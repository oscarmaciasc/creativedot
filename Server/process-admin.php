<?php
    session_start();

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "arte";

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connection_error);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            if (isset($_POST['new_username']) && isset($_POST['new_password'])) {
            // Registration Logic
            
            $newUsername = $_POST['new_username'];
            $newPassword = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
            $nombre = $_POST['nombre'];
            $correo = $_POST['email'];
            $paterno = $_POST['paterno'];
            $materno = $_POST['materno'];
            $cellphone = $_POST['cellphone'];
            $cp = $_POST['cp'];
            $rol = "admin";

            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena, user, paterno, materno, cellphone, cp, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssiis", $nombre, $correo, $newPassword, $newUsername, $paterno, $materno, $cellphone, $cp, $rol);
            $stmt->execute();

            header('Location: ../login-user.html');
            //echo 'Registration succesful. <a href="../login.html">Login</a>';
            $stmt->close();
        } elseif (isset($_GET['logout']) && $_GET['logout'] === 'true') {
            // Logout logic
            session_unset();
            session_destroy();
            header('Location: ../index-admin.php');
        } else {
            // If the user tries to access process.php directly
            header('Location: ../index-admin.php');
        }

        $conn->close();
    }
?>