# Mygate Property Management System (PMS)

A containerized Property Management System built with CodeIgniter 4, featuring a modern user interface, DataTables integration, and a Google Gemini-powered Retrieval-Augmented Generation (RAG) system.

## Setup Instructions

Ensure Docker and Docker Compose are installed on the host system.

1. **Clone the Repository** (or navigate to the project folder)
2. **Configure Environment**
   - Copy `env` to `.env`.
   - Configure the Google Gemini API Key:
     ```ini
     GOOGLE_API_KEY=your_gemini_api_key_here
     ```
   - Verify database configuration:
     ```ini
     database.default.hostname = mygate-pms-db
     database.default.database = pms
     database.default.username = root
     database.default.password = root
     database.default.DBDriver = MySQLi
     ```
3. **Initialize Containers**
   ```bash
   docker-compose up -d --build
   ```
4. **Access the Application**
   - **Web Interface**: [http://localhost:8080](http://localhost:8080)
   - **Authentication**: Use administrative credentials to log in.

---

## AI and RAG Infrastructure

The system integrates an advanced AI layer to assist property administrators with data retrieval and analysis.

### Technical Architecture
- **Language Model**: Google Gemini 2.5 Flash.
- **Embeddings**: `gemini-embedding-001`.
- **Vector Database**: Qdrant (Collection: `pms_knowledge`).

### Retrieval Augmented Generation (RAG)
The `rag-service` microservice indexes unstructured data to provide context-aware responses:
- **Maintenance Logs**: Historical maintenance data and issue descriptions.
- **Noticeboard**: Formal announcements and internal notices.
- **Work Orders**: Comprehensive tracking of pending and completed tasks.
- **Data Synchronization**: Execute `docker exec -it rag-service python /app/sync_data.py` to synchronize the vector database with the latest records.

### SQL Agent Functionality
The AI assistant functions as a SQL Agent with the following capabilities:
- Generation and execution of read-only SQL queries against the production database.
- Real-time reporting on tenant status, unit vacancy rates, and financial metrics.

---

## Technology Stack
- **Backend Framework**: CodeIgniter 4.x
- **AI Infrastructure**: Python (FastAPI), Google GenAI SDK, Qdrant
- **Database Management**: MySQL 8.0
- **Frontend Components**: Bootstrap 5, DataTables.js, Chart.js, Marked.js
- **Containerization**: Docker, Nginx

## Core Functionality
- **Analytical Dashboard**: Centralized interface for real-time statistics and financial analytics.
- **Search-Enabled Interfaces**: Advanced filtering and pagination via DataTables.js integration.
- **Professional Design System**: Corporate branding utilizing the Mygate color palette.

## Project Directory Structure
- `app/`: Application source code.
- `ai-layer/`: AI microservice and synchronization scripts.
- `public/`: Publicly accessible assets.
- `docker-compose.yml`: Infrastructure orchestration file.

---
*Developed for Mygate Property Management Services.*
