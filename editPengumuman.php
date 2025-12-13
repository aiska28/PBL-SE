<?php
include "konekDB.php";

// ================== AMBIL DATA ==================
if (!isset($_GET['id'])) {
    header("Location: landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_updated");
    exit;
}

$id = $_GET['id'];

$q = pg_query_params($conn, "SELECT * FROM pengumuman WHERE id = $1", array($id));
$data = pg_fetch_assoc($q);

if (!$data) {
    echo "Data pengumuman tidak ditemukan!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Pengumuman</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="backend/prosesAdmin.php">
                <input type="hidden" name="action" value="update_pengumuman">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Pengumuman</label>
                    <input type="text" name="judul" class="form-control"
                           value="<?= $data['judul']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Konten</label>
                    <textarea name="konten" class="form-control" rows="6" required><?= $data['konten']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="<?= $data['tanggal']; ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab" class="btn btn-secondary"> Kembali</a>

                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
