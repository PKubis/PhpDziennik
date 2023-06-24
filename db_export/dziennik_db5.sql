-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Cze 15, 2023 at 07:45 PM
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
-- Database: `dziennik_db5`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktywnosci`
--

CREATE TABLE `aktywnosci` (
  `id` int(11) UNSIGNED NOT NULL,
  `uczen_id` int(11) UNSIGNED NOT NULL,
  `nauczyciel_id` int(11) UNSIGNED NOT NULL,
  `typ_aktywnosci` enum('kartkowka','sprawdzian','odpowiedz') NOT NULL,
  `ocena` int(11) DEFAULT NULL,
  `data_wystawienia` datetime NOT NULL DEFAULT current_timestamp(),
  `data_aktualizacji` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt_uczniowie`
--

CREATE TABLE `kontakt_uczniowie` (
  `id` int(11) UNSIGNED NOT NULL,
  `uczen_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE `login` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
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
-- Struktura tabeli dla tabeli `uczniowie`
--

CREATE TABLE `uczniowie` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `role_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(9, 'adi@wp.pl', 1, 'Adrian', 'Figiel', '1988-03-16', '$argon2id$v=19$m=65536,t=4,p=1$cXdYajBBWDhTZ2JyUGxnMw$/XIGaS0A9vcg1bHw564TNHtWqP7X+QzGDGtNmu82RsE', '', '2023-06-13 22:30:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wszystko`
--

CREATE TABLE `wszystko` (
  `id` int(11) UNSIGNED NOT NULL,
  `uczen_id` int(11) UNSIGNED NOT NULL,
  `kartkowka` int(11) DEFAULT NULL,
  `sprawdzian` int(11) DEFAULT NULL,
  `odpowiedz` int(11) DEFAULT NULL,
  `srednia` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aktywnosci`
--
ALTER TABLE `aktywnosci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uczen_id` (`uczen_id`),
  ADD KEY `nauczyciel_id` (`nauczyciel_id`);

--
-- Indeksy dla tabeli `kontakty`
--
ALTER TABLE `kontakty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `kontakt_uczniowie`
--
ALTER TABLE `kontakt_uczniowie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uczen_id` (`uczen_id`);

--
-- Indeksy dla tabeli `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

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
  ADD KEY `uczen_id` (`uczen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktywnosci`
--
ALTER TABLE `aktywnosci`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontakty`
--
ALTER TABLE `kontakty`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontakt_uczniowie`
--
ALTER TABLE `kontakt_uczniowie`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nauczyciele`
--
ALTER TABLE `nauczyciele`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_uczen`
--
ALTER TABLE `new_uczen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uczniowie`
--
ALTER TABLE `uczniowie`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wszystko`
--
ALTER TABLE `wszystko`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktywnosci`
--
ALTER TABLE `aktywnosci`
  ADD CONSTRAINT `aktywnosci_ibfk_1` FOREIGN KEY (`uczen_id`) REFERENCES `uczniowie` (`id`),
  ADD CONSTRAINT `aktywnosci_ibfk_2` FOREIGN KEY (`nauczyciel_id`) REFERENCES `nauczyciele` (`id`);

--
-- Constraints for table `kontakty`
--
ALTER TABLE `kontakty`
  ADD CONSTRAINT `kontakty_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `kontakt_uczniowie`
--
ALTER TABLE `kontakt_uczniowie`
  ADD CONSTRAINT `kontakt_uczniowie_ibfk_1` FOREIGN KEY (`uczen_id`) REFERENCES `uczniowie` (`id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `wszystko_ibfk_1` FOREIGN KEY (`uczen_id`) REFERENCES `uczniowie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
