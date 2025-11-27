<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {

    // Ambil input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input kosong
    if ($username == '' || $password == '') {
        echo "<script>alert('Username dan password tidak boleh kosong');</script>";
    } else {

        // Hash password
        $password_md5 = md5($password);

        // Query
        $query = mysqli_query($koneksi, 
            "SELECT * FROM users WHERE username='$username' AND password='$password_md5'"
        );

        // Jika data ditemukan
        if (mysqli_num_rows($query) > 0) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $username;
            header('Location: index.php');
            exit;
        } else {
            echo "<script>alert('Username atau password salah!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login BK</title>
<style>
body{
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: url('poto nubas.jpg')
    no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.box{
    width: 340px;
    margin: 120px auto;
    padding: 25px;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
    color: white;
}
.box h2{
    text-align: center;
    margin-bottom: 20px;
}
input{
    width: 100%;
    padding: 12px;
    margin: 7px 0;
    border: 1px solid #bbb;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 14px;
}
button{
    width: 100%;
    padding: 12px;
    background: orange;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    margin-top: 10px;
    font-size: 16px;
}
button:hover{
    background:#D97706;
}
</style>
</head>
<body>

<div class="box">
    <h2>SMK AK NUSA BANGSA</h2>
    <h2>LOGIN</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" autocomplete="off">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
