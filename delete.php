<?php
include 'db.php';
include 'produk.php';

$database = new Database();
$db = $database->conn;
$product = new Product($db);

// Mendapatkan ID produk dari parameter URL
$id = isset($_GET['id']) ? $_GET['id'] : die('Error: Produk tidak ditemukan.');

// Mengatur ID produk yang akan dihapus
$product->id = $id;

// Menghapus produk
if ($product->delete()) {
    echo "Produk berhasil dihapus.";
} else {
    echo "Gagal menghapus produk.";
}
?>
