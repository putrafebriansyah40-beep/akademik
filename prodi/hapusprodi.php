<?php
include("../koneksi.php");

$hapus = mysqli_query($koneksi, "DELETE FROM program_studi WHERE id=$_GET[id]");

if ($hapus) {
    header("<location:prodi>listprodi.php");
} else {
    echo "<script>alert('Gagal menghapus data'); window.location='listprodi.php';</script>";
}
?>