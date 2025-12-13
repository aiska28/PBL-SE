<?php
include "konekDB.php";

if (isset($_POST['simpan'])) {
    $nama    = $_POST['nama'];
    $jabatan = $_POST['jabatan'];

    $q = "INSERT INTO tenaga_kependidikan (nama_pegawai, jabatan)
          VALUES ($1, $2)";

    pg_query_params($conn, $q, array($nama, $jabatan));

    header("Location: landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=deleted");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tenaga Kependidikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-warning fw-bold">Tambah Tenaga Kependidikan</div>
    <div class="card-body">

      <form method="POST">

        <label class="fw-semibold">Nama Pegawai</label>
        <input type="text" name="nama" class="form-control" required>

        <label class="fw-semibold mt-2">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" required>

        <button name="simpan" class="btn btn-primary mt-3">Simpan</button>
        <a href="landingAdmin.php?tab=tentangKami&inner=kependidikan"
        class="btn btn-secondary mt-3">Kembali</a>

      </form>

    </div>
  </div>
</div>
</body>
</html>
