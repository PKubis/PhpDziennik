-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Cze 2023, 17:48
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dziennik_db25`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kartkowka`
--

CREATE TABLE `kartkowka` (
                           `id` int(11) NOT NULL,
                           `ocena` int(11) DEFAULT NULL,
                           `data_wystawienia` datetime NOT NULL DEFAULT current_timestamp(),
                           `data_modyfikacji` datetime NOT NULL DEFAULT current_timestamp(),
                           `user_id` int(10) UNSIGNED DEFAULT NULL
) ;

--
-- Zrzut danych tabeli `kartkowka`
--

INSERT INTO `kartkowka` (`id`, `ocena`, `data_wystawienia`, `data_modyfikacji`, `user_id`) VALUES
                                                                                             (10, 5, '2023-06-15 21:50:18', '2023-06-15 21:50:18', 10),
                                                                                             (120, 1, '2023-06-24 19:24:10', '2023-06-24 19:24:10', 168),
                                                                                             (121, 1, '2023-06-24 19:55:57', '2023-06-24 19:55:57', 169),
                                                                                             (123, 1, '2023-06-25 06:25:56', '2023-06-25 06:25:56', 171),
                                                                                             (124, 2, '2023-06-25 06:29:10', '2023-06-25 06:29:10', 172),
                                                                                             (125, 3, '2023-06-25 08:30:26', '2023-06-25 08:30:26', 173),
                                                                                             (126, 5, '2023-06-25 09:55:45', '2023-06-25 09:55:45', 174),
                                                                                             (128, NULL, '2023-06-26 17:34:51', '2023-06-26 17:34:51', 176),
                                                                                             (129, NULL, '2023-06-26 17:35:49', '2023-06-26 17:35:49', 177);

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
-- Zrzut danych tabeli `kontakty`
--

