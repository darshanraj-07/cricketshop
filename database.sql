CREATE DATABASE cricket_store;
USE cricket_store;

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50),
    sub_category VARCHAR(50),
    brand VARCHAR(50),
    image VARCHAR(255),
    stock INT DEFAULT 0,
    rating DECIMAL(2,1) DEFAULT 0,
    reviews_count INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT FALSE,
    discount_percent INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    total_amount DECIMAL(10,2),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Clear existing products
TRUNCATE TABLE products;

-- Insert Cricket Bats
INSERT INTO products (name, description, price, category, brand, image, stock, rating, reviews_count, discount_percent) VALUES
('MRF Genius Limited Edition', 'Premium English willow cricket bat with perfect balance', 29999, 'bats', 'MRF', 'img/bats/bat1.jpg', 10, 4.8, 245, 15),
('Kookaburra Ghost Pro', 'Professional grade English willow bat with massive edges', 24999, 'bats', 'Kookaburra', 'img/bats/bat2.jpg', 15, 4.7, 189, 0),
('SG Player Edition', 'Kashmir willow bat with excellent pickup', 18999, 'bats', 'SG', 'img/bats/bat3.jpg', 20, 4.5, 156, 10);

-- Insert Cricket Balls
INSERT INTO products (name, description, price, category, brand, image, stock, rating, reviews_count, discount_percent) VALUES
('Kookaburra Red Test', 'Premium leather match ball used in Test cricket', 1999, 'balls', 'Kookaburra', 'img/balls/ball1.jpg', 50, 4.9, 123, 0),
('SG Test White Ball', 'Professional white leather ball for ODI matches', 1799, 'balls', 'SG', 'img/balls/ball2.jpg', 45, 4.6, 98, 5),
('Duke Pink Ball', 'Special pink ball for day-night Test matches', 2499, 'balls', 'Duke', 'img/balls/ball3.jpg', 30, 4.7, 76, 0);

-- Insert Cricket Jerseys
INSERT INTO products (name, description, price, category, brand, image, stock, rating, reviews_count, discount_percent) VALUES
('Team India Home Jersey', 'Official Indian cricket team jersey 2024', 4999, 'jerseys', 'Nike', 'img/jerseys/jersey1.jpg', 100, 4.8, 312, 20),
('IPL Chennai Jersey', 'Chennai Super Kings official jersey 2024', 3999, 'jerseys', 'Nike', 'img/jerseys/jersey2.jpg', 80, 4.7, 245, 15),
('World Cup Special Edition', 'ICC Cricket World Cup 2023 jersey', 5999, 'jerseys', 'Adidas', 'img/jerseys/jersey3.jpg', 50, 4.9, 178, 25);

-- Insert Cricket Shoes
INSERT INTO products (name, description, price, category, brand, image, stock, rating, reviews_count, discount_percent) VALUES
('Nike Cricket Spikes', 'Professional cricket spikes with excellent grip', 8999, 'shoes', 'Nike', 'img/shoes/shoe1.jpg', 40, 4.6, 167, 10),
('Adidas Cricket Shoes', 'Lightweight cricket shoes with comfort fit', 7999, 'shoes', 'Adidas', 'img/shoes/shoe2.jpg', 35, 4.5, 143, 15),
('Puma Bowling Spikes', 'Specialized bowling spikes for fast bowlers', 9999, 'shoes', 'Puma', 'img/shoes/shoe3.jpg', 25, 4.8, 98, 0);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    total_amount DECIMAL(10,2),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample products
INSERT INTO products (name, description, price, category, brand, image, stock, rating) VALUES
('Kookaburra Ghost Pro', 'Professional grade English willow cricket bat', 24999, 'bats', 'Kookaburra', 'img/bats_1.jpg', 10, 4.5),
('SG Player Edition', 'Premium Kashmir willow cricket bat', 18999, 'bats', 'SG', 'img/bats_2.jpg', 15, 4.3),
-- Add more products 

-- Add more sample products
INSERT INTO products (name, description, price, category, brand, image, stock, rating, reviews_count) VALUES
('MRF Genius Special', 'Premium English willow cricket bat', 21999, 'bats', 'MRF', 'img/bats_1.jpg', 10, 4.5, 128),
('Kookaburra Ghost Pro', 'Professional grade English willow bat', 24999, 'bats', 'Kookaburra', 'img/bats_2.jpg', 15, 4.8, 95),
('SG Player Edition', 'Kashmir willow cricket bat', 18999, 'bats', 'SG', 'img/bats_3.jpg', 20, 4.3, 156),
('Kookaburra Turf Ball', 'Premium leather cricket ball', 1499, 'balls', 'Kookaburra', 'img/balls_1.jpg', 50, 4.6, 89),
('SG Test Ball', 'Match quality leather ball', 1299, 'balls', 'SG', 'img/balls_2.jpg', 45, 4.4, 112),
('DSC Intense Pro Helmet', 'Professional cricket helmet', 3999, 'protection', 'DSC', 'img/protection_1.jpg', 25, 4.7, 78),
('SG Test Pads', 'Premium batting pads', 4999, 'protection', 'SG', 'img/protection_2.jpg', 30, 4.5, 92);

-- Update the product image paths
UPDATE products SET image = 'img/bats/bat1.jpg' WHERE category = 'bats' AND brand = 'MRF';
UPDATE products SET image = 'img/bats/bat2.jpg' WHERE category = 'bats' AND brand = 'Kookaburra';
UPDATE products SET image = 'img/bats/bat3.jpg' WHERE category = 'bats' AND brand = 'SG';

UPDATE products SET image = 'img/balls/ball1.jpg' WHERE category = 'balls' AND brand = 'Kookaburra';
UPDATE products SET image = 'img/balls/ball2.jpg' WHERE category = 'balls' AND brand = 'SG';
UPDATE products SET image = 'img/balls/ball3.jpg' WHERE category = 'balls' AND brand = 'Duke';

UPDATE products SET image = 'img/jerseys/jersey1.jpg' WHERE category = 'jerseys' AND name LIKE '%India%';
UPDATE products SET image = 'img/jerseys/jersey2.jpg' WHERE category = 'jerseys' AND name LIKE '%Chennai%';
UPDATE products SET image = 'img/jerseys/jersey3.jpg' WHERE category = 'jerseys' AND name LIKE '%World Cup%';

UPDATE products SET image = 'img/shoes/shoe1.jpg' WHERE category = 'shoes' AND brand = 'Nike';
UPDATE products SET image = 'img/shoes/shoe2.jpg' WHERE category = 'shoes' AND brand = 'Adidas';
UPDATE products SET image = 'img/shoes/shoe3.jpg' WHERE category = 'shoes' AND brand = 'Puma'; 