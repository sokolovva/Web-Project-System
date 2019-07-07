-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2018 at 12:05 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `project` varbinary(2000) NOT NULL,
  `requested` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `projects` (`id`, `title`, `description`, `project`, `requested`) VALUES
(1, 'Angular project', 'This project is about Angular framework.', '', '0'),
(2, 'Javascript project', 'This project is about Javascript basics.', '', '0'),
(3, 'Typescript project', 'This project is about Typescript basics.', '', '0'),
(4, 'Web technologies project', 'This is my Web technologies project', '', '0'),
(5, 'Mobile applications project', 'This project cover Mobile applications project. And how they work.', '', 'st_petya'),
(7, 'SARS project', 'This is my SARS project', '', '0'),
(8, 'DI project', 'This is my DI project', '', '0'),
(9, '.NET project', 'This project is about .NET basics.', '', '1');


CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--

INSERT INTO `teachers` (`id`, `username`, `password`) VALUES
(1, 'petya', '1234'),
(2, 'ivan', '123456'),
(3, 'todor', '12345');

-- --------------------------------------------------------


CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `projectId` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `students` (`id`, `username`, `password`, `projectId`) VALUES
(1, 'st_petya', '1234', ''),
(2, 'st_magi', '123456', ''),
(3, 'st_pesho', '12345', '1');

-- --------------------------------------------------------


CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `author` varchar(16) NOT NULL,
  `projectId` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




INSERT INTO `comments` (`id`, `comment`, `author`, `projectId`) VALUES
(1, 'Very good article.', 'st_petya', 1),
(2, 'I like your work.', 'st_magi',2),
(3, 'You can do better.', 'st_pesho', 3),
(4, 'I think React is better', 'st_pesho', 1),
(5, 'I like your work.', 'st_magi', 3),
(6, 'I dont like it.', 'st_petya', 3);


-- --------------------------------------------------------

--
-- Indexes for table `inbox`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sent`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userboxes`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sent`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
