<?php
include "konekDB.php";

if (!isset($_GET['id'])) {
    header("Location: landingAdmin.php?tab=tampilanBerita&inner=AgendaTab");
    exit;
}

$id = $_GET['id'];

$data = pg_fetch_assoc(
    pg_query_params($conn, "SELECT * FROM agenda WHERE id=$1", [$id])
);

// ===== PROSES UPDATE =====
if (isset($_POST['update'])) {

    pg_query_params(
        $conn,
        "UPDATE agenda 
         SET deskripsi=$1, tanggal=$2, waktu=$3, nama_kegiatan=$4
         WHERE id=$5",
        [
            $_POST['deskripsi'],
            $_POST['tanggal'],
            $_POST['waktu'],
            $_POST['nama_kegiatan'],
            $id
        ]
    );

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=AgendaTab&msg=agenda_updated");
    exit;
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
                    <a href="landingAdmin.php?tab=tampilanBerita&inner=AgendaTab" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
