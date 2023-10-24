<?php
include("db_connection.php"); // Include the database connection script

$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$telNumber = $_POST['telNumber'];
$address = $_POST['address'];
$qrCode = $_POST['qrCode'];

$query = "INSERT INTO profiles (name, gender, email, telNumber, address, qrCode) VALUES ('$name', '$gender', '$email', '$telNumber', '$address', '$qrCode')";
$result = $connection->query($query);

if ($result) {
    echo json_encode(array("statusCode"=>200));
} else {
    echo json_encode(array("statusCode"=>201));
}

$connection->close();
?>