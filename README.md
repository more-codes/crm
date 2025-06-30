# Mini CRM Example

This project provides a very small CRM-like example for a pharmacy.
It is built using plain PHP (no framework) with MySQLi prepared statements,
MySQL database, and vanilla HTML/CSS/JavaScript.

## Features

- Login system with admin and operator roles.
- Admin dashboard to manage products, categories, and operators.
- Operator dashboard to view products.
- Basic CRUD pages for products, categories, and operators.

## Setup

1. Create a MySQL database named `crm` and run the following SQL to create tables:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','operator') NOT NULL
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- create default admin user (password: adminpass)
INSERT INTO users (username, password, role) VALUES ('admin', PASSWORD('adminpass'), 'admin');
```

2. Update `includes/db.php` with your database credentials.
3. Upload the project files to your hosting account (e.g., Hostinger) and access `index.php`.
4. Login with the admin account and start adding data.

This is only a minimal example and does not include advanced security or validation. It can be extended to meet additional requirements.
