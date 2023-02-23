-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 09:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `base_hospital_gampola`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinic_calendar`
--

CREATE TABLE `clinic_calendar` (
  `clinic_id` varchar(100) NOT NULL,
  `doc_regno` varchar(150) NOT NULL,
  `clinic_date` date NOT NULL,
  `clinic_timeF` time NOT NULL,
  `clinic_timeT` time NOT NULL,
  `clinic_room` varchar(100) NOT NULL,
  `clinic_activation` int(11) NOT NULL,
  `doc_activation` int(11) NOT NULL,
  `cliniccalendar_indx` int(11) NOT NULL,
  `clinicalendar_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic_calendar`
--

INSERT INTO `clinic_calendar` (`clinic_id`, `doc_regno`, `clinic_date`, `clinic_timeF`, `clinic_timeT`, `clinic_room`, `clinic_activation`, `doc_activation`, `cliniccalendar_indx`, `clinicalendar_activation`) VALUES
('001', '5247', '2020-09-14', '18:53:00', '19:53:00', 'HARITHA-007', 1, 1, 1, 1),
('002', '5248', '2020-09-15', '18:55:00', '11:46:00', 'HARITHA-007', 1, 1, 2, 1),
('003', '5555', '2020-09-25', '19:25:00', '20:25:00', 'HARITHA-007', 1, 1, 3, 1),
('003', '5248', '2020-09-30', '13:00:00', '15:00:00', 'HARITHA-007', 1, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_details`
--

