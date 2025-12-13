<?php
include "konekDB.php";

if (!isset($_GET['id'])) {
    die("ID agenda tidak ditemukan");
}

$id = $_GET['id'];
$q = pg_query_params($conn, "SELECT * FROM agenda WHERE id=$1", [$id]);
$data = pg_fetch_assoc($q);

if (!$data) {
    die("Data agenda tidak ditemukan");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Agenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4>Edit Agenda</h4>
    </div>

    <div class="card-body">
      <form method="POST" action="backend/prosesAdmin.php">

        <input type="hidden" name="action" value="update_agenda">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label class="fw-bold">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>

        <label class="fw-bold mt-2">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" required>

        <label class="fw-bold mt-2">Waktu</label>
        <input type="time" name="waktu" class="form-control" value="<?= $data['waktu'] ?>" required>

        <label class="fw-bold mt-2">Nama Kegiatan</label>
        <input type="text" name="nama_kegiatan" class="form-control"
               value="<?= htmlspecialchars($data['nama_kegiatan']) ?>" required>

        <div class="mt-3 d-flex justify-content-between">
          <a href="landingAdmin.php?tab=tampilanBerita&inner=AgendaTab" class="btn btn-secondary">Kembali</a>
          <button class="btn btn-primary">Simpan Perubahan</button>
        </div>

      </form>
    </div>
  </div>
</div>

</body>
</html>
