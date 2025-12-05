<?php 
include 'konekDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO KegiatanProyek (judul, deskripsi) VALUES ($1, $2)";
    pg_query_params($conn, $query, array($judul, $deskripsi));

    header("Location: LandingAdmin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Kegiatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
  <h3 class="text-primary fw-bold mb-3">Tambah Kegiatan / Proyek</h3>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Judul</label>
      <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="LandingAdmin.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

</body>
</html>