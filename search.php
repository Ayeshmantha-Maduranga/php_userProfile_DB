<?php
include("db_connection.php"); // Include the database connection script

// $input = 'Oe<%Zj7vY03S';
$input = $_POST['input'];

$query = "SELECT * FROM profiles WHERE qrCode LIKE '$input'";
// $result = $connection->query($query);
$result = mysqli_query($connection, $query);

if ($result->num_rows > 0) {
    while($row =mysqli_fetch_assoc($result))
    {
        $id = $row['id'];
        $name = $row['name'];
        $gender = $row['gender'];
        $email = $row['email'];
        $telNumber = $row['telNumber'];
        $address = $row['address'];
        $qrCode = $row['qrCode'];
    }
    echo json_encode(array(
        "statusCode" => 200, 
        "id" => $id,
        "name" => $name,
        "gender" => $gender,
        "email" => $email,
        "telNumber" => $telNumber,
        "address" => $address,
        "qrCode" => $qrCode,
    ));
} else {
    echo json_encode(array("statusCode"=>201));
}

$connection->close();
?>