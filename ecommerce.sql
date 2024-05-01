-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2024 at 10:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('present','absent') NOT NULL DEFAULT 'present'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `user_id`, `date`, `status`) VALUES
(1, 2, '2024-04-30 18:00:00', 'present'),
(2, 2, '2024-05-01 18:00:00', 'absent'),
(3, 2, '2024-05-02 18:00:00', 'present'),
(4, 2, '2024-05-03 18:00:00', 'present'),
(5, 2, '2024-05-04 18:00:00', 'absent'),
(6, 2, '2024-05-05 18:00:00', 'present'),
(7, 2, '2024-05-06 18:00:00', 'absent'),
(8, 2, '2024-05-07 18:00:00', 'present'),
(9, 2, '2024-05-08 18:00:00', 'present'),
(10, 2, '2024-05-09 18:00:00', 'present'),
(11, 2, '2024-04-30 21:26:42', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `review_id` int(11) NOT NULL,
  `delivery_man_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_reviews`
--

INSERT INTO `customer_reviews` (`review_id`, `delivery_man_id`, `comment`, `rating`) VALUES
(1, 4, 'Great service! Delivery was fast and the package arrived in perfect condition.', 5),
(2, 4, 'The delivery man was polite and helpful.', 4),
(3, 4, 'Package was delivered on time, but it was slightly damaged.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `user_id`, `order_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3),
(4, 4, 4),
(5, 4, 6),
(6, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `loyaltyPrograms`
--

CREATE TABLE `loyaltyPrograms` (
  `loyalty_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `loyalty_points` int(11) NOT NULL DEFAULT 0,
  `discount_percentage` int(11) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loyaltyPrograms`
--

INSERT INTO `loyaltyPrograms` (`loyalty_id`, `user_id`, `loyalty_points`, `discount_percentage`, `expiration_date`) VALUES
(1, 3, 100, 10, NULL),
(2, 7, 200, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notify_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notify_id`, `user_id`, `message`) VALUES
(1, 4, 'You have a new friend request.'),
(2, 4, 'Reminder: Your appointment is tomorrow at 10:00 AM.'),
(3, 4, 'You have a new message in your inbox.'),
(4, 2, 'how are you'),
(5, 6, 'check for email');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','shipped','delivered') NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `order_date`, `status`, `total_amount`) VALUES
(1, 3, 1, '2024-04-30 21:12:52', 'delivered', 29.99),
(2, 3, 2, '2024-04-30 21:12:53', 'shipped', 39.99),
(3, 3, 7, '2024-04-30 21:12:56', 'delivered', 30.00),
(4, 3, 6, '2024-04-30 21:14:27', 'shipped', 2999.00),
(5, 3, 5, '2024-04-30 21:14:29', 'pending', 59.99),
(6, 3, 8, '2024-04-30 21:14:32', 'delivered', 35.01),
(7, 3, 10, '2024-05-01 07:26:25', 'pending', 499.00),
(8, 3, 7, '2024-05-01 07:26:27', 'shipped', 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `productFeedback`
--

CREATE TABLE `productFeedback` (
  `feedback_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productFeedback`
--

INSERT INTO `productFeedback` (`feedback_id`, `product_id`, `user_id`, `rating`, `comment`, `date`) VALUES
(1, 1, 3, 1, 'buy mojo brother', '2024-04-30 21:13:30'),
(2, 1, 3, 4, 'i think pepsico owns this', '2024-04-30 21:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category`, `stock_quantity`) VALUES
(1, 'Sprite', 'Description for Product 1', 29.99, 'Category 1', 98),
(2, 'Coke', 'Description for Product 2', 39.99, 'Category 2', 49),
(4, 'Fanta', 'Description for Product 4', 19.99, 'Category 3', 200),
(5, 'Rc Cola', 'Description for Product 5', 59.99, 'Category 2', 149),
(6, 'Air jordan', 'great sneakers, you\'all should give it a try!', 2999.00, 'Shoe', 98),
(7, 'Prime', 'electrolite drink', 30.00, 'Beverage', 2998),
(8, 'Geterade', 'Electrolite drink', 45.00, 'Beverage', 2999),
(9, 'Mojo', 'tastes like cocacola', 25.00, 'Beverage', 4548),
(10, 'Nike', 'good pair of shoes', 499.00, 'shoe', 387);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `delivery_charge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `product_id`, `discount_percentage`, `delivery_charge`) VALUES
(10, 1, 10, 30),
(11, 2, 20, 30),
(12, 4, 40, 30),
(13, 5, 50, 30),
(14, 6, 60, 30),
(15, 7, 70, 30),
(16, 8, 10, 30),
(17, 9, 25, 30),
(18, 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deposit_date` date DEFAULT NULL,
  `salary_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `user_id`, `deposit_date`, `salary_amount`) VALUES
(1, 2, NULL, 10000.00),
(2, 6, NULL, 14000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `task_description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `assigned_to`, `task_description`, `due_date`, `status`) VALUES
(1, 2, 'first task', '2024-05-01', 'completed'),
(2, 2, 'second task', '2024-05-01', 'completed'),
(3, 2, 'third task', '2024-05-01', 'pending'),
(4, 6, 'fourth task', '2024-05-01', 'pending'),
(5, 6, 'fifth task', '2024-05-01', 'pending'),
(6, 2, 'another task', '2024-05-01', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee','customer','delivery Man') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `email`, `name`, `phone_number`, `address`) VALUES
(1, 'foo', 'fjfj', 'admin', 'admin1@example.com', 'Admin User 1', '1234567890', '123 Admin St'),
(2, 'bar', 'fjfj', 'employee', 'employee1@example.com', 'Employee User 1', '9876543210', '456 Employee St'),
(3, 'tokyo', 'fjfj', 'customer', 'customer1@example.com', 'Customer User 1', '5551234567', '789 Customer St'),
(4, 'ramen', 'fjfj', 'delivery Man', 'delivery1@example.com', 'Delivery Man 1', '9995554321', '101 Delivery St'),
(5, 'jocko', 'fjfj', 'delivery Man', 'jocko@email.com', 'jocko podcast', '+943090394309', 'Beverly hills'),
(6, 'naval', 'fjfj', 'employee', 'naval@email.com', 'Naval Ravikant', '+9409903448', 'Austin heights, Malaysia'),
(7, 'hayder', 'fjfj', 'customer', 'hayer@email.com', 'Hasin Hayder', '+4904304309', 'Chittagong, Bangladesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `delivery_man_id` (`delivery_man_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `loyaltyPrograms`
--
ALTER TABLE `loyaltyPrograms`
  ADD PRIMARY KEY (`loyalty_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notify_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `productFeedback`
--
ALTER TABLE `productFeedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loyaltyPrograms`
--
ALTER TABLE `loyaltyPrograms`
  MODIFY `loyalty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productFeedback`
--
ALTER TABLE `productFeedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD CONSTRAINT `customer_reviews_ibfk_1` FOREIGN KEY (`delivery_man_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `loyaltyPrograms`
--
ALTER TABLE `loyaltyPrograms`
  ADD CONSTRAINT `loyaltyPrograms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `productFeedback`
--
ALTER TABLE `productFeedback`
  ADD CONSTRAINT `productFeedback_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productFeedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
