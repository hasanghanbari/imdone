DROP TABLE IF EXISTS `<DB_PREFIX>admins`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `<DB_PREFIX>admins` (`id`, `name`, `username`, `password`) VALUES
(1, '<USER_FA_NAME>', '<USER_NAME>', <PASSWORD>);


DROP TABLE IF EXISTS `<DB_PREFIX>class`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>class` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `active` tinytext COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;


DROP TABLE IF EXISTS `<DB_PREFIX>users`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>users` (
  `id` int(11) NOT NULL,
  `hash_id` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `system_number` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `im_done` tinyint(1) NOT NULL DEFAULT 0,
  `class_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `<DB_PREFIX>admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `<DB_PREFIX>class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `<DB_PREFIX>users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

ALTER TABLE `<DB_PREFIX>admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `<DB_PREFIX>class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `<DB_PREFIX>users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `<DB_PREFIX>class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `<DB_PREFIX>admins` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `<DB_PREFIX>users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `<DB_PREFIX>class` (`id`) ON UPDATE CASCADE;