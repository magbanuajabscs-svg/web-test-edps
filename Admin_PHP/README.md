# EDPS Studio Admin Panel - Backend Setup Guide

## Overview
This is a complete PHP-based admin panel for EDPS Studio with MySQL database backend. The system includes staff management, project creation, and assignment functionality.

## Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP/MAMP (recommended for local development)

## Installation Steps

### 1. Database Setup
1. Open phpMyAdmin (usually at `http://localhost/phpmyadmin`)
2. Create a new database named `edps_studio`
3. Import the `database_schema.sql` file:
   - Go to the "Import" tab
   - Select the `database_schema.sql` file
   - Click "Go"

### 2. Configuration
1. Open `config.php` and update the database credentials if needed:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'edps_studio');
   define('DB_USER', 'root'); // Default XAMPP user
   define('DB_PASS', '');     // Default XAMPP password
   ```

### 3. File Structure
Place all files in your web server's document root (e.g., `htdocs` for XAMPP):
```
Admin_PHP/
├── api/
│   ├── auth.php      # Authentication endpoints
│   ├── staff.php     # Staff CRUD API
│   └── project.php   # Project CRUD API
├── Bulletin.php      # Dashboard
├── stafflist.php     # Staff directory
├── createproj.php    # Project creation
├── staffassign.php   # Staff assignment
├── reviewproj.php    # Project review
├── staffmanage.php   # Staff management
├── staffregister.php # Staff registration
├── viewprojects.php  # Project monitoring
├── webedit.php       # Website CMS
├── config.php        # Database configuration
├── Database.php      # PDO singleton class
├── Staff.php         # Staff model
├── Project.php       # Project model
├── User.php          # User authentication
└── database_schema.sql
```

### 4. Access the Application
Open your browser and navigate to:
```
http://localhost/Admin_PHP/Bulletin.php
```

## Features

### Staff Management
- Register new staff members
- View all staff with project assignments
- Edit staff information
- Delete staff accounts

### Project Management
- Create new projects with detailed information
- Assign staff to projects
- Review and finalize project details
- Monitor project status

### API Endpoints
All CRUD operations are available via REST API:

#### Staff API (`api/staff.php`)
- `GET /api/staff.php` - Get all staff
- `GET /api/staff.php?id=1` - Get staff by ID
- `POST /api/staff.php` - Create new staff
- `PUT /api/staff.php?id=1` - Update staff
- `DELETE /api/staff.php?id=1` - Delete staff

#### Project API (`api/project.php`)
- `GET /api/project.php` - Get all projects
- `GET /api/project.php?id=1` - Get project by ID
- `POST /api/project.php` - Create new project
- `PUT /api/project.php?id=1` - Update project
- `DELETE /api/project.php?id=1` - Delete project

#### Authentication API (`api/auth.php`)
- `POST /api/auth.php` (action=login) - User login
- `POST /api/auth.php` (action=logout) - User logout
- `POST /api/auth.php` (action=check_session) - Check login status

## Database Schema

### Tables
- `users` - Admin user accounts
- `staff` - Staff member information
- `projects` - Project details
- `project_assignments` - Staff-project relationships

### Default Admin Account
After importing the schema, create an admin user:
```sql
INSERT INTO users (username, password, role, created_at)
VALUES ('admin', '$2y$10$hashed_password', 'admin', NOW());
```

## Security Features
- Password hashing with bcrypt
- Prepared statements to prevent SQL injection
- Input sanitization
- Session-based authentication
- CORS headers for API security

## Troubleshooting

### Common Issues
1. **Database connection error**: Check credentials in `config.php`
2. **Permission denied**: Ensure proper file permissions (755 for directories, 644 for files)
3. **PHP errors**: Check PHP error logs in XAMPP control panel
4. **API not working**: Ensure `mod_rewrite` is enabled in Apache

### Debug Mode
To enable error reporting, add this to the top of PHP files:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## Development Notes
- All form submissions now use PHP POST instead of localStorage
- Session management is implemented for project creation workflow
- API endpoints return JSON responses
- Frontend uses AJAX for dynamic interactions

## Next Steps
1. Implement user authentication UI
2. Add file upload functionality for project assets
3. Create reporting dashboard
4. Add email notifications
5. Implement role-based access control