<?php
require('fpdf186/fpdf.php');
session_start();

class OrderPDF extends FPDF
{
    // Add your custom styling here
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Order Details', 0, 1, 'C');
    }

    // Add your custom styling here
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Thank you for your purchase!', 0, 0, 'C');
    }

    // Add your custom styling here
    function ChapterTitle($title)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1);
    }

    // Add your custom styling here
    function ChapterBody($body)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $body);
    }

    // Custom function to add a table
    function AddOrderTable($header, $data)


    {
        // Colors, line width, and font
        $this->SetFillColor(200, 220, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Header
        $isFirstCol = true;
        foreach ($header as $col) {
            $widthCol = $isFirstCol ? 85 : 35;
            $this->Cell($widthCol, 10, $col, 1, 0, 'C', true);
            $isFirstCol = false;
        }
        $this->Ln();

        // Data
        $this->SetFont('');
        foreach ($data as $row) {
            $isFirstElement = true;
            foreach ($row as $col) {
                // Check if it's the first element in the row
                $width = $isFirstElement ? 85 : 35;

                $this->Cell($width, 10, $col, 1, 0, 'C');

                // After the first element, set the flag to false
                $isFirstElement = false;
            }
            $this->Ln();
        }
    }
}

$userID = $_SESSION['user_id'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arte";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

// Get product data
$sql = "SELECT c.idCarrito, c.cantidad, p.nombre AS product_name, p.precio FROM carrito c JOIN producto p ON c.idProducto = p.idProducto WHERE c.idUsuario = $userID";
$result = $conn->query($sql);

// Get ID Order
$sqlIdOrder = "SELECT idUsuario, MAX(idCarrito) AS highestIdCarrito
FROM carrito
GROUP BY idUsuario;
";

// Get Total Price
$sqlTotalPrice = "SELECT c.idUsuario, SUM(c.cantidad * p.precio) AS totalPurchasePrice
                 FROM carrito c
                 JOIN producto p ON c.idProducto = p.idProducto
                 WHERE c.idUsuario = ?
                 GROUP BY c.idUsuario";
$stmtTotalPrice = $conn->prepare($sqlTotalPrice);

// Bind the parameter
$stmtTotalPrice->bind_param("i", $userID);

// Execute the statement
$stmtTotalPrice->execute();

// Get the result set
$resultTotalPrice = $stmtTotalPrice->get_result();

if ($resultTotalPrice->num_rows > 0) {
    $rowTotalPrice = $resultTotalPrice->fetch_assoc();
    $totalPurchasePrice = $rowTotalPrice['totalPurchasePrice'];

    // Output the total purchase price
    // echo "Total Purchase Price: $" . number_format($totalPurchasePrice, 2);
} else {
    echo "No purchase found for the user.";
}

// Fetch array of cart products
$products = $conn->query($sql);
foreach ($products as $product) {
    $data[] = array(
        $product['product_name'],
        $product['cantidad'],
        '$' . $product['precio'],
        '$' . ($product['cantidad'] * $product['precio'])
    );
}

$resultOrder = $conn->query($sqlIdOrder);

if ($resultOrder->num_rows > 0) {
    $row = $resultOrder->fetch_assoc();

    $highestIdCarrito = $row['highestIdCarrito'];
}

if ($result->num_rows > 0) {


    // echo json_encode($data[0][0]);
    // Create PDF
    $pdf = new OrderPDF();
    $pdf->AddPage();

    // Order Information
    $pdf->ChapterTitle('Order Information');
    $pdf->ChapterBody('Order ID: ' . $highestIdCarrito);
    $pdf->ChapterBody('Date: ' . date('Y-m-d'));
    $pdf->Ln();

    // Order details table
    $header = array('Product', 'Quantity', 'Price', 'Total');
    // $data = array();


    $pdf->AddOrderTable($header, $data);
    $pdf->Ln();
    $pdf->ChapterTitle('Total Price: $' . $totalPurchasePrice);

    // Output file
    $pdf->Output('Order_Details.pdf', 'I');
} else {
    echo "No products found";
}
$conn->close();
