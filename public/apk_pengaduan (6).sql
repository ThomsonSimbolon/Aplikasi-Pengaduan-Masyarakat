-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 16, 2024 at 09:41 PM
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
  `rt_rw` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `tgl_aspirasi` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` enum('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_aspirasi`
--

INSERT INTO `tb_aspirasi` (`id_aspirasi`, `id_user`, `nik`, `kategori_aspirasi`, `deskripsi`, `rt_rw`, `kelurahan`, `kecamatan`, `kabupaten`, `tgl_aspirasi`, `tgl_update`, `lampiran`, `status`) VALUES
(3, 1, 'Lurah', '1', '1', '', '', '', '', '2024-06-14 16:22:13', '2024-06-14 16:53:15', '1717401196_725161889f5506cc992b.pdf', 'Selesai'),
(13, 7, '3576014403910003', 'KDRT', 'KDRT1', '', '', '', '', '2024-06-14 17:15:47', '2024-06-14 17:15:47', '1718360106_7324956ce09cc6000dfd.jpg', 'Selesai'),
(15, 7, '3576014403910003', 'Kecelakaan', 'Terjadi kecelakaan di jembatan balai raja yang menyebabkan kemacetan lalu lintas', '', '', '', '', '2024-06-15 00:20:57', '2024-06-15 01:51:47', '1718385657_cfd4697e9c84f22d9142.jpg', 'Diproses'),
(16, 7, '3576014403910003', '222', '222', '', '', '', '', '2024-06-15 01:57:35', '2024-06-15 01:57:35', '1718391455_5c2d3aab77a32d6d58e3.jpg', 'Menunggu');

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
(2, 'Testing Code', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', 'Test', 'https://www.lipsum.com/', '1717272721_444fc2be453e114b8713.png', '2024-06-02 03:21:57', '2024-06-02 03:21:57'),
(5, 'Lombah 17 Agustus', 'LENDAH. Dalam rangka memeriahkan Hari Ulang Tahun Kemerdekaan Republik Indonesia yang ke-73, di  Desa Jatirejo Kecamatan Lendah dilaksanakan berbagai lomba diantaranya; Lomba Tarik Tambang bapak-bapak antar dusun, Lomba Bola Kasti ibu-ibu antar dusun dan Lomba Volly bapak-bapak antar dusun.\r\n\r\nBerbagai lomba tersebut sudah dilaksanakan sejak awal Agustus 2018, dan saat ini memasuki tahap final bahkan untuk lomba tarik tambang sudah ditentukan pemenangnya yaitu Dusun Sumberejo. Sedangkan untuk final bola volley baru akan dilaksanakan hari Minggu tanggal 12 Agustus 2018 di lapangan volley Botokan antara tim bola volley Dusun Lendah melawan tim bola volley Dusun Jatirejo.', 'Fito Hasibuan', 'https://lendah.kulonprogokab.go.id/detil/187/meriah-lomba-17-an-desa-jatirejo', '1721158523_b2d662c513f8fcc544b4.png', '2024-07-17 02:35:23', '2024-07-17 02:35:23');

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
(1, 13, 5, 'Fito Hasibuan', 'sdfdfsf\r\n', '2024-07-17 02:28:16', '2024-07-17 02:28:16'),
(2, 1, 8, 'Admin', '1. Surat Pengantar RT/ RW.\r\n2. Fotokopi KK dan KTP Pemohon.\r\n3. Fotokopi Bukti Kepemilikan Tanah (sertifikat, Akta/Keterangan Hibah, Waris, Jual Beli, Wakaf);\r\n4. SPPT PBB Tahun Berjalan.\r\n5. Riwayat / Asal-usul Tanah;\r\n6. Kutipan C;\r\n7. Blanko / Formulir yang disediakan oleh BPN.', '2024-07-17 02:30:59', '2024-07-17 02:30:59'),
(3, 13, 8, 'Fito Hasibuan', 'makasih', '2024-07-17 02:32:32', '2024-07-17 02:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluhan`
--

CREATE TABLE `tb_keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_pengadu` varchar(255) NOT NULL,
  `rt_rw` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
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

INSERT INTO `tb_keluhan` (`id_keluhan`, `id_user`, `nik`, `nama_pengadu`, `rt_rw`, `kelurahan`, `kecamatan`, `kabupaten`, `no_telp`, `judul_keluh`, `deskripsi_keluh`, `tgl_pengadu`, `tgl_update`, `status`, `file_path`, `kategori_keluh`, `solusi_keluh`) VALUES
(7, 1, 'Lurah', '2', '2', '', '', '', '2', '2', '2', '2024-06-14 16:27:37', '2024-06-14 17:13:20', 'Selesai', '1717396485_9d79148b0af01909c12a.mp4', '2', '2'),
(8, 7, '3576014403910003', 'Tono1', 'dsfsdf', '', '', '', 'sdsdg', 'dfsdf', 'sdgsssdg', '2024-06-14 17:22:47', '2024-06-14 17:22:47', 'Selesai', '1718360538_5d32b5e0ebd74e33a56f.jpg', 'sdfsdfs', 'sdfsdfsd'),
(9, 13, '140302020202020002', 'Fito Hasibuan', '', '', '', '', '081245563949', 'Kemalingan', 'Terjadi Kemalingan Dirumah dengan kehilangan hp, perhiasan , dan laptop', '2024-07-17 02:12:03', '2024-07-17 02:12:36', 'Selesai', '1721157123_016d81e8f2a3c80551ac.png', 'kemalingan', 'tolong buat ronda buat keamanan disekitar rumah');

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
  `rt_rw` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` enum('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `id_user`, `nik`, `judul_laporan`, `deskripsi`, `tgl_laporan`, `tgl_update`, `rt_rw`, `kecamatan`, `kelurahan`, `kabupaten`, `lampiran`, `status`) VALUES
(8, 1, 'Lurah', 'vidio sample', 'vidio sample', '2024-06-14 16:29:57', '2024-06-14 16:54:35', 'vidio sample', 'vidio sample', 'vidio sample', '', '1717354614_3a4e33fc318e9382987d.mp4', 'Selesai'),
(10, 7, '3576014403910003', 'KDRT1', 'Melakukan tindakan kdrt didesa temulawak', '2024-06-14 17:20:27', '2024-06-14 17:20:27', 'asa', 'ash', 'as', '', '1718360393_9dd84e3f29a9a4d7433e.jpg', 'Selesai'),
(11, 13, '140302020202020002', 'Jalan Rusak di sepanjang jalan Rambutan', 'banyak jalan yang rusak dan berlubang membuat pengendara sering kecelakaan', '2024-07-17 02:16:06', '2024-07-17 02:18:04', '', 'Pinggir', 'Balai Raja', 'Bengkalis', '1721157366_e7f7437543a47a02257b.png', 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lurah`
--

CREATE TABLE `tb_lurah` (
  `id_lurah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_lurah`
--

INSERT INTO `tb_lurah` (`id_lurah`, `id_user`, `nama_lengkap`, `nik`, `alamat`, `agama`, `no_telp`, `email`, `jabatan`, `foto_profile`) VALUES
(1, 12, 'Hermalina, S.Sos', '3576014403912431', 'Balai Raja', 'Islam', '081282735736', 'budiarto@gmail.com', 'Lurah', '1720964874_7cc3ee0b002cc3f24242.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id_masyarakat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `rt_rw` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
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

INSERT INTO `tb_masyarakat` (`id_masyarakat`, `id_user`, `nama_lengkap`, `nik`, `rt_rw`, `kelurahan`, `kecamatan`, `kabupaten`, `agama`, `no_telp`, `tgl_lahir`, `jenis_kelamin`, `status`, `pekerjaan`, `foto_profile`) VALUES
(4, 13, 'Fito Hasibuan', '140302020202020002', '003/005', 'Balai Raja', 'Pinggir', 'Bengkalis', 'Kristen', '081245563949', '2024-07-17', 'Laki-laki', 'Belum Kawin', 'Mahasiswa', '1721156603_1adee7eb4e4d064855ca.png');

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
(5, 7, '3576014403910003', '222', '222', '2024-06-14 16:48:23', '2024-06-14 16:48:23', ''),
(7, 7, '3576014403910003', '1212', '121212', '2024-06-15 00:30:17', '2024-06-15 00:30:17', ''),
(8, 13, '140302020202020002', 'Cara mengurus Surat Tanah', 'syarat-syarat mengurus surat tanah', '2024-07-17 02:17:24', '2024-07-17 02:17:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','lurah','masyarakat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nik`, `password`, `level`) VALUES
(1, 'Admin', '$2y$10$US.83JHLHEJYn89MS1yVJ.gfFoKaKEN9VaPzclcPXoYXYsR9HpvZW', 'admin'),
(12, '3576014403912431', '$2y$10$jh.1745xoQoCJ9iJNFcu1eId3kIm5kihmd28a1cr9NVX0.EVY33he', 'lurah'),
(13, '140302020202020002', '$2y$10$C7ZHNTIve56P0tsedQPdzOzXOr8eHQFnBLpFyJXCG0e6O8/BkeLQ2', 'masyarakat');

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
-- Indexes for table `tb_lurah`
--
ALTER TABLE `tb_lurah`
  ADD PRIMARY KEY (`id_lurah`),
  ADD UNIQUE KEY `id_user` (`id_user`);

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
  MODIFY `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_lurah`
--
ALTER TABLE `tb_lurah`
  MODIFY `id_lurah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_lurah`
--
ALTER TABLE `tb_lurah`
  ADD CONSTRAINT `tb_lurah_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD CONSTRAINT `tb_masyarakat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
