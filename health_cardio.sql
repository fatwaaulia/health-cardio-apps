-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2023 at 12:38 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_cardio`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_input`
--

CREATE TABLE `form_input` (
  `id` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `konten` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `select` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `select_search` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `select_multiple` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `checkbox` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `radio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_input`
--

INSERT INTO `form_input` (`id`, `nama`, `deskripsi`, `konten`, `img`, `select`, `select_search`, `select_multiple`, `checkbox`, `radio`, `created_at`, `updated_at`) VALUES
(6, 'Yoii', 'asd', '<p>asdasdasd</p>', '1678746388_c31c13d25e0fc9029024.png', 'Perempuan', 'Satu', '[\"Tiga\",\"Delapan\"]', '[\"checkbox 2\",\"checkbox 3\"]', 'radio 1', '2023-01-17 11:27:45', '2023-03-14 05:26:28'),
(7, 'Form  duaa', 'lorem lorem lorem', '<p>halo asek serrr</p><ul><li>list satu</li><li>list dua</li></ul>', '1677678567_ca0462454b23b1adf959.jpg', 'Laki-laki', 'Enam', '[\"Empat\",\"Tujuh\"]', '[\"checkbox 1\",\"checkbox 2\"]', 'radio 2', '2023-01-17 19:48:22', '2023-03-08 06:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'Pasien');

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `skor_jenis_kelamin` int DEFAULT NULL,
  `usia` int NOT NULL,
  `skor_usia` int DEFAULT NULL,
  `tinggi_badan` int NOT NULL,
  `berat_badan` int NOT NULL,
  `indeks_massa_tubuh` double NOT NULL,
  `skor_indeks_massa_tubuh` int DEFAULT NULL,
  `tekanan_darah` varchar(10) NOT NULL,
  `skor_tekanan_darah` int DEFAULT NULL,
  `denyut_jantung` int NOT NULL,
  `riwayat_merokok` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `skor_riwayat_merokok` int DEFAULT NULL,
  `riwayat_alkohol` varchar(10) NOT NULL,
  `riwayat_diabetes` varchar(10) NOT NULL,
  `skor_riwayat_diabetes` int DEFAULT NULL,
  `aktivitas_fisik` varchar(20) NOT NULL,
  `skor_aktivitas_fisik` int DEFAULT NULL,
  `total_skor` int DEFAULT NULL,
  `risiko` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `screening`
--

INSERT INTO `screening` (`id`, `id_user`, `jenis_kelamin`, `skor_jenis_kelamin`, `usia`, `skor_usia`, `tinggi_badan`, `berat_badan`, `indeks_massa_tubuh`, `skor_indeks_massa_tubuh`, `tekanan_darah`, `skor_tekanan_darah`, `denyut_jantung`, `riwayat_merokok`, `skor_riwayat_merokok`, `riwayat_alkohol`, `riwayat_diabetes`, `skor_riwayat_diabetes`, `aktivitas_fisik`, `skor_aktivitas_fisik`, `total_skor`, `risiko`, `deskripsi`, `created_at`, `updated_at`) VALUES
(6, 7, 'Laki-laki', 1, 25, 4, 171, 59, 20.21, 0, '115/84', NULL, 78, 'Tidak pernah', 0, 'Tidak', 'Tidak', 0, 'Ringan', 1, 6, 'Risiko tinggi', '', '2023-04-06 08:41:59', '2023-04-08 08:41:59'),
(7, 7, 'Laki-laki', 1, 25, 4, 171, 60, 20.55, 0, '110/82', 0, 77, 'Tidak pernah', 0, 'Tidak', 'Tidak', 0, 'Berat', -3, 2, 'Risiko sedang', '', '2023-04-07 09:13:13', '2023-04-09 03:13:13'),
(9, 7, 'Laki-laki', 1, 25, 4, 171, 62, 21.23, 0, '115/83', 0, 70, 'Tidak pernah', 0, 'Tidak', 'Tidak', 0, 'Berat', -3, 2, 'Risiko sedang', '', '2023-04-08 11:09:06', '2023-04-09 11:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `id_role` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usia` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `riwayat_diabetes` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `riwayat_alkohol` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `riwayat_merokok` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `nama`, `email`, `password`, `img`, `jenis_kelamin`, `usia`, `riwayat_diabetes`, `riwayat_alkohol`, `riwayat_merokok`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin', 'superadmin@gmail.com', '6c6bbee91bae132c37f1fd88be269a80e8b7ca09436ae3f7d342d6599413b5760b26da25277ae56bbe027a35f1838c8dc4be34d0243e75da17090b27588e31a0', '1678345377_a947ce34bc1335dbaeec.jpg', 'Laki-laki', '22', '', '', '', '2022-10-21 14:14:28', '2023-04-01 20:31:21'),
(2, 2, 'Admin', 'admin@gmail.com', '6c6bbee91bae132c37f1fd88be269a80e8b7ca09436ae3f7d342d6599413b5760b26da25277ae56bbe027a35f1838c8dc4be34d0243e75da17090b27588e31a0', '', 'Laki-laki', '', '', '', '', '2023-01-06 13:41:51', '2023-03-31 08:11:55'),
(7, 3, 'Fatwa Aulia', 'fatwaaulia.fy@gmail.com', '6c6bbee91bae132c37f1fd88be269a80e8b7ca09436ae3f7d342d6599413b5760b26da25277ae56bbe027a35f1838c8dc4be34d0243e75da17090b27588e31a0', '1678344611_24fbd0c5fe6c0ac00418.jpg', 'Laki-laki', '25', 'Tidak', 'Tidak', 'Tidak pernah', '2023-01-13 16:13:31', '2023-04-06 14:21:58'),
(8, 3, 'Senyum', 'senyum@gmail.com', '6c6bbee91bae132c37f1fd88be269a80e8b7ca09436ae3f7d342d6599413b5760b26da25277ae56bbe027a35f1838c8dc4be34d0243e75da17090b27588e31a0', '', 'Laki-laki', '25', '', '', '', '2023-03-28 05:15:01', '2023-03-28 07:24:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_input`
--
ALTER TABLE `form_input`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_input`
--
ALTER TABLE `form_input`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
