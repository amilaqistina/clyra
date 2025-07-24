-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 10:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clyra1`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_name` varchar(100) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `club_name`, `status`) VALUES
(1, 2, 'AIS', 'Rejected'),
(2, 1, 'AIS', 'Approved'),
(3, 2, 'ENACTUS', 'Approved'),
(4, 2, 'MOBISM', 'Approved'),
(5, 7, 'HAC', 'Approved'),
(6, 6, 'ENACTUS', 'Approved'),
(7, 5, 'SISMA', 'Approved'),
(8, 5, 'PRIME MOVER', 'Rejected'),
(9, 5, 'DEBAT & PIDATO', 'Rejected'),
(10, 8, 'DEBAT & PIDATO', 'Approved'),
(11, 10, 'JPK TR', 'Approved'),
(12, 11, 'JPK TDM', 'Approved'),
(13, 11, 'SILAT CEKAK', 'Approved'),
(14, 12, 'JPK TR', 'Approved'),
(15, 13, 'SILAT CEKAK', 'Approved'),
(16, 15, 'JPK TAR', 'Approved'),
(17, 16, 'JPK THO', 'Approved'),
(18, 17, 'SILAT CEKAK', 'Approved'),
(19, 17, 'JPK NR', 'Approved'),
(20, 18, 'JPK DO', 'Approved'),
(21, 19, 'JPK THO', 'Approved'),
(22, 20, 'JPK THO', 'Approved'),
(23, 21, 'OMSA', 'Approved'),
(24, 1, 'MOBISM', 'Approved'),
(25, 24, 'SISMA', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `user_id`, `event_id`, `registered_at`, `status`) VALUES
(1, 1, 3, '2025-07-14 14:43:28', 'Approved'),
(2, 2, 1, '2025-07-14 16:15:30', 'Approved'),
(3, 7, 1, '2025-07-15 02:01:51', 'Approved'),
(4, 6, 3, '2025-07-15 02:02:31', 'Approved'),
(5, 5, 3, '2025-07-15 02:03:19', 'Approved'),
(6, 5, 2, '2025-07-15 02:33:43', 'Rejected'),
(7, 8, 1, '2025-07-15 03:58:31', 'Approved'),
(8, 10, 2, '2025-07-16 07:42:23', 'Approved'),
(9, 11, 3, '2025-07-16 07:45:47', 'Approved'),
(10, 12, 2, '2025-07-16 07:48:01', 'Approved'),
(11, 13, 2, '2025-07-16 07:50:02', 'Approved'),
(12, 14, 1, '2025-07-16 07:52:12', 'Approved'),
(13, 16, 3, '2025-07-16 07:56:57', 'Approved'),
(14, 22, 1, '2025-07-16 08:10:20', 'Approved'),
(15, 17, 5, '2025-07-16 15:34:11', 'Approved'),
(16, 18, 4, '2025-07-16 15:35:04', 'Approved'),
(17, 18, 6, '2025-07-16 15:35:26', 'Approved'),
(18, 19, 6, '2025-07-16 15:35:57', 'Approved'),
(19, 20, 2, '2025-07-16 15:36:48', 'Rejected'),
(20, 21, 2, '2025-07-16 15:37:16', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `role` enum('student','admin') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `student_id`, `email`, `phone`, `username`, `password`, `picture`, `role`) VALUES
(1, 'NIK AMILA QISTINA BINTI MOHAMMAD SAUFI', '2023213974', 'nikqistina27@gmail.com', '01110796813', 'Amila Qistina', '$2y$10$p18ege56ONPI2qAUmKH4lOsafcilnYf/xCOKbVagYgwi5e9XRQMxa', 'pic_68754222c76a3.jpeg', 'student'),
(2, 'NOR AININ SOFIYA BINTI MOHAMMAD SAUFI', '2022216625', 'norsofiya1@gmail.com', '01110746813', 'Ainin Sofiya', '$2y$10$.Gh1.iNVtydabPrRInrIveATEUNIEAljJy1lL0J/lDYMwTK6YLiey', 'pic_68752fcb55642.jpeg', 'student'),
(4, 'NURUL SHAMIMI ATHIRAH BINTI NORIZAL', '2023680766', 'shamimi03@gmail.com', '01131083585', 'Shamimi Athirah', '$2y$10$NF2Wat3mNHIDcBzmuSGcA.lwaix2Uhc7Hat8V5giqyVRxYYG7HmnS', 'pic_6875423eeb4cf.jpg', 'student'),
(5, 'FARAH HASINA BINTI ZAIDI', '2023298104', 'farahhasina@gmail.com', '0107627694', 'Farah Hasina', '$2y$10$S/H8OQ5DlTR4O1Nxfl9uEOBKcNmLaStTpLeUjf2OVZy7x7qWmmOIC', 'pic_6875b5aecb0f9.jpg', 'student'),
(6, 'NUR ALIS AQILAH BINTI ZAHARI', '2023492036', 'alis03@gmail.com', '01129204138', 'Alis Aqilah', '$2y$10$5uRed.X53Fsml0thXTfjGO6Y3EcBiXfUCvJr2nxSORyGVxQ9VY6By', 'pic_6875b61b50c96.jpg', 'student'),
(7, 'NURULNISA IMANINA BINTI ABDUL MUHAIMIN', '2023225656', 'nisa07@gmail.com', '0179629780', 'Nisa', '$2y$10$SHzXUh60F05C.lb3ahG7Hum09tkCVRtZICl5Shj9TDmm3U4Rm5EBe', 'pic_6875b66d968e8.jpg', 'student'),
(8, 'MUHAMMAD AFIQ BIN MD HUSIN', '2023239018', 'afiq00@gmail.com', '0185700465', 'Afiq ', '$2y$10$3wPI.9zCSXivkVIUwJXp9.dKlCUB7zNsFF6FZQonm0S1dLW0TT/PG', 'pic_6875d16bc3302.jpeg', 'student'),
(9, 'MUHAMAD AMAR BIN ZAINAL', '2023001567', 'amarzainal01@gmail.com', '0174567892', 'Amar', '$2y$10$1EndBJDAsryTKTtplCkBl.cSxNWwPB52E0nDEXTuSMMh3XALWsupG', 'pic_6877623a26a59.webp', 'student'),
(10, 'AHMAD FARIS BIN RAMLI', '2023002385', 'ahmadfaris@gmail.com', '0137853421', 'Ahmad Faris', '$2y$10$zNmbCA3971Vajrd6E1fTj.i2S7TR2fnLvYF94ZlMWmst93Vbh9fVi', 'pic_68776248bf8d3.png', 'student'),
(11, 'HAFIZUDDIN BIN ZULKIFLI', '2023003972', 'hafizzulkifli@gmail.com', '0112683947', 'Hafizuddin', '$2y$10$T7NKHnVUghe4AMwTze4Es.BtbSmoUOLrBEFRFk0uD0ACQ20VCG9ba', 'pic_6877627128397.jpg', 'student'),
(12, 'MUHAMMAD IRFAN BIN RAHMAT', '2024001283', 'irfanrahmat24@gmail.com', '0129372651', 'Irfan', '$2y$10$jR1Jr.GkF2yFlMb1ScN7nOqO0sjll6xsevX.lMFs9Y5o9VTsbMXdK', 'pic_687763024d874.jpg', 'student'),
(13, 'DANIAL HAKIM BIN ABDULLAH', '2024002448', 'danialhakim@gmail.com', '0105281930', 'Danial Hakim', '$2y$10$GrimNjzrHoQnIDNVDKYr2./8IDyd7ZFJ0kis4R6iAWMhqLKg6ivUS', 'pic_68776398169f4.jpg', 'student'),
(14, 'MOHD FAIZ BIN HASSAN', '2024003069', 'faiz92@gmail.com', '0164728610', 'Faiz', '$2y$10$/uIM8s.lpzXZ2.K3pF8sS.ttfO2wDr5fyPZRUOZ2uwwVifwQEb666', 'pic_687763a5e8d99.jpg', 'student'),
(15, 'SITI ZULAIKHA BINTI SYED ZAMRI', '2023001883', 'zulaikha12@gmail.com', '0147652193', 'Siti Zulaikha', '$2y$10$al8Dk5MqoPHNpJMNoswwj.irTFZ3CxNG.wZmLF9ZEoB1TOjwAySTO', 'pic_687764601544c.jpg', 'student'),
(16, 'NUR AISYAH BINTI ZAKARIA', '2023002574', 'aisyahzakaria01@gmail.com', '0183856210', 'Aisyah', '$2y$10$l9x5MxY9cP1yMLjW.kuECOUErPiCODgEPGW1LuGlul.2gMh.qn5CO', 'pic_687764720e223.jpg', 'student'),
(17, 'NURUL IMAN BIN HAMDAN', '2023003912', 'imanhamdan@gmail.com', '0197341280', 'Nurul Iman', '$2y$10$pS25BUeGxGkNe/h01ysNa.A/QyWlSw/3sbH5i8caXuPVNJyFe1Iyq', 'pic_687764835b28a.jpg', 'student'),
(18, 'AINA SOFEA BINTI JAMALUDDIN', '2023004768', 'ainasofea@gmail.com', '0115629402', 'Aina Sofea', '$2y$10$OVUOfbDiE8zWXf1i/DS2h.Yfu/p//mUqahBBqYpMNU8zwKYdZGkgy', 'pic_687764d5f2db8.jpg', 'student'),
(19, 'BALQIS NAJIHA BINTI ROSLAN', '2024001029', 'balqisnajihah07@gmail.com', '0176497238', 'Balqis Najihah', '$2y$10$pLqJc4MlrfZa4YXiCRgmPO.Ut/rZ/Fg49DTW1iT9Y7bDLUuUzWQB6', 'pic_6877661b31127.jpg', 'student'),
(20, 'NURSYAFIQAH BINTI MOHD RIZAL', '2024002184', 'syafiqahrizal@gmail.com', '0139087356', 'Nursyafiqah', '$2y$10$Ihn1T/SbUOtI6EqwWrOYbeVZPt2ZNWIezuJKTA4yudYUg662XbquC', 'pic_6877658109bdb.png', 'student'),
(21, 'WAN NUR AMIRAH BINTI FAIZAL', '2024003047', 'wanamirah05@gmail.com', '0128345701', 'Nur Amirah', '$2y$10$gzlRzYSQPFLDMMqM76NHM.Rm9lgI5Ft6dsDiNpUN6zAG95i/df9qW', 'pic_6877663455128.jpg', 'student'),
(22, 'NABILA SYAHIRAH BINTI AHMAD ', '2024003650', 'nabila06@gmail.com', '0162956743', 'Nabila Syahirah', '$2y$10$eltcP7xsJey8aB5IV9PHJOYzz/OT2Ew.glJTlFUEDCdwAjgA9o1.e', 'pic_6877667dd6bbf.jpg', 'student'),
(23, 'FARAH DINA BINTI SHAHRUL', '2024004291', 'farahdina@gmail.com', '0187624910', 'Farah Dina', '$2y$10$MfjifVDuo1DN.vKmwuwXHe16UJ44imkkogz9NvD81FGzpIw6ygmda', 'pic_6877668da1d76.jpg', 'student'),
(24, 'Nurul Izzaati binti Yusoff', '2023299688', 'izzati@gmail.com', '01110786512', 'Izzati', '$2y$10$8dU/ufnN80eMCjUqmYYCc.sNqS.wsYuYKFzehmm/FtaD25.HmqoIK', 'pic_6881c5e8db7b9.jpeg', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
