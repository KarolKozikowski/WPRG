-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 02:18 AM
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
-- Database: `arctic_airlines`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `ID` int(11) NOT NULL,
  `Airframe_type_id` int(11) NOT NULL,
  `REG` char(6) NOT NULL,
  `HasTwoClass_config` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`ID`, `Airframe_type_id`, `REG`, `HasTwoClass_config`) VALUES
(1, 1, 'OH-MAA', 0),
(2, 1, 'OH-MAB', 0),
(3, 1, 'OH-MAC', 0),
(4, 1, 'OH-MAD', 0),
(5, 1, 'OH-MAE', 0),
(6, 1, 'OH-MAF', 0),
(7, 1, 'OH-MAG', 0),
(8, 1, 'OH-MAG', 0),
(9, 1, 'OH-MAH', 0),
(10, 1, 'OH-MAI', 0),
(11, 1, 'OH-MAJ', 0),
(12, 1, 'OH-MAK', 0),
(13, 1, 'OH-MBA', 1),
(14, 1, 'OH-MBB', 1),
(15, 1, 'OH-MBC', 1),
(16, 1, 'OH-MBD', 1),
(17, 2, 'OH-MXA', 0),
(18, 2, 'OH-MXB', 0),
(19, 2, 'OH-MXC', 0),
(20, 2, 'OH-MXD', 0),
(21, 2, 'OH-MXE', 0),
(22, 2, 'OH-MXF', 0),
(23, 4, 'OH-MEA', 0),
(24, 4, 'OH-MEB', 0),
(25, 4, 'OH-MEC', 0),
(26, 4, 'OH-MED', 0),
(27, 4, 'OH-MEE', 0),
(28, 4, 'OH-MEF', 0),
(29, 4, 'OH-MBE', 1),
(30, 4, 'OH-MBF', 1),
(31, 3, 'OH-SAA', 0),
(32, 3, 'OH-SAB', 0),
(33, 3, 'OH-SAC', 0),
(34, 3, 'OH-SAD', 0),
(35, 3, 'OH-SBA', 1),
(36, 5, 'OH-LAA', 0),
(37, 5, 'OH-LAB', 0),
(38, 5, 'OH-LAC', 0),
(39, 5, 'OH-LBA', 1),
(40, 5, 'OH-LBB', 1),
(41, 6, 'OH-LBC', 1),
(42, 6, 'OH-LBD', 1),
(43, 7, 'OH-LBE', 1),
(44, 7, 'OH-LBF', 1),
(45, 8, 'OH-SAE', 0),
(46, 8, 'OH-SAF', 0),
(47, 8, 'OH-SAG', 0),
(48, 8, 'OH-SAH', 0),
(49, 8, 'OH-SAI', 0),
(50, 9, 'LN-XCS', 0),
(51, 9, 'LN-YCS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `airframe_type`
--

CREATE TABLE `airframe_type` (
  `ID` int(11) NOT NULL,
  `Make` varchar(50) NOT NULL,
  `Model` varchar(20) NOT NULL,
  `ICAO_reg` char(4) NOT NULL,
  `OperCost_hour` float(4,2) NOT NULL,
  `OneClassConfig_capacity` int(11) NOT NULL,
  `TwoClassConfig_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airframe_type`
--

INSERT INTO `airframe_type` (`ID`, `Make`, `Model`, `ICAO_reg`, `OperCost_hour`, `OneClassConfig_capacity`, `TwoClassConfig_capacity`) VALUES
(1, 'Airbus', 'A320-232', 'A320', 80.00, 174, 160),
(2, 'Airbus', 'A321-231', 'A321', 85.00, 220, 200),
(3, 'Airbus', 'A319-114', 'A319', 89.00, 156, 110),
(4, 'Airbus', 'A320-271N', 'A20N', 83.00, 180, 164),
(5, 'Airbus', 'A321-253N', 'A21N', 81.00, 244, 200),
(6, 'Airbus', 'A330-300', 'A333', 40.00, 440, 290),
(7, 'Airbus', 'A350-1000ULR', 'A35K', 50.00, 410, 350),
(8, 'De Havilland/Bombardier', 'Dash-8 Q400', 'DH8D', 90.00, 78, 60),
(9, 'Boeing', 'B737-400C', 'B734', 71.00, 72, 72);

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `ID` int(11) NOT NULL,
  `ICAO` char(4) NOT NULL,
  `IATA` char(3) NOT NULL,
  `Municipality` varchar(128) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Country` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`ID`, `ICAO`, `IATA`, `Municipality`, `Name`, `Country`) VALUES
(1, 'EFHK', 'HEL', 'Helsinki', 'Helsinki Vantaa Airport', 'Finland'),
(2, 'EFTU', 'TKU', 'Turku', 'Turku Airport', 'Finland'),
(3, 'EFTP', 'TMP', 'Tampere', 'Tampere-Pirkkala Airport', 'Finland'),
(4, 'EFJO', 'JOE', 'Joensuu', 'Joensuu Airport', 'Finland'),
(5, 'EFLP', 'LPP', 'Lappeenranta', 'Lappeenranta Airport', 'Finland'),
(6, 'EFMI', 'MIK', 'Mikkeli', 'Mikkeli Airport', 'Finland'),
(7, 'EFJY', 'JYV', 'Jyväskylä', 'Jyväskylä Airport', 'Finland'),
(8, 'EFKU', 'KUO', 'Kuopio', 'Kuopio Airport', 'Finland'),
(9, 'EFVA', 'VAA', 'Vaasa', 'Vaasa Airport', 'Finland'),
(10, 'EFKI', 'KAJ', 'Kajaani', 'Kajaani Airport', 'Finland'),
(11, 'EFOU', 'OUL', 'Oulu', 'Oulu Airport', 'Finland'),
(12, 'EFRO', 'RVN', 'Rovaniemi', 'Rovaniemi Airport', 'Finland'),
(13, 'EFIV', 'IVL', 'Ivalo', 'Ivalo Airport', 'Finland'),
(14, 'EFMA', 'MHQ', 'Mariehamn', 'Mariehamn Airport', 'Finland'),
(15, 'ESGG', 'GOT', 'Gothenburg', 'Gothenburg-Landvetter Airport', 'Sweden'),
(16, 'ESSA', 'ARN', 'Stockholm', 'Stockholm-Arlanda Airport', 'Sweden'),
(17, 'ESNQ', 'KRN', 'Kiruna', 'Kiruna Airport', 'Sweden'),
(18, 'ENGM', 'OSL', 'Oslo', 'Oslo Airport, Gardermoen', 'Norway'),
(19, 'ENZV', 'SVG', 'Stavanger', 'Stavanger Airport, Sola', 'Norway'),
(20, 'ENBR', 'BGO', 'Bergen', 'Bergen Airport, Flesland', 'Norway'),
(21, 'ENVA', 'TRD', 'Trondheim', 'Trondheim Airport, Værnes', 'Norway'),
(22, 'ENBO', 'BOO', 'Bodø', 'Bodø Airport', 'Norway'),
(23, 'ENTC', 'TOS', 'Tromsø', 'Tromsø Airport, Langnes', 'Norway'),
(24, 'ENAT', 'ALF', 'Alta', 'Alta Airport', 'Norway'),
(25, 'ENHV', 'HVG', 'Honningsvåg', 'Honningsvåg Airport, Valan', 'Norway'),
(26, 'ENVD', 'VDS', 'Vadsø', 'Vadsø Airport', 'Norway'),
(27, 'ENKR', 'KKN', 'Kirkenes', 'Kirkenes Airport, Høybuktmoen', 'Norway'),
(28, 'ENSB', 'LYR', 'Longyearbyen', 'Svalbard Airport, Longyear', 'Norway'),
(29, 'EKVG', 'FAE', 'Vágar', 'Vágar Airport', 'Faroe'),
(30, 'BIKF', 'KEF', 'Keflavik', 'Keflavik International Airport', 'Iceland'),
(31, 'BIRK', 'RKV', 'Reykjavik', 'Reykjavik Airport', 'Iceland'),
(32, 'BIIS', 'IFJ', 'Ísafjörður', 'Ísafjörður Airport', 'Greenland'),
(33, 'BGGH', 'GOH', 'Nuuk', 'Nuuk Airport', 'Greenland'),
(34, 'EETN', 'TLL', 'Tallinn', 'Lennart Meri Tallinn Airport', 'Estonia'),
(35, 'EPGD', 'GDN', 'Gdańsk', 'Gdańsk Lech Wałęsa Airport', 'Poland'),
(36, 'EPWA', 'WAW', 'Warsaw', 'Warsaw Chopin Airport', 'Poland'),
(37, 'EPKK', 'KRK', 'Kraków', 'Kraków John Paul II International Airport', 'Poland'),
(38, 'EDDB', 'BER', 'Berlin', 'Berlin Brandenburg Airport', 'Germany'),
(39, 'EDDF', 'FRA', 'Frankfurt', 'Frankfurt Airport', 'Germany'),
(40, 'EDDL', 'DUS', 'Düsseldorf', 'Düsseldorf Airport', 'Germany'),
(41, 'EHAM', 'AMS', 'Amsterdam', 'Amsterdam Airport Schiphol', 'Netherlands'),
(42, 'LFPO', 'ORY', 'Paris', 'Paris-Orly Airport', 'France'),
(43, 'EGLL', 'LHR', 'London', 'London Heathrow Airport', 'UK'),
(44, 'EGPH', 'EDI', 'Edinburgh', 'Edinburgh Airport', 'UK'),
(45, 'LSZH', 'ZRH', 'Zürich', 'Zürich Airport', 'Switzerland'),
(46, 'EKCH', 'CPH', 'Copenhagen', 'Copenhagen Kastrup Airport', 'Denmark'),
(47, 'LIRF', 'FCO', 'Rome', 'Rome–Fiumicino Leonardo da Vinci International Airport', 'Italy'),
(48, 'KJFK', 'JFK', 'New York, NY', 'John F Kennedy International Airport', 'US'),
(49, 'KPWM', 'PWM', 'Portland, ME', 'Portland International Jetport', 'US'),
(50, 'KORD', 'ORD', 'Chicago, IL', 'Chicago O\'Hare International Airport', 'US'),
(51, 'KDFW', 'DFW', 'Dallas, TX', 'Dallas Fort Worth International Airport', 'US'),
(52, 'KLAX', 'LAX', 'Los Angeles, CA', 'Los Angeles / Tom Bradley International Airport', 'US'),
(53, 'KPDX', 'PDX', 'Portland, OR', 'Portland International Airport', 'US'),
(54, 'KSEA', 'SEA', 'Seattle', 'Seattle–Tacoma International Airport', 'US'),
(55, 'CYVR', 'YVR', 'Vancouver', 'Vancouver International Airport', 'Canada'),
(56, 'CYUL', 'YUL', 'Montreal', 'Montreal / Pierre Elliott Trudeau International Airport', 'Canada'),
(57, 'CYYC', 'YYC', 'Calgary', 'Calgary International Airport', 'Canada'),
(58, 'CYXY', 'YXY', 'Whitehorse', 'Whitehorse / Erik Nielsen International Airport', 'Canada'),
(59, 'PANC', 'ANC', 'Anchorage, AK', 'Ted Stevens Anchorage International Airport', 'US'),
(60, 'PAFA', 'FAI', 'Fairbanks, AK', 'Fairbanks International Airport', 'US'),
(61, 'YSSY', 'SYD', 'Sydney', 'Sydney Kingsford Smith International Airport', 'Australia'),
(62, 'RJTT', 'HND', 'Tokyo', 'Tokyo Haneda International Airport', 'Japan');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `ID` int(11) NOT NULL,
  `Route_id` int(11) NOT NULL,
  `Dep_date` date NOT NULL,
  `Dep_time` time NOT NULL,
  `Aircraft_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`ID`, `Route_id`, `Dep_date`, `Dep_time`, `Aircraft_id`) VALUES
(1, 1, '2023-06-23', '00:30:08', 43),
(2, 2, '2023-06-24', '10:43:00', 43),
(3, 3, '2023-06-25', '12:03:00', 43),
(4, 4, '2023-06-26', '21:00:00', 44),
(5, 5, '2023-06-28', '00:00:00', 44),
(6, 6, '2023-06-28', '18:15:00', 44),
(7, 7, '2023-06-29', '15:15:00', 43),
(8, 8, '2023-06-30', '06:05:00', 43),
(9, 9, '2023-06-22', '12:10:00', 42),
(10, 10, '2023-06-24', '02:12:00', 42),
(11, 11, '2023-07-01', '05:30:00', 44),
(12, 12, '2023-07-02', '09:30:00', 44),
(13, 13, '2023-06-26', '08:30:00', 42),
(14, 14, '2023-07-03', '17:20:00', 43),
(15, 27, '2023-06-27', '14:15:00', 4),
(16, 28, '2023-07-05', '18:05:00', 6),
(17, 1, '2023-06-25', '13:55:00', 44),
(18, 2, '2023-06-27', '21:50:00', 44),
(19, 31, '2023-06-30', '06:30:00', 2),
(20, 32, '2023-07-02', '09:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `ID` int(11) NOT NULL,
  `Flight_nr` int(11) NOT NULL,
  `Enroute_time` int(11) NOT NULL,
  `Departure_id` int(11) NOT NULL,
  `Arrival_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`ID`, `Flight_nr`, `Enroute_time`, `Departure_id`, `Arrival_id`) VALUES
(1, 1, 611, 1, 62),
(2, 101, 628, 62, 1),
(3, 2, 1116, 1, 61),
(4, 102, 1228, 61, 1),
(5, 3, 504, 1, 59),
(6, 103, 498, 59, 1),
(7, 4, 502, 1, 58),
(8, 104, 493, 58, 1),
(9, 5, 589, 1, 55),
(10, 105, 568, 55, 1),
(11, 6, 589, 1, 52),
(12, 106, 568, 52, 1),
(13, 7, 665, 1, 51),
(14, 107, 629, 51, 1),
(15, 8, 531, 1, 48),
(16, 108, 489, 48, 1),
(17, 9, 295, 1, 33),
(18, 109, 283, 33, 1),
(19, 201, 144, 1, 45),
(20, 401, 136, 45, 1),
(21, 202, 244, 1, 43),
(22, 402, 140, 43, 1),
(23, 203, 125, 1, 39),
(24, 403, 117, 39, 1),
(25, 204, 198, 1, 30),
(26, 404, 187, 30, 1),
(27, 205, 66, 1, 18),
(28, 405, 61, 18, 1),
(29, 207, 86, 1, 20),
(30, 407, 93, 20, 1),
(31, 2001, 60, 2, 35),
(32, 2201, 60, 35, 2),
(33, 2002, 30, 2, 16),
(34, 2202, 30, 16, 2),
(35, 2003, 70, 2, 36),
(36, 2203, 70, 36, 2),
(37, 2004, 80, 2, 37),
(38, 2204, 80, 37, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ID` int(11) NOT NULL,
  `Users_id` int(11) NOT NULL,
  `Flight_id` int(11) NOT NULL,
  `Seat` char(3) NOT NULL,
  `Gate` int(11) DEFAULT NULL,
  `Hand_Luggage` tinyint(1) NOT NULL,
  `Check_In_Luggage` tinyint(1) NOT NULL,
  `Traveling_With_Kids` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `First_name` varchar(128) NOT NULL,
  `Last_name` varchar(128) NOT NULL,
  `Phone_nr` char(16) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Country` varchar(128) NOT NULL,
  `Is_Fat` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `First_name`, `Last_name`, `Phone_nr`, `Email`, `Country`, `Is_Fat`, `username`, `user_password`) VALUES
(1, 'Karol', 'Kozikowski', '+358 123 456 789', 's27092@pjwstk.edu.pl', 'Finland', 0, 'ADMIN', '$2y$10$TmzDhBPV4TWwdFiLmDiIwuU6vNCXGa4.rswAixTTmXj/Mw.RlO/2e'),
(2, 'test', 'name', '+47 123 456 789', 'test@test.com', 'Norway', 0, 'username', '$2y$10$rg9B62SkCxsyPY9YipQ9c.nyG24s8XAmAsVv0txaeKfDIwLlaDpU2'),
(3, 'Ellie', 'Mikkela', '+358 886 443 029', 'ellie@gmail.com', 'Finland', 0, 'lofi&lt;3', '$2y$10$5GUwguEQtRLAVf5SLR0O9eARwj.poI9LO7Ct.eqOWCb3amPGUb4um'),
(4, 'Cave', 'Johnson', '+1 1234567898', 'cave@gmail.com', 'US', 1, 'Johnny', '$2y$10$gckW9K6rLKmQeK40KHzX6.W7fuDvTVTWguM2/67girOhrO/MNlopq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Aircraft_Aircraft_type` (`Airframe_type_id`);

--
-- Indexes for table `airframe_type`
--
ALTER TABLE `airframe_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Flights_Aircraft` (`Aircraft_id`),
  ADD KEY `Flights_Routes` (`Route_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Airports_Routes` (`Departure_id`),
  ADD KEY `Routes_Airports` (`Arrival_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Tickets_Flights` (`Flight_id`),
  ADD KEY `Tickets_Users` (`Users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD CONSTRAINT `Aircraft_Aircraft_type` FOREIGN KEY (`Airframe_type_id`) REFERENCES `airframe_type` (`ID`);

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `Flights_Aircraft` FOREIGN KEY (`Aircraft_id`) REFERENCES `aircraft` (`ID`),
  ADD CONSTRAINT `Flights_Routes` FOREIGN KEY (`Route_id`) REFERENCES `routes` (`ID`);

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `Airports_Routes` FOREIGN KEY (`Departure_id`) REFERENCES `airports` (`ID`),
  ADD CONSTRAINT `Routes_Airports` FOREIGN KEY (`Arrival_id`) REFERENCES `airports` (`ID`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `Tickets_Flights` FOREIGN KEY (`Flight_id`) REFERENCES `flights` (`ID`),
  ADD CONSTRAINT `Tickets_Users` FOREIGN KEY (`Users_id`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
