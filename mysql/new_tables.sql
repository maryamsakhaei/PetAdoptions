CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_agency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`fk_agency_id`) REFERENCES `users` (`id`);

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `fk_pet_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

  ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`fk_pet_id`) REFERENCES `pet` (`id`),
  ADD CONSTRAINT `stories_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
COMMIT;