-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 14, 2017 at 05:47 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blueprint`
--

-- --------------------------------------------------------

--
-- Table structure for table `bp_conversation`
--

CREATE TABLE `bp_conversation` (
  `conversationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `bp_job_accept`
--

CREATE TABLE `bp_job_accept` (
  `jobAcceptID` int(11) NOT NULL,
  `jobOfferID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_job_offer`
--

CREATE TABLE `bp_job_offer` (
  `jobOfferId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `jobPostId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_job_post`
--

CREATE TABLE `bp_job_post` (
  `jobPostID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `jobName` varchar(100) NOT NULL,
  `jobDesc` text NOT NULL,
  `jobLoc` varchar(100) NOT NULL,
  `payMethod` varchar(100) NOT NULL,
  `budget` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_message`
--

CREATE TABLE `bp_message` (
  `messageID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `convorsationID` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_notification`
--

CREATE TABLE `bp_notification` (
  `notificationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `link` varchar(200) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `markRead` tinyint(1) NOT NULL,
  `messageID` int(11) NOT NULL,
  `jobOfferID` int(11) NOT NULL,
  `jobAcceptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_skills`
--

CREATE TABLE `bp_skills` (
  `skillId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `skillTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_skill_type`
--

CREATE TABLE `bp_skill_type` (
  `skillTypeId` int(11) NOT NULL,
  `skillType` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `organisation` varchar(100) NOT NULL,
  `websiteLink` varchar(500) NOT NULL,
  `userRole` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_user`
--

INSERT INTO `bp_user` (`userId`, `forename`, `surname`, `email`, `username`, `password`, `pro`, `image`, `overview`, `organisation`, `websiteLink`, `userRole`) VALUES
(3, 'Ross', 'Brown', 'ross.brown@xample.com', 'rossbrown', 'password', 0, NULL, 'example overview', 'organisation', 'www.example.com', 'freelancer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bp_conversation`
--
ALTER TABLE `bp_conversation`
  ADD PRIMARY KEY (`conversationID`),
  ADD KEY `userID` (`userID`);

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
-- Indexes for table `bp_job_accept`
--
ALTER TABLE `bp_job_accept`
  ADD PRIMARY KEY (`jobAcceptID`),
  ADD KEY `jobOfferID` (`jobOfferID`);

--
-- Indexes for table `bp_job_offer`
--
ALTER TABLE `bp_job_offer`
  ADD PRIMARY KEY (`jobOfferId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `jobPostId` (`jobPostId`);

--
-- Indexes for table `bp_job_post`
--
ALTER TABLE `bp_job_post`
  ADD PRIMARY KEY (`jobPostID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `bp_message`
--
ALTER TABLE `bp_message`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `convorsationID` (`convorsationID`);

--
-- Indexes for table `bp_notification`
--
ALTER TABLE `bp_notification`
  ADD PRIMARY KEY (`notificationID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `messageID` (`messageID`),
  ADD KEY `jobOfferID` (`jobOfferID`),
  ADD KEY `jobAcceptID` (`jobAcceptID`);

--
-- Indexes for table `bp_skills`
--
ALTER TABLE `bp_skills`
  ADD PRIMARY KEY (`skillId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `skillTypeId` (`skillTypeId`);

--
-- Indexes for table `bp_skill_type`
--
ALTER TABLE `bp_skill_type`
  ADD PRIMARY KEY (`skillTypeId`);

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
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bp_conversation`
--
ALTER TABLE `bp_conversation`
  MODIFY `conversationID` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `bp_job_accept`
--
ALTER TABLE `bp_job_accept`
  MODIFY `jobAcceptID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_job_offer`
--
ALTER TABLE `bp_job_offer`
  MODIFY `jobOfferId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_job_post`
--
ALTER TABLE `bp_job_post`
  MODIFY `jobPostID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_message`
--
ALTER TABLE `bp_message`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_notification`
--
ALTER TABLE `bp_notification`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_skills`
--
ALTER TABLE `bp_skills`
  MODIFY `skillId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bp_skill_type`
--
ALTER TABLE `bp_skill_type`
  MODIFY `skillTypeId` int(11) NOT NULL AUTO_INCREMENT;
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
-- Constraints for table `bp_conversation`
--
ALTER TABLE `bp_conversation`
  ADD CONSTRAINT `bp_conversation_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_event_signup`
--
ALTER TABLE `bp_event_signup`
  ADD CONSTRAINT `bp_event_signup_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`),
  ADD CONSTRAINT `bp_event_signup_ibfk_2` FOREIGN KEY (`eventId`) REFERENCES `bp_events` (`eventId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_job_accept`
--
ALTER TABLE `bp_job_accept`
  ADD CONSTRAINT `bp_job_accept_ibfk_1` FOREIGN KEY (`jobOfferID`) REFERENCES `bp_job_offer` (`jobOfferId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_job_offer`
--
ALTER TABLE `bp_job_offer`
  ADD CONSTRAINT `bp_job_offer_ibfk_2` FOREIGN KEY (`jobPostId`) REFERENCES `bp_job_post` (`jobPostID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_job_offer_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_job_post`
--
ALTER TABLE `bp_job_post`
  ADD CONSTRAINT `bp_job_post_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_message`
--
ALTER TABLE `bp_message`
  ADD CONSTRAINT `bp_message_ibfk_2` FOREIGN KEY (`convorsationID`) REFERENCES `bp_conversation` (`conversationID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_message_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_notification`
--
ALTER TABLE `bp_notification`
  ADD CONSTRAINT `bp_notification_ibfk_4` FOREIGN KEY (`messageID`) REFERENCES `bp_message` (`messageID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_notification_ibfk_1` FOREIGN KEY (`jobAcceptID`) REFERENCES `bp_job_accept` (`jobAcceptID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_notification_ibfk_2` FOREIGN KEY (`jobOfferID`) REFERENCES `bp_job_offer` (`jobOfferId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_notification_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_skills`
--
ALTER TABLE `bp_skills`
  ADD CONSTRAINT `bp_skills_ibfk_2` FOREIGN KEY (`skillTypeId`) REFERENCES `bp_skill_type` (`skillTypeId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_skills_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_thread`
--
ALTER TABLE `bp_thread`
  ADD CONSTRAINT `bp_thread_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_thread_message`
--
ALTER TABLE `bp_thread_message`
  ADD CONSTRAINT `bp_thread_message_ibfk_1` FOREIGN KEY (`threadID`) REFERENCES `bp_thread` (`threadId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_thread_message_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;
