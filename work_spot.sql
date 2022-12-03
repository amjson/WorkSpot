-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 01:08 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `work_spot`
--

-- --------------------------------------------------------

--
-- Table structure for table `canapplyjob`
--

CREATE TABLE `canapplyjob` (
  `id` int(10) NOT NULL,
  `comp_name` varchar(50) NOT NULL,
  `emp_mail` varchar(50) NOT NULL,
  `emp_phone` int(10) NOT NULL,
  `emp_token` text NOT NULL,
  `photo` text NOT NULL,
  `can_name` varchar(50) NOT NULL,
  `can_title` varchar(50) NOT NULL,
  `can_email` varchar(50) NOT NULL,
  `can_phone` int(10) NOT NULL,
  `can_gender` varchar(10) NOT NULL,
  `can_age` varchar(20) NOT NULL,
  `can_xp` varchar(50) NOT NULL,
  `can_study` text NOT NULL,
  `about` text NOT NULL,
  `can_token` text NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canapplyjob`
--

INSERT INTO `canapplyjob` (`id`, `comp_name`, `emp_mail`, `emp_phone`, `emp_token`, `photo`, `can_name`, `can_title`, `can_email`, `can_phone`, `can_gender`, `can_age`, `can_xp`, `can_study`, `about`, `can_token`, `uploaded`) VALUES
(1, 'joenest', 'joenest@newmail.com', 799066377, '161d4a835001a7', 'canprofile/61d4ac5b4339f9.34456157.jfif', 'joe son', 'web developer', 'json@newmail.com', 707066379, 'male', '22', '3 years of xp', 'Information Technology', 'i would like to be given a chance of exploring my skills', '161d4aae4cc069', '2022-01-04 20:23:26'),
(2, 'MasomoBora', 'masomobora@newmail.com', 741524152, '1638a8eeb0ec92', 'canprofile/61d4ac5b4339f9.34456157.jfif', 'joe son', 'web developer', 'json@newmail.com', 707066379, 'male', '22', '3 years of xp', 'Information Technology', 'form testing', '161d4aae4cc069', '2022-12-02 23:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `user_id` int(10) NOT NULL,
  `user_firstname` varchar(20) NOT NULL,
  `user_lastname` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_phonenumber` int(10) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_proffesion` text NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `acc_verify` int(1) NOT NULL,
  `token` text NOT NULL,
  `user_pass` text NOT NULL,
  `user_profile` text NOT NULL,
  `log_in` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`user_id`, `user_firstname`, `user_lastname`, `user_name`, `user_phonenumber`, `user_email`, `user_proffesion`, `user_gender`, `acc_verify`, `token`, `user_pass`, `user_profile`, `log_in`, `date_created`) VALUES
(1, 'Joe', 'Alpha', 'Codefor73', 785412369, 'mogaka@webmail.com', 'Web Developer', 'Male', 1, '15ef1967a7312d', '$2y$10$J4RbN.jmtqkU0kWj0Xkl2ehwW8/MdsJpI772vO0vovgLVG1OW/VCO', 'JobSite-Profiles/5ef1a0f1acd972.63829641.jpg', 'Offline', '2020-06-23 05:43:22'),
(4, 'joe', 'son', 'json', 789789001, 'json@newmail.com', 'Web Developer', 'Male', 1, '1638a9103e0338', '$2y$10$lg9ej3Y7jq95LH0s./rGsO/E8SYZqucCUtjcbN5CmdzaIP94SFTCG', 'photos/placeholder.jpg', 'Offline', '2022-12-02 23:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `canprofile`
--

CREATE TABLE `canprofile` (
  `id` int(10) NOT NULL,
  `photo` text NOT NULL,
  `prof_title` varchar(50) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `age` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` int(10) NOT NULL,
  `alt_phone` int(10) NOT NULL,
  `email` text NOT NULL,
  `p_box` varchar(20) NOT NULL,
  `study` text NOT NULL,
  `interested` text NOT NULL,
  `xp` varchar(50) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canprofile`
--

INSERT INTO `canprofile` (`id`, `photo`, `prof_title`, `fullname`, `age`, `gender`, `phone`, `alt_phone`, `email`, `p_box`, `study`, `interested`, `xp`, `token`) VALUES
(1, 'canprofile/5ef1a184a37662.84804622.jpg', 'Web Developer', 'Joe Alpha', '20 years', 'Male', 785412369, 785412369, 'mogaka@webmail.com', '785412369', 'Standard Stack', 'Web Developer', '1 year', '15ef1967a7312d'),
(2, 'canprofile/61d4ac5b4339f9.34456157.jfif', 'web developer', 'joe son', '22', 'male', 707066379, 707066379, 'json@newmail.com', '4573', 'Information Technology', 'web developer', '3 years', '161d4aae4cc069');

-- --------------------------------------------------------

--
-- Table structure for table `can_request`
--

CREATE TABLE `can_request` (
  `id` int(11) NOT NULL,
  `user_token` text NOT NULL,
  `user_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `user_id` int(10) NOT NULL,
  `user_fullname` varchar(20) NOT NULL,
  `user_company` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_phonenumber` int(10) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_location` text NOT NULL,
  `acc_verify` int(1) NOT NULL,
  `token` text NOT NULL,
  `user_pass` text NOT NULL,
  `user_profile` text NOT NULL,
  `log_in` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`user_id`, `user_fullname`, `user_company`, `user_name`, `user_phonenumber`, `user_email`, `user_location`, `acc_verify`, `token`, `user_pass`, `user_profile`, `log_in`, `date_created`) VALUES
