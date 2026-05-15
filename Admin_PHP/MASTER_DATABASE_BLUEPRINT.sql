-- ========================================================================
-- EDPS STUDIO MASTER DATABASE BLUEPRINT
-- Version: 2.0
-- Date: May 11, 2026
-- Description: Complete database schema with all features:
--              - Project Management
--              - Staff Management
--              - Task Monitoring & Progress Tracking
--              - Theme Preferences
--              - Location/Maps Support
--              - Priority Logic
--              - Activity Logging
-- ========================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- ========================================================================
-- 1. USERS TABLE
-- ========================================================================
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `role` enum('admin','manager','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_users_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- 2. STAFF TABLE (Extended with Theme Preference)
-- ========================================================================
CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `role` enum('photographer','editor','assistant','manager') NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `join_date` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `profile_image` varchar(255) DEFAULT NULL,
  `theme_preference` enum('light','dark') DEFAULT 'light',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_staff_status` (`status`),
  KEY `idx_staff_role` (`role`),
  KEY `idx_theme_preference` (`theme_preference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- 3. PROJECTS TABLE (Extended with Priority & Location Support)
-- ========================================================================
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `status` enum('planning','in_progress','completed','cancelled') DEFAULT 'planning',
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `budget` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10, 8) DEFAULT NULL,
  `longitude` decimal(11, 8) DEFAULT NULL,
  `client_name` varchar(100) DEFAULT NULL,
  `client_email` varchar(100) DEFAULT NULL,
  `client_phone` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_projects_status` (`status`),
  KEY `idx_projects_priority` (`priority`),
  KEY `idx_projects_event_date` (`event_date`),
  KEY `idx_projects_location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- 4. PROJECT ASSIGNMENTS TABLE (Extended with Task Monitoring)
-- ========================================================================
CREATE TABLE `project_assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `role_in_project` varchar(100) DEFAULT NULL,
  `assigned_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('assigned','completed','removed') DEFAULT 'assigned',
  `progress_notes` text DEFAULT NULL,
  `internal_status` varchar(50) DEFAULT 'assigned',
  `task_status` enum('for_approval','on_process','on_hold','lack_of_info','completed') DEFAULT 'for_approval',
  `admin_feedback` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_assignment` (`project_id`,`staff_id`),
  KEY `idx_project_assignments_project` (`project_id`),
  KEY `idx_project_assignments_staff` (`staff_id`),
  KEY `idx_task_status` (`task_status`),
  KEY `idx_internal_status` (`internal_status`),
  FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- 5. PROJECT MEDIA TABLE
-- ========================================================================
CREATE TABLE `project_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `file_type` enum('image','video','document') DEFAULT 'image',
  `uploaded_by` int(11) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_project_media_project` (`project_id`),
  KEY `idx_project_media_uploaded_by` (`uploaded_by`),
  FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`uploaded_by`) REFERENCES `staff` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- 6. PROJECT LOCATIONS/MAPS TABLE
-- ========================================================================
CREATE TABLE `project_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `latitude` decimal(10, 8) DEFAULT NULL,
  `longitude` decimal(11, 8) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `shooting_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_project_locations_project` (`project_id`),
  FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- 7. ACTIVITY LOG TABLE
-- ========================================================================
CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_activity_log_user` (`user_id`),
  KEY `idx_activity_log_entity` (`entity_type`,`entity_id`),
  KEY `idx_activity_log_created` (`created_at`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- 8. TASK MONITORING TABLE (For detailed task tracking)
-- ========================================================================
CREATE TABLE `task_monitoring` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) NOT NULL,
  `completion_percentage` int(3) DEFAULT 0,
  `last_updated_by` int(11) DEFAULT NULL,
  `estimated_completion_date` date DEFAULT NULL,
  `actual_completion_date` date DEFAULT NULL,
  `blockers` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_task_monitoring_assignment` (`assignment_id`),
  KEY `idx_task_monitoring_updated_by` (`last_updated_by`),
  FOREIGN KEY (`assignment_id`) REFERENCES `project_assignments` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`last_updated_by`) REFERENCES `staff` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================================
-- VIEWS
-- ========================================================================

-- --------------------------------------------------------
-- View: Active Projects (In Planning or In Progress)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `active_projects`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `active_projects` AS
  SELECT 
    `p`.`id` AS `id`,
    `p`.`name` AS `name`,
    `p`.`description` AS `description`,
    `p`.`event_date` AS `event_date`,
    `p`.`status` AS `status`,
    `p`.`priority` AS `priority`,
    `p`.`budget` AS `budget`,
    `p`.`location` AS `location`,
    `p`.`client_name` AS `client_name`,
    `p`.`client_email` AS `client_email`,
    `p`.`client_phone` AS `client_phone`,
    `p`.`notes` AS `notes`,
    `p`.`created_at` AS `created_at`,
    `p`.`updated_at` AS `updated_at`,
    count(`pa`.`staff_id`) AS `assigned_staff`
  FROM 
    (`projects` `p` left join `project_assignments` `pa` on(
      `p`.`id` = `pa`.`project_id` and `pa`.`status` = 'assigned'
    ))
  WHERE 
    `p`.`status` in ('planning', 'in_progress')
  GROUP BY 
    `p`.`id`;

