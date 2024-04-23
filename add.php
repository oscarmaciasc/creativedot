<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nombre = $_POST['product-name'];
    $precio = $_POST['price'];
    $descripcion = $_POST['description'];
    $idArtista = $_POST['artist'];
    //$img = $_POST['image'];

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

    $targetDirectory = "img/";  // Assuming your images are stored in the "img" directory
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $imgPath = $targetFile;

    // Preparar la declaración SQL para insertar el producto
    $stmt = $conn->prepare("INSERT INTO producto (nombre, precio, descripcion, img, idArtista) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssi", $nombre, $precio, $descripcion, $imgPath, $idArtista); // 's' para cadena (string), 'd' para decimal (double)

    // Ejecutar la declaración
    if ($stmt->execute()) {
        header('Location: admin-products.php');
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }

    // Cerrar la conexión y la declaración
    $stmt->close();
    $conn->close();
}
?>