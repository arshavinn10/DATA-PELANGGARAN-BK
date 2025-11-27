<?php
session_start();
if(!isset($_SESSION['login'])){ header('Location:login.php'); }
include 'config.php';

if(isset($_POST['save'])){
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $poin = $_POST['poin'];
    $tgl  = $_POST['tanggal'];

    if($nama=='' || $jenis=='' || $poin=='' || $tgl==''){
        echo "<script>alert('Semua field harus diisi');</script>";
    } elseif(!is_numeric($poin)){
        echo "<script>alert('Poin harus angka');</script>";
    } else {
        mysqli_query($koneksi,"INSERT INTO pelanggaran VALUES(NULL,'$nama','$jenis','$poin','$tgl')");
        header('Location:index.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah Data Pelanggaran</title>

<style>
    body{
        font-family: Arial;
        background: #eef3ff;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding-top: 40px;
    }

    h2{
        margin-bottom: 20px;
        font-size: 26px;
        text-align: center;
        font-weight: bold;
    }

    .box{
        background: white;
        width: 420px;
        padding: 30px 28px;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.12);
    }

    .form-group{
        margin-bottom: 15px;
    }

    .form-control{
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
        transition: 0.2s;
    }

    .form-control:focus{
        border-color: #28a745;
        box-shadow: 0 0 5px rgba(40,167,69,0.3);
        outline: none;
    }

    button{
        width: 100%;
        padding: 12px;
        background: #28a745;
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 17px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover{
        background: #218838;
    }
</style>

</head>
<body>

<h2>TAMBAH DATA PELANGGARAN</h2>

<div class="box">
<form method="POST">

    <div class="form-group">
        <input type="text" name="nama" class="form-control" placeholder="Nama Siswa">
    </div>

    <div class="form-group">
        <select name="jenis" class="form-control">
            <option value="">-- Pilih Jenis Pelanggaran --</option>
            <option value="Ringan">Ringan</option>
            <option value="Sedang">Sedang</option>
            <option value="Berat">Berat</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" name="poin" class="form-control" placeholder="Poin Hukuman">
    </div>

    <div class="form-group">
        <input type="date" name="tanggal" class="form-control">
    </div>

    <button name="save">Simpan</button>

</form>
</div>

</body>
</html>
