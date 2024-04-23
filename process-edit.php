<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nombre = $_POST['product-name'];
    $precio = $_POST['price'];
    $descripcion = $_POST['description'];
    $id = $_POST['id'];
    $idArtista = $_POST['artist'];

    // Validar y procesar los datos (puedes agregar más validaciones según tus necesidades)

    // Conectar a la base de datos (reemplaza con tus propias credenciales)
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "arte";

    $conn = new mysqli($host, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la declaración SQL para editar el producto
    $stmt = $conn->prepare("UPDATE producto
    SET nombre = ?, precio = ?, descripcion = ?, idArtista = ?
    WHERE idProducto = ?");
    $stmt->bind_param("sdsii", $nombre, $precio, $descripcion, $idArtista ,$id);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        header('Location: admin-products.php');
    } else {
        echo "Error al editar el producto: " . $stmt->error;
    }

    // Cerrar la conexión y la declaración
    $stmt->close();

    $conn->close();
}
