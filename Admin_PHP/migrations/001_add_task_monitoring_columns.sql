-- Migration: Add Task Monitoring Columns to project_assignments
-- Date: May 6, 2026
-- Description: Adds columns for tracking staff task progress, admin approval, and feedback

ALTER TABLE `project_assignments` 
ADD COLUMN `progress_notes` TEXT DEFAULT NULL AFTER `status`,
ADD COLUMN `internal_status` VARCHAR(50) DEFAULT 'assigned' AFTER `progress_notes`,
ADD COLUMN `task_status` ENUM('for_approval', 'on_process', 'on_hold', 'lack_of_info', 'completed') DEFAULT 'for_approval' AFTER `internal_status`,
ADD COLUMN `admin_feedback` TEXT DEFAULT NULL AFTER `task_status`;

-- Add indexes for better query performance
ALTER TABLE `project_assignments`
ADD INDEX `idx_task_status` (`task_status`),
ADD INDEX `idx_internal_status` (`internal_status`);

-- Success: Columns added successfully
