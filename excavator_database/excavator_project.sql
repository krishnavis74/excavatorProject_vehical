-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2024 at 03:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `excavator_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `code` int NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`code`, `document_name`, `created_at`, `updated_at`) VALUES
(1, 'Insurance', '2023-03-09 08:01:10', '2023-07-14 04:19:05'),
(2, 'Registration', '2023-03-09 08:01:10', NULL),
(3, 'Pollution', '2023-03-09 08:01:40', '2023-07-14 04:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `code` int NOT NULL,
  `state` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`code`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Andhra Pradesh', '2023-02-15 10:36:22', NULL),
(2, 'Arunachal Pradesh', '2023-02-15 10:36:22', NULL),
(3, 'Assam', '2023-02-15 10:36:22', NULL),
(4, 'Bihar', '2023-02-15 10:36:22', NULL),
(5, 'Chhattisgarh', '2023-02-15 10:36:22', NULL),
(6, 'Goa', '2023-02-15 10:36:22', NULL),
(7, 'Gujarat', '2023-02-15 10:36:22', NULL),
(8, 'Haryana', '2023-02-15 10:36:22', NULL),
(9, 'Himachal Pradesh', '2023-02-15 10:36:22', NULL),
(10, 'Jharkhand', '2023-02-15 10:36:22', NULL),
(11, 'Karnataka', '2023-02-15 10:36:22', NULL),
(12, 'Kerala', '2023-02-15 10:36:22', NULL),
(13, 'Madhya Pradesh', '2023-02-15 10:36:22', NULL),
(14, 'Maharashtra', '2023-02-15 10:36:22', NULL),
(15, 'Manipur', '2023-02-15 10:36:22', NULL),
(16, 'Meghalaya', '2023-02-15 10:36:22', NULL),
(17, 'Mizoram', '2023-02-15 10:36:22', NULL),
(18, 'Nagaland', '2023-02-15 10:36:22', NULL),
(19, 'Odisha', '2023-02-15 10:36:22', NULL),
(20, 'Punjab', '2023-02-15 10:36:22', NULL),
(21, 'Rajasthan', '2023-02-15 10:36:22', NULL),
(22, 'Sikkim', '2023-02-15 10:36:22', NULL),
(23, 'Tamil Nadu', '2023-02-15 10:36:22', NULL),
(24, 'Telangana', '2023-02-15 10:36:22', NULL),
(25, 'Tripura', '2023-02-15 10:36:22', NULL),
(26, 'Uttar Pradesh', '2023-02-15 10:36:22', NULL),
(27, 'Uttarakhand', '2023-02-15 10:36:22', NULL),
(28, 'West Bengal', '2023-02-15 10:36:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `code` int NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `vehicle_model_no` varchar(100) NOT NULL,
  `vehicle_reg_no` varchar(100) NOT NULL,
  `vehicle_purchase_date` date NOT NULL,
  `vehicle_reg_date` date NOT NULL,
  `reg_authority` varchar(100) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `fuel_type` varchar(100) NOT NULL,
  `engine_no` varchar(100) NOT NULL,
  `chassis_no` varchar(100) NOT NULL,
  `vehicle_serial_no` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`code`, `owner_name`, `vehicle_model_no`, `vehicle_reg_no`, `vehicle_purchase_date`, `vehicle_reg_date`, `reg_authority`, `vehicle_type`, `fuel_type`, `engine_no`, `chassis_no`, `vehicle_serial_no`, `created_at`, `updated_at`) VALUES
(1, 'Rabi', 'KA-03-HA-1985', 'KA-03-HA-1985', '2023-02-27', '2023-02-16', 'ggg', 'gbg', 'petrol', 'KA-03-HA-1985', 'KA-03-HA-1985', 'KA-03-HA-1985', '2023-02-13 00:51:45', '2023-03-04 01:48:20'),
(2, 'Test', 'HFHGG585-444', 'HFHGG585-444', '2023-02-08', '2023-02-13', 'M/s Enterprice', 'bbbbb', 'petrol', 'HFHGG585-444', 'HFHGG585-444', 'HFHGG585-444', '2023-02-13 05:26:41', '2023-03-04 01:48:06'),
(3, 'Avijit Sarkar', 'KA-03-HA-1985', 'WB 20 AA 4562', '2023-02-08', '2023-02-08', 'M/S Enterprises', 'Excavator', 'Petrol', '53WVC103254', '53WVC103254', 'MB20574B85', '2023-02-14 01:10:13', '2023-10-20 13:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicleworkplace`
--