-- --------------------------------------------------------
-- View: Project Details (with assigned staff names)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `project_details`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `project_details` AS
  SELECT 
    `p`.`id` AS `id`,
    `p`.`name` AS `name`,
    `p`.`description` AS `description`,
    `p`.`event_date` AS `event_date`,
    `p`.`status` AS `status`,
    `p`.`priority` AS `priority`,
    `p`.`budget` AS `budget`,
    `p`.`location` AS `location`,
    `p`.`client_name` AS `client_name`,
    `p`.`client_email` AS `client_email`,
    `p`.`client_phone` AS `client_phone`,
    `p`.`notes` AS `notes`,
    `p`.`created_at` AS `created_at`,
    `p`.`updated_at` AS `updated_at`,
    group_concat(distinct concat(
      `s`.`name`, ' (', `pa`.`role_in_project`, ')'
    ) separator ', ') AS `assigned_staff`
  FROM 
    ((`projects` `p` left join `project_assignments` `pa` on(
      `p`.`id` = `pa`.`project_id` and `pa`.`status` = 'assigned'
    )) left join `staff` `s` on(`pa`.`staff_id` = `s`.`id`))
  GROUP BY 
    `p`.`id`;

-- --------------------------------------------------------
-- View: Staff Workload (Active projects per staff)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `staff_workload`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `staff_workload` AS
  SELECT 
    `s`.`id` AS `id`,
    `s`.`name` AS `name`,
    `s`.`email` AS `email`,
    `s`.`role` AS `role`,
    `s`.`phone` AS `phone`,
    `s`.`join_date` AS `join_date`,
    `s`.`status` AS `status`,
    `s`.`profile_image` AS `profile_image`,
    `s`.`created_at` AS `created_at`,
    `s`.`updated_at` AS `updated_at`,
    count(`pa`.`project_id`) AS `active_projects`
  FROM 
    ((`staff` `s` left join `project_assignments` `pa` on(
      `s`.`id` = `pa`.`staff_id` and `pa`.`status` = 'assigned'
    )) left join `projects` `p` on(
      `pa`.`project_id` = `p`.`id` and `p`.`status` in ('planning', 'in_progress')
    ))
  WHERE 
    `s`.`status` = 'active'
  GROUP BY 
    `s`.`id`;

-- ========================================================================
-- INDEXES
-- ========================================================================

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_staff_status` (`status`),
  ADD KEY `idx_staff_role` (`role`),
  ADD KEY `idx_theme_preference` (`theme_preference`);

ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_projects_status` (`status`),
  ADD KEY `idx_projects_priority` (`priority`),
  ADD KEY `idx_projects_event_date` (`event_date`),
  ADD KEY `idx_projects_location` (`location`);

ALTER TABLE `project_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_assignment` (`project_id`,`staff_id`),
  ADD KEY `idx_project_assignments_project` (`project_id`),
  ADD KEY `idx_project_assignments_staff` (`staff_id`),
  ADD KEY `idx_task_status` (`task_status`),
  ADD KEY `idx_internal_status` (`internal_status`);

ALTER TABLE `project_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_project_media_project` (`project_id`),
  ADD KEY `idx_project_media_uploaded_by` (`uploaded_by`);

ALTER TABLE `project_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_project_locations_project` (`project_id`);

ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_activity_log_user` (`user_id`),
  ADD KEY `idx_activity_log_entity` (`entity_type`,`entity_id`),
  ADD KEY `idx_activity_log_created` (`created_at`);

ALTER TABLE `task_monitoring`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_task_monitoring_assignment` (`assignment_id`),
  ADD KEY `idx_task_monitoring_updated_by` (`last_updated_by`);

-- ========================================================================
-- AUTO_INCREMENT DEFINITIONS
-- ========================================================================

ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `staff` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `projects` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `project_assignments` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `project_media` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `project_locations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `activity_log` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `task_monitoring` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ========================================================================
-- FOREIGN KEY CONSTRAINTS
-- ========================================================================

ALTER TABLE `project_assignments`
  ADD CONSTRAINT `project_assignments_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_assignments_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

ALTER TABLE `project_media`
  ADD CONSTRAINT `project_media_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_media_ibfk_2` FOREIGN KEY (`uploaded_by`) REFERENCES `staff` (`id`) ON DELETE SET NULL;

ALTER TABLE `project_locations`
  ADD CONSTRAINT `project_locations_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

ALTER TABLE `task_monitoring`
  ADD CONSTRAINT `task_monitoring_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `project_assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_monitoring_ibfk_2` FOREIGN KEY (`last_updated_by`) REFERENCES `staff` (`id`) ON DELETE SET NULL;

-- ========================================================================
-- END OF MASTER DATABASE BLUEPRINT
-- ========================================================================

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
