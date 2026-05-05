import random
import datetime

first_names = ["James", "John", "Robert", "Michael", "William", "David", "Richard", "Charles", "Joseph", "Thomas", "Mary", "Patricia", "Jennifer", "Linda", "Elizabeth", "Barbara", "Susan", "Jessica", "Sarah", "Karen"]
last_names = ["Smith", "Johnson", "Williams", "Brown", "Jones", "Garcia", "Miller", "Davis", "Rodriguez", "Martinez", "Hernandez", "Lopez", "Gonzalez", "Wilson", "Anderson", "Thomas", "Taylor", "Moore", "Jackson", "Martin"]
cities = ["New York", "Los Angeles", "Chicago", "Houston", "Phoenix", "Philadelphia", "San Antonio", "San Diego", "Dallas", "San Jose"]
streets = ["Main St", "Oak St", "Pine St", "Maple Ave", "Cedar Ln", "Elm St", "Washington Blvd", "Lake Rd", "Hill St", "Park Ave"]
property_types = ["Apartment", "Condo", "Single Family Home", "Townhouse", "Multi-Family", "Commercial"]

sql = []

# Generate Landlords
for i in range(1, 51):
    fname = random.choice(first_names)
    lname = random.choice(last_names)
    email = f"{fname.lower()}.{lname.lower()}{i}@example.com"
    phone = f"555-{random.randint(100, 999)}-{random.randint(1000, 9999)}"
    address = f"{random.randint(100, 9999)} {random.choice(streets)}"
    city = random.choice(cities)
    sql.append(f"INSERT INTO p_landlord (first_name, last_name, email, contact_no, address, city, country, state, zip_code) VALUES ('{fname}', '{lname}', '{email}', '{phone}', '{address}', '{city}', 'USA', 'CA', '90210');")

# Generate Properties
for i in range(1, 51):
    pname = f"{random.choice(last_names)} {random.choice(['Plaza', 'Towers', 'Estates', 'Heights', 'Apartments', 'Court'])}"
    ptype = random.choice(property_types)
    address = f"{random.randint(100, 9999)} {random.choice(streets)}"
    city = random.choice(cities)
    sql.append(f"INSERT INTO property (property_type, property_name, frequency, unit, tarea, tarea_munit, property_address, city, property_country, property_province, zip_code) VALUES ('{ptype}', '{pname}', 'Monthly', {random.randint(1, 50)}, '1000', 'sqft', '{address}', '{city}', 'USA', 'CA', '90210');")

# Generate Units
unit_id_counter = 1
for prop_id in range(1, 51):
    num_units = random.randint(4, 10)
    for u in range(1, num_units + 1):
        beds = random.randint(1, 4)
        baths = random.randint(1, 3)
        rent = random.randint(800, 3500)
        vacant = random.choice([0, 1])
        sql.append(f"INSERT INTO unit (unit_name, unit_type, property_name, floor_number, bedrooms, bathrooms, trent, trent_period, vacant_status) VALUES ('Unit {u}', 'Residential', {prop_id}, {random.randint(1, 5)}, {beds}, {baths}, '{rent}', 'Monthly', {vacant});")
        unit_id_counter += 1

# Generate AppInfo
for i in range(1, 151):
    fname = f"{random.choice(first_names)} {random.choice(last_names)}"
    phone = f"555-{random.randint(100, 999)}-{random.randint(1000, 9999)}"
    email = f"applicant{i}@example.com"
    prop_id = random.randint(1, 50)
    sql.append(f"INSERT INTO p_appinfo (property_name, movein_date, no_of_bedroom, full_name, phone_number, email, rent_status, application_date) VALUES ({prop_id}, '2026-06-01', {random.randint(1, 3)}, '{fname}', '{phone}', '{email}', {random.choice([0, 1, 2])}, '2026-05-01');")

# Generate Tenants & Leases
for i in range(1, 101):
    fname = f"{random.choice(first_names)} {random.choice(last_names)}"
    phone = f"555-{random.randint(100, 999)}-{random.randint(1000, 9999)}"
    prop_id = random.randint(1, 50)
    unit_id = random.randint(1, unit_id_counter - 1)
    sql.append(f"INSERT INTO p_tenant (appinfo_id, tenant_name, tenant_contact, property_name, frequency, vacant_unit, tenantStatus) VALUES ({i}, '{fname}', '{phone}', {prop_id}, 'Monthly', {unit_id}, 0);")
    
    rentAmount = random.randint(800, 3500)
    sql.append(f"INSERT INTO p_lease (tenantId, moveinDate, moveoutDate, property_name, frequency, vacant_unit, rentAmount, leaseStatus) VALUES ({i}, '2025-01-01', '2026-01-01', {prop_id}, 'Monthly', {unit_id}, '{rentAmount}', 0);")

# Generate Work Orders
contractors = ["Bobs Plumbing", "Ace Electrical", "Speedy Maintenance", "Pro Cleaners", "Roof Masters"]
for i in range(1, 201):
    contractor = random.choice(contractors)
    prop_id = random.randint(1, 50)
    title = random.choice(["Fix Leaking Pipe", "Replace Light Fixture", "Clean Carpets", "Repair HVAC", "Paint Walls", "Fix Broken Window"])
    cost = random.randint(50, 500)
    done = random.choice(["Yes", "No"])
    sql.append(f"INSERT INTO work_order (contractor, PropertyId, JobTitle, JobDescription, Material1Cost, isWorkDone, user) VALUES ('{contractor}', {prop_id}, '{title}', 'Routine maintenance task.', '{cost}', '{done}', 'admin');")

# Generate Maintenance Logs
for i in range(1, 151):
    contractor = random.choice(contractors)
    prop_id = random.randint(1, 50)
    title = random.choice(["Fix Leaking Pipe", "Replace Light Fixture", "Clean Carpets", "Repair HVAC", "Paint Walls", "Fix Broken Window"])
    cat = random.choice(["Plumbing", "Electrical", "General", "HVAC"])
    sql.append(f"INSERT INTO p_maintenance_log (contractor, PropertyId, UnitName, Category, MaintenanceTitle, Description, when_done, user) VALUES ('{contractor}', {prop_id}, '{random.randint(1,10)}', '{cat}', '{title}', 'Completed maintenance task.', '2026-05-01', 'admin');")

with open('fake_data.sql', 'w') as f:
    f.write("\n".join(sql))
