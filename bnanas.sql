-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2015 at 05:41 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bnanas`
--

-- --------------------------------------------------------

--
-- Table structure for table `day_user_location`
--

CREATE TABLE IF NOT EXISTS `day_user_location` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Location_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `TimeStart` time NOT NULL,
  `TimeStop` time NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Day_User_Location_User_Location` (`User_Location_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `day_user_location`
--

INSERT INTO `day_user_location` (`Id`, `User_Location_Id`, `Date`, `TimeStart`, `TimeStop`) VALUES
(1, 1, '2015-09-26', '09:00:00', '19:00:00'),
(2, 2, '2015-09-26', '09:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `day_user_location_visibility`
--

CREATE TABLE IF NOT EXISTS `day_user_location_visibility` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Day_User_Location_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Day_User_Location_Visibility_Day_User_Location` (`Day_User_Location_Id`),
  KEY `Day_User_Location_Visibility_User` (`User_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `day_user_location_visibility`
--

INSERT INTO `day_user_location_visibility` (`Id`, `Day_User_Location_Id`, `User_Id`) VALUES
(1, 1, 2),
(4, 2, 2),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Location_Id` int(11) NOT NULL,
  `Name` varchar(127) COLLATE latin1_general_ci NOT NULL,
  `Description` text COLLATE latin1_general_ci NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`),
  KEY `Event_Location` (`Location_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_datetime`
--

CREATE TABLE IF NOT EXISTS `event_datetime` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Event_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Status_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Event_DateTime_Event` (`Event_Id`),
  KEY `Event_DateTime_Status` (`Status_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_visibility`
--

CREATE TABLE IF NOT EXISTS `event_visibility` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Event_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Event_Visibility_Event` (`Event_Id`),
  KEY `Event_Visibility_User` (`User_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Friend` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Friends_User` (`Friend`),
  KEY `Friends_User_Friend` (`User_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`Id`, `User_Id`, `Friend`) VALUES
(1, 2, 3),
(2, 2, 4),
(3, 4, 2),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(127) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE IF NOT EXISTS `group_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Group_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Group_User_Group` (`Group_Id`),
  KEY `Group_User_Role` (`Role_Id`),
  KEY `Group_User_User` (`User_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Lat` varchar(127) COLLATE latin1_general_ci NOT NULL,
  `Long` varchar(127) COLLATE latin1_general_ci NOT NULL,
  `Name` varchar(127) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Id`, `Lat`, `Long`, `Name`) VALUES
(1, '38.5717788', '-7.9069862', 'Évora'),
(2, '48.8666667', '2.3333333', 'Paris');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Message` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Message_User` (`User_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messageto`
--

CREATE TABLE IF NOT EXISTS `messageto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Message_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Status_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `MesageTo_Message` (`Message_Id`),
  KEY `MesageTo_User` (`User_Id`),
  KEY `Status_Id` (`Status_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(127) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(127) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(127) COLLATE latin1_general_ci NOT NULL,
  `FirstName` varchar(127) COLLATE latin1_general_ci NOT NULL,
  `LastName` varchar(127) COLLATE latin1_general_ci NOT NULL,
  `BirthDate` date DEFAULT NULL,
  `Picture` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Username`, `FirstName`, `LastName`, `BirthDate`, `Picture`) VALUES
(3, 'user.2', 'user2', 'x2', '2015-09-24', NULL),
(2, 'jeremix', 'Jeremie', 'Seabra', '1986-12-16', NULL),
(4, 'user.3', 'user3', 'x3', '2015-09-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_event`
--

CREATE TABLE IF NOT EXISTS `user_event` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL,
  `Status_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_Event_Role` (`Role_Id`),
  KEY `User_Event_Status` (`Status_Id`),
  KEY `User_Event_User` (`User_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE IF NOT EXISTS `user_location` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Location_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Name` varchar(127) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `User_Location_Location` (`Location_Id`),
  KEY `User_Location_User` (`User_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_location`
--

INSERT INTO `user_location` (`Id`, `Location_Id`, `User_Id`, `Name`) VALUES
(1, 1, 2, 'Casa'),
(2, 2, 4, 'Tour Eiffel');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
