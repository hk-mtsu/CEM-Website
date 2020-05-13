/*
SQL script to drop/re-build tables needed for database schema
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_name` varchar(255) NOT NULL,
  `max_attendees` int(3) NOT NULL DEFAULT '150',
  `cut_off_datetime` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `cc_email` varchar(255) NOT NULL,
  `event_fee` int(11) NOT NULL,
  `event_date` varchar(255) NOT NULL,
  `open_registration` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`event_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `SPhone` varchar(12) NOT NULL,
  `District` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AgreeToTerms` char(1) NOT NULL,
  `unregistered` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`event_name`) REFERENCES events(`event_name`),
  UNIQUE KEY `Uee` (`event_name`,`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_Id` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pass` blob NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `Participant_Type` varchar(255) NOT NULL,
  `Role` varchar(255) DEFAULT 'N/A',
  `School_District` varchar(255) DEFAULT 'N/A',
  `School_Name` varchar(255) DEFAULT 'N/A',
  `Permission_Level` varchar(255) DEFAULT 'user',
  `Member_Since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`User_Id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `certificates`;
CREATE TABLE IF NOT EXISTS `certificates` (
  `User_Id` varchar(255) NOT NULL,
  `Certificate` varchar(255) NOT NULL,
  `Date_Earned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`User_Id`) REFERENCES users(`User_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
