<?php
include("../koneksi.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program studi - Sistem Akademik</title>
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
                <a class="nav-link <?php echo ($current_page == 'prodi/inputprodi.php') ? 'active' : ''; ?>" href="prodi/inputprodi.php">Tambah Prodi</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <h3 class="text-center mb-4">Program Studi</h3>
                    
                    <form method="POST" action="prosesprodi.php">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Program Studi</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_prodi" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Jenjang</label>
                            <div class="col-sm-9">
                                <select name="jenjang" class="form-select" required>
                                    <option value="">Pilih Jenjang</option>
                                    <option value="D2">D2</option>
                                    <option value="D3">D3</option>
                                    <option value="D4">D4</option>
                                    <option value="S2">S2</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Akreditasi</label>
                            <div class="col-sm-9">
                                <input type="text" name="akreditasi" class="form-control" maxlength="12">
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea name="keterangan" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary px-4 me-2">Kirim</button>
                            <a href="listprodi.php" class="btn btn-success px-4">Lihat List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