INSERT INTO `kontakty` (`id`, `firstName`, `lastName`, `role_id`, `email`) VALUES
                                                                             (7, 'Izabela', 'Kowal', 2, 'iza@wp.pl'),
                                                                             (8, 'Ojciec', 'Dyrektor', 3, 'admin@wp.pl');

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
-- Zrzut danych tabeli `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `status`, `address_ip`, `created_at`) VALUES
                                                                             (7, 7, 1, '127.0.0.1', '2023-06-16 20:07:18'),
                                                                             (8, 7, 1, '127.0.0.1', '2023-06-16 20:52:59'),
                                                                             (26, 8, 1, '::1', '2023-06-23 11:44:42'),
                                                                             (27, 7, 0, '::1', '2023-06-23 12:27:10'),
                                                                             (28, 7, 1, '::1', '2023-06-23 12:27:21'),
                                                                             (29, 7, 1, '::1', '2023-06-23 12:52:29'),
                                                                             (30, 7, 1, '::1', '2023-06-23 13:06:37'),
                                                                             (31, 7, 1, '::1', '2023-06-23 13:11:18'),
                                                                             (32, 7, 1, '::1', '2023-06-23 15:49:43'),
                                                                             (33, 7, 1, '::1', '2023-06-23 16:04:00'),
                                                                             (34, 8, 1, '::1', '2023-06-23 16:15:13'),
                                                                             (36, 7, 1, '::1', '2023-06-23 16:26:48'),
                                                                             (37, 7, 1, '::1', '2023-06-23 21:02:00'),
                                                                             (38, 7, 1, '::1', '2023-06-24 06:51:33'),
                                                                             (39, 7, 1, '::1', '2023-06-24 07:15:58'),
                                                                             (40, 8, 1, '::1', '2023-06-24 07:16:34'),
                                                                             (41, 7, 1, '::1', '2023-06-24 07:17:21'),
                                                                             (42, 7, 1, '::1', '2023-06-24 07:27:57'),
                                                                             (43, 8, 1, '::1', '2023-06-24 07:36:29'),
                                                                             (44, 7, 1, '::1', '2023-06-24 07:38:10'),
                                                                             (45, 7, 1, '::1', '2023-06-24 07:38:38'),
                                                                             (46, 7, 1, '::1', '2023-06-24 07:52:13'),
                                                                             (47, 7, 1, '::1', '2023-06-24 08:02:06'),
                                                                             (48, 7, 1, '::1', '2023-06-24 09:05:23'),
                                                                             (49, 7, 1, '::1', '2023-06-24 09:26:45'),
                                                                             (50, 7, 1, '::1', '2023-06-24 10:11:54'),
                                                                             (51, 7, 1, '::1', '2023-06-24 10:14:07'),
                                                                             (52, 7, 1, '::1', '2023-06-24 10:27:16'),
                                                                             (53, 7, 1, '::1', '2023-06-24 10:42:48'),
                                                                             (54, 7, 1, '::1', '2023-06-24 10:57:11'),
                                                                             (55, 7, 1, '::1', '2023-06-24 11:05:02'),
                                                                             (56, 7, 1, '::1', '2023-06-24 11:13:39'),
                                                                             (57, 7, 1, '::1', '2023-06-24 11:43:59'),
                                                                             (58, 7, 1, '::1', '2023-06-24 11:49:16'),
                                                                             (59, 7, 1, '::1', '2023-06-24 12:08:38'),
                                                                             (60, 7, 1, '::1', '2023-06-24 12:28:36'),
                                                                             (61, 7, 1, '::1', '2023-06-24 12:41:55'),
                                                                             (62, 7, 1, '::1', '2023-06-24 12:46:41'),
                                                                             (63, 7, 1, '::1', '2023-06-24 12:49:02'),
                                                                             (64, 7, 1, '::1', '2023-06-24 13:10:00'),
                                                                             (65, 7, 1, '::1', '2023-06-24 13:11:13'),
                                                                             (66, 7, 1, '::1', '2023-06-24 13:20:00'),
                                                                             (67, 7, 1, '::1', '2023-06-24 13:39:49'),
                                                                             (68, 7, 0, '::1', '2023-06-24 13:44:37'),
                                                                             (69, 7, 1, '::1', '2023-06-24 13:44:47'),
                                                                             (70, 7, 0, '::1', '2023-06-24 14:01:28'),
                                                                             (71, 7, 1, '::1', '2023-06-24 14:01:37'),
                                                                             (72, 7, 1, '::1', '2023-06-24 14:16:53'),
                                                                             (74, 8, 1, '::1', '2023-06-24 15:38:52'),
                                                                             (75, 7, 1, '::1', '2023-06-24 15:39:10'),
                                                                             (76, 7, 1, '::1', '2023-06-24 15:39:11'),
                                                                             (77, 7, 1, '::1', '2023-06-24 16:32:54'),
                                                                             (78, 7, 1, '::1', '2023-06-24 16:35:31'),
                                                                             (79, 8, 1, '::1', '2023-06-24 16:37:17'),
                                                                             (80, 7, 1, '::1', '2023-06-24 16:37:51'),
                                                                             (81, 7, 1, '::1', '2023-06-24 16:39:13'),
                                                                             (82, 7, 1, '::1', '2023-06-24 16:40:58'),
                                                                             (83, 7, 1, '::1', '2023-06-24 17:00:57'),
                                                                             (84, 7, 1, '::1', '2023-06-24 17:45:03'),
                                                                             (85, 7, 1, '::1', '2023-06-24 18:17:30'),
                                                                             (86, 7, 1, '::1', '2023-06-24 18:39:03'),
                                                                             (87, 7, 1, '::1', '2023-06-24 18:56:06'),
                                                                             (88, 8, 1, '::1', '2023-06-24 19:17:31'),
                                                                             (89, 7, 1, '::1', '2023-06-24 19:19:07'),
                                                                             (90, 7, 1, '::1', '2023-06-24 19:19:42'),
                                                                             (91, 7, 1, '::1', '2023-06-25 06:26:14'),
                                                                             (92, 7, 1, '::1', '2023-06-25 07:44:09'),
                                                                             (93, 7, 1, '::1', '2023-06-25 07:53:07'),
                                                                             (94, 7, 1, '::1', '2023-06-25 07:57:03'),
                                                                             (95, 7, 1, '::1', '2023-06-25 07:59:27'),
                                                                             (96, 7, 1, '::1', '2023-06-25 08:00:54'),
                                                                             (97, 7, 1, '::1', '2023-06-25 08:10:08'),
                                                                             (98, 7, 1, '::1', '2023-06-25 08:15:36'),
                                                                             (99, 7, 1, '::1', '2023-06-25 08:22:07'),
                                                                             (100, 7, 1, '::1', '2023-06-25 09:34:41'),
                                                                             (101, 7, 1, '::1', '2023-06-25 10:20:08'),
                                                                             (102, 7, 1, '::1', '2023-06-25 10:50:40'),
                                                                             (103, 7, 1, '::1', '2023-06-25 12:40:48'),
                                                                             (104, 7, 1, '::1', '2023-06-25 20:59:02'),
                                                                             (105, 7, 1, '::1', '2023-06-26 17:32:19'),
                                                                             (106, 7, 1, '::1', '2023-06-26 17:33:45');

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
-- Zrzut danych tabeli `nauczyciele`
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
-- Zrzut danych tabeli `new_uczen`
--

INSERT INTO `new_uczen` (`id`, `firstName`, `lastName`, `role_id`) VALUES
                                                                     (1, 'Imię', 'Nazwisko', 1),
                                                                     (2, 'Imię', 'Nazwisko', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedz`
--

