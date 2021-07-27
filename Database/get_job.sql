-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 12:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `get_job`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE `attachment` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `storage_name` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `upload_date` datetime NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `storage_name`, `post_id`, `upload_date`, `file_path`) VALUES
(8, '2021-07-14 07-11-35.txt', 'trying queries.txt', 1, '2021-07-14 19:11:35', 'D:/upload/2021-07-14 07-11-35.txt'),
(9, '2021-07-14 07-15-21.png', 'Get_Job_1.png', 4, '2021-07-14 19:15:21', 'D:/upload/2021-07-14 07-15-21.png'),
(10, '2021-07-15 12-02-58.txt', 'queries.txt', 1, '2021-07-15 00:02:58', 'D:/upload/2021-07-15 12-02-58.txt'),
(11, '2021-07-15 12-04-01.sql', 'get_jobs1 (2).sql', 4, '2021-07-15 00:04:01', 'D:/upload/2021-07-15 12-04-01.sql'),
(12, '2021-07-15 08-43-06.sql', 'get_jobs1 (2).sql', 1, '2021-07-15 08:43:06', 'D:/upload/2021-07-15 08-43-06.sql'),
(13, '2021-07-15 11-46-27.sql', 'get_jobs1 (2).sql', 10, '2021-07-15 11:46:27', 'D:/upload/2021-07-15 11-46-27.sql');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `accept` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`id`, `post_id`, `client_id`, `freelancer_id`, `accept`) VALUES
(1, 8, 8, 4, 1),
(2, 14, 24, 4, 0),
(3, 15, 8, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `creator_id`, `destination_id`, `message`, `created_at`) VALUES
(1, 5, 3, 'Hey are you there??!!', '2021-06-23 12:05:17'),
(2, 6, 4, '', '2021-06-23 12:05:18'),
(4, 4, 5, 'hello', '2021-07-01 22:39:33'),
(8, 3, 5, 'Yes I am here', '2021-07-03 09:20:58'),
(9, 3, 5, '', '2021-07-05 15:05:25'),
(10, 3, 5, 'so tell me about the project', '2021-07-05 15:21:13'),
(11, 5, 3, 'OK so...', '2021-07-05 15:21:13'),
(12, 3, 5, 'First of all', '2021-07-05 15:34:31'),
(14, 5, 3, 'I should say that', '2021-07-05 15:59:51'),
(15, 5, 3, 'So first of all ....', '2021-07-05 16:01:43'),
(16, 5, 4, 'Hi', '2021-07-06 06:52:53'),
(17, 5, 4, 'OK', '2021-07-06 06:54:07'),
(18, 5, 4, 'Now what', '2021-07-06 06:56:14'),
(19, 5, 3, 'Hi again', '2021-07-08 15:33:49'),
(20, 5, 3, 'hellooooooooooo', '2021-07-13 20:54:56'),
(21, 5, 3, 'ok', '2021-07-13 20:55:41'),
(22, 5, 3, 'try', '2021-07-13 21:04:47'),
(23, 5, 3, 'another try', '2021-07-13 21:05:19'),
(24, 5, 3, 'Yeah', '2021-07-13 21:07:28'),
(25, 5, 3, 'another one', '2021-07-13 21:08:06'),
(26, 5, 3, 'for happinnes', '2021-07-13 21:08:40'),
(27, 5, 4, 'trying something', '2021-07-13 21:09:05'),
(28, 3, 5, 'ok', '2021-07-15 08:41:49'),
(29, 3, 5, 'OK', '2021-07-15 10:48:12'),
(30, 5, 3, 'hi', '2021-07-15 11:44:18'),
(31, 3, 5, 'ok', '2021-07-15 11:44:44'),
(32, 5, 3, 'how are you doing??!!', '2021-07-15 12:18:05'),
(33, 5, 3, 'kjsahf', '2021-07-19 20:24:57'),
(34, 5, 4, 'jhjmhdsd', '2021-07-25 14:18:23'),
(35, 4, 5, 'yes', '2021-07-25 14:19:16'),
(36, 5, 4, 'Hi', '2021-07-27 17:39:35'),
(37, 5, 4, 'YO', '2021-07-27 17:39:51'),
(38, 5, 4, 'YO!!', '2021-07-27 17:41:25'),
(39, 5, 4, 'مرحبا', '2021-07-27 17:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cost` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `paid_status` tinyint(1) NOT NULL DEFAULT 0,
  `start_date` datetime NOT NULL,
  `skills` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `client_id`, `freelancer_id`, `company_id`, `title`, `description`, `cost`, `category`, `status`, `paid_status`, `start_date`, `skills`) VALUES
