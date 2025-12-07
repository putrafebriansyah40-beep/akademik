<?php
include("koneksi.php");

// Mengambil NIM dari URL
$nim = $_GET['nim'];

// Query untuk menghapus data
$hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE nim='$nim'");

if ($hapus) {
    // Jika berhasil, redirect ke list.php dengan pesan sukses
    header("Location: list.php?status=deleted");
} else {
    // Jika gagal, tampilkan pesan error
    echo "<script>
            alert('Gagal menghapus data!');
            window.location='list.php';
          </script>";
}
?>