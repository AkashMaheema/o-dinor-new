-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 06:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
CREATE DATABASE o_dinor;

USE o_dinor;
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `gender`, `category`, `cost`, `rate`, `title`, `description`, `created_at`) VALUES
(1, 'COLLAR SHIRT', 'M', 'Shirts', 3000.00, 7000.00, 'STAND-UP COLLAR SHIRT', 'Relaxed fit shirt made of cotton. Stand-up collar with front button fastening. Long sleeves with buttoned cuffs.', '2024-07-15 09:49:39'),
(2, 'BERMUDA SHORTS', 'M', 'Shorts', 3000.00, 5000.00, 'EMBROIDERED TEXTURED BERMUDA SHORTS', 'Cotton Bermuda shorts. Elasticated waistband with adjustable drawstrings. Side pockets at the hip and back patch pocket detail. Contrast embroidery on the leg.', '2024-07-15 09:54:43'),
(3, 'LYOCELL SHIRT', 'M', 'Shirts', 5000.00, 8500.00, 'LYOCELL SHIRT', 'Relaxed-fit collared shirt made of lyocell. Long sleeves with buttoned cuffs. Chest patch pocket. Button-up front.', '2024-07-15 09:58:32'),
(4, 'RUNNING SNEAKERS', 'M', 'Shoes', 10000.00, 15000.00, 'MULTIPIECE CHUNKY RUNNING SNEAKERS', 'Running sneakers. Combination of pieces and finishes on the upper. Six-eyelet facing. Hiking-inspired design. Chunky sole with an irregular design.', '2024-07-15 10:10:52'),
(5, 'SOFT SCARF', 'M', 'Accessories', 2500.00, 4500.00, 'BASIC SOFT SCARF', 'Soft-touch scarf. Fringed trims.\r\n\r\nMeasurements: 186 x 60 cm. / 73.2 x 23.6″', '2024-07-15 10:15:38'),
(6, 'SLIM FIT JEANS', 'M', 'Jeans', 6000.00, 9500.00, 'SLIM FIT JEANS', 'Slim fit jeans. Five pockets. Faded and ripped effect all over the garment. Front zip fly and button fastening.', '2024-07-15 10:25:39'),
(7, 'BAGGY FIT JEANS', 'M', 'Jeans', 6500.00, 10000.00, 'BAGGY FIT JEANS', 'Baggy fit jeans. Five pockets. Faded effect. Front zip fly and button fastening.', '2024-07-15 10:28:55'),
(8, 'COMFORT BLAZER', 'M', 'Blazer', 10000.00, 16000.00, 'COMFORT BLAZER', 'Straight fit blazer made of highly stretchy fabric. Notched lapel collar and long sleeves. Hip welt pockets and inside pocket detail. Back vent at the hem. Front button fastening.', '2024-07-15 10:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`) VALUES
(1, 1, 'uploads/01063470250-e1.jpg'),
(2, 1, 'uploads/01063470250-a4.jpg'),
(3, 1, 'uploads/01063470250-a3.jpg'),
(4, 1, 'uploads/01063470250-a2.jpg'),
(5, 1, 'uploads/01063470250-a1.jpg'),
(6, 1, 'uploads/01063470250-p.jpg'),
(7, 2, 'uploads/06917036251-e1.jpg'),
(8, 3, 'uploads/04470400807-e1.jpg'),
(9, 4, 'uploads/12310320120-e1.jpg'),
(10, 4, 'uploads/12310320120-e2.jpg'),
(11, 4, 'uploads/12310320120-e3.jpg'),
(12, 4, 'uploads/12310320120-e4.jpg'),
(13, 4, 'uploads/12310320120-a2.jpg'),
(14, 5, 'uploads/4000.jpg'),
(15, 5, 'uploads/4000 (3).jpg'),
(16, 5, 'uploads/4000 (2).jpg'),
(17, 5, 'uploads/4000 (1).jpg'),
(18, 6, 'uploads/08062459822-e1.jpg'),
(19, 6, 'uploads/08062459822-e3.jpg'),
(20, 6, 'uploads/08062459822-a3.jpg'),
(21, 6, 'uploads/08062459822-e2.jpg'),
(22, 6, 'uploads/08062459822-a1.jpg'),
(23, 7, 'uploads/04365460250-e1.jpg'),
(24, 7, 'uploads/04365460250-e4.jpg'),
(25, 7, 'uploads/04365460250-a4.jpg'),
(26, 7, 'uploads/04365460250-e3.jpg'),
(27, 7, 'uploads/04365460250-e2.jpg'),
(28, 8, 'uploads/05070435802-000-e1.jpg'),
(29, 8, 'uploads/05070435802-a5.jpg'),
(30, 8, 'uploads/05070435802-a1.jpg'),
(31, 8, 'uploads/05070435802-000-e3.jpg'),
(32, 8, 'uploads/05070435802-000-e2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sold_products`
--

CREATE TABLE `sold_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `sold_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `color` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `size`, `color`, `quantity`, `created_at`) VALUES
(1, 1, '', '', 100, '2024-07-15 09:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `admin_ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`admin_ID`, `username`, `password`) VALUES
(1, 'admin', '123'),
(2, 'Akash', '123'),
(3, 'test', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_ibfk_1` (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sold_products`
--
ALTER TABLE `sold_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`admin_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `sold_products`
--
ALTER TABLE `sold_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_color_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sold_products`
--
ALTER TABLE `sold_products`
  ADD CONSTRAINT `sold_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
