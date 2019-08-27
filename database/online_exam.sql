-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2019 at 05:39 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(5) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `Username`, `Password`) VALUES
(1, 'administrator', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `exam_name`
--

CREATE TABLE IF NOT EXISTS `exam_name` (
  `id` int(5) NOT NULL,
  `Exam_name` varchar(200) DEFAULT NULL,
  `Exam_desc` text,
  `Exam_start_time` datetime DEFAULT NULL,
  `Exam_end_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_name`
--

INSERT INTO `exam_name` (`id`, `Exam_name`, `Exam_desc`, `Exam_start_time`, `Exam_end_time`) VALUES
(1, 'Groups', '<br>', '2019-04-04 20:29:47', '2019-04-04 20:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `exam_ques_set`
--

CREATE TABLE IF NOT EXISTS `exam_ques_set` (
  `id` int(10) NOT NULL,
  `Sub_code` int(5) DEFAULT NULL,
  `Ques_no` int(10) DEFAULT NULL,
  `Question` text,
  `Ques_crct_option` varchar(5) DEFAULT NULL,
  `Ques_mark` float(5,2) DEFAULT NULL,
  `Ques_neg_mark` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_ques_set`
--

INSERT INTO `exam_ques_set` (`id`, `Sub_code`, `Ques_no`, `Question`, `Ques_crct_option`, `Ques_mark`, `Ques_neg_mark`) VALUES
(1, 1, 1, '1AP.png', 'A', 1.00, 0.00),
(2, 1, 2, '2AP.png', 'B', 1.00, 0.00),
(3, 1, 3, '3AP.png', 'C', 1.00, 0.00),
(4, 1, 4, '1AP.png', 'A', 1.00, 0.00),
(5, 1, 5, '2AP.png', 'A', 1.00, 0.00),
(6, 1, 6, '3AP.png', 'A', 1.00, 0.00),
(7, 1, 7, '1AP.png', 'A', 1.00, 0.00),
(8, 1, 8, '1AP.png', 'A', 1.00, 0.00),
(9, 1, 9, '1AP.png', 'A', 1.00, 0.00),
(10, 1, 10, '1AP.png', 'A', 1.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `exam_subjects`
--

CREATE TABLE IF NOT EXISTS `exam_subjects` (
  `Sub_code` int(5) NOT NULL,
  `Sub_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Sub_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_subjects`
--

INSERT INTO `exam_subjects` (`Sub_code`, `Sub_name`) VALUES
(1, 'Maths');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `Regd_id` varchar(50) NOT NULL DEFAULT '',
  `Name` varchar(200) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Regd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Regd_id`, `Name`, `Password`) VALUES
('1234', 'RAMAKRISHNA SIR', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `student_mark`
--

CREATE TABLE IF NOT EXISTS `student_mark` (
  `id` int(10) NOT NULL,
  `Cand_regd_id` varchar(50) DEFAULT NULL,
  `Mark_ob` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_mark`
--

INSERT INTO `student_mark` (`id`, `Cand_regd_id`, `Mark_ob`) VALUES
(1, '1234', 6.00),
(2, '1234', 6.00),
(3, '1234', 6.00);

-- --------------------------------------------------------

--
-- Table structure for table `student_response`
--

CREATE TABLE IF NOT EXISTS `student_response` (
  `id` int(10) NOT NULL,
  `Cand_regd_id` varchar(50) DEFAULT NULL,
  `Ques_no` int(10) DEFAULT NULL,
  `Resp_choice` varchar(5) DEFAULT NULL,
  `Mark_review` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_response`
--

INSERT INTO `student_response` (`id`, `Cand_regd_id`, `Ques_no`, `Resp_choice`, `Mark_review`) VALUES
(1, '1234', 1, 'B', 'N'),
(2, '1234', 2, 'A', 'N'),
(3, '1234', 3, 'A', 'N'),
(4, '1234', 4, 'C', 'N'),
(5, '1234', 5, 'A', 'N'),
(6, '1234', 6, 'A', 'N'),
(7, '1234', 7, 'A', 'N'),
(8, '1234', 8, 'A', 'N'),
(10, '1234', 10, 'A', 'N'),
(11, '1234', 9, 'A', 'N');
