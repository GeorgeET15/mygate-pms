# Changelog & Setup Journey

This document outlines all the modifications, fixes, and additions made to the Property Management System (PMS) codebase to make it run flawlessly on modern systems and strip out legacy technical debt.

## 1. Docker Development Environment
The original application was built using CodeIgniter 2.x and PHP 5.6, which are extremely difficult to run natively on modern Apple Silicon Macs. We containerized the app:
- **`Dockerfile`**: Added to pull `php:5.6-apache`, install the legacy `mysql` and `mysqli` extensions, and enable Apache `mod_rewrite`.
- **`docker-compose.yml`**: Added to orchestrate the PHP web server and a `mysql:5.7` database. Included `platform: linux/amd64` to ensure the old MySQL image runs smoothly on Mac M-series chips via Rosetta.
- **`application/config/database.php`**: Updated the CodeIgniter database configuration to point to the Docker `db` service using credentials `root` / `root`.

## 2. Database Schema Reverse Engineering
The original developers included a dummy initialization file (`uploads/hms.sql`) that contained the schema for a **Hospital Management System** (with tables for blood banks, nurses, beds) instead of the actual Property Management System.
- **Reverse Engineering**: We scanned all controllers and models to rebuild the *actual* database schema used by the application.
- **`pms_schema.sql`**: Created this new file containing the `CREATE TABLE` statements for all 21 missing tables (e.g., `property`, `unit`, `p_tenant`, `p_lease`, `work_order`, `p_marketing`, `p_quick_links`, `pass_storer`, etc.).
- **Auto-Initialization**: Updated `docker-compose.yml` to automatically inject `pms_schema.sql` into the database on startup.
- **Admin Seeding**: Seeded the database with a default admin user (`admin@admin.com` / `admin`).

## 3. Data Population
- Wrote a Python script (`generate_fake_data.py`) to generate realistic, randomized fake data to flesh out the application.
- Seeded the database with **50 landlords, 50 properties, 200 units, 150 rental applications, 100 active tenants/leases, 200 work orders, and 150 maintenance logs**.

## 4. UI Fixes
- **Missing Module**: Discovered that an external accounting sub-module (`accounting/scb_mod/`) was entirely missing from the codebase. Commented out the "Accounts Module" link in the sidebar (`application/views/admin/navigation.php`) to prevent 404 errors.

## 5. Legacy Hospital Boilerplate Cleanup
We conducted a massive sweep to delete the dead code left behind from the Hospital Management boilerplate:
- **Login Controller (`application/controllers/login.php`)**: Removed all session checks, redirects, and POST handling for `doctor`, `patient`, `nurse`, `pharmacist`, `laboratorist`, and `accountant` login types.
- **Login View (`application/views/login.php`)**: Removed the HTML `<option>` dropdown choices for hospital user types from both the main login form and the reset password modal.
- **Admin Controller (`application/controllers/admin.php`)**: Removed conflicting blocks of code inside the `rental_application` feature that were still trying to edit/update/delete records in the `doctor` table.
- **Orphaned Views**: Deleted `application/views/admin/view_report.php`, which was a completely unused hospital report.
- **Backup Manager (`application/views/admin/backup_restore.php`)**: Rewrote the Backup & Restore page loop. It previously allowed admins to download backups of tables like `blood_bank` and `nurse`. It now correctly lists and backs up `property`, `unit`, `p_lease`, `work_order`, etc.
- **Schema Purge**: Deleted the confusing `uploads/hms.sql` file and dropped all 18 dead hospital tables from the live database container.
