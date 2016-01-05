-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2015 at 10:24 AM
-- Server version: 5.5.42-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mohit_sharefreedocs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_login_date` date NOT NULL,
  `date_register` date NOT NULL,
  `last_logout_date` date NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`, `firstname`, `lastname`, `mobile`, `email`, `last_login_date`, `date_register`, `last_logout_date`) VALUES
(1, 'mohit', 'mohit', 'mohit', 'amgaonkar', '7276671866', 'mohithamgaonkar@gmail.com', '2013-07-17', '2013-03-25', '2013-05-10'),
(2, 'rohit', 'rohit', 'rohit', 'amgaonkar', '7276671866', 'mohitjob@gmail.com', '0000-00-00', '2013-03-27', '0000-00-00'),
(3, 'praful', 'praful', 'praful', 'pusadkar', '9866718661', 'praful@gmail.com', '2013-03-29', '2013-03-27', '0000-00-00'),
(4, 'ashish', '12345', 'ashish', 'gathi', '8901231234', 'asdf@asdf.com', '0000-00-00', '2013-04-05', '0000-00-00'),
(5, 'gurdeep', '12345', 'gurdeep', 'suri', '8923423454', 'gurdeepashish@gmail.com', '2013-04-05', '2013-04-05', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(50) NOT NULL,
  `uploaderid` int(11) NOT NULL,
  `description` text NOT NULL,
  `collegename` varchar(50) NOT NULL,
  `date_of_event` date NOT NULL,
  `date_upload` date NOT NULL,
  `fullname` varchar(20) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eid`, `eventname`, `uploaderid`, `description`, `collegename`, `date_of_event`, `date_upload`, `fullname`) VALUES
(5, 'gniet rocks', 14, 'this is bunk image', 'GNIET', '2013-03-08', '2013-03-14', '5.jpg'),
(6, 'Paper Presentatoin', 15, 'this is the paper presentation ', 'RKNEC', '2013-03-29', '2013-03-14', '6.jpg'),
(7, 'normal', 1, 'normal people event', 'YCCE', '2013-04-01', '2013-03-14', '7.jpg'),
(8, 'this event is at gniet', 17, 'sldifhouxcb', 'GNIET', '2013-03-26', '2013-03-16', '8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `group_upload`
--

CREATE TABLE IF NOT EXISTS `group_upload` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `create_id` int(11) NOT NULL COMMENT 'group creater id',
  `group_name` varchar(90) DEFAULT NULL,
  `group_member` varchar(255) DEFAULT NULL,
  `document_id` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `group_upload`
--

INSERT INTO `group_upload` (`gid`, `create_id`, `group_name`, `group_member`, `document_id`, `date_created`) VALUES
(1, 1, 'mahol group', '15 22 17 16 ', NULL, '2013-03-31'),
(2, 1, 'mahol', '15 22 17 16 ', '22 23', '2013-03-31'),
(3, 22, 'asdf', '1 ', '24', '2013-04-01'),
(4, 1, 'Ashish rocks', '14 22 16 23 ', NULL, '2013-04-03'),
(5, 1, 'group 1', '15 14 22 17 16 23 26 ', NULL, '2013-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'register id',
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL DEFAULT 'male',
  `dateofbirth` date NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL DEFAULT 'India',
  `collegename` varchar(40) NOT NULL,
  `last_log_date` date NOT NULL,
  `confirm` int(1) NOT NULL DEFAULT '0',
  `profession` varchar(20) NOT NULL,
  `date_register` date NOT NULL,
  `pic` varchar(30) NOT NULL,
  `branch` varchar(50) NOT NULL DEFAULT 'not specified',
  `interest` varchar(60) NOT NULL,
  `group_add_id` varchar(255) NOT NULL,
  `group_id` text NOT NULL COMMENT 'link between group and users',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`rid`, `username`, `password`, `firstname`, `lastname`, `sex`, `dateofbirth`, `mobile`, `email`, `address`, `city`, `state`, `country`, `collegename`, `last_log_date`, `confirm`, `profession`, `date_register`, `pic`, `branch`, `interest`, `group_add_id`, `group_id`) VALUES
(1, 'mohit', 'mohit', 'mohit', 'amgaonkar', 'male', '1991-06-21', '7276671866', 'mohitjob1@gmail.com', 'jawahar nagar \r\nmanewada road', 'Nagpur', 'Maharashtra', 'India', 'VNIET', '2013-08-16', 1, 'student', '0000-00-00', '1.jpg', 'Computer Science', 'Web Development', '', '2 345'),
(14, 'vijayshahu', 'rashmi', 'vijay', 'shahu', 'male', '2013-03-07', '9404365989', 'vjshahu@gmail.com', 'near RKNEC', 'Nagpur', 'Maharashtra', 'India', 'VNIET', '2013-04-05', 1, 'student', '2013-03-09', '14.jpg', 'not specified', '', '', '045'),
(15, 'richa', '12345', 'richa', 'jham', 'female', '0000-00-00', '8976676211', 'jham@gmail.com', 'whereever mohit', 'nagpur', 'maharshatra', 'India', 'VNIET', '2013-04-01', 1, 'student', '2013-03-10', 'female.jpg', 'not specified', '', '', '25'),
(16, 'gathi', '12345', 'ashish', 'gathi', 'male', '1987-03-04', '9866718661', 'gathi@gmail.com', '', '', '', 'India', 'GNIET', '2013-03-30', 1, 'student', '2013-03-14', 'male.jpg', 'not specified', '', '', '245'),
(17, 'manoj', 'manoj', 'manoj', 'v', 'male', '0000-00-00', '7887781988', 'manok@gmail.com', '', 'nagur', 'maharshatra', 'India', 'VNIET', '2013-03-30', 1, 'teacher', '2013-03-16', 'male.jpg', 'not specified', '', '', '25'),
(22, 'praful', 'praful', 'praful', 'pusadkar', 'male', '2013-03-06', '9404365989', 'asdf@asdf.com', '', '', '', 'India', 'VNIET', '2013-04-06', 1, 'teacher', '2013-03-17', 'male.jpg', 'not specified', '', '', '2 345'),
(23, 'pranay', 'pranay', 'pranay', 'khogra', 'male', '2013-04-24', '9404365986', 'pranay@gmail.com', '', '', '', 'India', 'VNIET', '2013-04-01', 1, 'student', '2013-04-01', 'male.jpg', 'not specified', '', '', '045'),
(26, 'mohit1', 'mohit', 'mohit', 'amgaonkar', 'male', '2013-04-24', '9404365989', 'mohithamgaonkar@gmail.com', '', '', '', 'India', 'VNIET', '2013-05-10', 1, 'student', '2013-04-02', 'male.jpg', 'not specified', '', '', '5'),
(27, 'shobu', '12345', 'shoaib', 'sheikh', 'male', '1990-09-17', '8446031039', 'sheikhshoaib718@gmail.com', '', 'Nagpur', 'MH', 'India', 'GNIET', '2013-06-05', 1, 'student', '2013-06-05', 'male.jpg', 'not specified', '', '', ''),
(28, 'shobu1', '00000', 'shoaib', 'sk', 'male', '2013-12-31', '8446031007', 'sheikhshoaib@ymail.com', '', '', '', 'India', 'VNIET', '0000-00-00', 0, 'student', '2013-06-05', 'male.jpg', 'not specified', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `status1`
--

CREATE TABLE IF NOT EXISTS `status1` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(11) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) NOT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `status1`
--

INSERT INTO `status1` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(1, 15, NULL, 1, 0),
(5, 14, NULL, 1, 0),
(6, 22, NULL, 1, 0),
(7, 17, NULL, 1, 0),
(8, 16, NULL, 1, 0),
(9, 23, NULL, 1, 0),
(10, 26, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status14`
--

CREATE TABLE IF NOT EXISTS `status14` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(11) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) NOT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `status14`
--

