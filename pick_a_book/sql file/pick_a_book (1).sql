-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 09:44 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pick_a_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(2, 'fasih', 'fshzafar@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2022-07-16 08:40:23'),
(7, 'Admin 2 - updated', 'admin2@gmail.com', 'admin2', '123456', '2022-07-26 22:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

CREATE TABLE `book_requests` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `view_flag` varchar(255) NOT NULL DEFAULT '1',
  `updated_date` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_requests`
--

INSERT INTO `book_requests` (`id`, `id_user`, `id_book`, `status`, `view_flag`, `updated_date`, `created_date`) VALUES
(1, 4, 1, 'ACCEPT', '0', '2022-07-25 00:15:29', '2022-07-24 13:07:06'),
(2, 12, 3, 'ACCEPT', '0', '2022-07-26 23:57:45', '2022-07-24 13:07:06'),
(3, 12, 4, 'REJECT', '0', '2022-07-25 00:19:09', '2022-07-24 13:07:06'),
(4, 10, 3, 'NEW', '1', '2022-07-27 01:35:28', '2022-07-24 13:19:19'),
(5, 4, 4, 'NEW', '1', '2022-07-25 00:18:56', '2022-07-24 13:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `id_school` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `id_school`, `class_name`, `created_date`) VALUES
(1, 1, 'Class 1', '2022-07-16 19:25:48'),
(2, 1, 'Class 2', '2022-07-16 19:25:48'),
(3, 1, 'Class 3', '2022-07-16 19:25:48'),
(4, 2, 'Class 1', '2022-07-16 19:27:06'),
(5, 2, 'Class 2', '2022-07-16 19:27:06'),
(6, 2, 'Class 3', '2022-07-16 19:27:06'),
(7, 2, 'Class 4', '2022-07-16 19:27:06'),
(17, 5, 'Class - 1', '2022-07-27 02:45:12'),
(18, 5, 'Class - 2', '2022-07-27 02:45:12'),
(19, 5, 'Class - 3', '2022-07-27 02:45:12'),
(20, 5, 'Class - 4', '2022-07-27 02:45:12'),
(21, 5, 'Class - 5', '2022-07-27 02:45:12'),
(22, 5, 'Class - 6', '2022-07-27 02:45:12'),
(23, 5, 'Class - 7', '2022-07-27 02:45:12'),
(24, 5, 'Class - 8', '2022-07-27 02:45:12'),
(25, 5, 'Class - 9', '2022-07-27 02:45:12'),
(26, 5, 'Class - 10', '2022-07-27 02:45:12'),
(27, 5, 'Class - 11', '2022-07-27 02:45:12'),
(28, 5, 'Class - 12', '2022-07-27 02:45:12'),
(54, 6, 'Class - 1', '2022-08-02 00:28:54'),
(55, 6, 'Class - 2', '2022-08-02 00:28:54'),
(56, 6, 'Class - 3', '2022-08-02 00:28:54'),
(57, 6, 'Class - 4', '2022-08-02 00:28:54'),
(58, 6, 'Class - 5', '2022-08-02 00:28:54'),
(59, 6, 'Class - 6', '2022-08-02 00:28:54'),
(60, 6, 'Class - 7', '2022-08-02 00:28:54'),
(61, 6, 'Class - 8', '2022-08-02 00:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `PublisherName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `PublisherName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Punjab Textbook Board', '2017-07-08 12:49:09', '2022-07-16 14:51:48'),
(2, 'National Book Foundation', '2017-07-08 14:30:23', '2022-07-16 14:52:10'),
(3, 'Oxford ', '2017-07-08 14:35:08', '2022-07-16 14:52:24'),
(4, 'Gaaba publishers', '2017-07-08 14:35:21', '2022-07-16 14:52:38'),
(5, 'Afaaq publishers', '2017-07-08 14:35:36', '2022-07-16 14:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class_type` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `class_type`, `created_date`, `updated_date`) VALUES
(1, 'School A', 'Custom', '2022-07-16 19:25:48', NULL),
(2, 'School B', 'Custom', '2022-07-16 19:27:06', NULL),
(5, 'Army Public School', 'Custom', '2022-07-27 02:45:12', NULL),
(6, 'School C - updated', 'Middle', '2022-08-01 23:37:57', '2022-08-02 00:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `id_school` int(11) DEFAULT NULL,
  `id_class` int(11) NOT NULL,
  `id_publisher` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `id_school`, `id_class`, `id_publisher`, `BookPrice`, `RegDate`, `UpdationDate`) VALUES
(1, 'PHP And MySql programming', 2, 7, 1, 20, '2017-07-08 20:04:55', '2022-07-24 13:13:20'),
(3, 'physics', 1, 3, 4, 15, '2017-07-08 20:17:31', '2022-07-24 13:13:00'),
(4, 'Oliver Twist', 2, 7, 3, 399, '2022-07-16 16:54:35', NULL),
(5, 'Chemistry', 2, 7, 2, NULL, '2022-07-26 20:13:21', NULL),
(6, 'English', 2, 7, 2, NULL, '2022-07-26 20:14:46', NULL),
(7, 'Urdu', 2, 7, 2, NULL, '2022-07-26 20:17:40', NULL),
(8, 'Isl', 2, 7, 2, NULL, '2022-07-26 20:23:58', NULL),
(9, 'Biology', 2, 7, 2, NULL, '2022-07-26 20:26:33', NULL),
(10, 'Computers - updated edition', 2, 7, 2, NULL, '2022-07-26 20:27:16', '2022-07-26 21:43:44'),
(11, 'Math', 2, 7, 1, NULL, '2022-07-26 20:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Romantic', 1, '2017-07-04 18:35:25', '2017-07-06 16:00:42'),
(5, 'Technology', 1, '2017-07-04 18:35:39', '2017-07-08 17:13:03'),
(6, 'Science', 1, '2017-07-04 18:35:55', '0000-00-00 00:00:00'),
(7, 'Management', 0, '2017-07-04 18:36:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`) VALUES
(1, 1, 'SID002', '2017-07-15 06:09:47', '2017-07-15 11:15:20', 1, 0),
(2, 1, 'SID002', '2017-07-15 06:12:27', '2017-07-15 11:15:23', 1, 5),
(3, 3, 'SID002', '2017-07-15 06:13:40', NULL, 0, NULL),
(4, 3, 'SID002', '2017-07-15 06:23:23', '2017-07-15 11:22:29', 1, 2),
(5, 1, 'SID009', '2017-07-15 10:59:26', NULL, 0, NULL),
(6, 3, 'SID011', '2017-07-15 18:02:55', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(4, 'SID005', 'John Roberts', 'john@yahoo.com', '8569710025', '92228410fc8b872914e023160cf4ae8f', 1, '2017-07-11 15:41:27', '2022-07-16 17:06:40'),
(10, 'SID011', 'Clide Louie', 'CLIDE@gmail.com', '4672423754', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-15 18:00:59', '2019-04-11 14:12:50'),
(11, 'SID012', 'Clive Dela Cruz', 'clive21@yahoo.com', '0945208280', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-04-11 13:46:30', NULL),
(12, 'SID013', 'fasih', 'fshzafar@gmail.com', '0316515362', 'e10adc3949ba59abbe56e057f20f883e', 1, '2022-07-15 14:54:54', '2022-07-16 08:48:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
