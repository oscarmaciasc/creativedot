<?php
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

// Retrieve product data
$sql = "SELECT * FROM artista";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch associative array
    $products = $result->fetch_all(MYSQLI_ASSOC);

    // Return JSON-encoded product data
    echo json_encode($products);
} else {
    echo "No products found";
}

// Close the connection
$conn->close();
?>