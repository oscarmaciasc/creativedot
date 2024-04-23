<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/vendor/autoload.php'; // Adjust the path based on your setup
$host = "localhost";
$username = "root";
$password = "";
$database = "arte";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->error);
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
        // Logout logic
        echo 'Hey, im working';
        session_unset();
        session_destroy();
        header('Location: ../landing.html');
    }else {
        // If the user tries to access process.php directly
        header('Location: ../index.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Login logic
        $username = $_POST['username'];
        //echo "El nombre de usuario es: " . $username;
        $password = $_POST['password'];
        //echo "La contrasena es: " . $password;

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE user = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $id_query = $conn->prepare("SELECT id FROM usuarios WHERE user = ?");
        $id_query->bind_param("s", $username);
        $id_query->execute();
        $id_query_result = $id_query->get_result();
        $rowId = $id_query_result->fetch_assoc();
        
        $user_id = $rowId['id']; 

        $rol = $conn->prepare("SELECT rol FROM usuarios WHERE user = ?");
        $rol->bind_param("s", $username);
        $rol->execute();
        $rolResult = $rol->get_result();
        $rowRol = $rolResult->fetch_assoc();


        // echo "SQL Query: SELECT * FROM usuarios WHERE user = '$username'";
        // print_r($row); // Check what's in $row

        if ($row && password_verify($password, $row['contrasena'])) {
            $_SESSION['username'] = $username;
            // Password is correct, set user_id in the session
            $_SESSION['user_id'] = $user_id;
            if ($rowRol['rol'] == "admin") {
                header('Location: ../index-admin.php');
                echo $rowRol;
            } else {
                header('Location: ../index.php');
                echo "ROL: " . $rowRol;
            }
        } else {
            $_SESSION['error_message'] = 'Invalid username or password';
            header('Location: ../login-user.php');
        }

        $stmt->close();
    } elseif (isset($_POST['new_username']) && isset($_POST['new_password'])) {
        // Registration Logic

        $newUsername = $_POST['new_username'];
        $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $nombre = $_POST['nombre'];
        $correo = $_POST['email'];
        $paterno = $_POST['paterno'];
        $materno = $_POST['materno'];
        $cellphone = $_POST['cellphone'];
        $cp = $_POST['cp'];
        $rol = "usuario";

        // Check for duplicate username or email
        $checkDuplicate = $conn->prepare("SELECT COUNT(*) as count FROM usuarios WHERE correo = ?");
        $checkDuplicate->bind_param("s", $correo);
        $checkDuplicate->execute();
        $duplicateResult = $checkDuplicate->get_result();
        $duplicateCount = $duplicateResult->fetch_assoc()['count'];

        $checkDuplicateUser = $conn->prepare("SELECT COUNT(*) as count FROM usuarios WHERE user = ?");
        $checkDuplicateUser->bind_param("s", $newUsername);
        $checkDuplicateUser->execute();
        $duplicateResultUser = $checkDuplicateUser->get_result();
        $duplicateCountUser = $duplicateResultUser->fetch_assoc()["count"];

        if ($duplicateCount > 0 || $duplicateCountUser > 0) {
            $_SESSION['registration_error'] = 'Error: Username or email already exists.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            // Insert the new user
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena, user, paterno, materno, cellphone, cp, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssiis", $nombre, $correo, $newPassword, $newUsername, $paterno, $materno, $cellphone, $cp, $rol);
            $stmt->execute();

            // Retrieve the ID of the newly inserted user
            $user_id = $conn->insert_id;

            // Set user_id in the session
            $_SESSION['user_id'] = $user_id;

            // Query to retrieve user information from the usuarios table
            $query = "SELECT * FROM usuarios WHERE correo = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

                // Fetch user details
                $userDetails = $result->fetch_assoc();
                echo "Correo: ". $userDetails["correo"] ." Nombre: ". $userDetails["nombre"];

                // Include the email template
                $emailTemplate = file_get_contents('../email_template.php');

                // Customize the template with user-specific information
                $emailContent = str_replace('[USERNAME]', $userDetails['nombre'], $emailTemplate); // Replace [USERNAME] with actual field

                // Use PHPMailer to send the email via a third-party SMTP server (e.g., Gmail)
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'oscarmaciasprof@gmail.com'; // Replace with your Gmail email address
                    $mail->Password   = 'nuvt wswt vcwv rtht'; // Replace with your Gmail password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    $mail->setFrom('oscarmaciasprof@gmail.com', 'Creative.dot'); // Replace with your Gmail email address and your name
                    $mail->addAddress($userDetails['correo'], $userDetails['nombre']); // Use the actual field names

                    $mail->isHTML(true);
                    $mail->Subject = 'Welcome to Our Website';
                    $mail->Body    = $emailContent;

                    $mail->send();
                    echo "Email sent successfully!";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

    
             header('Location: ../login-user.php');
            //echo 'Registration succesful. <a href="../login.html">Login</a>';
            $stmt->close();
        }

    } else {
        // If the user tries to access process.php directly
        header('Location: ../index.php');
    }

    $conn->close();
}
?>