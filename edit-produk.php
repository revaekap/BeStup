<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id ='" . $_GET['id'] . "'");
if (mysqli_num_rows($produk) == 0) {
    echo '<script>window.location="data-produk.php"</script>';
}
$p = mysqli_fetch_array($produk);
$produk = $p['product_id'];
$pilkat = $p['category_id'];
$nama = $p['product_name'];
$harga = $p['product_price'];
$deskripsi = $p['product_description'];
$status = $p['product_status'];
$file = $p['product_images']

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Setup</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Setup</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!-- Konten -->
    <div class="section">
        <div class="container">
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" class="input-control" required>
                        <option value="">--Pilih--</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while ($r = mysqli_fetch_array($kategori)) {
                        ?>
                            <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $pilkat) ? 'selected' : ''; ?>>
                                <?php echo $r['category_name'] ?></option>
                        <?php  } ?>

                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $nama ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $harga ?>" required>

                    <img src="uploads/<?php echo $file ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $file ?>">
                    <input type="file" name="foto" class="input-control">
                    <textarea name="deskripsi" class="input-control" placeholder="deskripsi"><?php echo $deskripsi ?></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // data inputan dari form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    // $foto = $_POST['foto'];
                    // menampung data file yang diupload
                    $nama_file = $_FILES['foto']['name'];
                    $source = $_FILES['foto']['tmp_name'];
                    $folder = './uploads/';

                    // jika admin ganti gambar
                    if ($nama_file != '') {

                        move_uploaded_file($source, $folder . $nama_file);
                        // query update
                        $ubah = mysqli_query($conn, " UPDATE tb_product SET 
                            category_id = '" . $kategori . "',
                            product_name = '" . $nama . "',
                            product_price = '" . $harga . "',
                            product_description = '" . $deskripsi . "',
                            product_images = '" . $nama_file . "',
                            product_status = '" . $status . "'
                            WHERE product_id = '" . $produk . "' ");
                        if ($ubah) {
                            echo '<script>alert("Ubah Data Berhasil")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        } else {
                            echo 'Gagal' . mysqli_error($conn);
                        }
                    } else {
                        $ubah = mysqli_query($conn, "UPDATE tb_product SET 
                        category_id = '" . $kategori . "',
                        product_name = '" . $nama . "',
                        product_price = '" . $harga . "',
                        product_description = '" . $deskripsi . "',
                        product_status = '" . $status . "'
                        WHERE product_id = '" . $produk . "' ");
                        if ($ubah) {
                            echo '<script>alert("Ubah Data Berhasil")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        } else {
                            echo 'Gagal' . mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - Setup <small>
        </div>
    </footer>

    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>

</html>