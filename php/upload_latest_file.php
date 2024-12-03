<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Direktori tujuan file
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //Validasi file
    $allowed_types = ["jpg", "jpeg", "png", "pdf", "docx"];
    if (in_array($file_type, $allowed_types)){
        //Pindahkan file ke direktori tujuan
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "File berhasil diunggah: <a href='$target_file' target='_blank'>" . htmlspecialchars($target_file) . "</a>";

            //Simpan path file ke database
            include_once 'Database.php';
            include_once 'Product.php';

            $database = new Database();
            $db = $database->getConnection();

            $product = new Product($db);
            $product->id = $_POST['id'];
            $product->file_path = $target_file;

            if ($product->updateFile()) {
                echo "<br>Path file berhasil diperbarui di database.";
            } else {
                echo "<br>Gagal menyimpan path file di database.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Tipe file tidak diizinkan.";
    }
}
?>