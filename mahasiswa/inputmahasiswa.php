<?php
include("../koneksi.php");

$query_prodi = "SELECT * FROM program_studi ORDER BY nama_prodi ASC";
$result_prodi = mysqli_query($koneksi, $query_prodi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Akademik</title>
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
                <a class="nav-link <?php echo ($current_page == 'mahasiswa/inputmahasiswa.php') ? 'active' : ''; ?>" href="mahasiswa/inputmahasiswa.php">Tambah Mahasiswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == '../prodi/inputprodi.php') ? 'active' : ''; ?>" href="../prodi/inputprodi.php">Tambah Prodi</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                <h3 class="text-center mb-4">Mahasiswa</h3>
                
                <form method="POST" action="prosesmahasiswa.php">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">NIM</label>
                        <div class="col-sm-9">
                            <input type="text" name="nim" class="form-control" maxlength="15" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_mhs" class="form-control" maxlength="50" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_lahir" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea name="alamat" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Program Studi</label>
                        <div class="col-sm-9">
                            <select name="program_studi_id" class="form-select" required>
                                <option value="">Pilih Program Studi</option>
                                <?php while($prodi = mysqli_fetch_array($result_prodi)): ?>
                                    <option value="<?php echo $prodi['id']; ?>">
                                        <?php echo $prodi['nama_prodi'] . ' - ' . $prodi['jenjang']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary px-4 me-2">Kirim</button>
                        <a href="listmahasiswa.php" class="btn btn-success px-4">Lihat List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>