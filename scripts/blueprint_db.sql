-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 12:23 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blueprint_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bp_conversation`
--

CREATE TABLE `bp_conversation` (
  `conversationID` int(11) NOT NULL,
  `startUserID` int(11) NOT NULL,
  `secUserID` int(11) NOT NULL,
  `lastMessage` varchar(1000) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_conversation`
--

INSERT INTO `bp_conversation` (`conversationID`, `startUserID`, `secUserID`, `lastMessage`, `time`) VALUES
(1, 4, 3, 'go\r\n', '11:19:36');

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
  `eventAddress2` varchar(100) DEFAULT NULL,
  `eventCity` varchar(100) NOT NULL,
  `eventPostcode` varchar(10) NOT NULL,
  `eventSpaces` int(4) NOT NULL,
  `eventImage` varchar(200) DEFAULT NULL,
  `eventInfo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_events`
--

INSERT INTO `bp_events` (`eventId`, `eventName`, `eventDate`, `eventTime`, `eventPlace`, `eventAddress2`, `eventCity`, `eventPostcode`, `eventSpaces`, `eventImage`, `eventInfo`) VALUES
(12, 'Party at cassa del James', '2018-02-14', '20:30:00', 'the flat of James', 'Stepney lane', 'Newcastle upon Tyne', 'NE1 6PN', 10, 'defaultEventImg.jpeg', 'Lets get smashed at cassa del James, party all night long bring your own booze'),
(13, 'Matty T&#39;s birthday extravoganza', '2018-02-28', '21:30:00', 'Matty T&#39;s place', 'Heaton', 'Newcastle upon Tyne', 'NE6 5XY', 40, 'Banner.jpeg', 'it&#39;s Matty T&#39;s birthday so bring drink and lets paaartay to the max.'),
(17, 'skyscraper tour', '2018-02-26', '12:34:00', 'Downtown', '', 'London', 'W5 4TP', 20, 'defaultEventImg.jpeg', 'Come along and tour londons most famous skyscrapers'),
(20, 'Super Event', '2018-02-10', '12:34:00', 'Event', '', 'city', 'ne1 2hq', 3, 'defaultEventImg.jpeg', 'the event of this century'),
(21, 'event', '2018-02-18', '12:34:00', 'street', '', 'Newcastle upon Tyne', 'NE5 2HQ', 123, 'defaultEventImg.jpeg', 'info'),
(22, 'Super exclusive event', '2018-03-20', '17:30:00', 'The boiler shop steamer', '', 'Newcastle upon Tyne', 'NE1 3PE', 2, 'defaultEventImg.jpeg', 'Only two people can come to this event');

-- --------------------------------------------------------

--
-- Table structure for table `bp_event_signup`
--

