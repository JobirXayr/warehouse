-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 05, 2023 at 08:51 AM
-- Server version: 5.6.47
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_03_02_223904_create_products_table', 1),
(5, '2023_03_02_230337_create_stocks_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'Продукты питания/напитки', NULL, '2023-03-02 17:56:48', '2023-03-02 17:56:48'),
(2, 0, 'Автомобили', NULL, '2023-03-02 17:57:13', '2023-03-02 17:57:13'),
(3, 0, 'Одежда и обувь', NULL, '2023-03-02 17:57:22', '2023-03-02 17:57:22'),
(4, 0, 'Мобильные телефоны', NULL, '2023-03-02 17:57:33', '2023-03-02 17:57:33'),
(5, 0, 'Мебель и хозтовары', NULL, '2023-03-02 17:57:45', '2023-03-02 17:57:45'),
(6, 0, 'Средства по уходу за собой', NULL, '2023-03-02 17:57:53', '2023-03-02 17:57:53'),
(7, 0, 'Лекарства', NULL, '2023-03-02 17:58:00', '2023-03-02 17:58:00'),
(8, 0, 'Бытовая, видео и аудиотехника', NULL, '2023-03-02 17:58:07', '2023-03-03 00:27:42'),
(9, 0, 'Телеканалы', NULL, '2023-03-02 17:58:17', '2023-03-02 17:58:17'),
(10, 0, 'Интернет-сервисы/сайты', NULL, '2023-03-02 17:58:24', '2023-03-02 17:58:24'),
(11, 0, 'Алкогольные напитки', NULL, '2023-03-02 17:58:30', '2023-03-02 17:58:30'),
(12, 0, 'Товары для спорта', NULL, '2023-03-02 17:58:41', '2023-03-02 17:58:41'),
(13, 0, 'Товары для детей', NULL, '2023-03-02 17:58:48', '2023-03-02 17:58:48'),
(21, 1, 'Колбаса', NULL, '2023-03-04 04:05:21', '2023-03-04 04:05:21'),
(22, 1, 'Пармезан', NULL, '2023-03-04 04:05:43', '2023-03-04 04:05:43'),
(23, 3, 'Левый носок', NULL, '2023-03-04 04:06:21', '2023-03-04 04:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supply_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `price` double NOT NULL,
  `supply_order` tinyint(4) NOT NULL,
  `day` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `category_id`, `product_id`, `supply_number`, `order_number`, `amount`, `price`, `supply_order`, `day`, `created_at`, `updated_at`) VALUES
(1, 1, 21, '1', NULL, 300, 5000, 1, '2021-01-01', '2023-03-03 23:19:33', '2023-03-03 23:19:33'),
(3, 3, 23, '12-TP-777', NULL, 100, 500, 1, '2021-01-13', '2023-03-03 23:22:03', '2023-03-03 23:22:03'),
(4, 3, 23, '12-TP-778', NULL, 50, 300, 1, '2021-01-14', '2023-03-03 23:26:32', '2023-03-03 23:36:02'),
(5, 3, 23, '12-TP-779', NULL, 77, 539, 1, '2021-01-20', '2023-03-03 23:40:56', '2023-03-03 23:40:56'),
(6, 3, 23, '12-TP-877', NULL, 32, 176, 1, '2021-01-30', '2023-03-03 23:41:30', '2023-03-03 23:41:30'),
(7, 3, 23, '12-TP-977', NULL, 94, 554, 1, '2021-02-01', '2023-03-03 23:41:58', '2023-03-03 23:41:58'),
(8, 3, 23, '12-TP-979', NULL, 200, 1000, 1, '2021-02-05', '2023-03-03 23:42:30', '2023-03-03 23:42:30'),
(9, 1, 21, '1', 'ON-1', 200, 6500, -1, '2021-01-06', '2023-03-03 23:19:33', '2023-03-04 10:00:39'),
(10, 3, 23, '12-TP-779', 'ON-2', 60, 65, -1, '2021-01-07', '2023-03-03 23:19:33', '2023-03-05 05:48:10'),
(12, 0, 1, 't-500', NULL, 10, 6000, 1, '2021-03-17', '2023-03-05 03:30:52', '2023-03-05 04:41:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
