<?php
include '../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idproduk'])) {
        $productId = $_GET['idproduk'];

        // Fetch product data from the database based on the product ID
        $query = "SELECT * FROM produk WHERE idproduk = $productId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $productData = mysqli_fetch_assoc($result);
            echo json_encode($productData);
        } else {
            // Handle database error
            echo json_encode(['error' => 'Failed to fetch product data']);
        }
    } else {
        // Handle missing product ID
        echo json_encode(['error' => 'Product ID not provided']);
    }
} else {
    // Handle invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>
