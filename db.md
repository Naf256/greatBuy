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
DROP TABLE IF EXISTS customer_reviews;
DROP TABLE IF EXISTS notifications;

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


CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50),
    stock_quantity INT NOT NULL DEFAULT 0
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'shipped', 'delivered') NOT NULL DEFAULT 'pending',
    total_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);


CREATE TABLE productFeedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    user_id INT,
    rating INT,
    comment TEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);



CREATE TABLE tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    assigned_to INT,
    task_description TEXT,
    due_date DATE,
    status ENUM('pending', 'completed') NOT NULL DEFAULT 'pending',
    FOREIGN KEY (assigned_to) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('present', 'absent') NOT NULL DEFAULT 'present',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS salary (
    salary_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    deposit_date DATE,
    salary_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE promotions (
    promotion_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    discount_percentage INT,
    delivery_charge INT,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);


CREATE TABLE loyaltyPrograms (
    loyalty_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    loyalty_points INT NOT NULL DEFAULT 0,
    discount_percentage INT,
    expiration_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE delivery (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);

CREATE TABLE performances (
    performance_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    rating INT, 
    date DATE, 
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE customer_reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    delivery_man_id INT,
    comment TEXT,
    rating INT,
    FOREIGN KEY (delivery_man_id) REFERENCES users(user_id) ON DELETE CASCADE
);



CREATE TABLE notifications (
    notify_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


INSERT INTO users (username, password, role, email, name, phone_number, address) VALUES
('foo', 'fjfj', 'admin', 'admin1@example.com', 'Admin User 1', '1234567890', '123 Admin St'),
('bar', 'fjfj', 'employee', 'employee1@example.com', 'Employee User 1', '9876543210', '456 Employee St'),
('tokyo', 'fjfj', 'customer', 'customer1@example.com', 'Customer User 1', '5551234567', '789 Customer St'),
('ramen', 'fjfj', 'delivery Man', 'delivery1@example.com', 'Delivery Man 1', '9995554321', '101 Delivery St');


INSERT INTO products (name, description, price, category, stock_quantity) VALUES
('Sprite', 'Description for Product 1', 29.99, 'Category 1', 100),
('Coke', 'Description for Product 2', 39.99, 'Category 2', 50),
('Merinda', 'Description for Product 3', 49.99, 'Category 1', 75),
('Fanta', 'Description for Product 4', 19.99, 'Category 3', 200),
('Rc Cola', 'Description for Product 5', 59.99, 'Category 2', 150);

INSERT INTO orders (user_id, product_id, total_amount) VALUES
(3, 1, 29.99),
(4, 2, 39.99),
(3, 3, 49.99),
(4, 4, 19.99),
(3, 5, 59.99);


INSERT INTO productFeedback (product_id, user_id, rating, comment) VALUES
(1, 3, 4, 'Great product!'),
(2, 4, 5, 'Excellent service!'),
(3, 3, 3, 'Could be better.'),
(4, 4, 5, 'Very satisfied.'),
(5, 3, 4, 'Fast delivery.');


INSERT INTO tasks (assigned_to, task_description, due_date, status) VALUES
(2, 'Task 1 description', '2024-05-10', 'pending'),
(3, 'Task 2 description', '2024-05-15', 'completed'),
(2, 'Task 3 description', '2024-05-20', 'pending'),
(4, 'Task 4 description', '2024-05-25', 'completed'),
(3, 'Task 5 description', '2024-05-30', 'pending');


INSERT INTO attendance (user_id, status) VALUES
(2, 'present'),
(3, 'present'),
(4, 'absent'),
(2, 'present'),
(3, 'absent');


INSERT INTO salary (user_id, deposit_date, salary_amount) VALUES
(2, '2024-05-01', 2000.00),
(3, '2024-05-01', 2500.00),
(4, '2024-05-01', 1800.00),
(2, '2024-05-01', 2000.00),
(3, '2024-05-01', 2500.00);


INSERT INTO promotions (product_id, discount_percentage, delivery_charge) VALUES
(1, 10, 5),
(2, 15, 7),
(3, 20, 8),
(4, 10, 6),
(5, 15, 7);

INSERT INTO loyaltyPrograms (user_id, loyalty_points, discount_percentage, expiration_date) VALUES
(3, 100, 10, '2024-12-31'),
(4, 50, 5, '2024-12-31'),
(3, 150, 15, '2024-12-31'),
(2, 200, 20, '2024-12-31'),
(4, 75, 7, '2024-12-31');

INSERT INTO delivery (user_id, order_id) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5);


INSERT INTO performances (user_id, rating, date) VALUES
(2, 4, '2024-04-30'),
(3, 5, '2024-04-30'),
(4, 3, '2024-04-30'),
(2, 4, '2024-04-30'),
(3, 5, '2024-04-30');


INSERT INTO customer_reviews (delivery_man_id, comment, rating) VALUES
(4, 'Great service!', 5),
(4, 'Fast delivery, very professional.', 5),
(4, 'Excellent communication.', 4),
(4, 'Good job!', 5),
(4, 'Highly recommended!', 5);


INSERT INTO notifications (user_id, message) VALUES
(2, 'You have a new task assigned.'),
(3, 'Your order has been shipped.'),
(4, 'You have a new customer review.'),
(2, 'Your salary has been deposited.'),
(3, 'You have a new loyalty reward.');
