<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ["jpg", "jpeg", "png", "pdf", "docx"];
    if (in_array($file_type, $allowed_types)) {
        if (file_exists($target_file)) {
            die("File dengan nama yang sama sudah ada.");
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File berhasil diunggah: <a href='" . htmlspecialchars($target_file) . "' target='_blank'>" . htmlspecialchars(basename($target_file)) . "</a>";

            include_once 'Database.php';
            include_once 'Product.php';

            $database = new Database();
            $db = $database->getConnection();

            $product = new Product($db);

            try {
                $product->id = $_POST['id'];
                $product->file_path = $target_file;

                if ($product->updateFile()) {
                    echo "<br>Path file berhasil diperbarui di database.";
                } else {
                    echo "<br>Gagal menyimpan path file.";
                }
            } catch (Exception $e) {
                echo "<br>Terjadi kesalahan: " . $e->getMessage();
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "File tidak diizinkan. Hanya file dengan ekstensi: " . implode(", ", $allowed_types);
    }
}
