<?php
session_start();
$id_produk = $_GET['id'];
unset($_SESSION['Keranjang'][$id_produk]);

echo "<script>alert('Produk dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
