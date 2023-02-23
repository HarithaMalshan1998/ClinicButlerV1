-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 08:13 PM
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
-- Table structure for table `checkup_cate`
--

CREATE TABLE `checkup_cate` (
  `category_id` int(11) NOT NULL,
  `category` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `activation_cate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkup_cate`
--

INSERT INTO `checkup_cate` (`category_id`, `category`, `activation_cate`) VALUES
(5, 'BLOOD TEST', 1),
(1, 'CONSULTATION', 1),
(4, 'EYE EXAMINATION', 1),
(10, 'GYNECOLOGICAL CHECK', 1),
(8, 'IMAGING STUDY', 1),
(11, 'OTHERS', 1),
(2, 'PHYSICAL&MEASUREMENT', 1),
(3, 'PHYSIOLOGICAL&EXAMINATION', 1),
(7, 'STOOL TEST', 1),
(9, 'TUMOR MARKER', 1),
(6, 'URINE TEST', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkup_lst`
--

CREATE TABLE `checkup_lst` (
  `checkup_indx` int(11) NOT NULL,
  `checkup_name` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `category_id` int(11) NOT NULL,
  `checkup_price` decimal(10,2) NOT NULL,
  `lst_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkup_lst`
--

INSERT INTO `checkup_lst` (`checkup_indx`, `checkup_name`, `category_id`, `checkup_price`, `lst_activation`) VALUES
(1, 'consultation And Interview', 1, '1000.00', 1),
(2, 'Height', 2, '0.00', 1),
(3, 'Weight', 2, '0.00', 1),
(4, 'Body Mass Index', 2, '0.00', 1),
(5, 'Hearing Acuity (1000Hz/4000Hz)', 3, '0.00', 1),
(6, 'Pulmonary Function Test', 3, '0.00', 1),
(7, 'Blood Pressure', 3, '0.00', 1),
(8, 'ECG', 3, '0.00', 1),
(9, 'Vision Test', 4, '0.00', 1),
(10, 'Intraocular Pressure', 4, '0.00', 1),
(11, 'Retinal Camera', 4, '0.00', 1),
(12, 'AST(GOT)', 5, '0.00', 1),
(13, 'ALT(GPT)', 5, '0.00', 1),
(14, 'G-GT', 5, '0.00', 1),
(15, 'Total protein', 5, '0.00', 1),
(16, 'Albumin', 5, '0.00', 1),
(17, 'Total Bilirubin', 5, '0.00', 1),
(18, 'LDH', 5, '0.00', 1),
(19, 'ALP', 5, '0.00', 1),
(20, 'Amylase', 5, '0.00', 1),
(21, 'Creatinine', 5, '0.00', 1),
(22, 'Urea nitrogen', 5, '0.00', 1),
(23, 'Total-cholesterol', 5, '0.00', 1),
(24, 'HDL-cholesterol', 5, '0.00', 1),
(25, 'LDL-cholesterol', 5, '0.00', 1),
(26, 'Triglyceride', 5, '0.00', 1),
(27, 'Fasting glucose', 5, '0.00', 1),
(28, 'HbA1c', 5, '0.00', 1),
(29, 'Uric Acid', 5, '0.00', 1),
(30, 'Na', 5, '0.00', 1),
(31, 'Cl', 5, '0.00', 1),
(32, 'K', 5, '0.00', 1),
(33, 'RBC', 5, '0.00', 1),
(34, 'WBC', 5, '0.00', 1),
(35, 'Hemoglobin', 5, '0.00', 1),
(36, 'Hematocrit', 5, '0.00', 1),
(37, 'Platelet', 5, '0.00', 1),
(38, 'MCV', 5, '0.00', 1),
(39, 'MCH', 5, '0.00', 1),
(40, 'MCHC', 5, '0.00', 1),
(41, 'Serum iron', 5, '0.00', 1),
(42, 'Baso', 5, '0.00', 1),
(43, 'Eosino', 5, '0.00', 1),
(44, 'Lympho', 5, '0.00', 1),
(45, 'Mono', 5, '0.00', 1),
(46, 'Neutro', 5, '0.00', 1),
(47, 'CRP', 5, '0.00', 1),
(48, 'HBsAg', 5, '0.00', 1),
(49, 'HCVAb', 5, '0.00', 1),
(50, 'RPR', 5, '0.00', 1),
(51, 'Helicobacter pylori Ab', 5, '0.00', 1),
(52, 'Protein', 6, '0.00', 1),
(53, 'Glucose', 6, '0.00', 1),
(54, 'Occult blood', 6, '0.00', 1),
(55, 'Specific gravity', 6, '0.00', 1),
(56, 'Urobilinogen', 6, '0.00', 1),
(57, 'Bilirubin', 6, '0.00', 1),
(58, 'Urinary sediment', 6, '0.00', 1),
(59, 'pH', 6, '600.00', 1),
(60, 'Occult blood reaction (2 days method)', 7, '0.00', 1),
(61, 'Chest X-ray CT', 8, '0.00', 1),
(62, 'Visceral Fat Area Measurement with CT', 8, '0.00', 1),
(63, 'Upper gastrointestinal tract exam. (Esophagus, Stomach and Duodenum)&*Choose GI series or endoscopy', 8, '0.00', 1),
(64, 'Abdominal ultrasound (Liver, Gall-bladder, Spleen, Kidney, Pancreas)', 8, '0.00', 1),
(65, 'Mammography (only for women)', 8, '0.00', 1),
(66, 'Breast ultrasound (only for women)', 8, '0.00', 1),
(67, 'CA19-9', 9, '0.00', 1),
(68, 'PSA (only for men)', 9, '0.00', 1),
(69, 'CA125 (only for women)', 9, '0.00', 1),
(70, 'Intra vaginal examination (only for women)', 10, '0.00', 1),
(71, 'Pap smear (only for women)', 10, '0.00', 1),
(72, 'Lunch at Grand Hyatt Hotel after checkup', 11, '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_calendar`
--

CREATE TABLE `clinic_calendar` (
  `cliniccalendar_indx` int(11) NOT NULL,
  `clinic_date` date NOT NULL,
  `clinic_timeF` time NOT NULL,
  `clinic_timeT` time NOT NULL,
  `clinic_id` varchar(100) NOT NULL,
  `doc_regno` varchar(150) NOT NULL,
  `clinic_activation` int(11) NOT NULL,
  `doc_activation` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `clinicalendar_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic_calendar`
--

INSERT INTO `clinic_calendar` (`cliniccalendar_indx`, `clinic_date`, `clinic_timeF`, `clinic_timeT`, `clinic_id`, `doc_regno`, `clinic_activation`, `doc_activation`, `id`, `clinicalendar_activation`) VALUES
(26, '2020-11-06', '09:00:00', '12:00:00', '001', '5248', 1, 1, 'CLN/G/1', 1),
(27, '2020-11-07', '11:00:00', '13:00:00', '001', '5248', 1, 1, 'CLN/G/1', 1),
(28, '2020-11-08', '11:00:00', '13:00:00', '001', '5248', 1, 1, 'CLN/G/1', 1),
(29, '2020-11-09', '17:13:00', '20:13:00', '001', '5248', 1, 1, 'CLN/G/1', 1);

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
('001', 'Dental', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clin_room`
--

CREATE TABLE `clin_room` (
  `id` varchar(100) NOT NULL,
  `room_name` varchar(150) NOT NULL,
  `room_device` varchar(110) NOT NULL,
  `clinic_id` varchar(100) NOT NULL,
  `room_activ` int(11) NOT NULL,
  `indx_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clin_room`
--

INSERT INTO `clin_room` (`id`, `room_name`, `room_device`, `clinic_id`, `room_activ`, `indx_id`) VALUES
('CLN/G/1', 'Ground Floor 1st Room', 'HARITHA-007', '001', 1, 1);

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
('982041562v', 'haritha', '5248', 'haritha@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '001', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `drug_info`
--

CREATE TABLE `drug_info` (
  `drg_name` varchar(150) NOT NULL,
  `drg_capa` float NOT NULL,
  `drg_vol` varchar(10) NOT NULL,
  `drg_number` varchar(100) NOT NULL,
  `prc_o_pill` decimal(10,2) NOT NULL,
  `drg_activation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drug_info`
--

INSERT INTO `drug_info` (`drg_name`, `drg_capa`, `drg_vol`, `drg_number`, `prc_o_pill`, `drg_activation`) VALUES
('Sinarest-s', 30, 'ml', '18BQ089', '945.00', 1),
('Esomac 20', 20, 'mg', '8901117031371', '15.00', 1),
('Metformin', 500, 'mg', '8903238501139', '10.00', 1);

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
('9016', 'HARITHA MALSHAN EDIRISINGHE', '982041562v', '1998-07-22', 'MALE', 765403320, 0, 'harithamalshan1998@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Haritha edirisinghe,kaluthara,mathugama,welipanna,lewwanduwa');

-- --------------------------------------------------------

--
-- Table structure for table `patient_passbook`
--

CREATE TABLE `patient_passbook` (
  `id` int(11) NOT NULL,
  `patient_regNum` varchar(150) NOT NULL,
  `doc_regno` varchar(150) NOT NULL,
  `clinic_id` varchar(100) NOT NULL,
  `consult_date` date NOT NULL,
  `disF_patient` varchar(250) DEFAULT NULL,
  `dis_stts` varchar(250) DEFAULT NULL,
  `commF_patient` varchar(250) DEFAULT NULL,
  `drg_lst` varchar(250) DEFAULT NULL,
  `chckup_lst` varchar(250) DEFAULT NULL,
  `nxt_clinic_date` date NOT NULL,
  `chck_activat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_passbook`
--

INSERT INTO `patient_passbook` (`id`, `patient_regNum`, `doc_regno`, `clinic_id`, `consult_date`, `disF_patient`, `dis_stts`, `commF_patient`, `drg_lst`, `chckup_lst`, `nxt_clinic_date`, `chck_activat`) VALUES
(14, '9016', '5248', '001', '2020-11-07', '', 'dsfsdf', 'sdfsdfdd', 'wwwwwwwwwww', 'ddd', '2020-11-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sample_reslt`
--

CREATE TABLE `sample_reslt` (
  `id` int(11) NOT NULL,
  `patient_regNum` varchar(150) NOT NULL,
  `clinic_id` varchar(100) NOT NULL,
  `clt_date` date NOT NULL,
  `pay_typ` int(11) NOT NULL,
  `checkup_name` varchar(250) NOT NULL,
  `file_Nme` varchar(250) NOT NULL,
  `activations` int(11) NOT NULL,
  `upload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('004', 'Admin', 1),
('005', 'Main Laboratory', 1),
('006', 'Information', 1);

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
('2222', '222222222V', 'Malshan', 'FEMALE', '1999-10-01', 777523165, 0, 'Dispensary@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '002', 1),
('3333', '333333333V', 'dsfsdf fsdfdsf', 'MALE', '2000-09-17', 785642230, 0, 'Regch@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '003', 1),
('4444', '444444444V', 'malshan', 'MALE', '1998-09-03', 76532220, 0, 'Admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '004', 1),
('5555', '555555555V', 'W.M.S.U.K.Edirisinghe', 'FEMALE', '1990-08-10', 754682210, 0, 'mainlab@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '005', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkup_cate`
--
ALTER TABLE `checkup_cate`
  ADD PRIMARY KEY (`category_id`) USING BTREE,
  ADD UNIQUE KEY `category` (`category`,`activation_cate`);

--
-- Indexes for table `checkup_lst`
--
ALTER TABLE `checkup_lst`
  ADD PRIMARY KEY (`checkup_indx`),
  ADD KEY `checkup_lst_ibfk_1` (`category_id`),
  ADD KEY `checkup_name` (`checkup_name`,`checkup_price`,`lst_activation`);

--
-- Indexes for table `clinic_calendar`
--
ALTER TABLE `clinic_calendar`
  ADD PRIMARY KEY (`cliniccalendar_indx`,`clinic_date`) USING BTREE,
  ADD KEY `clinic_id` (`clinic_id`,`clinic_activation`),
  ADD KEY `doc_regno` (`doc_regno`,`doc_activation`),
  ADD KEY `clinic_timeF` (`clinic_timeF`,`clinic_timeT`,`id`,`clinicalendar_activation`);

--
-- Indexes for table `clinic_details`
--
ALTER TABLE `clinic_details`
  ADD PRIMARY KEY (`clinic_id`,`clinic_activation`) USING BTREE;

--
-- Indexes for table `clin_room`
--
ALTER TABLE `clin_room`
  ADD PRIMARY KEY (`indx_id`,`id`,`room_name`) USING BTREE,
  ADD KEY `room_device` (`room_device`,`room_activ`),
  ADD KEY `clin_room_ibfk_1` (`clinic_id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`doc_regno`,`doc_activation`,`doc_nic`) USING BTREE,
  ADD KEY `doctor_details_ibfk_1` (`clinic_id`),
  ADD KEY `doc_dt_idx` (`doc_name`,`doc_username`,`doc_password`,`clinic_id`) USING BTREE;

--
-- Indexes for table `drug_info`
--
ALTER TABLE `drug_info`
  ADD PRIMARY KEY (`drg_number`) USING BTREE,
  ADD KEY `drg_name` (`drg_name`,`drg_capa`,`drg_vol`,`prc_o_pill`);

--
-- Indexes for table `patient_data`
--
ALTER TABLE `patient_data`
  ADD PRIMARY KEY (`patient_regNum`,`patient_NIC`) USING BTREE,
  ADD KEY `patient_dt_idx` (`patient_fullName`,`patient_Dob`,`patient_Gender`,`patient_Mobile`,`patient_fixed_Number`,`patient_email`,`patient_password`) USING BTREE;

--
-- Indexes for table `patient_passbook`
--
ALTER TABLE `patient_passbook`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consult_date` (`consult_date`,`disF_patient`,`dis_stts`,`commF_patient`,`chckup_lst`,`chck_activat`) USING HASH,
  ADD KEY `patient_passbook_ibfk_1` (`patient_regNum`),
  ADD KEY `drg_lst` (`drg_lst`,`doc_regno`,`clinic_id`) USING BTREE,
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `sample_reslt`
--
ALTER TABLE `sample_reslt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_regNum` (`patient_regNum`,`clinic_id`,`clt_date`,`pay_typ`,`checkup_name`,`file_Nme`,`activations`,`upload`),
  ADD KEY `clinic_id` (`clinic_id`);

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
-- AUTO_INCREMENT for table `checkup_cate`
--
ALTER TABLE `checkup_cate`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `checkup_lst`
--
ALTER TABLE `checkup_lst`
  MODIFY `checkup_indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `clinic_calendar`
--
ALTER TABLE `clinic_calendar`
  MODIFY `cliniccalendar_indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `clin_room`
--
ALTER TABLE `clin_room`
  MODIFY `indx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_passbook`
--
ALTER TABLE `patient_passbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sample_reslt`
--
ALTER TABLE `sample_reslt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkup_lst`
--
ALTER TABLE `checkup_lst`
  ADD CONSTRAINT `checkup_lst_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `checkup_cate` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clinic_calendar`
--
ALTER TABLE `clinic_calendar`
  ADD CONSTRAINT `clinic_calendar_ibfk_1` FOREIGN KEY (`clinic_id`,`clinic_activation`) REFERENCES `clinic_details` (`clinic_id`, `clinic_activation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clinic_calendar_ibfk_2` FOREIGN KEY (`doc_regno`,`doc_activation`) REFERENCES `doctor_details` (`doc_regno`, `doc_activation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clin_room`
--
ALTER TABLE `clin_room`
  ADD CONSTRAINT `clin_room_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic_details` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD CONSTRAINT `doctor_details_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic_details` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_passbook`
--
ALTER TABLE `patient_passbook`
  ADD CONSTRAINT `patient_passbook_ibfk_1` FOREIGN KEY (`patient_regNum`) REFERENCES `patient_data` (`patient_regNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_passbook_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic_details` (`clinic_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sample_reslt`
--
ALTER TABLE `sample_reslt`
  ADD CONSTRAINT `sample_reslt_ibfk_1` FOREIGN KEY (`patient_regNum`) REFERENCES `patient_data` (`patient_regNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sample_reslt_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic_details` (`clinic_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `section_staff`
--
ALTER TABLE `section_staff`
  ADD CONSTRAINT `section_staff_ibfk_1` FOREIGN KEY (`section_ID`) REFERENCES `section` (`section_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
