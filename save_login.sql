-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 14 jun 2021 om 16:39
-- Serverversie: 5.5.68-MariaDB
-- PHP-versie: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `save_login`
--
CREATE DATABASE IF NOT EXISTS `save_login` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `save_login`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) DEFAULT NULL,
  `address` text,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) DEFAULT NULL,
  `access_code` text,
  `status` int(11) DEFAULT NULL COMMENT '0=pending,1=confirmed',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `access_level`, `access_code`, `status`, `created`, `modified`) VALUES
(41, NULL, NULL, 'm.kors@rocmn.nl', NULL, NULL, '$2y$10$KmATvFXJ3c8irN9i/e7W5.7fBPzLKHk2xgI.gkoTcqlRuP5dud3iG', NULL, NULL, 1, '2021-06-09 07:09:14', '2021-06-09 05:10:16'),
(42, NULL, NULL, 'mark.kors@gmail.com', NULL, NULL, '$2y$10$nBb2l9igUJHIg0DtuTnIh.PG2t.oNqoO92WTXqRzTRVn9ZqgQ5MG.', 'admin', NULL, 1, '2021-06-10 11:35:25', '2021-06-11 13:19:19');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_uindex` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
