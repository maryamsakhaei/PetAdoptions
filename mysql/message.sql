-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 09:16 AM
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
-- Database: `pet_adoption`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `fk_sender_id` int(11) NOT NULL,
  `fk_receiver_id` int(11) NOT NULL,
  `readmsg_agency` tinyint(1) NOT NULL DEFAULT 0,
  `readmsg_user` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `subject`, `message`, `date`, `fk_sender_id`, `fk_receiver_id`, `readmsg_agency`, `readmsg_user`) VALUES
(1, 'Naslov poruke', 'some message', '2023-08-22 19:04:16', 3, 5, 1, 0),
(2, 'Naslov poruke', 'dfdfdfdfd', '2023-08-22 19:06:58', 4, 6, 0, 0),
(3, 'Naslov poruke', 'df', '2023-08-22 19:27:36', 3, 5, 1, 0),
(4, 'Reply back', 'This is a message from the agency to the user Sara Smith', '2023-08-23 07:42:22', 5, 3, 0, 0),
(5, 'Reply back to the agency', 'This is a reply to the new message by the agency from the user Sara Smith.', '2023-08-23 07:43:19', 3, 5, 0, 0),
(6, 'Subject 2', 'Another message sent by the user to the agency!', '2023-08-23 07:53:42', 3, 5, 0, 1),
(7, 'dfdfdf', 'dfdfd', '2023-08-23 07:55:56', 5, 3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_sender_id`),
  ADD KEY `fk_agency_id` (`fk_receiver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`fk_sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`fk_receiver_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
