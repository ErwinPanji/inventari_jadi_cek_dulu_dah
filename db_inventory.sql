-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2022 pada 11.22
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_06_02_060308_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('49SN2u5UwVGOdExuwJX0A3sFJAg7t8CDgrfrRb5D', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmhDelF0dXdvMjRhSnphNjVaWDNpSllrZ2liaWZVZHlzdDdMU2lvQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vbG9jYWxob3N0L2ludmVudGFyaXMvYmFzdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1655457633),
('VtLozNiNLU8SFaUW7BjBwPhrZQJbjGHz8YAjP62r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV3BuQWNXa3QyMTBBSmNVbHlFV3IweWV3ZEhXSk9DSFM2N3hlYVBVOCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cHM6Ly9sb2NhbGhvc3QvaW52ZW50YXJpcy9zcHBiIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vbG9jYWxob3N0L2ludmVudGFyaXMvc3BwYiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1655453717);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kode_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah_instock` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `tanggal_penerimaan_terakhir` date NOT NULL,
  `tanggal_distribusi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`kode_barang`, `kode_jenis_barang`, `nama_barang`, `jumlah_instock`, `satuan`, `tanggal_penerimaan_terakhir`, `tanggal_distribusi`, `created_at`, `updated_at`) VALUES
('BR202206001', 'JB202206001', 'Buku', 35, 'Lusin', '2022-06-15', '2022-06-14', '2022-06-05 21:18:15', '2022-06-15 03:33:53'),
('BR202206002', 'JB202206002', 'Sapu', 30, 'Unit', '2022-06-08', '2022-06-08', '2022-06-08 02:32:18', '2022-06-08 02:33:48'),
('BR202206003', 'JB202206001', 'Bolpoin', 35, 'Pack', '2022-06-08', '2022-06-14', '2022-06-08 02:32:49', '2022-06-15 02:08:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bast_dist`
--

CREATE TABLE `tbl_bast_dist` (
  `kode_bast_dist` varchar(20) NOT NULL,
  `nomor_sppb` varchar(20) NOT NULL,
  `tanggal_sppb` date NOT NULL,
  `kode_pemohon` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bast_dist`
--

INSERT INTO `tbl_bast_dist` (`kode_bast_dist`, `nomor_sppb`, `tanggal_sppb`, `kode_pemohon`, `created_at`, `updated_at`) VALUES
('DS202206001', '001/SPPB/2022', '2022-06-13', 'RQ202206001', '2022-06-14 23:04:06', '2022-06-14 23:09:15'),
('DS202206002', '002/SPPB/2022', '2022-06-14', 'RQ202206001', '2022-06-15 02:07:41', '2022-06-15 02:08:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_barang`
--

CREATE TABLE `tbl_jenis_barang` (
  `kode_jenis_barang` varchar(20) NOT NULL,
  `jenis_barang` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jenis_barang`
--

INSERT INTO `tbl_jenis_barang` (`kode_jenis_barang`, `jenis_barang`, `keterangan`, `created_at`, `updated_at`) VALUES
('JB202206001', 'Alat Tulis Kantor', 'ini keterangan', '2022-06-04 07:59:59', '2022-06-04 07:59:59'),
('JB202206002', 'Alat dan Bahan Kebersihan', 'Alat Kebersihan', '2022-06-04 23:58:12', '2022-06-05 01:41:14'),
('JB202206003', 'Alat Rumah Tangga Kantor', 'Alat Rumah Tangga Kantor', '2022-06-11 06:36:00', '2022-06-11 06:36:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_list_barang_bast_dist`
--

CREATE TABLE `tbl_list_barang_bast_dist` (
  `kode_list_barang_bast_dist` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `instock` int(11) NOT NULL,
  `jumlah_permintaan` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `kode_bast_dist` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_list_barang_bast_dist`
--

INSERT INTO `tbl_list_barang_bast_dist` (`kode_list_barang_bast_dist`, `kode_barang`, `instock`, `jumlah_permintaan`, `satuan`, `keterangan`, `kode_bast_dist`, `created_at`, `updated_at`) VALUES
('LB202206001', 'BR202206001', 35, 3, 'Lusin', 'buku', 'DS202206001', '2022-06-14 23:06:59', '2022-06-14 23:08:36'),
('LB202206002', 'BR202206003', 40, 2, 'Pack', 'pulpen', 'DS202206001', '2022-06-14 23:08:41', '2022-06-14 23:08:47'),
('LB202206003', 'BR202206001', 32, 2, 'Lusin', 'ini buku', 'DS202206002', '2022-06-15 02:07:55', '2022-06-15 02:08:17'),
('LB202206004', 'BR202206003', 38, 3, 'Pack', 'ini pulpen', 'DS202206002', '2022-06-15 02:08:27', '2022-06-15 02:08:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_list_barang_sppb`
--

CREATE TABLE `tbl_list_barang_sppb` (
  `kode_list_barang_sppb` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_permintaan` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `kode_sppb` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_list_barang_sppb`
--

INSERT INTO `tbl_list_barang_sppb` (`kode_list_barang_sppb`, `kode_barang`, `jumlah_permintaan`, `satuan`, `keterangan`, `kode_sppb`, `created_at`, `updated_at`) VALUES
('LS202206001', 'BR202206001', 3, 'Lusin', 'buku tulis', 'SP202206001', '2022-06-11 01:09:48', '2022-06-11 23:59:49'),
('LS202206003', 'BR202206001', 3, 'Lusin', 'buku', 'SP202206002', '2022-06-11 06:49:40', '2022-06-11 23:59:36'),
('LS202206004', 'BR202206003', 3, 'Pack', 'pilot ashdgaj', 'SP202206002', '2022-06-11 06:52:58', '2022-06-11 06:53:54'),
('LS202206005', 'BR202206003', 2, 'Pack', 'pilot', 'SP202206003', '2022-06-12 00:27:50', '2022-06-12 00:28:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pemohon`
--

CREATE TABLE `tbl_pemohon` (
  `kode_pemohon` varchar(20) NOT NULL,
  `nama_pemohon` varchar(50) NOT NULL,
  `nip_niiki` varchar(20) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pemohon`
--

INSERT INTO `tbl_pemohon` (`kode_pemohon`, `nama_pemohon`, `nip_niiki`, `jabatan`, `created_at`, `updated_at`) VALUES
('RQ202206001', 'Adi Antara', '12309130123123', 'Guru Tetap', '2022-06-05 01:31:56', '2022-06-09 02:04:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penerimaan_barang`
--

CREATE TABLE `tbl_penerimaan_barang` (
  `kode_penerimaan_barang` varchar(20) NOT NULL,
  `tanggal_penerimaan` date NOT NULL,
  `kode_penyedia` varchar(20) NOT NULL,
  `nomor_tanda_bukti` varchar(50) NOT NULL,
  `kode_sumber_dana` varchar(20) NOT NULL,
  `tahun_anggaran` varchar(4) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `kode_jenis_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `spesifikasi_barang` text DEFAULT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `instock` int(11) NOT NULL,
  `satuan_barang` varchar(20) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_penerimaan_barang`
--

INSERT INTO `tbl_penerimaan_barang` (`kode_penerimaan_barang`, `tanggal_penerimaan`, `kode_penyedia`, `nomor_tanda_bukti`, `kode_sumber_dana`, `tahun_anggaran`, `bulan`, `kode_jenis_barang`, `nama_barang`, `kode_barang`, `spesifikasi_barang`, `jumlah_barang`, `instock`, `satuan_barang`, `harga_satuan`, `subtotal`, `ppn`, `total`, `keterangan`, `created_at`, `updated_at`) VALUES
('PB202206001', '2022-06-07', 'SU202206001', '2022010309991', 'SD202206001', '2022', 'Januari', 'JB202206001', 'Buku', 'BR202206001', 'Buku dengan isi 60 lembar', 25, 0, 'Lusin', 20000, 500000, 55000, 555000, 'asdhjaksd', '2022-06-07 02:31:17', '2022-06-07 21:20:30'),
('PB202206002', '2022-06-08', 'SU202206001', '23131231231', 'SD202206001', '2022', 'Januari', 'JB202206002', 'Sapu', 'BR202206002', 'sapu', 30, 0, 'Unit', 7000, 210000, 23100, 233100, 'Sapu', '2022-06-08 02:33:48', '2022-06-08 02:33:48'),
('PB202206003', '2022-06-08', 'SU202206001', '12398193810389', 'SD202206001', '2022', 'Januari', 'JB202206001', 'Bolpoin', 'BR202206003', 'bolasd', 40, 0, 'Pack', 15000, 600000, 66000, 666000, 'askdjasd', '2022-06-08 02:34:52', '2022-06-08 02:34:52'),
('PB202206004', '2022-06-11', 'SU202206001', '200123029301923', 'SD202206001', '2022', 'Januari', 'JB202206001', 'Buku', 'BR202206001', 'asdkajs', 10, 25, 'Lusin', 20000, 200000, 22000, 222000, 'keterangahsa', '2022-06-11 06:45:08', '2022-06-14 21:59:02'),
('PB202206005', '2022-06-15', 'SU202206001', '12312313123', 'SD202206001', '2022', 'Juni', 'JB202206001', 'Buku', 'BR202206001', 'spek buku', 5, 30, 'Lusin', 20000, 100000, 11000, 111000, 'ketajdkasd', '2022-06-15 03:33:53', '2022-06-15 03:33:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penyedia`
--

CREATE TABLE `tbl_penyedia` (
  `kode_penyedia` varchar(20) NOT NULL,
  `nama_penyedia` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_penyedia`
--

INSERT INTO `tbl_penyedia` (`kode_penyedia`, `nama_penyedia`, `alamat`, `created_at`, `updated_at`) VALUES
('SU202206001', 'PT ABBASY SINERGI UTAMA', 'Komplek PIK Penggilingan Blok B No. 54 RT 004 RW 010', '2022-06-04 23:24:08', '2022-06-04 23:24:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_profil_skpd_ukpd`
--

CREATE TABLE `tbl_profil_skpd_ukpd` (
  `kode_profil` varchar(20) NOT NULL,
  `nama_skpd_ukpd` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `nama_kepala` varchar(30) NOT NULL,
  `nip_kepala` varchar(20) NOT NULL,
  `no_telp_kepala` varchar(15) NOT NULL,
  `nama_pengurus` varchar(30) NOT NULL,
  `nip_pengurus` varchar(20) NOT NULL,
  `no_telp_pengurus` varchar(15) NOT NULL,
  `ppn` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_profil_skpd_ukpd`
--

INSERT INTO `tbl_profil_skpd_ukpd` (`kode_profil`, `nama_skpd_ukpd`, `alamat`, `telepon`, `nama_kepala`, `nip_kepala`, `no_telp_kepala`, `nama_pengurus`, `nip_pengurus`, `no_telp_pengurus`, `ppn`, `created_at`, `updated_at`) VALUES
('1', 'SMK Negeri 4 Jakarta', 'Jalan Rorotan VI No. 1, Cilincing Jakarta Utara 14140', '44850035', 'Dr. Rianto Ritonga, M.M.', '196403101992031005', 'xxxxxx', 'Rita Sahara Saud, M.Pd.', '197011302008012016', 'xxxx', 11, NULL, '2022-06-13 00:46:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `kode_satuan` varchar(20) NOT NULL,
  `nama_satuan` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`kode_satuan`, `nama_satuan`, `keterangan`, `updated_at`, `created_at`) VALUES
('ST202206002', 'Pack', 'Satuan untuk Pack', '2022-06-04 03:32:44', '2022-06-04 03:32:44'),
('ST202206003', 'Unit', 'Satuan untun banyak unit', '2022-06-04 05:49:49', '2022-06-04 05:49:49'),
('ST202206004', 'Lusin', 'satuan untuk 12 buah barang', '2022-06-04 06:04:23', '2022-06-04 06:04:23'),
('ST202206005', 'CM', 'centimeter', '2022-06-11 06:37:51', '2022-06-11 06:37:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sppb`
--

CREATE TABLE `tbl_sppb` (
  `kode_sppb` varchar(20) NOT NULL,
  `nomor_spb` varchar(20) NOT NULL,
  `tanggal_spb` date NOT NULL,
  `kode_pemohon` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_sppb`
--

INSERT INTO `tbl_sppb` (`kode_sppb`, `nomor_spb`, `tanggal_spb`, `kode_pemohon`, `created_at`, `updated_at`) VALUES
('SP202206001', '2022031301', '2022-06-11', 'RQ202206001', '2022-06-11 01:09:13', '2022-06-11 01:15:52'),
('SP202206002', '001/SPB/2022', '2022-06-11', 'RQ202206001', '2022-06-11 06:48:45', '2022-06-11 06:54:13'),
('SP202206003', '002/SPB/2022', '2022-06-10', 'RQ202206001', '2022-06-12 00:27:33', '2022-06-12 00:28:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sumber_dana`
--

CREATE TABLE `tbl_sumber_dana` (
  `kode_sumber_dana` varchar(20) NOT NULL,
  `sumber_dana` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_sumber_dana`
--

INSERT INTO `tbl_sumber_dana` (`kode_sumber_dana`, `sumber_dana`, `created_at`, `updated_at`) VALUES
('SD202206001', 'BOS', '2022-06-05 00:32:35', '2022-06-05 00:32:35'),
('SD202206002', 'BOP', '2022-06-05 00:34:35', '2022-06-05 00:34:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$ods0HUEeO9mtLP/Q0GkXeeJhq5y/mdAVzH081/8FurbyxXM7HbkIK', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-01 23:53:00', '2022-06-16 21:17:44'),
(2, 'Adi', 'adi@gmail.com', NULL, '$2y$10$dXM5.1N/WzD32EhQKCnOpOa.HjPbrAFx6IdjEZ9sAwshJ6lw6IKV6', '3', NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-16 21:11:48', '2022-06-16 21:18:54'),
(6, 'Dr. Rianto Ritonga, M.M.', 'riantoritonga@gmail.com', NULL, '$2y$10$xX06Wkq3ehzj.fxhzw80ue8sV49n/MFCeC4iCG4rDM73kW9DXVoPu', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-16 23:26:41', '2022-06-16 23:26:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kode_jenis_barang` (`kode_jenis_barang`);

--
-- Indeks untuk tabel `tbl_bast_dist`
--
ALTER TABLE `tbl_bast_dist`
  ADD PRIMARY KEY (`kode_bast_dist`),
  ADD KEY `kode_pemohon` (`kode_pemohon`);

--
-- Indeks untuk tabel `tbl_jenis_barang`
--
ALTER TABLE `tbl_jenis_barang`
  ADD PRIMARY KEY (`kode_jenis_barang`);

--
-- Indeks untuk tabel `tbl_list_barang_bast_dist`
--
ALTER TABLE `tbl_list_barang_bast_dist`
  ADD PRIMARY KEY (`kode_list_barang_bast_dist`),
  ADD KEY `kode_bast_dist` (`kode_bast_dist`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `tbl_list_barang_sppb`
--
ALTER TABLE `tbl_list_barang_sppb`
  ADD PRIMARY KEY (`kode_list_barang_sppb`),
  ADD KEY `kodesppb` (`kode_sppb`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `tbl_pemohon`
--
ALTER TABLE `tbl_pemohon`
  ADD PRIMARY KEY (`kode_pemohon`);

--
-- Indeks untuk tabel `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  ADD PRIMARY KEY (`kode_penerimaan_barang`),
  ADD KEY `barang` (`kode_barang`),
  ADD KEY `jenisbarang` (`kode_jenis_barang`),
  ADD KEY `sumberdana` (`kode_sumber_dana`),
  ADD KEY `kode_penyedia` (`kode_penyedia`);

--
-- Indeks untuk tabel `tbl_penyedia`
--
ALTER TABLE `tbl_penyedia`
  ADD PRIMARY KEY (`kode_penyedia`);

--
-- Indeks untuk tabel `tbl_profil_skpd_ukpd`
--
ALTER TABLE `tbl_profil_skpd_ukpd`
  ADD PRIMARY KEY (`kode_profil`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`kode_satuan`);

--
-- Indeks untuk tabel `tbl_sppb`
--
ALTER TABLE `tbl_sppb`
  ADD PRIMARY KEY (`kode_sppb`),
  ADD KEY `kode_pemohon` (`kode_pemohon`);

--
-- Indeks untuk tabel `tbl_sumber_dana`
--
ALTER TABLE `tbl_sumber_dana`
  ADD PRIMARY KEY (`kode_sumber_dana`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`kode_jenis_barang`) REFERENCES `tbl_jenis_barang` (`kode_jenis_barang`);

--
-- Ketidakleluasaan untuk tabel `tbl_bast_dist`
--
ALTER TABLE `tbl_bast_dist`
  ADD CONSTRAINT `tbl_bast_dist_ibfk_1` FOREIGN KEY (`kode_pemohon`) REFERENCES `tbl_pemohon` (`kode_pemohon`);

--
-- Ketidakleluasaan untuk tabel `tbl_list_barang_bast_dist`
--
ALTER TABLE `tbl_list_barang_bast_dist`
  ADD CONSTRAINT `tbl_list_barang_bast_dist_ibfk_1` FOREIGN KEY (`kode_bast_dist`) REFERENCES `tbl_bast_dist` (`kode_bast_dist`),
  ADD CONSTRAINT `tbl_list_barang_bast_dist_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`);

--
-- Ketidakleluasaan untuk tabel `tbl_list_barang_sppb`
--
ALTER TABLE `tbl_list_barang_sppb`
  ADD CONSTRAINT `kodesppb` FOREIGN KEY (`kode_sppb`) REFERENCES `tbl_sppb` (`kode_sppb`),
  ADD CONSTRAINT `tbl_list_barang_sppb_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`);

--
-- Ketidakleluasaan untuk tabel `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  ADD CONSTRAINT `barang` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`),
  ADD CONSTRAINT `jenisbarang` FOREIGN KEY (`kode_jenis_barang`) REFERENCES `tbl_jenis_barang` (`kode_jenis_barang`),
  ADD CONSTRAINT `sumberdana` FOREIGN KEY (`kode_sumber_dana`) REFERENCES `tbl_sumber_dana` (`kode_sumber_dana`),
  ADD CONSTRAINT `tbl_penerimaan_barang_ibfk_1` FOREIGN KEY (`kode_penyedia`) REFERENCES `tbl_penyedia` (`kode_penyedia`);

--
-- Ketidakleluasaan untuk tabel `tbl_sppb`
--
ALTER TABLE `tbl_sppb`
  ADD CONSTRAINT `tbl_sppb_ibfk_1` FOREIGN KEY (`kode_pemohon`) REFERENCES `tbl_pemohon` (`kode_pemohon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
