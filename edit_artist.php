<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form submission
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $idArtista = isset($_POST['idArtista']) ? $_POST['idArtista'] : '';

    // Conectar a la base de datos (reemplaza con tus propias credenciales)
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "arte";

    $conn = new mysqli($host, $username, $password, $database);

    // $id_query = $conn->prepare("SELECT idProducto FROM producto WHERE nombre = ?");
    // $id_query->bind_param("s", $nombre);
    // $id_query->execute();
    // $id_result = $id_query->get_result();

    // if ($id_result->num_rows > 0) {
    //     $row = $id_result->fetch_assoc();
    //     $id = $row['idProducto'];
    // } else {
    //     echo "No se encontró el producto con el nombre proporcionado.";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <title>Edit Artist</title>
</head>
<header class="HeadFlex">
    <div class="HeadLogo">
        <h1>creative.dot</h1>
    </div>
    <div class="HeadNav">
        <a href="index-admin.php">HOME</a>
        <a href="admin-products.php">PRODUCTS</a>
        <a href="admin-artists.php">ARTISTS</a>
        <a href="log.php">LOG</a>
        <a href="Server/process-user.php?logout=true">LOGOUT</a>
    </div>
    <div class="HeadHamburguer">

        <div class="hamburguer">
            <div class="bar"></div>
        </div>
    </div>
</header>

<nav class="mobile-nav">
    <a href="index-admin.php">HOME</a>
    <a href="admin-products.php">STORE</a>
    <a href="admin-artists.php">ARTISTS</a>
    <a href="log.php">LOG</a>
    <a href="Server/process-user.php?logout=true">LOGOUT</a>
</nav>

<body>
    <div class="Container">
        <div class="AddContainer">
            <div class="FormContainer">
                <h1 class="centerTitle">Edit Artist</h1>
            </div>
            <form style="width: 50%;" method="post" action="process-edit-artist.php">
                <div class="form-flex">
                    <label for="product-name">Nombre de Artista</label>
                    <input type="text" id="artist-name" name="artist-name" required placeholder="<?php echo htmlspecialchars($nombre); ?>">

                    <input type="hidden" name="id-artista" id="id-artista" value="<?php echo htmlspecialchars($idArtista); ?>">

                    <label for="description">Descripcion</label>
                    <input style="height: 100px;" type="text" id="description" name="description" required placeholder="<?php echo htmlspecialchars($descripcion); ?>">
                </div>
                <div>
                    <button type="submit">EDIT</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        window.onload = function() {
            const menu_btn = document.querySelector('.hamburguer');
            const mobile_menu = document.querySelector('.mobile-nav');
            menu_btn.addEventListener('click', function() {
                menu_btn.classList.toggle('is-active');
                mobile_menu.classList.toggle('is-active');
            })
        }
    </script>
</body>
<footer class="foot">
    <h1><strong>Created By: </strong>Oscar Alejandro Macias Castillo.</h1>
    <h1><strong>From: </strong>4P Software Development - Database and Web Development.</h1>
</footer>

</html>