CREATE TABLE `odpowiedz` (
                           `id` int(11) NOT NULL,
                           `ocena` int(11) DEFAULT NULL,
                           `data_wystawienia` datetime NOT NULL DEFAULT current_timestamp(),
                           `data_modyfikacji` datetime NOT NULL DEFAULT current_timestamp(),
                           `user_id` int(10) UNSIGNED DEFAULT NULL
) ;

--
-- Zrzut danych tabeli `odpowiedz`
--

INSERT INTO `odpowiedz` (`id`, `ocena`, `data_wystawienia`, `data_modyfikacji`, `user_id`) VALUES
                                                                                             (24, 5, '2023-06-23 09:23:57', '2023-06-23 09:23:57', 10),
                                                                                             (84, 1, '2023-06-24 19:24:10', '2023-06-24 19:24:10', 168),
                                                                                             (85, 1, '2023-06-24 19:55:57', '2023-06-24 19:55:57', 169),
                                                                                             (87, 1, '2023-06-25 06:25:56', '2023-06-25 06:25:56', 171),
                                                                                             (88, 2, '2023-06-25 06:29:11', '2023-06-25 06:29:11', 172),
                                                                                             (89, 3, '2023-06-25 08:30:26', '2023-06-25 08:30:26', 173),
                                                                                             (90, 5, '2023-06-25 09:55:45', '2023-06-25 09:55:45', 174),
                                                                                             (92, NULL, '2023-06-26 17:34:52', '2023-06-26 17:34:52', 176),
                                                                                             (93, NULL, '2023-06-26 17:35:49', '2023-06-26 17:35:49', 177);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
                       `id` tinyint(4) NOT NULL,
                       `role` enum('uczen','nauczyciel','administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `roles`
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
                            `id` int(11) NOT NULL,
                            `ocena` int(11) DEFAULT NULL,
                            `data_wystawienia` datetime NOT NULL DEFAULT current_timestamp(),
                            `data_modyfikacji` datetime NOT NULL DEFAULT current_timestamp(),
                            `user_id` int(10) UNSIGNED DEFAULT NULL
) ;

--
-- Zrzut danych tabeli `sprawdzian`
--

INSERT INTO `sprawdzian` (`id`, `ocena`, `data_wystawienia`, `data_modyfikacji`, `user_id`) VALUES
                                                                                              (10, 5, '2023-06-15 22:10:46', '2023-06-15 22:10:46', 10),
                                                                                              (69, 1, '2023-06-24 19:24:10', '2023-06-24 19:24:10', 168),
                                                                                              (70, 1, '2023-06-24 19:55:57', '2023-06-24 19:55:57', 169),
                                                                                              (72, 1, '2023-06-25 06:25:56', '2023-06-25 06:25:56', 171),
                                                                                              (73, 2, '2023-06-25 06:29:11', '2023-06-25 06:29:11', 172),
                                                                                              (74, 3, '2023-06-25 08:30:26', '2023-06-25 08:30:26', 173),
                                                                                              (75, 5, '2023-06-25 09:55:45', '2023-06-25 09:55:45', 174),
                                                                                              (77, NULL, '2023-06-26 17:34:52', '2023-06-26 17:34:52', 176),
                                                                                              (78, NULL, '2023-06-26 17:35:49', '2023-06-26 17:35:49', 177);

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
-- Zrzut danych tabeli `uczniowie`
--

