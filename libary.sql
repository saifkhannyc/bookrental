-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 03:57 AM
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
-- Database: `libary`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date_booked` date NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `book_id`, `member_id`, `date_booked`, `from_date`, `to_date`, `status`) VALUES
(1, 2, 2, '2021-09-29', '2021-09-29', '2021-10-01', 2),
(2, 1, 3, '2021-09-29', '2021-09-29', '2021-12-15', 2),
(3, 1, 2, '2021-09-29', '2021-09-29', '2021-11-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_cat`
--

CREATE TABLE `book_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `cat_desc` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `book_cat`
--

INSERT INTO `book_cat` (`cat_id`, `cat_name`, `cat_desc`, `parent_id`, `status`) VALUES
(1, 'Information Technology', '<p>This is Information Technology subject</p>\r\n', 0, 1),
(2, 'Business', '<p>This is business book category</p>\r\n', 0, 1),
(3, 'Marketing', '<p>This marketing sub category</p>\r\n', 2, 1),
(4, 'Startup', '<p>This is startup sub-category</p>\r\n', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `book_id` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `book_title` varchar(300) NOT NULL,
  `book_desc` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `author` varchar(200) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `pub_date` date NOT NULL,
  `quantity` int(10) NOT NULL,
  `available` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`book_id`, `ISBN`, `book_title`, `book_desc`, `category_id`, `author`, `publisher`, `image`, `pub_date`, `quantity`, `available`) VALUES
(1, '1617294403', 'Web Design Playground', '<p><em>Web Design Playground takes</em>&nbsp;you step by step from writing your first line of HTML to creating interesting and attractive web pages. In this project-based book, you&#39;ll use a custom online workspace, the book&#39;s companion Playground, to design websites, product pages, photo galleries, and more.</p>\r\n', 1, 'Paul McFedries ', 'Manning', '1027953937042241-6F+RDbIL._SX397_BO1,204,203,200_.jpg', '2021-09-14', 2, 0),
(2, '', 'Startups Made Simple', '<p>Imagine the perfect business for you. Not only a business that you love, but one that generates consistent wealth and is so well systemized that it mostly runs itself.<br />\r\n<br />\r\nIn Startups Made Simple, small business expert Matt Knee has created a complete guide that takes you from idea to systemized company as quickly and easily as humanly possible. This book is not for the stereotypical Silicon Valley-type of startup that get millions in venture capital. This book is for &ldquo;the rest of us&rdquo;&mdash;the 99% of entrepreneurs who bootstrap and start real businesses.</p>\r\n', 4, 'Matt Knee ', 'ROCKNEE LLC', '3801766756452.jpg', '2021-06-07', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_issue`
--

CREATE TABLE `book_issue` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_trans`
--

CREATE TABLE `book_trans` (
  `issue_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  `date_returned` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `book_trans`
--

INSERT INTO `book_trans` (`issue_id`, `booking_id`, `book_id`, `member_id`, `issue_date`, `return_date`, `date_returned`, `status`) VALUES
(1, 1, 2, 2, '2021-09-29', '2021-10-01', '0000-00-00', 2),
(2, 2, 1, 3, '2021-09-29', '2021-12-15', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `userole` int(1) NOT NULL,
  `status` varchar(30) NOT NULL,
  `join_date` date NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `fullname`, `email`, `password`, `phone`, `address`, `userole`, `status`, `join_date`, `image`) VALUES
(1, 'Saif Khan', 'saifkhan6@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '917-239-68', NULL, 2, '1', '2021-09-29', NULL),
(2, 'Rahim Chowdhury', 'rahim@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '917-233-1111', '34 Mayer Drive, Wantagh NY 11793', 1, '1', '2021-09-29', '84776974570538PersonalImage.png'),
(3, 'Salim Khan', 'salim@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '231-333-3333', '3 Brother Lane, Perry, NY 11150', 1, '1', '2021-09-29', '81661575005837user8-128x128.jpg'),
(4, 'Shahed Khan', 'shahed@gmail.com', '7699fecede0e563e90443f8aa0f2eb461fcd40e8', '212-111-4452', NULL, 1, '1', '2021-09-29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `book_cat`
--
ALTER TABLE `book_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_trans`
--
ALTER TABLE `book_trans`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book_cat`
--
ALTER TABLE `book_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_trans`
--
ALTER TABLE `book_trans`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
