<?php
session_start();

// echo "<pre>";
// print_r($_SESSION['Keranjang']);
// echo "</pre>";
$koneksi = new mysqli("localhost", "root", "", "db_setup");

// if (empty($_SESSION["keranjang"]) or !isset($_SESSION["Keranjang"])) {
//     echo "<script>alert('Keranjang Kosong Silahkan Belanja Lagi');</script>";
//     echo "<script>location='index.php';</script>";
// }

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

    <br>

    <!-- isi keranjang -->
    <section class="konten">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <br>
            <table border="1px solid">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>SubHarga</th>
                    </tr>
                </thead>
                <?php $nomor = 1; ?>
                <?php $totalbelanja = 0; ?>
                <?php $ongkir = 5000; ?>
                <?php foreach ($_SESSION['Keranjang'] as $p => $jumlah) : ?>
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM tb_product WHERE product_id ='$p'");
                    $pecah = $ambil->fetch_assoc();
                    $subharga = $pecah["product_price"] * $jumlah;
                    ?>
                    <tbody>
                        <tr>
                            <center>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah["product_name"]; ?></td>
                                <td>Rp <?php echo number_format($pecah["product_price"]); ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td>Rp <?php echo number_format($subharga); ?></td>
                            </center>
                        </tr>
                        <?php $nomor++ ?>
                        <?php $totalbelanja += $subharga; ?>
                        <?php $totalsemua = $ongkir + $totalbelanja ?>
                    <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total Belanja</th>
                            <th>Rp. <?php echo number_format($totalbelanja) ?> </th>
                        </tr>
                        <tr>
                            <th colspan="4">Ongkir</th>
                            <th>Rp. 5000 </th>
                        </tr>
                    </tfoot>
            </table>
            <br>
            <div class="box">
                <h3>Total Semua</h3>
                <h1>Rp. <?php echo number_format($totalsemua) ?></h1>
            </div>

            <br>
            <br>
        </div>
    </section>

    <br>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - Setup <small>
        </div>
    </footer>
</body>

</html>