INSERT INTO `uczniowie` (`id`, `firstName`, `lastName`, `role_id`) VALUES
  (10, 'Ada', 'Adkowska', 1);

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
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `role_id`, `firstName`, `lastName`, `birthday`, `password`, `logo`, `created_at`) VALUES
                                                                                                                        (7, 'iza@wp.pl', 2, 'Izabela', 'Kowal', '2000-02-02', '$argon2id$v=19$m=65536,t=4,p=1$RjZxNU9DNEdvV0dZL3Z4Zw$VmwdCmDg1vCcrjbIyT/5sc4WKCyE/d+zxjnJ7WGaPYo', '', '2023-06-13 21:44:53'),
                                                                                                                        (8, 'admin@wp.pl', 3, 'Ojciec', 'Dyrektor', '1900-06-01', '$argon2id$v=19$m=65536,t=4,p=1$c1l2eWFoVFI4aHR1dXRBVA$HquwCvSriUN6gEE3Mpth9+u8E6M38WXVGueNFLwuz/0', '', '2023-06-13 21:50:22'),
                                                                                                                        (10, 'daria1@wp.pl', 1, 'Daria', 'Sikorska', '2010-02-22', '$argon2id$v=19$m=65536,t=4,p=1$eWxhRFo3L1hhSXFEelB5eg$jeqpZEk4n6Ri/ABJOo8OjU4dEG/AqR5sXC2UUXHcmXY', '', '2023-06-15 19:36:04'),
                                                                                                                        (168, 'aaa11@wp.pl', 1, 'q', 'q', '0000-00-00', '$2y$10$Pnj.FraonJlEmchnhuaZveR3NtxJOoUO1cC5oAURkrHbLyTCSyAGe', '', '2023-06-24 19:24:10'),
                                                                                                                        (169, 'piotrkubis1989@gmail.com', 1, 'piotr', 'kubis', '0000-00-00', '$2y$10$TiQNMCZaAl.pq.CWanlbfun9vNfoGsDH9P2j47pCenJE1jZRHu7aG', '', '2023-06-24 19:55:57'),
                                                                                                                        (171, 'aaa@o2.pl', 1, 'aaa', 'aaa', '0000-00-00', '$2y$10$JGxHWbfYV5AiiSxX9bPmi.6vUGyCnXPoUBAWezYJGkci8x9.f2rRG', '', '2023-06-25 06:25:54'),
                                                                                                                        (172, 'bbb@wp.pl', 1, 'bbb', 'bbb', '0000-00-00', '$2y$10$0M94.vIJFIK92S29ZOJxN.0Oxc9OQUZJ1qa06XTW2LiTScjA.2aci', '', '2023-06-25 06:29:10'),
                                                                                                                        (173, 'ccc@wp.pl', 1, 'ccc', 'ccc', '0000-00-00', '$2y$10$2/WqvDJwqO45d.34mfD9qegzV7bb8b/6kW9gGFo2vVYWsxYfwN1Ki', '', '2023-06-25 08:30:26'),
                                                                                                                        (174, 'ddd@wp.pol', 1, 'ddd', 'ddd', '0000-00-00', '$2y$10$F2cKrVRitavTC1BY4dfSIOUp/CfBgh5U2TTyRmAEhSsHUkpRsjIeS', '', '2023-06-25 09:55:45'),
                                                                                                                        (176, 'marcin.kuras@poczta.onet.pl', 1, 'Marcin ', 'Kreatyński', '0000-00-00', '$2y$10$DWnJGDs0nSu5qkvX8S9N2uR49l7FhlD2KSajeNdJiDlpG1mKcPjne', '', '2023-06-26 17:34:51'),
                                                                                                                        (177, 'izabelakozibura@gmail.com', 1, 'Izabela', 'Bliźniak', '0000-00-00', '$2y$10$GRI5t6QXyP7CHSziUf/XAewzSqVK3TtYLpnYyQeDTDmBAuSRXXVNa', '', '2023-06-26 17:35:49');

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
-- Zrzut danych tabeli `wszystko`
--

INSERT INTO `wszystko` (`id`, `kartkowka`, `sprawdzian`, `odpowiedz`, `srednia`, `firstName`, `lastName`, `user_id`) VALUES
                                                                                                                       (7, NULL, NULL, NULL, NULL, 'Izabela', 'Kowal', 7),
                                                                                                                       (8, NULL, NULL, NULL, NULL, 'Ojciec', 'Dyrektor', 8),
                                                                                                                       (10, 3, 2, 2, '2.33', 'Ada', 'Adkowska', 10);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kartkowka`
--
ALTER TABLE `kartkowka`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
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
  ADD PRIMARY KEY (`id`),
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
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `wszystko`
--
ALTER TABLE `wszystko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kartkowka`
--
ALTER TABLE `kartkowka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kontakty`
--
ALTER TABLE `kontakty`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT dla tabeli `nauczyciele`
--
ALTER TABLE `nauczyciele`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `new_uczen`
--
ALTER TABLE `new_uczen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `odpowiedz`
--
ALTER TABLE `odpowiedz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `sprawdzian`
--
ALTER TABLE `sprawdzian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT dla tabeli `wszystko`
--
ALTER TABLE `wszystko`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kartkowka`
--
ALTER TABLE `kartkowka`
  ADD CONSTRAINT `kartkowka_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kartkowka_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `kontakty`
--
ALTER TABLE `kontakty`
  ADD CONSTRAINT `kontakty_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ograniczenia dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `nauczyciele`
--
ALTER TABLE `nauczyciele`
  ADD CONSTRAINT `nauczyciele_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ograniczenia dla tabeli `new_uczen`
--
ALTER TABLE `new_uczen`
  ADD CONSTRAINT `new_uczen_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ograniczenia dla tabeli `odpowiedz`
--
ALTER TABLE `odpowiedz`
  ADD CONSTRAINT `odpowiedz_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `odpowiedz_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `sprawdzian`
--
ALTER TABLE `sprawdzian`
  ADD CONSTRAINT `sprawdzian_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sprawdzian_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD CONSTRAINT `uczniowie_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ograniczenia dla tabeli `wszystko`
--
ALTER TABLE `wszystko`
  ADD CONSTRAINT `wszystko_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
