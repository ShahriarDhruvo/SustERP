-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2020 at 09:29 PM
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
  `Number_Of_Books` int(100) NOT NULL,
  `uploaders_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addbook`
--

INSERT INTO `addbook` (`id`, `Book_Name`, `Author_Name`, `Number_Of_Books`, `uploaders_name`) VALUES
(2, 'swe', 'rafi', 6, ''),
(7, 'swe', 'Samir', 213, ''),
(8, 'Metro', 'Glokaskova', 10, ''),
(9, 'Mecha', 'Samir', 212, ''),
(10, 'swe', 'Samir', 213, 'Dhruvo');

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
(16, '06/02/2020 Thursday 06:39:19pm', 'Tuesday', '06:38:00', 'Dhruvo', 'CEP', 'math', 2011, '3/1', '(1)_Screenshot from 2020-02-01 18-02-37.png', '2021-07-06', 'What are you doing?'),
(17, '06/02/2020 Thursday 06:40:14pm', 'Thursday', '06:39:00', 'Dhruvo', 'SWE', 'Mee 213', 2019, '1/1', '(17)_Screenshot from 2020-02-01 20-46-23.png', '2020-02-06', 'Yo'),
(18, '06/02/2020 Thursday 09:54:16pm', 'Thursday', '09:54:00', 'Samir', 'SWE', 'Math', 2019, '1/1', '(18)_Dhruvo.jpg', '2020-02-06', 'Yo');

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
(17, '29/01/2020 Wednesday 03:17:43am', 'Dhruvo', 'SWE', 2019, '3/2', 'SWE', '(17)_1.jpg', 'LOL');

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
  `uploaders_name` varchar(255) NOT NULL,
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

INSERT INTO `events` (`id`, `date`, `day`, `time`, `uploaders_name`, `ename`, `orname`, `edate`, `link`, `files`, `comments`) VALUES
(31, '24-01-2020 04:22am', 'Monday', '14:56:00', '', 'Football', 'SWE', '2020-01-27', '\"https://www.google.com/\"', '(1)_assignment 2p.pdf', 'Yo man'),
(33, '24-01-2020 04:23am', 'Saturday', '13:56:00', '', 'Football', 'SUST Authority', '2020-01-25', '', '', 'uo'),
(34, '24-01-2020 04:24am', 'Wednesday', '13:56:00', '', 'Football', 'CSE society', '2020-03-25', '', '', 'uo'),
(35, '24-01-2020 04:36am', 'Saturday', '14:53:00', '', 'Football', 'SWE', '2020-01-25', '', '', 'uo'),
(37, '06-02-2020 10:01pm', 'Saturday', '07:00:00', 'Teacher', 'Convocation', 'CSE society', '2020-06-06', '\"https://google.com/\"', '(36)_Dhruvo.jpg', 'LOL');

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `id` int(11) NOT NULL,
  `Student_id` int(255) NOT NULL,
  `Book_Name` varchar(255) NOT NULL,
  `Book_Serial` varchar(255) NOT NULL,
  `Issue_Date` date NOT NULL,
  `received_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issuebook`
--

INSERT INTO `issuebook` (`id`, `Student_id`, `Book_Name`, `Book_Serial`, `Issue_Date`, `received_by`) VALUES
(8, 2018854999, 'Mecha', 'rfe5234d', '2020-02-06', ''),
(9, 2018831017, 'metro', 'dasdasd434', '2020-02-06', '');

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
(3, '22/01/2020 Wednesday 12:54:21pm', 'Teacher', 'SWE', 'Operating System', 2018, '2/2', '(3)_result 1.jpg'),
(4, '06/02/2020 Thursday 07:01:07pm', 'Dhruvo', 'EEE', 'Electrical Engineering', 2006, '3/2', '(4)_Screenshot from 2020-02-06 00-12-28.png');

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
  `days` int(255) NOT NULL,
  `received_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `returnbook`
--

INSERT INTO `returnbook` (`id`, `Student_id`, `Book_Name`, `Book_Serial`, `Issue_Date`, `Return_Date`, `days`, `received_by`) VALUES
(1, 2017831060, 'swe', '3543erwerw', '2020-02-21', '2020-02-29', 0, ''),
(2, 2017831060, 'swe', '3543erwerw', '2020-02-21', '2020-02-29', 8, ''),
(3, 2017831060, 'swe', '3543erwerw', '2020-02-03', '2035-07-27', 5653, ''),
(4, 2017831060, 'swe', '3543erwerw', '2020-02-03', '2020-02-03', 0, ''),
(5, 2017331006, 'swe', '3543erwerw', '2020-02-03', '2020-02-20', 17, ''),
(6, 2017845070, 'Mecha', '4235rdf', '2020-02-06', '2020-02-06', 0, ''),
(7, 1986132342, 'Mecha', '5235235', '2020-02-06', '2020-02-06', 0, 'Dhruvo');

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
(35, 'Samir', 'SWE', 'teacher', 'assistant professor', 2008, 'befako9496@qmailers.com', '$2y$10$Vt.G5js/Q2NDKoJzy1P19O6o.JK0ZlkI9gMTJu1e/FbKpqRsUuJDW', 'e79295289336cf55c61a2d9531826e9fc45318a501f428759cb248c67208494a01797c86b07028a9944bcb31e52e1f0a0a3e', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `returnbook`
--
ALTER TABLE `returnbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
