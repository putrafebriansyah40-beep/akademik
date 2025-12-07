<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0"><i class="bi bi-people-fill"></i> Daftar Data Mahasiswa</h3>
            </div>
            <div class="card-body">
                
                <?php
                // Menampilkan notifikasi jika ada
                if (isset($_GET['status'])) {
                    if ($_GET['status'] == 'success') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill"></i> Data berhasil disimpan!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                    } elseif ($_GET['status'] == 'updated') {
                        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill"></i> Data berhasil diupdate!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                    } elseif ($_GET['status'] == 'deleted') {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-trash-fill"></i> Data berhasil dihapus!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                    }
                }
                ?>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">NIM</th>
                                <th width="25%">Nama Mahasiswa</th>
                                <th width="15%">Tanggal Lahir</th>
                                <th width="25%">Alamat</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysqli_query($db, "SELECT * FROM mahasiswa ORDER BY nim ASC");
                            $no = 1;
                            
                            if (mysqli_num_rows($tampil) > 0) {
                                while ($data = mysqli_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no; ?></td>
                                        <td><?php echo $data['nim']; ?></td>
                                        <td><?php echo $data['nama_mhs']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($data['tgl_lahir'])); ?></td>
                                        <td><?php echo $data['alamat']; ?></td>
                                        <td class="text-center">
                                            <a href="edit.php?nim=<?php echo $data['nim']; ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="hapus.php?nim=<?php echo $data['nim']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash-fill"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center">Belum ada data mahasiswa</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    <a href="index.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Data Mahasiswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>