-- EDPS Studio Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS edps_studio;
USE edps_studio;

-- Staff table
CREATE TABLE IF NOT EXISTS staff (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    name VARCHAR(200),
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(20),
    role VARCHAR(50) NOT NULL DEFAULT 'staff',
    profile_image VARCHAR(255) DEFAULT NULL,
    is_email_verified TINYINT DEFAULT 0,
    theme_preference VARCHAR(10) DEFAULT 'light',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_profile_image (profile_image)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    client_name VARCHAR(150),
    status VARCHAR(50) DEFAULT 'planning',
    event_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_event_date (event_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Project assignments table
CREATE TABLE IF NOT EXISTS project_assignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT NOT NULL,
    staff_id INT NOT NULL,
    role_in_project VARCHAR(100),
    status VARCHAR(50) DEFAULT 'assigned',
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE,
    INDEX idx_staff_id (staff_id),
    INDEX idx_project_id (project_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin user (optional: seed data)
INSERT IGNORE INTO staff (username, password, first_name, last_name, name, email, phone, role, is_email_verified)
VALUES (
    'admin',
    '$2y$10$Sm3H4gSBEzx6Z.9L4D.DuO4.Wn4VV8n8N8E5C6K7L8M9N0O1P2Q3',
    'Admin',
    'User',
    'Admin User',
    'admin@edps-studio.com',
    '+1234567890',
    'admin',
    1
);
