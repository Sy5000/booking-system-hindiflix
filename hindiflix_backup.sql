-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 22, 2023 at 06:55 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hindiflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `Booking`
--

CREATE TABLE `Booking` (
  `bookingID` int(11) NOT NULL,
  `patronID` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Booking`
--

INSERT INTO `Booking` (`bookingID`, `patronID`, `sessionID`) VALUES
(1, 7, 22),
(9, 20, 31),
(10, 21, 31),
(11, 21, 31),
(12, 22, 31),
(13, 22, 31),
(14, 22, 31),
(48, 48, 13),
(49, 48, 13),
(50, 49, 13),
(51, 49, 13),
(52, 50, 13),
(53, 50, 13),
(54, 51, 13),
(55, 52, 13),
(56, 53, 13),
(57, 54, 13);

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE `Movie` (
  `movieID` int(11) NOT NULL,
  `thumb` varchar(512) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `year` int(4) NOT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`movieID`, `thumb`, `title`, `description`, `year`, `active`) VALUES
(1, 'https://upload.wikimedia.org/wikipedia/en/9/99/Dangal_Poster.jpg', 'Dangal', 'After his failure at winning a gold medal for the country, Mahavir Phogat vows to realize his dreams by training his daughters for the Commonwealth Games despite societal pressures.', 2016, 1),
(2, 'https://upload.wikimedia.org/wikipedia/en/8/85/Sanju_poster.jpg', 'Sanju', 'Few lives in our times are as dramatic and enigmatic as the saga of Sanjay Dutt. Coming from a family of cinema legends, he himself became a film star, and then saw dizzying heights and darkest depths: adulation of die-hard fans, unending battles with various addictions, brushes with the underworld, prison terms, loss of loved ones, and the haunting speculation that he might or might not be a terrorist. Sanju is in turns a hilarious and heartbreaking exploration of one man\'s battle against his own wild self and the formidable external forces trying to crush him. It depicts the journey of a man through everything that life can throw at him. Some true stories leave you thinking \"did this really happen?\" This is one such unbelievable story that happens to be true.', 2018, 1),
(3, 'https://upload.wikimedia.org/wikipedia/en/c/c3/PK_poster.jpg', 'PK', 'An alien on Earth loses the only device he can use to communicate with his spaceship. His innocent nature and child-like questions force the country to evaluate the impact of religion on its people.', 2014, 1),
(4, 'https://upload.wikimedia.org/wikipedia/en/2/22/Tiger_Zinda_Hai_poster.jpg', 'Tiger Zinda Hai', 'When a group of Indian and Pakistani nurses are held hostage in Iraq by a terrorist organization, a secret agent is drawn out of hiding to rescue them.', 2017, 0),
(5, 'https://upload.wikimedia.org/wikipedia/en/d/dd/Bajrangi_Bhaijaan_Poster.jpg', 'Bajrangi Bhaijaan', 'A young mute girl from Pakistan loses herself in India with no way to head back. A devoted man with a magnanimous spirit undertakes the task to get her back to her motherland and unite her with her family.', 2015, 1),
(6, 'https://upload.wikimedia.org/wikipedia/en/6/6f/War_official_poster.jpg', 'War', 'An Indian soldier is assigned to eliminate his former mentor and he must keep his wits about him if he is to be successful in his mission. When the two men collide, it results in a barrage of battles and bullets.', 2019, 1),
(7, 'https://upload.wikimedia.org/wikipedia/en/7/73/Padmaavat_poster.jpg', 'Padmaavat', 'In medieval India, a tyrannical sultan and his army attack a prosperous kingdom to try and capture the beautiful Queen Padmavati. Her husband Maharawal Ratan Singh assembles his valiant forces to defend his land and the honor of his beloved wife.', 2018, 1),
(8, 'https://upload.wikimedia.org/wikipedia/en/1/1f/Sultan_film_poster.jpg', 'Sultan', 'A middle-aged wrestling champion (Salman Khan) tries to make a comeback to represent India at the Olympics.', 2016, 0),
(9, 'https://upload.wikimedia.org/wikipedia/en/f/f1/Dhoom_3_Film_Poster.jpg', 'Dhoom 3', 'After his family circus business is closed down by a Chicago bank, a man swears revenge. Years later, he robs the bank, using his acrobat skills to escape.', 2013, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Patron`
--

CREATE TABLE `Patron` (
  `patronID` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Patron`
--

INSERT INTO `Patron` (`patronID`, `firstname`, `lastname`, `email`, `mobile`) VALUES
(1, 'simon', 'davies', 'sy.d@hotmail.co.uk', '0449192068'),
(2, 'dave', 'mave', 'dave@davemail.com', '123123123123'),
(3, 'sonic ', 'hedgehog', 'sonic@speedbal.com', '12312312312'),
(7, 'lisa ', 'simpson', 'lisa@springfield.cm', '123123123'),
(20, 'Phil', 'Dunph', 'ph@il.dun', '1234567890'),
(21, 'Phil2', 'Dunph2', 'phil@dunph2', '0987654321'),
(22, 'Phil3 ', 'Dunph3 ', 'phil@dunph3.com', '09876567890'),
(23, 'phil4', 'dunph4', 'phil@dun.com4', '12345612345'),
(48, 'grandpa ', 'simpson', 'g@simpsons.com', '1234567890'),
(49, 'lisa', 'simpson', 'g@simpsons.com', '1234567890'),
(50, 'lisa', 'simpson', 'g@simpsons.com', '1234567890'),
(51, 'bart', 'simpson', 'g@simpsons.com', '1234567890'),
(52, 'bart', 'simpson', 'g@simpsons.com', '1234567890'),
(53, 'bart', 'simpson', 'g@simpsons.com', '1234567890'),
(54, 'bart', 'simpson', 'g@simpsons.com', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

CREATE TABLE `Sessions` (
  `sessionID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `sessionDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Sessions`
--

INSERT INTO `Sessions` (`sessionID`, `movieID`, `sessionDate`) VALUES
(1, 1, '2020-07-01 15:30:00'),
(2, 1, '2020-07-02 15:30:00'),
(3, 1, '2020-07-03 15:30:00'),
(4, 1, '2020-07-04 12:30:00'),
(5, 1, '2020-07-04 15:30:00'),
(6, 1, '2020-07-05 12:30:00'),
(7, 1, '2020-07-05 15:30:00'),
(8, 1, '2020-07-06 12:30:00'),
(9, 1, '2020-07-06 15:30:00'),
(10, 2, '2020-07-01 16:00:00'),
(11, 2, '2020-07-02 16:00:00'),
(12, 2, '2020-07-03 16:00:00'),
(13, 2, '2020-07-04 16:00:00'),
(14, 2, '2020-07-04 19:00:00'),
(15, 2, '2020-07-05 16:00:00'),
(16, 2, '2020-07-05 19:00:00'),
(17, 2, '2020-07-06 16:00:00'),
(18, 2, '2020-07-06 19:00:00'),
(19, 2, '2020-07-07 16:00:00'),
(20, 2, '2020-07-07 19:00:00'),
(21, 3, '2020-07-01 19:30:00'),
(22, 3, '2020-07-02 19:30:00'),
(23, 3, '2020-07-03 19:30:00'),
(24, 3, '2020-07-04 19:30:00'),
(25, 3, '2020-07-04 22:30:00'),
(26, 3, '2020-07-05 19:30:00'),
(27, 3, '2020-07-05 22:30:00'),
(28, 3, '2020-07-06 19:30:00'),
(29, 3, '2020-07-06 22:30:00'),
(30, 3, '2020-07-07 19:30:00'),
(31, 3, '2020-07-07 22:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `patronID` (`patronID`),
  ADD KEY `sessionID` (`sessionID`);

--
-- Indexes for table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`movieID`);

--
-- Indexes for table `Patron`
--
ALTER TABLE `Patron`
  ADD PRIMARY KEY (`patronID`);

--
-- Indexes for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD PRIMARY KEY (`sessionID`),
  ADD KEY `movieID` (`movieID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Patron`
--
ALTER TABLE `Patron`
  MODIFY `patronID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `Sessions`
--
ALTER TABLE `Sessions`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Booking`
--
ALTER TABLE `Booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`patronID`) REFERENCES `Patron` (`patronID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`sessionID`) REFERENCES `Sessions` (`sessionID`);

--
-- Constraints for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `Movie` (`movieID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
