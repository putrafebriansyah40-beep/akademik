<?php
include("koneksi.php");

if (isset($_POST['update'])) {
    // Mengambil data dari form
    $nim_lama = $_POST['nim_lama'];
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    
    // Query untuk update data
    $update = mysqli_query($db, "UPDATE mahasiswa SET 
                                  nim='$nim', 
                                  nama_mhs='$nama_mhs', 
                                  tgl_lahir='$tgl_lahir', 
                                  alamat='$alamat' 
                                  WHERE nim='$nim_lama'");
    
    if ($update) {
        // Jika berhasil, redirect ke list.php dengan pesan sukses
        header("Location: list.php?status=updated");
    } else {
        // Jika gagal, kembali ke edit.php dengan pesan error
        echo "<script>
                alert('Maaf, data gagal diubah!');
                window.location='edit.php?nim=$nim_lama';
              </script>";
    }
} else {
    // Jika akses langsung tanpa submit, redirect ke list.php
    header("Location: list.php");
}
?>