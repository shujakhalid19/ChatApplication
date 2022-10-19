-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2021 at 10:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friendlyChat`
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
(1, '9p5wq96kw7q83qr', '4km9puyot5v13k2', '4km9puyot5v13k2', 1614878590319, 0),
(6, 'r9ksvtmtoquprm9', '4km9puyot5v13k2', '4ls68u94tm1pn85', 1614967537482, 0),
(11, 'n43q762s4z5km2x', '4km9puyot5v13k2', 'S1mzrJy7MsWC4G4K', 1615025875967, 0),
(18, '7kw0m5pz8msm965', '4km9puyot5v13k2', '3a7Z6wz9S9vNx29a', 1615029994261, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `keyUnique` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `imguri` varchar(200) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `keyUnique`, `name`, `email`, `imguri`, `timestamp`, `state`) VALUES
(1, '4km9puyot5v13k2', 'Shuja Khalid', 'shujakhalid26@gmail.com', 'https://lh3.googleusercontent.com/a-/AOh14GjGiEF0xwirsnYn6-C-EJevwgAfCqzZ3uVljrBSAA=s96-c', 1614874810140, 0),
(2, 'pqlxon96wmqn2qs', 'anshul tiwari', 'anshultiwari5796@gmail.com', 'https://lh4.googleusercontent.com/-GqXRpIH7qHI/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuckQ0oNZ6gxy3PYpAiBhrgCf0C-F8A/s96-c/photo.jpg', 1614944931289, 0),
(5, '4ls68u94tm1pn85', 'TestUser', 'shujakhalid7@gmail.com', 'https://lh3.googleusercontent.com/a-/AOh14Ggo6-w-X7JJJjNWOMed8qL3rjexCP77Ow8KCpLJ=s96-c', 1614967165328, 0),
(6, 'S1mzrJy7MsWC4G4K', 'John Doe', 'john@gmail.com', 'https://i.pravatar.cc/150?u=fake@pravatar.com', 1615020022, 0),
(7, '3a7Z6wz9S9vNx29a', 'jeremy', 'j@gmail.com', 'https://i.pravatar.cc/150?img=33', 1615027317, 0);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
