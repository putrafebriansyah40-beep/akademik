<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama_mhs = mysqli_real_escape_string($koneksi, $_POST['nama_mhs']);
    $program_studi_id = mysqli_real_escape_string($koneksi, $_POST['program_studi_id']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    
    $query = "INSERT INTO mahasiswa (nim, nama_mhs, program_studi_id, tgl_lahir, alamat) 
              VALUES ('$nim', '$nama_mhs', '$program_studi_id', '$tgl_lahir', '$alamat')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data Mahasiswa berhasil ditambahkan!'); 
                window.location='inputmahasiswa.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "'); 
                window.location='inputmahasiswa.php';
              </script>";
        exit();
    }
}

$query_prodi = "SELECT * FROM program_studi ORDER BY nama_prodi ASC";
$result_prodi = mysqli_query($koneksi, $query_prodi);
?>
