-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 10:48 AM
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

--
-- Dumping data for table `adoption`
--

INSERT INTO `adoption` (`id`, `fk_pet_id`, `fk_users_id`, `adopStatus`, `submitionDate`, `adoptionDate`, `donation`, `reason`) VALUES
(1, 4, 3, 'Approved', '2023-07-25', '2023-08-14', 500.00, 'Since I am a bit older, I would love to spend the day with a new friend. Also my grandchildren loves to play with dogs');

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`id`, `name`, `image`, `location`, `species`, `breed`, `age`, `size`, `description`, `available`, `vaccinated`, `experienceNeeded`, `minSpace`, `behavior`, `fk_users_id`) VALUES
(1, 'Silvester', NULL, 'Vienna', 'Cat', 'Siamese', 2, 'Medium', 'Friendly and playful cat.', 1, 1, 1, 30, NULL, 5),
(2, 'Luna', NULL, 'Vienna', 'Cat', 'Maine Coon', 4, 'Large', 'Gentle giant with a friendly personality.', 1, 1, 1, 50, NULL, 5),
(3, 'Rex', NULL, 'Vienna', 'Dog', 'German Shepherd ', 8, 'Large', 'Energetic and loyal dog.', 1, 1, 1, 100, NULL, 5),
(4, 'Pluto', NULL, 'Graz', 'Dog', 'Labrador Retriever', 3, 'Large', 'Energetic and loyal dog.', 0, 1, 1, 70, NULL, 5),
(5, 'Tweety', NULL, 'Vienna', 'Bird', 'Canary', 1, 'Small', 'Colorful and melodious bird.', 1, 0, 0, 1, NULL, 6),
(6, 'Nemo', NULL, 'Graz', 'Fish', 'Clownfish', 1, 'Small', 'Cute and friendly clownfish.', 1, 0, 0, 1, NULL, 6);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `firstName`, `lastName`, `agency`, `address`, `image`, `birthdate`, `phone`, `email`, `password`, `space`, `experienced`) VALUES
(1, 'Adm', 'Albert', 'Schwarz', NULL, 'Street 1, 1234 Vienna', NULL, '1990-06-09', '0699-17899999', 'admin@admin.com', NULL, 90, 1),
(2, 'User', 'Marc', 'Johnson', NULL, 'Street 2 5678 Salzburg', NULL, '2008-01-27', '0670-8887448', 'user@user.com', NULL, 120, 1),
(3, 'User', 'Sara', 'Smith', NULL, 'Street 3, 8752 Graz', NULL, '1956-12-19', '0660-7898522', 'user1@user1.com', NULL, 75, 1),
(4, 'User', 'Kim', 'Meyer', NULL, 'Street 4, 1987 Vienna', NULL, '1988-04-07', '01-8887448', 'user2@user2.com', NULL, 30, 0),
(5, 'Agency', NULL, NULL, 'Petshop AG', 'Animal Street 1 1544 Vienna', NULL, NULL, '01-37752221', 'agency@agency.com', NULL, NULL, NULL),
(6, 'Agency', NULL, NULL, 'Animalshelter & Co', 'Pet Street 85 8795 Graz', NULL, NULL, '0850-37721', 'agency1@agency1.com', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
