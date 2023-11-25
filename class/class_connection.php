<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "antrian_klinik";

// Koneksi dan memilih database di server
$koneksidb = mysqli_connect($server,$username,$password ) or die("Koneksi gagal");
mysqli_select_db($koneksidb, $database) or die("Database tidak bisa dibuka");

?>