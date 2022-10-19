-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2021 at 09:15 AM
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
-- Database: `friendlyChat1`
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
(21, '93zx3wzy3l39klo', '4km9puyot5v13k2', '03626v32t0r8kln', 1616778680452, 0),
(22, 'wm34s5n3kt912mk', 'pqlxon96wmqn2qs', '4km9puyot5v13k2', 1616609919069, 0),
(23, '7vtom9z60uzw602', '4km9puyot5v13k2', '7nvm0p8lurpkz5l', 1615572440986, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `keyUnique` varchar(20) NOT NULL,
  `prom` varchar(20) NOT NULL,
  `gname` varchar(40) NOT NULL,
  `iconType` varchar(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `state` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `keyUnique`, `prom`, `gname`, `iconType`, `category`, `description`, `timestamp`, `state`) VALUES
(1, 'r6olp0lv5ltp4tq', '1w29v9t23vuzu8l', 'Test Group', 'jpg', 'test', 'Test description', 1616090954003, 0),
(2, 'zrq08yu49yw2m6u', 'o3ozrt7qt29w8y3', 'New Test', 'jpg', 'testgp', '', 1616439728378, 0),
(3, 'u9uwxs15y4mqvqp', '9xs08nz2luks31r', 'dew', 'png', 'testgp', '', 1616440047869, 0),
(4, '64u497zw6ltkus3', '1rv4utw8n5vwx6v', 'testGroup', 'png', 'testgp', '', 1616445430323, 0),
(5, 'yv9lrkl8xor7ut9', '745867q8snz89ls', 'Snap', 'jpg', 'groupchat', '', 1616675519024, 0),
(6, '62qzluxs3kn752k', '4z0q4qzmno9x36v', 'Club Pokemon', 'jpg', 'pokemon', 'Group Description', 1616872719965, 0),
(7, 'musly0407063wn6', '0vl084k2z2nmwxu', 'Group Name', 'png', 'group', 'Test Group', 1616935722446, 0),
(8, 'q0urpqyvm57s1pq', '4x9wvy8y9w2uskq', 'Anither test group', 'png', 'test', 'Group for testing purpose', 1616935956471, 0),
(9, 'rp03sxv09tvz05n', 'z0vp2zmkn8m5qm7', 'Ubuntu Group', 'png', 'ubuntu', 'A group for testing purposes', 1616935956471, 0),
(10, '0nt7690ok0w2s1z', 'qypmrv1my2vz2vn', 'Ubuntu Group', 'png', 'ubuntu', 'A group for testing purposes', 1616935956471, 0),
(11, 'ysu185vytkoul79', 'muqux89t13o9680', 'Ubuntu Group', 'png', 'ubuntu', 'A group for testing purposes', 1616935956471, 0),
(12, 'v8rs964s7sukqo9', 'q4954ltx10uz2vz', 'GC', 'png', 'gc', 'gc', 1616936798773, 0),
(13, '40l21x8m32973lp', '3pq072sxuy4u3lk', 'GC', 'png', 'gc', 'gc', 1616936798773, 0),
(14, '14mnmx51qy5158p', '10os71xr4u4mozq', 'App', 'png', 'app', 'app', 1616936970324, 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `keyUnique` varchar(20) NOT NULL,
  `group` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `banned` int(11) NOT NULL DEFAULT 0,
  `timestamp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `keyUnique`, `group`, `user`, `rank`, `banned`, `timestamp`) VALUES
(1, 'l4psrn10xy7y3k8', 'r6olp0lv5ltp4tq', '4km9puyot5v13k2', 1, 0, 1616097697736),
(2, 'w3suzko6r06x9u8', 'r6olp0lv5ltp4tq', 'pqlxon96wmqn2qs', 0, 0, 1616101035979),
(3, 'uvp4vp3vpk2msv3', 'r6olp0lv5ltp4tq', '4ls68u94tm1pn85', 0, 0, 1616102560351),
(4, '649rkqnlv83pvqo', 'zrq08yu49yw2m6u', '4km9puyot5v13k2', 0, 0, 1616439968761),
(5, 's0rzkv3p5wyl091', 'u9uwxs15y4mqvqp', '4km9puyot5v13k2', 0, 0, 1616440115432),
(6, '5y845ruv1prpoy0', 'u9uwxs15y4mqvqp', 'pqlxon96wmqn2qs', 0, 0, 1616618535126),
(7, '30vrwozkuxtk897', '14mnmx51qy5158p', '4km9puyot5v13k2', 1, 0, 1616936970324);

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
(16, '4km9puyot5v13k2', 'Shuja', 'shuja', 'shujakhalid26@gmail.com', 'https://lh3.googleusercontent.com/a-/AOh14GjGiEF0xwirsnYn6-C-EJevwgAfCqzZ3uVljrBSAA=s96-c', 'abcd1212', 1615402416844, 0),
(17, '03626v32t0r8kln', 'shuja khalid', 'testuser', 'hostler.biz@gmail.com', 'https://lh4.googleusercontent.com/-buitUuE9JaU/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclLySVIRux7Cq_1rKfCbqsYMk8Hkw/s96-c/photo.jpg', 'abcd1212', 1615402875244, 0),
(18, '7nvm0p8lurpkz5l', 'Adiba Khalid', 'adibakhalid', 'adibakhalid20@gmail.com', 'https://lh5.googleusercontent.com/-5xjlix2KBEU/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuck14udXIUcIOSK1wR9dlXWPx_6PcQ/s96-c/photo.jpg', 'Abcd12', 1615548783578, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
