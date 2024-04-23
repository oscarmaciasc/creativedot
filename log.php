<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arte";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select data from the Bitacora table
$sql = "SELECT * FROM Bitacora";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="log.css">
    <link rel="stylesheet" href="normalize.css">
    <title>LOG</title>
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
        <h2>Log Table</h2>
        <p>Insert, Update and Delete actions on table Producto</p>

        <?php
        // Check if there is data in the result
        if ($result->num_rows > 0) {
            // Output data in a table
            echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Accion</th>
                <th>Fecha</th>
                <th>Sentencia</th>
                <th>Contrasentencia</th>
            </tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {

                // Conditionally displays a Class to change color of rows to be easier to identify 

                $class = '';
                if ($row['accion'] == 'Insercion') {
                    $class = 'Green';
                } elseif ($row['accion'] == 'Eliminacion') {
                    $class = 'Red';
                } elseif ($row['accion'] == 'Actualizacion') {
                    $class = 'Orange';
                }

                echo "<tr class='$class'>
                    <td>{$row['idBitacora']}</td>
                    <td>{$row['accion']}</td>
                    <td>{$row['fecha']}</td>
                    <td>{$row['sentencia']}</td>
                    <td>{$row['contrasentencia']}</td>
                  </tr>";
            }

            echo "</table>";
        } else {
            echo "No records found";
        }
        ?>
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