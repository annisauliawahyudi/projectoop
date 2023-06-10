<?php
session_start();

// Menghubungkan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'latihan_xpplg';
$koneksi = mysqli_connect($host, $username, $password, $database);

// Fungsi untuk melakukan login
function login($username, $password, $koneksi)
{
    $query = "SELECT * FROM  tb_login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username; // Menyimpan username dalam session
        header("Location: isi.php"); // Mengarahkan ke halaman home setelah login berhasil
        exit();
    } else {
        echo "Login gagal. Username atau password salah.";
    }
}



// Handle login form submission
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    login($username, $password, $koneksi);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login & Signup</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<body>
  <center> <h1> LOGIN FIRST </h1>
</center>
    <form action="isi.php" method="post">
    
    <div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login">
                <div class="login__field">

                    <input type="text" name="uname" class="login__input" placeholder="User name / Email"autocomplete="off" required >
                </div>
                <div class="login__field">
                    
                    <input type="password" name="password" class="login__input" placeholder="Password" required >
                </div>
                <button name="log" class="button login__submit">
                    <span class="button__text">Log In Now</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button><br>
                <h5>don't have any account?<a href="signup.php">sign-up</a></h5>
            </form>

   
</body>
</html>