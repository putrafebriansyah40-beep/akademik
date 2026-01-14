<?php
include("../koneksi.php");

if ($aksi == 'update_profil') {
    $user_id = $_SESSION['id'];
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    
    // Validasi nama lengkap
    if (strlen($nama_lengkap) < 3 || strlen($nama_lengkap) > 100) {
        $_SESSION['error_profil'] = "Nama lengkap harus antara 3-100 karakter!";
        header("Location: profil.php");
        exit();
    }
    
    $query = "UPDATE pengguna SET nama_lengkap='$nama_lengkap' WHERE id=$user_id";
    if (mysqli_query($conn, $query)) {
        $_SESSION['nama_lengkap'] = $nama_lengkap; // Update session
        $_SESSION['success_profil'] = "Profil berhasil diupdate!";
    } else {
        $_SESSION['error_profil'] = "Gagal mengupdate profil!";
    }
    header("Location: profil.php");
    exit();
}

// CHANGE PASSWORD
if ($aksi == 'change_password') {
    $user_id = $_SESSION['id'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    
    // Validasi panjang password
    if (strlen($password_baru) < 6 || strlen($password_baru) > 50) {
        $_SESSION['error_profil'] = "Password baru harus antara 6-50 karakter!";
        header("Location: profil.php");
        exit();
    }
    
    // Validasi konfirmasi password
    if ($password_baru !== $konfirmasi_password) {
        $_SESSION['error_profil'] = "Konfirmasi password tidak cocok!";
        header("Location: profil.php");
        exit();
    }
    
    // Cek password lama
    $query = "SELECT password FROM pengguna WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    
    if (!password_verify($password_lama, $user['password'])) {
        $_SESSION['error_profil'] = "Password lama salah!";
        header("Location: profil.php");
        exit();
    }
    
    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
    $query = "UPDATE pengguna SET password='$password_hash' WHERE id=$user_id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_profil'] = "Password berhasil diubah!";
    } else {
        $_SESSION['error_profil'] = "Gagal mengubah password!";
    }
    header("Location: profil.php");
    exit();
}
?>