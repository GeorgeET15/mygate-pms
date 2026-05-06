import mysql.connector
from qdrant_client import QdrantClient
from qdrant_client.http import models
from google import genai
import os
import time

# Configuration
DB_CONFIG = {
    "host": "mygate-pms-db",
    "user": "root",
    "password": "root",
    "database": "pms"
}
QDRANT_HOST = "qdrant"
QDRANT_PORT = 6333
GOOGLE_API_KEY = os.getenv("GOOGLE_API_KEY")

client = genai.Client(api_key=GOOGLE_API_KEY)
qdrant_client = QdrantClient(host=QDRANT_HOST, port=QDRANT_PORT)

def get_embeddings(text):
    try:
        result = client.models.embed_content(
            model="gemini-embedding-001",
            contents=text
        )
        return result.embeddings[0].values
    except Exception as e:
        print(f"Embedding error: {e}")
        time.sleep(5) # Backoff
        return get_embeddings(text)

def sync_unstructured_data():
    conn = mysql.connector.connect(**DB_CONFIG)
    cursor = conn.cursor(dictionary=True)
    
    points = []
    
    # 1. Maintenance Logs
    print("Indexing Maintenance Logs...")
    cursor.execute("SELECT m.*, p.property_name FROM p_maintenance_log m JOIN property p ON m.PropertyId = p.property_id")
    logs = cursor.fetchall()
    
    for log in logs:
        text = f"Property: {log['property_name']} | Maintenance Issue: {log['Description']} | Date: {log['when_done']}"
        vector = get_embeddings(text)
        points.append(models.PointStruct(
            id=int(log['maintenance_log_id']),
            vector=vector,
            payload={
                "type": "maintenance",
                "property_id": log['PropertyId'],
                "text": text,
                "date": str(log['when_done'])
            }
        ))
        time.sleep(1.0) # Rate limiting for free tier
        
    # 2. Notices
    print("Indexing Notices...")
    cursor.execute("SELECT * FROM noticeboard")
    notices = cursor.fetchall()
    for notice in notices:
        text = f"Notice Title: {notice['notice_title']} | Content: {notice['notice']}"
        vector = get_embeddings(text)
        points.append(models.PointStruct(
            id=10000 + int(notice['notice_id']),
            vector=vector,
            payload={
                "type": "notice",
                "text": text,
                "title": notice['notice_title']
            }
        ))
        time.sleep(1.0)

    # 3. Work Orders
    print("Indexing Work Orders...")
    cursor.execute("SELECT w.*, p.property_name FROM work_order w JOIN property p ON w.PropertyId = p.property_id")
    work_orders = cursor.fetchall()
    for wo in work_orders:
        status_text = "Completed" if str(wo.get('isWorkDone')).lower() in ['1', 'yes', 'true', 'completed'] else "Pending"
        text = f"Property: {wo['property_name']} | Outstanding Work Order: {wo['JobTitle']} - {wo['JobDescription']} | Status: {status_text} | Notes: {wo['Notes']}"
        vector = get_embeddings(text)
        points.append(models.PointStruct(
            id=20000 + int(wo['wo_id']),
            vector=vector,
            payload={
                "type": "work_order",
                "property_id": wo['PropertyId'],
                "text": text,
                "status": status_text
            }
        ))
        time.sleep(1.0)

    # Prepare Qdrant Collection
    if not qdrant_client.collection_exists("pms_knowledge"):
        qdrant_client.create_collection(
            collection_name="pms_knowledge",
            vectors_config=models.VectorParams(size=3072, distance=models.Distance.COSINE),
        )
    
    if points:
        qdrant_client.upsert(collection_name="pms_knowledge", points=points)
    
    cursor.close()
    conn.close()
    print(f"Gemini Sync Completed! {len(points)} documents indexed.")

if __name__ == "__main__":
    sync_unstructured_data()
