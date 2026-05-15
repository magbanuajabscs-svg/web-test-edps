-- Staff Portal Profile Image Schema
-- Add profile_image column to staff table if not exists

ALTER TABLE staff ADD COLUMN IF NOT EXISTS profile_image VARCHAR(255) DEFAULT NULL COMMENT 'Path to uploaded profile image';

-- Optional: Create an index on staff table if needed for performance
ALTER TABLE staff ADD INDEX idx_profile_image (profile_image);

-- Sample query to select staff with profile images
-- SELECT id, username, name, email, profile_image FROM staff WHERE profile_image IS NOT NULL;
