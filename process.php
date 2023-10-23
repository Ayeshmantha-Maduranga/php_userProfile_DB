<?php
include("db_connection.php"); // Include the database connection script

if (isset($_POST['save'])) {
    // Save a new user profile
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $passCode = $_POST['passCode'];
    $telNumber = $_POST['telNumber'];

    $query = "INSERT INTO profiles (firstName, lastName, gender, email, passCode, telNumber) VALUES ('$firstName', '$lastName', '$gender', '$email', '$passCode', $telNumber)";
    $result = $connection->query($query);

    if ($result) {
        echo "Profile saved successfully!";
    } else {
        echo "Error: " . $connection->error;
    }
}

if (isset($_POST['update'])) {
    // Update an existing user profile
    $profile_id = $_POST['profile_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $passCode = $_POST['passCode'];
    $telNumber = $_POST['telNumber'];

    $query = "UPDATE profiles SET firstName='$firstName', lastName='$lastName', gender='$gender', email='$email', passCode='$passCode', telNumber=$telNumber WHERE id=$profile_id";
    $result = $connection->query($query);

    if ($result) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $connection->error;
    }
}

$connection->close();
?>
