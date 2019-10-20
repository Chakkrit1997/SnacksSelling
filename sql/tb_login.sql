-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2019 at 08:12 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `login_id` int(11) UNSIGNED NOT NULL,
  `login_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `login_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `login_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `login_status` enum('admin','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `date_add` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`login_id`, `login_username`, `login_password`, `login_email`, `firstname`, `lastname`, `login_status`, `date_add`) VALUES
(1, 'admin', '7583289901fb25edfa0481940bf86556f721af68414f4fa65cd1ac0873292f32', 'root@root.com', 'Super', 'User', 'admin', '2018-09-29 15:03:11'),
(115, 'flame', '64c7e936b88cf180f26f46507e598bb31bb914cf6498aacab07735d93d2e6363', 'flame@hotmail.com', 'Weerayut', 'Buaphet', 'user', '2018-10-17 15:52:35'),
(118, 'user', '164b4d4af652de0d23519cb30818853dccd57d5bb1c7e361256f58d122a671a2', 'jimmie@hotmail.com', 'Nutdanai', 'jirakangwan', 'user', '2018-10-17 16:24:46'),
(119, 'darksoft', '164b4d4af652de0d23519cb30818853dccd57d5bb1c7e361256f58d122a671a2', 'guitar_dark_soft@hotmail.com', 'จักรกฤษ', 'ทาอภัย', 'user', '2018-10-17 21:22:41'),
(120, 'tar', '32e919128a49384f0cf139077c5876c231556999b4f9b26d30aa0a6e817de01e', 'guitardarksoft@gmail.com', 'Chakkrit', 'Tha-aphai', 'user', '2019-10-19 18:47:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_username` (`login_username`),
  ADD UNIQUE KEY `login_email` (`login_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `login_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
