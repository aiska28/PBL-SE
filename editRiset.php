<?php
include 'konekDB.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = $_GET['id'];

// Ambil data
$q = pg_query_params($conn, "SELECT * FROM FokusRiset WHERE id = $1", array($id));
$data = pg_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Fokus Riset</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">

<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="fw-bold text-primary mb-3">Edit Fokus Riset</h4>

      <form action="updateRiset.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
          <label class="form-label fw-semibold">Deskripsi Riset</label>
          <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi'] ?></textarea>
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-primary">Simpan Perubahan</button>
          <a href="LandingAdmin.php#tampilan" class="btn btn-outline-secondary">Kembali</a>
        </div>
      </form>

    </div>
  </div>
</div>

</body>
</html>
