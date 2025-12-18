<?php
$host = "localhost";
$port = "5432";
$dbname = "softwareEn";
$user = "postgres";
$password = "ailsasahda13"; 

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>