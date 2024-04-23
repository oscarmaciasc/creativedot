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

    // Check if productId is present in the data
    if (isset($data['productId'])) {
        // Sanitize and validate the input
        $productId = filter_var($data['productId'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare and execute the delete statement
        $stmt = $conn->prepare("DELETE FROM producto WHERE idProducto = ?");
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            // Successful deletion
            $response = array('success' => true, 'message' => 'Product deleted successfully');
            echo json_encode($response);
        } else {
            // Error in deletion
            $response = array('success' => false, 'message' => 'Errorrr deleting product');
            echo json_encode($response);
        }

        $stmt->close();
    } else {
        // ProductId not provided
        $response = array('success' => false, 'message' => 'ProductId not provided');
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
