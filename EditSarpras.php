<?php
include 'konekDB.php';

$id = $_GET['id'];
$q = pg_query($conn, "SELECT * FROM sarana_prasarana WHERE id=$id");
$d = pg_fetch_assoc($q);

if (!$d) {
    die("Data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Sarpras</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

<h4 class="text-primary fw-bold">Edit Sarana & Prasarana</h4>

<form method="POST" action="landingAdmin.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $d['id'] ?>">
    <input type="hidden" name="update_sarpras" value="1">

    <label class="fw-semibold mt-2">Nama Ruangan</label>
    <input type="text" name="nama_ruangan" class="form-control" value="<?= $d['nama_ruangan'] ?>">

    <label class="fw-semibold mt-2">Deskripsi</label>
    <textarea name="deskripsi" class="form-control summernote"><?= $d['deskripsi'] ?></textarea>

    <label class="fw-semibold mt-2">Foto (biarkan kosong jika tidak diganti)</label>
    <input type="file" name="foto_url" class="form-control">

    <p class="mt-2">Foto saat ini:</p>
    <img src="uploads/<?= $d['foto_url'] ?>" width="130">

    <div class="mt-3 d-flex gap-2">
      <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
      <a href="landingAdmin.php?tab=tentangKami&inner=sarpras"
      class="btn btn-secondary">Batal</a>
    </div>
</form>

</body>
</html>
