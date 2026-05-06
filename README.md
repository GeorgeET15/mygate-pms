# Mygate Property Management System (PMS)

A containerized Property Management System built with CodeIgniter 4, featuring a modern user interface, DataTables integration, and a Google Gemini-powered Retrieval-Augmented Generation (RAG) system.

## Setup Instructions (Development)

Follow these precise steps to initialize the development environment:

### 1. Repository Preparation
Clone the repository and enter the project directory:
```bash
git clone <repository_url>
cd mygate-pms
```

### 2. Environment Configuration
The application requires a `.env` file to manage secrets and connections. 
- **Create the file**:
  ```bash
  cp env .env
  ```
- **Edit the file**: Open `.env` in your editor and configure the following:
  - **Gemini AI**: Add your API key to `GOOGLE_API_KEY`.
  - **Environment**: Set `CI_ENVIRONMENT = development`.
  - **Database**: Ensure the following settings match the Docker infrastructure:
    ```ini
    database.default.hostname = mygate-pms-db
    database.default.database = pms
    database.default.username = root
    database.default.password = root
    ```

### 3. Infrastructure Initialization
Spin up the containerized services (PHP, MySQL, Qdrant, RAG-Service):
```bash
docker-compose up -d --build
```
*Note: The first build may take several minutes as it installs PHP extensions and Python dependencies.*

### 4. Database & AI Synchronization
Once containers are running, populate the AI vector store:
```bash
docker exec -it rag-service python /app/sync_data.py
```

### 5. Verification
- **Web App**: Visit [http://localhost:8080](http://localhost:8080)
- **RAG API**: Visit [http://localhost:8000/docs](http://localhost:8000/docs) (Swagger UI)
- **Database**: Port `3306` is exposed for external tools (e.g., TablePlus, DBeaver).

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

## Development Server Deployment

If you are setting up a dedicated remote server for testing/development (e.g., `dev.mygate.com`):

### 1. Environment Differences
Unlike production, the dev server should keep debug features active:
- **Environment**: Set `CI_ENVIRONMENT = development` in `.env`.
- **Toolbar**: Ensure the Debug Toolbar is enabled in `app/Config/Filters.php` for this specific instance.

### 2. Configuration
- **Base URL**: Update `app.baseURL` to your dev subdomain: `https://dev.yourdomain.com/`.
- **Git Branch**: Often deployed from a `develop` or `staging` branch instead of `main`.

### 3. Server Setup (Quick Commands)
Assuming a clean Ubuntu server with Docker installed:
```bash
# Clone and enter
git clone -b develop <repo_url> dev-pms
cd dev-pms

# Initialize environment
cp env .env
nano .env # Edit base URL, Gemini Key, and set ENV to development

# Start infrastructure
docker-compose up -d --build

# Populate AI
docker exec -it rag-service python /app/sync_data.py
```

### 4. Continuous Integration (Optional)
To auto-deploy when you push to the dev branch, you can use a simple Webhook or a GitHub Action that runs:
```bash
cd /path/to/dev-pms && git pull && docker-compose up -d
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
