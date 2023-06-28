-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Jun 2023 pada 07.45
-- Versi server: 8.0.30
-- Versi PHP: 8.2.3

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
-- Struktur dari tabel `form_input`
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
-- Dumping data untuk tabel `form_input`
--

INSERT INTO `form_input` (`id`, `nama`, `deskripsi`, `konten`, `img`, `select`, `select_search`, `select_multiple`, `checkbox`, `radio`, `created_at`, `updated_at`) VALUES
(6, 'Yoii', 'asd', '<p>asdasdasd</p>', '1678746388_c31c13d25e0fc9029024.png', 'Perempuan', 'Satu', '[\"Tiga\",\"Delapan\"]', '[\"checkbox 2\",\"checkbox 3\"]', 'radio 1', '2023-01-17 11:27:45', '2023-03-14 05:26:28'),
(7, 'Form  duaa', 'lorem lorem lorem', '<p>halo asek serrr</p><ul><li>list satu</li><li>list dua</li></ul>', '1677678567_ca0462454b23b1adf959.jpg', 'Laki-laki', 'Enam', '[\"Empat\",\"Tujuh\"]', '[\"checkbox 1\",\"checkbox 2\"]', 'radio 2', '2023-01-17 19:48:22', '2023-03-08 06:27:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Superadmin'),
(3, 'Pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `screening`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `id_role` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_role`, `nama`, `username`, `password`, `img`, `jenis_kelamin`, `usia`, `riwayat_diabetes`, `riwayat_alkohol`, `riwayat_merokok`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin', 'superadmin', '6c6bbee91bae132c37f1fd88be269a80e8b7ca09436ae3f7d342d6599413b5760b26da25277ae56bbe027a35f1838c8dc4be34d0243e75da17090b27588e31a0', '1687935765_f8a5226117685ce7b22c.png', 'Laki-laki', '22', '', '', '', '2022-10-21 14:14:28', '2023-06-28 14:02:45'),
(13, 3, 'pasien', 'pasien', '6c6bbee91bae132c37f1fd88be269a80e8b7ca09436ae3f7d342d6599413b5760b26da25277ae56bbe027a35f1838c8dc4be34d0243e75da17090b27588e31a0', '', '', '', '', '', '', '2023-06-28 14:39:31', '2023-06-28 14:39:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `form_input`
--
ALTER TABLE `form_input`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `form_input`
--
ALTER TABLE `form_input`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `screening`
--
ALTER TABLE `screening`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
