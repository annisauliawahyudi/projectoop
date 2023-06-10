<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <form action="" method="post">
        <label for="">Nama</label><br>
        <input type="text" name = "nama">
        <br>
        <label for="">NIS</label><br>
        <input type="text" name = "nis">
        <br>
        <label for="">Produktif</label><br>
        <input type="text" name = "prod">
        <br>
        <label for="">Matematika</label><br>
        <input type="text" name = "mtk">
        <br>
        <label for="">Bahasa Inggris</label><br>
        <input type="text" name = "ing">
        <br>
        <label for="">Bahasa Sunda</label><br>
        <input type="text" name = "sund">
        <br>
        <label for="">PIPAS</label><br>
        <input type="text" name = "pipas">
        <br>
        <label for="">PJOK</label><br>
        <input type="text" name = "pjok">
        <br>

        <button type="submit" name ="submit">Submit</button>
        <br><br>
        <a href= logout.php>Logout </a>
    </form>

</body>
</html>

<?php

class Nilai
{
    private $nama;
    private $nis;
    private $map1;
    private $map2;
    private $map3;
    private $map4;
    private $map5;
    private $map6;

    public function __construct($nama, $nis, $map1, $map2, $map3, $map4, $map5, $map6)
    {
        $this->nama = $nama;
        $this->nis = $nis;
        $this->map1 = $map1;
        $this->map2 = $map2;
        $this->map3 = $map3;
        $this->map4 = $map4;
        $this->map5 = $map5;
        $this->map6 = $map6;
    }

    public function getTotal()
    {
        return $this->map1 + $this->map2 + $this->map3 + $this->map4 + $this->map5 + $this->map6;
    }

    public function getAverage()
    {
        return $this->getTotal() / 6;
    }

    public function getMax()
    {
        return max($this->map1, $this->map2, $this->map3, $this->map4, $this->map5, $this->map6);
    }

    public function getMin()
    {
        return min($this->map1, $this->map2, $this->map3, $this->map4, $this->map5, $this->map6);
    }

    public function getGrade()
    {
        $average = $this->getAverage();
        if ($average >= 90) {
            return 'A';
        } elseif ($average >= 80) {
            return 'B';
        } elseif ($average >= 70) {
            return 'C';
        } elseif ($average >= 60) {
            return 'D';
        } else {
            return 'E';
        }
    }

    public function saveToDatabase()
    {
        $server = mysqli_connect("localhost", "root", "", "db_nilai");

        $nama = mysqli_real_escape_string($server, $this->nama);
        $nis = mysqli_real_escape_string($server, $this->nis);
        $map1 = mysqli_real_escape_string($server, $this->map1);
        $map2 = mysqli_real_escape_string($server, $this->map2);
        $map3 = mysqli_real_escape_string($server, $this->map3);
        $map4 = mysqli_real_escape_string($server, $this->map4);
        $map5 = mysqli_real_escape_string($server, $this->map5);
        $map6 = mysqli_real_escape_string($server, $this->map6);
        $rata2 = mysqli_real_escape_string($server, $this->getAverage());

        $sql = "INSERT INTO tb_data(nama, nis, produktif, mtk, inggris, sunda, pipas, pjok, rata2) 
                VALUES ('$nama', '$nis', '$map1', '$map2', '$map3', '$map4', '$map5', '$map6', '$rata2')";

        $query = mysqli_query($server, $sql);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}

if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $nis = $_POST["nis"];
    $map1 = $_POST["prod"];
    $map2 = $_POST["mtk"];
    $map3 = $_POST["ing"];
    $map4 = $_POST["sund"];
    $map5 = $_POST["pipas"];
    $map6 = $_POST["pjok"];

    $nilai = new Nilai($nama, $nis, $map1, $map2, $map3, $map4, $map5, $map6);
    $total = $nilai->getTotal();
    $rata2 = $nilai->getAverage();
    $max = $nilai->getMax();
    $min = $nilai->getMin();
    $grade = $nilai->getGrade();

    echo "Jumlah total adalah: " . $total . "<br>";
    echo "Rata-rata adalah: " . $rata2 . "<br>";
    echo "Nilai maksimal adalah: " . $max . "<br>";
    echo "Nilai minimal adalah: " . $min . "<br>";
    echo "Grade penilaian: " . $grade . "<br>";

    if ($nilai->saveToDatabase()) {
        echo "Data berhasil disimpan ke database.";
    } else {
        echo "Gagal menyimpan data ke database.";
    }
}

    session_start();

    if(isset($_SESSION['username'])) {
        // jika session username ada, maka pengguna sudah login
        $username = $_SESSION['username'];
        echo "selamat datang $username! <br>";
        echo "<a href= 'logout.php'>Logout</a>";
    } else {
        // jika username tidak ada, artinya pengguna belum login
        echo "silahkan masukan data lagi atau logout. <br>";
        echo "<a href= 'isi.php'>Masukkan</a>";
    }
?>