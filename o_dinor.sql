-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2024 at 04:53 AM
-- Server version: 8.0.34
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `o_dinor`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `gender`, `category`, `title`, `description`, `created_at`) VALUES
(1, 'TEXTURED BERMUDA SHORTS', 'M', 'Shorts', 'EMBROIDERED TEXTURED BERMUDA SHORTS', 'Cotton Bermuda shorts. Elasticated waistband with adjustable drawstrings. Side pockets at the hip and back patch pocket detail. Contrast embroidery on the leg.', '2024-08-04 12:20:27'),
(2, 'TEXTURED POLO SHIRT', 'M', 'Polos', 'TEXTURED POLO SHIRT WITH RIBBED TRIMS', 'Regular fit collared polo shirt with front opening. Short sleeves.', '2024-08-04 13:06:20'),
(3, 'BASIC HEAVY WEIGHT T-SHIRT', 'M', 'T-Shirts', 'BASIC HEAVY WEIGHT T-SHIRT', 'Oversize T-shirt made of compact cotton. Round neck and short sleeves.', '2024-08-04 13:09:24'),
(4, 'T-SHIRT WITH CONTRAST PRINT', 'M', 'T-Shirts', 'T-SHIRT WITH CONTRAST PRINT', 'Relaxed fit T-shirt. Round neck and short sleeve. Contrast print on the front.', '2024-08-04 13:12:14'),
(5, 'METALLIC THREAD CROPPED T-SHIRT', 'M', 'T-Shirts', 'METALLIC THREAD CROPPED T-SHIRT WITH SLOGAN', 'LOOSE FIT - ROUND NECK - SHORT - SHORT SLEEVES\r\nCropped T-shirt with metallic thread. Featuring a round neck, short sleeves and', '2024-08-04 13:15:14'),
(6, '100% WOOL KNIT T-SHIRT', 'M', 'T-Shirts', '100% WOOL KNIT T-SHIRT - LIMITED EDITION', 'Regular fit knit T-shirt made of lightweight spun wool. Featuring a round neck, short sleeves and ribbed trims.', '2024-08-07 10:40:09'),
(7, 'blazer', 'M', 'Blazers', 'blazersssssss', 'asdbahdbkajsjd', '2024-08-15 00:04:03'),
(8, 'CONTRAST PRINTED T-SHIRT', 'M', 'T-Shirts', 'CONTRAST PRINTED T-SHIRT', 'Relaxed fit T-shirt featuring a round neck and short sleeves. Contrast slogan and graphic prints on the front and back.', '2024-08-16 08:27:49'),
(11, 'MOUNTAIN JACQUARD T-SHIRT', 'M', 'T-Shirts', 'MOUNTAIN JACQUARD T-SHIRT', 'Relaxed fit T-shirt made of textured fabric, lightweight and elastic in every direction.\r\n\r\n- Round neck and short sleeves.\r\n- Printed logo detail on the hem.', '2024-08-21 17:46:09'),
(13, 'test', 'M', 'T-Shirts', 'test2', 'teasastafsaxfs', '2024-08-28 16:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
CREATE TABLE IF NOT EXISTS `product_colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color`) VALUES
(2, 2, '#ffffe5'),
(3, 3, '#ffffff'),
(4, 4, '#fdfcfc'),
(6, 6, '#545454'),
(7, 6, '#313344'),
(12, 1, '#fdfdf2'),
(16, 7, '#e7dfdf'),
(17, 5, '#dfdddd'),
(18, 8, '#f2f2f2'),
(19, 11, '#ebab6f'),
(20, 11, '#050505'),
(22, 13, '#b4a2a2'),
(23, 13, '#703e3e');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_ibfk_1` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`) VALUES
(1, 1, '../o-Dinor_back/uploads/66afbf637d366.jpg'),
(2, 1, '../o-Dinor_back/uploads/06917036251-a4.jpg'),
(3, 1, '../o-Dinor_back/uploads/06917036251-a3.jpg'),
(4, 1, '../o-Dinor_back/uploads/06917036251-a2.jpg'),
(5, 1, '../o-Dinor_back/uploads/06917036251-a1.jpg'),
(6, 1, '../o-Dinor_back/uploads/06917036251-p.jpg'),
(7, 2, '../o-Dinor_back/uploads/66afca24c1106.jpg'),
(8, 2, '../o-Dinor_back/uploads/01887460251-a3.jpg'),
(9, 2, '../o-Dinor_back/uploads/01887460251-a1.jpg'),
(10, 2, '../o-Dinor_back/uploads/01887460251-a2.jpg'),
(11, 2, '../o-Dinor_back/uploads/01887460251-e3.jpg'),
(12, 2, '../o-Dinor_back/uploads/01887460251-e2.jpg'),
(13, 3, '../o-Dinor_back/uploads/66afcadca8776.jpg'),
(14, 3, '../o-Dinor_back/uploads/01887450250-e3.jpg'),
(15, 3, '../o-Dinor_back/uploads/01887450250-e2.jpg'),
(16, 4, '../o-Dinor_back/uploads/66afcb86340b2.jpg'),
(20, 4, '../o-Dinor_back/uploads/03992324251-e3.jpg'),
(21, 4, '../o-Dinor_back/uploads/03992324251-e2.jpg'),
(22, 5, '../o-Dinor_back/uploads/66afcc3a9b2b3.jpg'),
(32, 5, '../o-Dinor_back/uploads/06050810808-e2.jpg'),
(33, 6, '../o-Dinor_back/uploads/66b39c61d68ca.jpg'),
(37, 6, '../o-Dinor_back/uploads/05755328803-e3.jpg'),
(38, 6, '../o-Dinor_back/uploads/05755328803-e2.jpg'),
(39, 7, '../o-Dinor_back/uploads/66bd934b065c8.jpg'),
(40, 7, '../o-Dinor_back/uploads/05070435802-a5.jpg'),
(41, 7, '../o-Dinor_back/uploads/05070435802-a1.jpg'),
(42, 7, '../o-Dinor_back/uploads/05070435802-000-e3.jpg'),
(43, 7, '../o-Dinor_back/uploads/05070435802-000-e2.jpg'),
(58, 8, '../o-Dinor_back/uploads/1.jpg'),
(69, 8, '../o-Dinor_back/uploads/2.jpg'),
(70, 8, '../o-Dinor_back/uploads/3.jpg'),
(72, 8, '../o-Dinor_back/uploads/4.jpg'),
(73, 8, '../o-Dinor_back/uploads/5.jpg'),
(74, 8, '../o-Dinor_back/uploads/6.jpg'),
(75, 4, '../o-Dinor_back/uploads/03992324251-a3.jpg'),
(76, 4, '../o-Dinor_back/uploads/03992324251-a2.jpg'),
(77, 4, '../o-Dinor_back/uploads/03992324251-a1.jpg'),
(78, 6, '../o-Dinor_back/uploads/05755328803-a1.jpg'),
(79, 6, '../o-Dinor_back/uploads/05755328803-a2.jpg'),
(80, 6, '../o-Dinor_back/uploads/05755328803-a4.jpg'),
(81, 11, '../o-Dinor_back/uploads/66c627e151034.jpg'),
(82, 11, '../o-Dinor_back/uploads/04387303639-e2.jpg'),
(83, 11, '../o-Dinor_back/uploads/04387303639-e3.jpg'),
(84, 11, '../o-Dinor_back/uploads/04387303639-a2.jpg'),
(85, 11, '../o-Dinor_back/uploads/04387303639-a3.jpg'),
(86, 11, '../o-Dinor_back/uploads/04387303639-p.jpg'),
(88, 13, '../o-Dinor_back/uploads/66cf523d1043a.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `size` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cost` int NOT NULL,
  `rate` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`, `cost`, `rate`) VALUES
(5, 2, 'S', 3000, 4000),
(6, 2, 'M', 3000, 4000),
(7, 2, 'L', 3000, 4000),
(8, 2, 'XL', 3000, 4000),
(9, 3, 'S', 3000, 4000),
(10, 3, 'M', 3000, 4000),
(11, 3, 'L', 3000, 4000),
(12, 3, 'XL', 3000, 4000),
(13, 4, 'S', 3000, 4000),
(14, 4, 'M', 3000, 4000),
(15, 4, 'L', 3000, 4000),
(16, 4, 'XL', 3000, 4000),
(21, 6, 'S', 3000, 4000),
(22, 6, 'M', 3000, 4000),
(23, 6, 'L', 3000, 4000),
(24, 6, 'XL', 3000, 4000),
(25, 6, 'XXL', 3000, 4000),
(42, 1, 'S', 3000, 4000),
(43, 1, 'M', 3000, 4000),
(44, 1, 'L', 3000, 4000),
(45, 1, 'XL', 3000, 4000),
(58, 7, 'S', 3000, 4000),
(59, 7, 'M', 3000, 4000),
(60, 7, 'L', 3000, 4000),
(61, 7, 'XL', 3000, 4000),
(62, 5, 'S', 3000, 4000),
(63, 5, 'M', 3000, 4000),
(64, 5, 'L', 3000, 4000),
(65, 5, 'XL', 3000, 4000),
(66, 8, 'S', 3000, 4000),
(67, 8, 'M', 3000, 4000),
(68, 8, 'L', 3000, 4000),
(69, 8, 'XL', 3000, 4000),
(70, 8, 'XXL', 3000, 4000),
(71, 8, 'XXXL', 3000, 4000),
(72, 11, 'S', 5000, 6000),
(73, 11, 'M', 5500, 6500),
(77, 13, 'S', 1000, 2000),
(78, 13, 'M', 1233, 2222),
(79, 13, 'L', 1452, 3500),
(80, 13, 'XL', 3214, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `sold_products`
--

DROP TABLE IF EXISTS `sold_products`;
CREATE TABLE IF NOT EXISTS `sold_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity_sold` int NOT NULL,
  `sold_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `size` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `admin_ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`admin_ID`, `username`, `password`) VALUES
(1, 'admin', '123'),
(2, 'Akash', '123'),
(3, 'test', '123'),
(5, 'new', '123'),
(6, 'test', '1234'),
(7, 'dasd', 'qwe');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `fk_product_colors` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_color_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `fk_product_sizes` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
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
