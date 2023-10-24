MYSQL USER
qrAppUser   AL9hZxC3gG*G

https://goqr.me/api/

<?php
$host = 'localhost'; // Your database host
$username = 'collabse_qrAppUser'; // Your database username
$password = 'AL9hZxC3gG*G'; // Your database password
$database = 'collabse_qrGuest'; // Your database name

// Create a connection
$connection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>