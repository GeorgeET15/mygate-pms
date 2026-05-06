from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from qdrant_client import QdrantClient
from qdrant_client.http import models
from google import genai
from google.genai import types
import os
import mysql.connector
import traceback

app = FastAPI()
GOOGLE_API_KEY = os.getenv("GOOGLE_API_KEY")
client = genai.Client(api_key=GOOGLE_API_KEY)
qdrant_client = QdrantClient(host="qdrant", port=6333)

DB_CONFIG = {
    "host": "mygate-pms-db",
    "user": "root",
    "password": "root",
    "database": "pms"
}

class ChatRequest(BaseModel):
    message: str
    property_id: int = None

def query_pms_database(sql_query: str):
    """
    Executes a read-only SELECT query against the PMS database and returns the results.
    Use this to get real-time data about tenants, units, payments, or properties.
    """
    if not sql_query.strip().lower().startswith("select"):
        return "Error: Only SELECT queries are allowed for security reasons."
    
    try:
        conn = mysql.connector.connect(**DB_CONFIG)
        cursor = conn.cursor(dictionary=True)
        cursor.execute(sql_query)
        results = cursor.fetchall()
        cursor.close()
        conn.close()
        return str(results)
    except Exception as e:
        return f"Database Error: {str(e)}"

# Define the tool for Gemini
db_tool = types.Tool(
    function_declarations=[
        types.FunctionDeclaration(
            name="query_pms_database",
            description="Executes a read-only SELECT query against the PMS database. Use this for real-time data.",
            parameters=types.Schema(
                type="OBJECT",
                properties={
                    "sql_query": types.Schema(type="STRING", description="The SQL SELECT query to execute.")
                },
                required=["sql_query"]
            )
        )
    ]
)

@app.post("/chat")
async def chat(request: ChatRequest):
    try:
        # 1. Retrieve Context from Qdrant using Gemini Embeddings
        embedding_result = client.models.embed_content(
            model="gemini-embedding-001",
            contents=request.message
        )
        query_vector = embedding_result.embeddings[0].values
        
        query_filter = None
        if request.property_id:
            query_filter = models.Filter(
                must=[models.FieldCondition(key="property_id", match=models.MatchValue(value=request.property_id))]
            )
        
        search_result = qdrant_client.query_points(
            collection_name="pms_knowledge",
            query=query_vector,
            limit=5,
            query_filter=query_filter
        )
        
        context = "\n".join([r.payload['text'] for r in search_result.points])
        
        # 2. Gemini Agent with Tool Use
        system_instruction = f"""
        You are the Mygate PMS Administrative Assistant. 
        
        You have access to:
        1. Historical Context (RAG): {context}
        2. Real-time Database Access: Use the 'query_pms_database' tool.
        
        Database Schema Overview:
        - property: property_id, property_name, property_type, city
        - unit: unit_id, unit_name, property_id, trent, vacant_status
        - p_tenant: tenant_id, tenant_name, property_name, vacant_unit, tenantStatus (Active/Inactive)
        - p_lease: leaseId, tenantId, rentAmount, moveinDate, moveoutDate
        - work_order: wo_id, PropertyId, JobTitle, JobDescription, isWorkDone (1=Completed, 0=Pending), created_at
        - noticeboard: notice_id, notice_title, notice
        
        If the user asks for data (e.g., 'How many vacant units?', 'List overdue payments'), generate a SQL query and use the tool.
        Always answer the user's question accurately.
        """
        
        response = client.models.generate_content(
            model="gemini-2.5-flash",
            config=types.GenerateContentConfig(
                system_instruction=system_instruction,
                tools=[db_tool]
            ),
            contents=request.message
        )
        
        # Handle Tool Use (Single turn for simplicity, but Gemini handles it well)
        final_text = ""
        for part in response.candidates[0].content.parts:
            if part.function_call:
                # Execute the tool
                tool_name = part.function_call.name
                tool_args = part.function_call.args
                if tool_name == "query_pms_database":
                    tool_result = query_pms_database(tool_args["sql_query"])
                    
                    # Send result back to LLM for final answer
                    final_response = client.models.generate_content(
                        model="gemini-2.5-flash",
                        config=types.GenerateContentConfig(system_instruction=system_instruction),
                        contents=[
                            types.Content(role="user", parts=[types.Part(text=request.message)]),
                            response.candidates[0].content,
                            types.Content(role="tool", parts=[
                                types.Part(function_response=types.FunctionResponse(
                                    name=tool_name,
                                    response={"result": tool_result}
                                ))
                            ])
                        ]
                    )
                    final_text = final_response.text
                break
            else:
                final_text += part.text

        return {"response": final_text}

    except Exception as e:
        traceback.print_exc()
        return {"response": f"I encountered an error: {str(e)}"}

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000)
