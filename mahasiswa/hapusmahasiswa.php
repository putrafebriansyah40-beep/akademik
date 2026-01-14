<?php
include("../koneksi.php");

$hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$_GET[nim]'");

if ($hapus) {
    header("location:list_mahasiswa.php");
} else {
    echo "<script>alert('Gagal menghapus data'); window.location='mahasiswa/listmahasiswa.php';</script>";
}
?>