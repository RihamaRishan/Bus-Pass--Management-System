<?php
// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'buspasssystem');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving POST data
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
$dateofbirth = isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mobilenumber = isset($_POST['mobilenumber']) ? $_POST['mobilenumber'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
$idnumber = isset($_POST['idnumber']) ? $_POST['idnumber'] : '';
$issueddate = isset($_POST['issueddate']) ? $_POST['issueddate'] : '';
$expirydate = isset($_POST['expirydate']) ? $_POST['expirydate'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$address2 = isset($_POST['address2']) ? $_POST['address2'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$district = isset($_POST['district']) ? $_POST['district'] : '';
$zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
$country = isset($_POST['Country']) ? $_POST['Country'] : '';
$from = isset($_POST['from']) ? $_POST['from'] : '';
$to = isset($_POST['to']) ? $_POST['to'] : '';

// Prepared statement to insert data into the database
$stmt = $conn->prepare("INSERT INTO register (fullname, dateofbirth, email, mobilenumber, gender, occupation, idnumber, issueddate, expirydate, address, address2, city, district, zipcode, country, from_location, to_location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "sssssssssssssssss",
    $fullname, $dateofbirth, $email, $mobilenumber, $gender, $occupation, $idnumber, 
    $issueddate, $expirydate, $address, $address2, $city, $district, $zipcode, $country, $from, $to
);

// Execute the statement
if ($stmt->execute()) {
    $last_id = $stmt->insert_id; // Get the last inserted ID
    header("Location: invoice.php?id=$last_id"); // Redirect to invoice form with the ID
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
