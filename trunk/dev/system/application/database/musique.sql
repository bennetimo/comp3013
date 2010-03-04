-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2010 at 05:22 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comp3013`
--
CREATE DATABASE `comp3013` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `comp3013`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `year`, `cost`) VALUES
(1, 'Album 1', NULL, NULL),
(2, 'Album 2', NULL, NULL),
(3, 'Album 3', NULL, NULL),
(4, 'Massive Attack - Heligoland Heligoland', 2010, 899),
(5, 'B-Day', 2006, 699);

-- --------------------------------------------------------

--
-- Table structure for table `album_track`
--

CREATE TABLE IF NOT EXISTS `album_track` (
  `albumid` int(11) NOT NULL,
  `trackid` int(11) NOT NULL,
  `play_order` int(11) NOT NULL,
  PRIMARY KEY (`albumid`,`trackid`),
  KEY `FKalbum_trac472451` (`trackid`),
  KEY `FKalbum_trac210426` (`albumid`),
  KEY `order` (`play_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album_track`
--

INSERT INTO `album_track` (`albumid`, `trackid`, `play_order`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 2, 0),
(5, 3, 0),
(5, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'Artist 1'),
(2, 'Beyoncé');

-- --------------------------------------------------------

--
-- Table structure for table `artist_track`
--

CREATE TABLE IF NOT EXISTS `artist_track` (
  `artistid` int(11) NOT NULL,
  `trackid` int(11) NOT NULL,
  `role` enum('artist','featured','composer') DEFAULT NULL,
  PRIMARY KEY (`artistid`,`trackid`),
  KEY `FKartist_tra234383` (`trackid`),
  KEY `FKartist_tra18975` (`artistid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_track`
--

INSERT INTO `artist_track` (`artistid`, `trackid`, `role`) VALUES
(2, 3, NULL),
(2, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Jazz'),
(2, 'Rock'),
(3, 'Pop'),
(4, 'Opera'),
(5, 'Reggae'),
(6, 'Punk'),
(7, 'Classical'),
(8, 'Metal'),
(9, 'Rap'),
(10, 'R n B'),
(11, 'Hip Hop');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `shared` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `playlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `playlist_track`
--

CREATE TABLE IF NOT EXISTS `playlist_track` (
  `playlistid` int(11) NOT NULL,
  `albumid` int(11) NOT NULL,
  `trackid` int(11) NOT NULL,
  `play_order` int(11) NOT NULL,
  PRIMARY KEY (`playlistid`,`albumid`,`trackid`),
  KEY `FKplaylist_t199259` (`albumid`,`trackid`),
  KEY `FKplaylist_t477004` (`playlistid`),
  KEY `play_order` (`play_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist_track`
--


-- --------------------------------------------------------

--
-- Table structure for table `playlist_user`
--

CREATE TABLE IF NOT EXISTS `playlist_user` (
  `playlistid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`playlistid`,`userid`),
  KEY `FKplaylist_u752939` (`userid`),
  KEY `FKplaylist_u55716` (`playlistid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE IF NOT EXISTS `track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `main_artistid` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `main_artistid` (`main_artistid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `name`, `cost`, `src`, `main_artistid`, `duration`) VALUES
(1, 'Track 1', NULL, NULL, 1, 0),
(2, 'Track 2', NULL, NULL, 1, 0),
(3, 'Beautiful Liar', 79, NULL, 2, 198),
(4, 'Deja Vu', 79, NULL, 2, 180);

-- --------------------------------------------------------

--
-- Table structure for table `track_genre`
--

CREATE TABLE IF NOT EXISTS `track_genre` (
  `trackid` int(11) NOT NULL,
  `genreid` int(11) NOT NULL,
  PRIMARY KEY (`trackid`,`genreid`),
  KEY `FKtrack_genr330448` (`trackid`),
  KEY `FKtrack_genr573263` (`genreid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_genre`
--

INSERT INTO `track_genre` (`trackid`, `genreid`) VALUES
(1, 2),
(1, 3),
(2, 4),
(3, 10),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `picture` blob,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `fname`, `lname`, `picture`, `joined`) VALUES
(1, 'paul_smith@smithmedia.com', 'c3687ab9880c26dfe7ab966a8a1701b5e017c2ff', 'Paul', 'Smith', NULL, '2010-03-04 13:49:59'),
(2, 'crazy_babe_55@hotmail.com', 'c269af59b8d32af462511a834387cadae8cec538', 'Rachel', 'Stevens', NULL, '2010-03-04 13:50:14'),
(3, 'susan4ever@gmail.com', '33dca1c0c1c5ae78f67580a76d9c6aba6a172e20', 'Susan', 'Boyle', NULL, '2010-03-04 13:50:20'),
(4, 'bran_adams@yahoo.com', '2d7651e0bb2c34e67a2dd296d94d7b81ef7bf459', 'Bryan', 'Adams', NULL, '2010-03-04 13:50:27'),
(5, 'b_simpson@simpson.com', '2f93be482bc3eb1c637e8e058e19dbd9ed26e095', 'Bart', 'Simpson', NULL, '2010-03-04 13:50:49'),
(6, 'bean_me@yahoo.com', '4bb8f79b42ab26b2150655b71eb0bdca103cfb17', 'Rowan', 'Atkinson', NULL, '2010-03-04 13:50:55'),
(7, 'cheryl_cole@hotmail.com', '187037e1a3220306571f7d9448b9277fe4d38f83', 'Cheryl', 'Cole', NULL, '2010-03-04 13:50:43'),
(8, 'in_the_world@clarksonisland.com', '085277134da9ca888ee60a18e1f8260dba207b82', 'Jeremy', 'Clarkson', NULL, '2010-03-04 13:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `userid` int(11) NOT NULL,
  `credit` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `FKuser_accou95263` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_track`
--

CREATE TABLE IF NOT EXISTS `user_track` (
  `userid` int(11) NOT NULL,
  `albumid` int(11) NOT NULL,
  `trackid` int(11) NOT NULL,
  `bought` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`,`albumid`,`trackid`),
  KEY `FKuser_track330483` (`albumid`,`trackid`),
  KEY `FKuser_track244082` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_track`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_verification`
--

CREATE TABLE IF NOT EXISTS `user_verification` (
  `userid` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `FKuser_verif983218` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_verification`
--


-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trackid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKvideo568773` (`trackid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `trackid`, `name`, `src`) VALUES
(1, 1, 'performance at Webley 2009', 'http://myvideo.com/v.mpg');
