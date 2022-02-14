-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2022 pada 16.30
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pegadaian3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `kode_cabang` varchar(100) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `kode_toko` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`kode_cabang`, `nama_cabang`, `alamat`, `no_telp`, `kode_toko`) VALUES
('FG00', 'SUPERADMIN', 'SUPERADMIN', '', 'SUPERADMIN'),
('FG01', 'FLOBAMORA GADAI PADMA', 'Jl. Padma No. 89 Penatih', '081 337 995 667', 'FG1'),
('FG02', 'FLOBAMORA GADAI SEROJA', 'Jalan Seroja no.59, bali', '081 337 995 667', 'FG2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori`
--

CREATE TABLE `histori` (
  `id_histori` int(100) NOT NULL,
  `kode_pinjaman_gadai` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `dana` varchar(250) NOT NULL,
  `jenis` enum('penebusan','perpanjangan','denda') NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `histori`
--

INSERT INTO `histori` (`id_histori`, `kode_pinjaman_gadai`, `tanggal`, `dana`, `jenis`, `keterangan`) VALUES
(1, 'FG1-6140222', '2022-02-14', '10000', 'perpanjangan', 'test'),
(2, 'FG1-5100222', '2022-02-14', '50000', 'perpanjangan', 'test2'),
(3, 'FG1-3100222', '2022-02-14', '100000', 'penebusan', 'test3'),
(4, 'FG1-5100222', '2022-02-14', '500000', 'penebusan', 'test4'),
(5, 'FG1-7140222', '2022-02-14', '15000', 'denda', 'TEST1'),
(6, 'FG1-9140222', '2022-02-14', '500000', 'penebusan', 'Lunaz1'),
(7, 'FG1-9140222', '2022-02-14', '25000', 'denda', 'Lunaz1'),
(8, 'FG1-10140222', '2022-02-14', '500000', 'denda', 'Coba tebus lelang'),
(9, 'FG1-10140222', '2022-02-14', '500000', 'penebusan', 'Coba tebus lelang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(11) UNSIGNED NOT NULL,
  `jumlah_kas` float NOT NULL,
  `sisa_kas` float NOT NULL,
  `tgl_masuk` timestamp NULL DEFAULT NULL,
  `tgl_keluar` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kode_cabang` varchar(100) NOT NULL,
  `jenis` enum('masuk','keluar','pembayaran','lelang','pembatalan') NOT NULL,
  `kode_transaksi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kas`
--

INSERT INTO `kas` (`id_kas`, `jumlah_kas`, `sisa_kas`, `tgl_masuk`, `tgl_keluar`, `keterangan`, `kode_cabang`, `jenis`, `kode_transaksi`) VALUES
(23, 10000000, 10000000, '2022-01-31 09:17:12', '2022-01-31 09:17:12', 'saldo perdana', 'FG01', 'masuk', ''),
(24, 500000, 9500000, '2022-01-31 09:30:40', '2022-01-31 09:30:40', 'Transaksi Pegadaian Baru dengan kode FG1-13101', 'FG01', 'keluar', ''),
(25, 1000000, 8500000, '2022-01-31 09:31:57', '2022-01-31 09:31:57', 'Transaksi Pegadaian Baru dengan kode FG1-23101', 'FG01', 'keluar', ''),
(26, 1000000, 9500000, '2022-01-31 09:34:16', '2022-01-31 09:34:16', 'Tebus laptop gede', 'FG01', 'pembayaran', ''),
(27, 1000000, 8500000, '2022-01-31 10:04:16', '2022-01-31 10:04:16', 'Transaksi Pegadaian Baru dengan kode FG1-33101', 'FG01', 'keluar', ''),
(28, 500000, 9000000, '2022-01-31 10:09:03', '2022-01-31 10:09:03', 'Pembatalan Transaksi FG1-13101. Dana Sudah dikembalikan ke saldo', 'FG01', 'pembatalan', ''),
(29, 500000, 8500000, '2022-01-31 10:12:27', '2022-01-31 10:12:27', 'Transaksi Pegadaian Baru dengan kode FG1-33101', 'FG01', 'keluar', ''),
(30, 500000, 8000000, '2022-01-31 10:25:03', '2022-01-31 10:25:03', 'Transaksi Pegadaian Baru dengan kode FG1-23101', 'FG01', 'keluar', ''),
(31, 500000, 7500000, '2022-01-31 19:16:53', '2022-01-31 19:16:53', 'Transaksi Pegadaian Baru dengan kode FG1-30102', 'FG01', 'keluar', ''),
(32, 500000, 8000000, '2022-01-31 19:17:04', '2022-01-31 19:17:04', 'Pembatalan Transaksi FG1-30102. Dana Sudah dikembalikan ke saldo', 'FG01', 'pembatalan', ''),
(33, 500000, 7500000, '2022-01-31 19:17:31', '2022-01-31 19:17:31', 'Transaksi Pegadaian Baru dengan kode FG1-30102', 'FG01', 'keluar', ''),
(34, 500000, 7000000, '2022-01-31 19:19:44', '2022-01-31 19:19:44', 'Transaksi Pegadaian Baru dengan kode FG1-40102', 'FG01', 'keluar', ''),
(35, 500000, 7500000, '2022-01-31 19:20:00', '2022-01-31 19:20:00', 'Pembatalan Transaksi FG1-30102. Dana Sudah dikembalikan ke saldo', 'FG01', 'pembatalan', ''),
(36, 500000, 7000000, '2022-02-01 01:29:47', '2022-02-01 01:29:47', 'Transaksi Pegadaian Baru dengan kode FG1-20102', 'FG01', 'keluar', ''),
(37, 500000, 6500000, '2022-02-01 01:36:11', '2022-02-01 01:36:11', 'Transaksi Pegadaian Baru dengan kode FG1-30102', 'FG01', 'keluar', ''),
(38, 500000, 6000000, '2022-02-01 01:40:10', '2022-02-01 01:40:10', 'Transaksi Pegadaian Baru dengan kode FG1-50102', 'FG01', 'keluar', ''),
(39, 500000, 5500000, '2022-02-01 01:49:42', '2022-02-01 01:49:42', 'Transaksi Pegadaian Baru dengan kode FG1-60102', 'FG01', 'keluar', ''),
(40, 500000, 6000000, '2022-02-01 02:54:08', '2022-02-01 02:54:08', 'Transfer,', 'FG01', 'pembayaran', ''),
(41, 1500000, 4500000, '2022-02-01 03:41:51', '2022-02-01 03:41:51', 'Transaksi Pegadaian Baru dengan kode FG1-70102', 'FG01', 'keluar', ''),
(42, 4000000, 500000, '2022-02-01 05:00:12', '2022-02-01 05:00:12', 'Transaksi Pegadaian Baru dengan kode FG1-80102', 'FG01', 'keluar', ''),
(43, 500000, 1000000, '2022-02-01 05:51:13', '2022-02-01 05:51:13', 'Lelang', 'FG01', 'lelang', ''),
(44, 500000, 500000, '2022-02-01 07:15:24', '2022-02-01 07:15:24', 'Transaksi Pegadaian Baru dengan kode FG1-10102', 'FG01', 'keluar', ''),
(45, 1000000, 1500000, '2022-02-05 00:01:51', '2022-02-05 00:01:51', 'TF', 'FG01', 'pembayaran', ''),
(46, 10000000, 10000000, '2022-02-05 03:16:40', '2022-02-05 03:16:40', 'pertama', 'FG02', 'masuk', ''),
(47, 500000, 9500000, '2022-02-05 03:18:06', '2022-02-05 03:18:06', 'Transaksi Pegadaian Baru dengan kode FG2-30502', 'FG02', 'keluar', ''),
(48, 500000, 10000000, '2022-02-05 03:22:13', '2022-02-05 03:22:13', 'Transfer,asd', 'FG02', 'pembayaran', ''),
(49, 700000, 10700000, '2022-02-05 03:37:32', '2022-02-05 03:37:32', 'Lelang', 'FG02', 'lelang', ''),
(50, 1000000, 9700000, '2022-02-05 03:52:35', '2022-02-05 03:52:35', 'Transaksi Pegadaian Baru dengan kode FG2-40502', 'FG02', 'keluar', ''),
(51, 1000000, 10700000, '2022-02-05 03:57:16', '2022-02-05 03:57:16', 'cash', 'FG02', 'pembayaran', ''),
(52, 2000000, 12700000, '2022-02-05 04:00:25', '2022-02-05 04:00:25', 'Lelang', 'FG02', 'lelang', ''),
(53, 500000, 1000000, '2022-02-09 05:49:05', '2022-02-09 05:49:05', 'Transaksi Pegadaian Baru dengan kode FG1-1090222', 'FG01', 'keluar', ''),
(54, 500000, 500000, '2022-02-09 06:06:52', '2022-02-09 06:06:52', 'Transaksi Pegadaian Baru dengan kode FG1-2090222', 'FG01', 'keluar', ''),
(55, 300000, 200000, '2022-02-09 06:10:51', '2022-02-09 06:10:51', 'Transaksi Pegadaian Baru dengan kode FG1-3090222', 'FG01', 'keluar', ''),
(56, 300000, 500000, '2022-02-09 07:04:47', '2022-02-09 07:04:47', 'Lelang', 'FG01', 'lelang', ''),
(57, 300000, 200000, '2022-02-09 08:19:18', '2022-02-09 08:19:18', 'Transaksi Pegadaian Baru dengan kode FG1-2090222', 'FG01', 'keluar', ''),
(58, 100000, 100000, '2022-02-10 05:21:54', '2022-02-10 05:21:54', 'Transaksi Pegadaian Baru dengan kode FG1-3100222', 'FG01', 'keluar', ''),
(59, 100000, 1000000, '2022-02-10 06:19:28', '2022-02-10 06:19:28', 'Transaksi Pegadaian Baru dengan kode FG1-4100222', 'FG01', 'keluar', ''),
(60, 500000, 500000, '2022-02-10 07:55:03', '2022-02-10 07:55:03', 'Transaksi Pegadaian Baru dengan kode FG1-5100222', 'FG01', 'keluar', ''),
(61, 100000, 600000, '2022-02-11 03:34:43', '2022-02-11 03:34:43', 'Lunas', 'FG01', 'pembayaran', ''),
(62, 100000, 500000, '2022-02-14 03:27:46', '2022-02-14 03:27:46', 'Transaksi Pegadaian Baru dengan kode FG1-6140222', 'FG01', 'keluar', ''),
(63, 300000, 800000, '2022-02-14 03:58:13', '2022-02-14 03:58:13', 'Lunas', 'FG01', 'pembayaran', ''),
(64, 100000, 900000, '2022-02-14 08:16:50', '2022-02-14 08:16:50', 'test3', 'FG01', 'pembayaran', ''),
(65, 500000, 1400000, '2022-02-14 08:18:15', '2022-02-14 08:18:15', 'test4', 'FG01', 'pembayaran', ''),
(66, 100000, 1300000, '2022-02-14 08:22:48', '2022-02-14 08:22:48', 'Transaksi Pegadaian Baru dengan kode FG1-7140222', 'FG01', 'keluar', ''),
(67, 100000, 1200000, '2022-02-14 08:32:48', '2022-02-14 08:32:48', 'Transaksi Pegadaian Baru dengan kode FG1-8140222', 'FG01', 'keluar', ''),
(68, 100000, 1300000, '2022-02-14 08:33:28', '2022-02-14 08:33:28', 'Lunas1', 'FG01', 'pembayaran', ''),
(69, 500000, 800000, '2022-02-14 08:34:59', '2022-02-14 08:34:59', 'Transaksi Pegadaian Baru dengan kode FG1-9140222', 'FG01', 'keluar', ''),
(70, 500000, 1300000, '2022-02-14 08:39:16', '2022-02-14 08:39:16', 'Lunaz1', 'FG01', 'pembayaran', ''),
(71, 500000, 800000, '2022-02-14 08:41:33', '2022-02-14 08:41:33', 'Transaksi Pegadaian Baru dengan kode FG1-10140222', 'FG01', 'keluar', ''),
(72, 500000, 1300000, '2022-02-14 08:47:50', '2022-02-14 08:47:50', 'Lelang', 'FG01', 'lelang', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_barang` int(100) NOT NULL,
  `nama_barang` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_barang`, `nama_barang`) VALUES
(1, 'Laptop'),
(2, 'HP'),
(3, 'Motor'),
(4, 'Elektronik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lelang`
--

CREATE TABLE `lelang` (
  `id_lelang` int(50) NOT NULL,
  `kode_pinjaman` varchar(100) NOT NULL,
  `hasil_lelang` int(50) NOT NULL,
  `tgl_lelang` date NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `kodeCabang` varchar(150) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lelang`
--

INSERT INTO `lelang` (`id_lelang`, `kode_pinjaman`, `hasil_lelang`, `tgl_lelang`, `nama_barang`, `kodeCabang`, `keterangan`) VALUES
(1, 'FG1-50102', 600000, '2022-01-31', '1', 'FG01', ''),
(2, 'FG2-540101', 1500000, '2022-02-04', '1', 'FG02', ''),
(3, 'FG2-550101', 2500000, '2022-02-05', '1', 'FG02', ''),
(4, 'FG1-3090222', 2000000, '2022-02-09', '3', 'FG01', 'Terlelang'),
(5, 'FG1-10140222', 1000000, '2022-02-03', 'Laptop', 'FG01', 'Coba tebus lelang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-01-03-080231', 'App\\Database\\Migrations\\Nasabah', 'default', 'App', 1641285754, 1),
(2, '2022-01-03-080340', 'App\\Database\\Migrations\\Cabang', 'default', 'App', 1641285754, 1),
(3, '2022-01-03-080356', 'App\\Database\\Migrations\\PinjamanGadai', 'default', 'App', 1641285754, 1),
(4, '2022-01-03-080403', 'App\\Database\\Migrations\\Pembayaran', 'default', 'App', 1641285754, 1),
(5, '2022-01-03-080411', 'App\\Database\\Migrations\\Peraturan', 'default', 'App', 1641285754, 1),
(6, '2022-01-03-080416', 'App\\Database\\Migrations\\Perpanjangan', 'default', 'App', 1641285754, 1),
(7, '2022-01-03-080420', 'App\\Database\\Migrations\\Kas', 'default', 'App', 1641285754, 1),
(8, '2022-01-04-084948', 'App\\Database\\Migrations\\User', 'default', 'App', 1641286892, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `alamat_nasabah` text DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `kode_cabang` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nama`, `nik`, `alamat_nasabah`, `no_telp`, `kode_cabang`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Agustika', '191532308112323', 'saswadwd', '08120546418', 'FG01', 'Aktif', '2022-02-09 05:34:43', '2022-02-09 05:34:43'),
(2, 'Dadung', '19153230811231', 'awdwaddwa', '0812054641876', 'FG01', 'Aktif', '2022-02-09 05:38:21', '2022-02-09 05:38:21'),
(3, 'Agustikaz', '19153230811231', 'jkjkjjkjk', '08120546418', 'FG01', 'aktif', '2022-02-09 06:09:48', '2022-02-09 06:09:48'),
(4, 'Grid', '19153230811232', 'etnal kingdom', '081205464180', 'FG01', 'aktif', '2022-02-10 06:18:05', '2022-02-10 06:18:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) UNSIGNED NOT NULL,
  `kode_pinjaman` varchar(100) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jumlah_bayar` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `kode_pinjaman`, `tgl_bayar`, `jumlah_bayar`, `keterangan`) VALUES
(3, 'FG1-450102', '2022-02-05', 1000000, 'TF'),
(4, 'FG2-30502', '2022-02-05', 500000, 'Transfer,asd'),
(5, 'FG2-40502', '2022-02-05', 1000000, 'cash'),
(6, 'FG1-4100222', '2022-02-11', 100000, 'Lunas'),
(7, 'FG1-2090222', '2022-02-14', 300000, 'Lunas'),
(8, 'FG1-3100222', '2022-02-14', 100000, 'test3'),
(9, 'FG1-5100222', '2022-02-14', 500000, 'test4'),
(10, 'FG1-8140222', '2022-02-14', 100000, 'Lunas1'),
(11, 'FG1-9140222', '2022-02-14', 500000, 'Lunaz1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id_pendapatan` int(100) NOT NULL,
  `jumlah_untung` float NOT NULL,
  `kd_pinjaman` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL DEFAULT current_timestamp(),
  `jenis` enum('Bunga','Denda','Lelang') NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendapatan`
--

INSERT INTO `pendapatan` (`id_pendapatan`, `jumlah_untung`, `kd_pinjaman`, `tgl_masuk`, `jenis`, `keterangan`) VALUES
(22, 150000, 'FG1-130102', '2022-02-05', 'Bunga', ''),
(23, 150000, 'FG1-130102', '2022-02-05', 'Bunga', ''),
(24, 50000, 'FG2-30502', '2022-02-05', 'Bunga', ''),
(25, 220000, 'FG2-700101', '2022-02-05', 'Bunga', ''),
(26, 112500, 'FG2-690101', '2022-02-05', 'Denda', ''),
(27, 800000, 'FG2-540101', '2022-02-05', 'Lelang', ''),
(28, 100000, 'FG2-40502', '2022-02-05', 'Bunga', ''),
(29, 100000, 'FG2-40502', '2022-02-05', 'Bunga', ''),
(30, 500000, 'FG2-550101', '2022-02-05', 'Lelang', ''),
(31, 787500, 'FG2-640101', '2022-02-05', 'Denda', ''),
(32, 787500, 'FG2-640101', '2022-02-05', 'Denda', ''),
(33, 50000, 'FG1-1090222', '2022-02-09', 'Bunga', ''),
(34, 50000, 'FG1-2090222', '2022-02-09', 'Bunga', ''),
(35, 30000, 'FG1-3090222', '2022-02-09', 'Bunga', ''),
(36, 1700000, 'FG1-3090222', '2022-02-09', 'Lelang', 'Terlelang'),
(37, 50000, 'FG1-2090222', '2022-02-09', 'Bunga', 'Perpanjang'),
(38, 30000, 'FG1-2090222', '2022-02-09', 'Bunga', ''),
(39, 10000, 'FG1-3100222', '2022-02-10', 'Bunga', ''),
(40, 10000, 'FG1-4100222', '2022-02-10', 'Bunga', ''),
(41, 50000, 'FG1-5100222', '2022-02-10', 'Bunga', ''),
(42, 5000, 'FG1-4100222', '2022-02-11', 'Denda', 'Lunas'),
(43, 10000, 'FG1-6140222', '2022-02-14', 'Bunga', ''),
(44, 75000, 'FG1-5100222', '2022-02-14', 'Denda', 'Lunas'),
(45, 15000, 'FG1-2090222', '2022-02-14', 'Denda', 'Lunas'),
(46, 10000, 'FG1-6140222', '2022-02-14', 'Bunga', 'test'),
(47, 50000, 'FG1-5100222', '2022-02-14', 'Bunga', 'test2'),
(48, 10000, 'FG1-7140222', '2022-02-14', 'Bunga', ''),
(49, 15000, 'FG1-7140222', '2022-02-14', 'Denda', 'TEST1'),
(50, 10000, 'FG1-8140222', '2022-02-14', 'Bunga', ''),
(51, 5000, 'FG1-8140222', '2022-02-14', 'Denda', 'Lunas1'),
(52, 50000, 'FG1-9140222', '2022-02-14', 'Bunga', ''),
(53, 25000, 'FG1-9140222', '2022-02-14', 'Denda', 'Lunaz1'),
(54, 50000, 'FG1-10140222', '2022-02-14', 'Bunga', ''),
(55, 500000, 'FG1-10140222', '2022-02-14', 'Lelang', 'Coba tebus lelang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peraturan`
--

CREATE TABLE `peraturan` (
  `id_peraturan` int(11) UNSIGNED NOT NULL,
  `bunga` int(3) NOT NULL,
  `denda` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `peraturan`
--

INSERT INTO `peraturan` (`id_peraturan`, `bunga`, `denda`) VALUES
(1, 10, 5),
(2, 15, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perpanjangan`
--

CREATE TABLE `perpanjangan` (
  `id_perpanjangan` int(11) UNSIGNED NOT NULL,
  `kode_pinjamann` varchar(100) NOT NULL,
  `tgl_perpanjangan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `perpanjangan`
--

INSERT INTO `perpanjangan` (`id_perpanjangan`, `kode_pinjamann`, `tgl_perpanjangan`) VALUES
(5, 'FG1-130102', '2022-03-01'),
(6, 'FG1-130102', '2022-03-10'),
(7, 'FG2-700101', '2022-03-06'),
(8, 'FG2-40502', '2022-04-05'),
(9, 'FG1-2090222', '2022-04-01'),
(10, 'FG1-6140222', '2022-03-14'),
(11, 'FG1-5100222', '2022-04-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjamangadai`
--

CREATE TABLE `pinjamangadai` (
  `kode_pinjaman` varchar(50) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `jenis_barang` int(11) DEFAULT NULL,
  `seri` varchar(100) DEFAULT NULL,
  `kelengkapan` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kondisi` varchar(250) DEFAULT NULL,
  `tgl_gadai` date DEFAULT NULL,
  `tgl_jatuh_tempo` date DEFAULT NULL,
  `tgl_lelang` date DEFAULT NULL,
  `jumlah_pinjaman` double DEFAULT NULL,
  `bunga` float DEFAULT NULL,
  `kode_cabang` varchar(100) DEFAULT NULL,
  `status_bayar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pinjamangadai`
--

INSERT INTO `pinjamangadai` (`kode_pinjaman`, `id_nasabah`, `jenis_barang`, `seri`, `kelengkapan`, `password`, `jumlah`, `kondisi`, `tgl_gadai`, `tgl_jatuh_tempo`, `tgl_lelang`, `jumlah_pinjaman`, `bunga`, `kode_cabang`, `status_bayar`) VALUES
('FG1-10140222', 2, 1, 'GOLDEN', 'sds', '', 1, 'dawdaw', '2022-02-01', '2022-02-02', '2022-02-03', 500000, 50000, 'FG01', 'TERLELANG'),
('FG1-2090222', 1, 1, 'RDNB', 'dwadaw', '', 1, 'dwadwddw', '2022-02-09', '2022-02-09', '2022-02-09', 300000, 30000, 'FG01', 'Lunas'),
('FG1-3090222', 3, 3, 'supra', 'roda dan rantai', '', 1, 'penyok', '2022-02-08', '2022-02-08', '2022-02-09', 300000, 30000, 'FG01', 'TERLELANG'),
('FG1-3100222', 3, 3, 'RDNB', 'sdadwwwad', '', 1, 'baru dan masih mulus', '2022-02-10', '2022-03-10', '2022-03-10', 100000, 10000, 'FG01', 'Lunas'),
('FG1-4100222', 4, 4, 'GOLDEN', 'sdawnk', '', 1, 'dawwkl', '2022-02-09', '2022-02-09', '2022-02-10', 100000, 10000, 'FG01', 'Lunas'),
('FG1-5100222', 3, 1, 'GOLDEN', 'abcscsaic', '', 1, 'dwadjnkd', '2022-02-10', '2022-04-10', '2022-04-11', 500000, 50000, 'FG01', 'Lunas'),
('FG1-6140222', 1, 1, 'RDNB', 'kjb', '', 2, 'kjvb', '2022-02-14', '2022-03-14', '2022-03-15', 100000, 10000, 'FG01', 'Belum Lunas'),
('FG1-7140222', 4, 2, 'OPPO A3', 'CAS', 'DADUNG123', 1, 'RUSAK PARAH', '2022-02-13', '2022-03-13', '2022-03-13', 100000, 10000, 'FG01', 'Belum Lunas'),
('FG1-8140222', 3, 2, 'ASU S6', 'DUS', 'BABI1111', 1, 'CACAT', '2022-02-01', '2022-02-02', '2022-02-03', 100000, 10000, 'FG01', 'Lunas'),
('FG1-9140222', 4, 2, '123432', 'SDAW', 'DWAWS', 1, 'DWDWAD', '2022-02-01', '2022-02-02', '2022-02-03', 500000, 50000, 'FG01', 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `cabang` varchar(150) NOT NULL,
  `level` enum('superadmin','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `cabang`, `level`) VALUES
(9, 'SUPERADMIN 1', 'superadmin1', '$2y$10$VItbz6APqbkqJDLeLs/seuzdR8U1JV.CoeWmC3L1ARzShMpqvS6Ei', 'FG00', 'superadmin'),
(10, 'Admin Padma', 'cabpadma', '$2y$10$QUhofnpO4dOrHWdVhEi1o.6z6YbyC.zUiXLwLz.4zzE43yYUTcAXy', 'FG01', 'admin'),
(11, 'ADMIN 2', 'admin2', '$2y$10$5GygPfzmMGlAKZYVYKN9I.4bStxCZ.hsw3wKyDrfKahfIaau20eLK', 'FG02', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`kode_cabang`);

--
-- Indeks untuk tabel `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`id_histori`);

--
-- Indeks untuk tabel `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `lelang`
--
ALTER TABLE `lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indeks untuk tabel `peraturan`
--
ALTER TABLE `peraturan`
  ADD PRIMARY KEY (`id_peraturan`);

--
-- Indeks untuk tabel `perpanjangan`
--
ALTER TABLE `perpanjangan`
  ADD PRIMARY KEY (`id_perpanjangan`);

--
-- Indeks untuk tabel `pinjamangadai`
--
ALTER TABLE `pinjamangadai`
  ADD PRIMARY KEY (`kode_pinjaman`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_barang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `peraturan`
--
ALTER TABLE `peraturan`
  MODIFY `id_peraturan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `perpanjangan`
--
ALTER TABLE `perpanjangan`
  MODIFY `id_perpanjangan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
