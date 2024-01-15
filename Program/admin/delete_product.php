<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../dbconnect.php';

if (isset($_POST['idproduk'])) {
    $idproduk = $_POST['idproduk'];

    // Perform the deletion query (modify as needed based on your database structure)
    $deleteQuery = mysqli_query($conn, "DELETE FROM produk WHERE idproduk = '$idproduk'");

    if ($deleteQuery) {
        // Return success to the JavaScript
        echo json_encode(['success' => true]);
    } else {
        // Return failure to the JavaScript
        echo json_encode(['success' => false]);
    }
} else {
    // Handle the case when 'idproduk' is not set
    echo json_encode(['success' => false]);
}
?>
