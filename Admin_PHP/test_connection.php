<?php
// Database Connection Test Script
// Run this file to test if your database connection is working

require_once 'config.php';
require_once 'Database.php';

try {
    $db = Database::getInstance();
    echo "<h1 style='color: green;'>✓ Database Connection Successful!</h1>";
    echo "<p>Your EDPS Studio admin panel is ready to use.</p>";
    echo "<p><a href='Bulletin.php'>Go to Dashboard</a></p>";

    // Test if tables exist
    $stmt = $db->prepare("SHOW TABLES");
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "<h2>Database Tables Found:</h2>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";

    if (count($tables) === 0) {
        echo "<p style='color: red;'>⚠️ No tables found. Please import database_schema.sql in phpMyAdmin.</p>";
    }

} catch (Exception $e) {
    echo "<h1 style='color: red;'>✗ Database Connection Failed</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<h2>Troubleshooting Steps:</h2>";
    echo "<ol>";
    echo "<li>Make sure XAMPP/WAMP is running</li>";
    echo "<li>Check that MySQL service is started</li>";
    echo "<li>Verify database credentials in config.php</li>";
    echo "<li>Ensure database 'edps_studio' exists in phpMyAdmin</li>";
    echo "<li>Import database_schema.sql file</li>";
    echo "</ol>";
}
?>