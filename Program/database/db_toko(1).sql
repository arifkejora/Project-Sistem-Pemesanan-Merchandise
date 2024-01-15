-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2024 pada 15.12
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `tglorder` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'Cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`idcart`, `orderid`, `userid`, `tglorder`, `status`) VALUES
(15, '16vMCk5cT9quw', 4, '2022-05-21 08:29:00', 'Selesai'),
(16, '16g35ImKgZ3cI', 4, '2022-05-21 08:49:59', 'Selesai'),
(17, '17v3GpLwuxOd.', 3, '2023-12-23 14:20:33', 'Selesai'),
(18, '17xsE/JTT1TEQ', 3, '2023-12-23 14:22:00', 'Selesai'),
(19, '17.RxDF5REnu2', 3, '2023-12-23 14:23:16', 'Cart'),
(20, '17IoJzZ/W9drI', 7, '2024-01-14 07:20:50', 'Selesai'),
(21, '17uV/msXOUcyo', 7, '2024-01-14 07:27:37', 'Selesai'),
(22, '17FA00aSrNWdk', 7, '2024-01-14 07:37:31', 'Cart');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailorder`
--

CREATE TABLE `detailorder` (
  `detailid` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detailorder`
--

INSERT INTO `detailorder` (`detailid`, `orderid`, `idproduk`, `qty`) VALUES
(21, '17v3GpLwuxOd.', 23, 1),
(22, '17xsE/JTT1TEQ', 23, 2),
(23, '17.RxDF5REnu2', 23, 2),
(24, '17IoJzZ/W9drI', 23, 5),
(25, '17uV/msXOUcyo', 23, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(20) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `tgldibuat`) VALUES
(4, 'Jersey', '2023-12-23 14:12:40'),
(5, 'Device', '2024-01-14 07:34:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `idkonfirmasi` int(11) NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `namarekening` varchar(25) NOT NULL,
  `tglbayar` date NOT NULL,
  `tglsubmit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`idkonfirmasi`, `orderid`, `userid`, `payment`, `namarekening`, `tglbayar`, `tglsubmit`) VALUES
(1, '15PzF03ejd8W2', 1, 'Bank BCA', 'Admin', '2020-05-16', '2020-05-13 02:41:51'),
(2, '16KUZ1wKc7fLY', 1, 'BANK BCA', 'Fiqri', '0000-00-00', '2022-05-20 09:10:06'),
(3, '16iI9ToBA9NZU', 1, 'BANK BCA', 'Ariefff', '2022-02-05', '2022-05-20 09:13:48'),
(5, '17v3GpLwuxOd.', 3, 'Mandiri', 'Arif Kejora', '2023-12-23', '2023-12-23 14:21:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgljoin` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(7) NOT NULL DEFAULT 'Member',
  `lastlogin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`userid`, `namalengkap`, `email`, `password`, `notelp`, `alamat`, `tgljoin`, `role`, `lastlogin`) VALUES
(1, 'Admin', 'admin', '$2y$10$GJVGd4ji3QE8ikTBzNyA0uLQhiGd6MirZeSJV1O6nUpjSVp1eaKzS', '01234567890', 'Indonesia', '2020-03-16 11:31:17', 'Admin', NULL),
(2, 'Guest', 'guest', '$2y$10$xXEMgj5pMT9EE0QAx3QW8uEn155Je.FHH5SuIATxVheOt0Z4rhK6K', '01234567890', 'Indonesia', '2020-03-16 11:30:40', 'Member', NULL),
(3, 'Arif', 'arif@gmail.com', '$2y$10$xllPnurGcSsbSJwmcpaUn.h.H6S/Yzhk4dYh5M8nCv4xCFfckHWM6', '081225762946', 'Sleman', '2022-05-18 08:55:45', 'Member', NULL),
(4, 'lilik', 'lilik@gmail.com', '$2y$10$qd/p0XveYrGKIVOus0BN/.L2hNOhpOiZaSw40nKVyeDGbDc7WTlcO', '123456789', 'Klaten', '2022-05-21 07:24:29', 'Member', NULL),
(5, 'Lesti', 'lesti@gmail.com', '$2y$10$17pmTMP3Omia4kQ.g7mlk.zC8S7vNiDJ2/E/SbI6RfJ5q2OLpn9Kq', '089678234567', 'Pasar Minggu', '2023-12-23 14:08:55', 'Admin', NULL),
(6, 'Muhammad Rizky Billar', 'rizkibillar@gmail.com', '$2y$10$SDvBH6520zZ9XVitWBVFbuAgA5AF0MOp3Em4rLLFCo/PgMRcDij6q', '082345678234', 'Jalan Pondok Indah KM 15', '2023-12-28 15:43:08', 'Member', NULL),
(7, 'Arif Kazakiri', 'arifkazakiri@gmail.com', '$2y$10$17pmTMP3Omia4kQ.g7mlk.zC8S7vNiDJ2/E/SbI6RfJ5q2OLpn9Kq', '089678567234', 'Jatipadang, Pasar Minggu', '2024-01-14 07:20:39', 'Member', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no` int(11) NOT NULL,
  `metode` varchar(25) NOT NULL,
  `norek` varchar(25) NOT NULL,
  `logo` text DEFAULT NULL,
  `an` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`no`, `metode`, `norek`, `logo`, `an`) VALUES
(10, 'Transfer Bank', '322923456789332445', 'data:image/png;base64,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', 'BT Banteng Merah Ind'),
(11, 'Transfer Bank', '322923456789332445', 'data:image/png;base64,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', 'BT Banteng Merah Ind');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `rate` int(11) NOT NULL,
  `stok` int(50) NOT NULL,
  `hargabefore` int(11) NOT NULL,
  `hargaafter` int(11) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `gambar`, `deskripsi`, `rate`, `stok`, `hargabefore`, `hargaafter`, `tgldibuat`) VALUES
(23, 4, 'Bulls New Era', 'produk/179RxJF2hr9SI.jpg', 'Bulls New Era', 4, 20, 249000, 199000, '2023-12-23 14:18:31'),
(25, 5, 'Iphone 14', 'produk/17weVqOunwOdU.jpg', 'Device Highend', 5, 22, 20000000, 15600000, '2024-01-14 08:14:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`),
  ADD UNIQUE KEY `orderid` (`orderid`),
  ADD KEY `orderid_2` (`orderid`);

--
-- Indeks untuk tabel `detailorder`
--
ALTER TABLE `detailorder`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`idkonfirmasi`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `detailorder`
--
ALTER TABLE `detailorder`
  MODIFY `detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `idkonfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detailorder`
--
ALTER TABLE `detailorder`
  ADD CONSTRAINT `idproduk` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderid` FOREIGN KEY (`orderid`) REFERENCES `cart` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `login` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `idkategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
