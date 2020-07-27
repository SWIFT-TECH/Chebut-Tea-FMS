-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 10:24 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', '$2y$10$fCOiMky4n5hCJx3cpsG20Od4wHtlkCLKmO6VLobJNRIg9ooHTkgjK', 'Chebut', 'Admin', 'Chebut Tea (1).png', '2019-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `kgs` double NOT NULL,
  `rate` double NOT NULL,
  `date_bonus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`id`, `employee_id`, `kgs`, `rate`, `date_bonus`) VALUES
(6, '29', 75.2, 28, '2020-07-24'),
(7, '31', 87.2, 28, '2020-07-24'),
(8, '27', 112.5, 28, '2020-07-25'),
(9, '31', 112.5, 28, '2020-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`id`, `date_advance`, `employee_id`, `amount`) VALUES
(6, '2020-07-24', '28', 4500),
(7, '2020-07-24', '29', 4500),
(8, '2020-07-25', '36', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `collection_centre`
--

CREATE TABLE `collection_centre` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `centre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection_centre`
--

INSERT INTO `collection_centre` (`id`, `time_in`, `time_out`, `centre`) VALUES
(7, '00:00:00', '00:00:00', 'Kamobo'),
(9, '00:00:00', '00:00:00', 'Showground'),
(10, '00:00:00', '00:00:00', 'Samoo'),
(11, '00:00:00', '00:00:00', 'Teldet'),
(12, '00:00:00', '00:00:00', 'Kiropket'),
(13, '00:00:00', '00:00:00', 'Chebut');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(3, 'NSSF', 250),
(5, 'Tax', 84);

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `employee_id`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`) VALUES
(27, 'ZB510', 'Simon', 'Kosgei', '2151', '0007-12-19', '0724429697', 'Male', 5, 7, '', '2020-07-24'),
(28, 'EF248', 'Ednah', 'Ednah', '2151', '1995-10-10', '0724429697', 'Female', 5, 9, '', '2020-07-24'),
(29, 'DT208', 'Nancy', 'Nancy', '2151\r\n210', '1997-06-18', '0724429697', 'Female', 5, 9, '', '2020-07-24'),
(30, 'BN930', 'Kalembe', 'Ndile', '325', '1989-07-18', '0724429697', 'Male', 5, 9, '', '2020-07-24'),
(31, 'DW542', 'Kate', 'Karimi', '2151\r\n210', '1978-07-27', '0724429697', 'Female', 5, 10, '', '2020-07-24'),
(32, 'DC958', 'Pembe', 'Makola', '785', '1985-12-12', '0724429697', 'Male', 5, 11, '', '2020-07-24'),
(33, 'FU521', 'Kibet', 'John', '320', '1974-12-04', '0724429697', 'Male', 5, 11, '', '2020-07-25'),
(34, 'ZE491', 'Jinja', 'Butula', '587', '1989-07-10', '0724429697', 'Male', 5, 12, '', '2020-07-25'),
(35, 'SG236', 'Christine', 'Chemutai', '39', '1978-07-11', '0724429697', 'Female', 5, 13, '', '2020-07-25'),
(36, 'WO092', 'Kiki', 'Jamila', '2151', '1985-10-10', '0724429697', 'Male', 5, 13, '', '2020-07-25'),
(37, 'QD029', 'Chris', 'Matano', '2151', '1989-07-18', '0724429697', 'Male', 5, 11, '', '2020-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `description`, `rate`) VALUES
(5, 'Green Tea Leaves', 75);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `kg` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `kg`) VALUES
(111, 28, '2020-07-24', '01:00:00', 0, '01:00:00', 100),
(113, 27, '2020-07-24', '01:00:00', 0, '01:00:00', 100),
(114, 29, '2020-07-23', '01:00:00', 0, '01:00:00', 87),
(115, 30, '2020-07-24', '01:00:00', 0, '01:00:00', 89),
(116, 29, '2020-07-24', '01:00:00', 78, '01:00:00', 78),
(117, 31, '2020-07-24', '00:00:00', 0, '00:00:00', 104),
(120, 32, '2020-07-24', '00:00:00', 0, '00:00:00', 112),
(121, 32, '2020-07-25', '01:00:00', 0, '01:00:00', 112),
(122, 28, '2020-07-25', '01:00:00', 0, '01:00:00', 124),
(123, 27, '2020-07-25', '01:00:00', 0, '01:00:00', 145),
(124, 31, '2020-07-25', '00:00:00', 0, '00:00:00', 214),
(125, 34, '2020-07-25', '00:00:00', 0, '00:00:00', 184),
(126, 34, '2020-07-24', '01:00:00', 0, '01:00:00', 112),
(127, 35, '2020-07-25', '00:00:00', 0, '00:00:00', 97),
(128, 36, '2020-07-25', '00:00:00', 0, '00:00:00', 124),
(129, 37, '2020-07-25', '00:00:00', 0, '00:00:00', 145);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_centre`
--
ALTER TABLE `collection_centre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `collection_centre`
--
ALTER TABLE `collection_centre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
