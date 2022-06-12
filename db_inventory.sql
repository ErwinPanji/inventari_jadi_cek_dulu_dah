-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_inventory
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_06_02_060308_create_sessions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_username_index` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('OayFDqY3uM8suWxykmI6xeVCeX2ILRdNl29MImVl',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiVkRBVTJNUUpud3dhdGdMbVhuWUpHOXdnVVRSMUp1Q1Z3U0FPdElRWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3QvaW52ZW50YXJpcy9iYXN0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRlZ2dqZ0RPeFcyZ1BudzE5Z1JmN1dlUmI1UzlMWnZzRjN0blh3enNYYUh5U1IyMGtMZlFQSyI7czo5OiJrb2RlX3NwcGIiO3M6MDoiIjtzOjEyOiJrb2RlX3BlbW9ob24iO3M6MDoiIjtzOjExOiJ0YW5nZ2FsX3NwYiI7czowOiIiO30=',1655023887);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_barang`
--

DROP TABLE IF EXISTS `tbl_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_barang` (
  `kode_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah_instock` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `tanggal_penerimaan_terakhir` date NOT NULL,
  `tanggal_distribusi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_barang`),
  KEY `kode_jenis_barang` (`kode_jenis_barang`),
  CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`kode_jenis_barang`) REFERENCES `tbl_jenis_barang` (`kode_jenis_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_barang`
--

LOCK TABLES `tbl_barang` WRITE;
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
INSERT INTO `tbl_barang` VALUES ('BR202206001','JB202206001','Buku',35,'Lusin','2022-06-11','2022-06-06','2022-06-05 21:18:15','2022-06-11 06:45:08'),('BR202206002','JB202206002','Sapu',30,'Unit','2022-06-08','2022-06-08','2022-06-08 02:32:18','2022-06-08 02:33:48'),('BR202206003','JB202206001','Bolpoin',40,'Pack','2022-06-08','2022-06-08','2022-06-08 02:32:49','2022-06-08 02:34:52');
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_bast_dist`
--

DROP TABLE IF EXISTS `tbl_bast_dist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_bast_dist` (
  `kode_bast_dist` varchar(20) NOT NULL,
  `nomor_sppb` varchar(20) NOT NULL,
  `tanggal_sppb` date NOT NULL,
  `kode_pemohon` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_bast_dist`),
  KEY `kode_pemohon` (`kode_pemohon`),
  CONSTRAINT `tbl_bast_dist_ibfk_1` FOREIGN KEY (`kode_pemohon`) REFERENCES `tbl_pemohon` (`kode_pemohon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bast_dist`
--

LOCK TABLES `tbl_bast_dist` WRITE;
/*!40000 ALTER TABLE `tbl_bast_dist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bast_dist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jenis_barang`
--

DROP TABLE IF EXISTS `tbl_jenis_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jenis_barang` (
  `kode_jenis_barang` varchar(20) NOT NULL,
  `jenis_barang` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_jenis_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jenis_barang`
--

LOCK TABLES `tbl_jenis_barang` WRITE;
/*!40000 ALTER TABLE `tbl_jenis_barang` DISABLE KEYS */;
INSERT INTO `tbl_jenis_barang` VALUES ('JB202206001','Alat Tulis Kantor','ini keterangan','2022-06-04 07:59:59','2022-06-04 07:59:59'),('JB202206002','Alat dan Bahan Kebersihan','Alat Kebersihan','2022-06-04 23:58:12','2022-06-05 01:41:14'),('JB202206003','Alat Rumah Tangga Kantor','Alat Rumah Tangga Kantor','2022-06-11 06:36:00','2022-06-11 06:36:00');
/*!40000 ALTER TABLE `tbl_jenis_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_list_barang_bast_dist`
--

DROP TABLE IF EXISTS `tbl_list_barang_bast_dist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_list_barang_bast_dist` (
  `kode_list_barang_bast_dist` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_permintaan` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `kode_bast_dist` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_list_barang_bast_dist`),
  KEY `kode_bast_dist` (`kode_bast_dist`),
  KEY `kode_barang` (`kode_barang`),
  CONSTRAINT `tbl_list_barang_bast_dist_ibfk_1` FOREIGN KEY (`kode_bast_dist`) REFERENCES `tbl_bast_dist` (`kode_bast_dist`),
  CONSTRAINT `tbl_list_barang_bast_dist_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_list_barang_bast_dist`
--

LOCK TABLES `tbl_list_barang_bast_dist` WRITE;
/*!40000 ALTER TABLE `tbl_list_barang_bast_dist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_list_barang_bast_dist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_list_barang_sppb`
--

DROP TABLE IF EXISTS `tbl_list_barang_sppb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_list_barang_sppb` (
  `kode_list_barang_sppb` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_permintaan` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `kode_sppb` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_list_barang_sppb`),
  KEY `kodesppb` (`kode_sppb`),
  KEY `kode_barang` (`kode_barang`),
  CONSTRAINT `kodesppb` FOREIGN KEY (`kode_sppb`) REFERENCES `tbl_sppb` (`kode_sppb`),
  CONSTRAINT `tbl_list_barang_sppb_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_list_barang_sppb`
--

LOCK TABLES `tbl_list_barang_sppb` WRITE;
/*!40000 ALTER TABLE `tbl_list_barang_sppb` DISABLE KEYS */;
INSERT INTO `tbl_list_barang_sppb` VALUES ('LS202206001','BR202206001',3,'Lusin','buku tulis','SP202206001','2022-06-11 01:09:48','2022-06-11 23:59:49'),('LS202206003','BR202206001',3,'Lusin','buku','SP202206002','2022-06-11 06:49:40','2022-06-11 23:59:36'),('LS202206004','BR202206003',3,'Pack','pilot ashdgaj','SP202206002','2022-06-11 06:52:58','2022-06-11 06:53:54'),('LS202206005','BR202206003',2,'Pack','pilot','SP202206003','2022-06-12 00:27:50','2022-06-12 00:28:14');
/*!40000 ALTER TABLE `tbl_list_barang_sppb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pemohon`
--

DROP TABLE IF EXISTS `tbl_pemohon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pemohon` (
  `kode_pemohon` varchar(20) NOT NULL,
  `nama_pemohon` varchar(50) NOT NULL,
  `nip_niiki` varchar(20) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_pemohon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pemohon`
--

LOCK TABLES `tbl_pemohon` WRITE;
/*!40000 ALTER TABLE `tbl_pemohon` DISABLE KEYS */;
INSERT INTO `tbl_pemohon` VALUES ('RQ202206001','Adi Antara','12309130123123','Guru Tetap','2022-06-05 01:31:56','2022-06-09 02:04:23');
/*!40000 ALTER TABLE `tbl_pemohon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_penerimaan_barang`
--

DROP TABLE IF EXISTS `tbl_penerimaan_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `spesifikasi_barang` text NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `satuan_barang` varchar(20) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_penerimaan_barang`),
  KEY `barang` (`kode_barang`),
  KEY `jenisbarang` (`kode_jenis_barang`),
  KEY `sumberdana` (`kode_sumber_dana`),
  KEY `kode_penyedia` (`kode_penyedia`),
  CONSTRAINT `barang` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`),
  CONSTRAINT `jenisbarang` FOREIGN KEY (`kode_jenis_barang`) REFERENCES `tbl_jenis_barang` (`kode_jenis_barang`),
  CONSTRAINT `sumberdana` FOREIGN KEY (`kode_sumber_dana`) REFERENCES `tbl_sumber_dana` (`kode_sumber_dana`),
  CONSTRAINT `tbl_penerimaan_barang_ibfk_1` FOREIGN KEY (`kode_penyedia`) REFERENCES `tbl_penyedia` (`kode_penyedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penerimaan_barang`
--

LOCK TABLES `tbl_penerimaan_barang` WRITE;
/*!40000 ALTER TABLE `tbl_penerimaan_barang` DISABLE KEYS */;
INSERT INTO `tbl_penerimaan_barang` VALUES ('PB202206001','2022-06-07','SU202206001','2022010309991','SD202206001','2022','Januari','JB202206001','Buku','BR202206001','Buku dengan isi 60 lembar',25,'Lusin',20000,500000,55000,555000,'asdhjaksd','2022-06-07 02:31:17','2022-06-07 21:20:30'),('PB202206002','2022-06-08','SU202206001','23131231231','SD202206001','2022','Januari','JB202206002','Sapu','BR202206002','sapu',30,'Unit',7000,210000,23100,233100,'Sapu','2022-06-08 02:33:48','2022-06-08 02:33:48'),('PB202206003','2022-06-08','SU202206001','12398193810389','SD202206001','2022','Januari','JB202206001','Bolpoin','BR202206003','bolasd',40,'Pack',15000,600000,66000,666000,'askdjasd','2022-06-08 02:34:52','2022-06-08 02:34:52'),('PB202206004','2022-06-11','SU202206001','200123029301923','SD202206001','2022','Januari','JB202206001','Buku','BR202206001','asdkajs',10,'Lusin',10000,100000,11000,111000,'keterangahsa','2022-06-11 06:45:08','2022-06-11 06:45:08');
/*!40000 ALTER TABLE `tbl_penerimaan_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_penyedia`
--

DROP TABLE IF EXISTS `tbl_penyedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penyedia` (
  `kode_penyedia` varchar(20) NOT NULL,
  `nama_penyedia` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_penyedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penyedia`
--

LOCK TABLES `tbl_penyedia` WRITE;
/*!40000 ALTER TABLE `tbl_penyedia` DISABLE KEYS */;
INSERT INTO `tbl_penyedia` VALUES ('SU202206001','PT ABBASY SINERGI UTAMA','Komplek PIK Penggilingan Blok B No. 54 RT 004 RW 010','2022-06-04 23:24:08','2022-06-04 23:24:08');
/*!40000 ALTER TABLE `tbl_penyedia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_profil_skpd_ukpd`
--

DROP TABLE IF EXISTS `tbl_profil_skpd_ukpd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_profil_skpd_ukpd`
--

LOCK TABLES `tbl_profil_skpd_ukpd` WRITE;
/*!40000 ALTER TABLE `tbl_profil_skpd_ukpd` DISABLE KEYS */;
INSERT INTO `tbl_profil_skpd_ukpd` VALUES ('1','SMK Negeri 4 Jakarta','Jalan Rorotan VI No. 1, Cilincing Jakarta Utara 14140','44850035','Dr. Rianto Ritonga, M.M.','196403101992031005','xxxxxx','xxxxxx','xxxxxx','xxxxx',11,NULL,'2022-06-11 07:10:36');
/*!40000 ALTER TABLE `tbl_profil_skpd_ukpd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_satuan`
--

DROP TABLE IF EXISTS `tbl_satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_satuan` (
  `kode_satuan` varchar(20) NOT NULL,
  `nama_satuan` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_satuan`
--

LOCK TABLES `tbl_satuan` WRITE;
/*!40000 ALTER TABLE `tbl_satuan` DISABLE KEYS */;
INSERT INTO `tbl_satuan` VALUES ('ST202206002','Pack','Satuan untuk Pack','2022-06-04 03:32:44','2022-06-04 03:32:44'),('ST202206003','Unit','Satuan untun banyak unit','2022-06-04 05:49:49','2022-06-04 05:49:49'),('ST202206004','Lusin','satuan untuk 12 buah barang','2022-06-04 06:04:23','2022-06-04 06:04:23'),('ST202206005','CM','centimeter','2022-06-11 06:37:51','2022-06-11 06:37:51');
/*!40000 ALTER TABLE `tbl_satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sppb`
--

DROP TABLE IF EXISTS `tbl_sppb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sppb` (
  `kode_sppb` varchar(20) NOT NULL,
  `nomor_spb` varchar(20) NOT NULL,
  `tanggal_spb` date NOT NULL,
  `kode_pemohon` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_sppb`),
  KEY `kode_pemohon` (`kode_pemohon`),
  CONSTRAINT `tbl_sppb_ibfk_1` FOREIGN KEY (`kode_pemohon`) REFERENCES `tbl_pemohon` (`kode_pemohon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sppb`
--

LOCK TABLES `tbl_sppb` WRITE;
/*!40000 ALTER TABLE `tbl_sppb` DISABLE KEYS */;
INSERT INTO `tbl_sppb` VALUES ('SP202206001','2022031301','2022-06-11','RQ202206001','2022-06-11 01:09:13','2022-06-11 01:15:52'),('SP202206002','001/SPB/2022','2022-06-11','RQ202206001','2022-06-11 06:48:45','2022-06-11 06:54:13'),('SP202206003','002/SPB/2022','2022-06-10','RQ202206001','2022-06-12 00:27:33','2022-06-12 00:28:05');
/*!40000 ALTER TABLE `tbl_sppb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sumber_dana`
--

DROP TABLE IF EXISTS `tbl_sumber_dana`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sumber_dana` (
  `kode_sumber_dana` varchar(20) NOT NULL,
  `sumber_dana` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_sumber_dana`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sumber_dana`
--

LOCK TABLES `tbl_sumber_dana` WRITE;
/*!40000 ALTER TABLE `tbl_sumber_dana` DISABLE KEYS */;
INSERT INTO `tbl_sumber_dana` VALUES ('SD202206001','BOS','2022-06-05 00:32:35','2022-06-05 00:32:35'),('SD202206002','BOP','2022-06-05 00:34:35','2022-06-05 00:34:35');
/*!40000 ALTER TABLE `tbl_sumber_dana` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@gmail.com',NULL,'$2y$10$eggjgDOxW2gPnw19gRf7WeRb5S9LZvsF3tnXwzsXaHySR20kLfQPK','1',NULL,NULL,NULL,NULL,NULL,NULL,'2022-06-01 23:53:00','2022-06-01 23:53:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-12 17:32:10
