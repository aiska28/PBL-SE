<?php
include "konekDB.php";

// PROSES SIMPAN
if (isset($_POST['simpan'])) {
    $jabatan = $_POST['jabatan'];
    $nama    = $_POST['nama'];

    $q = "INSERT INTO struktur_organisasi (jabatan, nama) VALUES ($1, $2)";
    pg_query_params($conn, $q, array($jabatan, $nama));

    header("Location: landingAdmin.php?msg=struktur_added");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Struktur Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-warning fw-bold">Tambah Struktur Organisasi</div>
    <div class="card-body">

      <form method="POST">
        <label class="fw-semibold mt-2">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" required>

        <label class="fw-semibold mt-3">Nama</label>
        <input type="text" name="nama" class="form-control" required>

        <button name="simpan" class="btn btn-primary mt-3">Simpan</button>
        <a href="landingAdmin.php" class="btn btn-secondary mt-3">Kembali</a>
      </form>

    </div>
  </div>
</div>
</body>
</html>