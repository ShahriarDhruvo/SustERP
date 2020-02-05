-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2020 at 05:44 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_datas`
--

-- --------------------------------------------------------

--
-- Table structure for table `addbook`
--

CREATE TABLE `addbook` (
  `id` int(11) NOT NULL,
  `Book_Name` varchar(255) NOT NULL,
  `Author_Name` varchar(255) NOT NULL,
  `Number_Of_Books` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addbook`
--

INSERT INTO `addbook` (`id`, `Book_Name`, `Author_Name`, `Number_Of_Books`) VALUES
(2, 'swe', 'rafi', 6);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `uploaders_name` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `batch_year` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  `sdate` date NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `date`, `day`, `time`, `uploaders_name`, `department_name`, `course_name`, `batch_year`, `semester`, `files`, `sdate`, `comments`) VALUES
(12, '29/01/2020 Wednesday 04:13:49am', 'Tuesday', '06:10:00', 'Dhruvo', 'CEP', 'math', 2013, '3/2', '(1)_2.jpg', '2020-05-26', 'fbsbsfhs');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `uploaders_name` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `batch_year` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `uploaders_name`, `department_name`, `batch_year`, `semester`, `course_name`, `files`, `comments`) VALUES
(16, '29/01/2020 Wednesday 02:18:51am', 'Dhruvo', 'SWE', 2017, '3/1', 'math', '(1)_1.jpg', 'fdfdfs'),
(17, '29/01/2020 Wednesday 03:17:43am', 'Dhruvo', 'SWE', 2019, '3/2', 'SWE', '(17)_1.jpg', 'LOL'),
(21, '29/01/2020 Wednesday 03:59:46am', 'Dhruvo', 'MEE', 2019, '1/1', 'sWe', '(21)_2.jpg', 'sdsad');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comments_id` int(11) NOT NULL,
  `comments_subject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `comments_text` text CHARACTER SET latin1 NOT NULL,
  `comments_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comments_id`, `comments_subject`, `comments_text`, `comments_status`) VALUES
(1, 'sadsad', 'asfdasf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `ename` varchar(255) NOT NULL,
  `orname` varchar(255) NOT NULL,
  `edate` date NOT NULL,
  `link` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `date`, `day`, `time`, `ename`, `orname`, `edate`, `link`, `files`, `comments`) VALUES
