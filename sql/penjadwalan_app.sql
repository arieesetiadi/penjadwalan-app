-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2022 pada 14.50
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

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
-- Struktur dari tabel `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divisions`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `notes`
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

--
-- Dumping data untuk tabel `notes`
--

INSERT INTO `notes` (`id`, `title`, `content_file`, `content_image`, `content_text`, `schedule_id`, `created_at`) VALUES
(11, 'Notulen Rapat Review Aplikasi ABC', '1657506626_02 menyusun latar belakang.pdf|1657506626_rancangan basis data - tugas akhir 180030048 r1.docx|', '1657506625_screenshot (70).png|1657506626_screenshot (71).png|', '<p>Ini adalah isi notulen dalam bentuk text</p>', 56, '2022-07-11 02:30:26'),
(12, 'Notulen Rapat Uji Coba Aplikasi E', '1658811488_final website damamaya.txt|1658811488_materi presentasi.pptx|', '1658811488_photo_2022-07-11_11-22-40-min.jpg|1658811488_photo_2022-07-11_11-22-49-min.jpg|', '<p>Isi notulen dalam bentuk text</p>', 108, '2022-07-26 04:58:08'),
(13, 'Notulen Rapat Koordinasi', '1658838834_final website damamaya.txt|1658838834_materi presentasi.pptx|', '1658838834_photo_2022-07-11_11-22-40-min.jpg|1658838834_photo_2022-07-11_11-22-49-min.jpg|', '<p>Ini adalah isi notulen dalam bentuk text</p>', 27, '2022-07-26 12:33:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Petugas'),
(3, 'Peminjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `status`) VALUES
(1, 'Command Room', 1),
(6, 'Multimedia', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
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
-- Dumping data untuk tabel `schedules`
--

INSERT INTO `schedules` (`id`, `date`, `start`, `end`, `description`, `status`, `user_borrower_id`, `room_id`, `requested_at`, `approved_at`, `created_at`, `updated_at`) VALUES
(19, '2022-07-06', '11:02:23', '11:07:00', 'Rapat Uji Coba Aplikasi XYZ', 4, 3, 1, '2022-06-04 11:32:17', '2022-06-05 20:38:43', NULL, '2022-06-05 12:00:24'),
(25, '2022-07-08', '13:00:00', '15:00:00', 'Rapat Damamaya', 4, 3, 1, '2022-06-06 11:09:57', '2022-06-06 14:50:59', NULL, NULL),
(27, '2022-07-11', '09:00:00', '11:00:00', 'Rapat Koordinasi', 4, 3, 1, '2022-06-10 10:42:50', '2022-06-10 10:44:20', NULL, NULL),
(56, '2022-06-27', '09:36:38', '09:41:00', 'Rapat Review Aplikasi ABC', 4, 3, 1, '2022-06-27 09:22:57', '2022-06-27 09:24:16', NULL, NULL),
(106, '2022-07-26', '20:40:15', '20:45:00', 'Rapat Uji Coba Aplikasi C', 4, 3, 1, '2022-07-24 22:25:50', '2022-07-26 20:20:12', NULL, NULL),
(107, '2022-07-29', '13:00:00', '15:00:00', 'Rapat Uji Coba Aplikasi D', 1, 3, 1, '2022-07-24 22:25:50', NULL, NULL, '2022-07-26 12:27:24'),
(108, '2022-07-26', '10:00:00', '10:30:00', 'Rapat Uji Coba Aplikasi E', 4, 3, 1, '2022-07-24 22:25:50', '2022-07-25 22:25:50', NULL, NULL),
(109, '2022-07-27', '11:00:00', '13:00:00', 'Rapat Uji Coba Aplikasi F', 2, 3, 1, '2022-07-24 22:25:50', '2022-07-25 22:25:50', NULL, NULL),
(110, '2022-07-28', '13:00:00', '15:00:00', 'Rapat Sidang Terbuka', 2, 3, 1, '2022-07-26 08:15:24', '2022-07-26 08:28:24', NULL, NULL),
(111, '2022-07-28', '09:00:00', '11:00:00', 'b', 2, 3, 6, NULL, '2022-07-26 13:05:29', '2022-07-26 05:03:58', '2022-07-26 05:05:29'),
(112, '2022-07-26', '22:00:00', '23:00:00', 'v', 2, 3, 1, NULL, NULL, '2022-07-26 12:02:22', '2022-07-26 12:02:40'),
(113, '2022-07-28', '11:00:00', '13:00:00', 'Rapat Sidang Tugas Akhir', 1, 3, 1, '2022-07-26 20:16:28', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
  `status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `phone`, `gender`, `role_id`, `division_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Putu Arie Suastra', 'ariesetiadi.sm@gmail.com', '$2y$10$4Grk797eEQ9JjrY.xT64kuB3fvtYwlyHRMWnxbtGGwuuBZth03h56', '082146335727', 'Pria', 1, 4, 1, NULL, '2022-05-13 07:34:36', '2022-05-13 07:34:36'),
(2, 'petugas', 'Made Suastra', 'ariesetiadi.wr@gmail.com', '$2y$10$GXqA3afWz8y15M4GwlXYA.KZfmv5aYleweoEp/NrE0QQN1BIeyhbW', '089671800585', 'Wanita', 2, 5, 1, '4B2N2CW5zywazQclhjzF5zryy5i4EfSwr5R1mdm01OFIROY1cVb8mloonQKc', '2022-05-13 07:34:36', '2022-05-26 16:21:25'),
(3, 'peminjam', 'Nyoman Setiadi', 'ariesetiadi.bn@gmail.com', '$2y$10$T7lFPu2f2DslyKYFat7uoeH.jQNWWSz1GXsFTCDMZNa4FAB9EyWmm', '089671800585', 'Pria', 3, 6, 1, 'TC4tlHbL0Az5vbjeC6tu2EcP1Hy42sZaVROWzvlY5Gv5wuiiDhB5dgoggN21', '2022-05-13 07:34:37', '2022-07-11 02:35:33'),
(4, 'peminjam2', 'Peminjam 2', 'ariesetiadi.edu@gmail.com', '$2y$10$rFfidxRw1ZeXo8acudGy.OSCwGYW23eg/seKHNy1UWYw555vqrLo6', '082146335727', 'Pria', 3, 3, 1, NULL, '2022-05-24 14:01:52', '2022-06-16 14:20:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
