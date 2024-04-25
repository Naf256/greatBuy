DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS productFeedback;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS attendence;
DROP TABLE IF EXISTS salary;
DROP TABLE IF EXISTS promotions;
DROP TABLE IF EXISTS expenses;
DROP TABLE IF EXISTS loyaltyPrograms;
DROP TABLE IF EXISTS delivery;
DROP TABLE IF EXISTS performances;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employee', 'customer', 'delivery Man') NOT NULL,
    email VARCHAR(100) UNIQUE,
    name VARCHAR(100),
    phone_number VARCHAR(15),
    address VARCHAR(255)
);

INSERT INTO users (username, password, role, email, name, phone_number, address) 
VALUES ('foo', 'fjfj', 'admin', 'foo@example.com', 'Foo User', '+1234567890', '123 Main St, City');

INSERT INTO users (username, password, role, email, name, phone_number, address) 
VALUES ('bar', 'fjfj', 'employee', 'bar@example.com', 'Bar Employee', '+9876543210', '456 Elm St, Town');

INSERT INTO users (username, password, role, email, name, phone_number, address) 
VALUES ('tokyo', 'fjfj', 'customer', 'tokyo@example.com', 'Tokyo Customer', '+1122334455', '789 Oak St, Village');

INSERT INTO users (username, password, role, email, name, phone_number, address) 
VALUES ('ramen', 'fjfj', 'delivery Man', 'ramen@example.com', 'Ramen Delivery Man', '+9988776655', '321 Pine St, County');

INSERT INTO users (username, password, role, email, name, phone_number, address) 
VALUES ('soju', 'fjfj', 'delivery Man', 'soju@example.com', 'Soju Delivery Man', '+9988776656', '321 Gomez St, Japan');

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50),
    stock_quantity INT NOT NULL DEFAULT 0
);

INSERT INTO products (name, description, price, category, stock_quantity) VALUES ('Laptop', 'High-performance laptop with 15-inch display', 999.99, 'Electronics', 50);

INSERT INTO products (name, description, price, category, stock_quantity) VALUES ('Wireless Mouse', 'Ergonomic wireless mouse with adjustable DPI', 19.99, 'Electronics', 100);

INSERT INTO products (name, description, price, category, stock_quantity) VALUES ('Yoga Mat', 'Eco-friendly yoga mat made from natural rubber', 29.99, 'Fitness', 200);

INSERT INTO products (name, description, price, category, stock_quantity) VALUES ('Running Shoes', 'Breathable running shoes with cushioned sole', 69.99, 'Footwear', 150);

INSERT INTO products (name, description, price, category, stock_quantity) VALUES ('Water Bottle', 'Stainless steel water bottle with vacuum insulation', 14.99, 'Outdoor', 300);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'shipped', 'delivered') NOT NULL DEFAULT 'pending',
    total_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO orders (user_id, product_id, status, total_amount) VALUES (1, 1, 'pending', 25.99);
INSERT INTO orders (user_id, product_id, status, total_amount) VALUES (2, 2, 'shipped', 19.99);
INSERT INTO orders (user_id, product_id, status, total_amount) VALUES (3, 3, 'delivered', 15.99);
INSERT INTO orders (user_id, product_id, status, total_amount) VALUES (4, 4, 'pending', 29.99);

CREATE TABLE productFeedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    user_id INT,
    rating INT,
    comment TEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO productFeedback (product_id, user_id, rating, comment)
VALUES (1, 1, 4, 'Great product! Really satisfied with my purchase.');

INSERT INTO productFeedback (product_id, user_id, rating, comment)
VALUES (2, 2, 5, 'Excellent quality! Will definitely buy again.');

INSERT INTO productFeedback (product_id, user_id, rating, comment)
VALUES (3, 3, 3, 'Good product, but delivery was a bit slow.');

INSERT INTO productFeedback (product_id, user_id, rating, comment)
VALUES (4, 4, 2, 'Not satisfied with the product. It arrived damaged.');

CREATE TABLE tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    assigned_to INT,
    task_description TEXT,
    due_date DATE,
    status ENUM('pending', 'completed') NOT NULL DEFAULT 'pending',
    FOREIGN KEY (assigned_to) REFERENCES users(user_id)
);


INSERT INTO tasks (assigned_to, task_description, due_date, status) 
VALUES (1, 'Complete project proposal', '2024-05-01', 'pending');

INSERT INTO tasks (assigned_to, task_description, due_date, status) 
VALUES (2, 'Review code changes', '2024-04-25', 'pending');

INSERT INTO tasks (assigned_to, task_description, due_date, status) 
VALUES (3, 'Prepare presentation slides', '2024-04-30', 'pending');

INSERT INTO tasks (assigned_to, task_description, due_date, status) 
VALUES (4, 'Test new software feature', '2024-04-28', 'pending');


CREATE TABLE attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('present', 'absent') NOT NULL DEFAULT 'present',
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO attendance (user_id, status) VALUES (1, 'present');
INSERT INTO attendance (user_id, status) VALUES (2, 'absent');
INSERT INTO attendance (user_id, status) VALUES (3, 'present');
INSERT INTO attendance (user_id, status) VALUES (4, 'absent');

CREATE TABLE salary (
    salary_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    month INT,
    year INT,
    salary_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE promotions (
    promotion_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    discount_percentage INT,
    delivery_charge INT,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE expenses (
    expense_id INT AUTO_INCREMENT PRIMARY KEY,
    expense_type VARCHAR(50),
    amount DECIMAL(10,2) NOT NULL,
    date DATE,
);

CREATE TABLE loyaltyPrograms (
    loyalty_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    loyalty_points INT NOT NULL DEFAULT 0,
    discount_percentage INT,
    expiration_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO loyaltyPrograms (user_id, loyalty_points, discount_percentage, expiration_date) VALUES (1, 100, 10, '2024-12-31');
INSERT INTO loyaltyPrograms (user_id, loyalty_points, discount_percentage, expiration_date) VALUES (2, 150, 15, '2024-12-31');
INSERT INTO loyaltyPrograms (user_id, loyalty_points, discount_percentage, expiration_date) VALUES (3, 200, 20, '2024-12-31');
INSERT INTO loyaltyPrograms (user_id, loyalty_points, discount_percentage, expiration_date) VALUES (4, 250, 25, '2024-12-31');


CREATE TABLE delivery (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
);

CREATE TABLE performances (
    performance_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    rating INT, 
    date DATE, 
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO performances (user_id, rating, date) VALUES
(2, 4, '2024-04-25'),
(3, 3, '2024-04-25'),
(4, 5, '2024-04-25');
