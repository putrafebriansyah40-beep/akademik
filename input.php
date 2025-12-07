<?php
include("koneksi.php");

if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    
    // Query untuk memasukkan data ke database
    $sql = mysqli_query($db, "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat) 
                              VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat')");
    
    if ($sql) {
        // Jika berhasil, redirect ke list.php dengan pesan sukses
        header("Location: list.php?status=success");
    } else {
        // Jika gagal, redirect ke index.php dengan pesan error
        header("Location: index.php?status=error");
    }
} else {
    // Jika akses langsung tanpa submit, redirect ke index.php
    header("Location: index.php");
}
?>