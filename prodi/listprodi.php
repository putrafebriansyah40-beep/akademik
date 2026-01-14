<?php
include("../koneksi.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Program Studi - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
           <img src='../asset/logopnp.png.png' alt="Logo" height="50"> Sistem Akademik
        </a>
        
        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>
        
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == '../index.php') ? 'active' : ''; ?>" href="../index.php">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == '../mahasiswa/inputmahasiswa.php') ? 'active' : ''; ?>" href="../mahasiswa/inputmahasiswa.php">Tambah Mahasiswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'prodi/inputprodi.php') ? 'active' : ''; ?>" href="<prodi>inputprodi.php">Tambah Prodi</a>
            </li>
        </ul>
    </div>
</nav>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">List Data Program Studi</h3>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Program Studi</th>
                                <th>Jenjang</th>
                                <th>Akreditasi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysqli_query($koneksi, "SELECT * FROM program_studi ORDER BY id ASC");
                            $no = 1;
                            while ($data = mysqli_fetch_array($tampil)) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama_prodi']; ?></td>
                                <td><?php echo $data['jenjang']; ?></td>
                                <td><?php echo $data['akreditasi']; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>
                                <td>
                                    <a href="editprodi.php?id=<?php echo $data['id']; ?>" 
                                       class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapusprodi.php?id=<?php echo $data['id']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center mt-3">
                    <a href="inputprodi.php" class="btn btn-primary">Tambah Program Studi</a>
                </div>
            </div>
        </div>
    </div>
</div>
