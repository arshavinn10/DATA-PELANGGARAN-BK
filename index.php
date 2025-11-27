<?php
session_start();
if(!isset($_SESSION['login'])){header('Location:login.php');}
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Pelanggaran BK</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f2f4f7;
    padding:20px;
    margin:0;
}

/* Judul Tengah */
h2{
    text-align:center;
    font-size:28px;
    margin-bottom:20px;
}

/* Tombol */
.btn{
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
    margin-right:5px;
    color:white;
}
.add{ background:#14B8A6;}
.add:hover{background:#218838;}

.edit{ background:#A855F7; }
.edit:hover{background:#6366F1;}

.del{ background:red; }
.del:hover{background:#FB7185;}

.print{ background:#F59E0B; }
.print:hover{background:#D97706;}

/* Search Box */
.search-box{
    margin-top:15px;
    margin-bottom:20px;
}
.search-box input{
    padding:8px;
    width:250px;
    border:1px solid #aaa;
    border-radius:5px;
}
.search-box button{
    padding:8px 12px;
    border:none;
    border-radius:5px;
    background:#007bff;
    color:white;
    cursor:pointer;
}
.search-box button:hover{
    background:#C084FC;
}

/* Tabel */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
th{
    background:#343a40;
    color:white;
    padding:12px;
    font-weight:bold;
    border:1px solid #ddd;
    text-align:center;
}
td{
    padding:10px;
    border:1px solid #ddd;
    font-weight:bold; /* TABEL JADI TEBAL */
}
tr:nth-child(even){
    background:#f7f7f7;
}
td:nth-child(1), td:nth-child(4), td:nth-child(5){
    text-align:center;
}
td:nth-child(6){
    text-align:center;
}
</style>
</head>
<body>
    <h2>DATA CATATAN PELANGGARAN BK</h2>
    <h2>SMK AK NUSA BANGSA</h2>

<!-- Tombol di tengah -->
<div style="text-align:center; margin-bottom:15px;">
    <a href='tambah.php' class='btn add'>+ Tambah Data</a>
    <a href='print.php' class='btn print' target='_blank'>Print</a>
    <a href='logout.php' class='btn del'>Logout</a>
</div>

<!-- Search box di tengah -->
<div class='search-box' style="text-align:center;">
    <form method='GET'>
        <input type='text' name='cari' placeholder='Cari nama siswa...' 
        value='<?php echo $_GET['cari'] ?? ""; ?>'>
        <button>Cari</button>
    </form>
</div>

<table>
<tr>
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Jenis</th>
    <th>Poin</th>
    <th>Tanggal</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$cari = $_GET['cari'] ?? '';

if ($cari != '') {
    $data = mysqli_query($koneksi, 
        "SELECT * FROM pelanggaran WHERE nama_siswa LIKE '%$cari%' ORDER BY id_pelanggaran DESC");
} else {
    $data = mysqli_query($koneksi, 
        "SELECT * FROM pelanggaran ORDER BY id_pelanggaran DESC");
}

while($d = mysqli_fetch_array($data)){ ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama_siswa'] ?></td>
    <td><?= $d['jenis_pelanggaran'] ?></td>
    <td><?= $d['poin'] ?></td>
    <td><?= $d['tanggal'] ?></td>
    <td>
        <a href='edit.php?id=<?= $d['id_pelanggaran'] ?>' class='btn edit'>Edit</a>
        <a href='hapus.php?id=<?= $d['id_pelanggaran'] ?>' class='btn del'
           onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