(1, 'Misiani Joeson ', 'New Edition', 'MJJoe', 789654100, 'probook@newmail.com', 'westlands', 1, '15ef193457d20b', '$2y$10$Iw.f2/mTiK0uIUSmUjiF.eQFcCSaEx1EXz6ljbcjOC6fysZLFlrvy', 'JobSite-Profiles/5ef199576fae87.34702962.jpg', 'Offline', '2020-06-23 05:29:41'),
(2, 'Amoro Misiani', 'Feather Text', 'Virtual Hand', 707041025, 'virtualhand@gmail.com', 'Westlands', 1, '15ef19485cf29b', '$2y$10$6y0JqkMxnB9shNdkafwy3uIxeqmla4sP11Il4nfkab2JiCn9Ig2ri', 'photos/placeholder.jpg', '', '2020-06-23 05:35:01'),
(3, 'lilian', 'shalom', 'myname', 778965412, 'myname@gmail.com', 'nairobi', 0, '160f088bdbdeb6', '$2y$10$9C/hfLvbA8oxEWwpw.NA6egVCEDRAd1YEP9AjXjJSRH/CkSp0xw8K', 'photos/placeholder.jpg', '', '2021-07-15 19:13:01'),
(4, 'json kruga', 'joenest', 'json', 799066377, 'joenest@newmail.com', 'Nairobi', 1, '161d4a835001a7', '$2y$10$Iw.f2/mTiK0uIUSmUjiF.eQFcCSaEx1EXz6ljbcjOC6fysZLFlrvy', 'JobSite-Profiles/61eefc3376f5c0.72011315.jfif', 'Offline', '2022-01-04 20:04:04'),
(6, 'evans ', 'dfgd', 'evans', 789654142, 'evans@g.com', 'nairobi', 1, '162a0d7f689998', '$2y$10$7V3O0RSbC4SKQ2dYt8ghfO/DRLNfjxYzrp/qPM2BByKweGQZUhFO.', 'JobSite-Profiles/62a0d8b60e1be5.51792828.jfif', 'Offline', '2022-06-08 17:10:14'),
(7, 'json kruger', 'bead art', 'kruger', 707006333, 'beadart@newmail.com', 'Dagoretti', 1, '162d3bdbe2a4d3', '$2y$10$p6DzaO7/t7LKNd1s2iCvEO4Aq1Ylczv1oWNT6qxzN/HcD/mRJMu0m', 'photos/placeholder.jpg', 'Offline', '2022-07-17 07:43:58'),
(9, 'Mj Joe', 'Masomo Bora', 'MBIS', 741524152, 'masomobora@newmail.com', 'Dagoretti', 1, '1638a8eeb0ec92', '$2y$10$dTZAxeERKWYIShvGnZQVr.G13mnJwKh3F1.jS9WL8Q0se.Tl7LUj.', 'JobSite-Profiles/638a907951d513.45007341.jfif', 'Offline', '2022-12-02 23:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `empostjob`
--

CREATE TABLE `empostjob` (
  `id` int(10) NOT NULL,
  `photo` text NOT NULL,
  `comp_name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `phone` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `xp` varchar(50) NOT NULL,
  `ends` varchar(20) NOT NULL,
  `info` text NOT NULL,
  `requirement` text NOT NULL,
  `token` text NOT NULL,
  `reg_token` text NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empostjob`
--

INSERT INTO `empostjob` (`id`, `photo`, `comp_name`, `location`, `email`, `phone`, `title`, `type`, `xp`, `ends`, `info`, `requirement`, `token`, `reg_token`, `uploaded`) VALUES
(1, 'emprofile/5ef19edd94e3f8.55724228.jpg', 'Work Spot', 'CBD', 'probook@newmail.com', 789654123, 'Web Developer', 'Full time', '2 years of xp', '2020-09-30', 'Employment', 'Html Css Js knowledge', '7e664660bf657aa0493d00725fc03133', '15ef193457d20b', '2020-09-11 18:51:47'),
(2, 'emprofile/5ef19edd94e3f8.55724228.jpg', 'Work Spot', 'CBD', 'probook@newmail.com', 789654123, 'hghjb', 'Part time', '6 months of xp', '2020-10-14', 'Internship', 'hjbkjhmnkjm,n', 'c2897f2bb382c772934f32780517f71b', '15ef193457d20b', '2020-10-13 18:03:39'),
(3, 'emprofile/5ef19edd94e3f8.55724228.jpg', 'Work Spot', 'CBD', 'probook@newmail.com', 789654123, 'xdgb', 'Part time', '6 months of xp', '2021-07-22', 'Internship', 'sdgfc', '37194726b6698832f96ee483dbfce47e', '15ef193457d20b', '2021-07-15 19:15:18'),
(4, 'emprofile/61d4a94fd46888.67872468.png', 'joenest', 'westlands', 'joenest@newmail.com', 799066377, 'web developer', 'Part time', '2 years of xp', '2022-01-10', 'Internship', 'have the knowledge of html css js ', 'e7f69208c7b32b5114d7509703486cd0', '161d4a835001a7', '2022-01-04 20:10:18'),
(5, 'emprofile/638a8fdc02adb8.20816046.jfif', 'MasomoBora', 'Dagoretti', 'masomobora@newmail.com', 741524152, 'Web Developer', 'Full time', 'none', '2022-12-30', 'Internship', 'Knowledge of Html, Css', 'fdcc3d3ed4e8504f21a29b1a53257a75', '1638a8eeb0ec92', '2022-12-02 23:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `emprofile`
--

CREATE TABLE `emprofile` (
  `id` int(10) NOT NULL,
  `photo` text NOT NULL,
  `comp_name` varchar(50) NOT NULL,
  `started` text NOT NULL,
  `services` text NOT NULL,
  `location` varchar(50) NOT NULL,
  `p_box` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` text NOT NULL,
  `owner` varchar(20) NOT NULL,
  `qlfcation` text NOT NULL,
  `xp` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emprofile`
--

INSERT INTO `emprofile` (`id`, `photo`, `comp_name`, `started`, `services`, `location`, `p_box`, `phone`, `email`, `owner`, `qlfcation`, `xp`, `token`) VALUES
(1, 'emprofile/5ef19edd94e3f8.55724228.jpg', 'Work Spot', 'The company started in the year 2019', 'Web Design and Development', 'CBD', '789654123 ', 789654123, 'probook@newmail.com', 'Joeson Misiani', 'Standard Stack', '1 year', '15ef193457d20b'),
(2, 'emprofile/61d4a94fd46888.67872468.png', 'joenest', '2019', 'web developer', 'westlands', '4573', 799066377, 'joenest@newmail.com', 'joenest', 'certified web developer', '3 years', '161d4a835001a7'),
(3, 'emprofile/638a8fdc02adb8.20816046.jfif', 'MasomoBora', '2022', 'Student-Lecturer interaction', 'Dagoretti', '4573', 741524152, 'masomobora@newmail.com', 'Mj Joe', 'Diploma', '2 Years', '1638a8eeb0ec92');

-- --------------------------------------------------------

--
-- Table structure for table `emp_request`
--

CREATE TABLE `emp_request` (
  `id` int(10) NOT NULL,
  `user_token` text NOT NULL,
  `user_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canapplyjob`
--
ALTER TABLE `canapplyjob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `canprofile`
--
ALTER TABLE `canprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `can_request`
--
ALTER TABLE `can_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `empostjob`
--
ALTER TABLE `empostjob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emprofile`
--
ALTER TABLE `emprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_request`
--
ALTER TABLE `emp_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canapplyjob`
--
ALTER TABLE `canapplyjob`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `canprofile`
--
ALTER TABLE `canprofile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `can_request`
--
ALTER TABLE `can_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `empostjob`
--
ALTER TABLE `empostjob`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emprofile`
--
ALTER TABLE `emprofile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_request`
--
ALTER TABLE `emp_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
