<?php
session_start();
include("koneksi.php");

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$query_user = "SELECT nama_lengkap FROM pengguna WHERE email = '$email'";
$result_user = mysqli_query($koneksi, $query_user);

if($result_user && mysqli_num_rows($result_user) > 0) {
    $data_user = mysqli_fetch_assoc($result_user);
    $nama_user = $data_user['nama_lengkap'];
} else {
    $nama_user = isset($_SESSION['email']) ? $_SESSION['email'] : 'pengguna';
}

$query_mahasiswa = "SELECT COUNT(*) as total FROM mahasiswa";
$result_mahasiswa = mysqli_query($koneksi, $query_mahasiswa);

if($result_mahasiswa) {
    $data_mahasiswa = mysqli_fetch_assoc($result_mahasiswa);
    $total_mahasiswa = $data_mahasiswa['total'];
} else {
    $total_mahasiswa = 0;
}

$query_prodi = "SELECT COUNT(*) as total FROM program_studi";
$result_prodi = mysqli_query($koneksi, $query_prodi);

if($result_prodi) {
    $data_prodi = mysqli_fetch_assoc($result_prodi);
    $total_prodi = $data_prodi['total'];
} else {
    $total_prodi = 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
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
                <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Beranda</a>
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

    <div class="container mt-5 text-start">
        <div class="mb-4">
            <h2>Selamat Datang <strong><?php echo ucwords(htmlspecialchars($nama_user)); ?></strong></h2>
            <p class="text-muted">Dashboard Sistem Akademik</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow border-0 text-white" style="background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);">
                    <div class="card-body p-4">
                        <h1 class="display-3 fw-bold mb-2"><?php echo $total_mahasiswa; ?></h1>
                        <p class="mb-3">Total Mahasiswa</p>
                        <a href="mahasiswa/listmahasiswa.php" class="btn btn-light">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card shadow border-0 text-white" style="background: linear-gradient(135deg, #ff00ff 0%, #cc00cc 100%);">
                    <div class="card-body p-4">
                        <h1 class="display-3 fw-bold mb-2"><?php echo $total_prodi; ?></h1>
                        <p class="mb-3">Total Program Studi</p>
                        <a href="prodi/listprodi.php" class="btn btn-light">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="mt-4">
            <a href="../profil/profil.php" class="btn btn-warning">Edit Profil</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
