<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nombre = $_POST['artist-name'];
    $descripcion = $_POST['description'];
    $idArtista = $_POST['id-artista'];

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
    $stmt = $conn->prepare("UPDATE artista
    SET nombre = ?, descripcion = ?
    WHERE idArtista = ?");
    $stmt->bind_param("ssi", $nombre, $descripcion, $idArtista);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        header('Location: admin-artists.php');
    } else {
        echo "Error al editar el artista: " . $stmt->error;
    }

    // Cerrar la conexión y la declaración
    $stmt->close();

    $conn->close();
}
