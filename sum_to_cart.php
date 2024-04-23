<?php

session_start();

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

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    echo 'product_id: ' . $product_id;
    echo 'quantity: ' . $quantity;
    echo 'user_id: '. $user_id;
    
        $update_query = $conn->prepare("UPDATE carrito SET cantidad = ? + 1 WHERE idUsuario = ? AND idProducto = ?");
        $update_query->bind_param("dii", $quantity, $user_id, $product_id);
        $update_query->execute();
        $update_query->close();

    // Redirect back to the productos.php or carrito view
    header("Location: productos.php");
    exit();
} else {
    echo "User not logged in";
}
