<?php
include("../../koneksi.php");

$id = $_GET['delete'];
$req = mysqli_query($koneksi, "SELECT * FROM tbl_kategori WHERE id ='$id' ");
$img = mysqli_fetch_array($req);

if (is_file("../../uploads/categories/" . $img['img']))
   unlink("../../uploads/categories/" . $img['img']);
$result = mysqli_query($koneksi, "DELETE FROM tbl_kategori WHERE id = '$id'");

header("Location: ./");
?>