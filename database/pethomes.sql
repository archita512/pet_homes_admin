-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 07:13 AM
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
-- Database: `pethomes`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `name`, `des`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What We Do', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.      ', 'Active', '2025-06-13 04:22:12', NULL),
(2, 'How can i can contacts Pethomes', '                     What We Do\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.', 'Active', '2025-06-13 04:22:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `pet_cat` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `key` varchar(1000) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `cat_id`, `pet_cat`, `name`, `image`, `des`, `price`, `key`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Dry Food', '1749718033_1747656394_dry_food.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 990, '[\"Quantity \"]', '[\"1 KG\"]', 'Active', '2025-06-12 08:47:13', NULL),
(2, 1, 1, 'Archita', '1750151793_Siamese_cat.jpg', 'asdsasdsadasd', 200, '[\"\"]', '[\"\"]', 'Active', '2025-06-17 09:16:33', '2025-06-18 08:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `acce_catgeory`
--

CREATE TABLE `acce_catgeory` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acce_catgeory`
--

INSERT INTO `acce_catgeory` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Food Product', '1749717961_ha1.png', 'Active', '2025-06-12 08:46:01', NULL),
(2, 'Bed Products', '1749719016_1747644403_ha2.png', 'Active', '2025-06-12 09:03:36', NULL),
(3, 'Grooming Products', '1749719037_1747975917_ha3.png', 'Active', '2025-06-12 09:03:57', NULL),
(4, 'Feeding Products', '1749719140_ha4.png', 'Active', '2025-06-12 09:05:40', NULL),
(5, 'aaa', '1750220838_Labrador_1.jpg', 'Active', '2025-06-18 04:27:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acc_return`
--

CREATE TABLE `acc_return` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `mno` bigint(20) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `re_date` date DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `payment_method` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acc_return`
--

INSERT INTO `acc_return` (`id`, `acc_id`, `name`, `mno`, `email`, `re_date`, `address`, `total_price`, `quantity`, `discount`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 'Archita', 9265724082, 'saxsax@gmail.com', '2025-06-11', 'varacha', 990, 1, 0, 'Paid', 'Cash', '2025-06-16 12:16:11', '2025-06-16 12:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `acc_sale`
--

CREATE TABLE `acc_sale` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `mno` bigint(20) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `payment_method` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acc_sale`
--

INSERT INTO `acc_sale` (`id`, `acc_id`, `name`, `mno`, `email`, `date`, `address`, `discount`, `total_price`, `quantity`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 'Archita', 9696968704, 'saxsax@gmail.com', '2025-06-18', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 5, 4702.5, 5, 'Pending', '0', '2025-06-14 06:46:47', NULL),
(2, 1, 'Archita', 9265724416, 'archita.kalathiyainfotech@gmail.com', '2025-06-08', 'varacha', 0, 990, 1, 'Pending', '0', '2025-06-16 05:56:13', '2025-06-16 05:57:34'),
(3, 1, 'Archita', 9685968896, 'archita.kalathiyainfotech@gmail.com', '2025-06-17', 'varacha', 0, 1980, 2, 'Pending', '0', '2025-06-16 05:56:30', NULL),
(4, 1, 'Archita', 9265724416, 'archita.kalathiyainfotech@gmail.com', '2025-06-20', 'varacha', 0, 2970, 3, 'Paid', 'Online', '2025-06-16 05:56:45', '2025-06-16 12:17:42'),
(5, 1, 'Archita', 9696968704, 'archita.kalathiyainfotech@gmail.com', '2025-06-07', 'varacha', 0, 990, 1, 'Paid', 'Online', '2025-06-16 05:57:05', '2025-06-16 11:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `acc_wishlist`
--

CREATE TABLE `acc_wishlist` (
  `id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acc_wishlist`
--

INSERT INTO `acc_wishlist` (`id`, `u_id`, `a_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2025-06-17 09:48:16', NULL),
(4, 6, 1, '2025-06-18 04:57:05', NULL),
(5, 6, 2, '2025-06-18 04:57:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addopt_pet`
--

CREATE TABLE `addopt_pet` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `mno` bigint(20) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `ad_date` date DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `payment_method` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addopt_pet`
--

INSERT INTO `addopt_pet` (`id`, `pet_id`, `name`, `mno`, `email`, `ad_date`, `address`, `discount`, `total_price`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 'Archita', 9265724082, 'archita.kalathiyainfotech@gmail.com', '2025-06-12', 'varacha', 5, 1425, 'Paid', 'Online', '2025-06-12 11:04:15', '2025-06-16 11:45:55'),
(4, 2, 'Archita', 9265724082, 'saxsax@gmail.com', '2025-07-17', 'varacha', 0, 750, 'Paid', 'Cash', '2025-06-14 09:36:10', '2025-06-16 11:24:43'),
(5, 3, 'Archita', 9685968595, 'archi.kalathiyainfotech@gmail.com', '2025-06-12', 'varacha', 0, 25000, 'Paid', 'Online', '2025-06-14 09:37:02', '2025-06-16 11:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `name`, `image`, `des`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Need Help? We\'re here to provide a safe start to your lifeong freindship', '1749718874_image (1).png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Active', '2025-06-12 09:01:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dog', '1749713323_dog.png', 'Active', '2025-06-12 07:28:43', NULL),
(2, 'Cat', '1749719523_cat.png', 'Active', '2025-06-12 09:12:03', NULL),
(3, 'Fish', '1749719547_fish.png', 'Active', '2025-06-12 09:12:27', NULL),
(4, 'Hourse', '1749719566_horse.png', 'Active', '2025-06-12 09:12:46', NULL),
(8, 'Archita', '1750243039_dog1 - Copy (2).jpg', 'Active', '2025-06-18 10:37:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `subject` varchar(1000) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`, `subject`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Orli Foreman', 'qaregewy@mailinator.com', 2796969696, 'Iste nulla corrupti', 'Adipisicing exercita', 'Active', NULL, NULL),
(2, 'Serina Pena', 'rivysyzixy@mailinator.com', 9685748596, 'Cum blanditiis fugia', 'Accusamus quaerat pa', 'Active', NULL, NULL),
(3, 'Ferdinand Vang', 'kisy@mailinator.com', 5741859685, 'Sed numquam est volu', 'Ab fugiat voluptas l', 'Active', NULL, NULL),
(4, 'Adele Singleton', 'lakypoqox@mailinator.com', 6968785496, 'Optio cillum repreh', 'Temporibus rerum fug', 'Active', NULL, NULL),
(5, 'Dalton Anderson', 'gaguwi@mailinator.com', 3996857485, 'Qui dignissimos mini', 'Velit ipsa assumend', 'Active', NULL, NULL),
(6, 'Felix Kline', 'botopum@mailinator.com', 3396857486, 'Magna in omnis dolor', 'Dolore et excepturi ', 'Active', NULL, NULL),
(7, 'Graham Pena', 'cyzuji@mailinator.com', 6896857485, 'Porro fugiat aspern', 'Consequatur Perspic', 'Active', NULL, NULL),
(8, 'isha', 'isha@gmail.com', 8547485965, 'aaaa', 'Reiciendis non simil', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `password` varchar(5000) DEFAULT NULL,
  `mno` bigint(20) DEFAULT NULL,
  `gender` varchar(500) DEFAULT NULL,
  `image` varchar(5000) DEFAULT NULL,
  `location` varchar(1000) DEFAULT NULL,
  `otp` varchar(1000) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `upadated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `mno`, `gender`, `image`, `location`, `otp`, `status`, `created_at`, `upadated_at`) VALUES
(1, 'Archita Patel', 'archita.kalathiyainfotech@gmail.com', '$2y$10$OQUhPlC7iKF0GjC.gECl6u6cVHdcgoOKZPvYLaKYh7I5.m48oCuyq', 9874563214, 'Male', '67b2cd4b0c5e9_customer2.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting.', '453594', 'Active', '2024-11-27 05:21:54', '2025-06-18 04:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `name`, `image`, `des`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Flat 30% Discount', '1749718358_h_temp1.png', '100% Organic Pet Food', 'Active', '2025-06-12 08:52:38', NULL),
(2, 'Venus Montoya', '1749718399_hero-image.png', 'Nisi laborum nisi po', 'Active', '2025-06-12 08:53:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `adv_id` varchar(1000) DEFAULT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `type_listing` varchar(1000) DEFAULT NULL,
  `pet_age` varchar(1000) DEFAULT NULL,
  `pets_available` varchar(1000) DEFAULT NULL,
  `health_check` varchar(500) DEFAULT NULL,
  `origina_breeder` varchar(200) DEFAULT NULL,
  `warm_flat` varchar(500) DEFAULT NULL,
  `pets_littel` varchar(1000) DEFAULT NULL,
  `adv_location` varchar(1000) DEFAULT NULL,
  `Vaccination` varchar(1000) DEFAULT NULL,
  `pet_viewable` varchar(500) DEFAULT NULL,
  `kc_register` varchar(500) DEFAULT NULL,
  `microchipped` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `pet_gander` varchar(500) DEFAULT NULL,
  `pet_weight` int(11) DEFAULT NULL,
  `pet_color` varchar(500) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `cat_id`, `sub_id`, `name`, `image`, `adv_id`, `des`, `price`, `type_listing`, `pet_age`, `pets_available`, `health_check`, `origina_breeder`, `warm_flat`, `pets_littel`, `adv_location`, `Vaccination`, `pet_viewable`, `kc_register`, `microchipped`, `country`, `pet_gander`, `pet_weight`, `pet_color`, `status`, `created_at`, `update_at`) VALUES
(1, 1, 1, 'Golden Retriever', '[\"684a92098f286.jpg\",\"684a92098f434.jpg\",\"684a92098f5f8.jpg\",\"684a92098f7be.jpg\",\"684a92098f98a.jpg\"]', 'ACU512', ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 1500, 'For Sale', '5 Year', '2025-06-12', 'Yes', 'Yes', 'Yes', '2 Male 3 Female', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Yes', 'Yes', 'Yes', 'Yes', 'London', 'Male', 15, 'Brown', 'Active', '2025-06-12 08:38:33', '2025-06-18 10:30:00'),
(2, 1, 2, 'Lacey', '[\"684abb6e87dce.jpg\",\"684abb6e880a2.jpg\",\"684abb6e882dd.jpg\",\"684abb6e88518.jpg\",\"684abb6e8875e.jpg\"]', 'HZD427', ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', 750, 'For Sale', '2 Month', '2025-06-12', 'Yes', 'Yes', 'Yes', '2 Male', 'Dolorem officia est', 'Yes', 'Yes', 'Yes', 'Yes', 'Newfoundland', 'Female', 15, 'black', 'Active', '2025-06-12 11:35:10', '2025-06-18 10:30:04'),
(3, 1, 3, 'Luna', '[\"684d11b3e6437.jpg\",\"684d11b3e660b.png\",\"684d11b3e67f5.png\",\"684d11b3e6a2d.png\"]', 'CGZ344', ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 25000, 'For Sale', '5 Year', '2025-06-22', 'Yes', 'Yes', 'Yes', '2 Male 3 Female', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Yes', 'Yes', 'Yes', 'Yes', 'France', 'Male', 25, 'white', 'Active', '2025-06-14 06:07:47', '2025-06-18 10:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `pet_return`
--

CREATE TABLE `pet_return` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `mno` bigint(20) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `re_date` date DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `payment_method` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_return`
--

INSERT INTO `pet_return` (`id`, `pet_id`, `name`, `mno`, `email`, `re_date`, `address`, `discount`, `total_price`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 3, 'Archita', 9265724082, 'saxsax@gmail.com', '2025-06-26', 'varacha', 5, 1425, 'Paid', 'Cash', '2025-06-14 06:44:30', '2025-06-16 11:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `pet_wishlist`
--

CREATE TABLE `pet_wishlist` (
  `id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_wishlist`
--

INSERT INTO `pet_wishlist` (`id`, `u_id`, `pet_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2025-06-12 09:34:31', NULL),
(10, 3, 2, '2025-06-17 09:36:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `id` int(11) NOT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`id`, `des`, `status`, `created_at`, `updated_at`) VALUES
(1, '                     What We Do\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.', 'Active', '2025-06-13 04:23:18', NULL),
(2, '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.What We Do\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.', 'Active', '2025-06-13 04:23:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `que_ans`
--

CREATE TABLE `que_ans` (
  `id` int(11) NOT NULL,
  `question` varchar(500) DEFAULT NULL,
  `ans` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `que_ans`
--

INSERT INTO `que_ans` (`id`, `question`, `ans`, `created_at`, `updated_at`) VALUES
(3, 'Hello', 'Hi there! How can I help you today?', '2025-06-14 04:02:59', NULL),
(4, 'What\'s your name', 'My name is Nicola. What\'s yours?', '2025-06-14 04:03:40', NULL),
(5, 'Where are you from', 'I\'m from New York. Where are you from?', '2025-06-14 04:04:06', NULL),
(6, 'Can I adopt a pet if I live in a rented house?', 'Yes, you can—provided you have your landlord’s permission and the space is suitable for a pet’s needs.🐻', '2025-06-14 04:07:03', NULL),
(7, 'What is the adoption process?', 'Visit Our Location and Pet Addopted This Location 🐶🐶', '2025-06-14 04:28:12', NULL),
(8, 'Thank you', ' You\'re welcome! Happy to help!😃', '2025-06-14 04:36:43', NULL),
(9, 'Goodbye', 'Goodbye! It was nice talking with you!🤩', '2025-06-14 04:37:09', NULL),
(10, 'hey jini', 'Hey archu, What\'s Up 😀😀', '2025-06-14 04:49:48', '2025-06-14 05:11:48'),
(11, 'hey ishaa', 'hey architaa🥰🍇🚎', '2025-06-18 04:37:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `reason` varchar(1000) DEFAULT NULL,
  `report_details` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `u_id`, `reason`, `report_details`, `created_at`, `updated_at`) VALUES
(9, 6, 'other', 'not supported', '2025-06-18 05:07:32', NULL),
(10, 6, 'Fake or Misleading Listing', 'aaaaaaa aaa a', '2025-06-18 10:26:12', NULL),
(11, 6, 'Fake or Misleading Listing', 'asdswe sadec', '2025-06-18 10:27:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `upadated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `image`, `des`, `price`, `status`, `created_at`, `upadated_at`) VALUES
(1, 'Boarding', '1749718175_1749545034_boarding.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 500, 'Active', '2025-06-12 08:49:35', NULL),
(2, 'Grooming', '1749718200_1749545219_grooming.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 750, 'Active', '2025-06-12 08:50:00', NULL),
(3, 'walking', '1749718242_1749545618_walk.jpeg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 250, 'Active', '2025-06-12 08:50:42', NULL),
(4, 'Pet Spa', '1749718273_1749545301_spa.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 500, 'Active', '2025-06-12 08:51:13', NULL),
(5, 'Pet Spa', '1750220939_Labrador_1.jpg', 'aaaaaaaaa  aaaaaaaaaaaaaaaaa', 990, 'Active', '2025-06-18 04:28:59', '2025-06-18 10:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `service_maintain`
--

CREATE TABLE `service_maintain` (
  `id` int(11) NOT NULL,
  `s_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `mno` bigint(20) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `payment_method` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_maintain`
--

INSERT INTO `service_maintain` (`id`, `s_id`, `name`, `mno`, `email`, `date`, `address`, `discount`, `total_price`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 'Archita', 9265724082, 'archita.kalathiyainfotech@gmail.com', '2025-06-12', 'varacha', 0, 500, 'Paid', 'Cash', '2025-06-12 09:51:57', '2025-06-16 12:20:25'),
(2, 5, 'Archita', 9265724082, 'saxsax@gmail.com', '2025-06-20', 'varacha', 0, 990, 'Paid', 'Cash', '2025-06-18 04:36:35', '2025-06-18 04:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `service_wishlist`
--

CREATE TABLE `service_wishlist` (
  `id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_wishlist`
--

INSERT INTO `service_wishlist` (`id`, `u_id`, `s_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2025-06-17 09:51:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `cat_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'German Shepherd', '1749713470_682aaa128982f.jpg', 'Active', '2025-06-12 07:31:10', NULL),
(2, 1, 'Labrador Retrievers', '1749727935_Labrador_1.jpg', 'Active', '2025-06-12 11:32:15', NULL),
(3, 1, 'Bulldog', '1749880742_Bulldog.jpg', 'Active', '2025-06-14 05:59:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `des` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `des`, `status`, `created_at`, `updated_at`) VALUES
(1, '                     What We Do\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.\r\nWhat We Do\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.', 'Active', '2025-06-13 04:23:05', NULL),
(2, '                     What We Do\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at fermentum magna. Vestibulum ultrices augue et sem consectetur fermentum. Pellentesque tempus tincidunt consectetur. Sed vestibulum turpis ut turpis efficitur, vel vehicula ligula mattis. Vivamus tincidunt maximus dolor et maximus. Aenean gravida sem facilisis accumsan cursus.', 'Active', '2025-06-13 04:23:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `token` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `name`, `email`, `phone`, `otp`, `password`, `image`, `status`, `token`, `created_at`, `updated_at`) VALUES
(3, 'Archita', 'archita.kalathiyainfotech@gmail.com', NULL, 969394, '$2y$10$wZ8COO8pr6fteW2nh00bd.R7NbChhvZT9KOXJHb0xaF2oogv8WjO6', NULL, 'Active', '4b0e8a4595d30dbe1d916400dd65ee8f0ae02f43ef79e239e81a5ed0d0a3b092', '2025-06-12 09:34:24', '2025-06-17 12:12:57'),
(4, 'Archita', 'archupatel@gmail.com', NULL, NULL, NULL, NULL, 'Active', NULL, '2025-06-17 06:47:31', NULL),
(5, 'jinisha', 'jinisha.kalathiyainfotech@gmail.com', NULL, 6462, '$2y$10$VjBmIQGN3x2cCUC7ovHih.ZN1BSio.ZJxI6jHjRHrHaYXlW3ZvJOq', NULL, 'Active', '663920c72104dcf44e18f7f820f8eb810248617c65232123bdf9620d675f9165', '2025-06-17 08:49:21', '2025-06-17 08:54:34'),
(6, 'isha', 'isha.kalathiyainfotech@gmail.com', 9685748596, 216405, '$2y$10$uBPW4rLro.ncohrdZH.MKeTElNJ7JeYnUGxc/WgxfXyFhl.rKozhS', '67b2cb130cd3a_messages-1.jpg', 'Active', '80cb0df09c375825a75fe4eaf27ad1ed45331025e415543c6114e19317830658', '2025-06-18 04:49:52', '2025-06-18 05:12:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_na` (`cat_id`),
  ADD KEY `pet_name` (`pet_cat`);

--
-- Indexes for table `acce_catgeory`
--
ALTER TABLE `acce_catgeory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_return`
--
ALTER TABLE `acc_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_name` (`acc_id`);

--
-- Indexes for table `acc_sale`
--
ALTER TABLE `acc_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `acc_wishlist`
--
ALTER TABLE `acc_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`u_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `addopt_pet`
--
ALTER TABLE `addopt_pet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_name` (`sub_id`),
  ADD KEY `category_name` (`cat_id`);

--
-- Indexes for table `pet_return`
--
ALTER TABLE `pet_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_category_name` (`pet_id`);

--
-- Indexes for table `pet_wishlist`
--
ALTER TABLE `pet_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_name` (`u_id`),
  ADD KEY `pet` (`pet_id`);

--
-- Indexes for table `privacy`
--
ALTER TABLE `privacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `que_ans`
--
ALTER TABLE `que_ans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users` (`u_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_maintain`
--
ALTER TABLE `service_maintain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ser_name` (`s_id`);

--
-- Indexes for table `service_wishlist`
--
ALTER TABLE `service_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`u_id`),
  ADD KEY `service` (`s_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catgeory_name` (`cat_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `acce_catgeory`
--
ALTER TABLE `acce_catgeory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `acc_return`
--
ALTER TABLE `acc_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `acc_sale`
--
ALTER TABLE `acc_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `acc_wishlist`
--
ALTER TABLE `acc_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `addopt_pet`
--
ALTER TABLE `addopt_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pet_return`
--
ALTER TABLE `pet_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pet_wishlist`
--
ALTER TABLE `pet_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `privacy`
--
ALTER TABLE `privacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `que_ans`
--
ALTER TABLE `que_ans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_maintain`
--
ALTER TABLE `service_maintain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_wishlist`
--
ALTER TABLE `service_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `category_na` FOREIGN KEY (`cat_id`) REFERENCES `acce_catgeory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_name` FOREIGN KEY (`pet_cat`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `acc_return`
--
ALTER TABLE `acc_return`
  ADD CONSTRAINT `acc_name` FOREIGN KEY (`acc_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `acc_sale`
--
ALTER TABLE `acc_sale`
  ADD CONSTRAINT `acc_id` FOREIGN KEY (`acc_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `acc_wishlist`
--
ALTER TABLE `acc_wishlist`
  ADD CONSTRAINT `a_id` FOREIGN KEY (`a_id`) REFERENCES `accessories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`u_id`) REFERENCES `user_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `category_name` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_name` FOREIGN KEY (`sub_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_return`
--
ALTER TABLE `pet_return`
  ADD CONSTRAINT `pet_category_name` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_wishlist`
--
ALTER TABLE `pet_wishlist`
  ADD CONSTRAINT `pet` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_name` FOREIGN KEY (`u_id`) REFERENCES `user_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `users` FOREIGN KEY (`u_id`) REFERENCES `user_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_maintain`
--
ALTER TABLE `service_maintain`
  ADD CONSTRAINT `ser_name` FOREIGN KEY (`s_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_wishlist`
--
ALTER TABLE `service_wishlist`
  ADD CONSTRAINT `service` FOREIGN KEY (`s_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`u_id`) REFERENCES `user_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `catgeory_name` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
