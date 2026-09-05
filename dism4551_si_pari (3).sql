-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 23 Agu 2026 pada 17.10
-- Versi server: 10.11.14-MariaDB-cll-lve
-- Versi PHP: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `dism4551_si_pari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `capaian_program`
--

CREATE TABLE `capaian_program` (
  `id` int(11) NOT NULL,
  `program` varchar(255) NOT NULL,
  `sasaran` varchar(255) NOT NULL,
  `indikator` varchar(255) NOT NULL,
  `target` decimal(20,6) DEFAULT 0.000000,
  `realisasi` decimal(20,6) DEFAULT 0.000000,
  `capaian` decimal(10,4) DEFAULT 0.0000,
  `frekwensi` varchar(50) DEFAULT NULL,
  `sumber_data` varchar(500) DEFAULT NULL,
  `file_sumber` varchar(255) DEFAULT NULL,
  `penanggung_jawab` varchar(255) DEFAULT NULL,
  `tahun` varchar(4) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `capaian_program`
--

INSERT INTO `capaian_program` (`id`, `program`, `sasaran`, `indikator`, `target`, `realisasi`, `capaian`, `frekwensi`, `sumber_data`, `file_sumber`, `penanggung_jawab`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-Rata Lama Kunjungan Wisatawan Mancanegara (Hari)', 2.500000, 1.510000, 60.4000, 'Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2025', '2026-07-23 11:18:04', '2026-08-19 05:48:18'),
(2, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-rata pengeluaran wisatawan mancanegara ($)', 500.000000, 447.120000, 89.4240, 'Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2025', '2026-07-23 11:18:04', '2026-07-28 14:13:08'),
(3, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan Mancanegara (ribu perhari)', 25000.000000, 28165.000000, 112.6600, 'Bulanan / Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pemasaran Pariwisata', '2025', '2026-07-23 11:18:04', '2026-07-28 14:13:08'),
(4, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan Nusantara (juta orang)', 9000000.000000, 11668000.000000, 129.6444, 'Bulanan / Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pemasaran Pariwisata', '2025', '2026-07-23 11:18:04', '2026-07-28 14:13:08'),
(5, 'Program Ekonomi Kreatif Melalui Pemanfaatan Dan Perlindungan Hak Kekayaan Intelektual', 'Meningkatnya Proporsi PDRB Ekonomi Kreatif Terhadap ADHB', 'Nilai Tambah Ekonomi Kreatif (Rp)', 150.000000, 13281.700000, 8854.4667, 'Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pengembangan Ekonomi Kreatif', '2025', '2026-07-23 11:18:04', '2026-08-19 05:47:58'),
(6, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah tenaga Kerja Pariwisata (orang)', 8418.000000, 84570.000000, 1004.6329, 'Tahunan', 'https://sulteng.bps.go.id/id/pressrelease/2025/11/05/1394/agustus-2025--tingkat-pengangguran-terbuka--tpt--sebesar-2-92-persen--tingkat-partisipasi-angkatan-kerja--tpak--sebesar-72-40-persen.html', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-07-23 11:18:04', '2026-08-18 13:38:10'),
(7, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja Ekonomi Kreatif (orang)', 2338.000000, 2919.000000, 124.8503, 'Tahunan', 'https://drive.google.com/file/d/18gCxgfLZPxH9FnIhcS9WenZbWrf6A5qe/view?usp=sharing', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-07-23 11:18:04', '2026-07-25 18:11:51'),
(8, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata tersertifikasi (orang)', 100.000000, 60.000000, 60.0000, 'Tahunan', 'https://www.pariwisata.sultengprov.go.id/images/2026/04SDM/REKAP_PELATIHAN_DAN_SERTIFIKASI_PAREKRAF_SULTENG.pdf', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-07-23 11:18:04', '2026-07-23 11:54:52'),
(9, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Ekonomi Kreatif tersertifikasi (orang)', 100.000000, 61.000000, 61.0000, 'Tahunan', 'https://www.pariwisata.sultengprov.go.id/images/2026/04SDM/REKAP_PELATIHAN_DAN_SERTIFIKASI_PAREKRAF_SULTENG.pdf', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-07-23 11:18:04', '2026-07-23 11:54:52'),
(10, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-Rata Lama Kunjungan Wisatawan Mancanegara (Hari)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(11, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-rata pengeluaran wisatawan mancanegara ($)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(12, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (ribu perhari)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(13, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (juta orang)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(14, 'Program Ekonomi Kreatif Melalui Pemanfaatan Dan Perlindungan Hak Kekayaan Intelektual', 'Meningkatnya Proporsi PDRB Ekonomi Kreatif Terhadap ADHB', 'Nilai Tambah Ekonomi Kreatif (Rp)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Ekonomi Kreatif', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(15, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah tenaga Kerja Pariwisata (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(16, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja Ekonomi Kreatif (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(17, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(18, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Ekonomi Kreatif tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2026', '2026-07-23 11:46:40', '2026-07-23 11:46:44'),
(19, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-Rata Lama Kunjungan Wisatawan Mancanegara (Hari)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(20, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-rata pengeluaran wisatawan mancanegara ($)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(21, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (ribu perhari)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(22, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (juta orang)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(23, 'Program Ekonomi Kreatif Melalui Pemanfaatan Dan Perlindungan Hak Kekayaan Intelektual', 'Meningkatnya Proporsi PDRB Ekonomi Kreatif Terhadap ADHB', 'Nilai Tambah Ekonomi Kreatif (Rp)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Ekonomi Kreatif', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(24, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah tenaga Kerja Pariwisata (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(25, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja Ekonomi Kreatif (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(26, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(27, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Ekonomi Kreatif tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2027', '2026-07-23 11:46:46', '2026-07-23 11:46:52'),
(28, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-Rata Lama Kunjungan Wisatawan Mancanegara (Hari)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(29, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-rata pengeluaran wisatawan mancanegara ($)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(30, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (ribu perhari)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(31, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (juta orang)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(32, 'Program Ekonomi Kreatif Melalui Pemanfaatan Dan Perlindungan Hak Kekayaan Intelektual', 'Meningkatnya Proporsi PDRB Ekonomi Kreatif Terhadap ADHB', 'Nilai Tambah Ekonomi Kreatif (Rp)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Ekonomi Kreatif', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(33, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah tenaga Kerja Pariwisata (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(34, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja Ekonomi Kreatif (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(35, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(36, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Ekonomi Kreatif tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2028', '2026-07-23 11:46:54', '2026-07-23 11:46:58'),
(37, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-Rata Lama Kunjungan Wisatawan Mancanegara (Hari)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(38, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-rata pengeluaran wisatawan mancanegara ($)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(39, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (ribu perhari)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(40, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (juta orang)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(41, 'Program Ekonomi Kreatif Melalui Pemanfaatan Dan Perlindungan Hak Kekayaan Intelektual', 'Meningkatnya Proporsi PDRB Ekonomi Kreatif Terhadap ADHB', 'Nilai Tambah Ekonomi Kreatif (Rp)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Ekonomi Kreatif', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(42, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah tenaga Kerja Pariwisata (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(43, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja Ekonomi Kreatif (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(44, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(45, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Ekonomi Kreatif tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2029', '2026-07-23 11:47:00', '2026-07-23 11:47:03'),
(46, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-Rata Lama Kunjungan Wisatawan Mancanegara (Hari)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(47, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-rata pengeluaran wisatawan mancanegara ($)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(48, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (ribu perhari)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(49, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan mancanegara (juta orang)', 0.000000, 0.000000, 0.0000, 'Bulanan / Tahunan', NULL, NULL, 'BIDANG Pemasaran Pariwisata', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(50, 'Program Ekonomi Kreatif Melalui Pemanfaatan Dan Perlindungan Hak Kekayaan Intelektual', 'Meningkatnya Proporsi PDRB Ekonomi Kreatif Terhadap ADHB', 'Nilai Tambah Ekonomi Kreatif (Rp)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Ekonomi Kreatif', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(51, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah tenaga Kerja Pariwisata (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(52, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja Ekonomi Kreatif (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(53, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08'),
(54, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Ekonomi Kreatif tersertifikasi (orang)', 0.000000, 0.000000, 0.0000, 'Tahunan', NULL, NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2030', '2026-07-23 11:47:05', '2026-07-23 11:47:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_akip`
--

