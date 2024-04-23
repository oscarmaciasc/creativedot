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

    // Check if the product is already in the cart
    $cart_query = $conn->prepare("SELECT * FROM carrito WHERE idUsuario = ? AND idProducto = ?");
    $cart_query->bind_param("ii", $user_id, $product_id);
    $cart_query->execute();
    $cart_result = $cart_query->get_result();
    $cart_query->close();

    if ($cart_result->num_rows > 0) {
        // Product is already in the cart, update the quantity
        $update_query = $conn->prepare("UPDATE carrito SET cantidad = cantidad + ? WHERE idUsuario = ? AND idProducto = ?");
        $update_query->bind_param("dii", $quantity, $user_id, $product_id);
        $update_query->execute();
        $update_query->close();
    } else {
        // Product is not in the cart, insert a new row
        $insert_query = $conn->prepare("INSERT INTO carrito (idUsuario, idProducto, cantidad) VALUES (?, ?, ?)");
        $insert_query->bind_param("iid", $user_id, $product_id, $quantity);
        $insert_query->execute();
        $insert_query->close();
    }

    // Redirect back to the productos.php or carrito view
    header("Location: productos.php");
    exit();
} else {
    echo "User not logged in";
}
