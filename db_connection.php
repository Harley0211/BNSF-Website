<?php
// Database connection settings
$db_host = 'localhost';
$db_username = 'root';
$db_password = ''; // or 'password' if you set one
$db_name = 'student_teacher_admin';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>