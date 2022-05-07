-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2022 at 01:55 PM
-- Server version: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absolventka`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id_agent` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nickname` varchar(11) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `flag_id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `open` tinyint(1) NOT NULL,
  `closed` tinyint(1) NOT NULL,
  `inprogress` tinyint(1) NOT NULL,
  `urgent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phpmailer`
--

CREATE TABLE `phpmailer` (
  `id` int(11) NOT NULL,
  `smtphost` varchar(128) COLLATE utf8mb4_czech_ci NOT NULL,
  `encrypttype` varchar(16) COLLATE utf8mb4_czech_ci NOT NULL,
  `smtpport` int(8) NOT NULL,
  `mailusername` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  `mailpassword` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  `setFrom` varchar(32) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pwdReset`
--

CREATE TABLE `pwdReset` (
  `id` int(11) NOT NULL,
  `pwdResetEmail` text COLLATE utf8mb4_czech_ci NOT NULL,
  `pwdResetSelector` text COLLATE utf8mb4_czech_ci NOT NULL,
  `pwdResetToken` longtext COLLATE utf8mb4_czech_ci NOT NULL,
  `pwdResetExpires` text COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(16) COLLATE utf8mb4_czech_ci NOT NULL,
  `rolenick` varchar(32) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subject` varchar(256) COLLATE utf8mb4_czech_ci NOT NULL,
  `text` varchar(2048) COLLATE utf8mb4_czech_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastEdited` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `assignedAgent` int(11) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_additional`
--

CREATE TABLE `tickets_additional` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `responseuserid` int(11) NOT NULL,
  `text` varchar(4096) COLLATE utf8mb4_czech_ci NOT NULL,
  `msgTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(128) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_czech_ci NOT NULL,
  `encPass` varchar(256) COLLATE utf8mb4_czech_ci NOT NULL,
  `usergroup` varchar(16) COLLATE utf8mb4_czech_ci NOT NULL,
  `birthDate` date NOT NULL,
  `registerTime` varchar(19) COLLATE utf8mb4_czech_ci NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `theme` varchar(8) COLLATE utf8mb4_czech_ci NOT NULL,
  `lang` varchar(8) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id_agent`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`flag_id`);

--
-- Indexes for table `phpmailer`
--
ALTER TABLE `phpmailer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdReset`
--
ALTER TABLE `pwdReset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_additional`
--
ALTER TABLE `tickets_additional`
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
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `flag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phpmailer`
--
ALTER TABLE `phpmailer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pwdReset`
--
ALTER TABLE `pwdReset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_additional`
--
ALTER TABLE `tickets_additional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
