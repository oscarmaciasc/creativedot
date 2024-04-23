<?php
    $servername = "localhost";
    $database = "arte";
    $username = "root";
    $password = "";

    $conexion = mysqli_connect($servername, $username, $password, $database);

    if(!$conexion) {
        die("Fallo la conexion " . mysqli_connect_error());
    } else {
        echo "Conexion Exitosa";
    }
?>