CREATE TABLE `dokumen_akip` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_dokumen` varchar(255) NOT NULL,
  `tipe_konten` enum('file','link') DEFAULT 'file',
  `link_url` varchar(500) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen_akip`
--

INSERT INTO `dokumen_akip` (`id`, `judul`, `deskripsi`, `file_dokumen`, `tipe_konten`, `link_url`, `file_type`, `file_size`, `tahun`, `urutan`, `status`, `created_at`) VALUES
(5, 'RENSTRA 2025-2029', 'Rencana Strategis', '1784528533_RENSTRARevisiDISPAR2025-2029.pdf', 'file', NULL, NULL, NULL, '2026', 1, 'aktif', '2026-07-20 13:22:13'),
(6, 'RENJA 2026 (AWAL)', 'Rencana Kerja', '1784528635_DISPARRENJA2026v3.pdf', 'file', NULL, NULL, NULL, '2026', 2, 'aktif', '2026-07-20 13:23:55'),
(7, 'SK INDIKATOR KINERJA UTAMA 2026', 'Surat Keputusan', '1784529825_SKIKU.pdf', 'file', NULL, '', 0, '2026', 3, 'aktif', '2026-07-20 13:43:45'),
(9, 'DPA 2026 (AWAL)', '', '1784546347_01DPAPenetapan-09Januari.rar', 'file', '', 'rar', 3913918, '2026', 4, 'aktif', '2026-07-20 18:19:07'),
(10, 'SK DEFINISI OPERASIONAL 2026', '', '1784595011_SKDOIKUPROGAMDANKEGIATANDISPAR2026v2.pdf', 'file', NULL, 'pdf', 2400684, '2026', 5, 'aktif', '2026-07-20 18:33:58'),
(11, 'STRUKTUR ORGANISASI DAN TUGAS POKOK', '', '1784547324_StrukturOrganisasidanTugasFungsiDinasPariwisata.pdf', 'file', '', 'pdf', 3507468, '2026', 6, 'aktif', '2026-07-20 18:35:24'),
(12, 'RENCANA AKSI 2026', '', '1784547441_DISPARRENCANAAKSITAHUN2026v3.pdf', 'file', '', 'pdf', 114317, '2026', 7, 'aktif', '2026-07-20 18:37:21'),
(13, 'POHON KINERJA', '', '1784548019_Pohon_Kinerja.pdf', 'file', '', 'pdf', 225851, '2026', 8, 'aktif', '2026-07-20 18:46:59'),
(14, 'CASCADING', '', '1784548272_CASCADING.pdf', 'file', '', 'pdf', 2603292, '2026', 9, 'aktif', '2026-07-20 18:51:12'),
(16, 'CROSSCUTING', '', '1784552400_Cross-Cutting-Dinas-Pariwisata.pdf', 'file', '', 'pdf', 213701, '2026', 10, 'aktif', '2026-07-20 20:00:00'),
(17, 'PERJANJIAN KINERJA 2026 (AWAL)', '', '1784604361_PK2026DISPARv3.pdf', 'file', '', 'pdf', 14489074, '2026', 11, 'aktif', '2026-07-21 10:26:01'),
(18, 'SK TIM KERJA', '', '1784604976_SKTimKerjaDinasPariwisata-digabungkan.pdf', 'file', '', 'pdf', 446280, '2026', 12, 'aktif', '2026-07-21 10:36:16'),
(19, 'SKP PEGAWAI', 'Sasaran kinerja pegawai', '', 'link', 'https://drive.google.com/drive/folders/1Zv4f4zGToAsPaAt2NBRcMs5XxAxehJ36?usp=drive_link', '', 0, '2026', 13, 'aktif', '2026-07-21 10:40:38'),
(20, 'LAKIP TAHUN 2025', 'Laporan Kinerja', '1784605349_DISPAR-Lakip2025LKJrevisi7.pdf', 'file', '', 'pdf', 2275225, '2026', 14, 'aktif', '2026-07-21 10:42:29'),
(21, 'SK PEDOMAN', '', '1784606841_wallpaperwhite.jpg', 'file', '', 'jpg', 24809, '2026', 15, 'aktif', '2026-07-21 11:07:21'),
(22, 'RENCANA TINDAK LANJUT HASIL EVALUASI AKIP TAHUN 2025', '', '1784607353_wallpaperwhite.jpg', 'file', '', 'jpg', 24809, '2026', 16, 'aktif', '2026-07-21 11:15:53'),
(23, 'EVALUASI RENCANA AKSI TAHUN 2026', '', '', 'link', 'https://drive.google.com/drive/folders/1tJo_kSumGMJPAoo72CdsdaqXpGb_eBkG?usp=drive_link', '', 0, '2026', 17, 'aktif', '2026-07-21 11:17:34'),
(25, 'SCREENSHOOT RENSTRA, RENJA, DPA, LAKIP, PK PADA WEBSITE DINAS', '', '1784607779_screenshotwebdokperencanaan.jpg', 'file', '', 'jpg', 91398, '2026', 19, 'aktif', '2026-07-21 11:22:59'),
(27, 'PENGUMPULAN DAN PENGUKURAN CAPAIAN KINERJA APLIKASI CEKIDOT', '', 'https://www.cekidot.dispar.my.id', 'link', 'https://www.cekidot.dispar.my.id', '', 0, '2026', 20, 'aktif', '2026-07-21 11:33:38'),
(28, 'KONITMEN DAN KETERLIBATAN PIMPINAN DALAM PROSES EVALUASI, PERBAIKAN AKIP,PERBAIKAN DOKUMEN KINERJA', '', '1784612521_wallpaperwhite.jpg', 'file', '', 'jpg', 24809, '2026', 21, 'aktif', '2026-07-21 12:42:01'),
(29, 'KONITMEN DAN KETERLIBATAN PIMPINAN DALAM PROSES EVALUASI, PERBAIKAN AKIP,PERBAIKAN DOKUMEN KINERJA', '', '1784614114_wallpaperwhite.jpg', 'file', '', 'jpg', 24809, '2026', 22, 'aktif', '2026-07-21 13:08:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_iki`
--

CREATE TABLE `dokumen_iki` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_dokumen` varchar(255) NOT NULL,
  `tipe_konten` enum('file','link') DEFAULT 'file',
  `link_url` varchar(500) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen_iki`
--

INSERT INTO `dokumen_iki` (`id`, `judul`, `deskripsi`, `file_dokumen`, `tipe_konten`, `link_url`, `file_type`, `file_size`, `tahun`, `urutan`, `status`, `created_at`) VALUES
(1, 'MPH KADIS', 'Matriks Penilaian Peran Hasil', '1784554649_MPHKadis.pdf', 'file', '', 'pdf', 713262, '2026', 1, 'aktif', '2026-07-20 20:37:29'),
(2, 'RENCANA AKSI KADIS', '', '1784554772_RencanaAksiKadis.pdf', 'file', '', 'pdf', 764199, '2026', 2, 'aktif', '2026-07-20 20:39:32'),
(3, 'SKP KADIS', 'Sasaran Kinerja Pegawai', '1785130721_SKPIBUKADIS.pdf', 'file', NULL, 'pdf', 172445, '2026', 3, 'aktif', '2026-07-27 12:38:41'),
(4, 'MPH KABID', 'Matriks Penilaian Peran Hasil', '1785130889_MPHKABID.pdf', 'file', NULL, 'pdf', 53928, '2026', 4, 'aktif', '2026-07-27 12:41:29'),
(5, 'RENCANA AKSI KABID', '', '1785131028_RencanaAksiAktivitasKABID.pdf', 'file', '', 'pdf', 54134, '2026', 5, 'aktif', '2026-07-27 12:43:48'),
(6, 'SKP KABID', 'Sasaran Kinerja Pegawai', '1785131214_SKPKABID2026TTD.pdf', 'file', NULL, 'pdf', 247781, '2026', 6, 'aktif', '2026-07-27 12:46:54'),
(7, 'MPH MAX', 'Matriks Penilaian Peran Hasil', '1785131369_MPHMAX.pdf', 'file', NULL, 'pdf', 42037, '2026', 7, 'aktif', '2026-07-27 12:49:29'),
(8, 'RENCANA AKSI MAX', '', '1785131466_RencanaAksiAktivitasMAX.pdf', 'file', '', 'pdf', 42363, '2026', 8, 'aktif', '2026-07-27 12:51:06'),
(9, 'SKP MAX', 'Sasaran Kinerja Pegawai', '1785131597_SKPMAX2026TTD.pdf', 'file', NULL, 'pdf', 667163, '2026', 9, 'aktif', '2026-07-27 12:53:17'),
(10, 'MPH SUTRISNI', 'Matriks Penilaian Peran Hasil', '1785131840_SKPSATRISNI2026TTD.pdf', 'file', NULL, 'pdf', 279821, '2026', 10, 'aktif', '2026-07-27 12:57:20'),
(11, 'RENCANA AKSI SUTRISNI', '', '1785131957_RencanaAksiAktivitasSATRISNI.pdf', 'file', '', 'pdf', 104607, '2026', 11, 'aktif', '2026-07-27 12:59:17'),
(12, 'SKP NOVIRA', 'Sasaran Kinerja Pegawai', '1785132106_SKPNOVIRA2026TTD.pdf', 'file', NULL, 'pdf', 269851, '2026', 12, 'aktif', '2026-07-27 13:01:46'),
(13, 'SKP YENNY', 'Sasaran Kinerja Pegawai', '1785132131_SKPYENNI2026TTD.pdf', 'file', NULL, 'pdf', 277545, '2026', 13, 'aktif', '2026-07-27 13:02:11'),
(14, 'SK TIM KERJA', 'Surat Keputusan', '1785198604_SKTimKerjaDinasPariwisata.pdf', 'file', '', 'pdf', 446280, '2026', 14, 'aktif', '2026-07-28 07:30:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iku_ekraf`
--

CREATE TABLE `iku_ekraf` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `sektor` varchar(255) NOT NULL,
  `koofisien` decimal(10,2) DEFAULT 0.00,
  `nilai_bps` decimal(15,2) DEFAULT 0.00,
  `jumlah_rp` decimal(20,2) DEFAULT 0.00,
  `hasil_penjumlahan` decimal(20,2) DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tahun` varchar(4) DEFAULT '2025'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `iku_ekraf`
--

INSERT INTO `iku_ekraf` (`id`, `kategori`, `sektor`, `koofisien`, `nilai_bps`, `jumlah_rp`, `hasil_penjumlahan`, `created_at`, `updated_at`, `tahun`) VALUES
(154, 'Ekraf', 'Industri Makanan dan Minuman (C.2)', 0.75, 7240.87, 7240870000000.00, 5430652500000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(155, 'Ekraf', 'Industri Tekstil dan Pakaian Jadi (C.4)', 0.85, 39.96, 39960000000.00, 33966000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(156, 'Ekraf', 'Industri Kulit, Barang dari Kulit, dan Alas Kaki (C.5)', 0.50, 22.05, 22050000000.00, 11025000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(157, 'Ekraf', 'Industri Kayu, Barang dari Kayu dan Gabus; dan Barang Anyaman dari Bambu, Rotan, dan Sejenisnya (C.6)', 0.90, 1778.96, 1778960000000.00, 1601064000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(158, 'Ekraf', 'Industri Kertas dan Barang dari Kertas; Percetakan dan Reproduksi Media Rekaman (C.7)', 0.70, 134.98, 134980000000.00, 94486000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(159, 'Ekraf', 'Industri Furnitur (C.15)', 0.90, 250.83, 250830000000.00, 225747000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(160, 'Ekraf', 'Penyediaan Makan Minum (I.2)', 0.80, 960.48, 960480000000.00, 768384000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(161, 'Ekraf', 'Informasi dan Komunikasi (J)', 0.45, 8231.35, 8231350000000.00, 3704107500000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(162, 'Ekraf', 'Jasa Perusahaan (M,N)', 0.45, 594.38, 594380000000.00, 267471000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025'),
(163, 'Ekraf', 'Jasa Lainnya (R,S,T,U)', 0.60, 1908.08, 1908080000000.00, 1144848000000.00, '2026-07-19 00:49:25', '2026-07-19 00:49:25', '2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iku_infografis`
--

CREATE TABLE `iku_infografis` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tahun` varchar(4) DEFAULT '2025'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `iku_infografis`
--

INSERT INTO `iku_infografis` (`id`, `kategori`, `file_name`, `created_at`, `updated_at`, `tahun`) VALUES
(1, 'Makan Minum', 'infografis_Makan Minum_1784136568.png', '2026-07-07 23:20:24', '2026-07-16 01:29:28', '2025'),
(2, 'Mancanegara', '', '2026-07-07 23:20:24', '2026-07-07 23:20:24', '2025'),
(3, 'Ekraf', 'infografis_Ekraf_1784035509.png', '2026-07-07 23:20:24', '2026-07-14 21:25:09', '2025'),
(4, 'Wisatawan', 'infografis_Wisatawan_1784035349.png', '2026-07-12 15:34:34', '2026-07-14 21:22:29', '2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iku_pdrb`
--

CREATE TABLE `iku_pdrb` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `target` decimal(10,2) DEFAULT 0.00,
  `realitas` decimal(10,2) DEFAULT 0.00,
  `capaian` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tahun` varchar(4) DEFAULT '2025'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `iku_pdrb`
--

INSERT INTO `iku_pdrb` (`id`, `kategori`, `target`, `realitas`, `capaian`, `created_at`, `updated_at`, `tahun`) VALUES
(1, 'Makan Minum', 0.34, 0.31, 91.84, '2026-07-07 19:24:02', '2026-07-16 15:34:55', '2025'),
(2, 'Ekraf', 3.76, 0.00, 0.00, '2026-07-08 15:19:25', '2026-07-19 00:49:25', '2025'),
(3, 'Wisatawan', 25000.00, 28165.00, 112.66, '2026-07-13 03:10:56', '2026-07-19 00:53:09', '2025'),
(4, 'Makan Minum', 0.00, 0.00, 0.00, '2026-07-13 15:55:54', '2026-07-13 16:03:04', '2026'),
(6, 'Wisatawan', 0.00, 0.00, 0.00, '2026-07-13 15:56:13', '2026-07-13 15:56:13', '2026'),
(7, 'Makan Minum', 0.00, 0.00, 0.00, '2026-07-13 16:02:56', '2026-07-13 16:02:56', '2027'),
(8, 'Makan Minum', 0.00, 0.00, 0.00, '2026-07-13 16:03:09', '2026-07-13 16:03:09', '2028'),
(9, 'Wisatawan', 0.00, 0.00, 0.00, '2026-07-13 16:03:12', '2026-07-13 16:03:12', '2028');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iku_penilaian`
--

CREATE TABLE `iku_penilaian` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) DEFAULT 'Makan Minum',
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot` decimal(5,2) DEFAULT 0.00,
  `target` decimal(5,2) DEFAULT 0.00,
  `nilai` decimal(15,2) DEFAULT 0.00,
  `link_sumber` varchar(255) DEFAULT NULL,
  `file_sumber` varchar(255) DEFAULT NULL,
  `realisasi` decimal(5,2) DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `tahun` varchar(4) DEFAULT '2025'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `iku_penilaian`
--

INSERT INTO `iku_penilaian` (`id`, `kategori`, `nama_kriteria`, `bobot`, `target`, `nilai`, `link_sumber`, `file_sumber`, `realisasi`, `created_at`, `tahun`) VALUES
(14, 'Makan Minum', 'Penyediaan Akomodasi dan Makan Minum', 0.00, 0.00, 1296.64, NULL, NULL, 0.00, '2026-07-07 16:35:19', '2025'),
(15, 'Makan Minum', 'PDRB ADHB Sulawesi Tengah', 0.00, 0.00, 415477.22, NULL, NULL, 0.00, '2026-07-07 16:35:19', '2025'),
(16, 'Makan Minum', 'Sumber Data', 0.00, 0.00, 0.00, 'https://sulteng.bps.go.id/id/publication/2026/02/27/5b520056cb0f26ef3736bc74/provinsi-sulawesi-tengah-dalam-angka-2026.html', '', 0.00, '2026-07-07 16:35:19', '2025'),
(17, 'Ekraf', 'Kriteria 1 - Ekraf', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-07 16:36:09', '2025'),
(18, 'Ekraf', 'Kriteria 2 - Ekraf', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-07 16:36:09', '2025'),
(19, 'Ekraf', 'Sumber Data', 0.00, 0.00, 0.00, 'https://sulteng.bps.go.id/id/publication/2026/02/27/5b520056cb0f26ef3736bc74/provinsi-sulawesi-tengah-dalam-angka-2026.html', NULL, 0.00, '2026-07-07 16:36:09', '2025'),
(28, 'Ekraf', 'PDRB ADHB Sulawesi Tengah', 0.00, 0.00, 415477.22, NULL, NULL, 0.00, '2026-07-08 15:43:26', '2025'),
(29, 'Wisatawan', 'Sumber Data', 0.00, 0.00, 0.00, 'https://sulteng.bps.go.id/id/publication/2026/02/27/5b520056cb0f26ef3736bc74/provinsi-sulawesi-tengah-dalam-angka-2026.html', NULL, 0.00, '2026-07-12 23:35:37', '2025'),
(30, 'Makan Minum', 'Penyediaan Akomodasi dan Makan Minum', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-13 15:55:54', '2026'),
(31, 'Makan Minum', 'PDRB ADHB Sulawesi Tengah', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-13 15:55:54', '2026'),
(33, 'Makan Minum', 'Penyediaan Akomodasi dan Makan Minum', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-13 16:02:56', '2027'),
(34, 'Makan Minum', 'PDRB ADHB Sulawesi Tengah', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-13 16:02:56', '2027'),
(35, 'Makan Minum', 'Penyediaan Akomodasi dan Makan Minum', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-13 16:03:09', '2028'),
(36, 'Makan Minum', 'PDRB ADHB Sulawesi Tengah', 0.00, 0.00, 0.00, NULL, NULL, 0.00, '2026-07-13 16:03:09', '2028');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iku_wisatawan`
--

CREATE TABLE `iku_wisatawan` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `subkategori` varchar(50) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `kabkota` varchar(100) NOT NULL,
  `januari` decimal(15,0) DEFAULT 0,
  `februari` decimal(15,0) DEFAULT 0,
  `maret` decimal(15,0) DEFAULT 0,
  `april` decimal(15,0) DEFAULT 0,
  `mei` decimal(15,0) DEFAULT 0,
  `juni` decimal(15,0) DEFAULT 0,
  `juli` decimal(15,0) DEFAULT 0,
  `agustus` decimal(15,0) DEFAULT 0,
  `september` decimal(15,0) DEFAULT 0,
  `oktober` decimal(15,0) DEFAULT 0,
  `november` decimal(15,0) DEFAULT 0,
  `desember` decimal(15,0) DEFAULT 0,
  `total` decimal(15,0) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `iku_wisatawan`
--

INSERT INTO `iku_wisatawan` (`id`, `kategori`, `subkategori`, `tahun`, `kabkota`, `januari`, `februari`, `maret`, `april`, `mei`, `juni`, `juli`, `agustus`, `september`, `oktober`, `november`, `desember`, `total`, `created_at`, `updated_at`) VALUES
(1, 'Wisatawan', 'Nusantara', '2025', 'BANGGAI KEPULAUAN', 21771, 19406, 15495, 28192, 17756, 21090, 18513, 17489, 15191, 15915, 17534, 18460, 226812, '2026-07-12 15:27:04', '2026-07-12 23:47:21'),
(2, 'Wisatawan', 'Nusantara', '2025', 'BANGGAI', 61301, 48246, 49363, 73222, 46684, 54640, 52570, 46245, 46434, 47815, 54720, 65636, 646876, '2026-07-12 15:27:04', '2026-07-13 13:45:45'),
(3, 'Wisatawan', 'Nusantara', '2025', 'MOROWALI', 91890, 88178, 109055, 95522, 80301, 83223, 86145, 86223, 88472, 92415, 91370, 109037, 1101831, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(4, 'Wisatawan', 'Nusantara', '2025', 'POSO', 98487, 69251, 68799, 94105, 74591, 88661, 78844, 81796, 76010, 77224, 72371, 88976, 969115, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(5, 'Wisatawan', 'Nusantara', '2025', 'DONGGALA', 103198, 86670, 73096, 134054, 93184, 115526, 89997, 92603, 91704, 94699, 100267, 116307, 1191305, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(6, 'Wisatawan', 'Nusantara', '2025', 'TOLI-TOLI', 28698, 28214, 24745, 51706, 25820, 33041, 30341, 33722, 26431, 28123, 28082, 35284, 374207, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(7, 'Wisatawan', 'Nusantara', '2025', 'BUOL', 15554, 14133, 12399, 23426, 12548, 16462, 14527, 30741, 14086, 14301, 14532, 16979, 199688, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(8, 'Wisatawan', 'Nusantara', '2025', 'PARIGI MOUTONG', 88046, 80368, 79904, 118965, 71184, 108449, 82448, 83418, 74980, 80451, 86335, 101486, 1056034, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(9, 'Wisatawan', 'Nusantara', '2025', 'TOJO UNA-UNA', 30154, 25670, 22614, 43639, 25196, 34895, 26982, 24618, 26216, 27610, 28536, 34287, 350417, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(10, 'Wisatawan', 'Nusantara', '2025', 'SIGI', 102865, 95880, 89741, 119836, 102821, 113177, 104679, 96169, 102025, 106588, 108333, 127960, 1270074, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(11, 'Wisatawan', 'Nusantara', '2025', 'BANGGAI LAUT', 16601, 14956, 11805, 14988, 10658, 11590, 10111, 9422, 10225, 11746, 18103, 11505, 151710, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(12, 'Wisatawan', 'Nusantara', '2025', 'MOROWALI UTARA', 55254, 45937, 51150, 56284, 49759, 55047, 52776, 46957, 44765, 44587, 46235, 55931, 604682, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(13, 'Wisatawan', 'Nusantara', '2025', 'KOTA PALU', 290944, 258194, 251599, 293976, 303761, 305960, 303682, 276747, 278654, 300575, 306081, 356009, 3526182, '2026-07-12 15:27:04', '2026-07-13 14:22:58'),
(14, 'Wisatawan', 'Mancanegara', '2025', 'BANGGAI KEPULAUAN', 61, 82, 123, 335, 537, 690, 831, 1206, 968, 800, 509, 278, 6420, '2026-07-12 15:27:11', '2026-07-13 00:43:02'),
(15, 'Wisatawan', 'Mancanegara', '2025', 'BANGGAI', 78, 175, 225, 213, 241, 216, 349, 230, 154, 180, 453, 225, 2739, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(16, 'Wisatawan', 'Mancanegara', '2025', 'MOROWALI', 7, 1, 0, 14, 13, 3, 38, 47, 32, 33, 8, 11, 207, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(17, 'Wisatawan', 'Mancanegara', '2025', 'POSO', 83, 43, 51, 86, 130, 110, 22, 391, 239, 182, 114, 3, 1454, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(18, 'Wisatawan', 'Mancanegara', '2025', 'DONGGALA', 2, 0, 0, 13, 7, 38, 8, 37, 4, 0, 4, 12, 125, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(19, 'Wisatawan', 'Mancanegara', '2025', 'TOLI-TOLI', 0, 1, 1, 1, 2, 0, 6, 1, 9, 0, 0, 0, 21, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(20, 'Wisatawan', 'Mancanegara', '2025', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, 10, 0, 15, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(21, 'Wisatawan', 'Mancanegara', '2025', 'PARIGI MOUTONG', 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 15, 0, 40, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(22, 'Wisatawan', 'Mancanegara', '2025', 'TOJO UNA-UNA', 195, 353, 346, 506, 402, 966, 1467, 1804, 875, 1021, 348, 313, 8596, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(23, 'Wisatawan', 'Mancanegara', '2025', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 11, 0, 3, 2, 16, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(24, 'Wisatawan', 'Mancanegara', '2025', 'BANGGAI LAUT', 66, 65, 75, 100, 83, 72, 108, 179, 157, 155, 181, 320, 1561, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(25, 'Wisatawan', 'Mancanegara', '2025', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 2, 0, 4, 6, 4, 0, 16, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(26, 'Wisatawan', 'Mancanegara', '2025', 'KOTA PALU', 497, 848, 883, 449, 464, 483, 471, 407, 613, 994, 396, 450, 6955, '2026-07-12 15:27:11', '2026-07-13 14:32:31'),
(27, 'Wisatawan', 'Akumulasi', '2025', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(28, 'Wisatawan', 'Akumulasi', '2025', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(29, 'Wisatawan', 'Akumulasi', '2025', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(30, 'Wisatawan', 'Akumulasi', '2025', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(31, 'Wisatawan', 'Akumulasi', '2025', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(32, 'Wisatawan', 'Akumulasi', '2025', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(33, 'Wisatawan', 'Akumulasi', '2025', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(34, 'Wisatawan', 'Akumulasi', '2025', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(35, 'Wisatawan', 'Akumulasi', '2025', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(36, 'Wisatawan', 'Akumulasi', '2025', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(37, 'Wisatawan', 'Akumulasi', '2025', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(38, 'Wisatawan', 'Akumulasi', '2025', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(39, 'Wisatawan', 'Akumulasi', '2025', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:32', '2026-07-12 15:27:32'),
(40, 'Wisatawan', 'Akumulasi', '2026', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(41, 'Wisatawan', 'Akumulasi', '2026', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(42, 'Wisatawan', 'Akumulasi', '2026', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(43, 'Wisatawan', 'Akumulasi', '2026', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(44, 'Wisatawan', 'Akumulasi', '2026', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(45, 'Wisatawan', 'Akumulasi', '2026', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(46, 'Wisatawan', 'Akumulasi', '2026', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(47, 'Wisatawan', 'Akumulasi', '2026', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(48, 'Wisatawan', 'Akumulasi', '2026', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(49, 'Wisatawan', 'Akumulasi', '2026', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(50, 'Wisatawan', 'Akumulasi', '2026', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(51, 'Wisatawan', 'Akumulasi', '2026', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(52, 'Wisatawan', 'Akumulasi', '2026', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:27:46', '2026-07-12 15:27:46'),
(53, 'Wisatawan', 'Mancanegara', '2028', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(54, 'Wisatawan', 'Mancanegara', '2028', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(55, 'Wisatawan', 'Mancanegara', '2028', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(56, 'Wisatawan', 'Mancanegara', '2028', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(57, 'Wisatawan', 'Mancanegara', '2028', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(58, 'Wisatawan', 'Mancanegara', '2028', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(59, 'Wisatawan', 'Mancanegara', '2028', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(60, 'Wisatawan', 'Mancanegara', '2028', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(61, 'Wisatawan', 'Mancanegara', '2028', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(62, 'Wisatawan', 'Mancanegara', '2028', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(63, 'Wisatawan', 'Mancanegara', '2028', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(64, 'Wisatawan', 'Mancanegara', '2028', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(65, 'Wisatawan', 'Mancanegara', '2028', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:28:18', '2026-07-12 15:28:18'),
(66, 'Wisatawan', 'Mancanegara', '2026', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(67, 'Wisatawan', 'Mancanegara', '2026', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(68, 'Wisatawan', 'Mancanegara', '2026', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(69, 'Wisatawan', 'Mancanegara', '2026', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(70, 'Wisatawan', 'Mancanegara', '2026', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(71, 'Wisatawan', 'Mancanegara', '2026', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(72, 'Wisatawan', 'Mancanegara', '2026', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(73, 'Wisatawan', 'Mancanegara', '2026', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(74, 'Wisatawan', 'Mancanegara', '2026', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(75, 'Wisatawan', 'Mancanegara', '2026', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(76, 'Wisatawan', 'Mancanegara', '2026', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(77, 'Wisatawan', 'Mancanegara', '2026', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(78, 'Wisatawan', 'Mancanegara', '2026', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 15:48:10', '2026-07-12 15:48:10'),
(79, 'Wisatawan', 'Nusantara', '2026', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:00', '2026-07-16 01:25:58'),
(80, 'Wisatawan', 'Nusantara', '2026', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(81, 'Wisatawan', 'Nusantara', '2026', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(82, 'Wisatawan', 'Nusantara', '2026', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(83, 'Wisatawan', 'Nusantara', '2026', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(84, 'Wisatawan', 'Nusantara', '2026', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(85, 'Wisatawan', 'Nusantara', '2026', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(86, 'Wisatawan', 'Nusantara', '2026', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(87, 'Wisatawan', 'Nusantara', '2026', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(88, 'Wisatawan', 'Nusantara', '2026', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(89, 'Wisatawan', 'Nusantara', '2026', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(90, 'Wisatawan', 'Nusantara', '2026', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(91, 'Wisatawan', 'Nusantara', '2026', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-12 16:00:01', '2026-07-16 01:25:58'),
(92, 'Wisatawan', 'Mancanegara', '2030', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(93, 'Wisatawan', 'Mancanegara', '2030', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(94, 'Wisatawan', 'Mancanegara', '2030', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(95, 'Wisatawan', 'Mancanegara', '2030', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(96, 'Wisatawan', 'Mancanegara', '2030', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(97, 'Wisatawan', 'Mancanegara', '2030', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(98, 'Wisatawan', 'Mancanegara', '2030', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(99, 'Wisatawan', 'Mancanegara', '2030', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(100, 'Wisatawan', 'Mancanegara', '2030', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(101, 'Wisatawan', 'Mancanegara', '2030', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(102, 'Wisatawan', 'Mancanegara', '2030', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(103, 'Wisatawan', 'Mancanegara', '2030', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(104, 'Wisatawan', 'Mancanegara', '2030', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 01:17:59', '2026-07-13 01:17:59'),
(118, 'Wisatawan', 'Nusantara', '2028', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(119, 'Wisatawan', 'Nusantara', '2028', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(120, 'Wisatawan', 'Nusantara', '2028', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(121, 'Wisatawan', 'Nusantara', '2028', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(122, 'Wisatawan', 'Nusantara', '2028', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(123, 'Wisatawan', 'Nusantara', '2028', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(124, 'Wisatawan', 'Nusantara', '2028', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(125, 'Wisatawan', 'Nusantara', '2028', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(126, 'Wisatawan', 'Nusantara', '2028', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(127, 'Wisatawan', 'Nusantara', '2028', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(128, 'Wisatawan', 'Nusantara', '2028', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(129, 'Wisatawan', 'Nusantara', '2028', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(130, 'Wisatawan', 'Nusantara', '2028', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 16:03:12', '2026-07-13 16:03:12'),
(131, 'Wisatawan', 'Nusantara', '2027', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(132, 'Wisatawan', 'Nusantara', '2027', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(133, 'Wisatawan', 'Nusantara', '2027', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(134, 'Wisatawan', 'Nusantara', '2027', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(135, 'Wisatawan', 'Nusantara', '2027', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(136, 'Wisatawan', 'Nusantara', '2027', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(137, 'Wisatawan', 'Nusantara', '2027', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(138, 'Wisatawan', 'Nusantara', '2027', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(139, 'Wisatawan', 'Nusantara', '2027', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(140, 'Wisatawan', 'Nusantara', '2027', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(141, 'Wisatawan', 'Nusantara', '2027', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(142, 'Wisatawan', 'Nusantara', '2027', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(143, 'Wisatawan', 'Nusantara', '2027', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-13 21:40:39', '2026-07-13 21:40:39'),
(144, 'Wisatawan', 'Nusantara', '2029', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(145, 'Wisatawan', 'Nusantara', '2029', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(146, 'Wisatawan', 'Nusantara', '2029', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(147, 'Wisatawan', 'Nusantara', '2029', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(148, 'Wisatawan', 'Nusantara', '2029', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(149, 'Wisatawan', 'Nusantara', '2029', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(150, 'Wisatawan', 'Nusantara', '2029', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(151, 'Wisatawan', 'Nusantara', '2029', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(152, 'Wisatawan', 'Nusantara', '2029', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:08', '2026-07-16 01:26:08'),
(153, 'Wisatawan', 'Nusantara', '2029', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:09', '2026-07-16 01:26:09'),
(154, 'Wisatawan', 'Nusantara', '2029', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:09', '2026-07-16 01:26:09'),
(155, 'Wisatawan', 'Nusantara', '2029', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:09', '2026-07-16 01:26:09'),
(156, 'Wisatawan', 'Nusantara', '2029', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:09', '2026-07-16 01:26:09'),
(157, 'Wisatawan', 'Nusantara', '2030', 'BANGGAI KEPULAUAN', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(158, 'Wisatawan', 'Nusantara', '2030', 'BANGGAI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(159, 'Wisatawan', 'Nusantara', '2030', 'MOROWALI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(160, 'Wisatawan', 'Nusantara', '2030', 'POSO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(161, 'Wisatawan', 'Nusantara', '2030', 'DONGGALA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(162, 'Wisatawan', 'Nusantara', '2030', 'TOLI-TOLI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(163, 'Wisatawan', 'Nusantara', '2030', 'BUOL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(164, 'Wisatawan', 'Nusantara', '2030', 'PARIGI MOUTONG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(165, 'Wisatawan', 'Nusantara', '2030', 'TOJO UNA-UNA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(166, 'Wisatawan', 'Nusantara', '2030', 'SIGI', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(167, 'Wisatawan', 'Nusantara', '2030', 'BANGGAI LAUT', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(168, 'Wisatawan', 'Nusantara', '2030', 'MOROWALI UTARA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11'),
(169, 'Wisatawan', 'Nusantara', '2030', 'KOTA PALU', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-16 01:26:11', '2026-07-16 01:26:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `monev_akumulasi`
--

CREATE TABLE `monev_akumulasi` (
  `id` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `sub_kegiatan` text NOT NULL,
  `indikator` text NOT NULL,
  `target_ik` decimal(15,2) DEFAULT 0.00,
  `target_keu` decimal(15,2) DEFAULT 0.00,
  `realisasi_ik` decimal(15,2) DEFAULT 0.00,
  `realisasi_keu` decimal(15,2) DEFAULT 0.00,
  `capaian_ik` decimal(10,2) DEFAULT 0.00,
  `capaian_keu` decimal(10,2) DEFAULT 0.00,
  `predikat_ik` varchar(50) DEFAULT NULL,
  `predikat_keu` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `status_ik` varchar(50) DEFAULT NULL,
  `status_keu` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monev_akumulasi`
--

INSERT INTO `monev_akumulasi` (`id`, `tahun`, `sub_kegiatan`, `indikator`, `target_ik`, `target_keu`, `realisasi_ik`, `realisasi_keu`, `capaian_ik`, `capaian_keu`, `predikat_ik`, `predikat_keu`, `status`, `status_ik`, `status_keu`, `created_at`, `updated_at`) VALUES
(6, '2025', '-', '-', 2.00, 2000000.00, 1.00, 1200000.00, 50.00, 60.00, 'KURANG', 'BUTUH PERBAIKAN', 'Tidak Efisien', NULL, NULL, '2026-07-29 01:08:43', '2026-07-29 01:08:43'),
(7, '2025', '-', '-', 2.00, 2000000.00, 1.00, 900000.00, 50.00, 45.00, 'KURANG', 'KURANG', 'Efisien', NULL, NULL, '2026-07-29 01:08:43', '2026-07-29 01:08:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `monev_bukti`
--

CREATE TABLE `monev_bukti` (
  `id` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `monev_bulanan`
--

CREATE TABLE `monev_bulanan` (
  `id` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `sub_kegiatan` text NOT NULL,
  `indikator` text NOT NULL,
  `target_ik` decimal(15,2) DEFAULT 0.00,
  `target_keu` decimal(15,2) DEFAULT 0.00,
  `realisasi_ik` decimal(15,2) DEFAULT 0.00,
  `realisasi_keu` decimal(15,2) DEFAULT 0.00,
  `capaian_ik` decimal(10,2) DEFAULT 0.00,
  `capaian_keu` decimal(10,2) DEFAULT 0.00,
  `sumber_data` text DEFAULT NULL,
  `faktor_penghambat` text DEFAULT NULL,
  `faktor_pendukung` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monev_bulanan`
--

INSERT INTO `monev_bulanan` (`id`, `tahun`, `bulan`, `sub_kegiatan`, `indikator`, `target_ik`, `target_keu`, `realisasi_ik`, `realisasi_keu`, `capaian_ik`, `capaian_keu`, `sumber_data`, `faktor_penghambat`, `faktor_pendukung`, `created_at`, `updated_at`) VALUES
(6, '2025', 'Januari', '-', '-', 2.00, 2000000.00, 1.00, 1200000.00, 50.00, 60.00, '', '', '', '2026-07-29 01:08:43', '2026-07-29 01:08:43'),
(7, '2025', 'Januari', '-', '-', 2.00, 2000000.00, 1.00, 900000.00, 50.00, 45.00, '', '', '', '2026-07-29 01:08:43', '2026-07-29 01:08:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `gambar`, `judul`, `urutan`, `status`, `created_at`) VALUES
(28, '1784449116_Gemini_Generated_Image_toyp45toyp45toyp.png', 'Slide 1', 13, 'aktif', '2026-07-19 15:18:36'),
(29, '1784449970_Definisi Operasional 1 (2).png', 'Slide DO 1', 14, 'aktif', '2026-07-19 15:32:50'),
(30, '1784450007_Definisi Operasional 2 (2).png', 'Slide DO 2', 15, 'aktif', '2026-07-19 15:33:27'),
(31, '1784450025_Definisi Operasioanl 3.png', 'Slide', 16, 'aktif', '2026-07-19 15:33:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `asal_instansi` varchar(100) DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `status` enum('baru','dibaca','diproses','selesai') DEFAULT 'baru',
  `dibaca` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor_surat`, `tanggal_surat`, `asal_instansi`, `nama_pengirim`, `no_hp`, `perihal`, `keterangan`, `file_surat`, `tanggal_masuk`, `ip_address`, `status`, `dibaca`) VALUES
(8, '009.B.BSB.FH-UTD.I.2026', '2026-08-03', 'BENGKEL SENI BALIA,FAKULTAS HUKUM UNTAD', 'ANANDYA PRADIPTA PUTRA', '08226951750', 'PEMINJAMAN ALAT', 'Peminjaman alat untuk kebutuhan penampilan TADULAKO LAW FESTIVAL', '1785735372_suratpeminjamanbsb2.pdf', '2026-08-03 12:36:12', '36.79.235.47', 'dibaca', 1),
(10, '09/B/PAN-PEL/UPHDM-UNTAD/VIII/2026', '2026-08-17', 'Unit Pengkajian Hindu Dharma Mahasiswa Universitas Tadulako', 'Gangga Honesty', '082290199143', 'Permohonan Peminjaman Pakaian', 'Permohonan Peminjaman Pakaian', '1787054886_09SURATPEMINJAMANBAJUADATBUOL.pdf', '2026-08-18 19:08:06', '182.2.235.79', 'baru', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_admin`, `email`, `created_at`) VALUES
(2, 'admin', '$2y$10$1S53bFmDLtwICcP9ZfGu6uS6xv6lpt2MCU3dZJPwep0RbW.kKtxiC', 'Administrator', 'admin@si-pari.go.id', '2026-07-05 19:55:59');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `capaian_program`
--
ALTER TABLE `capaian_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun` (`tahun`);

--
-- Indeks untuk tabel `dokumen_akip`
--
ALTER TABLE `dokumen_akip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen_iki`
--
ALTER TABLE `dokumen_iki`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `iku_ekraf`
--
ALTER TABLE `iku_ekraf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `iku_infografis`
--
ALTER TABLE `iku_infografis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `iku_pdrb`
--
ALTER TABLE `iku_pdrb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `iku_penilaian`
--
ALTER TABLE `iku_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `iku_wisatawan`
--
ALTER TABLE `iku_wisatawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori`,`subkategori`,`tahun`);

--
-- Indeks untuk tabel `monev_akumulasi`
--
ALTER TABLE `monev_akumulasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun` (`tahun`);

--
-- Indeks untuk tabel `monev_bukti`
--
ALTER TABLE `monev_bukti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun` (`tahun`,`bulan`);

--
-- Indeks untuk tabel `monev_bulanan`
--
ALTER TABLE `monev_bulanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun` (`tahun`,`bulan`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `capaian_program`
--
ALTER TABLE `capaian_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `dokumen_akip`
--
ALTER TABLE `dokumen_akip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `dokumen_iki`
--
ALTER TABLE `dokumen_iki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `iku_ekraf`
--
ALTER TABLE `iku_ekraf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT untuk tabel `iku_infografis`
--
ALTER TABLE `iku_infografis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `iku_pdrb`
--
ALTER TABLE `iku_pdrb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `iku_penilaian`
--
ALTER TABLE `iku_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `iku_wisatawan`
--
ALTER TABLE `iku_wisatawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT untuk tabel `monev_akumulasi`
--
ALTER TABLE `monev_akumulasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `monev_bukti`
--
ALTER TABLE `monev_bukti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `monev_bulanan`
--
ALTER TABLE `monev_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
