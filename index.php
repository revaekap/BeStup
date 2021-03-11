<?php
include 'db.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Setup</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">Setup</a></h1>
            <ul>
                <li><a href="keranjang.php">Keranjang</a></li>
            </ul>
        </div>
    </header>

    <!-- Search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="cari produk">
                <input type="submit" name="cari" placeholder="c">
            </form>
        </div>
    </div>

    <!-- Kategori -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if (mysqli_num_rows($kategori) > 0) {
                    while ($k = mysqli_fetch_array($kategori)) {
                ?>
                        <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                            <div class="col-5">
                                <img src="img/kat.png" width="50px" style="margin-bottom: 5px;">
                                <p><?php echo $k['category_name'] ?></p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Kategori Tidak Ada </p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- New Produk -->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                $produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_id DESC LIMIT 8");
                if (mysqli_num_rows($produk) > 0) {
                    while ($p = mysqli_fetch_array($produk)) {
                ?>
                        <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                            <div class="col-4">
                                <img src="uploads/<?php echo $p['product_images'] ?>">
                                <p class="nama"><?php echo $p['product_name'] ?></p>
                                <p class="harga">Rp. <?php echo $p['product_price'] ?></p>
                            </div>
                        </a>
                    <?php  }
                } else { ?>
                    <p>Produk Tidak Ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - Setup <small>
        </div>
    </footer>
</body>

</html>