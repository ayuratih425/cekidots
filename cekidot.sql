-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.46 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS=0;

-- Dumping structure for table cekidot.bidang
CREATE TABLE IF NOT EXISTS `bidang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_bidang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_bidang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bidang_kode_bidang_unique` (`kode_bidang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.bidang: ~0 rows (approximately)

-- Dumping structure for table cekidot.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.cache: ~0 rows (approximately)

-- Dumping structure for table cekidot.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.cache_locks: ~0 rows (approximately)

-- Dumping structure for table cekidot.capaian_program
CREATE TABLE IF NOT EXISTS `capaian_program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sasaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indikator` text COLLATE utf8mb4_unicode_ci,
  `target` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `realisasi` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `capaian` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `frekwensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sumber_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_sumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.capaian_program: ~9 rows (approximately)
INSERT INTO `capaian_program` (`id`, `program`, `sasaran`, `indikator`, `target`, `realisasi`, `capaian`, `frekwensi`, `sumber_data`, `file_sumber`, `penanggung_jawab`, `tahun`, `created_at`, `updated_at`) VALUES
	(1, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-Rata Lama Kunjungan Wisatawan Mancanegara (Hari)', 2.0000, 1.5100, 75.5000, 'Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(2, 'Program Pengembangan Destinasi Pariwisata', 'Meningkatnya Rasio PDRB Penyediaan Akomodasi Makan Minum', 'Rata-rata pengeluaran wisatawan mancanegara ($)', 500.0000, 447.1200, 89.4240, 'Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pengembangan Destinasi Pariwisata', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(3, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan Mancanegara (ribu perhari)', 25000.0000, 28165.0000, 112.6600, 'Bulanan / Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pemasaran Pariwisata', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(4, 'Program Pemasaran Pariwisata', 'Meningkatnya Jumlah Kunjungan Wisatawan Mancanegara', 'Jumlah pergerakan wisatawan Nusantara (juta orang)', 9000000.0000, 11668000.0000, 129.6444, 'Bulanan / Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pemasaran Pariwisata', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(5, 'Program Ekonomi Kreatif Melalui Pemanfaatan Dan Perlindungan Hak Kekayaan Intelektual', 'Meningkatnya Proporsi PDRB Ekonomi Kreatif Terhadap ADHB', 'Nilai Tambah Ekonomi Kreatif (Rp)', 150.0000, 13281.7000, 8854.4667, 'Tahunan', 'https://sulteng.bps.go.id/id/publication/2025/02/28/d99fa9772e3aac88cb25e6a8/provinsi-sulawesi-tengah-dalam-angka-2025.html', NULL, 'BIDANG Pengembangan Ekonomi Kreatif', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(6, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah tenaga Kerja Pariwisata (orang)', 8418.0000, 84057.0000, 998.5388, 'Tahunan', 'https://sulteng.bps.go.id/id/pressrelease/2025/11/05/1394/agustus-2025--tingkat-pengangguran-terbuka--tpt--sebesar-2-92-persen.html', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(7, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja Ekonomi Kreatif (orang)', 2338.0000, 2919.0000, 124.8503, 'Tahunan', 'https://drive.google.com/file/d/18gCxgfLZPxH9FnIhcS9WenZbWrf6A5qe/view?usp=sharing', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(8, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata tersertifikasi (orang)', 100.0000, 60.0000, 60.0000, 'Tahunan', 'https://www.pariwisata.sultengprov.go.id/images/2026/04SDM/REKAP_PELATIHAN_DAN_SERTIFIKASI_PAREKRAF_SULTENG.pdf', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(9, 'Program Pengembangan Sumber Daya Pariwisata dan Ekraf', 'Meningkatnya Jumlah Tenaga Kerja/Pelaku Usaha Pariwisata dan Ekonomi Kreatif tersertifikasi', 'Jumlah Tenaga Kerja/Pelaku Usaha Ekonomi Kreatif tersertifikasi (orang)', 100.0000, 61.0000, 61.0000, 'Tahunan', 'https://www.pariwisata.sultengprov.go.id/images/2026/04SDM/REKAP_PELATIHAN_DAN_SERTIFIKASI_PAREKRAF_SULTENG.pdf', NULL, 'BIDANG Pengembangan Sumber Daya Pariwisata dan Ekraf', '2025', '2026-09-09 10:41:57', '2026-09-09 10:41:57');

-- Dumping structure for table cekidot.dokumen_akip
CREATE TABLE IF NOT EXISTS `dokumen_akip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_konten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'file',
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint NOT NULL DEFAULT '0',
  `tahun` int NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumen_akip_tahun_urutan_index` (`tahun`,`urutan`),
  KEY `dokumen_akip_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.dokumen_akip: ~17 rows (approximately)
INSERT INTO `dokumen_akip` (`id`, `judul`, `deskripsi`, `file_dokumen`, `tipe_konten`, `link_url`, `file_type`, `file_size`, `tahun`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
	(5, 'RENSTRA 2025-2029', 'Rencana Strategis', '1784528533_RENSTRARevisiDISPAR2025-2029.pdf', 'file', NULL, 'pdf', 0, 2026, 1, 'aktif', '2026-09-09 10:41:57', NULL),
	(6, 'RENJA 2026 (AWAL)', 'Rencana Kerja', '1784528635_DISPARRENJA2026v3.pdf', 'file', NULL, 'pdf', 0, 2026, 2, 'aktif', '2026-09-09 10:41:57', NULL),
	(7, 'SK INDIKATOR KINERJA UTAMA 2026', 'Surat Keputusan', '1784529825_SKIKU.pdf', 'file', '', 'pdf', 0, 2026, 3, 'aktif', '2026-09-09 10:41:57', NULL),
	(9, 'DPA 2026 (AWAL)', '', '1784546347_01DPAPenetapan-09Januari.rar', 'file', '', 'rar', 3913918, 2026, 4, 'aktif', '2026-09-09 10:41:57', NULL),
	(10, 'SK DEFINISI OPERASIONAL 2026', '', '1784595011_SKDOIKUPROGAMDANKEGIATANDISPAR2026v2.pdf', 'file', NULL, 'pdf', 2400684, 2026, 5, 'aktif', '2026-09-09 10:41:57', NULL),
	(11, 'STRUKTUR ORGANISASI DAN TUGAS POKOK', '', '1784547324_StrukturOrganisasidanTugasFungsiDinasPariwisata.pdf', 'file', '', 'pdf', 3507468, 2026, 6, 'aktif', '2026-09-09 10:41:57', NULL),
	(12, 'RENCANA AKSI 2026', '', '1784547441_DISPARRENCANAAKSITAHUN2026v3.pdf', 'file', '', 'pdf', 114317, 2026, 7, 'aktif', '2026-09-09 10:41:57', NULL),
	(13, 'POHON KINERJA', '', '1784548019_Pohon_Kinerja.pdf', 'file', '', 'pdf', 225851, 2026, 8, 'aktif', '2026-09-09 10:41:57', NULL),
	(14, 'CASCADING', '', '1784548272_CASCADING.pdf', 'file', '', 'pdf', 2603292, 2026, 9, 'aktif', '2026-09-09 10:41:57', NULL),
	(16, 'CROSSCUTING', '', '1784552400_Cross-Cutting-Dinas-Pariwisata.pdf', 'file', '', 'pdf', 213701, 2026, 10, 'aktif', '2026-09-09 10:41:57', NULL),
	(17, 'PERJANJIAN KINERJA 2026 (AWAL)', '', '1784604361_PK2026DISPARv3.pdf', 'file', '', 'pdf', 14489074, 2026, 11, 'aktif', '2026-09-09 10:41:57', NULL),
	(18, 'SK TIM KERJA', '', '1784604976_SKTimKerjaDinasPariwisata-digabungkan.pdf', 'file', '', 'pdf', 446280, 2026, 12, 'aktif', '2026-09-09 10:41:57', NULL),
	(19, 'SKP PEGAWAI', 'Sasaran kinerja pegawai', '', 'link', 'https://drive.google.com/drive/folders/1Zv4f4zGToAsPaAt2NBRcMs5XxAxehJ36?usp=drive_link', '', 0, 2026, 13, 'aktif', '2026-09-09 10:41:57', NULL),
	(20, 'LAKIP TAHUN 2025', 'Laporan Kinerja', '1784605349_DISPAR-Lakip2025LKJrevisi7.pdf', 'file', '', 'pdf', 2275225, 2026, 14, 'aktif', '2026-09-09 10:41:57', NULL),
	(23, 'EVALUASI RENCANA AKSI TAHUN 2026', '', '', 'link', 'https://drive.google.com/drive/folders/1tJo_kSumGMJPAoo72CdsdaqXpGb_eBkG?usp=drive_link', '', 0, 2026, 17, 'aktif', '2026-09-09 10:41:57', NULL),
	(25, 'SCREENSHOOT RENSTRA, RENJA, DPA, LAKIP, PK PADA WEBSITE DINAS', '', '1784607779_screenshotwebdokperencanaan.jpg', 'file', '', 'jpg', 91398, 2026, 19, 'aktif', '2026-09-09 10:41:57', NULL),
	(27, 'PENGUMPULAN DAN PENGUKURAN CAPAIAN KINERJA APLIKASI CEKIDOT', '', 'https://www.cekidot.dispar.my.id', 'link', 'https://www.cekidot.dispar.my.id', '', 0, 2026, 20, 'aktif', '2026-09-09 10:41:57', NULL);

-- Dumping structure for table cekidot.dokumen_iki
CREATE TABLE IF NOT EXISTS `dokumen_iki` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_konten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'file',
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint NOT NULL DEFAULT '0',
  `tahun` int NOT NULL,
  `bidang_id` bigint unsigned DEFAULT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumen_iki_bidang_id_foreign` (`bidang_id`),
  KEY `dokumen_iki_tahun_urutan_index` (`tahun`,`urutan`),
  KEY `dokumen_iki_status_index` (`status`),
  CONSTRAINT `dokumen_iki_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.dokumen_iki: ~14 rows (approximately)
INSERT INTO `dokumen_iki` (`id`, `judul`, `kategori`, `deskripsi`, `file_dokumen`, `tipe_konten`, `link_url`, `file_type`, `file_size`, `tahun`, `bidang_id`, `divisi`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'MPH KADIS', NULL, 'Matriks Penilaian Peran Hasil', '1784554649_MPHKadis.pdf', 'file', '', 'pdf', 713262, 2026, NULL, NULL, 1, 'aktif', '2026-09-09 10:41:57', NULL),
	(2, 'RENCANA AKSI KADIS', NULL, '', '1784554772_RencanaAksiKadis.pdf', 'file', '', 'pdf', 764199, 2026, NULL, NULL, 2, 'aktif', '2026-09-09 10:41:57', NULL),
	(3, 'SKP KADIS', NULL, 'Sasaran Kinerja Pegawai', '1785130721_SKPIBUKADIS.pdf', 'file', NULL, 'pdf', 172445, 2026, NULL, NULL, 3, 'aktif', '2026-09-09 10:41:57', NULL),
	(4, 'MPH KABID', NULL, 'Matriks Penilaian Peran Hasil', '1785130889_MPHKABID.pdf', 'file', NULL, 'pdf', 53928, 2026, NULL, NULL, 4, 'aktif', '2026-09-09 10:41:57', NULL),
	(5, 'RENCANA AKSI KABID', NULL, '', '1785131028_RencanaAksiAktivitasKABID.pdf', 'file', '', 'pdf', 54134, 2026, NULL, NULL, 5, 'aktif', '2026-09-09 10:41:57', NULL),
	(6, 'SKP KABID', NULL, 'Sasaran Kinerja Pegawai', '1785131214_SKPKABID2026TTD.pdf', 'file', NULL, 'pdf', 247781, 2026, NULL, NULL, 6, 'aktif', '2026-09-09 10:41:57', NULL),
	(7, 'MPH MAX', NULL, 'Matriks Penilaian Peran Hasil', '1785131369_MPHMAX.pdf', 'file', NULL, 'pdf', 42037, 2026, NULL, NULL, 7, 'aktif', '2026-09-09 10:41:57', NULL),
	(8, 'RENCANA AKSI MAX', NULL, '', '1785131466_RencanaAksiAktivitasMAX.pdf', 'file', '', 'pdf', 42363, 2026, NULL, NULL, 8, 'aktif', '2026-09-09 10:41:57', NULL),
	(9, 'SKP MAX', NULL, 'Sasaran Kinerja Pegawai', '1785131597_SKPMAX2026TTD.pdf', 'file', NULL, 'pdf', 667163, 2026, NULL, NULL, 9, 'aktif', '2026-09-09 10:41:57', NULL),
	(10, 'MPH SUTRISNI', NULL, 'Matriks Penilaian Peran Hasil', '1785131840_SKPSATRISNI2026TTD.pdf', 'file', NULL, 'pdf', 279821, 2026, NULL, NULL, 10, 'aktif', '2026-09-09 10:41:57', NULL),
	(11, 'RENCANA AKSI SUTRISNI', NULL, '', '1785131957_RencanaAksiAktivitasSATRISNI.pdf', 'file', '', 'pdf', 104607, 2026, NULL, NULL, 11, 'aktif', '2026-09-09 10:41:57', NULL),
	(12, 'SKP NOVIRA', NULL, 'Sasaran Kinerja Pegawai', '1785132106_SKPNOVIRA2026TTD.pdf', 'file', NULL, 'pdf', 269851, 2026, NULL, NULL, 12, 'aktif', '2026-09-09 10:41:57', NULL),
	(13, 'SKP YENNY', NULL, 'Sasaran Kinerja Pegawai', '1785132131_SKPYENNI2026TTD.pdf', 'file', NULL, 'pdf', 277545, 2026, NULL, NULL, 13, 'aktif', '2026-09-09 10:41:57', NULL),
	(14, 'SK TIM KERJA', NULL, 'Surat Keputusan', '1785198604_SKTimKerjaDinasPariwisata.pdf', 'file', '', 'pdf', 446280, 2026, NULL, NULL, 14, 'aktif', '2026-09-09 10:41:57', NULL);

-- Dumping structure for table cekidot.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table cekidot.folder_dokumen
CREATE TABLE IF NOT EXISTS `folder_dokumen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `divisi` enum('Kepegawaian','Program','Keuangan','Ekraf','Destinasi','Pemasaran','Sdm','Semua') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Semua',
  `bidang_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folder_dokumen_bidang_id_foreign` (`bidang_id`),
  KEY `folder_dokumen_divisi_index` (`divisi`),
  KEY `folder_dokumen_status_index` (`status`),
  KEY `folder_dokumen_created_by_index` (`created_by`),
  KEY `folder_dokumen_parent_id_index` (`parent_id`),
  CONSTRAINT `folder_dokumen_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `folder_dokumen_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `folder_dokumen_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `folder_dokumen` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.folder_dokumen: ~0 rows (approximately)

-- Dumping structure for table cekidot.iku_ekraf
CREATE TABLE IF NOT EXISTS `iku_ekraf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ekraf',
  `tahun` int NOT NULL,
  `sektor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `koofisien` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `nilai_bps` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `jumlah_rp` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `hasil_penjumlahan` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.iku_ekraf: ~0 rows (approximately)

-- Dumping structure for table cekidot.iku_infografis
CREATE TABLE IF NOT EXISTS `iku_infografis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT '2025',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.iku_infografis: ~0 rows (approximately)

-- Dumping structure for table cekidot.iku_pdrb
CREATE TABLE IF NOT EXISTS `iku_pdrb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `target` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `realitas` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `capaian` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.iku_pdrb: ~5 rows (approximately)
INSERT INTO `iku_pdrb` (`id`, `kategori`, `tahun`, `target`, `realitas`, `capaian`, `created_at`, `updated_at`) VALUES
	(1, 'Makan Minum', 2025, 0.3400, 0.3100, 91.8400, '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(2, 'Ekraf', 2025, 3.7600, 0.0000, 0.0000, '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(3, 'Wisatawan', 2025, 25000.0000, 28165.0000, 112.6600, '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(4, 'Makan Minum', 2026, 0.0000, 0.0000, 0.0000, '2026-09-09 10:41:57', '2026-09-09 10:41:57'),
	(6, 'Wisatawan', 2026, 0.0000, 0.0000, 0.0000, '2026-09-09 10:41:57', '2026-09-09 10:41:57');

-- Dumping structure for table cekidot.iku_penilaian
CREATE TABLE IF NOT EXISTS `iku_penilaian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT '2025',
  `nama_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `bobot` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `target` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `realisasi` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `link_sumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_sumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.iku_penilaian: ~8 rows (approximately)
INSERT INTO `iku_penilaian` (`id`, `kategori`, `tahun`, `nama_kriteria`, `nilai`, `bobot`, `target`, `realisasi`, `link_sumber`, `file_sumber`, `created_at`, `updated_at`) VALUES
	(14, 'Makan Minum', '2025', 'Penyediaan Akomodasi dan Makan Minum', 1296.6400, 0.0000, 0.0000, 0.0000, NULL, NULL, '2026-09-09 10:41:57', NULL),
	(15, 'Makan Minum', '2025', 'PDRB ADHB Sulawesi Tengah', 415477.2200, 0.0000, 0.0000, 0.0000, NULL, NULL, '2026-09-09 10:41:57', NULL),
	(16, 'Makan Minum', '2025', 'Sumber Data', 0.0000, 0.0000, 0.0000, 0.0000, 'https://sulteng.bps.go.id/id/publication/2026/02/27/5b520056cb0f26ef3736bc74/provinsi-sulawesi-tengah-dalam-angka-2026.html', '', '2026-09-09 10:41:57', NULL),
	(17, 'Ekraf', '2025', 'Kriteria 1 - Ekraf', 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, '2026-09-09 10:41:57', NULL),
	(18, 'Ekraf', '2025', 'Kriteria 2 - Ekraf', 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, '2026-09-09 10:41:57', NULL),
	(19, 'Ekraf', '2025', 'Sumber Data', 0.0000, 0.0000, 0.0000, 0.0000, 'https://sulteng.bps.go.id/id/publication/2026/02/27/5b520056cb0f26ef3736bc74/provinsi-sulawesi-tengah-dalam-angka-2026.html', NULL, '2026-09-09 10:41:57', NULL),
	(28, 'Ekraf', '2025', 'PDRB ADHB Sulawesi Tengah', 415477.2200, 0.0000, 0.0000, 0.0000, NULL, NULL, '2026-09-09 10:41:57', NULL),
	(29, 'Wisatawan', '2025', 'Sumber Data', 0.0000, 0.0000, 0.0000, 0.0000, 'https://sulteng.bps.go.id/id/publication/2026/02/27/5b520056cb0f26ef3736bc74/provinsi-sulawesi-tengah-dalam-angka-2026.html', NULL, '2026-09-09 10:41:57', NULL);

-- Dumping structure for table cekidot.iku_wisatawan
CREATE TABLE IF NOT EXISTS `iku_wisatawan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Wisatawan',
  `subkategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `kabkota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `januari` decimal(15,2) NOT NULL DEFAULT '0.00',
  `februari` decimal(15,2) NOT NULL DEFAULT '0.00',
  `maret` decimal(15,2) NOT NULL DEFAULT '0.00',
  `april` decimal(15,2) NOT NULL DEFAULT '0.00',
  `mei` decimal(15,2) NOT NULL DEFAULT '0.00',
  `juni` decimal(15,2) NOT NULL DEFAULT '0.00',
  `juli` decimal(15,2) NOT NULL DEFAULT '0.00',
  `agustus` decimal(15,2) NOT NULL DEFAULT '0.00',
  `september` decimal(15,2) NOT NULL DEFAULT '0.00',
  `oktober` decimal(15,2) NOT NULL DEFAULT '0.00',
  `november` decimal(15,2) NOT NULL DEFAULT '0.00',
  `desember` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.iku_wisatawan: ~0 rows (approximately)

-- Dumping structure for table cekidot.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.jobs: ~0 rows (approximately)

-- Dumping structure for table cekidot.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.job_batches: ~0 rows (approximately)

-- Dumping structure for table cekidot.log_aktivitas
CREATE TABLE IF NOT EXISTS `log_aktivitas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `upload_id` bigint unsigned DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_aktivitas_user_id_foreign` (`user_id`),
  KEY `log_aktivitas_upload_id_foreign` (`upload_id`),
  CONSTRAINT `log_aktivitas_upload_id_foreign` FOREIGN KEY (`upload_id`) REFERENCES `upload_anggota` (`id`) ON DELETE SET NULL,
  CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.log_aktivitas: ~0 rows (approximately)

-- Dumping structure for table cekidot.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.migrations: ~33 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '0001_01_01_000003_create_sessions_table', 1),
	(5, '2026_01_01_000001_create_sliders_table', 1),
	(6, '2026_01_01_000002_create_dokumen_akip_table', 1),
	(7, '2026_01_01_000003_create_dokumen_iki_table', 1),
	(8, '2026_01_01_000004_create_surat_masuk_table', 1),
	(9, '2026_01_01_000005_create_iku_penilaian_table', 1),
	(10, '2026_01_01_000006_create_iku_wisatawan_table', 1),
	(11, '2026_01_01_000007_create_iku_ekraf_table', 1),
	(12, '2026_01_01_000008_create_iku_pdrb_table', 1),
	(13, '2026_01_01_000009_create_iku_infografis_table', 1),
	(14, '2026_01_01_000010_create_capaian_program_table', 1),
	(15, '2026_01_01_000011_create_monev_bulanan_table', 1),
	(16, '2026_01_01_000012_create_monev_akumulasi_table', 1),
	(17, '2026_01_01_000013_add_status_urutan_to_dokumen_tables', 1),
	(18, '2026_01_01_000014_recreate_iku_tables', 1),
	(19, '2026_01_01_000015_fix_surat_masuk_columns', 1),
	(20, '2026_01_01_000016_add_bobot_target_realisasi_to_iku_penilaian', 1),
	(21, '2026_01_01_000017_recreate_capaian_program_table', 1),
	(22, '2026_08_11_130401_add_role_divisi_to_users_table', 1),
	(23, '2026_08_11_130402_create_folder_dokumen_table', 1),
	(24, '2026_08_11_130403_create_upload_anggota_table', 1),
	(25, '2026_08_12_052128_create_bidang_table', 1),
	(26, '2026_08_12_052130_add_bidang_is_active_to_users_table', 1),
	(27, '2026_08_12_052131_create_arsip_surat_table', 1),
	(28, '2026_08_12_073824_add_bidang_id_to_folder_and_iki_tables', 1),
	(29, '2026_08_12_075250_add_missing_columns_to_legacy_tables', 1),
	(30, '2026_08_12_080340_add_kategori_to_dokumen_iki_table', 1),
	(31, '2026_08_14_000001_replace_bidang_id_with_divisi_in_arsip_surat', 1),
	(32, '2026_08_15_100001_add_parent_id_to_folder_dokumen', 1),
	(33, '2026_08_15_100002_create_log_aktivitas_table', 1),
	(34, '2026_08_23_000001_add_performance_indexes', 2);

-- Dumping structure for table cekidot.monev_akumulasi
CREATE TABLE IF NOT EXISTS `monev_akumulasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `indikator` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_ik` decimal(15,2) DEFAULT '0.00',
  `target_keu` decimal(15,2) DEFAULT '0.00',
  `realisasi_ik` decimal(15,2) DEFAULT '0.00',
  `realisasi_keu` decimal(15,2) DEFAULT '0.00',
  `capaian_ik` decimal(10,2) DEFAULT '0.00',
  `capaian_keu` decimal(10,2) DEFAULT '0.00',
  `predikat_ik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `predikat_keu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_keu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tahun` (`tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.monev_akumulasi: ~2 rows (approximately)
INSERT INTO `monev_akumulasi` (`id`, `tahun`, `sub_kegiatan`, `indikator`, `target_ik`, `target_keu`, `realisasi_ik`, `realisasi_keu`, `capaian_ik`, `capaian_keu`, `predikat_ik`, `predikat_keu`, `status`, `status_ik`, `status_keu`, `created_at`, `updated_at`) VALUES
	(6, '2025', '-', '-', 2.00, 2000000.00, 1.00, 1200000.00, 50.00, 60.00, 'KURANG', 'BUTUH PERBAIKAN', 'Tidak Efisien', NULL, NULL, '2026-09-09 18:41:57', '2026-09-09 18:41:57'),
	(7, '2025', '-', '-', 2.00, 2000000.00, 1.00, 900000.00, 50.00, 45.00, 'KURANG', 'KURANG', 'Efisien', NULL, NULL, '2026-09-09 18:41:57', '2026-09-09 18:41:57');

-- Dumping structure for table cekidot.monev_bukti
CREATE TABLE IF NOT EXISTS `monev_bukti` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `bulan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tahun` (`tahun`,`bulan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cekidot.monev_bukti: ~0 rows (approximately)

-- Dumping structure for table cekidot.monev_bulanan
CREATE TABLE IF NOT EXISTS `monev_bulanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `sub_kegiatan` text NOT NULL,
  `indikator` text NOT NULL,
  `target_ik` decimal(15,2) DEFAULT '0.00',
  `target_keu` decimal(15,2) DEFAULT '0.00',
  `realisasi_ik` decimal(15,2) DEFAULT '0.00',
  `realisasi_keu` decimal(15,2) DEFAULT '0.00',
  `capaian_ik` decimal(10,2) DEFAULT '0.00',
  `capaian_keu` decimal(10,2) DEFAULT '0.00',
  `sumber_data` text,
  `faktor_penghambat` text,
  `faktor_pendukung` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tahun` (`tahun`,`bulan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cekidot.monev_bulanan: ~2 rows (approximately)
INSERT INTO `monev_bulanan` (`id`, `tahun`, `bulan`, `sub_kegiatan`, `indikator`, `target_ik`, `target_keu`, `realisasi_ik`, `realisasi_keu`, `capaian_ik`, `capaian_keu`, `sumber_data`, `faktor_penghambat`, `faktor_pendukung`, `created_at`, `updated_at`) VALUES
	(6, '2025', 'Januari', '-', '-', 2.00, 2000000.00, 1.00, 1200000.00, 50.00, 60.00, '', '', '', '2026-09-09 18:41:57', '2026-09-09 18:41:57'),
	(7, '2025', 'Januari', '-', '-', 2.00, 2000000.00, 1.00, 900000.00, 50.00, 45.00, '', '', '', '2026-09-09 18:41:57', '2026-09-09 18:41:57');

-- Dumping structure for table cekidot.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.sessions: ~0 rows (approximately)

-- Dumping structure for table cekidot.slider
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urutan` int DEFAULT '0',
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cekidot.slider: ~5 rows (approximately)
INSERT INTO `slider` (`id`, `gambar`, `judul`, `urutan`, `status`, `created_at`) VALUES
	(28, '1784449116_Gemini_Generated_Image_toyp45toyp45toyp.png', 'Slide 1', 13, 'aktif', '2026-07-19 15:18:36'),
	(29, '1784449970_Definisi Operasional 1 (2).png', 'Slide DO 1', 14, 'aktif', '2026-07-19 15:32:50'),
	(30, '1784450007_Definisi Operasional 2 (2).png', 'Slide DO 2', 15, 'aktif', '2026-07-19 15:33:27'),
	(31, '1784450025_Definisi Operasioanl 3.png', 'Slide', 16, 'aktif', '2026-07-19 15:33:45'),
	(32, '1785256060_Cekidot.png', 'Slide', 1, 'aktif', '2026-07-29 00:27:40');

-- Dumping structure for table cekidot.sliders
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sliders_status_urutan_index` (`status`,`urutan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.sliders: ~4 rows (approximately)
INSERT INTO `sliders` (`id`, `judul`, `gambar`, `deskripsi`, `status`, `urutan`, `created_at`, `updated_at`) VALUES
	(1, 'Slide Utama', '1785256060_Cekidot.png', NULL, 'aktif', 1, '2026-09-02 20:14:19', NULL),
	(2, 'Slide 1', 'slide.png', NULL, 'aktif', 2, '2026-09-02 20:14:19', NULL),
	(3, 'Slide 2', 'slide2.png', NULL, 'aktif', 3, '2026-09-02 20:14:19', NULL),
	(4, 'Slide 3', 'slide3.png', NULL, 'aktif', 4, '2026-09-02 20:14:19', NULL);

-- Dumping structure for table cekidot.surat_masuk
CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `asal_instansi` varchar(100) DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `file_surat` varchar(255) DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(45) DEFAULT NULL,
  `status` enum('baru','dibaca','diproses','selesai') DEFAULT 'baru',
  `dibaca` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `surat_masuk_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cekidot.surat_masuk: ~4 rows (approximately)
INSERT INTO `surat_masuk` (`id`, `nomor_surat`, `tanggal_surat`, `asal_instansi`, `nama_pengirim`, `no_hp`, `perihal`, `keterangan`, `file_surat`, `tanggal_masuk`, `ip_address`, `status`, `dibaca`) VALUES
	(8, '009.B.BSB.FH-UTD.I.2026', '2026-08-03', 'BENGKEL SENI BALIA,FAKULTAS HUKUM UNTAD', 'ANANDYA PRADIPTA PUTRA', '08226951750', 'PEMINJAMAN ALAT', 'Peminjaman alat untuk kebutuhan penampilan TADULAKO LAW FESTIVAL', '1785735372_suratpeminjamanbsb2.pdf', '2026-09-09 18:41:57', NULL, 'dibaca', 1),
	(10, '09/B/PAN-PEL/UPHDM-UNTAD/VIII/2026', '2026-08-17', 'Unit Pengkajian Hindu Dharma Mahasiswa Universitas Tadulako', 'Gangga Honesty', '082290199143', 'Permohonan Peminjaman Pakaian', 'Permohonan Peminjaman Pakaian', '1787054886_09SURATPEMINJAMANBAJUADATBUOL.pdf', '2026-09-09 18:41:57', NULL, 'dibaca', 1),
	(11, '19319/UN28.6/TU/2026', '2026-08-24', 'Universitas Tadulako', 'Reihan Abta Afghani', '081229794347', 'Permohonan Kerja Praktek', '', '1787531542_F521230341.pdf', '2026-09-09 18:41:57', NULL, 'dibaca', 1),
	(12, '002/genpi', '2026-08-31', 'Generasi pesona Indonesia provinsi Sulawesi tengah', 'Abdul Rahman', '08113999146', 'Permohonan sinergi', 'Semoga bisa bersinergi', '1788151431_IMG_5477.jpeg', '2026-09-09 18:41:57', NULL, 'baru', 0);

-- Dumping structure for table cekidot.upload_anggota
CREATE TABLE IF NOT EXISTS `upload_anggota` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `folder_id` bigint unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint NOT NULL DEFAULT '0',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `tahun` int NOT NULL,
  `bulan` tinyint NOT NULL,
  `tanggal_upload` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_anggota_user_id_index` (`user_id`),
  KEY `upload_anggota_folder_id_index` (`folder_id`),
  KEY `upload_anggota_tahun_index` (`tahun`),
  KEY `upload_anggota_status_index` (`status`),
  CONSTRAINT `upload_anggota_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folder_dokumen` (`id`),
  CONSTRAINT `upload_anggota_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.upload_anggota: ~0 rows (approximately)

-- Dumping structure for table cekidot.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('super_admin','admin_divisi','admin_bidang','anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota',
  `divisi` enum('Kepegawaian','Program','Keuangan','Ekraf','Destinasi','Pemasaran','Sdm') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_bidang_id_foreign` (`bidang_id`),
  CONSTRAINT `users_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `nama_admin`, `email`, `role`, `divisi`, `bidang_id`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$12$Osd/l4bl2/4DDbaHC2lO2.TkjxX4No8T50JmuM889/8NECku5MYWa', 'Super Admin', NULL, 'super_admin', 'Kepegawaian', NULL, 1, NULL, '2026-08-15 18:02:51', '2026-08-15 18:02:51'),
	(2, 'anggota_kepegawaian', '$2y$12$sp/09h2oilE3xm1N/kHaB.TOsGcCc9rzmb/68cUZuvf4kiBoxWkoG', 'Anggota Kepegawaian', NULL, 'anggota', 'Kepegawaian', NULL, 1, NULL, '2026-08-15 18:12:04', '2026-08-15 18:12:04'),
	(3, 'anggota_ekraf', '$2y$12$lPnPzPW3s4oJ2Dyltn1x1OcuBohh1L1lWixKXIv3b6Letw4v9e.Le', 'Anggota Ekraf', NULL, 'anggota', 'Ekraf', NULL, 1, NULL, '2026-08-15 18:12:04', '2026-08-15 18:12:04'),
	(4, 'admin_kepegawaian', '$2y$12$Us7TgXWTX1uSw9odPKcYGuaodJxS4/1UDcPyREhkBo2ysjWrY36WS', 'Admin Kepegawaian', NULL, 'admin_divisi', 'Kepegawaian', NULL, 1, NULL, '2026-08-15 18:12:04', '2026-08-15 18:12:04'),
	(5, 'admin_ekraf', '$2y$12$zkIDkYblxgLj6BkfZ7lAcOgtHBDLS5zfgJKkcb00ztVwSMMTCR40C', 'Admin Ekraf', NULL, 'admin_divisi', 'Ekraf', NULL, 1, NULL, '2026-08-15 18:12:04', '2026-08-15 18:12:04'),
	(6, 'admin_program', '$2y$12$BKkTtiRLFqHliYk1bdI6YOle3eMiNWfb1lp7jsSBsCieJp9nA6SrW', 'Admin Program', NULL, 'admin_divisi', 'Program', NULL, 1, NULL, '2026-08-15 18:12:04', '2026-08-15 18:12:04');

-- Dumping structure for table cekidot.arsip_surat
CREATE TABLE IF NOT EXISTS `arsip_surat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_surat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_surat` enum('masuk','keluar','internal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masuk',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint unsigned DEFAULT NULL,
  `uploaded_by` bigint unsigned NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `arsip_surat_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `arsip_surat_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cekidot.arsip_surat: ~0 rows (approximately)

SET FOREIGN_KEY_CHECKS=1;
