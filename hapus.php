<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM pelanggaran WHERE id_pelanggaran=$id");
header('Location:index.php');
?>