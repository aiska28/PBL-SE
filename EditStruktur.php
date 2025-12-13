<?php
include 'konekDB.php';

$id = $_GET['id'];
$q = pg_query($conn, "SELECT * FROM struktur_organisasi WHERE id=$id");
$d = pg_fetch_assoc($q);

if (!$d) {
    die("Data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Struktur</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

<h4 class="text-primary fw-bold">Edit Struktur Organisasi</h4>

<form method="POST" action="landingAdmin.php?tab=tentangKami&inner=organisasi">
    <input type="hidden" name="id" value="<?= $d['id'] ?>">
    <input type="hidden" name="update_organisasi" value="1">

    <label class="fw-semibold mt-2">Jabatan</label>
    <input type="text" name="jabatan" class="form-control" value="<?= $d['jabatan'] ?>">

    <label class="fw-semibold mt-2">Nama</label>
    <input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>">

    <div class="mt-3 d-flex gap-2">
      <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
      <a href="landingAdmin.php?tab=tentangKami&inner=organisasi" class="btn btn-secondary">Batal</a>
</div>
</form>

</body>
</html>