-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2015 at 01:49 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `learning`
--
CREATE DATABASE `learning` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `learning`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(1) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`, `email`) VALUES
(1, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@distant.com');

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE IF NOT EXISTS `assessment` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `lecturer_id` varchar(5) NOT NULL,
  `quiz` text NOT NULL,
  `question1` text NOT NULL,
  `question2` text NOT NULL,
  `question3` text NOT NULL,
  `quiz_taken` varchar(3) NOT NULL,
  `exam_taken` varchar(3) NOT NULL,
  `quiz_answer` text NOT NULL,
  `exam_answer` text NOT NULL,
  `quiz_score` varchar(3) NOT NULL,
  `exam_score` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`id`, `lecturer_id`, `quiz`, `question1`, `question2`, `question3`, `quiz_taken`, `exam_taken`, `quiz_answer`, `exam_answer`, `quiz_score`, `exam_score`) VALUES
(1, 'Le04', 'What is CPU in algorithim', 'Not Set', 'Not Set', 'Not Set', 'Yes', 'No', 'Blah blah blah blah blah blahv', '', '0', '0'),
(2, 'Le03', 'find x when 2x + 4 =10', '4r + 7 = 23 what is r?', '3/4  +  1/3 = y What is y', 'What is circumference of a circle ', 'Yes', 'Yes', '2x = 10-4\r\n2x = 6\r\nx = 3', 'jblzf kblda kba  kba kba f', '28', '50'),
(5, 'Le01', 'What is Programming', 'Not Set', 'Not Set', 'Not Set', 'No', 'No', '', '', '0', '0'),
(6, 'Le05', 'What is a cell', 'Not Set', 'Not Set', 'Not Set', 'No', 'No', '', '', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_code` varchar(6) NOT NULL,
  `lecturer_id` varchar(100) NOT NULL,
  `Course_title` varchar(70) NOT NULL,
  PRIMARY KEY (`course_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `lecturer_id`, `Course_title`) VALUES
('DL101', 'Le02', 'Princinple of management'),
('DL102', 'Le01', 'Introduction to computer '),
('DL103', 'Le03', 'General Mathematics'),
('DL104', 'Le04', 'Programing in java'),
('DL105', '', 'Home management'),
('DL106', 'Le05', 'General Biology');

-- --------------------------------------------------------

--
-- Table structure for table `course_register`
--

CREATE TABLE IF NOT EXISTS `course_register` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(8) NOT NULL,
  `student_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `course_register`
--

INSERT INTO `course_register` (`id`, `course_id`, `student_id`) VALUES
(2, 'DL102', 3),
(3, 'DL104', 3),
(4, 'DL101', 3),
(5, 'DL103', 3),
(6, 'DL106', 3),
(7, 'DL101', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE IF NOT EXISTS `lecture` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `lecture_name` varchar(100) NOT NULL,
  `lecturer_id` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `lecture_name`, `lecturer_id`) VALUES
(2, 'lifeelastic.pptx', 'Le02'),
(3, 'Presentation1.pptx', 'Le04'),
(4, 'computer.pptx', 'Le01'),
(5, 'note.pptx', 'Le05');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `lecturer_id` varchar(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `country` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`lecturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturer_id`, `name`, `country`, `email`, `password`) VALUES
('Le01', 'Oladele Femi', 'Ghana', 'femi@distant.com', '48b4a13709511e0c079bfb9d90441510f51b097e'),
('Le02', 'Micheal lawson', 'Nigeria', 'lawson@distance.com', '7349bf9866fb7b167a2e132224aa1eae90fc8e64'),
('Le03', 'Eniola Ajala', 'Nigeria', 'ajala@distant.com', 'c2ace628f5ad1f0b2e9a62f6ce3556a46d21c72b'),
('Le04', 'dele olu', 'south africa', 'olu@distant.com', 'f29c8a691edcf3ceeaab4811eb47264468d9246d'),
('Le05', 'Adebiyi david ', 'gabon', 'david@distant.com', 'aa743a0aaec8f7d7a1f01442503957f4d7a2d634');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `names` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `country` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `names`, `address`, `country`, `email`, `phone`, `password`, `date`) VALUES
(3, 'Oladipupo Bode', 'No 14 Ariyo Ipoti Ekiti', 'Nigeria', 'rewaju25@yahoo.com', '08095643213', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Monday 19th of January 2015 '),
(4, 'david samuel', '2 akinde street mushin', 'UK', 'samueldavido@yahoo.com', '090908098998', '33e49263a05a4fda0bfc3ba0906e41fa30c868c5', 'Tuesday 20th of January 2015 ');
