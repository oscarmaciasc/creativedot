<?php

session_start();

$userID = $_SESSION["user_id"];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arte";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch shopping quantity data
$sql = "SELECT SUM(cantidad) AS totalQuantity FROM carrito WHERE idUsuario = $userID";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    echo json_encode(['error' => 'Database error: ' . $conn->error]);
    exit;
}

// Fetch the result
$data = $result->fetch_assoc();

// Send the result as JSON
header('Content-Type: application/json');
echo json_encode($data);

?>