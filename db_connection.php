<?php
$host = 'localhost'; // Your database host
$username = 'root'; // Your database username
$password = ''; // Your database password
$database = 'guest'; // Your database name

// Create a connection
$connection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>