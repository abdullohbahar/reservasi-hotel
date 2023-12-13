-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2023 at 05:45 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasi_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id` bigint UNSIGNED NOT NULL,
  `no_kamar` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kamar_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id`, `no_kamar`, `tipe_kamar_id`, `created_at`, `updated_at`) VALUES
(3, '21', 3, '2023-12-05 00:42:05', '2023-12-05 00:42:05'),
(4, '12', 4, '2023-12-05 19:55:20', '2023-12-05 19:55:20'),
(5, '90', 3, '2023-12-05 20:05:33', '2023-12-05 20:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_11_24_140337_create_resepsionis_table', 1),
(5, '2023_11_24_142939_create_tipe_kamars_table', 1),
(6, '2023_11_24_142940_create_kamars_table', 1),
(7, '2023_12_03_193653_create_tamus_table', 1),
(8, '2023_12_03_193654_create_reservasis_table', 1),
(9, '2023_12_03_194052_create_transaksis_table', 1),
(10, '2023_12_03_194216_create_admins_table', 1),
(11, '2023_12_06_023017_add_kamar_id_to_reservasis_table', 2),
(12, '2023_12_07_232335_add_bukti_pembayaran_to_transaksi_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resepsionis`
--

CREATE TABLE `resepsionis` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resepsionis`
--

INSERT INTO `resepsionis` (`id`, `nik`, `nama`, `alamat`, `no_wa`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, '1234567890123456', 'BAHARUDIN ABDULLOH M', 'Blawong 1, Trimulyo, Jetis', '0581234', 'resepsionis1@gmail.com', '$2y$10$EFPbj6diIkWDweEk4r0v9uRGwldT5PtLQF6p3XQdTajs3NQlcU2WC', '2023-12-05 00:59:44', '2023-12-05 00:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `reservasis`
--

CREATE TABLE `reservasis` (
  `id` bigint UNSIGNED NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `status` enum('free','pending','full','cancel','menunggu pembayaran','tolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `no_booking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kamar_id` bigint UNSIGNED DEFAULT NULL,
  `tamu_id` bigint UNSIGNED DEFAULT NULL,
  `resepsionis_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kamar_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasis`
--

INSERT INTO `reservasis` (`id`, `checkin`, `checkout`, `status`, `alasan`, `no_booking`, `tipe_kamar_id`, `tamu_id`, `resepsionis_id`, `created_at`, `updated_at`, `kamar_id`) VALUES
(13, '2023-12-01', '2023-12-31', 'free', '', '01/11/12/2023', 3, 3, NULL, '2023-12-11 00:32:01', '2023-12-11 03:12:13', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tamus`
--

CREATE TABLE `tamus` (
  `id` bigint UNSIGNED NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tamus`
--

INSERT INTO `tamus` (`id`, `gambar`, `nik`, `nama`, `alamat`, `email`, `password`, `no_wa`, `created_at`, `updated_at`) VALUES
(2, 'Profil.jpeg', '3404021310050001', 'Silvia Wijayanti 123', '-', 'heathcote.cyrus@cremin.com', '$2y$10$AG.Ovnm0f5rDTp0Im7C23Ov/53TLJFrHfEa9EB4QklPK4cPGGiWEG', '12321', '2023-12-03 21:32:51', '2023-12-03 21:32:51'),
(3, 'image/kamar/084208.png', '1234', 'Tamu Pertama 123', 'sini', 'tamu2@gmail.com', '$2y$10$qBDlDRbNiiRMaxmrNKd5IeZ9WHS18oSc.nGtCi2vQ8MVIlX2VUPm.', '08570123', '2023-12-05 01:00:51', '2023-12-05 01:42:08'),
(4, 'Profile.jpeg', '3404021310050001', 'BAHARUDIN ABDULLOH M', '-', 'abdullohbahar@gmail.com', '$2y$10$6qbKPIoOzd17yE1TBs66UurQre8NjSEgz/MsjvOoxopUId7XABLCq', '0581234', '2023-12-05 19:35:18', '2023-12-05 19:35:18'),
(5, 'Profile.jpeg', '3404021310050001', 'BAHARUDIN ABDULLOH M', '-', 'abdullohbahar@gmail.com', '$2y$10$PuV2rL8NIzi4RqI2q/NjF.N7NQbgh3djfJXolQUcjBTI8o1AYfwY.', '0581234', '2023-12-05 19:51:47', '2023-12-05 19:51:47'),
(6, 'Profile.jpeg', '3404021310050001', 'Silvia Wijayanti 123', '-', 'abdullohbahar@gmail.com', '$2y$10$o5h371Osf8.g9RfQP.mJm.MRjikc5BhMa3W1S1KZNRrMRWtmtCoQW', '123214', '2023-12-05 21:58:50', '2023-12-05 21:58:50'),
(7, 'Profile.jpeg', '3404021310050001', 'Silvia Wijayanti 123', '-', 'abdullohbahar@gmail.com', '$2y$10$kuEhMCy3iH9e3L/z6NGH1.5cCxaEH65wmvdCc4iwJ92rxm/W3gTOu', '123214', '2023-12-05 21:59:19', '2023-12-05 21:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamars`
--

CREATE TABLE `tipe_kamars` (
  `id` bigint UNSIGNED NOT NULL,
  `tipe_kamar` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipe_kamars`
--

INSERT INTO `tipe_kamars` (`id`, `tipe_kamar`, `harga`, `fasilitas`, `gambar`, `created_at`, `updated_at`) VALUES
(3, 'tipe 1', 1000000, 'ada', 'image/kamar/074159.png', '2023-12-05 00:41:59', '2023-12-05 00:41:59'),
(4, 'kamar 123', 900000, 'ya ini lah', 'image/kamar/025455.jpeg', '2023-12-05 19:54:55', '2023-12-05 19:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservasi_id` bigint UNSIGNED DEFAULT NULL,
  `tamu_id` bigint UNSIGNED DEFAULT NULL,
  `bukti_pembayaran` text COLLATE utf8mb4_unicode_ci,
  `status_pembayaran` enum('pending','dibayar','menunggu pembayaran','tolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `tgl_transaksi`, `metode_pembayaran`, `total_biaya`, `reservasi_id`, `tamu_id`, `bukti_pembayaran`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(9, '2023-12-11', 'BCA', '1000000', 13, 3, 'image/bukti-pembayaran/091453.jpeg', 'dibayar', '2023-12-11 00:32:01', '2023-12-11 02:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkin` date DEFAULT NULL,
  `checkout` date DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_biaya` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kamars_tipe_kamar_id_foreign` (`tipe_kamar_id`);

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
-- Indexes for table `resepsionis`
--
ALTER TABLE `resepsionis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservasis_tipe_kamar_id_foreign` (`tipe_kamar_id`),
  ADD KEY `reservasis_tamu_id_foreign` (`tamu_id`),
  ADD KEY `reservasis_resepsionis_id_foreign` (`resepsionis_id`),
  ADD KEY `reservasis_kamar_id_foreign` (`kamar_id`);

--
-- Indexes for table `tamus`
--
ALTER TABLE `tamus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_kamars`
--
ALTER TABLE `tipe_kamars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_reservasi_id_foreign` (`reservasi_id`),
  ADD KEY `transaksis_tamu_id_foreign` (`tamu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamars`
--
ALTER TABLE `kamars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `resepsionis`
--
ALTER TABLE `resepsionis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservasis`
--
ALTER TABLE `reservasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tamus`
--
ALTER TABLE `tamus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tipe_kamars`
--
ALTER TABLE `tipe_kamars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kamars`
--
ALTER TABLE `kamars`
  ADD CONSTRAINT `kamars_tipe_kamar_id_foreign` FOREIGN KEY (`tipe_kamar_id`) REFERENCES `tipe_kamars` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD CONSTRAINT `reservasis_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamars` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservasis_resepsionis_id_foreign` FOREIGN KEY (`resepsionis_id`) REFERENCES `resepsionis` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservasis_tamu_id_foreign` FOREIGN KEY (`tamu_id`) REFERENCES `tamus` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservasis_tipe_kamar_id_foreign` FOREIGN KEY (`tipe_kamar_id`) REFERENCES `tipe_kamars` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_reservasi_id_foreign` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasis` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksis_tamu_id_foreign` FOREIGN KEY (`tamu_id`) REFERENCES `tamus` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
