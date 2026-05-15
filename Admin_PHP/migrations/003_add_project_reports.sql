-- Migration: Create project_reports table
-- Date: 2026-05-13
-- Description: Stores reports submitted by staff about projects for admin review

CREATE TABLE IF NOT EXISTS `project_reports` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `project_id` INT NOT NULL,
  `reporter_id` INT NOT NULL,
  `reason` TEXT NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `project_reports` ADD INDEX `idx_project_id` (`project_id`);

-- End Migration
