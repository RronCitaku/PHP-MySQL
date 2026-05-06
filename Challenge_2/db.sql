CREATE DATABASE products_db;

USE products_db;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10,2),
    description TEXT,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);