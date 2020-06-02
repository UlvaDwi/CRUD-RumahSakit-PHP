-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Bulan Mei 2019 pada 23.18
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah_sakit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_obat`
--

CREATE TABLE `detail_obat` (
  `id_detail` int(11) NOT NULL,
  `id_inap` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_obat`
--

INSERT INTO `detail_obat` (`id_detail`, `id_inap`, `id_obat`) VALUES
(6, 1, 996),
(7, 2, 996),
(8, 3, 997);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inap`
--

CREATE TABLE `inap` (
  `id_inap` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `lama` int(10) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inap`
--

INSERT INTO `inap` (`id_inap`, `tgl_masuk`, `tgl_keluar`, `lama`, `id_pasien`, `id_kamar`, `status`) VALUES
(1, '2019-05-06', '2019-05-08', 2, 132, 1239, 0),
(2, '2019-05-07', '2019-05-09', 2, 133, 1240, 1),
(3, '2019-05-07', '2019-05-08', 1, 134, 1239, 1);

--
-- Trigger `inap`
--
DELIMITER $$
CREATE TRIGGER `penambahan kapasitas kamar` AFTER DELETE ON `inap` FOR EACH ROW BEGIN
	UPDATE kamar SET kamar.kapasitas = kamar.kapasitas + 1 WHERE kamar.id_kamar = OLD.id_kamar;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengurangan kapasitas kamar` AFTER INSERT ON `inap` FOR EACH ROW BEGIN
	UPDATE kamar SET kamar.kapasitas = kamar.kapasitas - 1 WHERE kamar.id_kamar = NEW.id_kamar;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `kapasitas` int(10) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `kelas`, `kapasitas`, `harga`) VALUES
(1239, 'Anggrek', 'Ekonomi', 10, 300000),
(1240, 'Melati', 'VIP', 9, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(20) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `harga`) VALUES
(996, 'mixagrip', 2000),
(997, 'bodrex', 3000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `jk`, `no_telp`, `alamat`) VALUES
(132, 'ulva dwi', 'Perempuan', '098777888987', 'malang'),
(133, 'siti afin', 'Perempuan', '087654345667', 'surabaya'),
(134, 'abc', 'Perempuan', '098', 'malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_inap` int(11) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `tanggal`, `id_inap`, `total`) VALUES
(4, '0000-00-00', 1, 602000),
(5, '2019-05-07', 2, 402000);

--
-- Trigger `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `bayarlunas` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN
	UPDATE inap set inap.status = '1' where inap.id_inap = new.id_inap;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status pembayaran` AFTER DELETE ON `pembayaran` FOR EACH ROW BEGIN
	update inap set inap.status = 0 where id_inap=old.id_inap;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `uid` int(10) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upass` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `uemail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`uid`, `uname`, `upass`, `fullname`, `uemail`) VALUES
(1, 'ulva', '827ccb0eea8a706c4c34', 'ulva dwi mariyani', 'ulvhadwii@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_passien`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_passien` (
`id_inap` int(11)
,`idpasien` int(11)
,`nama_pasien` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_pembayarankamar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_pembayarankamar` (
`id_inap` int(11)
,`lama` int(10)
,`harga` int(10)
,`bayarkamar` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_pembayaranobat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_pembayaranobat` (
`id_inap` int(11)
,`totalObat` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_passien`
--
DROP TABLE IF EXISTS `view_passien`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_passien`  AS  select `inap`.`id_inap` AS `id_inap`,`pasien`.`id_pasien` AS `idpasien`,`pasien`.`nama_pasien` AS `nama_pasien` from (`inap` join `pasien` on((`inap`.`id_pasien` = `pasien`.`id_pasien`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_pembayarankamar`
--
DROP TABLE IF EXISTS `view_pembayarankamar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pembayarankamar`  AS  select `inap`.`id_inap` AS `id_inap`,`inap`.`lama` AS `lama`,`kamar`.`harga` AS `harga`,(`inap`.`lama` * `kamar`.`harga`) AS `bayarkamar` from (`inap` join `kamar` on((`inap`.`id_kamar` = `kamar`.`id_kamar`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_pembayaranobat`
--
DROP TABLE IF EXISTS `view_pembayaranobat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pembayaranobat`  AS  select `inap`.`id_inap` AS `id_inap`,sum(`obat`.`harga`) AS `totalObat` from ((`inap` join `detail_obat` on((`inap`.`id_inap` = `detail_obat`.`id_inap`))) join `obat` on((`detail_obat`.`id_obat` = `obat`.`id_obat`))) group by `inap`.`id_inap` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_inap` (`id_inap`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `inap`
--
ALTER TABLE `inap`
  ADD PRIMARY KEY (`id_inap`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_inap` (`id_inap`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `inap`
--
ALTER TABLE `inap`
  MODIFY `id_inap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1241;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=998;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD CONSTRAINT `FK_detail_obat_inap` FOREIGN KEY (`id_inap`) REFERENCES `inap` (`id_inap`),
  ADD CONSTRAINT `FK_detail_obat_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Ketidakleluasaan untuk tabel `inap`
--
ALTER TABLE `inap`
  ADD CONSTRAINT `FK_inap_kamar` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`),
  ADD CONSTRAINT `FK_inap_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_pembayaran_inap` FOREIGN KEY (`id_inap`) REFERENCES `inap` (`id_inap`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
