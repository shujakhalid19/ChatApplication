-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 08:10 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friendlychat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `keyUnique` varchar(20) NOT NULL,
  `user1` varchar(20) NOT NULL,
  `user2` varchar(20) NOT NULL,
  `timestamp` bigint(20) NOT NULL DEFAULT 0,
  `state` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `keyUnique`, `user1`, `user2`, `timestamp`, `state`) VALUES
(21, '93zx3wzy3l39klo', '4km9puyot5v13k2', '03626v32t0r8kln', 1615403282340, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `keyUnique` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `imguri` varchar(200) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `keyUnique`, `name`, `username`, `email`, `imguri`, `pass`, `timestamp`, `state`) VALUES
(2, 'pqlxon96wmqn2qs', 'anshul tiwari', 'anshul', 'anshultiwari5796@gmail.com', 'https://lh4.googleusercontent.com/-GqXRpIH7qHI/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuckQ0oNZ6gxy3PYpAiBhrgCf0C-F8A/s96-c/photo.jpg', '1212', 1614944931289, 0),
(5, '4ls68u94tm1pn85', 'TestUser', 'test', 'shujakhalid7@gmail.com', 'https://lh3.googleusercontent.com/a-/AOh14Ggo6-w-X7JJJjNWOMed8qL3rjexCP77Ow8KCpLJ=s96-c', '1212', 1614967165328, 0),
(6, 'S1mzrJy7MsWC4G4K', 'John Doe', 'john', 'john@gmail.com', 'https://i.pravatar.cc/150?u=fake@pravatar.com', '1212', 1615020022, 0),
(7, '3a7Z6wz9S9vNx29a', 'jeremy', 'jeremy', 'j@gmail.com', 'https://i.pravatar.cc/150?img=33', '1212', 1615027317, 0),
(16, '4km9puyot5v13k2', 'Shuja Khalid', 'shuja', 'shujakhalid26@gmail.com', 'https://lh3.googleusercontent.com/a-/AOh14GjGiEF0xwirsnYn6-C-EJevwgAfCqzZ3uVljrBSAA=s96-c', 'abcd1212', 1615402416844, 0),
(17, '03626v32t0r8kln', 'shuja khalid', 'testuser', 'hostler.biz@gmail.com', 'https://lh4.googleusercontent.com/-buitUuE9JaU/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclLySVIRux7Cq_1rKfCbqsYMk8Hkw/s96-c/photo.jpg', 'abcd1212', 1615402875244, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
