<?php
include("db_connection.php"); // Include the database connection script

// --------------------------- INSERT DATA --------------------------------
if (isset($_POST['save'])) {
    // Save a new user profile
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $telNumber = $_POST['telNumber'];
    $address = $_POST['address'];
    $qrCode = 'hjhhkj';
    // $qrCode = generatePassCode();

    $query = "INSERT INTO profiles (name, gender, email, telNumber, address, qrCode) VALUES ('$name', '$gender', '$email', $telNumber, '$address', '$qrCode')";
    $result = $connection->query($query);

    if ($result) {
        echo "Profile saved successfully!";
    } else {
        echo "Error: " . $connection->error;
    }
}

// -------------------------- GEN PASS CODE -------------------------------

function generatePassCode() {
    $characterAmount = 12;
    $UPPERCASE_CHAR_CODES = arrayFromLowToHigh(65, 90);
    $LOWERCASE_CHAR_CODES = arrayFromLowToHigh(97, 122);
    $NUMBER_CHAR_CODES = arrayFromLowToHigh(48, 57);
    $SYMBOL_CHAR_CODES = array_merge(
        arrayFromLowToHigh(33, 47),
        arrayFromLowToHigh(58, 64),
        arrayFromLowToHigh(91, 96),
        arrayFromLowToHigh(123, 126)
    );

    global $LOWERCASE_CHAR_CODES, $UPPERCASE_CHAR_CODES, $SYMBOL_CHAR_CODES, $NUMBER_CHAR_CODES;

    $charCodes = $LOWERCASE_CHAR_CODES;
    // $charCodes = array_merge($charCodes, $UPPERCASE_CHAR_CODES);
    // $charCodes = array_merge($charCodes, $SYMBOL_CHAR_CODES);
    // $charCodes = array_merge($charCodes, $NUMBER_CHAR_CODES);

    $passwordCharacters = array();
    for ($i = 0; $i < $characterAmount; $i++) {
        $characterCode = $charCodes[rand(0, count($charCodes) - 1)];
        $passwordCharacters[] = chr($characterCode);
    }
    return implode('', $passwordCharacters);
}

function arrayFromLowToHigh($low, $high) {
    $array = array();
    for ($i = $low; $i <= $high; $i++) {
        $array[] = $i;
    }
    return $array;
}

//------------------------------------ END ----------------------------------
$connection->close();
?>
