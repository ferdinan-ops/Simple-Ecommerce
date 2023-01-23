<?php
include("../koneksi.php");

$id = $_GET['id'];
$req = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id ='$id' ");
$img = mysqli_fetch_array($req);

if (is_file("../uploads/products/" . $img['img']))
   unlink("../uploads/products/" . $img['img']);
$result = mysqli_query($koneksi, "DELETE FROM tbl_produk WHERE id = '$id'");

header("Location: ./");
?>