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

// Retrieve product data
$sql = "SELECT c.idProducto, c.cantidad, p.img, p.nombre AS product_name, p.precio FROM carrito c JOIN producto p ON c.idProducto = p.idProducto WHERE c.idUsuario = $userID";
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