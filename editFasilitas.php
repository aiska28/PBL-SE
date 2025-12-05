<?php
include 'konekDB.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$q = pg_query_params($conn, "SELECT * FROM FasilitasPeralatan WHERE id = $1", array($id));
$data = pg_fetch_assoc($q);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Fasilitas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="fw-bold text-primary mb-3">Edit Fasilitas & Peralatan</h4>

      <form action="updateFasilitas.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input type="text" class="form-control" name="judul" value="<?= $data['judul']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi']; ?></textarea>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="LandingAdmin.php#tampilan" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>