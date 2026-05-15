-- EDPS Studio Admin Database Blueprint
-- Complete schema without sample data

-- Users Table (Core Authentication & Theme Preference)
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    phone VARCHAR(20),
    role ENUM('admin', 'staff', 'client') DEFAULT 'staff',
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    profile_image VARCHAR(255),
    theme_preference ENUM('light', 'dark') DEFAULT 'light',
    is_email_verified TINYINT(1) DEFAULT 0,
    two_factor_enabled BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_username (username),
    INDEX idx_role (role),
    INDEX idx_status (status)
);

-- Staff Table (Extended Staff Information)
CREATE TABLE IF NOT EXISTS staff (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150),
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    username VARCHAR(100),
    role ENUM('photographer', 'editor', 'assistant', 'manager', 'admin') DEFAULT 'assistant',
    phone VARCHAR(20),
    join_date DATE,
    profile_image VARCHAR(255),
    theme_preference ENUM('light', 'dark') DEFAULT 'light',
    is_email_verified TINYINT(1) DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status),
    INDEX idx_join_date (join_date),
    INDEX idx_first_name (first_name),
    INDEX idx_last_name (last_name)
);

-- Projects Table
CREATE TABLE IF NOT EXISTS projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project_name VARCHAR(200) NOT NULL,
    description LONGTEXT,
    category VARCHAR(100),
    client_id INT,
    event_date DATE,
    start_date DATE,
    end_date DATE,
    budget DECIMAL(12, 2),
    status ENUM('planning', 'in_progress', 'completed', 'on_hold', 'cancelled') DEFAULT 'planning',
    priority ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_event_date (event_date),
    INDEX idx_category (category),
    INDEX idx_priority (priority)
);

-- Project Assignments Table
CREATE TABLE IF NOT EXISTS project_assignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT NOT NULL,
    staff_id INT NOT NULL,
    role_in_project VARCHAR(100),
    assigned_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('assigned', 'completed', 'rejected', 'pending') DEFAULT 'assigned',
    estimated_hours INT,
    actual_hours INT,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE,
    INDEX idx_project_id (project_id),
    INDEX idx_staff_id (staff_id),
    INDEX idx_status (status),
    UNIQUE KEY unique_assignment (project_id, staff_id)
);

-- Tasks Table
CREATE TABLE IF NOT EXISTS tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT NOT NULL,
    task_name VARCHAR(200) NOT NULL,
    description LONGTEXT,
    assigned_to INT,
    status ENUM('pending', 'in_progress', 'completed', 'blocked', 'cancelled') DEFAULT 'pending',
    priority ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium',
    due_date DATE,
    start_date DATE,
    completion_date TIMESTAMP NULL,
    estimated_hours INT,
    actual_hours INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES staff(id) ON DELETE SET NULL,
    INDEX idx_project_id (project_id),
    INDEX idx_assigned_to (assigned_to),
    INDEX idx_status (status),
    INDEX idx_due_date (due_date)
);

-- Events Table
CREATE TABLE IF NOT EXISTS events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_name VARCHAR(200) NOT NULL,
    description LONGTEXT,
    event_date DATE NOT NULL,
    event_time TIME,
    location VARCHAR(300),
    event_type VARCHAR(100),
    status ENUM('scheduled', 'in_progress', 'completed', 'cancelled') DEFAULT 'scheduled',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES staff(id) ON DELETE SET NULL,
    INDEX idx_event_date (event_date),
    INDEX idx_status (status)
);

-- Announcements Table
CREATE TABLE IF NOT EXISTS announcements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    priority ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium',
    created_by INT,
    status ENUM('draft', 'published', 'archived') DEFAULT 'published',
    published_at TIMESTAMP,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES staff(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_published_at (published_at)
);

-- Categories Table (for Project/Gallery Organization)
CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(150) NOT NULL UNIQUE,
    description TEXT,
    color_code VARCHAR(7),
    icon VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (is_active)
);

-- Gallery Table
CREATE TABLE IF NOT EXISTS gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT,
    title VARCHAR(255),
    description LONGTEXT,
    image_path VARCHAR(500) NOT NULL,
    thumbnail_path VARCHAR(500),
    category_id INT,
    uploaded_by INT,
    image_type ENUM('photo', 'video', 'document', 'other') DEFAULT 'photo',
    file_size INT,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_featured BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (uploaded_by) REFERENCES staff(id) ON DELETE SET NULL,
    INDEX idx_project_id (project_id),
    INDEX idx_category_id (category_id),
    INDEX idx_upload_date (upload_date)
);

-- Packages Table (Service Packages)
CREATE TABLE IF NOT EXISTS packages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    package_name VARCHAR(255) NOT NULL,
    description LONGTEXT,
    price DECIMAL(12, 2),
    duration INT COMMENT 'Duration in hours',
    features LONGTEXT,
    included_items LONGTEXT,
    category_id INT,
    status ENUM('active', 'inactive', 'archived') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_status (status)
);

-- Bulletins Table
CREATE TABLE IF NOT EXISTS bulletins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    category_id INT,
    priority ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium',
    created_by INT,
    status ENUM('draft', 'published', 'archived') DEFAULT 'published',
    published_at TIMESTAMP,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES staff(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_published_at (published_at)
);

-- Audit Log Table
CREATE TABLE IF NOT EXISTS audit_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(100),
    entity_id INT,
    old_values LONGTEXT,
    new_values LONGTEXT,
    ip_address VARCHAR(45),
    user_agent VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at),
    INDEX idx_action (action)
);

-- Session Table (for Session Management)
CREATE TABLE IF NOT EXISTS sessions (
    session_id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255),
    ip_address VARCHAR(45),
    user_agent VARCHAR(500),
    expires_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_expires_at (expires_at)
);

-- Notifications Table
CREATE TABLE IF NOT EXISTS notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255),
    message LONGTEXT,
    notification_type ENUM('info', 'warning', 'error', 'success') DEFAULT 'info',
    related_entity VARCHAR(100),
    related_entity_id INT,
    is_read BOOLEAN DEFAULT FALSE,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_is_read (is_read),
    INDEX idx_created_at (created_at)
);

-- Settings Table (System & User Settings)
CREATE TABLE IF NOT EXISTS settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value LONGTEXT,
    user_id INT,
    is_system_wide BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_setting_key (setting_key),
    INDEX idx_user_id (user_id)
);

-- Create Indexes for Better Performance
CREATE INDEX idx_staff_email ON staff(email);
CREATE INDEX idx_staff_role ON staff(role);
CREATE INDEX idx_projects_status ON projects(status);
CREATE INDEX idx_tasks_project_id ON tasks(project_id);
CREATE INDEX idx_tasks_assigned_to ON tasks(assigned_to);
CREATE INDEX idx_events_date ON events(event_date);
CREATE INDEX idx_announcements_created ON announcements(created_at);
CREATE INDEX idx_gallery_project_id ON gallery(project_id);
