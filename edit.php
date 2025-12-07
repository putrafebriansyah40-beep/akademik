<?php
include("koneksi.php");

// Mengambil data mahasiswa berdasarkan NIM
$nim = $_GET['nim'];
$edit = mysqli_query($db, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$data = mysqli_fetch_array($edit);

// Jika data tidak ditemukan
if (!$data) {
    header("Location: list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h3 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="proses_edit.php">
                            <input type="hidden" name="nim_lama" value="<?php echo $data['nim']; ?>">
                            
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $data['nim']; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama_mhs" class="form-label">Nama Mahasiswa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="<?php echo $data['nama_mhs']; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $data['tgl_lahir']; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" required><?php echo $data['alamat']; ?></textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="list.php" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </button>
                                <button type="submit" name="update" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>