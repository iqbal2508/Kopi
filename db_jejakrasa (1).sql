-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Apr 2026 pada 14.11
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jejakrasa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `qty`, `harga_satuan`, `subtotal`) VALUES
(22, 'INV-20260412-204735', 8, 1, 25000, 25000),
(25, 'INV-20260412-205933', 7, 1, 20000, 20000),
(26, 'INV-20260412-212941', 7, 1, 20000, 20000),
(27, 'INV-20260412-212941', 8, 1, 25000, 25000),
(28, 'INV-20260412-213051', 7, 1, 20000, 20000),
(29, 'INV-20260412-213051', 8, 1, 25000, 25000),
(30, 'INV-20260412-215459', 8, 1, 25000, 25000),
(31, 'INV-20260412-215634', 8, 1, 25000, 25000),
(32, 'INV-20260412-215654', 7, 1, 20000, 20000),
(33, 'INV-20260412-220042', 7, 1, 20000, 20000),
(34, 'INV-20260412-222835', 7, 2, 20000, 40000),
(35, 'INV-20260412-223754', 7, 1, 20000, 20000),
(36, 'INV-20260412-223754', 8, 2, 25000, 50000),
(37, 'INV-20260412-223826', 8, 1, 25000, 25000),
(38, 'INV-20260412-224730', 7, 1, 20000, 20000),
(39, 'INV-20260412-224730', 8, 1, 25000, 25000),
(40, 'INV-20260412-233405', 7, 1, 20000, 20000),
(41, 'INV-20260412-233405', 8, 1, 25000, 25000),
(42, 'POS-20260413-1859', 8, 1, 25000, 25000),
(43, 'INV-20260414-191216', 7, 1, 20000, 20000),
(44, 'INV-20260414-195223', 8, 3, 25000, 75000),
(45, 'INV-20260414-213619', 8, 1, 25000, 25000),
(46, 'INV-20260419-213700', 7, 2, 20000, 40000),
(47, 'INV-20260419-222950', 7, 1, 20000, 20000),
(48, 'INV-20260419-222958', 8, 1, 25000, 25000),
(49, 'INV-20260419-223005', 8, 1, 25000, 25000),
(50, 'INV-20260419-223045', 7, 1, 20000, 20000),
(51, 'INV-20260419-223052', 8, 1, 25000, 25000),
(52, 'INV-20260419-180613', 8, 2, 25000, 50000),
(55, 'INV-20260420-172259', 9, 1, 40000, 40000),
(56, 'INV-20260420-172259', 10, 1, 14500, 14500),
(57, 'INV-20260420-172457', 7, 1, 20000, 20000),
(58, 'INV-20260420-172457', 8, 1, 25000, 25000),
(59, 'INV-20260420-180427', 9, 1, 40000, 40000),
(60, 'INV-20260420-180427', 10, 1, 14500, 14500),
(61, 'INV-20260420-180427', 8, 1, 25000, 25000),
(65, 'INV-20260420-180616', 8, 1, 25000, 25000),
(66, 'INV-20260420-183819', 10, 1, 14500, 14500),
(67, 'INV-20260420-183819', 8, 1, 25000, 25000),
(68, 'INV-20260423-160646', 7, 1, 20000, 20000),
(69, 'INV-20260423-160646', 8, 1, 25000, 25000),
(70, 'INV-20260423-160646', 10, 1, 14500, 14500),
(71, 'INV-20260423-175738', 8, 1, 25000, 25000),
(72, 'INV-20260423-180139', 7, 1, 20000, 20000),
(73, 'INV-20260423-180205', 7, 1, 20000, 20000),
(74, 'INV-20260423-180224', 7, 2, 20000, 40000),
(75, 'INV-20260423-180252', 10, 1, 14500, 14500),
(76, 'INV-20260423-181345', 10, 1, 14500, 14500),
(77, 'INV-20260423-181523', 10, 1, 14500, 14500),
(78, 'INV-20260423-181946', 10, 1, 14500, 14500),
(79, 'INV-20260423-182216', 10, 1, 14500, 14500),
(80, 'INV-20260425-184824', 8, 2, 25000, 50000),
(81, 'INV-20260425-185715', 12, 1, 12000, 12000),
(82, 'INV-20260425-190001', 8, 1, 25000, 25000),
(83, 'INV-20260425-195242', 7, 1, 20000, 20000),
(84, 'INV-20260425-195242', 8, 1, 25000, 25000),
(85, 'POS-20260426-0108', 12, 1, 12000, 12000),
(86, 'POS-20260426-0108', 8, 1, 25000, 25000),
(87, 'POS-20260426-0111', 8, 1, 25000, 25000),
(88, 'POS-20260426-0111', 12, 1, 12000, 12000),
(89, 'POS-20260426-0111', 7, 1, 20000, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Kopi Susu'),
(2, 'Kopi Hitam'),
(3, 'Non-Kopi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `catatan_tambahan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `id_user`, `id_produk`, `qty`, `catatan_tambahan`) VALUES
(46, 7, 8, 1, ''),
(53, 8, 8, 1, ''),
(75, 10, 8, 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keuangan`
--

CREATE TABLE `tb_keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `modal` int(11) NOT NULL,
  `pendapatan` int(11) NOT NULL,
  `laba_rugi` int(11) NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_keuangan`
--

INSERT INTO `tb_keuangan` (`id_keuangan`, `bulan`, `modal`, `pendapatan`, `laba_rugi`, `waktu_input`) VALUES
(14, '2026-04', 430000, 344650, -85350, '2026-04-25 17:31:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `tanggal`, `nama_barang`, `harga`) VALUES
(1, '2026-04-01', 'Gelas 2 biji', 20000),
(3, '2026-04-25', 'Sendok 20 Biji', 10000),
(4, '2026-04-25', 'Biji Kopi ', 400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_modal` int(11) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `harga_modal`, `stok`, `gambar`) VALUES
(7, 2, 'Kopi Hitam', 'Kopi Nikmat', 20000, 0, 43, 'kopi-20260405181343.jpg'),
(8, 1, 'Kopi Susu', 'Kopi Dari Susu', 25000, 0, 20, 'kopi-20260405181414.jpg'),
(12, 3, 'Kopi Botol', '', 12000, 0, 9, 'kopi-20260425184940.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_promo`
--

CREATE TABLE `tb_promo` (
  `id_promo` int(11) NOT NULL,
  `nama_promo` varchar(100) NOT NULL,
  `diskon_persen` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `banner_gambar` varchar(255) DEFAULT NULL,
  `status_aktif` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_promo`
--

INSERT INTO `tb_promo` (`id_promo`, `nama_promo`, `diskon_persen`, `keterangan`, `banner_gambar`, `status_aktif`) VALUES
(1, 'Promo Jumat Berkah', 20, 'Nikmati diskon 20% untuk semua varian Es Kopi Susu. Bikin harimu makin segar!', 'promo1.jpg', 'Y'),
(2, 'Paket Nongkrong', 15, 'Potongan 15% untuk pembelian minimal 3 cup Kopi apa saja. Cocok buat ngopi bareng teman!', 'promo2.jpg', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT current_timestamp(),
  `total_bayar` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `tipe_pesanan` varchar(50) NOT NULL,
  `status_pesanan` enum('Menunggu Pembayaran','Diproses','Siap Diambil','Selesai') NOT NULL,
  `is_deleted_dashboard` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `provinsi`, `kota`, `tgl_transaksi`, `total_bayar`, `metode_pembayaran`, `tipe_pesanan`, `status_pesanan`, `is_deleted_dashboard`) VALUES
('INV-20260420-180616', 10, 'DKI Jakarta', 'Bekasi', '2026-04-20 23:06:16', 25000, 'QRIS', 'Di Antar', 'Selesai', 1),
('INV-20260420-183819', 10, 'DKI Jakarta', 'Tangerang', '2026-04-20 23:38:19', 39500, 'QRIS', 'Datang ke Rumah', 'Selesai', 1),
('INV-20260423-160646', 10, 'DKI Jakarta', 'Bekasi', '2026-04-23 21:06:46', 59500, 'Bayar di Tempat', 'Datang ke Rumah', 'Selesai', 1),
('INV-20260423-175738', 12, 'DKI Jakarta', 'Bekasi', '2026-04-23 22:57:38', 25000, 'QRIS', 'Di Antar', 'Selesai', 1),
('INV-20260423-180139', 11, 'DKI Jakarta', 'Jakarta Timur', '2026-04-23 23:01:39', 20000, 'QRIS', 'Di Antar', 'Selesai', 1),
('INV-20260423-180205', 11, 'DKI Jakarta', 'Tangerang Selatan', '2026-04-23 23:02:05', 20000, 'QRIS', 'Di Antar', 'Selesai', 1),
('INV-20260423-180224', 11, 'DKI Jakarta', 'Depok', '2026-04-23 23:02:24', 40000, 'QRIS', 'Di Antar', 'Selesai', 1),
('INV-20260423-180252', 11, 'DKI Jakarta', 'Jakarta Pusat', '2026-04-23 23:02:52', 14500, 'QRIS', 'Di Antar', 'Selesai', 1),
('INV-20260423-181345', 11, 'DKI Jakarta', 'Tangerang Selatan', '2026-04-23 23:13:45', 13775, 'Transfer Bank', 'Datang ke Rumah', 'Selesai', 1),
('INV-20260423-181523', 11, 'DKI Jakarta', 'Bogor', '2026-04-23 23:15:23', 0, 'Transfer Bank', 'Di Antar', 'Selesai', 1),
('INV-20260423-181946', 11, 'DKI Jakarta', 'Bogor', '2026-04-23 23:19:46', 13775, 'Transfer Bank', 'Datang ke Rumah', 'Selesai', 1),
('INV-20260423-182216', 11, 'DKI Jakarta', 'Jakarta Barat', '2026-04-23 23:22:16', 11600, 'QRIS', 'Di Antar', 'Selesai', 0),
('INV-20260425-184824', 13, 'DKI Jakarta', 'Jakarta Barat', '2026-04-25 23:48:24', 50000, 'QRIS', 'Di Antar', 'Selesai', 0),
('INV-20260425-185715', 13, 'DKI Jakarta', 'Jakarta Selatan', '2026-04-25 23:57:15', 12000, 'QRIS', 'Datang ke Rumah', 'Diproses', 0),
('INV-20260425-190001', 13, 'DKI Jakarta', 'Jakarta Selatan', '2026-04-26 00:00:01', 25000, 'QRIS', 'Di Antar', 'Selesai', 0),
('INV-20260425-195242', 14, 'DKI Jakarta', 'Bogor', '2026-04-26 00:52:42', 45000, 'QRIS', 'Di Antar', 'Diproses', 0),
('POS-20260426-0108', 0, NULL, NULL, '2026-04-26 01:08:14', 37000, 'Tunai/Kasir', 'Dine In', 'Selesai', 0),
('POS-20260426-0111', 0, NULL, NULL, '2026-04-26 01:11:56', 57000, 'Tunai/Kasir', 'Dine In', 'Selesai', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jatah_spin` int(1) NOT NULL DEFAULT 1,
  `hadiah_game` varchar(100) DEFAULT NULL,
  `role` enum('admin','pelanggan') NOT NULL DEFAULT 'pelanggan',
  `poin_loyalty` int(11) DEFAULT 0,
  `tgl_daftar` datetime DEFAULT current_timestamp(),
  `stempel_kopi` int(1) NOT NULL DEFAULT 0,
  `is_kupon_klaim` int(1) NOT NULL DEFAULT 0,
  `jatah_10detik` int(1) NOT NULL DEFAULT 3,
  `login_streak` int(11) DEFAULT 0,
  `last_checkin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nama_lengkap`, `email`, `password`, `jatah_spin`, `hadiah_game`, `role`, `poin_loyalty`, `tgl_daftar`, `stempel_kopi`, `is_kupon_klaim`, `jatah_10detik`, `login_streak`, `last_checkin`) VALUES
(1, 'Pelanggan Test', 'test@gmail.com', '12345', 1, NULL, 'pelanggan', 0, '2026-03-27 22:58:05', 0, 0, 3, 0, NULL),
(2, 'Administrator', 'admin@jejakrasa.com', 'admin123', 0, NULL, 'admin', 0, '2026-04-05 21:22:15', 5, 1, 3, 0, NULL),
(4, 'CeoKopi', 'ceo@gmail.com', 'ceo123', 1, NULL, 'admin', 0, '2026-04-05 22:58:43', 0, 0, 3, 0, NULL),
(11, 'Oco', 'oco@gmail.com', '123', 0, NULL, 'pelanggan', 0, '2026-04-23 21:56:39', 5, 1, 3, 1, '2026-04-25'),
(13, 'Muhammad Iqbal Arrasyid', 'Iqbal@gmail.com', '123', 0, 'Diskon 10%', 'pelanggan', 0, '2026-04-25 21:52:09', 2, 0, 0, 1, '2026-04-25'),
(14, 'Kucing', 'kucing@gmail.com', '123', 0, 'Kopi Gratis', 'pelanggan', 0, '2026-04-26 00:42:16', 0, 0, 3, 1, '2026-04-25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `tb_keuangan`
--
ALTER TABLE `tb_keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_promo`
--
ALTER TABLE `tb_promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `tb_keuangan`
--
ALTER TABLE `tb_keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_promo`
--
ALTER TABLE `tb_promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
