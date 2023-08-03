-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `aboutus`;
CREATE TABLE `aboutus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text,
  `subtitle` text,
  `deskripsi` text,
  `konten` text,
  `gambar` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `alamat`;
CREATE TABLE `alamat` (
  `id_alamat` int NOT NULL AUTO_INCREMENT,
  `nama_alamat` char(100) DEFAULT NULL,
  `detail` text,
  `propinsi` char(100) DEFAULT NULL,
  `kota` char(100) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `kode_member` char(100) DEFAULT NULL,
  PRIMARY KEY (`id_alamat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `app_routes`;
CREATE TABLE `app_routes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `slug` varchar(192) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `controller` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `appdata` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `id_bank` int NOT NULL AUTO_INCREMENT,
  `nama_bank` char(100) NOT NULL,
  `gambar` char(100) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` char(100) DEFAULT NULL,
  `text1` text,
  `text2` text,
  `text3` text,
  `button_text` text,
  `customlink` text,
  `gambar` text,
  `foto` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `bannerimage`;
CREATE TABLE `bannerimage` (
  `id_bannerimage` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) NOT NULL,
  `user` char(100) NOT NULL,
  PRIMARY KEY (`id_bannerimage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `bannertext`;
CREATE TABLE `bannertext` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` char(100) DEFAULT NULL,
  `subtitle` char(100) DEFAULT NULL,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `slug` text,
  `gambar` text,
  `user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `telepon` char(100) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `detailongkir`;
CREATE TABLE `detailongkir` (
  `id` int NOT NULL AUTO_INCREMENT,
  `detailongkir` varchar(500) NOT NULL,
  `tampilkan` int NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `detailpemesanan`;
CREATE TABLE `detailpemesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_produk` char(100) DEFAULT NULL,
  `berat` int DEFAULT NULL,
  `catatan` text,
  `size` char(200) DEFAULT NULL,
  `id_stok` char(100) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `no_pemesanan` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `doku`;
CREATE TABLE `doku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transidmerchant` varchar(125) NOT NULL,
  `totalamount` double NOT NULL,
  `words` varchar(200) NOT NULL,
  `statustype` varchar(1) NOT NULL,
  `response_code` varchar(50) NOT NULL,
  `approvalcode` char(6) NOT NULL,
  `trxstatus` varchar(50) NOT NULL,
  `payment_channel` int NOT NULL,
  `paymentcode` int NOT NULL,
  `session_id` varchar(48) NOT NULL,
  `bank_issuer` varchar(100) NOT NULL,
  `creditcard` varchar(16) NOT NULL,
  `payment_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `verifyid` varchar(30) NOT NULL,
  `verifyscore` int NOT NULL,
  `verifystatus` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `facebook`;
CREATE TABLE `facebook` (
  `id_facebook` int NOT NULL AUTO_INCREMENT,
  `facebook` text NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_facebook`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanya` text,
  `jawab` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `featproduct`;
CREATE TABLE `featproduct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text,
  `subtitle` text,
  `gambar` char(100) DEFAULT NULL,
  `permalink` char(100) DEFAULT NULL,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `featpromo`;
CREATE TABLE `featpromo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` char(100) DEFAULT NULL,
  `subtitle` char(100) DEFAULT NULL,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `footerimage`;
CREATE TABLE `footerimage` (
  `id_footerimage` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) NOT NULL,
  `user` char(100) NOT NULL,
  PRIMARY KEY (`id_footerimage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `headercontact`;
CREATE TABLE `headercontact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` char(100) DEFAULT NULL,
  `subtitle` char(100) DEFAULT NULL,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `headerproduct`;
CREATE TABLE `headerproduct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` char(100) DEFAULT NULL,
  `subtitle` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `instagram`;
CREATE TABLE `instagram` (
  `id_instagram` int NOT NULL AUTO_INCREMENT,
  `instagram` text NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_instagram`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id_invoice` int NOT NULL AUTO_INCREMENT,
  `no_invoice` char(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jatuh_tempo` datetime DEFAULT NULL,
  `metode_pembayaran` int DEFAULT NULL,
  `transidmerchant` char(100) DEFAULT NULL,
  `channel` int DEFAULT NULL,
  `biaya_tambahan` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `no_pemesanan` char(100) DEFAULT NULL,
  PRIMARY KEY (`id_invoice`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis` (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `nama` tinytext NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `jenisproduk`;
CREATE TABLE `jenisproduk` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `slug` text,
  `gambar` text,
  `user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kabupaten`;
CREATE TABLE `kabupaten` (
  `id_kab` char(4) NOT NULL,
  `id_prov` char(2) NOT NULL,
  `nama` tinytext NOT NULL,
  `id_jenis` int NOT NULL,
  PRIMARY KEY (`id_kab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kategoriproduk`;
CREATE TABLE `kategoriproduk` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `slug` text,
  `gambar` text,
  `user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE `kecamatan` (
  `id_kec` char(6) NOT NULL,
  `id_kab` char(4) NOT NULL,
  `nama` tinytext NOT NULL,
  PRIMARY KEY (`id_kec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kelebihan`;
CREATE TABLE `kelebihan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` char(100) DEFAULT NULL,
  `detail` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `kelurahan`;
CREATE TABLE `kelurahan` (
  `id_kel` char(10) NOT NULL,
  `id_kec` char(6) DEFAULT NULL,
  `nama` tinytext,
  `id_jenis` int NOT NULL,
  PRIMARY KEY (`id_kel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `logo`;
CREATE TABLE `logo` (
  `id_logo` int NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `user` char(100) NOT NULL,
  PRIMARY KEY (`id_logo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `marketplace`;
CREATE TABLE `marketplace` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` char(100) DEFAULT NULL,
  `gambar` char(100) DEFAULT NULL,
  `permalink` char(100) DEFAULT NULL,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_member` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `multimenu`;
CREATE TABLE `multimenu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `id_parent` int NOT NULL DEFAULT '0',
  `nama_menu` tinytext NOT NULL,
  `menu_en` char(100) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  `position` varchar(100) DEFAULT NULL,
  `urutan` int NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `slug` text,
  `konten` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `gambar` text,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_deskripsi` text,
  `meta_keyword` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_pemesanan` char(100) DEFAULT NULL,
  `pelanggan` char(100) DEFAULT NULL,
  `subtotal` int DEFAULT NULL,
  `ppn` int DEFAULT NULL,
  `provider_ongkir` char(100) DEFAULT NULL,
  `service_ongkir` char(100) DEFAULT NULL,
  `cost_ongkir` int DEFAULT NULL,
  `promo` int DEFAULT NULL,
  `diskon` int DEFAULT NULL,
  `potongan` int DEFAULT NULL,
  `grandtotal` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `notifikasi` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pengiriman`;
CREATE TABLE `pengiriman` (
  `id_pengiriman` int NOT NULL AUTO_INCREMENT,
  `nama` char(100) NOT NULL,
  `email` char(100) DEFAULT NULL,
  `telepon` char(20) DEFAULT NULL,
  `kota` int DEFAULT NULL,
  `propinsi` int DEFAULT NULL,
  `alamat` text,
  `alamat_alternatif` text,
  `no_statustransaksi` char(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pixel`;
CREATE TABLE `pixel` (
  `id_pixel` int NOT NULL AUTO_INCREMENT,
  `pixel` text,
  `pixel2` text,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pixel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `kategoriproduk_id` char(25) DEFAULT NULL,
  `jenisproduk` int DEFAULT NULL,
  `brand` int DEFAULT NULL,
  `subkategori` int DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `ukuran` char(100) DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `slug` text,
  `satuan` char(20) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `berat` float DEFAULT NULL,
  `harga_coret` int DEFAULT NULL,
  `deskripsi1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `deskripsi2` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `gambar1` text,
  `gambar2` text,
  `gambar3` text,
  `gambar4` text,
  `gambar5` text,
  `dilihat` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `video` text,
  `atribut` int DEFAULT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_deskripsi` text,
  `meta_keyword` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `profiltoko`;
CREATE TABLE `profiltoko` (
  `id_profiltoko` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `profile` text,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `propinsi` char(100) NOT NULL,
  `kota` char(100) NOT NULL,
  `telepon` char(100) NOT NULL,
  `handphone` char(100) NOT NULL,
  `whatsapp` char(100) NOT NULL,
  `maps` text NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_profiltoko`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `promo`;
CREATE TABLE `promo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` char(100) DEFAULT NULL,
  `detail` text,
  `gambar` char(100) DEFAULT NULL,
  `permalink` char(100) DEFAULT NULL,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `provinsi`;
CREATE TABLE `provinsi` (
  `id_prov` char(2) NOT NULL,
  `nama` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `rekening`;
CREATE TABLE `rekening` (
  `id_rekening` bigint NOT NULL AUTO_INCREMENT,
  `bank` varchar(200) DEFAULT NULL,
  `rekening` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `atasnama` char(200) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rekening`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `id_seo` int NOT NULL AUTO_INCREMENT,
  `title` text,
  `deskripsi` text,
  `keyword` text,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_seo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `skill`;
CREATE TABLE `skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `keahlian` text,
  `value` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `statuspembayaran`;
CREATE TABLE `statuspembayaran` (
  `id_statuspembayaran` int NOT NULL AUTO_INCREMENT,
  `no_statuspembayaran` char(100) DEFAULT NULL,
  `bank` char(50) DEFAULT NULL,
  `rekening` char(100) DEFAULT NULL,
  `nama` char(100) DEFAULT NULL,
  `bukti` char(225) DEFAULT NULL,
  `bank_tujuan` char(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_pembayaran` int DEFAULT NULL,
  `no_invoice` char(100) DEFAULT NULL,
  PRIMARY KEY (`id_statuspembayaran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `statustransaksi`;
CREATE TABLE `statustransaksi` (
  `id_statustransaksi` int NOT NULL AUTO_INCREMENT,
  `no_statustransaksi` char(100) DEFAULT NULL,
  `respon_pesanan` int DEFAULT NULL,
  `status_pengiriman` int DEFAULT NULL,
  `no_resi` char(100) DEFAULT NULL,
  `status_ekspedisi` char(100) DEFAULT NULL,
  `konfirmasi_penerimaan` int DEFAULT NULL,
  `no_statuspembayaran` char(100) DEFAULT NULL,
  PRIMARY KEY (`id_statustransaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `stok`;
CREATE TABLE `stok` (
  `id_stok` int NOT NULL AUTO_INCREMENT,
  `nama` char(100) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `id_kategoristok` int DEFAULT NULL,
  `user` char(100) DEFAULT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `subscribe`;
CREATE TABLE `subscribe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `telepon` char(100) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `testimoni`;
CREATE TABLE `testimoni` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` char(100) DEFAULT NULL,
  `gambar` text,
  `testimoni` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `time`;
CREATE TABLE `time` (
  `id` int NOT NULL AUTO_INCREMENT,
  `waktu` text,
  `konten` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `twitter`;
CREATE TABLE `twitter` (
  `id_twitter` int NOT NULL AUTO_INCREMENT,
  `twitter` text NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_twitter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(200) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `jenkel` char(50) NOT NULL,
  `hp` char(20) NOT NULL,
  `telp` char(20) NOT NULL,
  `level` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gambar_utama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `user` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `last_sign` datetime DEFAULT NULL,
  `generator` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `embed` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `webmaster`;
CREATE TABLE `webmaster` (
  `id_webmaster` int NOT NULL AUTO_INCREMENT,
  `webmaster` text,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_webmaster`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `why`;
CREATE TABLE `why` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text,
  `detail` text,
  `user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `youtube`;
CREATE TABLE `youtube` (
  `id_youtube` int NOT NULL AUTO_INCREMENT,
  `youtube` text NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_youtube`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- 2023-05-20 10:55:45
