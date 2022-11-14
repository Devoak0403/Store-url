-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 05:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_link`
--

-- --------------------------------------------------------

--
-- Table structure for table `link_db`
--

CREATE TABLE `link_db` (
  `l_id` int(11) NOT NULL,
  `l_title` varchar(255) NOT NULL,
  `l_description` text NOT NULL,
  `l_url` varchar(255) NOT NULL,
  `u_id` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_db`
--

INSERT INTO `link_db` (`l_id`, `l_title`, `l_description`, `l_url`, `u_id`, `dateCreate`) VALUES
(1, 'Test Insert Link', '-', 'https://fontawesome.com/search?q=server&o=r&m=free', 1, '2022-09-18 15:32:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link_db`
--
ALTER TABLE `link_db`
  ADD PRIMARY KEY (`l_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link_db`
--
ALTER TABLE `link_db`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
