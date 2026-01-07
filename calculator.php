<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kalkulator_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal!");
}

if (isset($_POST['ekspresi']) && isset($_POST['hasil'])) {
    $ekspresi = $_POST['ekspresi'];
    $hasil    = $_POST['hasil'];

    $sql = "INSERT INTO riwayat_kalkulator (ekspresi, hasil)
            VALUES ('$ekspresi', '$hasil')";
    mysqli_query($conn, $sql);
}

class Calculator {
    public function hitung($a, $b, $operator) {
        switch ($operator) {
            case '+':
                return $a + $b;
            case '-':
                return $a - $b;
            case '*':
                return $a * $b;
            case '/':
                if ($b == 0) {
                    return "Error";
                }
                return $a / $b;
            default:
                return 0;
        }
    }
}