CREATE TABLE `clinic_details` (
  `clinic_id` varchar(100) NOT NULL,
  `clinic_name` varchar(250) NOT NULL,
  `clinic_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic_details`
--

INSERT INTO `clinic_details` (`clinic_id`, `clinic_name`, `clinic_activation`) VALUES
('001', 'Dental', 1),
('002', 'Healthy Body Clinic', 1),
('003', 'Natural Health Clinic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE `doctor_details` (
  `doc_nic` varchar(25) NOT NULL,
  `doc_name` varchar(150) NOT NULL,
  `doc_regno` varchar(150) NOT NULL,
  `doc_username` varchar(250) NOT NULL,
  `doc_password` varchar(250) NOT NULL,
  `doc_activation` int(11) NOT NULL,
  `clinic_id` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_details`
--

INSERT INTO `doctor_details` (`doc_nic`, `doc_name`, `doc_regno`, `doc_username`, `doc_password`, `doc_activation`, `clinic_id`, `gender`) VALUES
('982041561v', 'haritha', '5247', 'haritha@gmail.com', '1234', 1, '001', ''),
('982041562v', 'malshan', '5248', 'malshan@gmail.com', '1234', 1, '002', ''),
('98204153v', 'edirisinghe', '5249', 'edirisinghe@gmail.com', '1234', 1, '003', ''),
('111111111V', 'Jayavardhana', '5555', 'jayavardhana@gmail.com', '1234', 1, '003', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_data`
--

CREATE TABLE `patient_data` (
  `patient_regNum` varchar(150) NOT NULL,
  `patient_fullName` varchar(200) NOT NULL,
  `patient_NIC` varchar(15) NOT NULL,
  `patient_Dob` date NOT NULL,
  `patient_Gender` varchar(10) NOT NULL,
  `patient_Mobile` int(10) DEFAULT NULL,
  `patient_fixed_Number` int(10) DEFAULT NULL,
  `patient_email` varchar(150) DEFAULT NULL,
  `patient_password` varchar(250) DEFAULT NULL,
  `patient_Address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_data`
--

INSERT INTO `patient_data` (`patient_regNum`, `patient_fullName`, `patient_NIC`, `patient_Dob`, `patient_Gender`, `patient_Mobile`, `patient_fixed_Number`, `patient_email`, `patient_password`, `patient_Address`) VALUES
('0519', 'navo', '222222222V', '2020-08-30', 'FEMALE', 765403320, 0, 'navo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '  Haritha edirisinghe,kaluthara,mathugama,welipanna,lewwanduwa '),
('2345245345', 'HARITHA MALSHAN EDIRISINGHE', '982041562v', '1998-07-22', 'MALE', 765403320, 0, 'harithamalshan1998@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Haritha edirisinghe,kaluthara,mathugama,welipanna,lewwanduwa');

-- --------------------------------------------------------

--
-- Table structure for table `patient_date`
--

CREATE TABLE `patient_date` (
  `clinic_date_indx` int(11) NOT NULL,
  `patient_regNum` varchar(150) NOT NULL,
  `doc_regno` varchar(150) NOT NULL,
  `clinic_id` varchar(100) NOT NULL,
  `patient_clinic_date` date NOT NULL,
  `patient_NIC` varchar(15) NOT NULL,
  `clinic_attend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_date`
--

INSERT INTO `patient_date` (`clinic_date_indx`, `patient_regNum`, `doc_regno`, `clinic_id`, `patient_clinic_date`, `patient_NIC`, `clinic_attend`) VALUES
(6, '0519', '5249', '003', '2020-09-18', '222222222V', 0),
(5, '2345245345', '5247', '002', '2020-09-14', '982041562v', 1),
(7, '2345245345', '5247', '003', '2020-09-16', '982041562v', 1),
(2, '2345245345', '5248', '003', '2020-09-13', '982041562v', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_ID` varchar(150) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `sec_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_ID`, `section_name`, `sec_activation`) VALUES
('001', 'Laboratory', 1),
('002', 'Dispensary', 1),
('003', 'Registration & Changes', 1),
('004', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section_staff`
--

CREATE TABLE `section_staff` (
  `emp_id` varchar(200) NOT NULL,
  `emp_NIC` varchar(20) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `Date_Ob` date NOT NULL,
  `mobile_num` int(11) DEFAULT NULL,
  `fixed_num` int(11) DEFAULT NULL,
  `section_user_name` varchar(250) NOT NULL,
  `section_password` varchar(250) NOT NULL,
  `section_ID` varchar(150) NOT NULL,
  `emp_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section_staff`
--

INSERT INTO `section_staff` (`emp_id`, `emp_NIC`, `emp_name`, `gender`, `Date_Ob`, `mobile_num`, `fixed_num`, `section_user_name`, `section_password`, `section_ID`, `emp_activation`) VALUES
('1111', '111111111V', 'Haritha', 'MALE', '1998-07-22', 0, 342274926, 'Laboratory@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '001', 1),
('2222', '222222222V', 'tftfbduzycdsgbcd', 'FEMALE', '1999-10-01', 777523165, 0, 'Dispensary@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '002', 1),
('3333', '333333333V', 'dsfsdf fsdfdsf', 'MALE', '2000-09-17', 785642230, 0, 'Regch@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '003', 1),
('4444', '444444444V', 'malshan', 'MALE', '1998-09-03', 76532220, 0, 'Admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '004', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinic_calendar`
--
ALTER TABLE `clinic_calendar`
  ADD PRIMARY KEY (`cliniccalendar_indx`,`clinic_date`) USING BTREE,
  ADD KEY `clinic_calendar_ibfk_1` (`clinic_id`,`clinic_activation`),
  ADD KEY `clinic_calendar_ibfk_2` (`doc_regno`,`doc_activation`),
  ADD KEY `cCalndr_dt_idx` (`clinicalendar_activation`,`clinic_timeF`,`clinic_timeT`,`clinic_room`);

--
-- Indexes for table `clinic_details`
--
ALTER TABLE `clinic_details`
  ADD PRIMARY KEY (`clinic_id`,`clinic_activation`) USING BTREE;

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`doc_regno`,`doc_activation`) USING BTREE,
  ADD KEY `doctor_details_ibfk_1` (`clinic_id`),
  ADD KEY `doc_dt_idx` (`doc_name`,`doc_username`,`doc_password`,`clinic_id`) USING BTREE;

--
-- Indexes for table `patient_data`
--
ALTER TABLE `patient_data`
  ADD PRIMARY KEY (`patient_regNum`,`patient_NIC`) USING BTREE,
  ADD KEY `patient_dt_idx` (`patient_fullName`,`patient_Dob`,`patient_Gender`,`patient_Mobile`,`patient_fixed_Number`,`patient_email`,`patient_password`) USING BTREE;

--
-- Indexes for table `patient_date`
--
ALTER TABLE `patient_date`
  ADD PRIMARY KEY (`clinic_date_indx`,`patient_clinic_date`) USING BTREE,
  ADD KEY `clinic_id` (`clinic_id`),
  ADD KEY `doc_regno` (`doc_regno`),
  ADD KEY `patient_regNum` (`patient_regNum`,`patient_NIC`),
  ADD KEY `section_pcDdt_idx` (`patient_regNum`,`doc_regno`,`clinic_id`,`patient_NIC`,`clinic_attend`) USING BTREE;

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_ID`);

--
-- Indexes for table `section_staff`
--
ALTER TABLE `section_staff`
  ADD PRIMARY KEY (`emp_id`,`emp_NIC`),
  ADD KEY `section_ID` (`section_ID`),
  ADD KEY `section_staff_idx` (`emp_name`,`section_user_name`,`section_password`),
  ADD KEY `section_staff_dt_idx` (`gender`,`Date_Ob`,`mobile_num`,`fixed_num`,`section_ID`,`emp_activation`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinic_calendar`
--
ALTER TABLE `clinic_calendar`
  MODIFY `cliniccalendar_indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient_date`
--
ALTER TABLE `patient_date`
  MODIFY `clinic_date_indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clinic_calendar`
--
ALTER TABLE `clinic_calendar`
  ADD CONSTRAINT `clinic_calendar_ibfk_1` FOREIGN KEY (`clinic_id`,`clinic_activation`) REFERENCES `clinic_details` (`clinic_id`, `clinic_activation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clinic_calendar_ibfk_2` FOREIGN KEY (`doc_regno`,`doc_activation`) REFERENCES `doctor_details` (`doc_regno`, `doc_activation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD CONSTRAINT `doctor_details_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic_details` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_date`
--
ALTER TABLE `patient_date`
  ADD CONSTRAINT `patient_date_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic_details` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_date_ibfk_2` FOREIGN KEY (`doc_regno`) REFERENCES `doctor_details` (`doc_regno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_date_ibfk_3` FOREIGN KEY (`patient_regNum`,`patient_NIC`) REFERENCES `patient_data` (`patient_regNum`, `patient_NIC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section_staff`
--
ALTER TABLE `section_staff`
  ADD CONSTRAINT `section_staff_ibfk_1` FOREIGN KEY (`section_ID`) REFERENCES `section` (`section_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
