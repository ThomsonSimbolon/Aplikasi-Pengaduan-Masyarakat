-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 29, 2024 at 08:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apk_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_aspirasi`
--

CREATE TABLE `tb_aspirasi` (
  `id_aspirasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `kategori_aspirasi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_aspirasi` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` enum('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_aspirasi`
--

INSERT INTO `tb_aspirasi` (`id_aspirasi`, `id_user`, `nik`, `kategori_aspirasi`, `deskripsi`, `tgl_aspirasi`, `tgl_update`, `lampiran`, `status`) VALUES
(13, 7, '3576014403910003', 'KDRT', 'KDRT1', '2024-06-14 17:15:47', '2024-06-14 17:15:47', '1718360106_7324956ce09cc6000dfd.jpg', 'Selesai'),
(15, 7, '3576014403910003', 'Kecelakaan', 'Terjadi kecelakaan di jembatan balai raja yang menyebabkan kemacetan lalu lintas', '2024-06-15 00:20:57', '2024-06-18 16:57:25', '1718385657_cfd4697e9c84f22d9142.jpg', 'Selesai'),
(17, 8, '3576014403910004', 'Kegiatan Gotong Royong', 'Melakukan kegiatan gotong royong di desa balai raja. guna untuk kebersihan dan kenyamanan masyarakat', '2024-06-19 16:59:37', '2024-06-26 01:03:02', '1718791177_ee98928f2f0af9f8b8f9.png', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `tgl_publikasi` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul`, `isi`, `penulis`, `url`, `file_path`, `tgl_publikasi`, `tgl_update`) VALUES
(1, 'Seminar Pemrograman', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', 'Thomson', 'https://getbootstrap.com/docs/4.6/components/alerts/', '1717269850_cfe9e5010775273819b8.png', '2024-06-02 03:10:11', '2024-06-02 03:10:11'),
(2, 'Testing Code', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', 'Test', 'https://www.lipsum.com/', '1717272721_444fc2be453e114b8713.png', '2024-06-02 03:21:57', '2024-06-02 03:21:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  `tgl_jawaban` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id_user`, `id_pertanyaan`, `nama_lengkap`, `jawaban`, `tgl_jawaban`, `tgl_update`) VALUES
(4, 8, 5, 'Thomson', 'Oke', '2024-06-18 16:26:52', '2024-06-18 16:26:52'),
(5, 8, 5, 'Thomson', 'ss', '2024-06-18 16:28:12', '2024-06-18 16:28:12'),
(8, 8, 5, 'Thomson', 'hvhjj', '2024-06-18 16:39:58', '2024-06-18 16:39:58'),
(13, 1, 8, 'Lurah', 'sdgdfg', '2024-06-18 17:41:04', '2024-06-18 17:41:04'),
(14, 8, 8, 'Thomson', 'sdfdsg11', '2024-06-18 17:41:27', '2024-06-18 18:24:24'),
(16, 1, 6, 'Lurah', 'Baik12', '2024-06-18 17:46:50', '2024-06-18 18:23:37'),
(17, 1, 6, 'Lurah', '112', '2024-06-18 18:16:41', '2024-06-18 18:23:17'),
(18, 8, 6, 'Thomson', 'dsfsdf', '2024-06-18 18:38:29', '2024-06-18 18:38:29'),
(19, 8, 6, 'Thomson', 'ltkdhlkft', '2024-06-27 00:17:18', '2024-06-27 00:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluhan`
--

CREATE TABLE `tb_keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_pengadu` varchar(255) NOT NULL,
  `alamat_pengadu` text NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `judul_keluh` varchar(255) NOT NULL,
  `deskripsi_keluh` text NOT NULL,
  `tgl_pengadu` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime NOT NULL,
  `status` enum('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu',
  `file_path` varchar(255) NOT NULL,
  `kategori_keluh` varchar(255) NOT NULL,
  `solusi_keluh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_keluhan`
--

INSERT INTO `tb_keluhan` (`id_keluhan`, `id_user`, `nik`, `nama_pengadu`, `alamat_pengadu`, `no_telp`, `judul_keluh`, `deskripsi_keluh`, `tgl_pengadu`, `tgl_update`, `status`, `file_path`, `kategori_keluh`, `solusi_keluh`) VALUES
(9, 1, 'Lurah', '222', '22', '222', '22', '22', '2024-06-18 17:24:26', '2024-06-18 17:24:26', 'Selesai', '1718706266_ed56f60c620d61528666.png', '222', '222'),
(10, 1, 'Lurah', 'dd', 'ddd', 'dd', 'dd', 'ddd', '2024-06-19 16:20:20', '2024-06-19 16:20:20', 'Selesai', '1718788820_406aefdceaba7479a523.jpg', 'dd', 'dd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `judul_laporan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_laporan` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` enum('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `id_user`, `nik`, `judul_laporan`, `deskripsi`, `tgl_laporan`, `tgl_update`, `alamat`, `kecamatan`, `kelurahan`, `lampiran`, `status`) VALUES
(8, 1, 'Lurah', 'vidio sample', 'vidio sample', '2024-06-14 16:29:57', '2024-06-14 16:54:35', 'vidio sample', 'vidio sample', 'vidio sample', '1717354614_3a4e33fc318e9382987d.mp4', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id_masyarakat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `status` enum('Kawin','Belum Kawin') NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `foto_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id_masyarakat`, `id_user`, `nama_lengkap`, `nik`, `alamat`, `agama`, `no_telp`, `tgl_lahir`, `jenis_kelamin`, `status`, `pekerjaan`, `foto_profile`) VALUES
(1, 7, 'Fito Hasibuan', '35760144039100032', 'Balai Raja', 'Kristen', '082332423743', '2024-06-15', 'Laki-laki', 'Kawin', 'Mahasiswa', '1718457408_e220ac719250e05aa153.png'),
(2, 8, 'Thomson', '3576014403910004', 'Jln Ikri Km.5', 'Kristen', '081363498781', '2024-06-16', 'Laki-laki', 'Belum Kawin', 'Mahasiswa', '1718481067_3d8d17892ba906a53713.jpg'),
(3, 11, 'Fito Hasibuan12', '3576014403910005', 'Balai Raja', 'Kristen Protestan', '081282735736', '2024-06-16', 'Perempuan', 'Belum Kawin', 'Mahasiswa12', '1718483445_db99281facef8548b47d.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `kategori_pertanyaan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_pertanyaan` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id_pertanyaan`, `id_user`, `nik`, `kategori_pertanyaan`, `deskripsi`, `tgl_pertanyaan`, `tgl_update`, `file_path`) VALUES
(6, 1, 'Lurah', '22', '222', '2024-06-18 17:00:34', '2024-06-18 17:00:34', '1718704834_3fc8a1352333cae01422.png'),
(8, 8, '3576014403910004', 'Kecelakaan21', 'Telah terjadi kecelakaan di jembatan balai raja, truk dan motor. 1 meninggal dunia diantaranya pengendara motor', '2024-06-18 16:56:52', '2024-06-18 16:56:52', ''),
(10, 1, 'Lurah', 'ff', 'ff', '2024-06-18 17:05:08', '2024-06-18 17:05:08', '1718705108_6b980c28d7429ba0e122.png'),
(12, 1, 'Lurah', 'vv', 'vv', '2024-06-18 17:08:08', '2024-06-18 17:08:08', '1718705288_760bb9fd2032e93a177c.png'),
(13, 1, 'Lurah', 'zz', 'zz', '2024-06-18 17:09:12', '2024-06-18 17:09:12', '1718705352_406f2dcfc4aafd4193df.png'),
(14, 8, '3576014403910004', 'info12', 'info12', '2024-06-18 17:10:09', '2024-06-18 17:10:09', ''),
(15, 8, 'Lurah', '222', '22', '2024-06-18 17:18:51', '2024-06-18 17:18:51', '1718705931_6b1d70a0b25721118f80.png'),
(16, 1, 'Lurah', 'bb', 'bb', '2024-06-18 17:18:12', '2024-06-18 17:18:12', '1718705892_80f237b29fdbef1842e8.png'),
(18, 1, 'Lurah', 'hhhhh', 'hhhhh', '2024-06-18 17:21:34', '2024-06-18 17:21:34', '1718706094_3b8330938dd25808c87d.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('lurah','masyarakat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nik`, `password`, `level`) VALUES
(1, 'Lurah', '$2y$10$US.83JHLHEJYn89MS1yVJ.gfFoKaKEN9VaPzclcPXoYXYsR9HpvZW', 'lurah'),
(2, 'Thomson', '$2y$10$O4YEh4j6xEpQq46x8U/AUejHLk4.t70Ky/sRhDM.vUxLJJDzMA3ey', 'masyarakat'),
(3, 'Fito', '$2y$10$dYgGS8sEs5zKKoHIaMgb9eYOHqSh.QTUmlGce2370Oc.lPTcEmhOK', 'masyarakat'),
(4, 'Simpony', '$2y$10$PxmqpLD0OlcXbiOt3d9Ua.ZOntX9BOVaxsVa9eRwoFKwckOp1ZdCe', 'masyarakat'),
(5, 'Daniel', '$2y$10$mNdtNOK1GnmPxjDarNuL/O3eob/MuATxZvH.IhziqdqlNOV07ZZ5K', 'masyarakat'),
(7, '3576014403910003', '$2y$10$jZqdS8gvrV/OTsDMXspl6.eHXPvbZOlITdN1c5uzbcqr9op0kowSS', 'masyarakat'),
(8, '3576014403910004', '$2y$10$eIE2/OCy4REEMhhHrnYwnu8v8W0/Cyf460gq2dv3s1RCG9JAguCrq', 'masyarakat'),
(9, '3576014403910004', '$2y$10$EyWdxKTsdxIndpFztdllUOrZ84Kks66VmxfHID.mYNu3KFqXnNGqG', 'masyarakat'),
(10, '3576014403910004', '$2y$10$QQoPIDvYJzpcxRvN7mM3uO404NAahYcUAr0s4uuy4bqUs3lquJ7Nu', 'masyarakat'),
(11, '3576014403910005', '$2y$10$ITVzr82UJcsFDr2A2zsCiOzeRhXYcxIw50bg.L5Dwf.zWWvuS3FXC', 'masyarakat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aspirasi`
--
ALTER TABLE `tb_aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`),
  ADD KEY `tb_masyarakat_ibfk_1` (`id_user`);

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_aspirasi`
--
ALTER TABLE `tb_aspirasi`
  MODIFY `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD CONSTRAINT `tb_masyarakat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
