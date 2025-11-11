<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_praktikum';

$koneksi = mysqli_connect($host, $user, $pass, $db);

    echo 'Koneksi gagal!';
} else {
    echo 'Koneksi berhasil!';
}
?>
