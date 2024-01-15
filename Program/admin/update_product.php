<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productStock = $_POST['productStock'];
    $productPrice = $_POST['productPrice'];

    $query = "UPDATE produk SET 
                stok = '$productStock', 
                hargaafter = '$productPrice'
              WHERE idproduk = $productId";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        // Handle database error
        // echo json_encode(['error' => 'Failed to update product data sss']);
    }
} else {
    // Handle invalid request method
    // echo json_encode(['error' => 'Invalid request method']);
}
?>
