<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form submission
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : '';

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
    <title>Edit</title>
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
                <h1 class="centerTitle">Edit Product</h1>
            </div>
            <form style="width: 50%;" method="post" action="process-edit.php">
                <div class="form-flex">
                    <label for="product-name">Nombre de Producto</label>
                    <input type="text" id="product-name" name="product-name" required placeholder="<?php echo htmlspecialchars($nombre); ?>">

                    <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($idProducto); ?>">

                    <label for="price">Precio</label>
                    <input type="number" id="price" name="price" required placeholder="<?php echo htmlspecialchars($precio); ?>">

                    <label for="artist">Select an artist:</label>
                    <select name="artist" id="artist"></select>

                    <script>
                        // Function to fetch artist data from getArtist.php
                        function fetchArtists() {
                            fetch('getArtist.php')
                                .then(response => response.json())
                                .then(data => {
                                    // Get the select element and hidden input
                                    const artistSelect = document.getElementById('artist');
                                    const idArtistaInput = document.getElementById('idArtista');

                                    // Iterate through the fetched data and add options to the select element
                                    data.forEach(artist => {
                                        const option = document.createElement('option');
                                        option.value = artist.idArtista; // Use the artist ID as the option value
                                        option.text = artist.nombre; // Use the artist name as the option text
                                        artistSelect.appendChild(option);
                                    });

                                    // Add an event listener to the select element
                                    artistSelect.addEventListener('change', function () {
                                        // Get the selected value (idArtista)
                                        const selectedIdArtista = this.value;

                                        // Update the hidden input value with the selected idArtista
                                        idArtistaInput.value = selectedIdArtista;
                                    });
                                })
                                .catch(error => console.error('Error fetching artist data:', error));
                        }

                        // Call the function to fetch and populate the artist data
                        fetchArtists();
                    </script>

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