(1, 5, 3, NULL, 'company logo', 'I want a logo for my company', 20, 'design', 'in progress', 1, '2021-06-29 19:19:46', 'photoshop, illustrator'),
(2, 5, NULL, 7, 'website for my company', 'I want a modern website for a my computers company', 50, 'it', 'done', 1, '2021-06-29 19:22:42', 'html, css, php, ajax, javascript'),
(3, 6, 4, 7, 'design', 'design anything', 15, 'design', 'done', 1, '2021-07-03 15:13:34', 'drawing, sketch'),
(4, 5, 3, NULL, 'application for mobile', 'with dart', 60, 'programming', 'in progress', 1, '2021-07-03 15:17:48', 'flutter, xd'),
(6, 5, NULL, 7, 'Online Shopping App', 'I want a mobile application like amazon for android and ios', 50, 'mobile application', 'in progress', 1, '2021-07-10 18:51:27', 'flutter, dart, ajax'),
(8, 8, 4, 7, 'anything', 'anything', 21, 'Design', 'in progress', 1, '2021-07-14 12:56:12', 'anything, anything'),
(9, 5, 3, NULL, 'any body work to me', 'translate document from arabic to english', 30, 'translate', 'in progress', 0, '2021-07-15 09:06:20', 'English, Arabic'),
(10, 5, 3, 7, 'alskdf', 'lisagjoisa', 34, 'dseign', 'done', 1, '2021-07-15 11:38:52', 'aslk, oias, isdf'),
(11, 5, 3, 7, 'app for anything', 'application for android', 20, 'android', 'in progress', 1, '2021-07-15 12:38:59', 'flutter, dart, ajax'),
(12, 5, 3, NULL, 'cake', 'I wanna make a vanilla cake', 29, 'testing', 'in progress', 0, '2021-07-25 09:21:05', 'cooking'),
(13, 5, 4, NULL, 'anything', 'logo design', 20, 'design', 'in progress', 0, '2021-07-25 14:13:12', 'ui'),
(14, 24, NULL, 7, 'first', 'design for food truck', 12, 'design', 'available', 1, '2021-07-27 00:02:23', 'photoshop, illustrator'),
(15, 8, 9, 7, 'new One', 'web scraping from amazon', 14, 'web scraping', 'in progress', 1, '2021-07-27 23:13:36', 'python, json, excel');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `post_id`, `freelancer_id`, `description`, `publish_date`) VALUES
(1, 1, 4, 'I can do it for you sir', '2021-07-02 15:26:44'),
(2, 1, 3, 'I can sir, text me', '2021-07-02 19:39:38'),
(20, 1, 3, 'another one', '2021-07-02 23:11:33'),
(21, 2, 3, 'hi fuck you\r\n', '2021-07-02 23:45:42'),
(22, 4, 3, 'I can do it Sir', '2021-07-14 22:52:15'),
(23, 1, 3, 'I can', '2021-07-15 08:40:32'),
(24, 9, 3, 'I do it for you for 20$', '2021-07-15 09:09:01'),
(25, 4, 3, 'I have some changes for better app', '2021-07-15 09:46:09'),
(26, 10, 3, 'ytes ica i', '2021-07-15 11:39:25'),
(27, 11, 3, 'salf', '2021-07-19 20:16:58'),
(28, 12, 3, 'I can do it', '2021-07-25 09:26:29'),
(29, 10, 22, 'I can', '2021-07-25 14:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `user_id` int(11) NOT NULL,
  `by_user` int(11) NOT NULL,
  `rated` int(11) NOT NULL,
  `rate_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`user_id`, `by_user`, `rated`, `rate_date`) VALUES
(3, 5, 5, '2021-06-23 12:02:56'),
(3, 6, 7, '2021-06-23 12:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `by_user` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `report_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transfering`
--

CREATE TABLE `transfering` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_at` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `id_number` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `hourly_rate` int(11) DEFAULT NULL,
  `wallet` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `join_date` datetime NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `id_number`, `email`, `username`, `password`, `phone_number`, `skills`, `language`, `bio`, `hourly_rate`, `wallet`, `location`, `category`, `join_date`, `group_id`) VALUES
