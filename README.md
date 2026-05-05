# Mygate Property Management System (PMS) - Modernized

A premium, containerized Property Management System built with CodeIgniter 4 and modernized with a high-end UI/UX, DataTables integration, and Dockerized infrastructure.

## 🚀 Quick Setup (Docker)

Ensure you have **Docker** and **Docker Compose** installed on your machine.

1. **Clone the Repository** (or navigate to the project folder)
2. **Configure Environment**
   - Copy `env` to `.env` if not already present.
   - Ensure database settings are:
     ```ini
     database.default.hostname = mygate-pms-db
     database.default.database = pms
     database.default.username = root
     database.default.password = root
     database.default.DBDriver = MySQLi
     ```
3. **Launch the Containers**
   ```bash
   docker-compose up -d --build
   ```
4. **Access the Application**
   - **Web App**: [http://localhost:8080](http://localhost:8080)
   - **Login**: (Use your admin credentials)

## 🛠️ Tech Stack
- **Framework**: CodeIgniter 4.x (PHP 8.1+)
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5, DataTables.js, Chart.js, Bootstrap Icons
- **Infrastructure**: Docker & Nginx

## ✨ Key Features
- **Modern Dashboard**: High-level "Mission Control" with real-time stats and graphical revenue analytics.
- **Collapsable Sidebar**: Maximized workspace with a sleek, responsive navigation system.
- **Search-Enabled Tables**: Instant filtering, sorting, and pagination across all data modules via DataTables.js.
- **Premium Branding**: Custom Mygate color palette (Black, Sky Blue, Bright Yellow) with premium gradients and glassmorphism elements.
- **Rental Applications**: Full end-to-end applicant tracking system.

## 🗄️ Database Management
The system uses a legacy database schema mapped to modern CI4 models.
- **Main Tables**: `property`, `unit`, `p_tenant`, `p_lease`, `p_appinfo`, `accounts_ledger`.
- **Database Host**: The database container is named `mygate-pms-db`.

## 📁 Project Structure
- `app/`: Source code (Controllers, Models, Views)
- `public/`: Assets (CSS, JS, Images) and entry point
- `writable/`: Logs, cache, and session data
- `docker-compose.yml`: Full stack definition

---
*Developed for Mygate Property Management Services.*
