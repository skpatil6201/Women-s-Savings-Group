-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 06:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gnjn`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankloans`
--

CREATE TABLE `bankloans` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `installment_month` int(11) NOT NULL,
  `loan_amount` decimal(10,2) NOT NULL,
  `memberid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bankloans`
--

INSERT INTO `bankloans` (`id`, `bank_name`, `date`, `interest_rate`, `installment_month`, `loan_amount`, `memberid`) VALUES
(1, 'sbi', '2024-04-23', 10.00, 2, 10000.00, ''),
(2, 'cbi', '2024-04-17', 10.00, 10, 21121.00, ''),
(3, 'sbi', '2024-04-09', 10.00, 10, 10000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `contact` varchar(202) NOT NULL,
  `address` varchar(255) NOT NULL,
  `memberid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`name`, `email`, `username`, `password`, `dob`, `contact`, `address`, `memberid`) VALUES
('gunjan katre', 'gunjan@gmail.com', '11', '11', '2024-04-23', '1111111111', 'Amravati', 11),
('Sakshi Kale', 'Sakshi@gmail.com', '22', '22', '2024-04-24', '2222222222', 'Amravati', 22),
('Sejal Ambalkar', 'Sejal@gmail.com', '33', '33', '2024-04-24', '3333333333', 'Amravati', 33),
('Gayatri patil', 'gayatri@gmail.com', '44', '44', '2024-04-16', '4444444444', 'Amravati', 44),
('Vaishnavi Patil', 'Vaishnavi@gmail.com', '55', '55', '2024-04-23', '5555555555', 'Amravati', 55),
('Arpita Sawarkar', 'Arpita@gmail.com', '66', '66', '2024-04-22', '6666666666', 'Amravati', 66),
('Nikita Dhaskat', 'Nikita@gmail.com', '77', '77', '2024-04-23', '7777777777', 'Amravati', 77),
('Pratiksha Kakad', 'Pratiksha@gmail.com', '88', '88', '2024-04-25', '8888888888', 'Amravati', 88),
('Namrata Padwal', 'Namrata@gmail.com', '99', '99', '2024-04-25', '9999999999', 'Amravati', 99),
('sakshi', 'Sakshi@gmail.com', 'Sakshi@123', 'Sakshi@123', '2024-06-14', '+919547896521', 'amt', 1012),
('rakhi', 'rakhi@gmail.com', 'Pakhi@123', 'Pakhi@123', '2024-06-10', '+915478965211', 'amt', 1013),
('fasdas', 'skpatil6201@gmail.com', 'Skpatil@123', 'Skpatil@123', '2024-07-17', '+912563524178', 'atpost. pathrot. tq.achlapur dist.amravati', 1014);

-- --------------------------------------------------------

--
-- Table structure for table `member_loan`
--

CREATE TABLE `member_loan` (
  `id` int(11) NOT NULL,
  `memberid` int(11) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `loan_date` date DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `subject`, `description`, `created_at`) VALUES
(1, 'to request', 'pay loan', 'pay all your loan', '2024-04-22 02:56:57'),
(2, 'to request', 'pay loan', 'pay all your loan', '2024-04-22 02:57:33'),
(3, 'dhd', 'jdjcf', 'jcncf', '2024-04-22 02:57:58'),
(4, 'dhd', 'jdjcf', 'jcncffcv', '2024-04-22 03:00:29'),
(5, 'sfzds', 'dasdasdasdas', 'dasd', '2024-07-05 16:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `otherloans`
--

CREATE TABLE `otherloans` (
  `id` int(11) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `loan_amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `installment_months` int(11) NOT NULL,
  `RequestLoanAmount` varchar(233) NOT NULL,
  `RequestInterestRate` varchar(200) NOT NULL,
  `RequestDate` date DEFAULT NULL,
  `RequestStutas` varchar(111) NOT NULL,
  `saving_amount` varchar(200) DEFAULT NULL,
  `saving_month` varchar(200) DEFAULT NULL,
  `saving_payment_date` datetime(6) DEFAULT NULL,
  `MemberTotalSaving` varchar(200) DEFAULT NULL,
  `memberid` varchar(255) DEFAULT NULL,
  `receive_loan_organisation` varchar(255) DEFAULT NULL,
  `receive_loan_date` date DEFAULT NULL,
  `receive_loan_amount` varchar(255) DEFAULT NULL,
  `receive_loan_interest` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `saving_date` date DEFAULT NULL,
  `receive_installment_month` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otherloans`
--

INSERT INTO `otherloans` (`id`, `organization_name`, `date`, `loan_amount`, `interest_rate`, `installment_months`, `RequestLoanAmount`, `RequestInterestRate`, `RequestDate`, `RequestStutas`, `saving_amount`, `saving_month`, `saving_payment_date`, `MemberTotalSaving`, `memberid`, `receive_loan_organisation`, `receive_loan_date`, `receive_loan_amount`, `receive_loan_interest`, `type`, `saving_date`, `receive_installment_month`) VALUES
(51, '', '0000-00-00', 0.00, 0.00, 0, '500', '5', '2024-04-27', 'Accept', NULL, NULL, NULL, NULL, '55', NULL, NULL, NULL, NULL, 'Loan Request', NULL, 0),
(59, '', '0000-00-00', 0.00, 0.00, 0, '', '', NULL, '', '111000', 'jan', NULL, NULL, '11', NULL, NULL, NULL, NULL, 'New Saving', '2024-05-17', 0),
(60, '', '0000-00-00', 0.00, 0.00, 0, '', '', NULL, '', '1000', 'september', NULL, NULL, '11', NULL, NULL, NULL, NULL, 'New Saving', '2024-07-04', 0),
(61, 'tyfdtyrf', '2024-07-03', 10000.00, 10.00, 6, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New Loan', NULL, 0),
(62, '', '0000-00-00', 0.00, 0.00, 0, '', '', NULL, '', '1000', NULL, '2024-07-31 00:00:00.000000', NULL, '11', NULL, NULL, NULL, NULL, 'saving', NULL, 0),
(63, '', '0000-00-00', 0.00, 0.00, 0, '', '', NULL, '', '2222', '2', NULL, NULL, '22', NULL, NULL, NULL, NULL, 'New Saving', '2024-07-05', 0),
(64, '', '0000-00-00', 0.00, 0.00, 0, '22', '2', '2024-07-05', 'Accept', NULL, NULL, NULL, NULL, '22', NULL, NULL, NULL, NULL, 'Loan Request', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `saving`
--

CREATE TABLE `saving` (
  `id` int(11) NOT NULL,
  `memberid` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `month` varchar(50) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `MemberTotalSaving` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saving`
--

INSERT INTO `saving` (`id`, `memberid`, `amount`, `month`, `payment_date`, `MemberTotalSaving`) VALUES
(1, '11', 20000.00, 'sept', '2024-04-22 03:37:11', '5000'),
(2, '22', 3201.00, 'sept', '2024-04-22 04:00:06', '500'),
(3, '11', 3201.00, 'sept', '2024-04-22 04:01:23', '500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankloans`
--
ALTER TABLE `bankloans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberid`);

--
-- Indexes for table `member_loan`
--
ALTER TABLE `member_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otherloans`
--
ALTER TABLE `otherloans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankloans`
--
ALTER TABLE `bankloans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- AUTO_INCREMENT for table `member_loan`
--
ALTER TABLE `member_loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `otherloans`
--
ALTER TABLE `otherloans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `saving`
--
ALTER TABLE `saving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