CREATE TABLE `bp_event_signup` (
  `eventSignupId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_event_signup`
--

INSERT INTO `bp_event_signup` (`eventSignupId`, `eventId`, `userId`) VALUES
(4, 13, 4),
(6, 13, 5),
(18, 22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `bp_job_accept`
--

CREATE TABLE `bp_job_accept` (
  `jobAcceptID` int(11) NOT NULL,
  `jobOfferID` int(11) NOT NULL,
  `dateAccepted` date NOT NULL
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
  `duration` varchar(50) NOT NULL,
  `dateAccepted` date NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bp_message`
--

CREATE TABLE `bp_message` (
  `messageID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `conversationID` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reported` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_message`
--

INSERT INTO `bp_message` (`messageID`, `UserID`, `conversationID`, `message`, `date`, `time`, `reported`) VALUES
(1, 4, 1, 'another message', '2018-02-08', '08:00:00', 0),
(2, 4, 1, 'go\r\n', '2018-02-08', '11:19:36', 0);

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

--
-- Dumping data for table `bp_thread`
--

INSERT INTO `bp_thread` (`threadId`, `userId`, `threadTitle`, `threadInfo`, `timePosted`, `datePosted`) VALUES
(1, 3, 'Planning permission', 'I need to know how to go about gaining planning permission and if it will cost me anything.', '09:23:00', '2017-11-10'),
(14, 3, 'Landscape gardening', 'A place to talk about gardens', '15:05:09', '2018-02-04'),
(15, 3, 'Interior Architecture', 'Discussion about interior architecture', '15:06:15', '2018-02-04'),
(16, 3, 'Building indoor swimming pools', 'where can i find guidelines on building an indoor swimming pool', '15:07:29', '2018-02-04'),
(17, 5, 'a thread', 'another thread', '12:58:42', '2018-02-06'),
(18, 3, 'a thread', 'brand new thread', '14:09:57', '2018-02-06'),
(19, 3, 'Brick price', 'How much does a single brick go for?', '10:32:59', '2018-02-08');

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
  `timePosted` time NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `reported` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_thread_message`
--

INSERT INTO `bp_thread_message` (`threadMessId`, `threadID`, `userId`, `message`, `datePosted`, `timePosted`, `anonymous`, `reported`) VALUES
(1, 1, 3, 'i\'m replying to your message', '2017-11-22', '15:00:00', 0, 0),
(2, 1, 4, 'I am also repling to you, sir.', '2018-02-01', '21:43:00', 0, 0),
(3, 1, 3, 'Another message to you sir', '2018-02-01', '20:00:00', 1, 0),
(5, 1, 3, 'test', '2018-02-04', '14:42:48', 0, 0),
(6, 1, 3, 'i need some plannning', '2018-02-04', '14:43:06', 0, 0),
(9, 1, 3, 'i is anonymous', '2018-02-04', '15:00:22', 1, 0),
(10, 1, 3, 'i is not anonymous', '2018-02-04', '15:00:40', 0, 0),
(11, 16, 3, 'how bout dem apples', '2018-02-04', '15:32:46', 1, 0),
(12, 16, 3, 'how are dem apples', '2018-02-04', '15:33:03', 0, 0),
(13, 15, 4, 'i love interior architecture', '2018-02-04', '22:51:35', 0, 0),
(14, 15, 4, 'me too', '2018-02-04', '22:51:43', 0, 0),
(15, 15, 4, 'me three', '2018-02-04', '22:51:53', 1, 0),
(18, 1, 3, 'i think you just have to contact the council', '2018-02-05', '15:09:29', 0, 0),
(19, 1, 3, 'that souns right', '2018-02-05', '15:10:08', 1, 0),
(20, 16, 4, 'reply', '2018-02-05', '15:11:52', 0, 0),
(21, 16, 4, 'anoder', '2018-02-05', '15:12:04', 1, 0),
(22, 16, 5, 'i am anonymous', '2018-02-06', '12:47:46', 1, 0),
(23, 16, 5, 'i am not anonymous', '2018-02-06', '12:51:46', 0, 1),
(24, 17, 3, 'a reply', '2018-02-06', '13:35:11', 0, 0),
(25, 16, 5, 'reply', '2018-02-06', '13:41:25', 1, 1),
(26, 16, 5, 'reply', '2018-02-06', '13:41:33', 0, 1),
(27, 1, 3, 'fghjk', '2018-02-06', '14:04:19', 1, 0),
(28, 18, 3, 'a reply', '2018-02-06', '14:25:52', 1, 0);

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
  `userRole` varchar(100) NOT NULL,
  `dateAdded` date NOT NULL,
  `suspended` tinyint(1) NOT NULL,
  `token` varchar(20) NOT NULL,
  `passwordHint` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bp_user`
--

INSERT INTO `bp_user` (`userId`, `forename`, `surname`, `email`, `username`, `password`, `pro`, `image`, `overview`, `organisation`, `websiteLink`, `userRole`, `dateAdded`, `suspended`, `token`, `passwordHint`) VALUES
(3, 'Ross', 'Brown', 'ross.brown@xample.com', 'rossbrown', '$2y$10$yv9So026F3u0JLxDymEpm.d8KZpZCzUsbfyzLMOtElsVFbYHZIZ6O', 0, NULL, 'example overview', 'organisation', 'www.example.com', 'admin', '0000-00-00', 0, '', ''),
(4, 'Matt', 'Taylor', 'matttaylor@admin.com', 'matttaylor', '$2y$10$spYQ1fZZ1TKB/v9gfO81qeXtKBB6nExj.HhMlrQh3NxodR19ZjYVG', 1, '', '', '', '', 'client', '2018-01-31', 0, '', ''),
(5, 'Oliver', 'Smelik', 'oliversmelik@gmail.com', 'oliversmelik', '$2y$10$spYQ1fZZ1TKB/v9gfO81qeXtKBB6nExj.HhMlrQh3NxodR19ZjYVG', 0, NULL, '', '', '', 'freelancer', '2018-02-06', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bp_conversation`
--
ALTER TABLE `bp_conversation`
  ADD PRIMARY KEY (`conversationID`),
  ADD KEY `userID` (`startUserID`),
  ADD KEY `secUserID` (`secUserID`);

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
  ADD KEY `convorsationID` (`conversationID`);

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
  MODIFY `conversationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bp_events`
--
ALTER TABLE `bp_events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `bp_event_signup`
--
ALTER TABLE `bp_event_signup`
  MODIFY `eventSignupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `threadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `bp_thread_message`
--
ALTER TABLE `bp_thread_message`
  MODIFY `threadMessId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `bp_user`
--
ALTER TABLE `bp_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bp_conversation`
--
ALTER TABLE `bp_conversation`
  ADD CONSTRAINT `bp_conversation_ibfk_1` FOREIGN KEY (`startUserID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_conversation_ibfk_2` FOREIGN KEY (`secUserID`) REFERENCES `bp_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bp_event_signup`
--
ALTER TABLE `bp_event_signup`
  ADD CONSTRAINT `bp_event_signup_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_event_signup_ibfk_2` FOREIGN KEY (`eventId`) REFERENCES `bp_events` (`eventId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bp_job_accept`
--
ALTER TABLE `bp_job_accept`
  ADD CONSTRAINT `bp_job_accept_ibfk_1` FOREIGN KEY (`jobOfferID`) REFERENCES `bp_job_offer` (`jobOfferId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_job_offer`
--
ALTER TABLE `bp_job_offer`
  ADD CONSTRAINT `bp_job_offer_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_job_offer_ibfk_2` FOREIGN KEY (`jobPostId`) REFERENCES `bp_job_post` (`jobPostID`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_job_post`
--
ALTER TABLE `bp_job_post`
  ADD CONSTRAINT `bp_job_post_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_message`
--
ALTER TABLE `bp_message`
  ADD CONSTRAINT `bp_message_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_message_ibfk_2` FOREIGN KEY (`conversationID`) REFERENCES `bp_conversation` (`conversationID`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_notification`
--
ALTER TABLE `bp_notification`
  ADD CONSTRAINT `bp_notification_ibfk_1` FOREIGN KEY (`jobAcceptID`) REFERENCES `bp_job_accept` (`jobAcceptID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_notification_ibfk_2` FOREIGN KEY (`jobOfferID`) REFERENCES `bp_job_offer` (`jobOfferId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_notification_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_notification_ibfk_4` FOREIGN KEY (`messageID`) REFERENCES `bp_message` (`messageID`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_skills`
--
ALTER TABLE `bp_skills`
  ADD CONSTRAINT `bp_skills_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_skills_ibfk_2` FOREIGN KEY (`skillTypeId`) REFERENCES `bp_skill_type` (`skillTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `bp_thread`
--
ALTER TABLE `bp_thread`
  ADD CONSTRAINT `bp_thread_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bp_thread_message`
--
ALTER TABLE `bp_thread_message`
  ADD CONSTRAINT `bp_thread_message_ibfk_1` FOREIGN KEY (`threadID`) REFERENCES `bp_thread` (`threadId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_thread_message_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `bp_user` (`userId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
