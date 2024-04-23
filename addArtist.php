<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nombre = $_POST['artist-name'];
    $descripcion = $_POST['description'];
    $img = $_POST['image'];
    $idArtista = $_POST['idArtista'];

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

    $targetDirectory = "img/artists/";  // Assuming your images are stored in the "img" directory
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $imgPath = $targetFile;

    // Preparar la declaración SQL para insertar el producto
    $stmt = $conn->prepare("INSERT INTO artista (nombre, descripcion, img) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $descripcion, $imgPath); // 's' para cadena (string), 'd' para decimal (double)

    // Ejecutar la declaración
    if ($stmt->execute()) {
        header('Location: admin-artists.php');
    } else {
        echo "Error al agregar el artista: " . $stmt->error;
    }

    // Cerrar la conexión y la declaración
    $stmt->close();
    $conn->close();
}
?>