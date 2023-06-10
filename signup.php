<?php
session_start();

// Menghubungkan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'latihan_xpplg';
$koneksi = mysqli_connect($host, $username, $password, $database);
function signup($username, $password, $koneksi)
{
    $query = "SELECT * FROM tb_login WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO tb_login (username, password) VALUES ('$username', '$password')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $_SESSION['username'] = $username; // Menyimpan username dalam session
            header("Location: index.php"); // Mengarahkan ke halaman home setelah signup berhasil
            exit();
        } else {
            echo "Pendaftaran gagal. Silakan coba lagi.";
        }
    } else {
        echo "Username sudah terdaftar. Silakan gunakan username lain.";
    }
}
//  Handle signup form submission
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    signup($username, $password, $koneksi);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <h2>Signup</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" name="signup" value="Signup">
    </form>
</body>
</html>