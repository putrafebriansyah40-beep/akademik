<?php
include("../koneksi.php");

if (isset($_POST['register'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);
    
    if ($password != $confirm_password) {
        header("Location: register/register.php?error=password");
        exit();
    }
    
    $check = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        header("Location: register/register.php?error=exists");
        exit();
    }
    
    $password_hash = md5($password);
    
    $sql = mysqli_query($koneksi, "INSERT INTO pengguna(nama_lengkap, email, password) 
                              VALUES ('$nama_lengkap', '$email', '$password_hash')");
    
    if ($sql) {
        header("Location: login.php?success=1");
    } else {
        header("Location: <register>register.php?error=database");
    }
} else {
    header("Location: register.php");
}
?>