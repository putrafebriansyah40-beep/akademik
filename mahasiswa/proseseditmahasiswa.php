<?php
include '../koneksi.php';

if (isset($_POST['Submit'])) {
    $nama_mhs = mysqli_real_escape_string($koneksi, $_POST['nama_mhs']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $program_studi_id = mysqli_real_escape_string($koneksi, $_POST['program_studi_id']);
    
    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
                                  nama_mhs='$nama_mhs', 
                                  tgl_lahir='$tgl_lahir', 
                                  alamat='$alamat', 
                                  program_studi_id='$program_studi_id' 
                                  WHERE nim='$_GET[nim]'");
    
    if ($update) {
        echo "<script>alert('Data berhasil diubah'); window.location='listmahasiswa.php';</script>";
    } else {
        echo "<script>alert('Maaf, data gagal diubah');</script>";
    }
}
?>