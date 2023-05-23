<?php
// Installer script for Chebut Tea Farmers Management System

// Database configuration
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'chebut';

// Create database connection
$connection = new mysqli($hostname, $username, $password);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($connection->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $connection->error . "\n";
    $connection->close();
    exit;
}

// Select the database
if (!$connection->select_db($database)) {
    echo "Error selecting database: " . $connection->error . "\n";
    $connection->close();
    exit;
}

// Import database schema
$sql = file_get_contents('database/chebut_tea_farmers_management_system.sql');
if ($connection->multi_query($sql) === TRUE) {
    echo "Database schema imported successfully\n";
} else {
    echo "Error importing database schema: " . $connection->error . "\n";
    $connection->close();
    exit;
}

// Update configuration file
$configFile = 'includes/config.php';
$configContent = file_get_contents($configFile);
$configContent = str_replace(
    ['YOUR_HOSTNAME', 'YOUR_USERNAME', 'YOUR_PASSWORD', 'YOUR_DATABASE'],
    [$hostname, $username, $password, $database],
    $configContent
);
if (file_put_contents($configFile, $configContent) !== FALSE) {
    echo "Configuration file updated successfully\n";
} else {
    echo "Error updating configuration file\n";
    $connection->close();
    exit;
}

// Installation completed
echo "Chebut Tea Farmers Management System installed successfully\n";

// Close the database connection
$connection->close();
