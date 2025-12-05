<?php 
include 'konekDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO FokusRiset (deskripsi) VALUES ($1)";
    pg_query_params($conn, $query, array($deskripsi));

    header("Location: LandingAdmin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Riset</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
  <h3 class="text-primary fw-bold mb-3">Tambah Fokus Riset</h3>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Deskripsi Riset</label>
      <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="LandingAdmin.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

</body>
</html>