INSERT INTO `status14` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(4, 15, NULL, 0, 0),
(7, 1, NULL, 1, 0),
(8, 16, NULL, 0, 0),
(9, 17, NULL, 0, 0),
(10, 22, NULL, 1, 0),
(11, 23, NULL, 0, 1),
(12, 26, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status15`
--

CREATE TABLE IF NOT EXISTS `status15` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(11) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) NOT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status15`
--

INSERT INTO `status15` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(1, 14, NULL, 0, 1),
(2, 1, NULL, 1, 0),
(3, 23, NULL, 0, 1),
(4, 26, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status16`
--

CREATE TABLE IF NOT EXISTS `status16` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(11) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) NOT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status16`
--

INSERT INTO `status16` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(1, 14, NULL, 0, 1),
(2, 1, NULL, 1, 0),
(3, 23, NULL, 0, 1),
(4, 22, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status17`
--

CREATE TABLE IF NOT EXISTS `status17` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(11) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) NOT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status17`
--

INSERT INTO `status17` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(1, 14, NULL, 0, 1),
(2, 1, NULL, 1, 0),
(3, 23, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status22`
--

CREATE TABLE IF NOT EXISTS `status22` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(11) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) NOT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status22`
--

INSERT INTO `status22` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(1, 14, NULL, 1, 0),
(2, 1, NULL, 1, 0),
(3, 23, NULL, 1, 0),
(4, 16, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status23`
--

CREATE TABLE IF NOT EXISTS `status23` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(1) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `status23`
--

INSERT INTO `status23` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(1, 22, NULL, 1, 0),
(2, 1, NULL, 1, 0),
(3, 14, NULL, 0, NULL),
(4, 16, NULL, 0, NULL),
(5, 15, NULL, 0, NULL),
(6, 17, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status24`
--

CREATE TABLE IF NOT EXISTS `status24` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(1) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status25`
--

CREATE TABLE IF NOT EXISTS `status25` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(1) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status26`
--

CREATE TABLE IF NOT EXISTS `status26` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(1) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status26`
--

INSERT INTO `status26` (`zid`, `friendid`, `blockid`, `confirm`, `notification`) VALUES
(1, 1, NULL, 1, 0),
(2, 14, NULL, 0, NULL),
(3, 15, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status27`
--

CREATE TABLE IF NOT EXISTS `status27` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(1) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status28`
--

CREATE TABLE IF NOT EXISTS `status28` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `friendid` int(11) DEFAULT NULL,
  `blockid` int(1) DEFAULT NULL,
  `confirm` int(1) DEFAULT NULL,
  `notification` int(1) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `uploaderid` int(11) NOT NULL,
  `uploaded` date NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `profession` varchar(15) NOT NULL,
  `approved` int(2) NOT NULL DEFAULT '0' COMMENT '0 when newly uploaded 1 when approved and 2 when denialed',
  `group_restricted` int(1) NOT NULL DEFAULT '0' COMMENT '0 for no and 1 for yes',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`uid`, `filename`, `description`, `uploaderid`, `uploaded`, `fullname`, `profession`, `approved`, `group_restricted`) VALUES
(9, 'this is the notes', 'please read it and clear the exam...!!!', 14, '2013-03-14', '9.pdf', 'student', 2, 0),
(10, 'CNI Notes', 'read it properly', 15, '2013-03-14', '10.pdf', 'student', 2, 0),
(11, 'gate Scoring', 'gate exam guide', 1, '2013-03-14', '11.pdf', 'student', 1, 0),
(12, 'WLAN', 'sdfi', 16, '2013-03-14', '12.ppt', 'student', 1, 0),
(13, 'iPod Manual', 'this is i pod manual', 17, '2013-03-16', '13.pdf', 'teacher', 1, 0),
(14, 'WAN', 'WAN notes', 1, '2013-03-17', '14.ppt', 'student', 1, 0),
(15, 'Important notes', 'really imp notes', 15, '2013-03-17', '15.pdf', 'student', 2, 0),
(16, 'Admit card', 'this is a admit card', 15, '2013-03-17', '16.pdf', 'student', 1, 0),
(17, 'Notification', 'this is notification', 17, '2013-03-17', '17.pdf', 'teacher', 1, 0),
(18, 'Guide to prepare for gate', 'please read', 22, '2013-03-17', '18.pdf', 'teacher', 1, 0),
(19, 'POT seminar', 'seminar for POT', 22, '2013-03-17', '19.ppt', 'teacher', 1, 0),
(20, 'tender notice ', 'this is tender notice', 16, '2013-03-17', '20.pdf', 'student', 1, 0),
(22, 'sdhf', 'cvnxcvn', 1, '2013-04-01', '22.pdf', 'student', 1, 1),
(23, 'asdgasg', 'xzcvzxcv', 1, '2013-04-01', '23.pdf', 'student', 1, 1),
(24, 'asdfa', 'xcvzc', 22, '2013-04-01', '24.ppt', 'teacher', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
