<?php
include "konekDB.php";

// ================== CEK ID ==================
if (!isset($_GET['id'])) {
    header("Location: landingAdmin.php");
    exit;
}

$id = $_GET['id'];

// ================== AMBIL DATA ==================
$q = pg_query_params($conn, "SELECT * FROM view_agenda WHERE id = $1", array($id));
$data = pg_fetch_assoc($q);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// ================== PROSES UPDATE ==================
if (isset($_POST['update'])) {

    $deskripsi = $_POST['deskripsi'];
    $tanggal   = $_POST['tanggal'];
    $waktu     = $_POST['waktu'];
    $nama      = $_POST['nama_kegiatan'];

    $query = "UPDATE agenda 
              SET deskripsi = $1, tanggal = $2, waktu = $3, nama_kegiatan = $4
              WHERE id = $5";

    $run = pg_query_params($conn, $query, array($deskripsi, $tanggal, $waktu, $nama, $id));

    if ($run) {
        header("Location: landingAdmin.php?msg=updated");
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui agenda!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Agenda</h4>
        </div>

        <div class="card-body">

            <form method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="5" required><?= $data['deskripsi']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Waktu</label>
                    <input type="time" name="waktu" class="form-control" value="<?= $data['waktu']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control" 
                           value="<?= $data['nama_kegiatan']; ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="landingAdmin.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
