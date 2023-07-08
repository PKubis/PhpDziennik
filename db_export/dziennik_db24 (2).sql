-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Cze 16, 2023 at 10:26 PM
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
-- Database: `dziennik_db24`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kartkowka`
--

CREATE TABLE `kartkowka` (
  `id` int(11) UNSIGNED NOT NULL,
  `ocena` int(11) DEFAULT NULL,
  `data_wystawienia` datetime NOT NULL DEFAULT current_timestamp(),
  `data_modyfikacji` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kartkowka`
--

INSERT INTO `kartkowka` (`id`, `ocena`, `data_wystawienia`, `data_modyfikacji`, `user_id`) VALUES
(9, 5, '2023-06-15 21:48:52', '2023-06-15 21:48:52', 9),
(10, 3, '2023-06-15 21:50:18', '2023-06-15 21:50:18', 10),
(11, 4, '2023-06-15 21:50:42', '2023-06-15 21:50:42', 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakty`
--

CREATE TABLE `kontakty` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kontakty`
--

INSERT INTO `kontakty` (`id`, `firstName`, `lastName`, `role_id`, `email`) VALUES
(7, 'Izabela', 'Kowal', 2, 'iza@wp.pl'),
(8, 'Ojciec', 'Dyrektor', 3, 'admin@wp.pl'),
(9, 'Adrian', 'Figiel', 1, 'adi@wp.pl'),
(10, 'Ada', 'Adkowska', 1, 'ada@wp.pl'),
(11, 'Tim', 'Burton', 1, 'tim@wp.pl');

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
(1, 10, 1, '::1', '2023-06-15 19:36:18'),
(2, 11, 1, '::1', '2023-06-15 20:26:24'),
(3, 11, 1, '::1', '2023-06-15 22:26:29'),
(4, 8, 1, '::1', '2023-06-16 18:04:38'),
(5, 7, 1, '127.0.0.1', '2023-06-16 19:31:54'),
(6, 12, 1, '127.0.0.1', '2023-06-16 20:06:50'),
(7, 7, 1, '127.0.0.1', '2023-06-16 20:07:18'),
(8, 7, 1, '127.0.0.1', '2023-06-16 20:52:59'),
(9, 12, 1, '127.0.0.1', '2023-06-16 21:06:49'),
(10, 9, 1, '127.0.0.1', '2023-06-16 21:33:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nauczyciele`
--

CREATE TABLE `nauczyciele` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `role_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nauczyciele`
--

INSERT INTO `nauczyciele` (`id`, `firstName`, `lastName`, `role_id`) VALUES
(7, 'Izabela', 'Kowal', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `new_uczen`
--

CREATE TABLE `new_uczen` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `role_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `new_uczen`
--

INSERT INTO `new_uczen` (`id`, `firstName`, `lastName`, `role_id`) VALUES
(1, 'Imię', 'Nazwisko', 1),
(2, 'Imię', 'Nazwisko', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedz`
--

CREATE TABLE `odpowiedz` (
  `id` int(11) UNSIGNED NOT NULL,
  `ocena` int(11) DEFAULT NULL,
  `data_wystawienia` datetime NOT NULL DEFAULT current_timestamp(),
  `data_modyfikacji` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `odpowiedz`
--

INSERT INTO `odpowiedz` (`id`, `ocena`, `data_wystawienia`, `data_modyfikacji`, `user_id`) VALUES
(9, 5, '2023-06-15 22:09:16', '2023-06-15 22:09:16', 9),
(10, 2, '2023-06-15 22:09:40', '2023-06-15 22:09:40', 10),
(11, 4, '2023-06-15 22:10:01', '2023-06-15 22:10:01', 11);

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
-- Struktura tabeli dla tabeli `sprawdzian`
--

CREATE TABLE `sprawdzian` (
  `id` int(11) UNSIGNED NOT NULL,
  `ocena` int(11) DEFAULT NULL,
  `data_wystawienia` datetime NOT NULL DEFAULT current_timestamp(),
  `data_modyfikacji` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sprawdzian`
--

INSERT INTO `sprawdzian` (`id`, `ocena`, `data_wystawienia`, `data_modyfikacji`, `user_id`) VALUES
(9, 5, '2023-06-15 22:10:19', '2023-06-15 22:10:19', 9),
(10, 2, '2023-06-15 22:10:46', '2023-06-15 22:10:46', 10),
(11, 4, '2023-06-15 22:11:06', '2023-06-15 22:11:06', 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczniowie`
--

CREATE TABLE `uczniowie` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `role_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uczniowie`
--

INSERT INTO `uczniowie` (`id`, `firstName`, `lastName`, `role_id`) VALUES
(9, 'Adrian', 'Figiel', 1),
(10, 'Ada', 'Adkowska', 1),
(11, 'Tim', 'Burton', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT 1,
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

INSERT INTO `users` (`id`, `email`, `role_id`, `firstName`, `lastName`, `birthday`, `password`, `logo`, `created_at`) VALUES
(7, 'iza@wp.pl', 2, 'Izabela', 'Kowal', '2000-02-02', '$argon2id$v=19$m=65536,t=4,p=1$RjZxNU9DNEdvV0dZL3Z4Zw$VmwdCmDg1vCcrjbIyT/5sc4WKCyE/d+zxjnJ7WGaPYo', '', '2023-06-13 21:44:53'),
(8, 'admin@wp.pl', 3, 'Ojciec', 'Dyrektor', '1900-06-01', '$argon2id$v=19$m=65536,t=4,p=1$c1l2eWFoVFI4aHR1dXRBVA$HquwCvSriUN6gEE3Mpth9+u8E6M38WXVGueNFLwuz/0', '', '2023-06-13 21:50:22'),
(9, 'adi@wp.pl', 1, 'Adrian', 'Figiel', '1988-03-16', '$argon2id$v=19$m=65536,t=4,p=1$cXdYajBBWDhTZ2JyUGxnMw$/XIGaS0A9vcg1bHw564TNHtWqP7X+QzGDGtNmu82RsE', '', '2023-06-13 22:30:52'),
(10, 'ada@wp.pl', 1, 'Ada', 'Adkowska', '2010-02-22', '$argon2id$v=19$m=65536,t=4,p=1$eWxhRFo3L1hhSXFEelB5eg$jeqpZEk4n6Ri/ABJOo8OjU4dEG/AqR5sXC2UUXHcmXY', '', '2023-06-15 19:36:04'),
(11, 'tim@wp.pl', 1, 'Tim', 'Burton', '2000-12-11', '$argon2id$v=19$m=65536,t=4,p=1$TG9hVFozY0FacHBHSEZnUQ$1gzH4MdznBDXIOlpNwPbZgr48cXMmUuqVw6P4Nfr+Go', '', '2023-06-15 20:26:15'),
(12, 'bak@wp.pl', 1, 'Marek', 'Bąk', '2012-12-12', '$argon2id$v=19$m=65536,t=4,p=1$R204SVBhOHIxSlJyVEZMeQ$WD4lvMl2E2LGGP48PCnpFhwQy0eRidt6Fn5FZTHGAA4', '', '2023-06-16 19:31:41');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wszystko`
--

CREATE TABLE `wszystko` (
  `id` int(11) UNSIGNED NOT NULL,
  `kartkowka` int(11) DEFAULT NULL,
  `sprawdzian` int(11) DEFAULT NULL,
  `odpowiedz` int(11) DEFAULT NULL,
  `srednia` decimal(5,2) DEFAULT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wszystko`
--

INSERT INTO `wszystko` (`id`, `kartkowka`, `sprawdzian`, `odpowiedz`, `srednia`, `firstName`, `lastName`, `user_id`) VALUES
(7, NULL, NULL, NULL, NULL, 'Izabela', 'Kowal', 7),
(8, NULL, NULL, NULL, NULL, 'Ojciec', 'Dyrektor', 8),
(9, 5, 5, 5, 5.00, 'Adrian', 'Figiel', 9),
(10, 3, 2, 2, 2.33, 'Ada', 'Adkowska', 10),
(11, 4, 4, 4, 4.00, 'Tim', 'Burton', 11);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kartkowka`
--
ALTER TABLE `kartkowka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `kontakty`
--
ALTER TABLE `kontakty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `nauczyciele`
--
ALTER TABLE `nauczyciele`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `new_uczen`
--
ALTER TABLE `new_uczen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `odpowiedz`
--
ALTER TABLE `odpowiedz`
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indeksy dla tabeli `sprawdzian`
--
ALTER TABLE `sprawdzian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `wszystko`
--
ALTER TABLE `wszystko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontakty`
--
ALTER TABLE `kontakty`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nauczyciele`
--
ALTER TABLE `nauczyciele`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `new_uczen`
--
ALTER TABLE `new_uczen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uczniowie`
--
ALTER TABLE `uczniowie`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wszystko`
--
ALTER TABLE `wszystko`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kartkowka`
--
ALTER TABLE `kartkowka`
  ADD CONSTRAINT `kartkowka_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kontakty`
--
ALTER TABLE `kontakty`
  ADD CONSTRAINT `kontakty_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `nauczyciele`
--
ALTER TABLE `nauczyciele`
  ADD CONSTRAINT `nauczyciele_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `new_uczen`
--
ALTER TABLE `new_uczen`
  ADD CONSTRAINT `new_uczen_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `odpowiedz`
--
ALTER TABLE `odpowiedz`
  ADD CONSTRAINT `odpowiedz_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sprawdzian`
--
ALTER TABLE `sprawdzian`
  ADD CONSTRAINT `sprawdzian_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD CONSTRAINT `uczniowie_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `wszystko`
--
ALTER TABLE `wszystko`
  ADD CONSTRAINT `wszystko_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
