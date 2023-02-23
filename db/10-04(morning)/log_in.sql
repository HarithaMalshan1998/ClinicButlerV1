-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2020 at 02:55 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `log_in`
--

-- --------------------------------------------------------

--
-- Table structure for table `hospital_login`
--

CREATE TABLE `hospital_login` (
  `hospital_number` varchar(150) NOT NULL,
  `hospital_name` varchar(150) NOT NULL,
  `hospital_user_name` varchar(250) NOT NULL,
  `hospital_password` varchar(150) NOT NULL,
  `hospital_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital_login`
--

INSERT INTO `hospital_login` (`hospital_number`, `hospital_name`, `hospital_user_name`, `hospital_password`, `hospital_activation`) VALUES
('1', 'Base Hospital (Teaching) Gampola', 'BaseHospitalTeachingGampola@gmail.com', '123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hospital_login`
--
ALTER TABLE `hospital_login`
  ADD PRIMARY KEY (`hospital_number`,`hospital_name`),
  ADD KEY `login_tb_ID_idx` (`hospital_number`,`hospital_user_name`,`hospital_password`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
