-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2024 at 01:28 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whats_happening`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventTypeID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `EventDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SubmitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EventTitle` varchar(100) NOT NULL,
  `EventImage` varchar(50) NOT NULL,
  `EventDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventTypeID`, `GroupID`, `EventDate`, `SubmitDate`, `EventTitle`, `EventImage`, `EventDesc`) VALUES
(1, 5, 1, '2024-02-25 22:00:00', '2024-01-04 01:11:38', 'Support Spay and Neuter Day', 'files/images/events/animal1.jpg', 'Integer luctus tortor id hendrerit auctor. Pellentesque gravida aliquam arcu vel dignissim.'),
(2, 3, 6, '2024-02-26 15:00:00', '2024-01-11 01:11:38', 'Come Skate on the Oval', 'files/images/events/skate3.jpg', 'Aliquam elementum augue mauris, quis elementum nulla suscipit ac. Suspendisse '),
(3, 3, 8, '2024-02-28 00:00:00', '2024-01-15 09:07:28', 'Learn to Ski', 'files/images/events/ski6.jpg', 'Praesent ac orci eu felis tincidunt dictum vitae sit amet velit. Integer tristique diam eget '),
(4, 4, 2, '2024-02-28 21:00:00', '2024-02-01 18:08:44', 'Food,Wine Pairing', 'files/images/events/food1.jpg', 'Maecenas rhoncus facilisis risus eu rhoncus. In id felis sit amet nunc tristique egestas. Nulla '),
(5, 2, 3, '2024-03-01 22:00:00', '2024-02-18 13:18:10', 'Exhibition Of Local Dance', 'files/images/events/dance1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt turpis vel dapibus imperdiet. Integer '),
(6, 5, 4, '2024-03-08 20:00:00', '2024-02-21 01:27:33', 'Local Bands compete to raise funds for national competition', 'files/images/events/music1.jpg', 'Pellentesque sed vestibulum sem, at faucibus massa. Praesent eget nisi ante. Integer dolor enim'),
(7, 5, 1, '2024-06-02 16:00:00', '2024-02-18 10:16:11', 'Meet, Greet and Adapt Day', 'files/images/events/animal3.jpg', 'Suspendisse tincidunt accumsan ex, non gravida massa sagittis quis. Ut tellus dui, lobortis eget lectus'),
(8, 5, 5, '2024-06-25 20:00:00', '2024-02-14 13:08:11', 'Auction of Ocal art to support local artists', 'files/images/events/art1.jpg', 'Etiam vitae metus dui. Nullam eu diam a velit semper vulputate. Vivamus elementum massa id nibh dapibus'),
(9, 1, 4, '2024-07-29 21:00:00', '2024-02-18 01:31:26', 'Spring concert', 'files/images/events/music2.jpg', 'Praesent a metus nisl. Donec id massa a diam porta tincidunt. Aenean faucibus neque non elit'),
(10, 4, 2, '2024-06-30 18:00:00', '2024-02-20 01:31:26', 'Spring Hamper - Get Yours', 'files/images/events/food7.jpg', 'Cras odio dui, sollicitudin et quam vitae, tristique fringilla ligula. Maecenas urna ante, venenatis vitae'),
(11, 2, 3, '2024-04-04 21:00:00', '2024-03-10 21:23:21', 'Learn to Dance ', 'files/images/events/dance5.jpg', 'Maecenas placerat purus quis ligula tempus, et facilisis dui sagittis. Fusce nec urna at nulla ullamcorper'),
(12, 1, 4, '2024-11-12 23:55:00', '2024-03-20 18:18:24', 'Arijit Singh Music Event', 'files/images/events/music2.jpg', '3aqws4erxctbhuinjkm zw4erxctfgvy bhuijkxredctfvg bh'),
(13, 1, 4, '2024-08-12 21:00:00', '2024-03-21 18:39:18', 'Darshan Raval Event', 'files/images/events/music1.jpg', 'Jh w fh wuf u fuiwf iwyiefwiu vw iv w8yfen8ai ihw '),
(14, 1, 2, '2025-01-01 03:59:00', '2024-03-25 05:45:26', 'new music event Halifax', 'files/images/events/music3.jpg', 'Fhbfqhj fjqh fu qefqjhf qh fuyq fuy q');

-- --------------------------------------------------------

--
-- Table structure for table `eventtype`
--

CREATE TABLE `eventtype` (
  `EventTypeID` int(11) NOT NULL,
  `EventType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventtype`
--

INSERT INTO `eventtype` (`EventTypeID`, `EventType`) VALUES
(1, 'Music'),
(2, 'Art+Culture'),
(3, 'Sports'),
(4, 'Food'),
(5, 'Fund Raiser');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupID` int(11) NOT NULL,
  `GroupName` varchar(100) NOT NULL,
  `GroupImage` varchar(50) NOT NULL,
  `GroupType` varchar(100) NOT NULL,
  `GroupDesc` text NOT NULL,
  `ContactName` varchar(255) NOT NULL,
  `ContactEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `GroupName`, `GroupImage`, `GroupType`, `GroupDesc`, `ContactName`, `ContactEmail`) VALUES
(1, 'Human Society', 'files/images/Groups/HumanSociety.jpg', 'Animal Shelter', 'Nullam id pellentesque ante. Vestibulum in convallis mauris.Duis dolor augu', 'Petra Barn', 'pb@hs.com'),
(2, 'Eat Local', 'files/images/Groups/EatLocal.jpg', 'Promotes Local Farms', 'Aenean odio ante, efficitur vel porttitor id, imperdiet ut urna. Ut tincidunt nibh', 'Joe Farm', 'joe@farms.com'),
(3, 'Dance NS', 'files/images/Groups/DanceNS.jpg', 'Dance for Youth', 'Sed sit amet urna sed nisl lobortis pharetra sit amet at nulla. Nulla euismod ', 'Ami Glen', 'ami@NSD.com'),
(4, 'Youth Band', 'files/images/Groups/YouthBand.jpg', 'Promotes Local School Bands', 'Ut ligula metus, pretium non dapibus dictum, rutrum at magna. Pellentesque et lorem', 'Drum Trumpet', 'DT@band.com'),
(5, 'Nocturne Association', 'files/images/Groups/Nocturne.jpg', 'Showcasing and supporting local art', 'Quisque vel rutrum est. Donec in turpis nec enim tincidunt eleifend vel eu nunc.', 'P Blue', 'pb@nocturne.com'),
(6, 'Outdoor Skating Group', 'files/images/Groups/Outdoor_Skate.jpg', 'Organizes outdoor skating', 'Nunc vel commodo sapien. Phasellus ac enim sit amet ligula congue scelerisque sit', 'Blade Fast', 'bf@risk.com'),
(7, 'NS Soccer Association', 'files/images/Groups/NS_Soccer.jpg', 'Organzies youth soccer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consequat, est et posuere maximus', 'Soca Foot', 'soca@socer.com'),
(8, 'NS Ski School', 'files/images/Groups/NS_Ski.jpg', 'Downhill skiing', 'Aliquam consequat, est et posuere maximus, magna arcu dapibus justo.', 'SK Downing', 'sk@hill.com'),
(9, 'Atlantic Game Developers', 'files/images/events/music6.jpg', 'Game Development', 'Nam at feugiat erat, quis congue sem. Suspendisse lobortis velit non metus', 'A. Fraser', 'afraser1@gamedeveloper.com'),
(14, 'ghj', 'files/images/events/ski3.jpg', 'vhbjn', 'tfcghvjbknlm', 'T. Pottie', 'tpottie@cricketclub.com'),
(15, 'xcvhj', 'files/images/events/music6.jpg', 'fghjkl', 'fdgcbhjknml', 'T. Pottie', 'tpottie@cricketclub.com'),
(16, 'Atlantic Cricket Club', 'files/images/events/music5.jpg', 'Atlantic Cricket Club', 'Vivamus non nulla vel neque pretium tempor quis et magna. Lorem ipsum dolor sit amet', 'T. Pottie', 'tpottie@cricketclub.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `AccountID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`AccountID`, `GroupID`, `Username`, `Password`) VALUES
(1, 1, 'humanS', 'abc123'),
(2, 2, 'locals', 'abc123'),
(3, 3, 'dancer', 'abc123'),
(4, 4, 'bands', 'abc123'),
(5, 5, 'nocturne', 'abc123'),
(6, 6, 'skate', 'abc123'),
(7, 7, 'soccer', 'abc123'),
(8, 8, 'skiNS', 'abc123'),
(9, 9, 'gdevelopers', '$2y$10$DoGqB8bP0CfM7G8NmGWwC.Vu7TeKwh4jNLd/GIF6FI1bDo0gpEwya'),
(16, 16, 'cclub', '$2y$10$98p1MTLPnTi.8oWnfL5Q5OEsfFyubxL7ZTP50T8aWers1XvW1Q4u.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `EventTypeID` (`EventTypeID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `eventtype`
--
ALTER TABLE `eventtype`
  ADD PRIMARY KEY (`EventTypeID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`AccountID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `eventtype`
--
ALTER TABLE `eventtype`
  MODIFY `EventTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`EventTypeID`) REFERENCES `eventtype` (`EventTypeID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
