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

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if the product is in the cart
    $cart_query = $conn->prepare("SELECT cantidad FROM carrito WHERE idUsuario = ? AND idProducto = ?");
    $cart_query->bind_param("ii", $user_id, $product_id);
    $cart_query->execute();
    $cart_result = $cart_query->get_result();
    $cart_query->close();

    if ($cart_result->num_rows > 0) {
        $row = $cart_result->fetch_assoc();
        $current_quantity = $row['cantidad'];

        // Ensure the quantity cannot be less than zero
        if ($current_quantity > 1) {
            // Update the quantity
            $update_query = $conn->prepare("UPDATE carrito SET cantidad = ? - 1 WHERE idUsuario = ? AND idProducto = ?");
            $update_query->bind_param("dii", $current_quantity, $user_id, $product_id);
            $update_query->execute();
            $update_query->close();
        } else {
            // If the quantity is already zero, delete the row
            $delete_query = $conn->prepare("DELETE FROM carrito WHERE idUsuario = ? AND idProducto = ?");
            $delete_query->bind_param("ii", $user_id, $product_id);
            $delete_query->execute();
            $delete_query->close();
        }
    }

    // Redirect back to the productos.php or carrito view
    header("Location: productos.php");
    exit();
} else {
    echo "User not logged in";
}

?>