-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 05:43 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedb`
--

-- --------------------------------------------------------

--

--



-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `access_level` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`user_id`, `user_email`, `user_password`, `access_level`) VALUES
(1, 'mannaihoussem2000@gmail.com', '', ''),
(2, 'HOSS@email.com', '', ''),
(3, 'sqdsq@email.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(4, 'aaaaa@em.c', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(5, 'Aaaaa@em.c', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(6, 'bbbbb@email.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(7, 'hos@email.com', 'd41d8cd98f00b204e9800998ecf8427e', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts_detail`
--

CREATE TABLE `tblaccounts_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `datetime_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `location` text NOT NULL,
  `expectation_visitor` varchar(100) NOT NULL,
  `cash_advanced` decimal(10,2) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `date_signed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaccounts_detail`
--

INSERT INTO `tblaccounts_detail` (`id`, `user_id`, `firstname`, `lastname`, `phone`, `city`, `datetime_created`, `description`, `location`, `expectation_visitor`, `cash_advanced`, `status`, `date_signed`) VALUES
(1, 1, 'Houssem', 'mannai', '55146551', 'gabes', '2023-05-27 02:05:45', '', 'TUNIS', '45', '23000.00', 'confirm', '0000-00-00 00:00:00'),
(2, 2, 'Houssem', 'mannai', '55146551', 'Monastir', '2023-05-27 02:05:46', '', 'thrhtr', '56', '34000.00', 'confirm', '0000-00-00 00:00:00'),
(3, 3, 'dzadza', 'dzadz', '55146551', 'Monastir', '2023-05-27 10:05:41', '', '', '', '2000.00', 'confirm', '0000-00-00 00:00:00'),
(4, 4, 'azaz', 'azazz', '55146551', 'Medjez el beb', '2023-05-28 02:05:23', '', 'TUNIS', '4', '3700.00', 'confirm', '0000-00-00 00:00:00'),
(5, 5, 'tyty', 'uiui', '55146551', 'Monastir', '2023-05-28 02:05:38', '', '', '', '9500.00', 'confirm', '0000-00-00 00:00:00'),
(6, 6, 'vvvvv', 'bbbbb', '55146551', 'Monastir', '2023-05-28 02:05:41', '', '', '', '0.00', 'pending', '0000-00-00 00:00:00'),
(7, 7, 'houuuuuussss', 'sssseeeeem', '12345678', 'gabes', '2023-05-28 02:05:47', '', 'GRE', '4', '6500.00', 'confirm', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblguest`
--

CREATE TABLE `tblguest` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `guestname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `state` char(4) NOT NULL,
  `zipcode` char(10) NOT NULL,
  `priority` enum('A','B','C','D','E') NOT NULL,
  `out_of_town` enum('y','n') NOT NULL,
  `relationship` varchar(32) NOT NULL,
  `tracks_and_gifts` text NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblguest`
--

INSERT INTO `tblguest` (`id`, `booking_id`, `fullname`, `guestname`, `address`, `state`, `zipcode`, `priority`, `out_of_town`, `relationship`, `tracks_and_gifts`, `city`) VALUES
(7, 1, 'ASASAS', 'SSSSS', 'TUNIS', 'TUNI', '2020', 'C', 'n', 'g', 'AAAAA', 'TUNIS');

-- --------------------------------------------------------

--
-- Table structure for table `tblorganizer`
--

CREATE TABLE `tblorganizer` (
  `organizer_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `datetime_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--

--



-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `access_level` enum('0','1','2') NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `firstname`, `lastname`, `gender`, `username`, `password`, `email`, `designation`, `address`, `access_level`, `profile_picture`, `date_created`) VALUES
(5, 'Houssem', 'Mannai', 'm', 'adminHoss', 'D00F5D5217896FB7FD601412CB890830', 'admin@mail.com', '0', 'Medjez EL Beb, B&eacute;ja, Tunis', '', 'user-icn-p-min.png', 'March 6, 2021, 5:15 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblweddingbook`
--

CREATE TABLE `tblweddingbook` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bride` varchar(32) NOT NULL,
  `groom` varchar(32) NOT NULL,
  `wedding_type` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `wedding_date` varchar(100) NOT NULL,
  `organizer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblweddingbook`
--

INSERT INTO `tblweddingbook` (`booking_id`, `user_id`, `bride`, `groom`, `wedding_type`, `user_email`, `wedding_date`, `organizer_id`) VALUES
(1, 1, 'ahshas ashhhh', 'mannai houssem', 5, 'mannaihoussem2000@gmail.com', '06/20/2023', 2),
(2, 2, 'SQDQSD', 'dqsdsq', 5, 'HOSS@email.com', '08/24/2023', 1),
(3, 3, 'FDFDFD', 'mpoijmo', 3, 'sqdsq@email.com', '06/20/2023', 1),
(4, 4, 'ahshas ashhhh', 'dqsdsq', 0, 'aaaaa@em.c', '09/29/2023', 1),
(5, 5, 'SQDQSD', 'dqsdsq', 4, 'Aaaaa@em.c', '04/15/2023', 1),
(6, 6, 'jjjjjjj', 'kkkkkkk', 1, 'bbbbb@email.com', '12/09/2023', 1),
(7, 7, 'beeeeeeeeeesss', 'besssssssss', 1, 'hos@email.com', '07/21/2025', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblweddingcategories`
--

CREATE TABLE `tblweddingcategories` (
  `id` int(11) NOT NULL,
  `wedding_type` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `preview_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblweddingcategories`
--

INSERT INTO `tblweddingcategories` (`id`, `wedding_type`, `price`, `preview_image`) VALUES
(1, 'Classic', '16500.00', 'classic.jpg'),
(2, 'Elegent', '20000.00', 'elegent.jpg'),
(3, 'Premier', '24000.00', 'premier.jpg'),
(4, 'Gold', '39500.00', 'timeless gold.jpg'),
(5, 'Elite', '52000.00', 'elite.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_features`
--

CREATE TABLE `tbl_features` (
  `feature_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_features`
--

INSERT INTO `tbl_features` (`feature_id`, `category_id`, `title`, `description`) VALUES
(2, 2, 'Hair and Make Up', 'none'),
(3, 2, 'Photographer', 'unlimited shot\r\nSoftCopy(CD/DVD)'),
(4, 5, 'Hair And Make Up', 'unlimited shot'),
(7, 5, 'Appetizers and Meal Service', 'Choice Six Hot/Cold, 3-Entr&eacute;e Buffet or Duet Plate'),
(8, 1, 'Hair And Make Up', 'Our own professional worker'),
(9, 5, 'Wedding Cake', 'Custom Wedding Cake'),
(10, 1, 'Appetizers', 'Vegetable &amp; Cheese Platters'),
(11, 1, 'DJ Services', 'DJ Services'),
(12, 5, 'Bar Service', 'Bar Service'),
(13, 5, 'Champagne &amp; Cider Toast', 'Champagne &amp; Cider Toast'),
(15, 4, 'Appetizers and Meal Service', 'Choice Six Hot/Cold, 3-Entr&eacute;e Buffet or Duet Plate'),
(16, 4, 'Hair And Make Up', 'hair cut that will change you life'),
(17, 5, 'Invitations &amp; Accessories', 'Invitations &amp; Accessories'),
(18, 5, 'DJ &amp; MC Services', 'DJ &amp; MC Services'),
(19, 4, 'Wedding Cake', 'Custom Wedding Cake'),
(20, 5, 'Chairs &amp; Linens', 'Chairs &amp; Linens'),
(21, 4, 'Photographer', 'unlimited shot'),
(22, 4, 'Bar Service', 'Beer, Wine'),
(23, 4, 'Reception Decor', 'Stage Decor'),
(24, 3, 'Hair And Make Up', 'unlimited shot'),
(25, 3, 'Appetizers and Meal Services', 'Choice Six Hot/Cold, 3-Entr&eacute;e Buffet or Duet Plate'),
(26, 3, 'Invitations &amp; Accessories', 'none'),
(27, 3, 'DJ &amp; MC Services', 'none'),
(28, 2, 'Appetizers', 'Vegetable &amp; Cheese Platters'),
(29, 2, 'Decorations', 'Stage Decorations'),
(30, 3, 'Wedding Cake', 'Custom Wedding Cake'),
(31, 4, 'DJ &amp; MC Services', 'none'),
(32, 4, 'Centerpieces', 'Standard'),
(33, 5, 'Centerpieces', 'Centerpieces'),
(34, 5, 'Photobooth', 'Photobooth'),
(35, 5, 'Grand Sparklers', 'Grand Sparklers'),
(36, 5, 'Specialty Lighting', 'Specialty Lighting');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_liquidation`
--

CREATE TABLE `tbl_liquidation` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) NOT NULL,
  `date_modified` varchar(100) NOT NULL,
  `cash_advanced` decimal(10,2) NOT NULL,
  `cash`decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_liquidation`
--

INSERT INTO `tbl_liquidation` (`id`, `booking_id`, `user_id`, `payment`, `credit`, `date_modified`, `cash_advanced`) VALUES
(1, 2, 2, '0.00', '-34000.00', '2023-05-27 23:33:41', '34000.00'),
(2, 3, 3, '0.00', '22000.00', '2023-05-27 23:43:22', '2000.00'),
(3, 3, 3, '0.00', '22000.00', '2023-05-27 23:44:23', '2000.00'),
(4, 3, 3, '4000.00', '4000.00', 'May 28, 2023, 12:03 am', '0.00'),
(5, 3, 3, '5000.00', '5000.00', 'May 28, 2023, 12:06 am', '0.00'),
(6, 3, 3, '2300.00', '2000.00', 'May 28, 2023, 12:14 am', '0.00'),
(7, 4, 4, '0.00', '20300.00', '2023-05-28 03:24:35', '3700.00'),
(8, 5, 5, '0.00', '30000.00', '2023-05-28 03:41:35', '9500.00'),
(9, 7, 7, '0.00', '10000.00', '2023-05-28 03:48:13', '6500.00'),
(25, 7, 7, '4000.00', '6000.00', 'May 28, 2023, 4:13 pm', '6500.00'),
(27, 7, 7, '1000.00', '5000.00', 'May 28, 2023, 4:31 pm', '6500.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--


--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tblaccounts_detail`
--
ALTER TABLE `tblaccounts_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblguest`
--
ALTER TABLE `tblguest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorganizer`
--
ALTER TABLE `tblorganizer`
  ADD PRIMARY KEY (`organizer_id`);

--

--


--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblweddingbook`
--
ALTER TABLE `tblweddingbook`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tblweddingcategories`
--
ALTER TABLE `tblweddingcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_features`
--
ALTER TABLE `tbl_features`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `tbl_liquidation`
--
ALTER TABLE `tbl_liquidation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--


--
-- AUTO_INCREMENT for table `tblaccounts_detail`
--
ALTER TABLE `tblaccounts_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblguest`
--
ALTER TABLE `tblguest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblorganizer`
--
ALTER TABLE `tblorganizer`
  MODIFY `organizer_id` int(11) NOT NULL AUTO_INCREMENT;

--


--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblweddingbook`
--
ALTER TABLE `tblweddingbook`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblweddingcategories`
--
ALTER TABLE `tblweddingcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_features`
--
ALTER TABLE `tbl_features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_liquidation`
--
ALTER TABLE `tbl_liquidation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
