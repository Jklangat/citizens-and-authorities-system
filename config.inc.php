<?php

define('APP', 'Forum');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'myforum_db');

// Make a database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    // Handle connection error gracefully
    // Log the error, display a user-friendly message, or redirect to an error page
    die("Connection failed: " . mysqli_connect_error());
}