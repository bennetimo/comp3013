-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2010 at 12:48 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comp3013`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `year`, `cost`) VALUES
(1, 'Keeps Gettin'' Better', NULL, NULL),
(2, 'Stripped', NULL, NULL),
(3, 'Takin'' Off', NULL, NULL),
(4, 'Maiden Voyage', NULL, NULL),
(5, 'Thrust', NULL, NULL),
(6, 'Head Hunters', NULL, NULL),
(7, 'Gnu High', NULL, NULL),
(8, 'Goldberg Variations (feat. harpsichord: Keith Jarrett)', NULL, NULL),
(9, 'Art of the Trio, Volume 4: Back at the Vanguard', NULL, NULL),
(10, 'The Art of the Trio, Volume 3: Songs', NULL, NULL),
(11, 'Elegiac Cycle', NULL, NULL),
(12, 'Live in Tokyo', NULL, NULL),
(13, 'Rolling Stones Classic', NULL, NULL),
(14, 'Out of Our Heads', NULL, NULL),
(15, 'Pearl Jam', NULL, NULL),
(16, 'Made in England', NULL, NULL),
(17, 'Jamaican in New York', NULL, NULL);

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
(1, 1, 1),
(1, 2, 2),
(2, 3, 1),
(2, 4, 2),
(2, 5, 3),
(2, 6, 4),
(2, 7, 5),
(2, 8, 6),
(2, 9, 7),
(2, 10, 8),
(2, 11, 9),
(2, 12, 10),
(2, 13, 11),
(2, 14, 12),
(2, 15, 13),
(2, 16, 14),
(2, 17, 15),
(2, 18, 16),
(2, 19, 17),
(2, 20, 18),
(2, 21, 19),
(2, 22, 20),
(3, 23, 1),
(3, 24, 2),
(3, 25, 3),
(3, 26, 4),
(3, 27, 5),
(3, 28, 6),
(4, 29, 1),
(4, 30, 2),
(4, 31, 3),
(4, 32, 4),
(4, 33, 5),
(5, 34, 1),
(5, 35, 2),
(5, 36, 3),
(5, 37, 4),
(6, 38, 1),
(6, 39, 2),
(6, 40, 3),
(6, 41, 4),
(7, 42, 1),
(7, 43, 2),
(7, 44, 3),
(8, 45, 1),
(8, 46, 2),
(8, 47, 3),
(8, 48, 4),
(8, 49, 5),
(8, 50, 6),
(8, 51, 7),
(8, 52, 8),
(8, 53, 9),
(8, 54, 10),
(8, 55, 11),
(8, 56, 12),
(8, 57, 13),
(8, 58, 14),
(8, 59, 15),
(8, 60, 16),
(8, 61, 17),
(8, 62, 18),
(8, 63, 19),
(8, 64, 20),
(8, 65, 21),
(8, 66, 22),
(8, 67, 23),
(8, 68, 24),
(8, 69, 25),
(8, 70, 26),
(8, 71, 27),
(8, 72, 28),
(8, 73, 29),
(8, 74, 30),
(8, 75, 31),
(8, 76, 32),
(9, 77, 1),
(9, 78, 2),
(9, 79, 3),
(9, 80, 4),
(9, 81, 5),
(9, 82, 6),
(9, 83, 7),
(10, 84, 1),
(10, 85, 2),
(10, 86, 3),
(10, 87, 4),
(10, 88, 5),
(10, 89, 6),
(10, 90, 7),
(10, 91, 8),
(10, 92, 9),
(10, 93, 10),
(11, 94, 1),
(11, 95, 2),
(11, 96, 3),
(11, 97, 4),
(11, 98, 5),
(11, 99, 6),
(11, 100, 7),
(11, 101, 8),
(11, 102, 9),
(12, 103, 1),
(12, 104, 2),
(12, 105, 3),
(12, 106, 4),
(12, 107, 5),
(12, 108, 6),
(12, 109, 7),
(12, 110, 8),
(13, 111, 1),
(13, 112, 2),
(13, 113, 3),
(13, 114, 4),
(13, 115, 5),
(13, 116, 6),
(13, 117, 7),
(13, 118, 8),
(13, 119, 9),
(13, 120, 10),
(13, 121, 11),
(13, 122, 12),
(13, 123, 13),
(14, 124, 1),
(14, 125, 2),
(14, 126, 3),
(14, 127, 4),
(14, 128, 5),
(14, 129, 6),
(14, 130, 7),
(14, 131, 8),
(14, 132, 9),
(14, 133, 10),
(14, 134, 11),
(14, 135, 12),
(15, 136, 1),
(15, 137, 2),
(15, 138, 3),
(15, 139, 4),
(15, 140, 5),
(15, 141, 6),
(15, 142, 7),
(15, 143, 8),
(15, 144, 9),
(15, 145, 10),
(15, 146, 11),
(15, 147, 12),
(15, 148, 13),
(16, 149, 1),
(16, 150, 2),
(16, 151, 3),
(16, 152, 4),
(16, 153, 5),
(16, 154, 6),
(16, 155, 7),
(16, 156, 8),
(16, 157, 9),
(16, 158, 10),
(16, 159, 11),
(17, 160, 1),
(17, 161, 2),
(17, 162, 3),
(17, 163, 4),
(17, 164, 5);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'Christina Aguilera'),
(2, 'Herbie Hancock'),
(3, 'Kenny Wheeler'),
(4, 'Johann Sebastian Bach'),
(5, 'Brad Mehldau Trio'),
(6, 'Brad Mehldau'),
(7, 'Ã¼nchner Philharmoniker'),
(8, 'The Rolling Stones'),
(9, 'Pearl Jam'),
(10, 'Elton John'),
(11, 'Shinehead');

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
(10, 'R''n''B'),
(11, 'Hip Hop');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE IF NOT EXISTS `track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `main_artistid` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `main_artistid` (`main_artistid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `name`, `cost`, `src`, `main_artistid`, `duration`) VALUES
(1, 'Keeps Gettin'' Better', NULL, NULL, 1, 321),
(2, 'Keeps Gettin'' Better (instrumental)', NULL, NULL, 1, 321),
(3, 'Stripped (intro)', NULL, NULL, 1, 321),
(4, 'Can''t Hold Us Down (feat. Lil'' Kim)', NULL, NULL, 1, 321),
(5, 'Walk Away', NULL, NULL, 1, 321),
(6, 'Fighter', NULL, NULL, 1, 321),
(7, 'Primer Amor (interlude)', NULL, NULL, 1, 321),
(8, 'Infatuation', NULL, NULL, 1, 321),
(9, 'Loves Embrace (interlude)', NULL, 'C:/Users/David/Workspace/aptana/3013project/system/application/mp3/track.mp3', 1, 321),
(10, 'Loving Me 4 Me', NULL, NULL, 1, 321),
(11, 'Impossible (feat. Alicia Keys)', NULL, NULL, 1, 321),
(12, 'Underappreciated', NULL, NULL, 1, 321),
(13, 'Beautiful', NULL, NULL, 1, 321),
(14, 'Make Over', NULL, NULL, 1, 321),
(15, 'Cruz', NULL, NULL, 1, 321),
(16, 'Soar', NULL, NULL, 1, 321),
(17, 'Get Mine, Get Yours', NULL, NULL, 1, 321),
(18, 'Dirrty (feat. Redman)', NULL, NULL, 1, 321),
(19, 'Stripped, Part 2', NULL, NULL, 1, 321),
(20, 'The Voice Within', NULL, NULL, 1, 321),
(21, 'I''m OK', NULL, NULL, 1, 321),
(22, 'Keep On Singin'' My Song', NULL, NULL, 1, 321),
(23, 'Watermelon Man', NULL, NULL, 2, 321),
(24, 'Three Bags Full', NULL, NULL, 2, 321),
(25, 'Empty Pockets', NULL, NULL, 2, 321),
(26, 'The Maze', NULL, NULL, 2, 321),
(27, 'Driftin''', NULL, NULL, 2, 321),
(28, 'Alone and I', NULL, NULL, 2, 321),
(29, 'Maiden Voyage', NULL, NULL, 2, 321),
(30, 'The Eye of the Hurricane', NULL, NULL, 2, 321),
(31, 'Little One', NULL, NULL, 2, 321),
(32, 'Survival of the Fittest', NULL, NULL, 2, 321),
(33, 'Dolphin Dance', NULL, NULL, 2, 321),
(34, 'Palm Grease', NULL, NULL, 2, 321),
(35, 'Actual Proof', NULL, NULL, 2, 321),
(36, 'Butterfly', NULL, NULL, 2, 321),
(37, 'Spank-a-Lee', NULL, NULL, 2, 321),
(38, 'Chameleon', NULL, NULL, 2, 321),
(39, 'Watermelon Man', NULL, NULL, 2, 321),
(40, 'Sly', NULL, NULL, 2, 321),
(41, 'Vein Melter', NULL, NULL, 2, 321),
(42, 'Heyoke', NULL, NULL, 3, 321),
(43, 'Smatter', NULL, NULL, 3, 321),
(44, 'Gnu Suite', NULL, NULL, 3, 321),
(45, 'Goldberg Variations in G major, BWV 988: I. Aria', NULL, NULL, 4, 321),
(46, 'Goldberg Variations in G major, BWV 988: II. Variatio 1', NULL, NULL, 4, 321),
(47, 'Goldberg Variations in G major, BWV 988: III. Variatio 2', NULL, NULL, 4, 321),
(48, 'Goldberg Variations in G major, BWV 988: IV. Variatio 3', NULL, NULL, 4, 321),
(49, 'Goldberg Variations in G major, BWV 988: V. Variatio 4', NULL, NULL, 4, 321),
(50, 'Goldberg Variations in G major, BWV 988: VI. Variatio 5', NULL, NULL, 4, 321),
(51, 'Goldberg Variations in G major, BWV 988: VII. Variatio 6', NULL, NULL, 4, 321),
(52, 'Goldberg Variations in G major, BWV 988: VIII. Variatio 7', NULL, NULL, 4, 321),
(53, 'Goldberg Variations in G major, BWV 988: IX. Variatio 8', NULL, NULL, 4, 321),
(54, 'Goldberg Variations in G major, BWV 988: X. Variatio 9', NULL, NULL, 4, 321),
(55, 'Goldberg Variations in G major, BWV 988: XI. Variatio 10', NULL, NULL, 4, 321),
(56, 'Goldberg Variations in G major, BWV 988: XII. Variatio 11', NULL, NULL, 4, 321),
(57, 'Goldberg Variations in G major, BWV 988: XIII. Variatio 12', NULL, NULL, 4, 321),
(58, 'Goldberg Variations in G major, BWV 988: XIV. Variatio 13', NULL, NULL, 4, 321),
(59, 'Goldberg Variations in G major, BWV 988: XV. Variatio 14', NULL, NULL, 4, 321),
(60, 'Goldberg Variations in G major, BWV 988: XVI. Variatio 15', NULL, NULL, 4, 321),
(61, 'Goldberg Variations in G major, BWV 988: XVII. Variatio 16', NULL, NULL, 4, 321),
(62, 'Goldberg Variations in G major, BWV 988: XVIII. Variatio 17', NULL, NULL, 4, 321),
(63, 'Goldberg Variations in G major, BWV 988: XIX. Variatio 18', NULL, NULL, 4, 321),
(64, 'Goldberg Variations in G major, BWV 988: XX. Variatio 19', NULL, NULL, 4, 321),
(65, 'Goldberg Variations in G major, BWV 988: XXI. Variatio 20', NULL, NULL, 4, 321),
(66, 'Goldberg Variations in G major, BWV 988: XXII. Variatio 21', NULL, NULL, 4, 321),
(67, 'Goldberg Variations in G major, BWV 988: XXIII. Variatio 22', NULL, NULL, 4, 321),
(68, 'Goldberg Variations in G major, BWV 988: XXIV. Variatio 23', NULL, NULL, 4, 321),
(69, 'Goldberg Variations in G major, BWV 988: XXV. Variatio 24', NULL, NULL, 4, 321),
(70, 'Goldberg Variations in G major, BWV 988: XXVI. Variatio 25', NULL, NULL, 4, 321),
(71, 'Goldberg Variations in G major, BWV 988: XXVII. Variatio 26', NULL, NULL, 4, 321),
(72, 'Goldberg Variations in G major, BWV 988: XXVIII. Variatio 27', NULL, NULL, 4, 321),
(73, 'Goldberg Variations in G major, BWV 988: XXIX. Variatio 28', NULL, NULL, 4, 321),
(74, 'Goldberg Variations in G major, BWV 988: XXX. Variatio 29', NULL, NULL, 4, 321),
(75, 'Goldberg Variations in G major, BWV 988: XXXI. Variatio 30', NULL, NULL, 4, 321),
(76, 'Goldberg Variations in G major, BWV 988: XXXII. Aria', NULL, NULL, 4, 321),
(77, 'All the Things You Are', NULL, NULL, 5, 321),
(78, 'Sehnsucht', NULL, NULL, 5, 321),
(79, 'Nice Pass', NULL, NULL, 5, 321),
(80, 'Solar', NULL, NULL, 5, 321),
(81, 'London Blues', NULL, NULL, 5, 321),
(82, 'I''ll Be Seeing You', NULL, NULL, 5, 321),
(83, 'Exit Music (For a Film)', NULL, NULL, 5, 321),
(84, 'Song-Song', NULL, NULL, 5, 321),
(85, 'Unrequited', NULL, NULL, 5, 321),
(86, 'Bewitched, Bothered and Bewildered', NULL, NULL, 5, 321),
(87, 'Exit Music (for a Film)', NULL, NULL, 5, 321),
(88, 'At a Loss', NULL, NULL, 5, 321),
(89, 'Convalescent', NULL, NULL, 5, 321),
(90, 'For All We Know', NULL, NULL, 5, 321),
(91, 'River Man', NULL, NULL, 5, 321),
(92, 'Young at Heart', NULL, NULL, 5, 321),
(93, 'Sehnsucht', NULL, NULL, 5, 321),
(94, 'Bard', NULL, NULL, 6, 321),
(95, 'Resignation', NULL, NULL, 6, 321),
(96, 'Memory''s Tricks', NULL, NULL, 6, 321),
(97, 'Elegy for William Burroughs and Allen Ginsberg', NULL, NULL, 6, 321),
(98, 'Lament for Linus', NULL, NULL, 6, 321),
(99, 'Trailer Park Ghost', NULL, NULL, 6, 321),
(100, 'Goodbye Storyteller (for Fred Myrow)', NULL, NULL, 6, 321),
(101, 'Ã¼ckblick', NULL, NULL, 6, 321),
(102, 'The Bard Returns', NULL, NULL, 6, 321),
(103, 'Things Behind the Sun', NULL, NULL, 6, 321),
(104, 'Intro', NULL, NULL, 6, 321),
(105, 'Someone to Watch Over Me', NULL, NULL, 6, 321),
(106, 'From This Moment On', NULL, NULL, 6, 321),
(107, 'Monk''s Dream', NULL, NULL, 6, 321),
(108, 'Paranoid Android', NULL, NULL, 6, 321),
(109, 'How Long Has This Been Going On?', NULL, NULL, 6, 321),
(110, 'River Man', NULL, NULL, 6, 321),
(111, 'Time Is on My Side', NULL, NULL, 7, 321),
(112, 'Lady Jane', NULL, NULL, 7, 321),
(113, 'The Last Time', NULL, NULL, 7, 321),
(114, 'Ruby Tuesday', NULL, NULL, 7, 321),
(115, 'Jumpin'' Jack Flash', NULL, NULL, 7, 321),
(116, 'Angie', NULL, NULL, 7, 321),
(117, 'Paint It Black', NULL, NULL, 7, 321),
(118, 'As Tears Go By', NULL, NULL, 7, 321),
(119, 'Satisfaction', NULL, NULL, 7, 321),
(120, 'Out of Time', NULL, NULL, 7, 321),
(121, 'Let''s Spend the Night Together', NULL, NULL, 7, 321),
(122, '19th Nervous Breakdown', NULL, NULL, 7, 321),
(123, 'It''s All Over Now', NULL, NULL, 7, 321),
(124, 'Mercy, Mercy', NULL, NULL, 8, 321),
(125, 'Hitch Hike', NULL, NULL, 8, 321),
(126, 'The Last Time', NULL, NULL, 8, 321),
(127, 'That''s How Strong My Love Is', NULL, NULL, 8, 321),
(128, 'Good Times', NULL, NULL, 8, 321),
(129, 'I''m All Right', NULL, NULL, 8, 321),
(130, '(I Can''t Get No) Satisfaction', NULL, NULL, 8, 321),
(131, 'Cry to Me', NULL, NULL, 8, 321),
(132, 'The Under Assistant West Coast Promotion Man', NULL, NULL, 8, 321),
(133, 'Play With Fire', NULL, NULL, 8, 321),
(134, 'The Spider and the Fly', NULL, NULL, 8, 321),
(135, 'One More Try', NULL, NULL, 8, 321),
(136, 'Life Wasted', NULL, NULL, 9, 321),
(137, 'World Wide Suicide', NULL, NULL, 9, 321),
(138, 'Comatose', NULL, NULL, 9, 321),
(139, 'Severed Hand', NULL, NULL, 9, 321),
(140, 'Marker in the Sand', NULL, NULL, 9, 321),
(141, 'Parachutes', NULL, NULL, 9, 321),
(142, 'Unemployable', NULL, NULL, 9, 321),
(143, 'Big Wave', NULL, NULL, 9, 321),
(144, 'Gone', NULL, NULL, 9, 321),
(145, 'Wasted Reprise', NULL, NULL, 9, 321),
(146, 'Army Reserve', NULL, NULL, 9, 321),
(147, 'Come Back', NULL, NULL, 9, 321),
(148, 'Inside Job', NULL, NULL, 9, 321),
(149, 'Believe', NULL, NULL, 10, 321),
(150, 'Made in England', NULL, NULL, 10, 321),
(151, 'House', NULL, NULL, 10, 321),
(152, 'Cold', NULL, NULL, 10, 321),
(153, 'Pain', NULL, NULL, 10, 321),
(154, 'Belfast', NULL, NULL, 10, 321),
(155, 'Latitude', NULL, NULL, 10, 321),
(156, 'Please', NULL, NULL, 10, 321),
(157, 'Man', NULL, NULL, 10, 321),
(158, 'Lies', NULL, NULL, 10, 321),
(159, 'Blessed', NULL, NULL, 10, 321),
(160, 'Jamaican in New York (radio mix without Rap)', NULL, NULL, 11, 321),
(161, 'Jamaican in New York (album version)', NULL, NULL, 11, 321),
(162, 'Jamaican in New York (radio mix with Rap)', NULL, NULL, 11, 321),
(163, 'Jamaican in New York (Southern Fried House)', NULL, NULL, 11, 321),
(164, 'Jamaican in New York (Dancehall Style)', NULL, NULL, 11, 321);

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
(3, 2),
(3, 3),
(4, 2),
(4, 3),
(5, 2),
(5, 3),
(6, 2),
(6, 3),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 2),
(10, 3),
(11, 2),
(11, 3),
(12, 2),
(12, 3),
(13, 2),
(13, 3),
(14, 2),
(14, 3),
(15, 2),
(15, 3),
(16, 2),
(16, 3),
(17, 2),
(17, 3),
(18, 2),
(18, 3),
(19, 2),
(19, 3),
(20, 2),
(20, 3),
(21, 2),
(21, 3),
(22, 2),
(22, 3),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(45, 7),
(46, 7),
(47, 7),
(48, 7),
(49, 7),
(50, 7),
(51, 7),
(52, 7),
(53, 7),
(54, 7),
(55, 7),
(56, 7),
(57, 7),
(58, 7),
(59, 7),
(60, 7),
(61, 7),
(62, 7),
(63, 7),
(64, 7),
(65, 7),
(66, 7),
(67, 7),
(68, 7),
(69, 7),
(70, 7),
(71, 7),
(72, 7),
(73, 7),
(74, 7),
(75, 7),
(76, 7),
(124, 2),
(125, 2),
(126, 2),
(127, 2),
(128, 2),
(129, 2),
(130, 2),
(131, 2),
(132, 2),
(133, 2),
(134, 2),
(135, 2),
(136, 2),
(137, 2),
(138, 2),
(139, 2),
(140, 2),
(141, 2),
(142, 2),
(143, 2),
(144, 2),
(145, 2),
(146, 2),
(147, 2),
(148, 2),
(149, 3),
(150, 3),
(151, 3),
(152, 3),
(153, 3),
(154, 3),
(155, 3),
(156, 3),
(157, 3),
(158, 3),
(159, 3);
