<?php
include("../koneksi.php");

$edit = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$_GET[nim]'");
$data = mysqli_fetch_array($edit);

$query_prodi = "SELECT * FROM program_studi ORDER BY nama_prodi ASC";
$result_prodi = mysqli_query($koneksi, $query_prodi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
           <img src='asset/logopnp.png.png' alt="Logo" height="50"> Sistem Akademik
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
                <a class="nav-link <?php echo ($current_page == 'prodi/inputprodi.php') ? 'active' : ''; ?>" href="prodi/inputprodi.php">Tambah Prodi</a>
            </li>
        </ul>
    </div>
</nav>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body p-5">
                <h3 class="text-center mb-4">Update Data Mahasiswa</h3>
                
                <form method="post" action="proseseditmahasiswa.php">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">NIM</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $data['nim']; ?>" readonly>
                            <small class="text-muted">NIM tidak dapat diubah</small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_mhs" class="form-control" 
                                   value="<?php echo $data['nama_mhs']; ?>" maxlength="50" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_lahir" class="form-control" 
                                   value="<?php echo $data['tgl_lahir']; ?>">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea name="alamat" class="form-control" rows="5"><?php echo $data['alamat']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Program Studi</label>
                        <div class="col-sm-9">
                            <select name="program_studi_id" class="form-select" required>
                                <option value="">Pilih Program Studi</option>
                                <?php while($prodi = mysqli_fetch_array($result_prodi)): ?>
                                    <option value="<?php echo $prodi['id']; ?>" 
                                            <?php if($prodi['id'] == $data['program_studi_id']) echo 'selected'; ?>>
                                        <?php echo $prodi['nama_prodi'] . ' - ' . $prodi['jenjang']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" name="Submit" class="btn btn-primary px-4 me-2">Update</button>
                        <a href="listmahasiswa.php" class="btn btn-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

