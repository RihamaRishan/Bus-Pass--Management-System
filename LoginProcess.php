<?php

// Create connection
$conn = new mysqli('localhost', 'root', '', 'buspasssystem');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to check if the user exists and provided password is correct
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, login successful
    header('location:home.html');
    exit();
    
} else {
    // User not found or incorrect password
    echo "error";
}

// Closing connection
$conn->close();
?>
