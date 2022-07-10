-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2022 at 05:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjadwalan_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`) VALUES
(1, 'Bagian Umum dan Kepegawaian'),
(2, 'Bagian Perencanaan dan Pelaporan'),
(3, 'Bagian Keuangan'),
(4, 'Bidang Pengelolaan Informasi Publik'),
(5, 'Bidang Pengelolaan Komunikasi Publik'),
(6, 'Bidang Teknologi, Informasi, dan Komunikasi'),
(7, 'Bidang Persandian');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(24, '2022_02_03_143032_create_divisions_table', 1),
(25, '2022_02_03_144023_create_roles_table', 1),
(26, '2022_02_03_144327_create_notes_table', 1),
(27, '2022_02_03_144353_create_schedules_table', 1),
(28, '2022_05_12_134924_create_rooms_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Petugas'),
(3, 'Peminjam');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`) VALUES
(1, 'Command Room'),
(6, 'Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL,
  `user_borrower_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) NOT NULL,
  `requested_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `date`, `start`, `end`, `description`, `status`, `user_borrower_id`, `room_id`, `requested_at`, `approved_at`, `created_at`, `updated_at`) VALUES
(19, '2022-06-06', '11:02:23', '11:07:00', 'Rapat Uji Coba Aplikasi XYZ', 4, 3, 1, '2022-06-04 11:32:17', '2022-06-05 20:38:43', NULL, '2022-06-05 12:00:24'),
(25, '2022-06-08', '13:00:00', '15:00:00', 'Rapat Damamaya', 4, 3, 1, '2022-06-06 11:09:57', '2022-06-06 14:50:59', NULL, NULL),
(27, '2022-06-11', '09:00:00', '11:00:00', 'Rapat Koordinasi', 4, 3, 1, '2022-06-10 10:42:50', '2022-06-10 10:44:20', NULL, NULL),
(32, '2022-06-16', '09:00:00', '11:00:00', 'Rapat Evaluasi', 4, 3, 1, NULL, '2022-06-15 20:55:07', '2022-06-15 12:52:17', NULL),
(56, '2022-06-27', '09:36:38', '09:41:00', 'Rapat Review Aplikasi ABC', 4, 3, 1, '2022-06-27 09:22:57', '2022-06-27 09:24:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(2) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `phone`, `gender`, `role_id`, `division_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Putu Arie Suastra', 'ariesetiadi.sm@gmail.com', '$2y$10$4Grk797eEQ9JjrY.xT64kuB3fvtYwlyHRMWnxbtGGwuuBZth03h56', '082146335727', 'Pria', 1, 4, 1, NULL, '2022-05-13 07:34:36', '2022-05-13 07:34:36'),
(2, 'petugas', 'Made Suastra', 'ariesetiadi.wr@gmail.com', '$2y$10$GXqA3afWz8y15M4GwlXYA.KZfmv5aYleweoEp/NrE0QQN1BIeyhbW', '089671800585', 'Wanita', 2, 5, 1, 'rTgN59snmZ47J2O2VvzPlRaqCz6qcyv2hnKz57xtNES3bkA3v9SsotNzPN0s', '2022-05-13 07:34:36', '2022-05-26 16:21:25'),
(3, 'peminjam', 'Nyoman Setiadi', 'ariesetiadi.bn@gmail.com', '$2y$10$T7lFPu2f2DslyKYFat7uoeH.jQNWWSz1GXsFTCDMZNa4FAB9EyWmm', '089671800585', 'Pria', 3, 6, 1, 'XkfKoZP6vTLdrsDoNcJt3jcMEFMa0MDEhROzfmv3aV8NVqoY4HFlAIAIRvUb', '2022-05-13 07:34:37', '2022-07-10 15:37:25'),
(4, 'peminjam2', 'Peminjam 2', 'ariesetiadi.edu@gmail.com', '$2y$10$rFfidxRw1ZeXo8acudGy.OSCwGYW23eg/seKHNy1UWYw555vqrLo6', '082146335727', 'Pria', 3, 3, 1, NULL, '2022-05-24 14:01:52', '2022-06-16 14:20:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
