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

INSERT INTO loyaltyPrograms (user_id, loyalty_points, discount_percentage) VALUES (3, 100, 10);
INSERT INTO loyaltyPrograms (user_id, loyalty_points, discount_percentage) VALUES (7, 200, 20);

CREATE TABLE delivery (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);


CREATE TABLE customer_reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    delivery_man_id INT,
    comment TEXT,
    rating INT,
    FOREIGN KEY (delivery_man_id) REFERENCES users(user_id) ON DELETE CASCADE
);

insert into customer_reviews (delivery_man_id, comment, rating) values (4, 'great service! delivery was fast and the package arrived in perfect condition.', 5);
insert into customer_reviews (delivery_man_id, comment, rating) values (4, 'the delivery man was polite and helpful.', 4);
insert into customer_reviews (delivery_man_id, comment, rating) values (4, 'package was delivered on time, but it was slightly damaged.', 3);


CREATE TABLE notifications (
    notify_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


INSERT INTO notifications (user_id, message) VALUES (4, 'You have a new friend request.');
INSERT INTO notifications (user_id, message) VALUES (4, 'Reminder: Your appointment is tomorrow at 10:00 AM.');
INSERT INTO notifications (user_id, message) VALUES (4, 'You have a new message in your inbox.');

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

INSERT INTO promotions (product_id, discount_percentage, delivery_charge) VALUES
    (1, 10, 30),
    (2, 20, 30),
    (3, 30, 30),
    (4, 40, 30),
    (5, 50, 30),
    (6, 60, 30),
    (7, 70, 30),
    (8, 15, 30),
    (9, 25, 30);
