<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $id = $_POST['idProducto'];

    $sql = $conn->prepare("SELECT idProducto, nombre, precio, descripcion, img FROM producto WHERE idProducto = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Fetch associative array
        $products = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($products);     
    } else {
        echo "No product found";
    }
}

    $sql->close();
    $conn->close();
?>