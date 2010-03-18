-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2010 at 02:01 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
  KEY `play_order` (`play_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album_track`
--

INSERT INTO `album_track` (`albumid`, `trackid`, `play_order`) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 23, 1),
(4, 29, 1),
(5, 34, 1),
(6, 38, 1),
(7, 42, 1),
(8, 45, 1),
(9, 77, 1),
(10, 84, 1),
(11, 94, 1),
(12, 103, 1),
(13, 111, 1),
(14, 124, 1),
(15, 136, 1),
(16, 149, 1),
(17, 160, 1),
(1, 2, 2),
(2, 4, 2),
(3, 24, 2),
(4, 30, 2),
(5, 35, 2),
(6, 39, 2),
(7, 43, 2),
(8, 46, 2),
(9, 78, 2),
(10, 85, 2),
(11, 95, 2),
(12, 104, 2),
(13, 112, 2),
(14, 125, 2),
(15, 137, 2),
(16, 150, 2),
(17, 161, 2),
(2, 5, 3),
(3, 25, 3),
(4, 31, 3),
(5, 36, 3),
(6, 40, 3),
(7, 44, 3),
(8, 47, 3),
(9, 79, 3),
(10, 86, 3),
(11, 96, 3),
(12, 105, 3),
(13, 113, 3),
(14, 126, 3),
(15, 138, 3),
(16, 151, 3),
(17, 162, 3),
(2, 6, 4),
(3, 26, 4),
(4, 32, 4),
(5, 37, 4),
(6, 41, 4),
(8, 48, 4),
(9, 80, 4),
(10, 87, 4),
(11, 97, 4),
(12, 106, 4),
(13, 114, 4),
(14, 127, 4),
(15, 139, 4),
(16, 152, 4),
(17, 163, 4),
(2, 7, 5),
(3, 27, 5),
(4, 33, 5),
(8, 49, 5),
(9, 81, 5),
(10, 88, 5),
(11, 98, 5),
(12, 107, 5),
(13, 115, 5),
(14, 128, 5),
(15, 140, 5),
(16, 153, 5),
(17, 164, 5),
(2, 8, 6),
(3, 28, 6),
(8, 50, 6),
(9, 82, 6),
(10, 89, 6),
(11, 99, 6),
(12, 108, 6),
(13, 116, 6),
(14, 129, 6),
(15, 141, 6),
(16, 154, 6),
(2, 9, 7),
(8, 51, 7),
(9, 83, 7),
(10, 90, 7),
(11, 100, 7),
(12, 109, 7),
(13, 117, 7),
(14, 130, 7),
(15, 142, 7),
(16, 155, 7),
(2, 10, 8),
(8, 52, 8),
(10, 91, 8),
(11, 101, 8),
(12, 110, 8),
(13, 118, 8),
(14, 131, 8),
(15, 143, 8),
(16, 156, 8),
(2, 11, 9),
(8, 53, 9),
(10, 92, 9),
(11, 102, 9),
(13, 119, 9),
(14, 132, 9),
(15, 144, 9),
(16, 157, 9),
(2, 12, 10),
(8, 54, 10),
(10, 93, 10),
(13, 120, 10),
(14, 133, 10),
(15, 145, 10),
(16, 158, 10),
(2, 13, 11),
(8, 55, 11),
(13, 121, 11),
(14, 134, 11),
(15, 146, 11),
(16, 159, 11),
(2, 14, 12),
(8, 56, 12),
(13, 122, 12),
(14, 135, 12),
(15, 147, 12),
(2, 15, 13),
(8, 57, 13),
(13, 123, 13),
(15, 148, 13),
(2, 16, 14),
(8, 58, 14),
(2, 17, 15),
(8, 59, 15),
(2, 18, 16),
(8, 60, 16),
(2, 19, 17),
(8, 61, 17),
(2, 20, 18),
(8, 62, 18),
(2, 21, 19),
(8, 63, 19),
(2, 22, 20),
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
(8, 76, 32);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
(7, 'Anchner Philharmoniker'),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `shared` tinyint(1) DEFAULT NULL,
  `ownerid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ownerid` (`ownerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `shared`, `ownerid`) VALUES
(2, '0', 0, 1),
(45, 'playlist name4', 0, 1),
(46, 'wow', 0, 1),
(47, 'nice', 1, 1),
(49, 'fav', 1, 1),
(50, 'Fav', 1, 1),
(51, 'favoloso', 0, 1),
(184, 'playlist name', 0, 4);

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
  KEY `play_order` (`play_order`),
  KEY `trackid` (`trackid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist_track`
--

INSERT INTO `playlist_track` (`playlistid`, `albumid`, `trackid`, `play_order`) VALUES
(51, 11, 95, 1),
(50, 13, 113, 2),
(50, 13, 114, 3),
(50, 11, 95, 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist_user`
--

INSERT INTO `playlist_user` (`playlistid`, `userid`) VALUES
(50, 1),
(51, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `name`, `cost`, `src`, `main_artistid`, `duration`) VALUES
(1, 'Keeps Gettin'' Better', 120, NULL, 1, 321),
(2, 'Keeps Gettin'' Better (instrumental)', 120, NULL, 1, 321),
(3, 'Stripped (intro)', 120, NULL, 1, 321),
(4, 'Can''t Hold Us Down (feat. Lil'' Kim)', 120, NULL, 1, 321),
(5, 'Walk Away', 120, NULL, 1, 321),
(6, 'Fighter', 120, NULL, 1, 321),
(7, 'Primer Amor (interlude)', 120, NULL, 1, 321),
(8, 'Infatuation', 120, NULL, 1, 321),
(9, 'Loves Embrace (interlude)', 120, '/home/logiusto/Music/blunotte/layla.mp3', 1, 321),
(10, 'Loving Me 4 Me', 120, NULL, 1, 321),
(11, 'Impossible (feat. Alicia Keys)', 120, NULL, 1, 321),
(12, 'Underappreciated', 120, NULL, 1, 321),
(13, 'Beautiful', 120, NULL, 1, 321),
(14, 'Make Over', 120, NULL, 1, 321),
(15, 'Cruz', 120, NULL, 1, 321),
(16, 'Soar', 120, NULL, 1, 321),
(17, 'Get Mine, Get Yours', 120, NULL, 1, 321),
(18, 'Dirrty (feat. Redman)', 120, NULL, 1, 321),
(19, 'Stripped, Part 2', 120, NULL, 1, 321),
(20, 'The Voice Within', 120, NULL, 1, 321),
(21, 'I''m OK', 120, NULL, 1, 321),
(22, 'Keep On Singin'' My Song', 120, NULL, 1, 321),
(23, 'Watermelon Man', 120, NULL, 2, 321),
(24, 'Three Bags Full', 120, NULL, 2, 321),
(25, 'Empty Pockets', 120, NULL, 2, 321),
(26, 'The Maze', 120, NULL, 2, 321),
(27, 'Driftin''', 120, NULL, 2, 321),
(28, 'Alone and I', 120, NULL, 2, 321),
(29, 'Maiden Voyage', 120, NULL, 2, 321),
(30, 'The Eye of the Hurricane', 120, NULL, 2, 321),
(31, 'Little One', 120, NULL, 2, 321),
(32, 'Survival of the Fittest', 120, NULL, 2, 321),
(33, 'Dolphin Dance', 120, NULL, 2, 321),
(34, 'Palm Grease', 120, NULL, 2, 321),
(35, 'Actual Proof', 120, NULL, 2, 321),
(36, 'Butterfly', 120, NULL, 2, 321),
(37, 'Spank-a-Lee', 120, NULL, 2, 321),
(38, 'Chameleon', 120, NULL, 2, 321),
(39, 'Watermelon Man', 120, NULL, 2, 321),
(40, 'Sly', 120, NULL, 2, 321),
(41, 'Vein Melter', 120, NULL, 2, 321),
(42, 'Heyoke', 120, NULL, 3, 321),
(43, 'Smatter', 120, NULL, 3, 321),
(44, 'Gnu Suite', 120, NULL, 3, 321),
(45, 'Goldberg Variations in G major, BWV 988: I. Aria', 120, NULL, 4, 321),
(46, 'Goldberg Variations in G major, BWV 988: II. Variatio 1', 120, NULL, 4, 321),
(47, 'Goldberg Variations in G major, BWV 988: III. Variatio 2', 120, NULL, 4, 321),
(48, 'Goldberg Variations in G major, BWV 988: IV. Variatio 3', 120, NULL, 4, 321),
(49, 'Goldberg Variations in G major, BWV 988: V. Variatio 4', 120, NULL, 4, 321),
(50, 'Goldberg Variations in G major, BWV 988: VI. Variatio 5', 120, NULL, 4, 321),
(51, 'Goldberg Variations in G major, BWV 988: VII. Variatio 6', 120, NULL, 4, 321),
(52, 'Goldberg Variations in G major, BWV 988: VIII. Variatio 7', 120, NULL, 4, 321),
(53, 'Goldberg Variations in G major, BWV 988: IX. Variatio 8', 120, NULL, 4, 321),
(54, 'Goldberg Variations in G major, BWV 988: X. Variatio 9', 120, NULL, 4, 321),
(55, 'Goldberg Variations in G major, BWV 988: XI. Variatio 10', 120, NULL, 4, 321),
(56, 'Goldberg Variations in G major, BWV 988: XII. Variatio 11', 120, NULL, 4, 321),
(57, 'Goldberg Variations in G major, BWV 988: XIII. Variatio 12', 120, NULL, 4, 321),
(58, 'Goldberg Variations in G major, BWV 988: XIV. Variatio 13', 120, NULL, 4, 321),
(59, 'Goldberg Variations in G major, BWV 988: XV. Variatio 14', 120, NULL, 4, 321),
(60, 'Goldberg Variations in G major, BWV 988: XVI. Variatio 15', 120, NULL, 4, 321),
(61, 'Goldberg Variations in G major, BWV 988: XVII. Variatio 16', 120, NULL, 4, 321),
(62, 'Goldberg Variations in G major, BWV 988: XVIII. Variatio 17', 120, NULL, 4, 321),
(63, 'Goldberg Variations in G major, BWV 988: XIX. Variatio 18', 120, NULL, 4, 321),
(64, 'Goldberg Variations in G major, BWV 988: XX. Variatio 19', 120, NULL, 4, 321),
(65, 'Goldberg Variations in G major, BWV 988: XXI. Variatio 20', 120, NULL, 4, 321),
(66, 'Goldberg Variations in G major, BWV 988: XXII. Variatio 21', 120, NULL, 4, 321),
(67, 'Goldberg Variations in G major, BWV 988: XXIII. Variatio 22', 120, NULL, 4, 321),
(68, 'Goldberg Variations in G major, BWV 988: XXIV. Variatio 23', 120, NULL, 4, 321),
(69, 'Goldberg Variations in G major, BWV 988: XXV. Variatio 24', 120, NULL, 4, 321),
(70, 'Goldberg Variations in G major, BWV 988: XXVI. Variatio 25', 120, NULL, 4, 321),
(71, 'Goldberg Variations in G major, BWV 988: XXVII. Variatio 26', 120, NULL, 4, 321),
(72, 'Goldberg Variations in G major, BWV 988: XXVIII. Variatio 27', 120, NULL, 4, 321),
(73, 'Goldberg Variations in G major, BWV 988: XXIX. Variatio 28', 120, NULL, 4, 321),
(74, 'Goldberg Variations in G major, BWV 988: XXX. Variatio 29', 120, NULL, 4, 321),
(75, 'Goldberg Variations in G major, BWV 988: XXXI. Variatio 30', 120, NULL, 4, 321),
(76, 'Goldberg Variations in G major, BWV 988: XXXII. Aria', 120, NULL, 4, 321),
(77, 'All the Things You Are', 120, NULL, 5, 321),
(78, 'Sehnsucht', 120, NULL, 5, 321),
(79, 'Nice Pass', 120, NULL, 5, 321),
(80, 'Solar', 120, NULL, 5, 321),
(81, 'London Blues', 120, NULL, 5, 321),
(82, 'I''ll Be Seeing You', 120, NULL, 5, 321),
(83, 'Exit Music (For a Film)', 120, NULL, 5, 321),
(84, 'Song-Song', 120, NULL, 5, 321),
(85, 'Unrequited', 120, NULL, 5, 321),
(86, 'Bewitched, Bothered and Bewildered', 120, NULL, 5, 321),
(87, 'Exit Music (for a Film)', 120, NULL, 5, 321),
(88, 'At a Loss', 120, NULL, 5, 321),
(89, 'Convalescent', 120, NULL, 5, 321),
(90, 'For All We Know', 120, NULL, 5, 321),
(91, 'River Man', 120, NULL, 5, 321),
(92, 'Young at Heart', 120, NULL, 5, 321),
(93, 'Sehnsucht', 120, NULL, 5, 321),
(94, 'Bard', 120, 'http://localhost/~logiusto/3013project/system/application/media/music/MaidwiththeFlaxenHair.mp3', 6, 321),
(95, 'Resignation', 120, 'http://localhost/~logiusto/3013project/system/application/media/music/layla.mp3', 6, 321),
(96, 'Memory''s Tricks', 120, NULL, 6, 321),
(97, 'Elegy for William Burroughs and Allen Ginsberg', 120, NULL, 6, 321),
(98, 'Lament for Linus', 120, NULL, 6, 321),
(99, 'Trailer Park Ghost', 120, NULL, 6, 321),
(100, 'Goodbye Storyteller (for Fred Myrow)', 120, NULL, 6, 321),
(101, 'Ã¼ckblick', 120, NULL, 6, 321),
(102, 'The Bard Returns', 120, NULL, 6, 321),
(103, 'Things Behind the Sun', 120, NULL, 6, 321),
(104, 'Intro', 120, NULL, 6, 321),
(105, 'Someone to Watch Over Me', 120, NULL, 6, 321),
(106, 'From This Moment On', 120, NULL, 6, 321),
(107, 'Monk''s Dream', 120, NULL, 6, 321),
(108, 'Paranoid Android', 120, NULL, 6, 321),
(109, 'How Long Has This Been Going On?', 120, NULL, 6, 321),
(110, 'River Man', 120, NULL, 6, 321),
(111, 'Time Is on My Side', 120, NULL, 7, 321),
(112, 'Lady Jane', 120, NULL, 7, 321),
(113, 'The Last Time', 120, NULL, 7, 321),
(114, 'Ruby Tuesday', 120, NULL, 7, 321),
(115, 'Jumpin'' Jack Flash', 120, NULL, 7, 321),
(116, 'Angie', 120, NULL, 7, 321),
(117, 'Paint It Black', 120, NULL, 7, 321),
(118, 'As Tears Go By', 120, NULL, 7, 321),
(119, 'Satisfaction', 120, NULL, 7, 321),
(120, 'Out of Time', 120, NULL, 7, 321),
(121, 'Let''s Spend the Night Together', 120, NULL, 7, 321),
(122, '19th Nervous Breakdown', 120, NULL, 7, 321),
(123, 'It''s All Over Now', 120, NULL, 7, 321),
(124, 'Mercy, Mercy', 120, NULL, 8, 321),
(125, 'Hitch Hike', 120, NULL, 8, 321),
(126, 'The Last Time', 120, NULL, 8, 321),
(127, 'That''s How Strong My Love Is', 120, NULL, 8, 321),
(128, 'Good Times', 120, NULL, 8, 321),
(129, 'I''m All Right', 120, NULL, 8, 321),
(130, '(I Can''t Get No) Satisfaction', 120, NULL, 8, 321),
(131, 'Cry to Me', 120, NULL, 8, 321),
(132, 'The Under Assistant West Coast Promotion Man', 120, NULL, 8, 321),
(133, 'Play With Fire', 120, NULL, 8, 321),
(134, 'The Spider and the Fly', 120, NULL, 8, 321),
(135, 'One More Try', 120, NULL, 8, 321),
(136, 'Life Wasted', 120, NULL, 9, 321),
(137, 'World Wide Suicide', 120, NULL, 9, 321),
(138, 'Comatose', 120, NULL, 9, 321),
(139, 'Severed Hand', 120, NULL, 9, 321),
(140, 'Marker in the Sand', 120, NULL, 9, 321),
(141, 'Parachutes', 120, NULL, 9, 321),
(142, 'Unemployable', 120, NULL, 9, 321),
(143, 'Big Wave', 120, NULL, 9, 321),
(144, 'Gone', 120, NULL, 9, 321),
(145, 'Wasted Reprise', 120, NULL, 9, 321),
(146, 'Army Reserve', 120, NULL, 9, 321),
(147, 'Come Back', 120, NULL, 9, 321),
(148, 'Inside Job', 120, NULL, 9, 321),
(149, 'Believe', 120, NULL, 10, 321),
(150, 'Made in England', 120, NULL, 10, 321),
(151, 'House', 120, NULL, 10, 321),
(152, 'Cold', 120, NULL, 10, 321),
(153, 'Pain', 120, NULL, 10, 321),
(154, 'Belfast', 120, NULL, 10, 321),
(155, 'Latitude', 120, NULL, 10, 321),
(156, 'Please', 120, NULL, 10, 321),
(157, 'Man', 120, NULL, 10, 321),
(158, 'Lies', 120, NULL, 10, 321),
(159, 'Blessed', 120, NULL, 10, 321),
(160, 'Jamaican in New York (radio mix without Rap)', 120, NULL, 11, 321),
(161, 'Jamaican in New York (album version)', 120, NULL, 11, 321),
(162, 'Jamaican in New York (radio mix with Rap)', 120, NULL, 11, 321),
(163, 'Jamaican in New York (Southern Fried House)', 120, NULL, 11, 321),
(164, 'Jamaican in New York (Dancehall Style)', 120, NULL, 11, 321);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_genre`
--

INSERT INTO `track_genre` (`trackid`, `genreid`) VALUES
(1, 2),
(2, 2),
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
(33, 2),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 2),
(43, 2),
(44, 2),
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
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(94, 2),
(95, 2),
(96, 2),
(97, 2),
(98, 2),
(99, 2),
(100, 2),
(101, 2),
(102, 2),
(103, 2),
(104, 2),
(105, 2),
(106, 2),
(107, 2),
(108, 2),
(109, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
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
(159, 3),
(160, 2),
(161, 2),
(162, 2),
(163, 2),
(164, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `fname`, `lname`, `picture`, `joined`) VALUES
(1, 'giacomolg@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'Giacomo', 'Lo Giusto', NULL, '2010-03-11 19:26:47'),
(2, 'giacomo@gmail.com', 'c35127b6560063193f62ac22c7b345b3', 'Giacomo', 'Lo Giusto', NULL, '2010-03-08 12:37:13'),
(3, 'logiusto@cs.ucl.ac.uk', 'c35127b6560063193f62ac22c7b345b3', 'Giacomo', 'Lo Giusto', NULL, '2010-03-08 12:43:05'),
(4, 'stefda@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'David', 'Stefan', NULL, '2010-03-15 23:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `userid` int(11) NOT NULL,
  `credit` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `FKuser_accou95263` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`userid`, `credit`) VALUES
(1, NULL),
(4, 20960);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_track`
--

INSERT INTO `user_track` (`userid`, `albumid`, `trackid`, `bought`) VALUES
(1, 2, 9, '2010-03-15 11:44:22'),
(1, 11, 94, '2010-03-14 13:30:43'),
(1, 11, 95, '2010-03-14 13:38:24'),
(4, 2, 8, '2010-03-15 23:54:12'),
(4, 2, 11, '2010-03-15 23:57:37'),
(4, 3, 25, '2010-03-16 00:04:03'),
(4, 6, 38, '2010-03-17 19:53:58'),
(4, 9, 82, '2010-03-15 23:51:16'),
(4, 11, 97, '2010-03-16 00:05:43'),
(4, 13, 121, '2010-03-16 01:40:06'),
(4, 14, 129, '2010-03-15 23:52:52'),
(4, 15, 148, '2010-03-15 23:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_verification`
--

CREATE TABLE IF NOT EXISTS `user_verification` (
  `userid` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `FKuser_verif983218` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_verification`
--

INSERT INTO `user_verification` (`userid`, `code`) VALUES
(1, NULL),
(2, 'c7a3c38b35dcefaad5729f45575824ff'),
(3, NULL),
(4, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `trackid`, `name`, `src`) VALUES
(1, 38, 'Chameleon Live', 'http://www.youtube.com/watch?v=JcjkA5ZAWQo');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_track`
--
ALTER TABLE `album_track`
  ADD CONSTRAINT `FKalbum_trac210426` FOREIGN KEY (`albumid`) REFERENCES `album` (`id`),
  ADD CONSTRAINT `FKalbum_trac472451` FOREIGN KEY (`trackid`) REFERENCES `track` (`id`);

--
-- Constraints for table `artist_track`
--
ALTER TABLE `artist_track`
  ADD CONSTRAINT `FKartist_tra18975` FOREIGN KEY (`artistid`) REFERENCES `artist` (`id`),
  ADD CONSTRAINT `FKartist_tra234383` FOREIGN KEY (`trackid`) REFERENCES `track` (`id`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`ownerid`) REFERENCES `user` (`id`);

--
-- Constraints for table `playlist_track`
--
ALTER TABLE `playlist_track`
  ADD CONSTRAINT `FKplaylist_t199259` FOREIGN KEY (`albumid`, `trackid`) REFERENCES `album_track` (`albumid`, `trackid`),
  ADD CONSTRAINT `playlist_track_ibfk_1` FOREIGN KEY (`playlistid`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_track_ibfk_2` FOREIGN KEY (`albumid`) REFERENCES `album` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_track_ibfk_3` FOREIGN KEY (`trackid`) REFERENCES `track` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD CONSTRAINT `playlist_user_ibfk_1` FOREIGN KEY (`playlistid`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_user_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `track`
--
ALTER TABLE `track`
  ADD CONSTRAINT `track_ibfk_1` FOREIGN KEY (`main_artistid`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track_genre`
--
ALTER TABLE `track_genre`
  ADD CONSTRAINT `FKtrack_genr330448` FOREIGN KEY (`trackid`) REFERENCES `track` (`id`),
  ADD CONSTRAINT `FKtrack_genr573263` FOREIGN KEY (`genreid`) REFERENCES `genre` (`id`);

--
-- Constraints for table `user_account`
--
ALTER TABLE `user_account`
  ADD CONSTRAINT `FKuser_accou95263` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_track`
--
ALTER TABLE `user_track`
  ADD CONSTRAINT `FKuser_track244082` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FKuser_track330483` FOREIGN KEY (`albumid`, `trackid`) REFERENCES `album_track` (`albumid`, `trackid`);

--
-- Constraints for table `user_verification`
--
ALTER TABLE `user_verification`
  ADD CONSTRAINT `FKuser_verif983218` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`trackid`) REFERENCES `track` (`id`);
