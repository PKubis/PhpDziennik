-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Cze 14, 2023 at 07:58 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dziennik_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktywnosc`
--

CREATE TABLE `aktywnosc` (
                           `id` int(11) NOT NULL,
                           `kartkowka` double NOT NULL,
                           `sprawdzian` double NOT NULL,
                           `odpowiedz` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE `logs` (
                      `id` int(11) UNSIGNED NOT NULL,
                      `user_id` int(11) UNSIGNED NOT NULL,
                      `status` tinyint(1) NOT NULL,
                      `address_ip` varchar(15) NOT NULL,
                      `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `status`, `address_ip`, `created_at`) VALUES
                                                                             (23, 2, 0, '127.0.0.1', '2023-06-10 14:28:34'),
                                                                             (24, 4, 1, '127.0.0.1', '2023-06-12 18:15:12'),
                                                                             (25, 4, 1, '127.0.0.1', '2023-06-12 18:36:40'),
                                                                             (26, 4, 1, '127.0.0.1', '2023-06-13 18:01:51'),
                                                                             (27, 4, 0, '::1', '2023-06-13 20:20:00'),
                                                                             (28, 5, 1, '::1', '2023-06-13 20:30:12'),
                                                                             (29, 5, 1, '::1', '2023-06-13 20:31:28'),
                                                                             (30, 5, 1, '::1', '2023-06-13 20:44:10'),
                                                                             (31, 6, 1, '::1', '2023-06-13 20:49:30'),
                                                                             (32, 6, 1, '::1', '2023-06-13 20:49:49'),
                                                                             (33, 7, 1, '::1', '2023-06-13 21:45:45'),
                                                                             (34, 8, 1, '::1', '2023-06-13 21:50:30'),
                                                                             (35, 8, 1, '::1', '2023-06-13 21:52:15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
                       `id` int(11) NOT NULL,
                       `aktywnosc_id` int(11) NOT NULL,
                       `ocena` double DEFAULT NULL,
                       `data_wystawienia` datetime DEFAULT NULL,
                       `data_modyfikacji` datetime DEFAULT NULL,
                       `avg` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
                       `id` tinyint(4) NOT NULL,
                       `role` enum('uczen','nauczyciel','administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
                                     (1, 'uczen'),
                                     (2, 'nauczyciel'),
                                     (3, 'administrator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
                       `id` int(10) UNSIGNED NOT NULL,
                       `email` varchar(60) NOT NULL,
                       `role_id` tinyint(4) NOT NULL DEFAULT 1,
                       `ocena_id` int(11) DEFAULT NULL,
                       `firstName` varchar(30) NOT NULL,
                       `lastName` varchar(50) NOT NULL,
                       `birthday` date NOT NULL,
                       `password` varchar(100) NOT NULL,
                       `logo` varchar(100) NOT NULL,
                       `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `role_id`, `ocena_id`, `firstName`, `lastName`, `birthday`, `password`, `logo`, `created_at`) VALUES
                                                                                                                                    (7, 'iza@wp.pl', 2, 0, 'Izabela', 'Kowal', '2000-02-02', '$argon2id$v=19$m=65536,t=4,p=1$RjZxNU9DNEdvV0dZL3Z4Zw$VmwdCmDg1vCcrjbIyT/5sc4WKCyE/d+zxjnJ7WGaPYo', '', '2023-06-13 21:44:53'),
                                                                                                                                    (8, 'admin@wp.pl', 3, 0, 'Ojciec', 'Dyrektor', '1900-06-01', '$argon2id$v=19$m=65536,t=4,p=1$c1l2eWFoVFI4aHR1dXRBVA$HquwCvSriUN6gEE3Mpth9+u8E6M38WXVGueNFLwuz/0', '', '2023-06-13 21:50:22'),
                                                                                                                                    (9, 'adi@wp.pl', 1, 0, 'Adrian', 'Figiel', '1988-03-16', '$argon2id$v=19$m=65536,t=4,p=1$cXdYajBBWDhTZ2JyUGxnMw$/XIGaS0A9vcg1bHw564TNHtWqP7X+QzGDGtNmu82RsE', '', '2023-06-13 22:30:52');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aktywnosc`
--
ALTER TABLE `aktywnosc`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_aktywnosc_id` (`aktywnosc_id`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `ocena_id` (`ocena_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktywnosc`
--
ALTER TABLE `aktywnosc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`aktywnosc_id`) REFERENCES `aktywnosc` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
