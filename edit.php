<?php
session_start(); 
if(!isset($_SESSION['login'])){ header('Location:login.php'); }
include 'config.php';

$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pelanggaran WHERE id_pelanggaran=$id"));

if(isset($_POST['save'])){
    $nama   = $_POST['nama'];
    $jenis  = $_POST['jenis'];
    $poin   = $_POST['poin'];
    $tgl    = $_POST['tanggal'];

    if($nama=='' || $jenis=='' || $poin=='' || $tgl==''){
        echo "<script>alert('Semua field harus diisi');</script>";
    } elseif(!is_numeric($poin)){
        echo "<script>alert('Poin harus angka');</script>";
    } else {
        mysqli_query($koneksi,"UPDATE pelanggaran SET 
            nama_siswa='$nama',
            jenis_pelanggaran='$jenis',
            poin='$poin',
            tanggal='$tgl'
            WHERE id_pelanggaran=$id
        ");
        header('Location:index.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Data Pelanggaran</title>

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

    .btn-submit{
        width: 100%;
        padding: 12px;
        background: #38BDF8;
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 17px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-submit:hover{
        background: #0E7490;
    }

    .btn-cancel{
        width: 94%;
        padding: 12px;
        background: #dc3545;
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 17px;
        cursor: pointer;
        margin-top: 8px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-cancel:hover{
        background: #c82333;
    }

</style>

</head>
<body>

<h2>EDIT DATA PELANGGARAN</h2>

<div class="box">
<form method="POST">

    <div class="form-group">
        <input type="text" name="nama" class="form-control" value="<?= $d['nama_siswa'] ?>">
    </div>

    <div class="form-group">
        <select name="jenis" class="form-control">
            <option value="Ringan" <?= ($d['jenis_pelanggaran']=='Ringan')?'selected':'' ?>>Ringan</option>
            <option value="Sedang" <?= ($d['jenis_pelanggaran']=='Sedang')?'selected':'' ?>>Sedang</option>
            <option value="Berat"  <?= ($d['jenis_pelanggaran']=='Berat')?'selected':'' ?>>Berat</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" name="poin" class="form-control" value="<?= $d['poin'] ?>">
    </div>

    <div class="form-group">
        <input type="date" name="tanggal" class="form-control" value="<?= $d['tanggal'] ?>">
    </div>

    <button class="btn-submit" name="save">Update</button>

    <!-- BUTTON BATAL -->
    <a href="index.php" class="btn-cancel">Batal</a>

</form>
</div>

</body>
</html>
