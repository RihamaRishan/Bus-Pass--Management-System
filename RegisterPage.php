<?php
// Establishing connection to the database

// Create connection
$conn = new mysqli('localhost', 'root', '', 'buspasssystem');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query 
$sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

// Executing query
if ($conn->query($sql) === TRUE) {
  
    header('location:home.html');
    exit();
} else {
   
    echo "error";
}

// Closing connection
$conn->close();
?>