(1, 'admin', '1', NULL, 'admin1@gmail.com', 'admin_1', 'admin1', 9123456, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-23 11:46:09', 0),
(2, 'admin', '2', NULL, 'admin2@gmail.com', 'admin_2', 'admin2', 9123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-23 11:48:35', 0),
(3, 'freelancer', '1', 1234, 'ayhamnarzo@gmail.com', 'freelancer_1', 'freelancer1', 91234, 'html, css', 'english', 'programmer', 10, 30, 'syria', 'IT', '2021-06-23 11:51:20', 1),
(4, 'freelancer', '2', 123456, 'freelancer2@gmail.com', 'freelancer_2', 'freelancer2', 912, 'photoshop, illustrator', 'arabic', 'logo designer', 13, 20, 'Jordan', 'Design', '2021-06-23 11:54:21', 1),
(5, 'client', '1', 523, 'mohamadkhald2001.3@gmail.com', 'client_1', 'client1', 96345, NULL, 'english', NULL, NULL, NULL, NULL, NULL, '2021-06-23 11:56:45', 2),
(6, 'client', '2', 4535, 'client2@gmail.com', 'client_2', 'client2', 9753453, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-23 11:58:08', 2),
(7, 'Al-Haram', 'Transfer', NULL, 'alharam@gmail.com', 'alharam', 'alharam', 96435, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-23 12:00:24', 3),
(8, 'client', '3', NULL, 'client3@email.com', 'client_3', 'client3', 0, NULL, NULL, NULL, NULL, NULL, 'syria', NULL, '2021-07-10 10:49:11', 2),
(9, 'freelancer', '3', NULL, 'freelancer3@email.com', 'freelancer_3', 'freelancer3', 0, 'html, css, pugjs', NULL, 'Attempting to reach 500 $ this month', 12, NULL, 'Turkey', 'Web Design', '2021-07-10 11:14:47', 1),
(21, 'ibrahem', 'jbara', NULL, 'ibrahem@gmail.com', 'ibrahem', 'ibrahem', 0, 'network', NULL, 'teacher', 10, NULL, 'syria', 'network', '2021-07-15 12:27:56', 1),
(22, 'mai', 'omar', NULL, 'mai.omar24@gmail.com', 'maiOmar', '12345678', 0, 'flutter, database, web', NULL, 'teacher', 100, NULL, 'syria', 'web, dba', '2021-07-25 13:53:08', 1),
(23, 'TRY', 'trying', NULL, 'trying@gmail.com', 'try', '123123try', 0, NULL, NULL, NULL, NULL, NULL, 'Syria', NULL, '2021-07-26 16:57:38', 2),
(24, 'client', '4', NULL, 'client4@gmail.com', 'client_4', 'client4', 0, NULL, NULL, NULL, NULL, NULL, 'Syria', NULL, '2021-07-27 00:01:09', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `client_id` (`client_id`) USING BTREE,
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`user_id`,`by_user`),
  ADD KEY `by_user` (`by_user`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `by_user` (`by_user`);

--
-- Indexes for table `transfering`
--
ALTER TABLE `transfering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachment`
--
ALTER TABLE `attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfering`
--
ALTER TABLE `transfering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `invitation_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitation_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitation_ibfk_3` FOREIGN KEY (`freelancer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proposal_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`by_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`by_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transfering`
--
ALTER TABLE `transfering`
  ADD CONSTRAINT `transfering_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transfering_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
