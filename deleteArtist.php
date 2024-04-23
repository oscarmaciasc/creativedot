<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arte";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data sent from the client
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['artistID'])) {
        // Sanitize and validate the input
        $artistId = filter_var($data['artistID'], FILTER_SANITIZE_NUMBER_INT);
    
        // Prepare and execute the delete statement for related products
        $stmtDeleteProducts = $conn->prepare("DELETE FROM producto WHERE idArtista = ?");
        $stmtDeleteProducts->bind_param("i", $artistId);
    
        if ($stmtDeleteProducts->execute()) {
            // Products deleted successfully, now delete the artist
            $stmtDeleteArtist = $conn->prepare("DELETE FROM artista WHERE idArtista = ?");
            $stmtDeleteArtist->bind_param("i", $artistId);
    
            if ($stmtDeleteArtist->execute()) {
                // Successful deletion
                $response = array('success' => true, 'message' => 'Artist and related products deleted successfully');
                echo json_encode($response);
            } else {
                // Error in artist deletion
                $response = array('success' => false, 'message' => 'Error deleting artist');
                echo json_encode($response);
            }
    
            $stmtDeleteArtist->close();
        } else {
            // Error in product deletion
            $response = array('success' => false, 'message' => 'Error deleting related products');
            echo json_encode($response);
        }
    
        $stmtDeleteProducts->close();
    } else {
        // ArtistId not provided
        $response = array('success' => false, 'message' => 'artistId not provided');
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
