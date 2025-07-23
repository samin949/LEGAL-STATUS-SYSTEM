<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_loan_cases";  // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
