<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
    $nama_prodi = mysqli_real_escape_string($koneksi, $_POST['nama_prodi']);
    $jenjang = mysqli_real_escape_string($koneksi, $_POST['jenjang']);
    $akreditasi = mysqli_real_escape_string($koneksi, $_POST['akreditasi']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    
    $sql = mysqli_query($koneksi, "INSERT INTO program_studi(nama_prodi, jenjang, akreditasi, keterangan) 
                              VALUES ('$nama_prodi', '$jenjang', '$akreditasi', '$keterangan')");
    
    if ($sql) {
        echo "<script>alert('Data Program Studi berhasil ditambahkan'); window.location='listprodi.php';</script>";
    } else {
        echo "<script>alert('Proses input Program Studi, Gagal..'); window.location='inputprodi.php';</script>";
    }
}
?>