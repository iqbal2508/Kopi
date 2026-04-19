-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Apr 2026 pada 16.43
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
(46, 'INV-20260419-213700', 7, 2, 20000, 40000);

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
(46, 7, 8, 1, '');

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
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar`) VALUES
(7, 2, 'Kopi Hitam', 'Kopi Nikmat', 20000, 7, 'kopi-20260405181343.jpg'),
(8, 1, 'Kopi Susu', 'Kopi Dari Susu', 25000, 13, 'kopi-20260405181414.jpg');

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
('INV-20260412-233405', 5, NULL, NULL, '2026-04-12 23:34:05', 45000, 'QRIS', 'Take Away', 'Selesai', 1),
('INV-20260414-191216', 5, NULL, NULL, '2026-04-14 19:12:16', 20000, 'QRIS', 'Dine In', 'Menunggu Pembayaran', 0),
('INV-20260414-195223', 5, NULL, NULL, '2026-04-14 19:52:23', 75000, 'Tunai/Kasir', 'Dine In', 'Menunggu Pembayaran', 0),
('INV-20260414-213619', 7, NULL, NULL, '2026-04-14 21:36:19', 25000, 'Tunai/Kasir', 'Dine In', 'Menunggu Pembayaran', 0),
('INV-20260419-213700', 5, NULL, NULL, '2026-04-19 21:37:00', 36000, 'Tunai/Kasir', 'Dine In', 'Menunggu Pembayaran', 0),
('POS-20260413-1859', 0, NULL, NULL, '2026-04-13 18:59:21', 25000, 'QRIS', 'Dine In', 'Selesai', 1);

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
  `jatah_10detik` int(1) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nama_lengkap`, `email`, `password`, `jatah_spin`, `hadiah_game`, `role`, `poin_loyalty`, `tgl_daftar`, `stempel_kopi`, `is_kupon_klaim`, `jatah_10detik`) VALUES
(1, 'Pelanggan Test', 'test@gmail.com', '12345', 1, NULL, 'pelanggan', 0, '2026-03-27 22:58:05', 0, 0, 3),
(2, 'Administrator', 'admin@jejakrasa.com', 'admin123', 0, NULL, 'admin', 0, '2026-04-05 21:22:15', 5, 1, 3),
(3, 'Ayam', 'Ayam@gmail.com', 'ayam123', 0, 'Zonk!', 'pelanggan', 0, '2026-04-05 22:55:15', 1, 0, 3),
(4, 'CeoKopi', 'ceo@gmail.com', 'ceo123', 1, NULL, 'admin', 0, '2026-04-05 22:58:43', 0, 0, 3),
(5, 'Iqbal', 'iqbal@gmail.com', '12345', 0, NULL, 'pelanggan', 0, '2026-04-12 23:02:56', 1, 0, 0),
(6, 'Bebek', 'bebek@gmail.com', '12345', 1, NULL, 'pelanggan', 0, '2026-04-13 18:58:04', 0, 0, 3),
(7, 'Kucing', 'Kucing@gmail.com', '12345', 0, 'Diskon 20%', 'pelanggan', 0, '2026-04-14 21:32:34', 0, 0, 0);

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_promo`
--
ALTER TABLE `tb_promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
