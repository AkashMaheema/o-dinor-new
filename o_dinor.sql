-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 04, 2024 at 11:03 AM
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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apartment` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postcode` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `country`, `street_address`, `apartment`, `city`, `postcode`, `phone`, `email`, `created_at`) VALUES
(1, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', '', 'Wadduwa', '12560', '0715703676', 'akashmaheema@gmail.com', '2024-09-03 19:06:38'),
(2, 'test', 'test', 'SriLanka', 'teasdasd', 'asdasd', 'asdasd', '12560', '0715703676', 'evilvisli@gamil.com', '2024-09-03 20:09:43'),
(3, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', '', 'Wadduwa', '12560', '0715703676', 'evilvisli@gamil.com', '2024-09-03 20:12:02'),
(4, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', 'adsasda', 'Wadduwa', '12560', '0715703676', 'akashmaheemaplus@gmail.com', '2024-09-03 20:25:57'),
(5, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', 'asdasd', 'Wadduwa', '12560', '0715703676', 'akashmahima88@gmail.com', '2024-09-03 20:30:07'),
(6, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', 'adasd', 'Wadduwa', '12560', '0715703676', 'akashmaheema@gmail.com8', '2024-09-03 21:16:38'),
(7, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', 'adas', 'Wadduwa', '12560', '0715703676', 'akashmahima88@gmail.com', '2024-09-03 21:21:37'),
(8, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', 'asdas', 'Wadduwa', '12560', '0715703676', 'thushanharshaka444@gmail.com', '2024-09-03 21:28:14'),
(9, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', '', 'Wadduwa', '12560', '0715703676', 'akashmaheema@gmail.com', '2024-09-03 21:41:19'),
(10, 'Akash', 'Maheema', 'SriLanka', '25/A M D L Land Malagama', '', 'Wadduwa', '12560', '0715703676', 'akashmaheema@gmail.com', '2024-09-04 04:53:03'),
(11, 'Upul', 'Chandrasiri', 'SriLanka', '199/, downver estate, meeptiya, nawalapitiya', '', 'Nawalapitiya', '20650', '0761568780', 'upulchandrasiri1@gmail.com', '2024-09-04 05:20:16'),
(12, 'Upul', 'Chandrasiri', 'SriLanka', '199/, downver estate, meeptiya, nawalapitiya', '', 'Nawalapitiya', '20650', '0760311609', 'upulchandrasiri1@gmail.com', '2024-09-04 09:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `checkout_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `subtotal`, `delivery`, `discount`, `total`, `payment_method`, `status`, `created_at`) VALUES
(3, 5, '3000.00', '2000.00', '0.00', '5000.00', 'cod', 'Confirmed', '2024-09-04 02:00:07'),
(4, 7, '3500.00', '2000.00', '350.00', '5150.00', 'cod', 'Confirmed', '2024-09-04 02:51:37'),
(5, 8, '11000.00', '2000.00', '1100.00', '11900.00', 'cod', 'Confirmed', '2024-09-04 02:58:14'),
(6, 9, '12000.00', '2000.00', '2400.00', '11600.00', 'paypal', 'Confirmed', '2024-09-04 03:11:19'),
(8, 11, '8000.00', '2000.00', '0.00', '10000.00', 'cod', 'Confirmed', '2024-09-04 10:50:16'),
(9, 12, '6000.00', '2000.00', '0.00', '8000.00', 'cod', 'pending', '2024-09-04 14:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_has_items`
--

DROP TABLE IF EXISTS `order_has_items`;
CREATE TABLE IF NOT EXISTS `order_has_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `size` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_has_items`
--

INSERT INTO `order_has_items` (`id`, `order_id`, `product_id`, `quantity`, `color`, `size`, `created_at`) VALUES
(1, 3, 15, 1, '#46b9b1', 'S', '2024-09-03 20:30:07'),
(2, 4, 16, 1, '#c2a68e', 'S', '2024-09-03 21:21:37'),
(3, 5, 2, 1, '#ffffe5', 'S', '2024-09-03 21:28:14'),
(4, 5, 2, 1, '#ffffe5', 'M', '2024-09-03 21:28:14'),
(5, 5, 4, 1, '#fdfcfc', 'S', '2024-09-03 21:28:14'),
(6, 6, 2, 3, '#ffffe5', 'S', '2024-09-03 21:41:19'),
(8, 8, 16, 1, '#c2a68e', 'S', '2024-09-04 05:20:16'),
(9, 8, 40, 1, '#68a249', 'S', '2024-09-04 05:20:16'),
(10, 9, 54, 1, '#66800a', 'S', '2024-09-04 09:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `gender`, `category`, `title`, `description`, `created_at`) VALUES
(1, 'TEXTURED BERMUDA SHORTS', 'M', 'Shorts', 'EMBROIDERED TEXTURED BERMUDA SHORTS', 'Cotton Bermuda shorts. Elasticated waistband with adjustable drawstrings. Side pockets at the hip and back patch pocket detail. Contrast embroidery on the leg.', '2024-08-04 12:20:27'),
(2, 'TEXTURED POLO SHIRT', 'M', 'Polos', 'TEXTURED POLO SHIRT WITH RIBBED TRIMS', 'Regular fit collared polo shirt with front opening. Short sleeves.', '2024-08-04 13:06:20'),
(3, 'BASIC HEAVY WEIGHT T-SHIRT', 'M', 'T-Shirts', 'BASIC HEAVY WEIGHT T-SHIRT', 'Oversize T-shirt made of compact cotton. Round neck and short sleeves.', '2024-08-04 13:09:24'),
(4, 'T-SHIRT WITH CONTRAST PRINT', 'M', 'T-Shirts', 'T-SHIRT WITH CONTRAST PRINT', 'Relaxed fit T-shirt. Round neck and short sleeve. Contrast print on the front.', '2024-08-04 13:12:14'),
(5, 'METALLIC THREAD CROPPED T-SHIRT', 'F', 'T-Shirts', 'METALLIC THREAD CROPPED T-SHIRT WITH SLOGAN', 'LOOSE FIT - ROUND NECK - SHORT - SHORT SLEEVES\r\nCropped T-shirt with metallic thread. Featuring a round neck, short sleeves and', '2024-08-04 13:15:14'),
(7, 'Blazer', 'M', 'Blazers', 'Slim fit blazer ', 'Slim fit blazer made of a viscose blend fabric. Notched lapel collar. Long sleeves with buttoned cuffs. Chest welt pocket and hip flap pocket detail. Interior pocket detail. Back vents at the hem. Buttoned front.', '2024-08-15 00:04:03'),
(8, 'CONTRAST PRINTED T-SHIRT', 'M', 'T-Shirts', 'CONTRAST PRINTED T-SHIRT', 'Relaxed fit T-shirt featuring a round neck and short sleeves. Contrast slogan and graphic prints on the front and back.', '2024-08-16 08:27:49'),
(11, 'MOUNTAIN JACQUARD T-SHIRT', 'M', 'T-Shirts', 'MOUNTAIN JACQUARD T-SHIRT', 'Relaxed fit T-shirt made of textured fabric, lightweight and elastic in every direction.\r\n\r\n- Round neck and short sleeves.\r\n- Printed logo detail on the hem.', '2024-08-21 17:46:09'),
(14, 'OVERSIZE FADED SWEATSHIRT', 'M', 'T-Shirts', 'OVERSIZE FADED SWEATSHIRT', 'Oversize faded sweatshirt with a round neck, short sleeves and uneven trims.\r\n\r\nThe garment is unique thanks to its special washing process. For this reason, it may', '2024-08-31 14:11:14'),
(15, 'TEXTURED RELAXED FIT SHIRT', 'M', 'Shirts', 'TEXTURED RELAXED FIT SHIRT', 'Relaxed fit shirt made of cotton fabric. Featuring a lapel     collar, long sleeve with buttoned cuffs, a chest patch pocket and a button-up front.', '2024-08-31 15:04:32'),
(16, 'STRIPED OVERSIZE SHIRT', 'M', 'Shirts', 'STRIPED OVERSIZE SHIRT', 'Oversize fit shirt. Lapel collar and short sleeve with embroidered eyelet detail. Patch pocket on the chest. Button-up front.', '2024-08-31 15:11:37'),
(19, 'TEXTURED CHECK SHIRT', 'M', 'Shirts', 'Relaxed TEXTURED CHECK SHIRT', 'Relaxed fit collared shirt featuring long sleeves with buttoned cuffs. Split hem and a button-up front.', '2024-09-03 13:33:08'),
(20, 'JACQUARD DENIM JACKET', 'M', 'Jackets', 'JACQUARD DENIM JACKET', 'Boxy fit jacket in cotton denim. Adjustable hooded collar. Long sleeves with adjustable cuffs with a hook-and-loop fastening. Flap pockets on the chest. Adjustable elasticated hem. Faded effect. Concealed zip fastening\r\n', '2024-09-03 13:49:18'),
(21, 'DENIM JACKET WITH POCKETS', 'M', 'Jackets', 'DENIM JACKET WITH POCKETS', 'Boxy fit collared jacket made of cotton denim. Featuring long sleeves with elasticated cuffs, front pouch pockets, faded effect with a coloured finish and zip-up front.', '2024-09-03 13:56:03'),
(22, 'UTILITY JACKET WITH POCKETS', 'M', 'Jackets', 'UTILITY JACKET WITH POCKETS', 'Cropped fit jacket in cotton fabric. Featuring a lapel collar, long sleeves with elasticated cuffs, multi-purpose pockets on the chest and hip, and a zip-up front.\r\n', '2024-09-03 13:58:31'),
(23, 'WASHED HOODED JACKET', 'M', 'Jackets', 'WASHED HOODED JACKET fit jacket', 'Relaxed fit jacket in canvas cotton fabric. Adjustable hood. Long sleeves. Elasticated trims. Garment-dyed effect. Zip-up front.', '2024-09-03 14:00:58'),
(24, 'TECHNICAL CARGO BERMUDA SHORTS', 'M', 'Shorts', 'TECHNICAL CARGO BERMUDA SHORTS', 'Regular fit Bermuda shorts made of stretchy technical fabric. Featuring an adjustable elasticated waistband with a matching belt. Featuring front pockets, back welt pockets, multi-purpose zip pockets on the legs and\r\n', '2024-09-03 15:36:48'),
(25, 'BERMUDA SHORTS WITH CONTRAST TOPSTITCHING', 'M', 'Shorts', 'BERMUDA SHORTS WITH CONTRAST TOPSTITCHING', 'Relaxed fit denim Bermuda shorts. Featuring front pockets, patch pockets on the rear, multi-functional strips and patch pockets on the legs and contrasting stitching detail throughout the garment. Zip fly and top\r\n', '2024-09-03 15:45:18'),
(26, 'TEXTURED CARGO JORTS', 'M', 'Shorts', 'TEXTURED CARGO JORTS', 'Baggy fit jorts made of textured cotton denim. Featuring front pockets, a back welt pocket, patch pockets with flaps on the legs, a slightly faded effect and front zip and button fastening.\r\n', '2024-09-03 15:57:21'),
(27, 'BAGGY-FIT BERMUDA JORTS', 'M', 'Shorts', 'BAGGY-FIT BERMUDA JORTS', 'Baggy fit Bermuda shorts. Five pockets. Faded effect. Front zip fly and button fastening.', '2024-09-03 15:59:38'),
(28, '2-PACK OF BEADED NECKLACES', 'M', 'Accessories', 'BEADED NECKLACES', 'Chain comprising metal links with a 925 MM silver-plated finish. Contrast pendants.\r\nLobster clasp fastening.', '2024-09-04 04:11:51'),
(29, 'SUNGLASSES', 'M', 'Accessories', 'SUNGLASSES', 'Round sunglasses with transparent acetate frame. Polarised lenses. Case included.', '2024-09-04 04:16:20'),
(30, 'CAP WITH CONTRAST EMBROIDERY', 'M', 'Accessories', 'CAP WITH CONTRAST EMBROIDERY', 'Peak cap with contrast embroidery on the front. Faded effect. Adjustable at the back.', '2024-09-04 04:18:57'),
(31, 'STRIPED CROCHET HAT', 'M', 'Accessories', 'STRIPED CROCHET HAT', 'Hat made of spun cotton fabric. Short brim', '2024-09-04 04:20:45'),
(32, 'COMFORT SUIT BLAZER', 'M', 'Blazers', 'COMFORT SUIT BLAZER', 'Slim fit blazer made of a viscose blend fabric. Notched lapel collar. Long sleeves with buttoned cuffs. Chest welt pocket and hip flap pocket detail. Interior pocket detail. Back vents at the hem. Buttoned front.', '2024-09-04 04:22:47'),
(33, 'COMFORT SUIT BLAZER', 'M', 'Blazers', 'COMFORT SUIT BLAZER', 'Slim fit blazer made of a viscose blend fabric. Notched lapel collar. Long sleeves with buttoned cuffs. Chest welt pocket and hip flap pocket detail. Interior pocket detail. Back vents at the hem. Buttoned front.', '2024-09-04 04:25:38'),
(34, 'PACK OF 2 COWBOY STONE AND RESIN BRACELETS', 'F', 'Accessories', 'PACK OF 2 COWBOY STONE AND RESIN BRACELETS', 'Metal bracelet with rectangular pieces and contrasting ball appliqués. Lobster clasp fastening.\r\nChain-style bracelet with links and metal balls. Detail of a coloured resin stone appliqué. Lobster clasp fastening.', '2024-09-04 04:31:14'),
(35, 'PACK OF 2 COWBOY STONE NECKLACES', 'F', 'Accessories', 'PACK OF 2 COWBOY STONE NECKLACES', 'Necklace with irregular circular metal links. Lobster clasp fastening.\r\nNecklace with rectangular metal pieces. Coloured garza textured stone pendant. Lobster clasp fastening.', '2024-09-04 04:34:01'),
(36, 'COWBOY RAFFIA HAT', 'F', 'Accessories', 'COWBOY RAFFIA HAT', 'Woven 100% raffia hat with a wide brim and adjustable chin strap.', '2024-09-04 04:36:35'),
(37, 'RING DETAIL SHOULDER BAG', 'F', 'Bags', 'RING DETAIL SHOULDER BAG', 'Patent-effect shoulder bag. Ring detail on the sides. Inside zip pocket. Shoulder strap. Zip closure.', '2024-09-04 04:39:50'),
(38, 'LEATHER MAXI BUCKET BAG', 'F', 'Bags', 'LEATHER MAXI BUCKET BAG', 'Maxi bucket bag made of leather. Adjustable shoulder strap. Magnetic clasp closure.', '2024-09-04 04:42:41'),
(39, 'BUCKET BAG', 'F', 'Bags', 'BUCKET BAG', 'Bucket bag. Features metal detailing on the side. Adjustable shoulder strap. Magnetic clasp closure.', '2024-09-04 04:49:23'),
(40, 'HALTER NECK DRESS WITH FLORAL RUFFLES', 'F', 'Dress', 'HALTER NECK DRESS WITH FLORAL RUFFLES', 'Midi dress with a draped halter neck and raised floral appliqué detail. Open back. Featuring matching fabric ruffles. Matching lining with side vents. Ruffled hem with vents. Side fastening with invisible zip and buttons at the neck.', '2024-09-04 05:17:15'),
(41, 'GODET MINI DRESS ZW COLLECTION', 'F', 'Dress', 'GODET MINI DRESS ZW COLLECTION', 'Short dress with a round neck and sleeveless design. Featuring tonal topstitching and a godet hem. Concealed zip fastening in the seam at the back', '2024-09-04 05:27:49'),
(42, 'SHORT PLAYSUIT DRESS WITH RUFFLES', 'F', 'Dress', 'SHORT PLAYSUIT DRESS WITH RUFFLES', 'High neck, short sleeve dress. Featuring an asymmetric ruffle trim on the hem, shorts lining and a concealed zip fastening at the back.', '2024-09-04 05:35:11'),
(43, 'LEATHER EFFECT CROPPED BIKER JACKET', 'F', 'Jackets', 'LEATHER EFFECT CROPPED BIKER JACKET', 'Collared jacket featuring long sleeves with tabs on the shoulders. Featuring front pockets with metal zips, a belt in the same material with a metal buckle and zip fastening at the front.', '2024-09-04 05:41:16'),
(44, 'LEATHER EFFECT CROPPED BIKER JACKET', 'F', 'Jackets', 'LEATHER EFFECT CROPPED BIKER JACKET', 'Long sleeve jacket with a lapel collar and shoulder tabs. Featuring front pockets with metal zips, a belt in the same material with a metal buckle and a zip-up front.', '2024-09-04 05:45:51'),
(45, 'SOFT JACKET WITH POCKETS', 'F', 'Jackets', 'SOFT JACKET WITH POCKETS', 'Long sleeve jacket with a round neck. Front patch pockets. Snap-button fastening at the front.', '2024-09-04 05:49:40'),
(46, 'TRF SLIM CROPPED BELL BOTTOM MID-WAIST JEANS', 'F', 'Jeans', 'TRF SLIM CROPPED BELL BOTTOM MID-WAIST JEANS', 'Mid-waist jeans with belt loops and five pockets. Cropped bell bottom hems. Zip fly and metal top button fastening.', '2024-09-04 05:56:40'),
(47, 'Z1975 WIDE LEG HIGH-RISE JEANS', 'F', 'Jeans', 'Z1975 WIDE LEG HIGH-RISE JEANS', 'Faded high-waist jeans with a five-pocket design. Wide leg. Zip fly and button fastening.', '2024-09-04 06:03:19'),
(48, 'Z1975 STRAIGHT-FIT HIGH-WAIST LONG LENGTH JEANS', 'F', 'Jeans', 'Z1975 STRAIGHT-FIT HIGH-WAIST LONG LENGTH JEANS', 'Faded high-waist jeans with a five-pocket design. Straight-leg and long-leg design. Front zip fly and top button fastening.', '2024-09-04 06:11:13'),
(51, 'DENIM BERMUDA SHORTS', 'F', 'Shorts', 'ZW COLLECTION MID-RISE DENIM BERMUDA SHORTS WITH RHINESTONES', 'Mid-rise denim Bermuda shorts with belt loops. Featuring five pockets, rhinestone appliqués and front zip and button fastening', '2024-09-04 06:26:26'),
(52, 'ASYMMETRIC SKORT', 'F', 'Skirts', 'ASYMMETRIC SKORT', 'Mid-rise skort featuring false welt pockets at the back and invisible side zip fastening.', '2024-09-04 06:38:06'),
(53, 'EMBROIDERED PAREO SKIRT WITH FRINGING', 'F', 'Skirts', 'EMBROIDERED PAREO SKIRT WITH FRINGING', 'Mid-rise pareo skirt featuring matching embroidery and a fringed hem. Inside button fastening and tied on the side', '2024-09-04 06:41:41'),
(54, 'SKORT WITH KNOT DETAIL', 'F', 'Skirts', 'SKORT WITH KNOT DETAIL', 'High-waist skort with front knot. Front slit at the hem. Invisible side zip fastening.', '2024-09-04 06:47:55'),
(55, 'HIGH-WAIST TROUSERS', 'F', 'Trousers', 'HIGH-WAIST TROUSERS', 'High-waist trousers with seam detail on the front and back. Front welt pockets. Front zip fly, inside button and metal hook fastening.', '2024-09-04 06:57:03'),
(56, ' WOOL TEXTURED TROUSERS', 'F', 'Trousers', 'ZW COLLECTION 100% WOOL TEXTURED TROUSERS', 'Trousers made of 100% wool yarn. Mid-waist fit with belt loops. Featuring front pockets and pressed creases. Zip fly and top button and metal hook fastening.', '2024-09-04 06:59:27'),
(57, 'STRAIGHT-LEG PLUSH TROUSERS', 'F', 'Trousers', 'STRAIGHT-LEG PLUSH TROUSERS', 'Mid-waist trousers in a cotton yarn. Elasticated drawstring waistband. Side seam pockets. Straight leg.', '2024-09-04 07:02:37'),
(58, 'BASIC SATIN SHIRT', 'F', 'Shirts', 'BASIC SATIN SHIRT', 'Shirt with a johnny collar, long sleeves and a button-up front.', '2024-09-04 07:08:34'),
(59, 'RUFFLED BLOUSE WITH CONTRAST PIPING', 'F', 'Shirts', 'RUFFLED BLOUSE WITH CONTRAST PIPING', 'Long sleeve blouse with a ruffled V-neckline. Contrast piping details. Button-up fastening at the front.', '2024-09-04 07:11:12'),
(60, 'FLOWING CROPPED SHIRT', 'F', 'Shirts', 'FLOWING CROPPED SHIRT', 'Flowing cropped shirt with a lapel collar and a v-neck. Featuring drop-shoulder elbow length sleeves and a button-up front.', '2024-09-04 07:20:31'),
(61, 'STRIPED T-SHIRT WITH EMBROIDERED SLOGAN', 'F', 'T-Shirts', 'STRIPED T-SHIRT WITH EMBROIDERED SLOGAN', 'T-shirt made of blended cotton yarn. Round neck and short sleeves. Contrasting embroidered text detail on the front.', '2024-09-04 07:25:40'),
(62, 'COTTON T-SHIRT WITH ENZYME FINISH', 'F', 'T-Shirts', 'COTTON T-SHIRT WITH ENZYME FINISH', 'T-shirt made of spun cotton with enzyme finish. V-neck and short sleeves.', '2024-09-04 07:28:42'),
(63, 'FADED-EFFECT T-SHIRT WITH A V-NECKLINE', 'F', 'T-Shirts', 'FADED-EFFECT T-SHIRT WITH A V-NECKLINE', 'Faded-effect T-shirt made of a cotton blend. Featuring a ribbed V-neckline and very short sleeves.\r\nDue to the dyeing and fading process, the colour on each garment is unique and special, therefore it may differ from what is shown in the photo.', '2024-09-04 07:32:28'),
(64, 'MESH TRAINERS', 'M', 'Shoes', 'MESH TRAINERS', '         Trainers. Upper made of a combination of panels and breathable fabric. Seven-eyelet lacing system. Flat sole with a textured finish', '2024-09-04 07:43:38'),
(65, 'CASUAL LEATHER SNEAKERS', 'M', 'Shoes', 'CASUAL LEATHER SNEAKERS', '        Sneakers. Upper made of leather with a split leather finish. Moc toe detail. Four-eyelet facing. Matching sole.', '2024-09-04 07:50:48'),
(66, 'CASUAL LEATHER SNEAKERS', 'M', 'Shoes', 'CASUAL LEATHER SNEAKERS', '        Sneakers. Leather upper with a split leather finish. Five-eyelet facing. Contrast sole.\r\n', '2024-09-04 07:53:24'),
(67, ' RETRO LEATHER TRAINERS', 'M', 'Shoes', ' RETRO LEATHER TRAINERS', '            Retro-style leather trainers. Smooth leather upper with split suede detail on the toe. Seven-eyelet lacing. Contrast sole.\r\n         ', '2024-09-04 07:55:37'),
(68, 'SKINNY FIT JEANS', 'M', 'Jeans', 'SKINNY FIT JEANS', 'Skinny fit jeans with five pockets. Faded effect. Zip fly and top button fastening.', '2024-09-04 08:00:15'),
(69, 'SKINNY FIT JEANS', 'M', 'Jeans', 'SKINNY FIT JEANS', 'Skinny fit jeans with five pockets. Faded effect. Zip fly and top button fastening.', '2024-09-04 08:02:48'),
(70, ' RIPPED SKINNY FIT JEANS', 'M', 'Jeans', ' RIPPED SKINNY FIT JEANS', 'Skinny fit jeans. Five pockets. Faded and ripped effect all over the garment. Front zip fly and button fastening.', '2024-09-04 08:07:20'),
(71, 'CROPPED SKINNY JEANS', 'M', 'Jeans', 'CROPPED SKINNY JEANS', 'Skinny fit jeans. Five pockets. Faded effect. Cropped length. Front zip fly and button fastening.', '2024-09-04 08:10:54'),
(72, 'SLIM CROPPED-FIT JEANS', 'M', 'Jeans', 'SLIM CROPPED-FIT JEANS', 'Slim cropped-fit jeans. Five pockets. Faded effect. Front zip fly and button fastening', '2024-09-04 08:14:57'),
(73, 'TEXTURED POLO SHIRT ', 'M', 'Polos', 'TEXTURED POLO SHIRT ', 'Relaxed fit polo shirt made of textured fabric. Polo collar with front button fastening. Short sleeves.', '2024-09-04 08:24:52'),
(74, 'TEXTURED KNIT POLO SHIRT', 'M', 'Polos', 'TEXTURED KNIT POLO SHIRT', 'Collared polo shirt made of spun cotton fabric. Front button fastening, short sleeves and ribbed trims.', '2024-09-04 08:30:11'),
(75, 'TEXTURED POLO SHIRT', 'M', 'Polos', 'TEXTURED POLO SHIRT', 'Short sleeve polo shirt with a buttoned placket on the front.', '2024-09-04 08:35:10'),
(76, 'TEXTURED POLO SHIRT ', 'M', 'Polos', 'TEXTURED POLO SHIRT ', 'Relaxed fit polo shirt made of textured fabric. Polo collar with front button fastening. Short sleeves.\r\n', '2024-09-04 08:37:52'),
(77, ' MID-RISE DENIM BERMUDA SHORTS', 'F', 'Shorts', 'ZW COLLECTION MID-RISE DENIM BERMUDA SHORTS WITH RHINESTONES', 'Mid-rise denim Bermuda shorts with belt loops. Featuring five pockets, rhinestone appliqués and front zip and button fastening.', '2024-09-04 08:42:44'),
(78, 'BERMUDA SHORTS WITH RHINESTONES', 'F', 'Shorts', 'ZW COLLECTION MID-RISE DENIM BERMUDA SHORTS WITH RHINESTONES', 'Mid-rise denim Bermuda shorts with belt loops. Featuring five pockets, rhinestone appliqués and front zip and button fastening.', '2024-09-04 08:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
CREATE TABLE IF NOT EXISTS `product_colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `color` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color`) VALUES
(18, 8, '#f2f2f2'),
(38, 11, '#ebab6f'),
(39, 11, '#050505'),
(41, 1, '#fdfdf2'),
(42, 2, '#ffffe5'),
(43, 3, '#ffffff'),
(44, 4, '#fdfcfc'),
(47, 5, '#dfdddd'),
(48, 14, '#595959'),
(50, 15, '#46b9b1'),
(51, 16, '#c2a68e'),
(55, 19, '#c9b297'),
(56, 20, '#0d0d0d'),
(57, 21, '#5b7c8b'),
(58, 22, '#bdb4a3'),
(59, 23, '#808080'),
(60, 24, '#2f4026'),
(61, 25, '#29513b'),
(62, 26, '#0d0d0d'),
(63, 27, '#424242'),
(65, 28, '#eae1c8'),
(66, 29, '#212121'),
(67, 30, '#e2e55d'),
(68, 31, '#cb5757'),
(69, 32, '#191c4d'),
(70, 7, '#e7dfdf'),
(71, 33, '#3e573d'),
(73, 34, '#1b3b2d'),
(74, 35, '#dedede'),
(75, 36, '#e4dbb9'),
(76, 37, '#31170c'),
(77, 38, '#050505'),
(78, 39, '#050505'),
(79, 40, '#68a249'),
(80, 41, '#d92020'),
(81, 42, '#f8bf5d'),
(82, 43, '#0a0a0a'),
(83, 44, '#f7cfcf'),
(84, 45, '#f9a4a4'),
(85, 46, '#263ef2'),
(86, 47, '#050439'),
(87, 48, '#272626'),
(91, 52, '#151414'),
(92, 53, '#1b1818'),
(93, 54, '#66800a'),
(94, 55, '#9e9a9a'),
(96, 57, '#181616'),
(97, 58, '#f0eaea'),
(98, 59, '#efebeb'),
(99, 60, '#3a6209'),
(100, 61, '#c9c5c5'),
(101, 62, '#febebe'),
(102, 63, '#f2e9e9'),
(103, 64, '#ffc7c7'),
(104, 65, '#efebeb'),
(105, 66, '#586303'),
(106, 67, '#f3eded'),
(107, 68, '#928787'),
(108, 69, '#8173ed'),
(109, 70, '#181616'),
(110, 71, '#484242'),
(111, 72, '#f0c2c2'),
(112, 73, '#272525'),
(113, 74, '#c2750a'),
(114, 75, '#153102'),
(116, 76, '#7c91d0'),
(120, 51, '#071950'),
(123, 78, '#1a1919'),
(125, 77, '#231f1f'),
(126, 56, '#564d4d');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_ibfk_1` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(75, 4, '../o-Dinor_back/uploads/03992324251-a3.jpg'),
(76, 4, '../o-Dinor_back/uploads/03992324251-a2.jpg'),
(81, 11, '../o-Dinor_back/uploads/66c627e151034.jpg'),
(82, 11, '../o-Dinor_back/uploads/04387303639-e2.jpg'),
(83, 11, '../o-Dinor_back/uploads/04387303639-e3.jpg'),
(84, 11, '../o-Dinor_back/uploads/04387303639-a2.jpg'),
(86, 11, '../o-Dinor_back/uploads/04387303639-p.jpg'),
(89, 14, '../o-Dinor_back/uploads/66d32482f0642.jpg'),
(90, 14, '../o-Dinor_back/uploads/00962370800-e2.jpg'),
(91, 14, '../o-Dinor_back/uploads/00962370800-e3.jpg'),
(92, 14, '../o-Dinor_back/uploads/00962370800-a1.jpg'),
(93, 14, '../o-Dinor_back/uploads/00962370800-a3.jpg'),
(94, 15, '../o-Dinor_back/uploads/66d33100cfe79.jpg'),
(95, 15, '../o-Dinor_back/uploads/05884528403-e2.jpg'),
(96, 15, '../o-Dinor_back/uploads/05884528403-e3.jpg'),
(97, 15, '../o-Dinor_back/uploads/05884528403-a3.jpg'),
(98, 15, '../o-Dinor_back/uploads/05884528403-p.jpg'),
(99, 16, '../o-Dinor_back/uploads/66d332a97dcaf.jpg'),
(101, 19, '../o-Dinor_back/uploads/66d7101468556.jpg'),
(102, 19, '../o-Dinor_back/uploads/05920480710-e2.jpg'),
(103, 19, '../o-Dinor_back/uploads/05920480710-e3.jpg'),
(104, 19, '../o-Dinor_back/uploads/05920480710-a2.jpg'),
(105, 19, '../o-Dinor_back/uploads/05920480710-a3.jpg'),
(106, 20, '../o-Dinor_back/uploads/66d713deed850.jpg'),
(107, 20, '../o-Dinor_back/uploads/01538393800-e2.jpg'),
(108, 20, '../o-Dinor_back/uploads/01538393800-a1.jpg'),
(109, 20, '../o-Dinor_back/uploads/01538393800-a2.jpg'),
(110, 20, '../o-Dinor_back/uploads/01538393800-p.jpg'),
(111, 21, '../o-Dinor_back/uploads/66d7157381727.jpg'),
(112, 21, '../o-Dinor_back/uploads/04365408400-e2.jpg'),
(113, 21, '../o-Dinor_back/uploads/04365408400-a1.jpg'),
(114, 21, '../o-Dinor_back/uploads/04365408400-a4.jpg'),
(115, 21, '../o-Dinor_back/uploads/04365408400-p.jpg'),
(116, 22, '../o-Dinor_back/uploads/66d716075daaa.jpg'),
(117, 22, '../o-Dinor_back/uploads/03715410802-e2.jpg'),
(118, 22, '../o-Dinor_back/uploads/03715410802-a1.jpg'),
(119, 22, '../o-Dinor_back/uploads/03715410802-a2.jpg'),
(120, 22, '../o-Dinor_back/uploads/03715410802-a3.jpg'),
(121, 23, '../o-Dinor_back/uploads/66d7169a2a7d1.jpg'),
(122, 23, '../o-Dinor_back/uploads/06987353811-e2.jpg'),
(123, 23, '../o-Dinor_back/uploads/06987353811-a1.jpg'),
(124, 23, '../o-Dinor_back/uploads/06987353811-a2.jpg'),
(125, 23, '../o-Dinor_back/uploads/06987353811-a3.jpg'),
(126, 24, '../o-Dinor_back/uploads/66d72d10c460a.jpg'),
(127, 24, '../o-Dinor_back/uploads/08574351505-e2.jpg'),
(128, 24, '../o-Dinor_back/uploads/08574351505-e4.jpg'),
(129, 24, '../o-Dinor_back/uploads/08574351505-a2.jpg'),
(130, 24, '../o-Dinor_back/uploads/08574351505-a3.jpg'),
(131, 25, '../o-Dinor_back/uploads/66d72f0e489ca.jpg'),
(132, 25, '../o-Dinor_back/uploads/05520325500-e2.jpg'),
(133, 25, '../o-Dinor_back/uploads/05520325500-e3.jpg'),
(134, 25, '../o-Dinor_back/uploads/05520325500-a1.jpg'),
(135, 25, '../o-Dinor_back/uploads/05520325500-p.jpg'),
(136, 26, '../o-Dinor_back/uploads/66d731e169401.jpg'),
(137, 26, '../o-Dinor_back/uploads/01455330400-e2.jpg'),
(138, 26, '../o-Dinor_back/uploads/01455330400-a1.jpg'),
(139, 26, '../o-Dinor_back/uploads/01455330400-a3.jpg'),
(140, 26, '../o-Dinor_back/uploads/01455330400-p.jpg'),
(141, 27, '../o-Dinor_back/uploads/66d7326a6c5f7.jpg'),
(142, 27, '../o-Dinor_back/uploads/05585498802-e2.jpg'),
(143, 27, '../o-Dinor_back/uploads/05585498802-e4.jpg'),
(144, 27, '../o-Dinor_back/uploads/05585498802-a1.jpg'),
(145, 27, '../o-Dinor_back/uploads/05585498802-a4.jpg'),
(146, 28, '../o-Dinor_back/uploads/66d7de0751c25.jpg'),
(147, 28, '../o-Dinor_back/uploads/08435309555-e3.jpg'),
(148, 28, '../o-Dinor_back/uploads/08435309555-e5.jpg'),
(149, 28, '../o-Dinor_back/uploads/08435309555-e2.jpg'),
(150, 28, '../o-Dinor_back/uploads/08435309555-p.jpg'),
(151, 29, '../o-Dinor_back/uploads/66d7df14539e8.jpg'),
(152, 29, '../o-Dinor_back/uploads/02750311990-e4.jpg'),
(153, 29, '../o-Dinor_back/uploads/02750311990-e5.jpg'),
(154, 29, '../o-Dinor_back/uploads/02750311990-a1.jpg'),
(155, 29, '../o-Dinor_back/uploads/02750311990-a2.jpg'),
(156, 30, '../o-Dinor_back/uploads/66d7dfb111b21.jpg'),
(157, 30, '../o-Dinor_back/uploads/09065313300-a1.jpg'),
(158, 30, '../o-Dinor_back/uploads/09065313300-a2.jpg'),
(159, 30, '../o-Dinor_back/uploads/09065313300-e3.jpg'),
(160, 30, '../o-Dinor_back/uploads/09065313300-p.jpg'),
(161, 31, '../o-Dinor_back/uploads/66d7e01d46941.jpg'),
(162, 31, '../o-Dinor_back/uploads/03920331615-e2.jpg'),
(163, 31, '../o-Dinor_back/uploads/03920331615-a1.jpg'),
(164, 31, '../o-Dinor_back/uploads/03920331615-a3.jpg'),
(165, 31, '../o-Dinor_back/uploads/03920331615-p.jpg'),
(166, 32, '../o-Dinor_back/uploads/66d7e0973445f.jpg'),
(167, 32, '../o-Dinor_back/uploads/01564300420-e2.jpg'),
(168, 32, '../o-Dinor_back/uploads/01564300420-e3.jpg'),
(169, 32, '../o-Dinor_back/uploads/01564300420-a1.jpg'),
(170, 32, '../o-Dinor_back/uploads/01564300420-a2.jpg'),
(171, 33, '../o-Dinor_back/uploads/66d7e142bf939.jpg'),
(172, 33, '../o-Dinor_back/uploads/01564300500-e2.jpg'),
(173, 33, '../o-Dinor_back/uploads/01564300500-e3.jpg'),
(174, 33, '../o-Dinor_back/uploads/04336232500-a1.jpg'),
(175, 33, '../o-Dinor_back/uploads/04336232500-a2.jpg'),
(176, 34, '../o-Dinor_back/uploads/66d7e29293774.jpg'),
(177, 34, '../o-Dinor_back/uploads/wacc1-2.jpg'),
(178, 34, '../o-Dinor_back/uploads/wacc1-3.jpg'),
(179, 34, '../o-Dinor_back/uploads/wacc1-4.jpg'),
(180, 35, '../o-Dinor_back/uploads/66d7e3398dd2a.jpg'),
(181, 35, '../o-Dinor_back/uploads/wacc2-2.jpg'),
(182, 35, '../o-Dinor_back/uploads/wacc2-3.jpg'),
(183, 36, '../o-Dinor_back/uploads/66d7e3d3ad855.jpg'),
(184, 36, '../o-Dinor_back/uploads/wacc3-2.jpg'),
(185, 36, '../o-Dinor_back/uploads/wacc3-3.jpg'),
(186, 36, '../o-Dinor_back/uploads/wacc3-4.jpg'),
(187, 37, '../o-Dinor_back/uploads/66d7e496424c7.jpg'),
(188, 37, '../o-Dinor_back/uploads/wbg1-2.jpg'),
(189, 37, '../o-Dinor_back/uploads/wbg1-4.jpg'),
(190, 37, '../o-Dinor_back/uploads/wbg1-3.jpg'),
(191, 37, '../o-Dinor_back/uploads/wbg1-5.jpg'),
(192, 38, '../o-Dinor_back/uploads/66d7e5415c8be.jpg'),
(193, 38, '../o-Dinor_back/uploads/wbg2-2.jpg'),
(194, 38, '../o-Dinor_back/uploads/wbg2-4.jpg'),
(195, 38, '../o-Dinor_back/uploads/wbg2-3.jpg'),
(196, 39, '../o-Dinor_back/uploads/66d7e6d319ee5.jpg'),
(197, 39, '../o-Dinor_back/uploads/wbg3-2.jpg'),
(198, 39, '../o-Dinor_back/uploads/wbg3-3.jpg'),
(199, 39, '../o-Dinor_back/uploads/wbg3-4.jpg'),
(200, 40, '../o-Dinor_back/uploads/66d7ed5b5dbb0.jpg'),
(201, 40, '../o-Dinor_back/uploads/wd1-2.jpg'),
(202, 40, '../o-Dinor_back/uploads/wd1-5.jpg'),
(203, 40, '../o-Dinor_back/uploads/wd1-3.jpg'),
(204, 40, '../o-Dinor_back/uploads/wd1-4.jpg'),
(205, 41, '../o-Dinor_back/uploads/66d7efd566acb.jpg'),
(206, 41, '../o-Dinor_back/uploads/Wd2-2.jpg'),
(207, 41, '../o-Dinor_back/uploads/Wd2-5.jpg'),
(208, 41, '../o-Dinor_back/uploads/Wd2-4.jpg'),
(209, 41, '../o-Dinor_back/uploads/Wd2-3.jpg'),
(210, 42, '../o-Dinor_back/uploads/66d7f18faa188.jpg'),
(211, 42, '../o-Dinor_back/uploads/wd3-2.jpg'),
(212, 42, '../o-Dinor_back/uploads/wd3-5.jpg'),
(213, 42, '../o-Dinor_back/uploads/wd3-4.jpg'),
(214, 42, '../o-Dinor_back/uploads/wd3-3.jpg'),
(215, 43, '../o-Dinor_back/uploads/66d7f2fcf1616.jpg'),
(216, 43, '../o-Dinor_back/uploads/wj1-2.jpg'),
(217, 43, '../o-Dinor_back/uploads/wj1-5.jpg'),
(218, 43, '../o-Dinor_back/uploads/wj1-4.jpg'),
(219, 43, '../o-Dinor_back/uploads/wj1-3.jpg'),
(220, 44, '../o-Dinor_back/uploads/66d7f40fc5b7a.jpg'),
(221, 44, '../o-Dinor_back/uploads/wj2-2.jpg'),
(222, 44, '../o-Dinor_back/uploads/wj2-5.jpg'),
(223, 44, '../o-Dinor_back/uploads/wj2-4.jpg'),
(224, 44, '../o-Dinor_back/uploads/wj2-3.jpg'),
(225, 45, '../o-Dinor_back/uploads/66d7f4f47267b.jpg'),
(226, 45, '../o-Dinor_back/uploads/wj3-2.jpg'),
(227, 45, '../o-Dinor_back/uploads/wj3-5.jpg'),
(228, 45, '../o-Dinor_back/uploads/wj3-4.jpg'),
(229, 45, '../o-Dinor_back/uploads/wj3-3.jpg'),
(230, 46, '../o-Dinor_back/uploads/66d7f69869c18.jpg'),
(231, 46, '../o-Dinor_back/uploads/wje1-2.jpg'),
(232, 46, '../o-Dinor_back/uploads/wje1-5.jpg'),
(233, 46, '../o-Dinor_back/uploads/wje1-4.jpg'),
(234, 46, '../o-Dinor_back/uploads/wje1-3.jpg'),
(235, 47, '../o-Dinor_back/uploads/66d7f8279bcd2.jpg'),
(236, 47, '../o-Dinor_back/uploads/wje2-2.jpg'),
(237, 48, '../o-Dinor_back/uploads/66d7fa0160fdb.jpg'),
(238, 48, '../o-Dinor_back/uploads/wje3-2.jpg'),
(239, 48, '../o-Dinor_back/uploads/wje3-5.jpg'),
(240, 48, '../o-Dinor_back/uploads/wje3-4.jpg'),
(241, 48, '../o-Dinor_back/uploads/wje3-3.jpg'),
(248, 51, '../o-Dinor_back/uploads/66d7fd92df4b0.jpg'),
(249, 51, '../o-Dinor_back/uploads/wst2-2.jpg'),
(250, 51, '../o-Dinor_back/uploads/wst2-5.jpg'),
(251, 51, '../o-Dinor_back/uploads/wst2-4.jpg'),
(252, 51, '../o-Dinor_back/uploads/wst2-3.jpg'),
(253, 52, '../o-Dinor_back/uploads/66d8004e8c65a.jpg'),
(254, 52, '../o-Dinor_back/uploads/wsk1-2.jpg'),
(255, 52, '../o-Dinor_back/uploads/wsk1-5.jpg'),
(256, 52, '../o-Dinor_back/uploads/wsk1-4.jpg'),
(257, 52, '../o-Dinor_back/uploads/wsk1-3.jpg'),
(258, 53, '../o-Dinor_back/uploads/66d80125c1a83.jpg'),
(259, 53, '../o-Dinor_back/uploads/wsk2-2.jpg'),
(260, 53, '../o-Dinor_back/uploads/wsk2-5.jpg'),
(261, 53, '../o-Dinor_back/uploads/wsk2-4.jpg'),
(262, 53, '../o-Dinor_back/uploads/wsk2-3.jpg'),
(263, 54, '../o-Dinor_back/uploads/66d8029b7da96.jpg'),
(264, 54, '../o-Dinor_back/uploads/wsk3-2.jpg'),
(265, 54, '../o-Dinor_back/uploads/wsk3-5.jpg'),
(266, 54, '../o-Dinor_back/uploads/wsk3-4.jpg'),
(267, 54, '../o-Dinor_back/uploads/wsk3-3.jpg'),
(268, 55, '../o-Dinor_back/uploads/66d804bf2401a.jpg'),
(269, 55, '../o-Dinor_back/uploads/wtr1-2.jpg'),
(270, 55, '../o-Dinor_back/uploads/wtr1-5.jpg'),
(271, 55, '../o-Dinor_back/uploads/wtr1-4.jpg'),
(272, 55, '../o-Dinor_back/uploads/wtr1-3.jpg'),
(273, 56, '../o-Dinor_back/uploads/66d8054f12ccc.jpg'),
(274, 56, '../o-Dinor_back/uploads/wtr2-2.jpg'),
(275, 56, '../o-Dinor_back/uploads/wtr2-5.jpg'),
(276, 56, '../o-Dinor_back/uploads/wtr2-4.jpg'),
(277, 56, '../o-Dinor_back/uploads/wtr2-3.jpg'),
(278, 57, '../o-Dinor_back/uploads/66d8060dae511.jpg'),
(279, 57, '../o-Dinor_back/uploads/wtr3-2.jpg'),
(280, 57, '../o-Dinor_back/uploads/wtr3-5.jpg'),
(281, 57, '../o-Dinor_back/uploads/wtr3-4.jpg'),
(282, 57, '../o-Dinor_back/uploads/wtr3-3.jpg'),
(283, 58, '../o-Dinor_back/uploads/66d80772a2530.jpg'),
(284, 58, '../o-Dinor_back/uploads/ws1-2.jpg'),
(285, 58, '../o-Dinor_back/uploads/ws1-5.jpg'),
(286, 58, '../o-Dinor_back/uploads/ws1-4.jpg'),
(287, 58, '../o-Dinor_back/uploads/ws1-3.jpg'),
(288, 59, '../o-Dinor_back/uploads/66d80810a5c49.jpg'),
(289, 59, '../o-Dinor_back/uploads/ws2-2.jpg'),
(290, 59, '../o-Dinor_back/uploads/ws2-5.jpg'),
(291, 59, '../o-Dinor_back/uploads/ws2-4.jpg'),
(292, 59, '../o-Dinor_back/uploads/ws2-3.jpg'),
(293, 60, '../o-Dinor_back/uploads/66d80a3f52c4c.jpg'),
(294, 60, '../o-Dinor_back/uploads/ws3-2.jpg'),
(295, 60, '../o-Dinor_back/uploads/ws3-4.jpg'),
(296, 60, '../o-Dinor_back/uploads/ws3-3.jpg'),
(297, 61, '../o-Dinor_back/uploads/66d80b74be310.jpg'),
(298, 61, '../o-Dinor_back/uploads/wt1-2.jpg'),
(299, 61, '../o-Dinor_back/uploads/wt1-4.jpg'),
(300, 61, '../o-Dinor_back/uploads/wt1-3.jpg'),
(301, 62, '../o-Dinor_back/uploads/66d80c2a2386f.jpg'),
(302, 62, '../o-Dinor_back/uploads/wt2-2.jpg'),
(303, 62, '../o-Dinor_back/uploads/wt2-4.jpg'),
(304, 62, '../o-Dinor_back/uploads/wt2-3.jpg'),
(305, 63, '../o-Dinor_back/uploads/66d80d0c13d96.jpg'),
(306, 63, '../o-Dinor_back/uploads/wt3-2.jpg'),
(307, 63, '../o-Dinor_back/uploads/wt3-5.jpg'),
(308, 63, '../o-Dinor_back/uploads/wt3-4.jpg'),
(309, 63, '../o-Dinor_back/uploads/wt3-3.jpg'),
(310, 64, '../o-Dinor_back/uploads/66d80faaa9e82.jpg'),
(311, 64, '../o-Dinor_back/uploads/12420420107-e2.jpg'),
(312, 64, '../o-Dinor_back/uploads/12420420107-a3.jpg'),
(313, 64, '../o-Dinor_back/uploads/12420420107-a4.jpg'),
(314, 64, '../o-Dinor_back/uploads/12420420107-e1.jpg'),
(315, 65, '../o-Dinor_back/uploads/66d811583c189.jpg'),
(316, 65, '../o-Dinor_back/uploads/12225320802-e2.jpg'),
(317, 65, '../o-Dinor_back/uploads/12225320802-a2.jpg'),
(318, 65, '../o-Dinor_back/uploads/12225320802-a3.jpg'),
(319, 65, '../o-Dinor_back/uploads/12225320802-a4.jpg'),
(320, 66, '../o-Dinor_back/uploads/66d811f4f26ba.jpg'),
(321, 66, '../o-Dinor_back/uploads/12419420032-e2.jpg'),
(322, 66, '../o-Dinor_back/uploads/12419420032-a3.jpg'),
(323, 66, '../o-Dinor_back/uploads/12419420032-a1.jpg'),
(324, 66, '../o-Dinor_back/uploads/12419420032-e1.jpg'),
(325, 67, '../o-Dinor_back/uploads/66d81279c388a.jpg'),
(326, 67, '../o-Dinor_back/uploads/12281320202-e2.jpg'),
(327, 67, '../o-Dinor_back/uploads/12281320202-a1.jpg'),
(328, 67, '../o-Dinor_back/uploads/12281320202-a2.jpg'),
(329, 67, '../o-Dinor_back/uploads/12281320202-a4.jpg'),
(330, 68, '../o-Dinor_back/uploads/66d8138fc92cc.jpg'),
(331, 68, '../o-Dinor_back/uploads/07223421802-e2.jpg'),
(332, 68, '../o-Dinor_back/uploads/07223420802-a1.jpg'),
(333, 68, '../o-Dinor_back/uploads/07223420802-a2.jpg'),
(334, 68, '../o-Dinor_back/uploads/07223420802-a4.jpg'),
(335, 69, '../o-Dinor_back/uploads/66d814282eccc.jpg'),
(336, 69, '../o-Dinor_back/uploads/05575420427-e2.jpg'),
(337, 69, '../o-Dinor_back/uploads/05575420427-p.jpg'),
(338, 69, '../o-Dinor_back/uploads/05575420427-a2.jpg'),
(339, 69, '../o-Dinor_back/uploads/05575420427-a3.jpg'),
(340, 70, '../o-Dinor_back/uploads/66d8153807ddb.jpg'),
(341, 70, '../o-Dinor_back/uploads/07223421800-e2.jpg'),
(342, 70, '../o-Dinor_back/uploads/07223421800-a1.jpg'),
(343, 70, '../o-Dinor_back/uploads/07223421800-a3.jpg'),
(344, 70, '../o-Dinor_back/uploads/07223421800-a4.jpg'),
(345, 71, '../o-Dinor_back/uploads/66d8160e789d3.jpg'),
(346, 71, '../o-Dinor_back/uploads/00840345802-e2.jpg'),
(347, 71, '../o-Dinor_back/uploads/00840345802-a1.jpg'),
(348, 71, '../o-Dinor_back/uploads/00840345802-a2.jpg'),
(349, 71, '../o-Dinor_back/uploads/00840345802-a3.jpg'),
(350, 72, '../o-Dinor_back/uploads/66d81701d6761.jpg'),
(351, 72, '../o-Dinor_back/uploads/08062377707-e1.jpg'),
(352, 72, '../o-Dinor_back/uploads/08062377707-a2.jpg'),
(353, 72, '../o-Dinor_back/uploads/08062377707-a3.jpg'),
(354, 72, '../o-Dinor_back/uploads/08062377707-a4.jpg'),
(355, 73, '../o-Dinor_back/uploads/66d81954be2f3.jpg'),
(356, 73, '../o-Dinor_back/uploads/04092306922-e2.jpg'),
(357, 73, '../o-Dinor_back/uploads/04092306922-a1.jpg'),
(358, 73, '../o-Dinor_back/uploads/04092306922-a2.jpg'),
(359, 73, '../o-Dinor_back/uploads/04092306922-a4.jpg'),
(360, 74, '../o-Dinor_back/uploads/66d81a93e3651.jpg'),
(361, 74, '../o-Dinor_back/uploads/03284315614-e2.jpg'),
(362, 74, '../o-Dinor_back/uploads/03284315614-a2.jpg'),
(363, 74, '../o-Dinor_back/uploads/03284315614-a3.jpg'),
(364, 74, '../o-Dinor_back/uploads/03284315614-a4.jpg'),
(365, 75, '../o-Dinor_back/uploads/66d81bbecf6fb.jpg'),
(366, 75, '../o-Dinor_back/uploads/00526410529-e2.jpg'),
(367, 75, '../o-Dinor_back/uploads/00526410529-p.jpg'),
(368, 75, '../o-Dinor_back/uploads/00526410529-a2 (1).jpg'),
(369, 75, '../o-Dinor_back/uploads/00526410529-a2.jpg'),
(370, 76, '../o-Dinor_back/uploads/66d81c607cdff.jpg'),
(371, 76, '../o-Dinor_back/uploads/00304417431-e2.jpg'),
(372, 76, '../o-Dinor_back/uploads/00304417431-a3.jpg'),
(373, 76, '../o-Dinor_back/uploads/00304417431-a4.jpg'),
(374, 76, '../o-Dinor_back/uploads/00304417431-a5.jpg'),
(375, 77, '../o-Dinor_back/uploads/66d81d84d6681.jpg'),
(376, 77, '../o-Dinor_back/uploads/wst1-2.jpg'),
(377, 77, '../o-Dinor_back/uploads/wst1-3.jpg'),
(378, 78, '../o-Dinor_back/uploads/66d81e2acbada.jpg'),
(379, 78, '../o-Dinor_back/uploads/wst3-2.jpg'),
(380, 78, '../o-Dinor_back/uploads/wst3-5.jpg'),
(381, 78, '../o-Dinor_back/uploads/wst3-4.jpg'),
(382, 78, '../o-Dinor_back/uploads/wst3-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `size` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `cost` int NOT NULL,
  `rate` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`, `cost`, `rate`) VALUES
(58, 7, 'S', 3000, 4000),
(59, 7, 'M', 3000, 4000),
(60, 7, 'L', 3000, 4000),
(61, 7, 'XL', 3000, 4000),
(66, 8, 'S', 3000, 4000),
(67, 8, 'M', 3000, 4000),
(68, 8, 'L', 3000, 4000),
(69, 8, 'XL', 3000, 4000),
(70, 8, 'XXL', 3000, 4000),
(71, 8, 'XXXL', 3000, 4000),
(81, 11, 'S', 2200, 3000),
(82, 11, 'M', 2500, 3500),
(83, 5, 'S', 1500, 2000),
(84, 5, 'M', 2000, 2500),
(85, 5, 'L', 2500, 3000),
(86, 1, 'S', 1500, 2000),
(87, 1, 'M', 1700, 2200),
(88, 1, 'L', 2000, 2500),
(89, 2, 'S', 3000, 4000),
(90, 2, 'M', 3500, 4500),
(91, 2, 'L', 3800, 4800),
(92, 3, 'S', 2000, 3000),
(93, 3, 'M', 2500, 3500),
(94, 3, 'L', 3000, 4000),
(95, 3, 'XL', 3500, 4500),
(96, 4, 'S', 2000, 2500),
(97, 4, 'M', 2500, 3000),
(98, 4, 'L', 3000, 3500),
(99, 14, 'S', 2000, 2500),
(100, 14, 'M', 2500, 3000),
(101, 14, 'L', 3000, 3500),
(102, 15, 'S', 2200, 3000),
(103, 15, 'M', 2500, 3200),
(104, 16, 'S', 2500, 3500),
(105, 16, 'M', 3000, 4000),
(107, 19, 'S', 2500, 3000),
(108, 19, 'M', 2700, 3500),
(109, 19, 'L', 3000, 4200),
(110, 19, 'XL', 3500, 4200),
(111, 20, 'S', 5000, 6000),
(112, 20, 'M', 5500, 6500),
(113, 20, 'L', 6000, 7000),
(114, 20, 'XL', 6500, 7500),
(115, 21, 'S', 3000, 3300),
(116, 21, 'M', 3500, 3800),
(117, 21, 'L', 4000, 4400),
(118, 21, 'XL', 4500, 5000),
(119, 22, 'S', 2500, 3000),
(120, 22, 'M', 2800, 3200),
(121, 22, 'L', 3000, 3500),
(122, 22, 'XXL', 4000, 5000),
(123, 22, 'XXXL', 4500, 5500),
(124, 23, 'M', 5000, 6000),
(125, 23, 'L', 5500, 6500),
(126, 23, 'XL', 6000, 7000),
(127, 24, 'S', 2000, 3000),
(128, 24, 'M', 2200, 3200),
(129, 24, 'L', 2400, 3400),
(130, 24, 'XL', 2600, 3600),
(131, 25, 'S', 3000, 3500),
(132, 25, 'M', 3500, 4000),
(133, 25, 'L', 4000, 4500),
(134, 26, 'S', 3000, 3500),
(135, 26, 'M', 3500, 4000),
(136, 27, 'S', 3000, 4000),
(137, 27, 'M', 3500, 4500),
(138, 27, 'XL', 4500, 5500),
(139, 28, 'S', 1000, 1500),
(140, 28, 'M', 1120, 1800),
(141, 28, 'L', 1300, 2000),
(142, 29, 'S', 2000, 2225),
(143, 29, 'M', 3000, 3250),
(144, 30, 'S', 1000, 2000),
(145, 30, 'M', 1200, 2200),
(146, 30, 'L', 1500, 2500),
(147, 30, 'XL', 2000, 3000),
(148, 31, 'S', 2000, 3000),
(149, 31, 'M', 2200, 3200),
(150, 31, 'L', 2400, 3400),
(151, 31, 'XL', 2600, 3600),
(152, 32, 'S', 4000, 5000),
(153, 32, 'M', 4200, 5200),
(154, 32, 'L', 4400, 5400),
(155, 32, 'XL', 4600, 5600),
(156, 33, 'S', 5000, 6000),
(157, 33, 'M', 5500, 6500),
(158, 34, 'S', 1000, 1500),
(159, 34, 'M', 1500, 1800),
(160, 35, 'S', 1200, 2200),
(161, 35, 'M', 1300, 2300),
(162, 35, 'L', 1400, 2400),
(163, 35, 'XL', 1500, 2500),
(164, 36, 'S', 3000, 4000),
(165, 36, 'M', 3300, 4400),
(166, 36, 'L', 3500, 4500),
(167, 37, 'S', 5000, 6000),
(168, 37, 'M', 5500, 6500),
(169, 37, 'L', 6000, 7000),
(170, 39, 'S', 4200, 5000),
(171, 39, 'M', 4500, 5555),
(172, 39, 'L', 5200, 6000),
(173, 40, 'S', 4000, 4500),
(174, 40, 'M', 5000, 5500),
(175, 40, 'L', 5500, 6000),
(176, 41, 'S', 4500, 5000),
(177, 41, 'M', 4600, 5200),
(178, 41, 'L', 5000, 5600),
(179, 42, 'S', 4000, 4200),
(180, 42, 'M', 5000, 5200),
(181, 43, 'S', 6000, 6500),
(182, 43, 'M', 6200, 6800),
(183, 43, 'L', 7000, 7500),
(184, 44, 'S', 6000, 6500),
(185, 44, 'M', 7000, 7500),
(186, 44, 'L', 8000, 8500),
(187, 45, 'S', 7000, 7500),
(188, 45, 'M', 8000, 8500),
(189, 45, 'L', 8500, 9000),
(190, 46, 'S', 8000, 9000),
(191, 46, 'M', 9000, 10000),
(192, 46, 'L', 10000, 11000),
(193, 47, 'S', 4000, 5000),
(194, 47, 'M', 4000, 6000),
(195, 47, 'L', 6000, 6500),
(196, 48, 'S', 6000, 7000),
(197, 48, 'M', 8000, 9000),
(198, 48, 'L', 9000, 9500),
(205, 51, 'S', 4000, 4500),
(206, 51, 'M', 5000, 5500),
(207, 51, 'L', 5500, 6000),
(208, 52, 'S', 5000, 5500),
(209, 52, 'M', 6000, 6500),
(210, 52, 'L', 6500, 7000),
(211, 53, 'S', 5000, 5500),
(212, 53, 'M', 5500, 6000),
(213, 53, 'L', 6000, 6500),
(214, 54, 'S', 5500, 6000),
(215, 54, 'M', 6000, 6500),
(216, 54, 'L', 6500, 7000),
(217, 55, 'S', 6000, 6500),
(218, 55, 'M', 7000, 7500),
(219, 55, 'L', 8000, 8500),
(220, 56, 'S', 7000, 8000),
(221, 56, 'M', 9000, 10000),
(222, 56, 'L', 9500, 11000),
(223, 57, 'S', 6000, 7000),
(224, 57, 'M', 7000, 8000),
(225, 57, 'L', 8000, 8500),
(226, 58, 'S', 4500, 0),
(227, 58, 'M', 5000, 0),
(228, 58, 'L', 6000, 0),
(229, 59, 'S', 7000, 7500),
(230, 59, 'M', 7500, 8000),
(231, 59, 'L', 7500, 9000),
(232, 60, 'S', 5000, 5400),
(233, 60, 'M', 6000, 6200),
(234, 60, 'L', 6500, 6700),
(235, 60, 'XL', 7000, 7700),
(236, 61, 'S', 4000, 4300),
(237, 61, 'M', 4300, 4600),
(238, 61, 'L', 5000, 5500),
(239, 61, 'XL', 5500, 6000),
(240, 62, 'S', 3000, 3500),
(241, 62, 'M', 4000, 4500),
(242, 62, 'L', 4500, 5000),
(243, 63, 'S', 3000, 3500),
(244, 63, 'M', 3500, 4000),
(245, 63, 'L', 4000, 4500),
(246, 63, 'XL', 4500, 5000),
(247, 64, 'S', 10000, 20000),
(248, 64, 'M', 12000, 30000),
(249, 64, 'L', 13000, 40000),
(250, 65, 'S', 10000, 25000),
(251, 65, 'M', 12000, 28000),
(252, 65, 'L', 13000, 29000),
(253, 66, 'S', 12000, 30000),
(254, 66, 'M', 12000, 32000),
(255, 66, 'L', 12000, 34000),
(256, 67, 'S', 12000, 30000),
(257, 67, 'M', 13000, 34000),
(258, 67, 'L', 14000, 35000),
(259, 68, 'S', 4000, 7000),
(260, 68, 'M', 5000, 8000),
(261, 68, 'L', 6000, 9000),
(262, 69, 'S', 7000, 8000),
(263, 69, 'M', 8000, 9000),
(264, 69, 'L', 9000, 10000),
(265, 70, 'S', 6000, 9000),
(266, 70, 'M', 7000, 10000),
(267, 70, 'L', 8000, 12000),
(268, 71, 'S', 10000, 12000),
(269, 71, 'M', 10000, 12000),
(270, 71, 'L', 10000, 12000),
(271, 72, 'S', 6000, 9000),
(272, 72, 'M', 7000, 10000),
(273, 72, 'L', 8000, 11000),
(274, 73, 'S', 5000, 5500),
(275, 73, 'M', 6000, 6500),
(276, 73, 'L', 6500, 7000),
(277, 74, 'S', 4000, 4500),
(278, 74, 'M', 4500, 5000),
(279, 74, 'L', 5000, 5500),
(280, 75, 'S', 3000, 3500),
(281, 75, 'M', 3500, 4000),
(282, 75, 'L', 4000, 4500),
(283, 76, 'S', 3000, 3500),
(284, 76, 'M', 3500, 4000),
(285, 76, 'L', 4000, 4500),
(286, 77, 'S', 3000, 3500),
(287, 77, 'M', 3500, 4000),
(288, 77, 'L', 4000, 4500),
(289, 78, 'S', 4000, 5000),
(290, 78, 'M', 5000, 5500);

-- --------------------------------------------------------

--
-- Table structure for table `sold_products`
--

DROP TABLE IF EXISTS `sold_products`;
CREATE TABLE IF NOT EXISTS `sold_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `quantity_sold` int NOT NULL,
  `sold_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `checkout_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sold_products`
--

INSERT INTO `sold_products` (`id`, `product_id`, `customer_id`, `quantity_sold`, `sold_at`) VALUES
(1, 2, 1, 2, '2024-09-03 19:06:38'),
(2, 2, 1, 2, '2024-09-03 19:06:38'),
(3, 2, 2, 1, '2024-09-03 20:09:43'),
(4, 2, 3, 1, '2024-09-03 20:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `size` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `size`, `color`, `quantity`, `created_at`) VALUES
(5, 2, 'M', '#ffffe5', 4, '2024-09-03 13:07:20'),
(6, 4, 'S', '#fdfcfc', 0, '2024-09-03 13:12:04'),
(7, 15, 'S', '#46b9b1', 0, '2024-09-03 13:34:27'),
(8, 16, 'S', '#c2a68e', 8, '2024-09-03 13:34:38'),
(9, 16, 'M', '#c2a68e', 10, '2024-09-03 13:34:43'),
(10, 11, 'S', '#ebab6f', 10, '2024-09-03 13:35:22'),
(11, 11, 'M', '#050505', 10, '2024-09-03 13:35:34'),
(12, 11, 'S', '#050505', 10, '2024-09-03 13:35:39'),
(13, 2, 'S', '#ffffe5', 12, '2024-09-03 19:04:26'),
(14, 2, 'L', '#ffffe5', 4, '2024-09-03 19:04:34'),
(15, 5, 'S', '#dfdddd', 10, '2024-09-03 19:04:58'),
(16, 5, 'M', '#dfdddd', 10, '2024-09-03 19:05:01'),
(17, 5, 'L', '#dfdddd', 10, '2024-09-03 19:05:04'),
(18, 39, 'S', '#050505', 10, '2024-09-04 04:52:12'),
(19, 40, 'S', '#68a249', 9, '2024-09-04 05:19:23'),
(20, 41, 'M', '#d92020', 12, '2024-09-04 05:31:31'),
(21, 46, 'S', '#263ef2', 8, '2024-09-04 05:58:08'),
(22, 46, 'M', '#263ef2', 10, '2024-09-04 05:58:17'),
(23, 43, 'S', '#0a0a0a', 10, '2024-09-04 06:00:36'),
(24, 43, 'M', '#0a0a0a', 10, '2024-09-04 06:00:46'),
(25, 48, 'S', '#272626', 10, '2024-09-04 06:13:11'),
(26, 48, 'M', '#272626', 10, '2024-09-04 06:13:25'),
(27, 51, 'S', '#071950', 12, '2024-09-04 06:27:33'),
(28, 52, 'S', '#151414', 12, '2024-09-04 06:43:41'),
(29, 52, 'M', '#151414', 12, '2024-09-04 06:43:56'),
(30, 53, 'S', '#1b1818', 12, '2024-09-04 06:45:29'),
(31, 54, 'S', '#66800a', 12, '2024-09-04 06:50:45'),
(32, 54, 'M', '#66800a', 5, '2024-09-04 06:51:45'),
(33, 57, 'S', '#181616', 12, '2024-09-04 07:03:34'),
(34, 57, 'M', '#181616', 8, '2024-09-04 07:03:43'),
(35, 58, 'S', '#f0eaea', 11, '2024-09-04 07:11:37'),
(36, 58, 'M', '#f0eaea', 3, '2024-09-04 07:11:48'),
(37, 60, 'S', '#3a6209', 5, '2024-09-04 07:21:48'),
(38, 60, 'M', '#3a6209', 7, '2024-09-04 07:21:57'),
(39, 61, 'S', '#c9c5c5', 23, '2024-09-04 07:26:49'),
(40, 61, 'M', '#c9c5c5', 11, '2024-09-04 07:26:56'),
(41, 62, 'S', '#febebe', 12, '2024-09-04 07:29:48'),
(42, 62, 'M', '#febebe', 5, '2024-09-04 07:29:54'),
(43, 63, 'S', '#f2e9e9', 4, '2024-09-04 07:33:43'),
(44, 64, 'S', '#ffc7c7', 12, '2024-09-04 07:51:41'),
(45, 64, 'M', '#ffc7c7', 12, '2024-09-04 07:51:47'),
(46, 65, 'S', '#efebeb', 12, '2024-09-04 07:51:59'),
(47, 65, 'M', '#efebeb', 3, '2024-09-04 07:52:05'),
(48, 68, 'S', '#928787', 4, '2024-09-04 08:03:38'),
(49, 68, 'M', '#928787', 12, '2024-09-04 08:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `admin_ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_has_items`
--
ALTER TABLE `order_has_items`
  ADD CONSTRAINT `order_has_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_has_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

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
  ADD CONSTRAINT `sold_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sold_products_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
