<?php
require_once 'Database.php';
require_once 'Product.php';
require_once 'PDFGenerator.php';

// Inisialisasi koneksi database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi obejk produk
$product = new Product($db);

//Ambil semua data produk
$data = $product->readAll();
$headers = ['ID', 'Nama Produk', 'Harga', 'Deskripsi'];

// Siaplan data untuk tabel PDF
$tabelData = [];
while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
    $tabelData[] = [
        $row['id'],
        $row['name'],
        $row['price'],
        $row['description'],
    ];
}

// Inisialisasi PDFGenerator
$pdfGenerator = new PDFGenerator();
$pdfGenerator->addTitle('Laporan Produk');
$pdfGenerator->addTable($headers, $tabelData);
$pdfGenerator->outputPDF();
?>