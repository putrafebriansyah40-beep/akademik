<?php
$koneksi = new mysqli("localhost", "root", "", "db_akademik");

if (!$koneksi) 
{
    die("Gagal terhubung dengan database : " . mysqli_connect_error());
}
?>