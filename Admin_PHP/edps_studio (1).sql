-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2026 at 10:31 AM
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
-- Database: `edps_studio`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `active_projects`
-- (See below for the actual view)
--
CREATE TABLE `active_projects` (
`id` int(11)
,`name` varchar(200)
,`description` text
,`event_date` date
,`status` enum('planning','in_progress','completed','cancelled')
,`budget` decimal(10,2)
,`location` varchar(255)
,`client_name` varchar(100)
,`client_email` varchar(100)
,`client_phone` varchar(20)
,`notes` text
,`created_at` timestamp
,`updated_at` timestamp
,`assigned_staff` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `status` enum('planning','in_progress','completed','cancelled') DEFAULT 'planning',
  `budget` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `client_name` varchar(100) DEFAULT NULL,
  `client_email` varchar(100) DEFAULT NULL,
  `client_phone` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_assignments`
--

CREATE TABLE `project_assignments` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `role_in_project` varchar(100) DEFAULT NULL,
  `assigned_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('assigned','completed','removed') DEFAULT 'assigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `project_details`
-- (See below for the actual view)
--
CREATE TABLE `project_details` (
`id` int(11)
,`name` varchar(200)
,`description` text
,`event_date` date
,`status` enum('planning','in_progress','completed','cancelled')
,`budget` decimal(10,2)
,`location` varchar(255)
,`client_name` varchar(100)
,`client_email` varchar(100)
,`client_phone` varchar(20)
,`notes` text
,`created_at` timestamp
,`updated_at` timestamp
,`assigned_staff` mediumtext
);

-- --------------------------------------------------------

--
-- Table structure for table `project_media`
--

CREATE TABLE `project_media` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `file_type` enum('image','video','document') DEFAULT 'image',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('photographer','editor','assistant','manager') NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `join_date` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `staff_workload`
-- (See below for the actual view)
--
CREATE TABLE `staff_workload` (
`id` int(11)
,`name` varchar(100)
,`email` varchar(100)
,`role` enum('photographer','editor','assistant','manager')
,`phone` varchar(20)
,`join_date` date
,`status` enum('active','inactive')
,`profile_image` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
,`active_projects` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','manager','staff') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `active_projects`
--
DROP TABLE IF EXISTS `active_projects`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `active_projects`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`description` AS `description`, `p`.`event_date` AS `event_date`, `p`.`status` AS `status`, `p`.`budget` AS `budget`, `p`.`location` AS `location`, `p`.`client_name` AS `client_name`, `p`.`client_email` AS `client_email`, `p`.`client_phone` AS `client_phone`, `p`.`notes` AS `notes`, `p`.`created_at` AS `created_at`, `p`.`updated_at` AS `updated_at`, count(`pa`.`staff_id`) AS `assigned_staff` FROM (`projects` `p` left join `project_assignments` `pa` on(`p`.`id` = `pa`.`project_id` and `pa`.`status` = 'assigned')) WHERE `p`.`status` in ('planning','in_progress') GROUP BY `p`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `project_details`
--
DROP TABLE IF EXISTS `project_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `project_details`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`description` AS `description`, `p`.`event_date` AS `event_date`, `p`.`status` AS `status`, `p`.`budget` AS `budget`, `p`.`location` AS `location`, `p`.`client_name` AS `client_name`, `p`.`client_email` AS `client_email`, `p`.`client_phone` AS `client_phone`, `p`.`notes` AS `notes`, `p`.`created_at` AS `created_at`, `p`.`updated_at` AS `updated_at`, group_concat(distinct concat(`s`.`name`,' (',`pa`.`role_in_project`,')') separator ', ') AS `assigned_staff` FROM ((`projects` `p` left join `project_assignments` `pa` on(`p`.`id` = `pa`.`project_id` and `pa`.`status` = 'assigned')) left join `staff` `s` on(`pa`.`staff_id` = `s`.`id`)) GROUP BY `p`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `staff_workload`
--
DROP TABLE IF EXISTS `staff_workload`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `staff_workload`  AS SELECT `s`.`id` AS `id`, `s`.`name` AS `name`, `s`.`email` AS `email`, `s`.`role` AS `role`, `s`.`phone` AS `phone`, `s`.`join_date` AS `join_date`, `s`.`status` AS `status`, `s`.`profile_image` AS `profile_image`, `s`.`created_at` AS `created_at`, `s`.`updated_at` AS `updated_at`, count(`pa`.`project_id`) AS `active_projects` FROM ((`staff` `s` left join `project_assignments` `pa` on(`s`.`id` = `pa`.`staff_id` and `pa`.`status` = 'assigned')) left join `projects` `p` on(`pa`.`project_id` = `p`.`id` and `p`.`status` in ('planning','in_progress'))) WHERE `s`.`status` = 'active' GROUP BY `s`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_activity_log_user` (`user_id`),
  ADD KEY `idx_activity_log_created` (`created_at`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_projects_status` (`status`),
  ADD KEY `idx_projects_event_date` (`event_date`);

--
-- Indexes for table `project_assignments`
--
ALTER TABLE `project_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_assignment` (`project_id`,`staff_id`),
  ADD KEY `idx_project_assignments_project` (`project_id`),
  ADD KEY `idx_project_assignments_staff` (`staff_id`);

--
-- Indexes for table `project_media`
--
ALTER TABLE `project_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_staff_status` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_assignments`
--
ALTER TABLE `project_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_media`
--
ALTER TABLE `project_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_assignments`
--
ALTER TABLE `project_assignments`
  ADD CONSTRAINT `project_assignments_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_assignments_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_media`
--
ALTER TABLE `project_media`
  ADD CONSTRAINT `project_media_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
