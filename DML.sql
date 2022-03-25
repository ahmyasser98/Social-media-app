-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 04:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `friend_id` int(11) NOT NULL,
  `email1` varchar(225) DEFAULT NULL,
  `email2` varchar(225) DEFAULT NULL,
  `isFriend` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`friend_id`, `email1`, `email2`, `isFriend`) VALUES
(1, 'yasseryasser@hotmail.com', 'omarnafei@gmail.com', '1'),
(2, 'sawsawn@gmail.com', 'omarnafei@gmail.com', '1'),
(3, 'shakoola@123.com', 'sawsawn@gmail.com', '0');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `posteremail` varchar(225) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `poster_name` varchar(225) DEFAULT NULL,
  `isPublic` tinyint(1) DEFAULT NULL,
  `timeposted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(225) DEFAULT NULL,
  `caption` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`posteremail`, `post_id`, `poster_name`, `isPublic`, `timeposted`, `image`, `caption`) VALUES
('omarnafei@gmail.com', 1, 'omar nafei', 1, '2020-05-17 01:47:47', NULL, 'hey every one just joined'),
('yasseryasser@hotmail.com', 2, 'yasser yasser', 1, '2020-05-17 01:56:15', 'postpics/download (1).jpg', 'wassap'),
('sawsawn@gmail.com', 3, 'sawsan sawsan', 1, '2020-05-17 02:03:16', 'profilepics/download (2).jpg', 'new profile picture!'),
('shakoola@123.com', 4, 'adel shakal', 1, '2020-05-17 02:11:36', 'postpics/adelshakal.jpg', 'shakal is here'),
('shakoola@123.com', 5, 'adel shakal', 1, '2020-05-17 02:12:42', 'profilepics/adelshakal.jpg', 'new profile picture!'),
('shakoola@123.com', 6, 'adel shakal', 1, '2020-05-17 02:16:12', NULL, 'guys i am  watching the game');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `email` varchar(225) NOT NULL,
  `birthdate` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `phonenumber` text DEFAULT NULL,
  `profilepicture` varchar(255) DEFAULT NULL,
  `hometown` text DEFAULT NULL,
  `martialstatus` text DEFAULT NULL,
  `aboutme` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `username`, `password`, `email`, `birthdate`, `gender`, `phonenumber`, `profilepicture`, `hometown`, `martialstatus`, `aboutme`) VALUES
('omar', 'nafei', 'omar nafei', '81dc9bdb52d04dc20036dbd8313ed055', 'omarnafei@gmail.com', '1990-04-14', 'Male', '', 'profilepics/male.jpg', 'Egypt', 'Single', 'Hi I am new here!'),
('sawsan', 'sawsan', 'sawsan sawsan', '827ccb0eea8a706c4c34a16891f84e7b', 'sawsawn@gmail.com', '1995-03-23', 'Female', '', 'profilepics/download (2).jpg', 'Albania', 'Single', 'Hi I am new here!'),
('adel', 'shakal', 'adel shakal', '827ccb0eea8a706c4c34a16891f84e7b', 'shakoola@123.com', '4444-03-14', 'Male', '', 'profilepics/adelshakal.jpg', 'USA', 'Single', 'Hi I am new here!'),
('yasser', 'yasser', 'yasser yasser', '81dc9bdb52d04dc20036dbd8313ed055', 'yasseryasser@hotmail.com', '1999-07-23', 'Male', '', 'profilepics/male.jpg', 'Egypt', 'Single', 'Hi I am new here!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`friend_id`),
  ADD KEY `email1` (`email1`),
  ADD KEY `email2` (`email2`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posteremail` (`posteremail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`email1`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`email2`) REFERENCES `users` (`email`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`posteremail`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
