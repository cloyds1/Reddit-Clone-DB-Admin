-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 01:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redditclonedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `datecreated` datetime DEFAULT current_timestamp(),
  `title` varchar(35) NOT NULL DEFAULT 'None',
  `content` text DEFAULT NULL,
  `likes` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userid`, `datecreated`, `title`, `content`, `likes`) VALUES
(1, 1, '2020-05-06 23:19:24', 'Hello there!', 'This is the first post.', 0),
(5, 3, '2020-05-08 19:20:55', 'This is a manager post title', 'this is a manager post content.', 0),
(6, 2, '2020-05-08 19:35:45', 'useraccount1\'s post', 'this is post content', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentpostid` int(10) UNSIGNED DEFAULT NULL,
  `userid` int(10) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL,
  `datecreated` datetime DEFAULT current_timestamp(),
  `likes` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `parentpostid`, `userid`, `content`, `datecreated`, `likes`) VALUES
(1, 1, 1, 'This is a reply.', '2020-05-06 23:53:45', 0),
(2, 1, 1, 'This is another reply, with the same account.', '2020-05-07 00:12:43', 0),
(3, 1, 2, 'This is another reply, with a user account.', '2020-05-07 00:17:53', 0),
(7, 5, 1, 'This is a reply from the admin account.', '2020-05-08 19:25:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `authority` varchar(7) NOT NULL DEFAULT 'user',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `email` varchar(35) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `authority`, `username`, `password`, `bio`, `email`) VALUES
(1, 'admin', 'TheAdmin', 'b9c950640e1b3740e98acb93e669c65766f6670dd1609ba91ff41052ba48c6f3', 'This is the administrator account for the site.', 'somethingemail@somemail.com'),
(2, 'user', 'useraccount1', '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e', 'This is useraccount1\'s bio.', 'email1@mail.com'),
(3, 'manager', 'ManagerAccount', '16472b57e17a8a0eafd5d6811cf5b182f6b4e2812e322d5fc33b0d1f19fb5832', 'This is the manager account.', 'anothermail@mail.com'),
(4, 'user', 'useraccount2', '6cf615d5bcaac778352a8f1f3360d23f02f34ec182e259897fd6ce485d7870d4', '', 'email2@mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `parentpostid` (`parentpostid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_5` FOREIGN KEY (`parentpostid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
