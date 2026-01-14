<?php
include '../koneksi.php';

if (isset($_POST['Submit'])) {
    $nama_prodi = mysqli_real_escape_string($koneksi, $_POST['nama_prodi']);
    $jenjang = mysqli_real_escape_string($koneksi, $_POST['jenjang']);
    $akreditasi = mysqli_real_escape_string($koneksi, $_POST['akreditasi']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    
    $update = mysqli_query($koneksi, "UPDATE program_studi SET 
                                  nama_prodi='$nama_prodi', 
                                  jenjang='$jenjang', 
                                  akreditasi='$akreditasi', 
                                  keterangan='$keterangan' 
                                  WHERE id=$_GET[id]");
    
    if ($update) {
        echo "<script>alert('Data berhasil diubah'); window.location='listprodi.php';</script>";
    } else {
        echo "<script>alert('Maaf, data gagal diubah');</script>";
    }
}
?>