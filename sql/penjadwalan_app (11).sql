-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 09:30 AM
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
(27, '2022_02_03_144353_create_schedules_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_file` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `content_file`, `content_image`, `content_text`, `schedule_id`, `created_at`) VALUES
(1, 'Notulen Rapat review aplikasi Damamaya', NULL, NULL, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia deleniti similique hic non aliquam! Minus est ratione, mollitia harum repudiandae impedit dolor doloribus repellendus atque non hic animi eaque ex, fugit, sapiente placeat tempore neque illo consectetur aliquid tenetur! Tempora quasi illum modi optio, dolorum laborum accusamus voluptatibus sit impedit praesentium hic numquam voluptate, quae labore reprehenderit rem blanditiis unde eveniet quisquam atque obcaecati! Alias voluptatibus unde quos officiis nulla sint aperiam ad impedit architecto quisquam placeat doloremque, natus est dolores dolorem. Beatae, unde eum sequi suscipit laborum placeat assumenda voluptatem soluta, enim nam, hic culpa? Repellat cumque libero ratione.', 3, '2022-04-01 14:43:12'),
(2, 'Notulen Rapat uji coba aplikasi 3', '1648824881_contoh surat keterangan orang tua (final).docx', '1648824881_map.png', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex consectetur deleniti vitae qui explicabo dolorem ab nostrum quidem, autem accusantium, libero, id quo adipisci consequatur ut aliquid vero reprehenderit molestiae.', 1, '2022-04-01 14:54:41'),
(5, 'Notulen Rapat Penting', '1649044914_bab i-iv aditya wiguna new11 ttd pengesahan.pdf', '1649044914_untitled-1_thumb900.jpg', '->attach(public_path(\'uploaded\\files\\\\\') . $this->fileName)', 5, '2022-04-04 04:01:54');

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
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_borrower_id` bigint(20) UNSIGNED NOT NULL,
  `requested_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `date`, `start`, `end`, `description`, `status`, `user_borrower_id`, `requested_at`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, '2022-03-26', '19:00:00', '20:39:00', 'Rapat uji coba aplikasi 3', 'finish', 3, '2022-03-26 12:53:48', '2022-03-26 18:28:19', NULL, '2022-03-26 10:25:26'),
(3, '2022-03-27', '18:47:44', '19:00:00', 'Rapat review aplikasi Damamaya', 'finish', 3, '2022-03-26 18:10:26', '2022-03-27 18:01:42', NULL, NULL),
(5, '2022-04-02', '13:00:00', '15:00:00', 'Rapat Penting', 'finish', 3, '2022-04-01 10:11:03', '2022-04-01 15:13:07', NULL, NULL),
(6, '2022-04-02', '15:00:00', '16:00:00', 'Test', 'pending', 3, '2022-04-01 10:12:04', NULL, NULL, NULL),
(7, '2022-04-05', '09:00:00', '11:00:00', 'Pentingg', 'active', 3, '2022-04-04 12:51:34', '2022-04-04 13:22:04', NULL, NULL);

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `phone`, `gender`, `role_id`, `division_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'ariesetiadi.sm@gmail.com', '$2y$10$9zhBgSoUAtQT4h85z3KpN.M9pVMyDe7QT3iJ/jsqRlLN/.Bx9Pkua', '082146335727', 'Pria', 1, 4, 'zZpTzHBTYAEEdheQkfBOGOpDJJbthWFuOWhp8OfuFt5wkm2nLr35zE4AWijk', '2022-02-03 08:11:23', '2022-02-21 03:33:17'),
(2, 'petugas', 'Petugas', 'ariesetiadi.wr@gmail.com', '$2y$10$UxbmkPwJFyale3SpOHorZ.5vpoo0AfCe5dCb0xzDrxhS0y1JmDL2u', '089671800585', 'Wanita', 2, 5, 'G0EZzaNEPSSa41S1blcJYWFsZ2fyxuyiTdtxhGLSywJRhvPNog91pKb867uK', '2022-02-03 08:11:23', '2022-02-03 08:11:23'),
(3, 'peminjam', 'Peminjam', 'ariesetiadi.bn@gmail.com', '$2y$10$Cy1XY6Mpls0ct7vCQ0QkreI6jKCeuXu2AD7cgEzciCZj3Gvc3WJey', '089671800585', 'Pria', 3, 6, 'dbuFerjiX9HIo3wRbTR6GXFc5FZQdfeGKuA1urIU1idaFaiSVbr9jPw879R9', '2022-02-03 08:11:23', '2022-02-03 08:11:23');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
