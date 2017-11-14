-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 13, 2017 at 06:44 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blueprint`
--

-- --------------------------------------------------------

--
-- Table structure for table `bp_events`
--

CREATE TABLE `bp_events` (
  `eventId` int(11) NOT NULL,
  `eventName` varchar(100) NOT NULL,
  `eventDate` date NOT NULL,
  `eventTime` time NOT NULL,
  `eventPlace` varchar(100) NOT NULL,
  `eventSpaces` int(4) NOT NULL,
  `eventImage` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_events`
--

INSERT INTO `bp_events` (`eventId`, `eventName`, `eventDate`, `eventTime`, `eventPlace`, `eventSpaces`, `eventImage`) VALUES
(1, 'test1', '2017-11-13', '18:00:00', 'newcastle', 1000, 'images/url.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bp_event_signup`
--

CREATE TABLE `bp_event_signup` (
  `eventSignupId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_event_signup`
--

INSERT INTO `bp_event_signup` (`eventSignupId`, `eventId`, `userId`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bp_thread`
--

CREATE TABLE `bp_thread` (
  `threadId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `threadTitle` varchar(100) NOT NULL,
  `threadInfo` varchar(500) NOT NULL,
  `timePosted` time NOT NULL,
  `datePosted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_thread_message`
--

CREATE TABLE `bp_thread_message` (
  `threadMessId` int(11) NOT NULL,
  `threadID` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `message` text NOT NULL,
  `datePosted` date NOT NULL,
  `timePosted` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_user`
--

CREATE TABLE `bp_user` (
  `userId` int(11) NOT NULL,
  `forename` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pro` int(1) NOT NULL DEFAULT '0',
  `image` blob,
  `overview` varchar(500) NOT NULL,
  `userRoleId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_user`
--

INSERT INTO `bp_user` (`userId`, `forename`, `surname`, `email`, `username`, `password`, `pro`, `image`, `overview`, `userRoleId`) VALUES
(3, 'Ross', 'Brown', 'ross.brown@xample.com', 'rossbrown', 'password', 0, NULL, 'fghjkl', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bp_events`
--
ALTER TABLE `bp_events`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `bp_event_signup`
--
ALTER TABLE `bp_event_signup`
  ADD PRIMARY KEY (`eventSignupId`),
  ADD KEY `eventId` (`eventId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `bp_thread`
--
ALTER TABLE `bp_thread`
  ADD PRIMARY KEY (`threadId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `bp_thread_message`
--
ALTER TABLE `bp_thread_message`
  ADD PRIMARY KEY (`threadMessId`),
  ADD KEY `threadID` (`threadID`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `bp_user`
--
ALTER TABLE `bp_user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userRoleidIndex` (`userRoleId`),
  ADD KEY `userRoleId` (`userRoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bp_events`
--
ALTER TABLE `bp_events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bp_event_signup`
--
ALTER TABLE `bp_event_signup`
  MODIFY `eventSignupId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bp_thread`
--
ALTER TABLE `bp_thread`
  MODIFY `threadId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_thread_message`
--
ALTER TABLE `bp_thread_message`
  MODIFY `threadMessId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_user`
--
ALTER TABLE `bp_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bp_event_signup`
--
ALTER TABLE `bp_event_signup`
  ADD CONSTRAINT `bp_event_signup_ibfk_2` FOREIGN KEY (`eventId`) REFERENCES `bp_events` (`eventId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_event_signup_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`);

--
-- Constraints for table `bp_thread`
--
ALTER TABLE `bp_thread`
  ADD CONSTRAINT `bp_thread_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_thread_message`
--
ALTER TABLE `bp_thread_message`
  ADD CONSTRAINT `bp_thread_message_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_thread_message_ibfk_1` FOREIGN KEY (`threadID`) REFERENCES `bp_thread` (`threadId`) ON UPDATE CASCADE;
