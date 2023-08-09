-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 06:44 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cou_student`
--

-- --------------------------------------------------------

--
-- Table structure for table `side_effect`
--

CREATE TABLE `side_effect` (
  `id` int(8) DEFAULT NULL,
  `vaccination_id` varchar(35) DEFAULT NULL,
  `fever` varchar(3) DEFAULT NULL,
  `headache` varchar(3) DEFAULT NULL,
  `vomitting` varchar(3) DEFAULT NULL,
  `other_effect` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `side_effect`
--

INSERT INTO `side_effect` (`id`, `vaccination_id`, `fever`, `headache`, `vomitting`, `other_effect`) VALUES
(11908014, '201549847092920955', 'No', 'No', 'No', 'Body aches'),
(11918015, '12345678', 'No', 'Yes', 'No', ''),
(11908002, '456146743022925218', 'Yes', 'No', 'No', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `id` int(8) NOT NULL,
  `session` varchar(9) DEFAULT NULL,
  `vaccinated` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `email`, `department`, `id`, `session`, `vaccinated`) VALUES
('Rydwanul Islam', 'rydwanmcj@gmail.com', 'MCJ', 11718031, '2016-2017', 'No'),
('Ashraful Islam', 'aislam.cse.1023@gmail.com', 'CSE', 11808023, '2017-2018', 'No'),
('Mahabub Rahman', 'mahabubrahman618@gmail.com', 'CSE', 11808043, '2017-2018', 'No'),
('Shahida', '3939shahida@gmail.com', 'AIS', 11906056, '2018-2019', 'No'),
('Nayeem Hossain', 'nayeeem.cse.cou@gmail.com', 'CSE', 11908002, '2018-2019', 'Yes'),
('Mestu Paul', 'paulmestu@gmail.com', 'CSE', 11908005, '2018-2019', 'No'),
('Mehedi Hasan', 'hasanmehedi2609@gmail.com', 'CSE', 11908010, '2018-2019', 'No'),
('Aftab Hossain Shakib', 'aftabshakib0@gmail.com', 'CSE', 11908013, '2018-2019', 'No'),
('Jamil Uddin Robin', 'jamiluddin1999@gmail.com', 'CSE', 11908014, '2018-2019', 'Yes'),
('Rayhan Hasan Labib', 'rayhanlabib7@gmail.com', 'CSE', 11908028, '2018-2019', 'No'),
('Arabindo Naha', 'arabindonaha11@stud.cou.ac.bd', 'CSE', 11908030, '2018-2019', 'No'),
('Mehedi Hasan Arafat', 'mehedihasanarafat10@gmail.com', 'CSE', 11908036, '2018-2019', 'No'),
('Md  Romjan Chowdhury', 'mrchowdhury587@gmail.com', 'CSE', 11908048, '2019-2020', 'No'),
('M M Hashmi Sarker', 'mudabbirhashmi2000@gmail.com', 'MCJ', 11918015, '2018-2019', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_info`
--

CREATE TABLE `vaccination_info` (
  `id` int(8) DEFAULT NULL,
  `vaccination_id` varchar(35) NOT NULL,
  `vaccine_name` varchar(15) DEFAULT NULL,
  `vaccination_date` varchar(20) DEFAULT NULL,
  `first_dose` varchar(3) DEFAULT NULL,
  `second_dose` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination_info`
--

INSERT INTO `vaccination_info` (`id`, `vaccination_id`, `vaccine_name`, `vaccination_date`, `first_dose`, `second_dose`) VALUES
(11918015, '12345678', 'VEROCELL', '2021-09-12', 'Yes', ''),
(11908014, '201549847092920955', 'Verocell', '2021-09-14', 'Yes', ''),
(11908002, '456146743022925218', 'Verocell', '2021-12-26', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `ip` varchar(30) NOT NULL,
  `ip_count` int(11) DEFAULT NULL,
  `location` varchar(15) DEFAULT NULL,
  `map` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`ip`, `ip_count`, `location`, `map`) VALUES
('10.182.113.145, 103.67.158.65', 1, NULL, NULL),
('103.230.106.20', 2, NULL, NULL),
('103.67.158.218', 43, NULL, NULL),
('116.58.202.189', 1, NULL, NULL),
('2a03:2880:20ff:11::face:b00c', 1, NULL, NULL),
('2a03:2880:20ff:15::face:b00c', 1, NULL, NULL),
('2a03:2880:20ff:16::face:b00c', 1, NULL, NULL),
('2a03:2880:20ff:b::face:b00c', 1, NULL, NULL),
('2a03:2880:32ff:b::face:b00c', 2, NULL, NULL),
('42.0.6.233', 8, NULL, NULL),
('45.125.221.70', 7, NULL, NULL),
('::1', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `side_effect`
--
ALTER TABLE `side_effect`
  ADD UNIQUE KEY `id` (`id`) USING BTREE,
  ADD UNIQUE KEY `vaccination_id` (`vaccination_id`) USING BTREE;

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccination_info`
--
ALTER TABLE `vaccination_info`
  ADD PRIMARY KEY (`vaccination_id`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`ip`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `side_effect`
--
ALTER TABLE `side_effect`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `fk_vid` FOREIGN KEY (`vaccination_id`) REFERENCES `vaccination_info` (`vaccination_id`);

--
-- Constraints for table `vaccination_info`
--
ALTER TABLE `vaccination_info`
  ADD CONSTRAINT `f_k` FOREIGN KEY (`id`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
