<?php
//sertakan file koneksi dan kelas produk
include_once 'Database.php';
include_once 'Product.php';

//inisialisasi koneksi ke database
$database = new Database();
$db = $database->getConnection();

//inisialisasi objek produk
$product = new Product($db);

//set properti berdasarkan data yang diterima
$product->NIK = $_POST['NIK'];
$product->id = $_POST['id'];
$product->name = $_POST['name'];
$product->price = $_POST['price'];
$product->description = $_POST['description'];

//Update produk di database
if ($product->update()) {
    echo "Produk berhasil diupdate!";
} else {
    echo "gagal megupdate produk";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Perbarui Produk</title>
    </head>
    <body>
        <h1>Perbarui Produk</h1>
        <form action="update_product.php" method="post">
            <!--form edit produk-->
            <input type="hidden" name="id" value="<?php echo $product_details['id']?>;">

            <label for="name">Nama Produk:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $product_details['name'];?>" required><br> 
            
            <label for="price">Harga:</label><br>
            <input type="number" id="price" name="price" value="<?php echo $product_details['price']; ?>" required><br>

            <label for="Deskripsi:"></label><br>
            <textarea name="description" required><?php echo $product_details['description']; ?></textarea><br><br>

            <button type="submit">Perbarui</button>
        </form>

        <!--Tombol untuk uploas file terbaru-->
        <h3>Uanggah File Terbaru</h3>
        <form action="upload_latest_file.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product_details['id']; ?>">
            <label for="file">Pilih file:</label><br>
            <input type="file" name="file" required><br><br>
            <button type="submit">Unggah File Terbaru</button>
        </form>
            
    </body>
</html>

