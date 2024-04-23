<?php

session_start();

// Check if 'user' key is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userRole = getUserRole($username);
    $userEmail = getUserEmail($username);
    //echo "User role: " . $userRole;
} else {
    echo "User not logged in.";
}

function getUserRole($username) {
    // Replace the database connection details with your actual credentials
    $host = "localhost";
    $dbUsername = "root";
    $password = "";
    $database = "arte";

    // Create a connection
    $conn = new mysqli($host, $dbUsername, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT rol FROM usuarios WHERE user = ?");

    // Check if the 'user' key is set in the session
    if (isset($_SESSION['username'])) {
        // Note: Do not redefine $username here
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($userRole);
        $stmt->fetch();

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Return the user's role
        return $userRole;
    } else {
        // Handle the case where 'user' key is not set in the session
        return 'unknown';
    }
}

function getUserEmail($username) {
     // Replace the database connection details with your actual credentials
     $host = "localhost";
     $dbUsername = "root";
     $password = "";
     $database = "arte";
 
     // Create a connection
     $conex = new mysqli($host, $dbUsername, $password, $database);
 
     // Check the connection
     if ($conex->connect_error) {
         die("Connection failed: " . $conex->connect_error);
     }
 
     // Use a prepared statement to prevent SQL injection
     $stmt = $conex->prepare("SELECT correo FROM usuarios WHERE user = ?");
 
     // Check if the 'user' key is set in the session
     if (isset($_SESSION['username'])) {
         // Note: Do not redefine $username here
         $stmt->bind_param("s", $username);
         $stmt->execute();
         $stmt->bind_result($userEmail);
         $stmt->fetch();
 
         // Close the statement and connection
         $stmt->close();
         $conex->close();
 
         // Return the user's role
         return $userEmail;
     } else {
         // Handle the case where 'user' key is not set in the session
         return 'unknown';
     }
    }

?>