-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 11:46 AM
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
-- Table structure for table `adoption`
--

CREATE TABLE `adoption` (
  `id` int(11) NOT NULL,
  `fk_pet_id` int(11) NOT NULL,
  `fk_adoptee_id` int(11) NOT NULL,
  `adopStatus` enum('Apply','Approved','Declined') DEFAULT 'Apply',
  `submitionDate` date DEFAULT NULL,
  `adoptionDate` date DEFAULT NULL,
  `donation` decimal(5,2) DEFAULT NULL,
  `reason` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption`
--

INSERT INTO `adoption` (`id`, `fk_pet_id`, `fk_adoptee_id`, `adopStatus`, `submitionDate`, `adoptionDate`, `donation`, `reason`) VALUES
(1, 4, 3, 'Approved', '2023-07-25', '2023-08-14', 500.00, 'Since I am a bit older, I would love to spend the day with a new friend. Also my grandchildren loves to play with dogs'),
(2, 8, 3, 'Apply', '2023-08-18', '2023-08-31', NULL, 'Some reason');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_agency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `species` enum('Cat','Dog','Bird','Fish') NOT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `size` enum('Small','Medium','Large') DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `available` tinyint(1) NOT NULL,
  `vaccinated` tinyint(1) NOT NULL,
  `experienceNeeded` tinyint(1) NOT NULL,
  `minSpace` int(11) NOT NULL,
  `behavior` varchar(255) DEFAULT NULL,
  `fk_users_id` int(11) NOT NULL,
  `pet_day` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`id`, `name`, `image`, `location`, `species`, `breed`, `age`, `size`, `description`, `available`, `vaccinated`, `experienceNeeded`, `minSpace`, `behavior`, `fk_users_id`, `pet_day`) VALUES
(1, 'Silvester', '64dd36ca5db2a.jpg', 'Vienna', 'Cat', 'Siamese', 3, 'Medium', '', 1, 1, 0, 40, '', 5, 0),
(2, 'Luna', '64dd39b0888bc.jpg', 'Vienna', 'Cat', 'Maine Coon', 4, 'Large', 'Gentle giant with a friendly personality.', 1, 1, 1, 50, '', 5, 0),
(3, 'Rex', '64dd3a10da520.jpg', 'Vienna', 'Dog', 'German Shepherd', 8, 'Small', 'Energetic and loyal dog.', 1, 1, 1, 100, '', 5, 0),
(4, 'Pluto', '64dd3a854a5ce.jpg', 'Graz', 'Dog', 'Labrador Retriever', 4, 'Large', 'Energetic and loyal dog.', 0, 1, 1, 70, '', 5, 0),
(5, 'Tweety', '64ddb6886fe5a.jpg', 'Vienna', 'Bird', 'Canary', 1, 'Small', 'Colorful and melodious bird.', 1, 0, 0, 1, '', 6, 0),
(6, 'Nemo', '64ddb6eae0830.jpg', 'Graz', 'Fish', 'Clownfish', 1, 'Small', 'Cute and friendly clownfish.', 1, 0, 0, 1, '', 6, 0),
(8, 'Fluffy', 'placeholder.jpg', '', 'Cat', '', 0, '', '', 0, 0, 0, 0, '', 1, 0),
(12, 'Tom', '64de0edcbdfd9.jpg', 'Graz', 'Bird', 'parrot', 1, 'Small', 'blue, red, green parot', 1, 0, 0, 20, 'Quiet; sings some times', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `fk_pet_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `fk_pet_id`, `image`, `desc`, `date`, `fk_user_id`) VALUES
(2, 1, '64e0db66e87c8.jpg', 'This is a new story', '2023-08-19 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('Adm','User','Agency') DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `agency` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `state` enum('Wien','Niederösterreich','Oberösterreich','Steiermark','Tirol','Kärnten','Salzburg','Vorarlberg','Burgenland') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `space` int(11) DEFAULT NULL,
  `experienced` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `firstName`, `lastName`, `agency`, `address`, `state`, `image`, `birthdate`, `phone`, `email`, `password`, `space`, `experienced`) VALUES
(1, 'Adm', 'Albert', 'Schwarz', NULL, 'Street 1, 1234 Vienna', NULL, 'placeholder.jpg', '1990-06-09', '0699-17899999', 'admin@admin.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 90, 1),
(2, 'User', 'Marc', 'Johnson', NULL, 'Street 2 5678 Salzburg', NULL, 'placeholder.jpg', '2008-01-27', '0670-8887448', 'user@user.com', NULL, 120, 1),
(3, 'User', 'Sara', 'Smith', NULL, 'Street 3, 8752 Graz', NULL, 'placeholder.jpg', '1956-12-19', '0660-7898522', 'user1@user1.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 75, 1),
(4, 'User', 'Kim', 'Meyer', NULL, 'Street 4, 1987 Vienna', NULL, 'placeholder.jpg', '1988-04-07', '01-8887448', 'user2@user2.com', NULL, 30, 0),
(5, 'Agency', NULL, NULL, 'Petshop AG', 'Animal Street 1 1544 Vienna', NULL, 'placeholder.jpg', NULL, '01-37752221', 'agency@agency.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', NULL, NULL),
(6, 'Agency', NULL, NULL, 'Animalshelter & Co', 'Pet Street 85 8795 Graz', NULL, 'placeholder.jpg', NULL, '0850-37721', 'agency1@agency1.com', NULL, NULL, NULL),
(7, 'User', 'Christina', 'Xeni', NULL, 'Liechtensteinstrasse 81/1/15', NULL, 'placeholder.jpg', '1989-08-13', '+436604466449', 'christinax7@ymail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', NULL, NULL),
(8, 'User', 'Test', 'lasttest', NULL, 'some address', NULL, 'placeholder.jpg', '1989-08-13', '123456', 'email2@example.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 50, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`),
  ADD KEY `fk_users_id` (`fk_adoptee_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_agency_id` (`fk_agency_id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agency_id` (`fk_users_id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `fk_pet_id` FOREIGN KEY (`fk_pet_id`) REFERENCES `pet` (`id`),
  ADD CONSTRAINT `fk_users_id` FOREIGN KEY (`fk_adoptee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`fk_agency_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fk_agency_id` FOREIGN KEY (`fk_users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`fk_pet_id`) REFERENCES `pet` (`id`),
  ADD CONSTRAINT `stories_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
