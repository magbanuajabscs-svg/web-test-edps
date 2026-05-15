-- Migration: Add Theme Preference Column to staff
-- Date: May 11, 2026
-- Description: Adds column for storing user's theme preference (light/dark mode)

ALTER TABLE `staff` 
ADD COLUMN `theme_preference` ENUM('light', 'dark') DEFAULT 'light' AFTER `profile_image`;

-- Add index for better query performance
ALTER TABLE `staff`
ADD INDEX `idx_theme_preference` (`theme_preference`);

-- Success: Column added successfully
