-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2025 at 01:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venue_managment_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `attends`
--

CREATE TABLE `attends` (
  `event_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attends`
--

INSERT INTO `attends` (`event_id`, `guest_id`) VALUES
(301, 601),
(302, 602),
(303, 603),
(304, 604),
(305, 605);

-- --------------------------------------------------------

--
-- Table structure for table `billed`
--

CREATE TABLE `billed` (
  `host_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billed`
--

INSERT INTO `billed` (`host_id`, `invoice_id`) VALUES
(101, 201),
(102, 202),
(103, 203),
(104, 204),
(105, 205);

-- --------------------------------------------------------

--
-- Table structure for table `contractor`
--

CREATE TABLE `contractor` (
  `staff_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contractor`
--

INSERT INTO `contractor` (`staff_id`, `start_date`, `end_date`) VALUES
(1, '2025-10-01', '2025-12-31'),
(2, '2025-09-15', '2025-11-15'),
(3, '2025-10-10', '2025-11-30'),
(4, '2025-08-01', '2025-10-31'),
(6, '2025-09-01', '2025-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

CREATE TABLE `emergency_contact` (
  `staff_id` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_phone_num` varchar(10) DEFAULT NULL,
  `relationship` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_contact`
--

INSERT INTO `emergency_contact` (`staff_id`, `contact_name`, `contact_phone_num`, `relationship`) VALUES
(1, 'Bo Horvat', '6041234567', 'Brother'),
(2, 'Henrik Sedin', '6042345678', 'Father'),
(3, 'Haley Wickenheiser', '6043456789', 'Mother'),
(4, 'Kevin Bieksa', '6044567890', 'Husband'),
(5, 'Alex Burrows', '6045678901', 'Sister');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `time` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `event_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `time`, `date`, `event_type`) VALUES
(301, '18:00', '2025-11-10', 'Concert'),
(302, '14:00', '2025-11-12', 'Conference'),
(303, '09:30', '2025-11-15', 'Wedding'),
(304, '10:00', '2025-11-18', 'Wedding'),
(305, '20:00', '2025-11-20', 'Gala');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL,
  `event_title` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `event_title`, `password`) VALUES
(601, 'Rock Night', '$2y$10$7KuZIAB8jCvo7OBB.f7tcuvTGTDy87MXGMnzSeGA71qsmvaw07AFe'),
(602, 'Tech Summit', '$2y$10$fNVuMDS5wmjdtERv0LX/L.O7g3vobJIpMzW4cu9D6bdthcVs..7Py'),
(603, 'Wedding', '$2y$10$q5AG25UZ4CUL3w5qFRUsPuQJDbLAm73cwpy58o9uoQ989ycFmziBu'),
(604, 'Wedding', '$2y$10$4eDCwYXaazlIs4W1sH7YsOGG5HBs9Ni/.l9pFhy2BkoqGViHScIAG'),
(605, 'Charity Gala', '$2y$10$spS1q1JAzZlXzxBwnpkUWebxnIQvfDMCyRvghdyGvGXX01.en5xGG'),
(606, NULL, '$2y$10$NiVibtFXS4f4Kzf9v.hT4.ztwGggMNdzxeG1uV5mgidcg/G3Au5wO');

-- --------------------------------------------------------

--
-- Table structure for table `host`
--

CREATE TABLE `host` (
  `host_id` int(11) NOT NULL,
  `host_address` varchar(100) DEFAULT NULL,
  `host_phone_num` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `host`
--

INSERT INTO `host` (`host_id`, `host_address`, `host_phone_num`, `password`) VALUES
(101, '123 Main St, Vancouver', '604-555-1001', '$2y$10$9avKNhGCUTbbKypQ1929y.Xnsn4gCbpSa8grxQ5OO9DCZxtwpBUYq'),
(102, '456 Oak Ave, Burnaby', '604-555-1002', '$2y$10$.PPDLmCCP2PXqYh7RJlftuKE8O3eNhkXG47bvwJNbrVL.LNFbDE0i'),
(103, '789 Pine Rd, Richmond', '604-555-1003', '$2y$10$pW4PJRdGQqZ3r67mLpP70utx1H8Oj5iqTRAZQovBrh9IzGXty0qNa'),
(104, '321 Cedar Blvd, Surrey', '604-555-1004', '$2y$10$CmKnjLemXArMwIsMVoYBIeXhUwgqOSHn/87sNVozqv2cetrnboAT6'),
(105, '654 Maple Ln, Coquitlam', '604-555-1005', '$2y$10$j8xyz6mjVZftyaBEkQJWHO3SEW41g8xNOiasTi955JMamPoDErWQu'),
(106, '1111 Main St TEST', '111-111-1111', '$2y$10$NRAYkXT2Ovz9uo3uyBXT2.kdeVP.qYcu3oXWaICz7TAhSULJ9QRfW');

-- --------------------------------------------------------

--
-- Table structure for table `hosts_event`
--

CREATE TABLE `hosts_event` (
  `event_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hosts_event`
--

INSERT INTO `hosts_event` (`event_id`, `host_id`) VALUES
(301, 101),
(302, 102),
(303, 103),
(304, 104),
(305, 105);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `amount`, `status`) VALUES
(201, 1500.00, 'Paid'),
(202, 2200.50, 'Unpaid'),
(203, 1800.75, 'Paid'),
(204, 2500.00, 'Pending'),
(205, 1300.00, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `located`
--

CREATE TABLE `located` (
  `event_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `located`
--

INSERT INTO `located` (`event_id`, `venue_id`) VALUES
(301, 401),
(302, 402),
(303, 403),
(304, 404),
(305, 405);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `Staff_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `position`, `Staff_name`) VALUES
(0, '[value-2]', '[value-3]'),
(1, 'Security', 'John Doe'),
(2, 'Security', 'Brock Boeser'),
(3, 'Waiter', 'Quinn Hughes'),
(4, 'Caterer', 'Elias Petterson'),
(5, 'Waiter', 'Max Sasson'),
(6, 'Security', 'Arshdeep Bains'),
(7, 'Waiter', 'Tyler Myers'),
(8, 'Event Planner', 'Connor Garland');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `supervisor_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `Supervisor_pos` varchar(50) DEFAULT NULL,
  `Staff_pos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`supervisor_id`, `staff_id`, `Supervisor_pos`, `Staff_pos`) VALUES
(2, 1, 'Security', 'Security'),
(2, 6, 'Security', 'Security'),
(4, 3, 'Caterer', 'Waiter'),
(4, 5, 'Caterer', 'Waiter'),
(8, 4, 'Event Planner', 'Caterer');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `event_id` int(11) NOT NULL,
  `seat_num` varchar(10) NOT NULL,
  `ticket_price` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`event_id`, `seat_num`, `ticket_price`) VALUES
(301, 'A1', 75.00),
(301, 'B2', 50.00),
(302, 'D4', 40.00),
(304, 'C3', 60.00),
(305, 'E5', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL,
  `venue_address` varchar(100) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `venue_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venue_address`, `size`, `venue_type`) VALUES
(401, '500 Granville St, Vancouver', 'Large', 'Indoor'),
(402, '200 Robson St, Vancouver', 'Medium', 'Indoor'),
(403, '100 Beach Ave, Vancouver', 'Small', 'Outdoor'),
(404, '700 Broadway St, Burnaby', 'Large', 'Indoor'),
(405, '300 Kingsway, Surrey', 'Medium', 'Outdoor');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `event_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`event_id`, `staff_id`) VALUES
(302, 2),
(303, 2),
(304, 4),
(305, 1),
(305, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attends`
--
ALTER TABLE `attends`
  ADD PRIMARY KEY (`event_id`,`guest_id`),
  ADD KEY `guest_id` (`guest_id`);

--
-- Indexes for table `billed`
--
ALTER TABLE `billed`
  ADD PRIMARY KEY (`host_id`,`invoice_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `contractor`
--
ALTER TABLE `contractor`
  ADD PRIMARY KEY (`staff_id`,`start_date`);

--
-- Indexes for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD PRIMARY KEY (`staff_id`,`contact_name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`host_id`);

--
-- Indexes for table `hosts_event`
--
ALTER TABLE `hosts_event`
  ADD PRIMARY KEY (`event_id`,`host_id`),
  ADD KEY `host_id` (`host_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `located`
--
ALTER TABLE `located`
  ADD PRIMARY KEY (`event_id`,`venue_id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`supervisor_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`event_id`,`seat_num`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`event_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attends`
--
ALTER TABLE `attends`
  ADD CONSTRAINT `attends_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `attends_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`);

--
-- Constraints for table `billed`
--
ALTER TABLE `billed`
  ADD CONSTRAINT `billed_ibfk_1` FOREIGN KEY (`host_id`) REFERENCES `host` (`host_id`),
  ADD CONSTRAINT `billed_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`);

--
-- Constraints for table `contractor`
--
ALTER TABLE `contractor`
  ADD CONSTRAINT `contractor_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD CONSTRAINT `emergency_contact_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `hosts_event`
--
ALTER TABLE `hosts_event`
  ADD CONSTRAINT `hosts_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `hosts_event_ibfk_2` FOREIGN KEY (`host_id`) REFERENCES `host` (`host_id`);

--
-- Constraints for table `located`
--
ALTER TABLE `located`
  ADD CONSTRAINT `located_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `located_ibfk_2` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`venue_id`);

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `supervisor_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `works_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
