<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'healthcare_friends_diagnosis_database';

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}