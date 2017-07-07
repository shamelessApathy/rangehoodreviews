<?php
$servername = "localhost";
$username = "admin_dev";
$password = "proline55";
$dbname = "test_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO test_table (random_vote) VALUES (?)");
$stmt->bind_param("i", $random_vote);

// set parameters and execute
$randomNumber = rand(0,5);
$random_vote = $randomNumber;
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?>