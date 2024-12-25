<?php
// Sertakan file koneksi dan kelas produk
include_once 'Database.php';
include_once 'Product.php';

// Inisialisasi koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi objek produk
$product = new Product($db);

// Tentukan jumlah produk per halaman
$products_per_page = 5;

// Ambil halaman saat ini dari query string, jika tidak ada set ke 1

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $products_per_page; // Tentukan batas mulai produk

// Dapatkan produk dengan pagination
$stmt = $product->readWithPagination($start, $products_per_page);
$num = $stmt->rowCount();

// Tampilkan produk
if ($num > 0) {
    echo "<style>
        tbody tr:nth-child(odd) { background-color: #f9f9f9; align-item: center;}
            tbody tr:nth-child(even) { background-color: #A6AEBF; }
            tbody tr td { padding: 10px; color: #333; }
            .btn-edit { background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; }
            .btn-delete { background-color: #f44336; color: white; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; margin-left: 5px; }
            thead { align-item: center;}
            </style>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>NIK</th>";
    echo "<th>Nama produk</th>";
    echo "<th>Deskripsi</th>";
    echo "<th>Harga</th>";
    echo "<th>File PDF</th>";
    echo "<th>Keterangan</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<tr>";
        echo "<td>{$NIK}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$description}</td>";
        echo "<td>Rp.{$price}</td>";
        echo "<td>{$file_path}</td>";
        echo "<td>";
        echo "<button style='background-color: #4caf50; color: black; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer;' onclick='editProduct({$id})'>Edit</button>";
        echo "<button style='background-color: #f44336; color: black; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer;'onclick='deleteProduct({$id})'>Hapus</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

// Hitung total halaman
$total_rows = $product->countAll();
$total_pages = ceil($total_rows / $products_per_page);
// Tampilkan pagination
echo "<div>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='list_products.php?page={$i}'>{$i}</a> ";
}
echo "</div>";