(31, '24-01-2020 04:22am', 'Monday', '14:56:00', 'Football', 'SWE', '2020-01-27', '\"https://www.google.com/\"', '(1)_assignment 2p.pdf', 'Yo man'),
(33, '24-01-2020 04:23am', 'Saturday', '13:56:00', 'Football', 'SUST Authority', '2020-01-25', '', '', 'uo'),
(34, '24-01-2020 04:24am', 'Wednesday', '13:56:00', 'Football', 'CSE society', '2020-03-25', '', '', 'uo'),
(35, '24-01-2020 04:36am', 'Saturday', '14:53:00', 'Football', 'SWE', '2020-01-25', '', '', 'uo');

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `id` int(11) NOT NULL,
  `Student_id` int(255) NOT NULL,
  `Book_Name` varchar(255) NOT NULL,
  `Book_Serial` varchar(255) NOT NULL,
  `Issue_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `uploaders_name` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `batch_year` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `date`, `uploaders_name`, `department_name`, `course_name`, `batch_year`, `semester`, `files`) VALUES
(1, '22/01/2020 Wednesday 12:23:35pm', 'Admin', 'CEP', 'Electrical ', 2013, '1/2', '(1)_result 2p.pdf'),
(3, '22/01/2020 Wednesday 12:54:21pm', 'Teacher', 'SWE', 'Operating System', 2018, '2/2', '(3)_result 1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `returnbook`
--

CREATE TABLE `returnbook` (
  `id` int(11) NOT NULL,
  `Student_id` int(255) NOT NULL,
  `Book_Name` varchar(255) NOT NULL,
  `Book_Serial` varchar(255) NOT NULL,
  `Issue_Date` date NOT NULL,
  `Return_Date` date NOT NULL,
  `days` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `returnbook`
--

INSERT INTO `returnbook` (`id`, `Student_id`, `Book_Name`, `Book_Serial`, `Issue_Date`, `Return_Date`, `days`) VALUES
(1, 2017831060, 'swe', '3543erwerw', '2020-02-21', '2020-02-29', 0),
(2, 2017831060, 'swe', '3543erwerw', '2020-02-21', '2020-02-29', 8),
(3, 2017831060, 'swe', '3543erwerw', '2020-02-03', '2035-07-27', 5653),
(4, 2017831060, 'swe', '3543erwerw', '2020-02-03', '2020-02-03', 0),
(5, 2017331006, 'swe', '3543erwerw', '2020-02-03', '2020-02-20', 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Occupation` varchar(50) NOT NULL,
  `Designation` varchar(50) NOT NULL,
  `Sess` int(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Psw` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `UserName`, `Department`, `Occupation`, `Designation`, `Sess`, `Email`, `Psw`, `token`, `verified`) VALUES
(14, 'Dhruvo', 'SWE', 'admin', 'none', 0, 'shahriarelahi3062@gmail.com', '$2y$10$5UeFdvll6E1JrHbXSi1kaOXvjaPHS08gT4p8ZyqKzg5zX18cHpmEG', '8a5aa600f6bc3ae414d9f6f6f10b3bb5769d91faf7e5e04c89814e8599a185737329270d702deb2e7285a69c78d67bfb3d56', 1),
(18, 'Librarian', 'SWE', 'librarian', 'none', 0, 'hodoc59800@riv3r.net', '$2y$10$KfNx/B9OYQtcTyMbj9rkDOEcVexdFIM7hwH736T.VX2EMaW0UmAam', 'f51002c0d3e3605bb45e4ce16de7c742f7ac96334ba02b124ca7b22e71901603894215c28db28cbc26f6b48782e1eeb2087c', 1),
(19, 'teacher', 'SWE', 'teacher', 'assistant professor', 0, 'fenaca9578@cnetmail.net', '$2y$10$3bNA2qtSicOFk7jEnUTH1uH3nRwR85wGO0z8g65nw685LlwBva1Oq', '6e147c009f732c1c2d3b1a4dd32e25c04ef204fc6dbb6d7252072a923f02bd283ec34d206f9a53061f699d360cc6b651d720', 1),
(20, 'Jishnu', 'SWE', 'teacher', 'none', 0, 'pedav24404@eroyal.net', '$2y$10$jXz3S/mVADZ2iRYZR4RmdeXxGCteDxH0JuEfU.4n0K.03Ycx.jq46', '1da87749fcef61b4be92c91a91c5e2cd1df5c585ebdf7fdc62fe7d7d352a4735b49f201e6badc31aa318705b58c9ac21c2bc', 1),
(22, 'Muksid', 'SWE', 'admin', 'none', 0, 'vikoc85776@riv3r.net', '$2y$10$3Vtv0iNaWp9aQg.89MnNRe6btCz1ojc9x7M0mm.rnBs/sXEtCHJFC', '2a08ba6effcb80a7ac655b2f16837158be672b4402fce1a3e9687f983eabd4871b717ce123b437cbc9cdfe204260e13ee455', 1),
(23, 'Riyad', 'CSE', 'admin', 'professor', 0, 'jipem78195@cityroyal.org', '$2y$10$Jdm44ZyfGNI04NRRaZU0bebH/h6QmURKX5XflgPVWX4nDPBddKaIu', 'cca35640c721921e0c87ec26ed99c6a0aefc39ffcf5fceac540e0b8e13af65458614caa7005ec2f2f141bae35a61591d7f1a', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addbook`
--
ALTER TABLE `addbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comments_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returnbook`
--
ALTER TABLE `returnbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addbook`
--
ALTER TABLE `addbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `returnbook`
--
ALTER TABLE `returnbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