CREATE TABLE `tbl_vehicleworkplace` (
  `code` int NOT NULL,
  `vehicle_serial_no` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `operator` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicleworkplace`
--

INSERT INTO `tbl_vehicleworkplace` (`code`, `vehicle_serial_no`, `state`, `district`, `address`, `operator`, `created_at`, `updated_at`) VALUES
(1, '4', 'hhh', 'hhhh', 'hhhh', '31', '2023-02-15 04:49:58', '2023-02-15 04:49:58'),
(3, '4', '20', 'haripur', '52-2/ goldik', '22', '2023-02-15 06:37:29', '2023-02-15 06:37:29'),
(4, '4', '4', 'bhagalpur', '25/23, gram', '22', '2023-02-15 06:50:42', '2023-02-16 01:25:31'),
(5, '4', '3', 'dd', 'dd', '22', '2023-02-15 06:51:08', '2023-02-16 01:44:07'),
(6, '5', '14', 'nn', 'hhh', '26', '2023-02-15 06:53:31', '2023-02-15 06:53:31'),
(9, '6', '16', 'dell', '12-2, pally', '27', '2023-02-16 04:18:47', '2023-02-16 04:19:25'),
(11, '2', '3', 'ddddd', 'sssss', '30', '2023-03-11 02:15:09', '2023-03-11 02:15:09'),
(12, '2', '2', 'ddddd', 'aaaaa', '26', '2023-03-11 02:15:30', '2023-03-11 02:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_repairing`
--

CREATE TABLE `tbl_vehicle_repairing` (
  `code` int NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vehicle_reg_id` int NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `grand_total` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle_repairing`
--

INSERT INTO `tbl_vehicle_repairing` (`code`, `vendor_name`, `vehicle_reg_id`, `date`, `address`, `grand_total`, `created_at`, `updated_at`) VALUES
(27, 'jj', 2, '2023-03-06', 'add', 120, '2023-03-06 10:57:13', '2023-03-09 02:10:50'),
(33, 'kkkkkkkkkk', 1, '2023-03-09', 'eee', 36, '2023-03-09 02:13:21', '2023-03-09 02:14:17'),
(34, 'dgdfg', 2, '2023-07-14', 'dfgdfgdfg', 2450, '2023-07-14 04:20:26', '2023-07-14 04:20:26'),
(35, 'krishna', 1, '2023-10-20', 'panagarh', 58, '2023-10-20 12:56:14', '2023-12-06 10:00:37'),
(36, 'krishna', 1, '2023-12-06', 'address', 20, '2023-12-06 10:00:04', '2023-12-06 10:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_repairing_details`
--

CREATE TABLE `tbl_vehicle_repairing_details` (
  `code` int NOT NULL,
  `vehicle_repairing_code` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantity` int NOT NULL,
  `amount` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle_repairing_details`
--

INSERT INTO `tbl_vehicle_repairing_details` (`code`, `vehicle_repairing_code`, `type`, `description`, `quantity`, `amount`, `total`, `created_at`, `updated_at`) VALUES
(167, 27, 'service charge', 'fff', 7, 7, 49, '2023-03-09 02:10:50', '2023-03-09 02:10:50'),
(168, 27, 'parts change', 'fff', 7, 7, 49, '2023-03-09 02:10:50', '2023-03-09 02:10:50'),
(169, 27, 'parts change', 'dd', 4, 5, 20, '2023-03-09 02:10:50', '2023-03-09 02:10:50'),
(170, 27, 'parts change', 'desc', 2, 1, 2, '2023-03-09 02:10:50', '2023-03-09 02:10:50'),
(173, 33, 'parts change', 'descc', 4, 4, 16, '2023-03-09 02:14:17', '2023-03-09 02:14:17'),
(174, 33, 'parts change', 'desf', 4, 5, 20, '2023-03-09 02:14:17', '2023-03-09 02:14:17'),
(175, 34, 'service charge', 'gfgfg', 4, 5, 20, '2023-07-14 04:20:27', '2023-07-14 04:20:27'),
(176, 34, 'parts change', '454', 45, 54, 2430, '2023-07-14 04:20:27', '2023-07-14 04:20:27'),
(181, 36, 'service charge', 'car', 5, 4, 20, '2023-12-06 10:00:28', '2023-12-06 10:00:28'),
(182, 35, 'service charge', 'deacription', 2, 5, 10, '2023-12-06 10:00:37', '2023-12-06 10:00:37'),
(183, 35, 'parts change', 'deacription', 6, 8, 48, '2023-12-06 10:00:37', '2023-12-06 10:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@gmail.com', NULL, '$2y$10$nr4JyfNvxqlZiaHmU3e3b.s5t9YEXtIbhR/4wnEnnQFEJbdAgCtSm', NULL, '2023-02-07 05:41:05', '2023-02-07 05:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_vehicle`
--

CREATE TABLE `user_vehicle` (
  `code` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_vehicle`
--

INSERT INTO `user_vehicle` (`code`, `name`, `mobile_no`, `user_name`, `password`, `type`, `created_at`, `updated_at`) VALUES
(26, 'sudhir', '0987897654', 'user@12345', '12345qwert', 'vehicle operator', '2023-02-10 00:16:11', '2023-02-10 00:16:35'),
(27, 'dev', '2345670000', 'dev@1234', '12345qwert', 'vehicle operator', '2023-02-10 00:36:47', '2023-02-10 00:39:25'),
(29, 'user name', '0000000000', 'krishna@12345', '12345qwert', 'vehicle operator', '2023-02-10 00:40:35', '2023-02-10 00:40:35'),
(30, 'sundar', '5555555555', 'krishna@12345', '1234512344', 'vehicle operator', '2023-02-10 00:56:18', '2023-02-10 00:56:18'),
(36, 'krishna viswakarma', '9999999000', 'de@3434', 'Uf@1ederfee', 'vehicle operator', '2023-02-13 02:40:17', '2023-02-13 02:49:21'),
(37, 'neha', '9999999999', 'as@1333', 'Uu@1dfdfdef', 'others', '2023-02-13 02:49:45', '2023-02-13 06:24:34'),
(40, 'krishna', '9999999999', 'de@3434', 'Uu@1gggggggg', 'others', '2023-02-13 06:25:04', '2023-02-13 06:25:04'),
(41, 'dinesh', '8888888888', 's@1234', '2ecd32af607ec163bedd308d8b2e09f7', 'admin', '2023-02-13 07:16:21', '2023-02-13 07:16:21'),
(42, 'krishna', '9999999999', 'ssS@12345F', 'bb5974fcc961062cf1cdb410f3df13eb', 'others', '2023-02-13 07:18:17', '2023-02-13 07:18:17'),
(43, 'fffff', '9999999999', 'de@3434', 'Uu@12345', 'admin', '2023-03-11 02:55:25', '2023-03-11 02:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `vehiclewise_document`
--

CREATE TABLE `vehiclewise_document` (
  `code` int NOT NULL,
  `vehicle_reg_no_id` int NOT NULL,
  `document_type_id` int NOT NULL,
  `document_pdf` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehiclewise_document`
--

INSERT INTO `vehiclewise_document` (`code`, `vehicle_reg_no_id`, `document_type_id`, `document_pdf`, `created_at`, `updated_at`) VALUES
(7, 2, 2, '1003202309031830845.pdf', '2023-03-10 04:18:18', '2023-11-09 01:58:47'),
(8, 1, 2, '1003202309035548380.pdf', '2023-03-10 04:19:55', '2023-03-10 23:24:03'),
(9, 3, 3, '1003202309031672821.pdf', '2023-03-10 04:20:16', '2023-03-10 04:20:16'),
(10, 1, 1, '0911202307112034596.pdf', '2023-11-09 01:45:21', '2023-11-09 01:45:21'),
(11, 2, 2, '0911202307110549481.pdf', '2023-11-09 01:46:05', '2023-11-09 01:46:05'),
(12, 1, 1, '0911202307111369170.pdf', '2023-11-09 01:58:13', '2023-11-09 01:58:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_vehicleworkplace`
--
ALTER TABLE `tbl_vehicleworkplace`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_vehicle_repairing`
--
ALTER TABLE `tbl_vehicle_repairing`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_vehicle_repairing_details`
--
ALTER TABLE `tbl_vehicle_repairing_details`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `vehiclewise_document`
--
ALTER TABLE `vehiclewise_document`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vehicleworkplace`
--
ALTER TABLE `tbl_vehicleworkplace`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_vehicle_repairing`
--
ALTER TABLE `tbl_vehicle_repairing`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_vehicle_repairing_details`
--
ALTER TABLE `tbl_vehicle_repairing_details`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `vehiclewise_document`
--
ALTER TABLE `vehiclewise_document`
  MODIFY `code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
