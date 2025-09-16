-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 05:00 PM
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
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `status` enum('available','booked','maintenance') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `room_id`, `type_id`, `service_id`, `check_in`, `check_out`, `status`) VALUES
(156, 52, 161, 2, 4, '2025-09-18', '2025-09-19', 'booked'),
(157, 55, 168, 3, 3, '2025-09-14', '2025-09-17', 'booked'),
(158, 98, 125, 2, 3, '2025-09-14', '2025-09-18', 'booked'),
(159, 108, 136, 3, 2, '2025-09-20', '2025-09-23', 'booked'),
(160, 56, 157, 2, 1, '2025-09-19', '2025-09-22', 'booked'),
(162, 73, 147, 1, 1, '2025-09-17', '2025-09-20', 'booked'),
(163, 68, 154, 2, 2, '2025-09-17', '2025-09-21', 'booked'),
(164, 51, 158, 2, 3, '2025-09-15', '2025-09-16', 'booked'),
(165, 60, 114, 1, 4, '2025-09-14', '2025-09-18', 'booked'),
(166, 106, 165, 3, 3, '2025-09-19', '2025-09-21', 'booked'),
(167, 97, 166, 3, 3, '2025-09-19', '2025-09-23', 'booked'),
(168, 70, 155, 2, 4, '2025-09-18', '2025-09-22', 'booked'),
(169, 93, 133, 3, 2, '2025-09-23', '2025-09-26', 'booked'),
(170, 84, 164, 3, 2, '2025-09-17', '2025-09-19', 'booked'),
(171, 87, 135, 3, 4, '2025-09-22', '2025-09-26', 'booked'),
(172, 91, 126, 2, 3, '2025-09-16', '2025-09-19', 'booked'),
(173, 78, 163, 3, 4, '2025-09-13', '2025-09-16', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` enum('available','booked','maintenance') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `type_id`, `status`) VALUES
(113, '101', 1, 'available'),
(114, '102', 1, 'booked'),
(115, '103', 1, 'available'),
(116, '104', 1, 'available'),
(117, '105', 1, 'available'),
(118, '106', 1, 'available'),
(119, '107', 1, 'available'),
(120, '108', 1, 'available'),
(121, '109', 1, 'available'),
(122, '110', 1, 'available'),
(123, '201', 2, 'available'),
(124, '202', 2, 'available'),
(125, '203', 2, 'booked'),
(126, '204', 2, 'booked'),
(127, '205', 2, 'available'),
(128, '206', 2, 'available'),
(129, '207', 2, 'available'),
(130, '208', 2, 'available'),
(131, '209', 2, 'available'),
(132, '210', 2, 'available'),
(133, '301', 3, 'booked'),
(134, '302', 3, 'available'),
(135, '303', 3, 'booked'),
(136, '304', 3, 'booked'),
(137, '305', 3, 'available'),
(138, '306', 3, 'booked'),
(139, '307', 3, 'available'),
(140, '308', 3, 'available'),
(141, '309', 3, 'available'),
(142, '310', 3, 'available'),
(143, '111', 1, 'available'),
(144, '112', 1, 'available'),
(145, '113', 1, 'available'),
(146, '114', 1, 'available'),
(147, '115', 1, 'booked'),
(148, '116', 1, 'available'),
(149, '117', 1, 'available'),
(150, '118', 1, 'available'),
(151, '119', 1, 'available'),
(152, '120', 1, 'available'),
(153, '211', 2, 'available'),
(154, '212', 2, 'booked'),
(155, '213', 2, 'booked'),
(156, '214', 2, 'available'),
(157, '215', 2, 'booked'),
(158, '216', 2, 'booked'),
(159, '217', 2, 'available'),
(160, '218', 2, 'available'),
(161, '219', 2, 'booked'),
(162, '220', 2, 'available'),
(163, '311', 3, 'booked'),
(164, '312', 3, 'booked'),
(165, '313', 3, 'booked'),
(166, '314', 3, 'booked'),
(167, '315', 3, 'available'),
(168, '316', 3, 'booked'),
(169, '317', 3, 'available'),
(171, '319', 3, 'booked'),
(172, '320', 3, 'available'),
(173, '318', 3, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price_per_night` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`type_id`, `type_name`, `description`, `price_per_night`) VALUES
(1, 'Standard', 'Standard room with basic amenities', 1200.00),
(2, 'Deluxe', 'Deluxe room with sea view', 2500.00),
(3, 'Suite', 'Luxury suite with living area and premium services', 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `price`) VALUES
(1, 'Breakfast Buffet', 'บุฟเฟต์อาหารเช้า', 250.00),
(2, 'Airport Shuttle', 'บริการรถรับ-ส่งสนามบิน', 500.00),
(3, 'Spa & Massage', 'บริการสปาและนวดแผนไทย', 1200.00),
(4, 'Laundry Service', 'บริการซักรีดเสื้อผ้า', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`) VALUES
(1, 'Admin', 'System', 'admin@hotel.com', '1234', '0800000000'),
(2, 'Somchai', 'Prasert', 'somchai@example.com', '0811111111', '0811111111'),
(3, 'Somsri', 'Wong', 'somsri@example.com', '0822222222', '0822222222'),
(4, 'Anan', 'Phan', 'anan@example.com', '0833333333', '0833333333'),
(5, 'Suda', 'Thong', 'suda@example.com', '0844444444', '0844444444'),
(6, 'Prasit', 'Korn', 'prasit@example.com', '0855555555', '0855555555'),
(7, 'Alex', 'Carter', 'alex@example.com', '0866666666', '0866666666'),
(8, 'P', 'W', 'littlepakan@gmail.com', '123', '0912223333'),
(35, 'สมชาย', 'พูนสุข', 'somchai.poonsuk@example.com', 'pass001', '0810000001'),
(36, 'สมหญิง', 'ศรีวงศ์', 'somying.sriwong@example.com', 'pass002', '0810000002'),
(37, 'อนันต์', 'พรหมมา', 'anan.phromma@example.com', 'pass003', '0810000003'),
(38, 'สุดา', 'ทองดี', 'suda.thongdee@example.com', 'pass004', '0810000004'),
(39, 'ประสิทธิ์', 'กาญจนา', 'prasit.kanjana@example.com', 'pass005', '0810000005'),
(40, 'วิชัย', 'คงเดช', 'wichai.kongdej@example.com', 'pass006', '0810000006'),
(41, 'มนัส', 'สุวรรณ', 'manas.suwan@example.com', 'pass007', '0810000007'),
(42, 'นฤมล', 'อินทร์แก้ว', 'naruemon.inkaew@example.com', 'pass008', '0810000008'),
(43, 'สุชาติ', 'อมรชัย', 'suchart.amornchai@example.com', 'pass009', '0810000009'),
(44, 'พิมพ์ใจ', 'โชคดี', 'pimjai.chokdee@example.com', 'pass010', '0810000010'),
(45, 'John', 'Smith', 'john.smith@example.com', 'pass011', '0810000011'),
(46, 'Emily', 'Johnson', 'emily.johnson@example.com', 'pass012', '0810000012'),
(47, 'Michael', 'Brown', 'michael.brown@example.com', 'pass013', '0810000013'),
(48, 'Sarah', 'Williams', 'sarah.williams@example.com', 'pass014', '0810000014'),
(49, 'Daniel', 'Miller', 'daniel.miller@example.com', 'pass015', '0810000015'),
(50, 'Jessica', 'Taylor', 'jessica.taylor@example.com', 'pass016', '0810000016'),
(51, 'David', 'Anderson', 'david.anderson@example.com', 'pass017', '0810000017'),
(52, 'Laura', 'Martinez', 'laura.martinez@example.com', 'pass018', '0810000018'),
(53, 'James', 'Lee', 'james.lee@example.com', 'pass019', '0810000019'),
(54, 'Sophia', 'Davis', 'sophia.davis@example.com', 'pass020', '0810000020'),
(55, 'ธีรศักดิ์', 'วัฒนกิจ', 'teerasak.wattanakit@example.com', 'pass021', '0810000021'),
(56, 'จิราภรณ์', 'พงษ์สวัสดิ์', 'jiraporn.pongsawat@example.com', 'pass022', '0810000022'),
(57, 'อรุณี', 'บำรุงสุข', 'arunee.bumrungsuk@example.com', 'pass023', '0810000023'),
(58, 'เกรียงไกร', 'ศรีสุข', 'kriangkrai.srisuk@example.com', 'pass024', '0810000024'),
(59, 'วัฒนา', 'อินทร', 'watthana.in@example.com', 'pass025', '0810000025'),
(60, 'อมรชัย', 'ชัยศรี', 'amornchai.chaisri@example.com', 'pass026', '0810000026'),
(61, 'นงนุช', 'วงษ์ดี', 'nongnuch.wongdee@example.com', 'pass027', '0810000027'),
(62, 'กิตติพงษ์', 'สุนทร', 'kittipong.suntorn@example.com', 'pass028', '0810000028'),
(63, 'ศิริพร', 'บุญมา', 'siriporn.boonma@example.com', 'pass029', '0810000029'),
(64, 'ปรีชา', 'มงคลชัย', 'pricha.mongkolchai@example.com', 'pass030', '0810000030'),
(65, 'Andrew', 'Wilson', 'andrew.wilson@example.com', 'pass031', '0810000031'),
(66, 'Olivia', 'Moore', 'olivia.moore@example.com', 'pass032', '0810000032'),
(67, 'Benjamin', 'Hall', 'benjamin.hall@example.com', 'pass033', '0810000033'),
(68, 'Hannah', 'Scott', 'hannah.scott@example.com', 'pass034', '0810000034'),
(69, 'William', 'Adams', 'william.adams@example.com', 'pass035', '0810000035'),
(70, 'Chloe', 'Turner', 'chloe.turner@example.com', 'pass036', '0810000036'),
(71, 'Matthew', 'Harris', 'matthew.harris@example.com', 'pass037', '0810000037'),
(72, 'Grace', 'White', 'grace.white@example.com', 'pass038', '0810000038'),
(73, 'Christopher', 'Young', 'christopher.young@example.com', 'pass039', '0810000039'),
(74, 'Natalie', 'King', 'natalie.king@example.com', 'pass040', '0810000040'),
(75, 'จารุวรรณ', 'คำดี', 'jaruwan.kamdee@example.com', 'pass041', '0810000041'),
(76, 'ภัทรพล', 'ธรรมรักษ์', 'phattharaphon.thamraks@example.com', 'pass042', '0810000042'),
(77, 'สุวรรณี', 'พงษ์เกษม', 'suwannee.pongkasem@example.com', 'pass043', '0810000043'),
(78, 'พงษ์ศักดิ์', 'จันทร์ทอง', 'phongsak.janthong@example.com', 'pass044', '0810000044'),
(79, 'กรองแก้ว', 'ศรีนวล', 'krongkaew.srinual@example.com', 'pass045', '0810000045'),
(80, 'วิโรจน์', 'วัฒนะ', 'wirot.wattana@example.com', 'pass046', '0810000046'),
(81, 'อภิญญา', 'อินทรักษ์', 'apinya.intharak@example.com', 'pass047', '0810000047'),
(82, 'วรพงษ์', 'ศักดิ์สิทธิ์', 'worapong.saksit@example.com', 'pass048', '0810000048'),
(83, 'ปัทมา', 'วงศ์สุวรรณ', 'patama.wongsuwan@example.com', 'pass049', '0810000049'),
(84, 'ธนพล', 'นาคินทร์', 'thanapol.nakinn@example.com', 'pass050', '0810000050'),
(85, 'Ryan', 'Walker', 'ryan.walker@example.com', 'pass051', '0810000051'),
(86, 'Megan', 'Hill', 'megan.hill@example.com', 'pass052', '0810000052'),
(87, 'Joshua', 'Green', 'joshua.green@example.com', 'pass053', '0810000053'),
(88, 'Lily', 'Baker', 'lily.baker@example.com', 'pass054', '0810000054'),
(89, 'Ethan', 'Carter', 'ethan.carter@example.com', 'pass055', '0810000055'),
(90, 'Isabella', 'Nelson', 'isabella.nelson@example.com', 'pass056', '0810000056'),
(91, 'Alexander', 'Perez', 'alexander.perez@example.com', 'pass057', '0810000057'),
(93, 'Samuel', 'Collins', 'samuel.collins@example.com', 'pass059', '0810000059'),
(94, 'Charlotte', 'Evans', 'charlotte.evans@example.com', 'pass060', '0810000060'),
(95, 'กาญจนา', 'ศิริวัฒน์', 'kanchana.siriwat@example.com', 'pass061', '0810000061'),
(96, 'อนุชา', 'แก้วใส', 'anucha.kaewsai@example.com', 'pass062', '0810000062'),
(97, 'ศิริกาญจน์', 'ปัญญา', 'sirikan.panya@example.com', 'pass063', '0810000063'),
(98, 'มารศรี', 'ชูเกียรติ', 'marasri.chukiat@example.com', 'pass064', '0810000064'),
(99, 'ธนากร', 'บัวแก้ว', 'thanakorn.buakaew@example.com', 'pass065', '0810000065'),
(100, 'พัชรี', 'นาคะ', 'patcharee.naka@example.com', 'pass066', '0810000066'),
(101, 'นพดล', 'คงสุข', 'noppadol.kongsuk@example.com', 'pass067', '0810000067'),
(102, 'จันทร์เพ็ญ', 'ศรีมา', 'chanpen.srima@example.com', 'pass068', '0810000068'),
(103, 'ปาริชาติ', 'พรหมมา', 'parichat.phromma@example.com', 'pass069', '0810000069'),
(104, 'สุเมธ', 'แสงทอง', 'sumet.saengthong@example.com', 'pass070', '0810000070'),
(105, 'Henry', 'Foster', 'henry.foster@example.com', 'pass071', '0810000071'),
(106, 'Amelia', 'Parker', 'amelia.parker@example.com', 'pass072', '0810000072'),
(107, 'Jacob', 'Reed', 'jacob.reed@example.com', 'pass073', '0810000073'),
(108, 'Mia', 'Howard', 'mia.howard@example.com', 'pass074', '0810000074');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `idx_bookings_type_id` (`type_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_number` (`room_number`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_roomtypes` FOREIGN KEY (`type_id`) REFERENCES `roomtypes` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_roomtypes` FOREIGN KEY (`type_id`) REFERENCES `roomtypes` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `roomtypes` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
