<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Print Data</title>
<style>
table{width:100%;border-collapse:collapse;}th,td{border:1px solid #000;padding:5px;}
</style>
</head>
<body onload='print()'>
<h3 align='center'>LAPORAN PELANGGARAN BK</h3>
<h3 align="center">SMK AK NUSA BANGSA</h3>
<table>
<tr><th>No</th><th>Nama</th><th>Jenis</th><th>Poin</th><th>Tanggal</th></tr>
<?php
$no=1;$sql=mysqli_query($koneksi,"SELECT * FROM pelanggaran ORDER BY id_pelanggaran DESC");
while($d=mysqli_fetch_array($sql)){
echo "<tr><td>$no</td><td>$d[nama_siswa]</td><td>$d[jenis_pelanggaran]</td><td>$d[poin]</td><td>$d[tanggal]</td></tr>";
$no++;
}
?>
</table>
</body>
</html>