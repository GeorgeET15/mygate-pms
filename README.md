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

## Server Deployment

To deploy the Mygate PMS to a production server (Ubuntu/Debian recommended):

### 1. Prerequisites
- **Docker & Docker Compose**: Ensure the latest versions are installed.
- **Git**: For cloning and updating the repository.
- **Domain Name**: Point your DNS A-record to the server's IP.

### 2. File Permissions
CodeIgniter requires write access to several directories. Run these commands from the project root:
```bash
sudo chown -R www-data:www-data writable
sudo chmod -R 775 writable
```

### 3. Production Hardening
- **Environment**: Change `CI_ENVIRONMENT` in `.env` to `production`.
- **Base URL**: Update `app.baseURL` in `.env` to your actual domain (e.g., `https://pms.mygate.com/`).
- **Security**: Ensure the `GOOGLE_API_KEY` is kept secret and not committed to public repositories.

### 4. Reverse Proxy (Nginx)
It is recommended to use Nginx as a reverse proxy with SSL (Certbot/Let's Encrypt).
```nginx
server {
    listen 80;
    server_name pms.yourdomain.com;

    location / {
        proxy_pass http://localhost:8080;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

### 5. Automated Data Sync
Set up a cron job to keep the AI Knowledge Base updated:
```bash
# Update every hour
0 * * * * docker exec rag-service python /app/sync_data.py > /dev/null 2>&1
```

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
