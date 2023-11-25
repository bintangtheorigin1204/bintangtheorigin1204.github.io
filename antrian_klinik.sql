-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2019 at 07:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `keluhan` varchar(191) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT 'T',
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `id_pasien`, `nomor_antrian`, `id_poli`, `id_user`, `keluhan`, `status`, `tanggal`, `waktu`) VALUES
(42, 2, 1, 1, 1, '', 'T', '2019-07-16', '20:43:04'),
(43, 3, 2, 1, 1, '', 'T', '2019-07-16', '20:43:11'),
(44, 3, 1, 3, 1, '', 'T', '2019-07-16', '20:43:15'),
(45, 3, 2, 3, 1, '', 'T', '2019-07-16', '20:43:24'),
(46, 4, 3, 1, 3, '', 'T', '2019-07-16', '21:42:17'),
(47, 3, 3, 3, 3, '', 'T', '2019-07-16', '21:42:22'),
(48, 2, 4, 1, 3, '', 'T', '2019-07-16', '21:42:43'),
(49, 5, 1, 4, 1, '', 'T', '2019-07-17', '01:17:58'),
(50, 5, 1, 1, 1, '', 'T', '2019-07-17', '01:18:09'),
(51, 6, 1, 5, 1, '', 'T', '2019-07-17', '01:19:29'),
(52, 6, 2, 1, 1, '', 'T', '2019-07-17', '02:19:53'),
(53, 6, 1, 3, 1, '', 'T', '2019-07-17', '02:20:02'),
(54, 6, 2, 3, 1, '', 'T', '2019-07-17', '02:20:13'),
(55, 4, 3, 1, 1, '', 'T', '2019-07-17', '17:45:58'),
(56, 4, 2, 4, 1, '', 'T', '2019-07-17', '17:47:58'),
(57, 2, 1, 1, 1, '', 'T', '2019-07-18', '17:50:46'),
(58, 5, 1, 3, 1, 'gdfg', 'T', '2019-07-18', '17:54:34'),
(65, 5, 1, 4, 0, 'test', 'T', '2019-07-19', '01:52:21'),
(66, 0, 1, 1, 0, 'test anteian baru\r\n', 'T', '2019-07-19', '02:09:39'),
(67, 8, 2, 1, 0, 'Test Nama Baru\r\n', 'T', '2019-07-19', '02:13:54'),
(68, 5, 3, 1, 0, 'jkhk', 'T', '2019-07-19', '02:20:03'),
(69, 9, 4, 1, 0, 'klj', 'T', '2019-07-19', '02:22:24'),
(70, 10, 5, 1, 0, 'gfhf', 'T', '2019-07-19', '02:23:12'),
(71, 11, 6, 1, 0, 'fhdh', 'T', '2019-07-19', '02:23:54'),
(72, 12, 1, 3, 0, 'hgjhg', 'T', '2019-07-19', '02:25:40'),
(73, 13, 2, 3, 0, 'ghjgf', 'T', '2019-07-19', '02:25:55'),
(74, 13, 3, 3, 0, 'ghjgf', 'T', '2019-07-19', '02:26:48'),
(75, 14, 7, 1, 0, 'jhgjf', 'T', '2019-07-19', '02:26:57'),
(76, 14, 8, 1, 0, 'jhgjf', 'T', '2019-07-19', '02:27:23'),
(77, 15, 4, 3, 0, 'hfhfd', 'T', '2019-07-19', '02:27:34'),
(78, 15, 5, 3, 0, 'hfhfd', 'T', '2019-07-19', '02:28:01'),
(79, 16, 6, 3, 0, 'yuki', 'T', '2019-07-19', '02:28:07'),
(80, 17, 1, 5, 0, 'jfghjfx', 'T', '2019-07-19', '02:30:35'),
(81, 17, 2, 5, 0, 'jfghjfx', 'T', '2019-07-19', '02:31:29'),
(82, 18, 7, 3, 0, 'ij', 'T', '2019-07-19', '02:31:34'),
(83, 18, 8, 3, 0, 'ij', 'T', '2019-07-19', '02:31:45'),
(84, 19, 9, 3, 0, 'dghd', 'T', '2019-07-19', '02:32:20'),
(85, 19, 10, 3, 0, 'dghd', 'T', '2019-07-19', '02:33:58'),
(86, 20, 11, 3, 0, 'ytrjrt', 'T', '2019-07-19', '02:34:07'),
(87, 20, 12, 3, 0, 'ytrjrt', 'T', '2019-07-19', '02:34:34'),
(88, 21, 3, 5, 0, 'tyuiyt', 'T', '2019-07-19', '02:34:41'),
(89, 22, 9, 1, 0, 'jgf', 'T', '2019-07-19', '02:37:00'),
(90, 5, 13, 3, 0, 'sdfda', 'T', '2019-07-19', '03:12:35'),
(91, 5, 14, 3, 0, 'fgd', 'T', '2019-07-19', '03:13:50'),
(92, 5, 15, 3, 0, 'fd', 'T', '2019-07-19', '03:14:22'),
(93, 5, 16, 3, 0, 'fd', 'T', '2019-07-19', '03:14:45'),
(94, 4, 1, 3, 1, 'tes\r\n', 'Y', '2019-07-20', '04:43:23'),
(95, 3, 2, 3, 1, 'test', 'Y', '2019-07-20', '04:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `isi`, `created_at`) VALUES
(1, '<p><img alt=\"\" src=\"https://jurnalislam.com/wp-content/uploads/2018/02/jurnalislam.com-20180224-092926-whatsapp-image-2018-02-24-at-8.05.40-am.jpeg\" style=\"width:100%\" /></p>\r\n', '2019-07-16 16:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(191) NOT NULL,
  `alamat` varchar(191) NOT NULL,
  `ktp` varchar(191) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pasien`, `alamat`, `ktp`, `tgl_lahir`, `tanggal`, `waktu`) VALUES
(2, 'Eko Patrio', 'Jakarta Selatan', '', '1992-07-17', '2019-07-15', '00:00:00'),
(3, 'Ahmad Andriansyah', 'Cikupa - Tangerang', '', '1991-02-06', '2019-07-15', '00:00:00'),
(4, 'Eko Patrio', 'Jakarta Selatan', '', '1980-04-17', '2019-07-15', '00:00:00'),
(5, 'Asep', 'Tangerang', '02155478858', '1993-01-12', '2019-07-15', '00:00:00'),
(6, 'AHmad Adi Saputra', 'Tangerang', '02155478857', '1992-07-17', '2019-07-17', '00:00:00'),
(8, 'Test Nama Baru', '', '324325435', '0000-00-00', '2019-07-19', '02:13:54'),
(9, 'kjlj', '', 'yihlj', '0000-00-00', '2019-07-19', '02:22:24'),
(10, 'fghf', '', 'fgdhf', '0000-00-00', '2019-07-19', '02:23:12'),
(11, 'fdrghggff', '', '436464', '0000-00-00', '2019-07-19', '02:23:54'),
(12, 'hgjg', '', 'hgjg', '0000-00-00', '2019-07-19', '02:25:40'),
(13, 'hgjgjfgjhg', '', 'jcghkjkcjcghjcg', '0000-00-00', '2019-07-19', '02:25:55'),
(14, 'hjgjhgjg', '', 'ghjhg', '0000-00-00', '2019-07-19', '02:26:56'),
(15, 'hjgflh,jktsrtr', '', '45375648756', '0000-00-00', '2019-07-19', '02:27:33'),
(16, 'ylylyiluyilyi', '', 'luhluyiliil', '0000-00-00', '2019-07-19', '02:28:07'),
(17, 'fhsrj', '', '676534586', '0000-00-00', '2019-07-19', '02:30:35'),
(18, 'hjklj', '', 'ljklkj', '0000-00-00', '2019-07-19', '02:31:34'),
(19, 'dgfhgdshdsh', '', 'fgghsfdhgsh', '0000-00-00', '2019-07-19', '02:32:20'),
(20, 'ytjytk', '', '568568756479', '0000-00-00', '2019-07-19', '02:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(191) NOT NULL,
  `nama_dokter` varchar(191) NOT NULL,
  `nama_petugas` varchar(191) NOT NULL,
  `id_antrian` int(11) NOT NULL,
  `inisial` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `nama_dokter`, `nama_petugas`, `id_antrian`, `inisial`, `created_at`) VALUES
(1, 'Poli Gigi', 'Dr. Hendarto', 'S Marni', 66, 'D', '2019-07-19 10:17:51'),
(3, 'Poli THT', 'Dr Karnavian', 'S Fani', 95, 'C', '2019-07-20 12:48:08'),
(4, 'Poli Umum', 'D. Widhaya Pir', 'S Marni', 49, 'B', '2019-07-16 18:49:31'),
(5, 'Poli Ibu & Anak', 'Dr Susi Pudjiatuti', 'S Nuryamah', 43, 'A', '2019-07-16 18:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(191) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `alamat` varchar(191) NOT NULL,
  `level` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `jk`, `alamat`, `level`, `created_at`) VALUES
(1, 'administrator', 'e10adc3949ba59abbe56e057f20f883e', 'Administrator', 'Laki-laki', 'Tangerang', 'Administrator', '2019-07-15 16:26:40'),
(3, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Perempuan', 'Tangerang', 'Admin', '2019-07-15 16:26:28'),
(5, 'poligigi', 'e10adc3949ba59abbe56e057f20f883e', 'Petugas Poli Gigi', 'Laki-laki', 'Jakarta', 'Poli Gigi', '2019-07-15 16:45:13'),
(6, 'politht', 'e10adc3949ba59abbe56e057f20f883e', 'Poli THT', 'Perempuan', 'Jakarta', 'Poli THT', '2019-07-16 15:08:23'),
(7, 'poliumum', 'e10adc3949ba59abbe56e057f20f883e', 'Poli Umum', 'Laki-laki', 'Tangerang', 'Poli Umum', '2019-07-16 18:26:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
