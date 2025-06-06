-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 07:45 AM
-- Server version: 8.0.37
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



--
-- Database: `crustonlinesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `crust`
--

CREATE TABLE `crust` (
  `crust_id` int NOT NULL,
  `crust_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `order_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `status_id` int NOT NULL,
  `order_date` datetime NOT NULL,
  `total_price` decimal(6,2) NOT NULL,
  `delivery_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custompizza`
--

CREATE TABLE `custompizza` (
  `custom_pizza_id` int NOT NULL,
  `crust_id` int NOT NULL,
  `sauce_id` int NOT NULL,
  `size` varchar(1) COLLATE utf8mb4_general_ci NOT NULL,
  `base_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customtopping`
--

CREATE TABLE `customtopping` (
  `custom_topping_id` int NOT NULL,
  `custom_pizza_id` int NOT NULL,
  `topping_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `drink_id` int NOT NULL,
  `drink_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `hire_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `name`, `username`, `password`, `role`, `hire_date`) VALUES
(1, 'Thais dos Santos Vieira', 'thaissvieira@crust.com.au', '$2y$10$jOS4sdD9Fel189brOszcX.SMJ95dXHlI/uHULbUKijR7kMbwYJtVu', 'Kitchen Staff', '2025-06-04 14:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `order_item_id` int NOT NULL,
  `order_id` int NOT NULL,
  `pizza_id` int DEFAULT NULL,
  `custom_pizza_id` int DEFAULT NULL,
  `drink_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount_paid` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `pizza_id` int NOT NULL,
  `pizza_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pizza_descrip` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `size` varchar(1) COLLATE utf8mb4_general_ci NOT NULL,
  `base_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`pizza_id`, `pizza_name`, `pizza_descrip`, `size`, `base_price`) VALUES
(1, 'Peri Peri Chicken', 'House Cooked Chicken, Roasted Capsicum, Caramelised Onions, Mozzarella, Shallots and Bocconcini on a Tomato base, topped with Peri-Peri sauce. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 20.00),
(2, 'Peri Peri Chicken', 'House Cooked Chicken, Roasted Capsicum, Caramelised Onions, Mozzarella, Shallots and Bocconcini on a Tomato base, topped with Peri-Peri sauce. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 23.00),
(3, 'Meat Deluxe', 'Smoked Ham, Pepperoni, Italian Sausage, House Cooked Chicken & Ground Beef and Bacon and Mozzarella on a BBQ base. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 21.00),
(4, 'Meat Deluxe', 'Smoked Ham, Pepperoni, Italian Sausage, House Cooked Chicken & Ground Beef and Bacon and Mozzarella on a BBQ base. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 24.00),
(5, 'Crust Supreme', 'Smoked Ham, Pepperoni, Italian Sausage, Mozzarella, Mushrooms, Fresh Capsicum, Spanish Onions, Pineapple & Kalamata Olives on a Tomato base. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 20.00),
(6, 'Crust Supreme', 'Smoked Ham, Pepperoni, Italian Sausage, Mozzarella, Mushrooms, Fresh Capsicum, Spanish Onions, Pineapple & Kalamata Olives on a Tomato base. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 23.00),
(7, 'Vegetarian Supreme', 'Grilled Eggplant, Marinated Artichokes, Baby Spinach, Roasted Capsicum, Mushrooms, Sundried Tomatoes, Mozzarella & Bocconcini on a Tomato base, topped with Pesto Aioli. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 20.00),
(8, 'Vegetarian Supreme', 'Grilled Eggplant, Marinated Artichokes, Baby Spinach, Roasted Capsicum, Mushrooms, Sundried Tomatoes, Mozzarella & Bocconcini on a Tomato base, topped with Pesto Aioli. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 23.00),
(9, 'BBQ Chicken', 'House Cooked Chicken, Mozzarella, Mushrooms, Spanish Onions & Shallots on a BBQ base (Feta optional). Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 19.00),
(10, 'BBQ Chicken', 'House Cooked Chicken, Mozzarella, Mushrooms, Spanish Onions & Shallots on a BBQ base (Feta optional). Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 22.00),
(11, 'Pepperoni', 'Pepperoni, Spanish Onions, Fresh Capsicum, House Cooked Ground Beef, Mozzarella & Garlic on a Tomato base. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 19.00),
(12, 'Pepperoni', 'Pepperoni, Spanish Onions, Fresh Capsicum, House Cooked Ground Beef, Mozzarella & Garlic on a Tomato base. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 22.00),
(13, 'Pesto Chicken Club', 'Chicken Breast Fillets, Prosciutto, Mozzarella, Spanish Onions & Tomatoes on a Tomato & Garlic base, garnished with Avocado, Rocket and Pesto Aioli. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 22.00),
(14, 'Pesto Chicken Club', 'Chicken Breast Fillets, Prosciutto, Mozzarella, Spanish Onions & Tomatoes on a Tomato & Garlic base, garnished with Avocado, Rocket and Pesto Aioli. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 25.00),
(15, '1889 Margherita', 'Bocconcini and Cherry Tomatoes on a Tomato base and garnished with Fresh Basil, Cracked Pepper & Sea Salt. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 18.00),
(16, '1889 Margherita', 'Bocconcini and Cherry Tomatoes on a Tomato base and garnished with Fresh Basil, Cracked Pepper & Sea Salt. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 21.00),
(17, 'Mediterranean Lamb', 'Roast Lamb, Mozzarella, Tomatoes, Capsicum, Spanish Onions, Feta & Oregano on a Garlic base, garnished with Mint Yoghurt & Lemon. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 21.00),
(18, 'Mediterranean Lamb', 'Roast Lamb, Mozzarella, Tomatoes, Capsicum, Spanish Onions, Feta & Oregano on a Garlic base, garnished with Mint Yoghurt & Lemon. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 24.00),
(19, 'Vietnamese Chilli Chicken', 'House Chicken, Shallots, Mozzarella on a Tomato, Hoisin, Sweet Chilli & Garlic base, with Slaw, Coriander, Chilli & Aioli. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'L', 20.00),
(20, 'Vietnamese Chilli Chicken', 'House Chicken, Shallots, Mozzarella on a Tomato, Hoisin, Sweet Chilli & Garlic base, with Slaw, Coriander, Chilli & Aioli. Large (11\")/Gluten Free (10.5\"): 2 serves. Extra Large (13\"): 3 serves.', 'X', 23.00);

-- --------------------------------------------------------

--
-- Table structure for table `sauce`
--

CREATE TABLE `sauce` (
  `sauce_id` int NOT NULL,
  `sauce_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topping`
--

CREATE TABLE `topping` (
  `topping_id` int NOT NULL,
  `topping_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crust`
--
ALTER TABLE `crust`
  ADD PRIMARY KEY (`crust_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `custompizza`
--
ALTER TABLE `custompizza`
  ADD PRIMARY KEY (`custom_pizza_id`),
  ADD KEY `crust_id` (`crust_id`),
  ADD KEY `sauce_id` (`sauce_id`);

--
-- Indexes for table `customtopping`
--
ALTER TABLE `customtopping`
  ADD PRIMARY KEY (`custom_topping_id`),
  ADD KEY `custom_pizza_id` (`custom_pizza_id`),
  ADD KEY `topping_id` (`topping_id`);

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`drink_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pizza_id` (`pizza_id`),
  ADD KEY `custom_pizza_id` (`custom_pizza_id`),
  ADD KEY `drink_id` (`drink_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pizza_id`);

--
-- Indexes for table `sauce`
--
ALTER TABLE `sauce`
  ADD PRIMARY KEY (`sauce_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`topping_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crust`
--
ALTER TABLE `crust`
  MODIFY `crust_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custompizza`
--
ALTER TABLE `custompizza`
  MODIFY `custom_pizza_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customtopping`
--
ALTER TABLE `customtopping`
  MODIFY `custom_topping_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drink`
--
ALTER TABLE `drink`
  MODIFY `drink_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `order_item_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `pizza_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sauce`
--
ALTER TABLE `sauce`
  MODIFY `sauce_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topping`
--
ALTER TABLE `topping`
  MODIFY `topping_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD CONSTRAINT `customerorder_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `customerorder_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `customerorder_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `custompizza`
--
ALTER TABLE `custompizza`
  ADD CONSTRAINT `custompizza_ibfk_1` FOREIGN KEY (`crust_id`) REFERENCES `crust` (`crust_id`),
  ADD CONSTRAINT `custompizza_ibfk_2` FOREIGN KEY (`sauce_id`) REFERENCES `sauce` (`sauce_id`);

--
-- Constraints for table `customtopping`
--
ALTER TABLE `customtopping`
  ADD CONSTRAINT `customtopping_ibfk_1` FOREIGN KEY (`custom_pizza_id`) REFERENCES `custompizza` (`custom_pizza_id`),
  ADD CONSTRAINT `customtopping_ibfk_2` FOREIGN KEY (`topping_id`) REFERENCES `topping` (`topping_id`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `customerorder` (`order_id`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`pizza_id`),
  ADD CONSTRAINT `orderitem_ibfk_3` FOREIGN KEY (`custom_pizza_id`) REFERENCES `custompizza` (`custom_pizza_id`),
  ADD CONSTRAINT `orderitem_ibfk_4` FOREIGN KEY (`drink_id`) REFERENCES `drink` (`drink_id`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
