<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Ambil data user dari database
$user_id = $_SESSION['id'];
$query = "SELECT * FROM pengguna WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
           <img src='asset/logopnp.png.png' alt="Logo" height="50"> Sistem Akademik
        </a>
        
        <?php
        // Mendapatkan nama file yang sedang dibuka
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>
        
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'inputmahasiswa.php') ? 'active' : ''; ?>" href="inputmahasiswa.php">Tambah Mahasiswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'inputprodi.php') ? 'active' : ''; ?>" href="inputprodi.php">Tambah Prodi</a>
            </li>
        </ul>
    </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <!-- Header -->
                <div class="mb-4">
                    <a href="index.php" class="btn btn-secondary btn-sm mb-3">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>

                <!-- Alert -->
                <?php if (isset($_SESSION['success_profil'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $_SESSION['success_profil']; unset($_SESSION['success_profil']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['error_profil'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $_SESSION['error_profil']; unset($_SESSION['error_profil']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Form Edit Profil -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Edit Profil</h3>
                        <form action="proses.php?aksi=update_profil" method="POST">
                            
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($user['nama_lengkap']); ?>" required minlength="3" maxlength="100">
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" readonly>
                                    <small class="text-muted">Email tidak dapat diubah</small>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Form Ubah Password -->
                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Ubah Password</h3>
                        <form action="proses.php?aksi=change_password" method="POST" id="formPassword">
                            
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_lama" class="form-control" required minlength="6">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_baru" id="password_baru" class="form-control" required minlength="6" maxlength="50">
                                    <small class="text-muted">Minimal 6 karakter</small>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" required minlength="6" maxlength="50">
                                    <div id="passwordError" class="text-danger mt-1 small" style="display: none;">
                                        Password tidak cocok!
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validasi konfirmasi password
        const form = document.getElementById('formPassword');
        const passwordBaru = document.getElementById('password_baru');
        const konfirmasiPassword = document.getElementById('konfirmasi_password');
        const passwordError = document.getElementById('passwordError');

        function checkPassword() {
            if (konfirmasiPassword.value !== '') {
                if (passwordBaru.value !== konfirmasiPassword.value) {
                    passwordError.style.display = 'block';
                    konfirmasiPassword.setCustomValidity('Password tidak cocok');
                } else {
                    passwordError.style.display = 'none';
                    konfirmasiPassword.setCustomValidity('');
                }
            }
        }

        passwordBaru.addEventListener('input', checkPassword);
        konfirmasiPassword.addEventListener('input', checkPassword);

        form.addEventListener('submit', function(e) {
            if (passwordBaru.value !== konfirmasiPassword.value) {
                e.preventDefault();
                passwordError.style.display = 'block';
            }
        });
    </script>
</body>
</html>