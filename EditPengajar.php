<?php
include 'konekDB.php';

$id = $_GET['id'];
$q = pg_query($conn, "SELECT * FROM tenaga_pengajar WHERE id=$id");
$d = pg_fetch_assoc($q);

if (!$d) {
    die("Data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Pengajar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

<h4 class="text-primary fw-bold">Edit Tenaga Pengajar</h4>

<form method="POST" action="backend/prosesAdmin.php" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $d['id'] ?>">
    <input type="hidden" name="update_pengajar" value="1">

    <label class="fw-semibold mt-2">Nama Dosen</label>
    <input type="text" name="nama_dosen" class="form-control" value="<?= $d['nama_dosen'] ?>">

    <label class="fw-semibold mt-2">Jabatan</label>
    <input type="text" name="jabatan" class="form-control" value="<?= $d['jabatan'] ?>">

    <label class="fw-semibold mt-2">NIDN</label>
    <input type="text" name="nidn" class="form-control" value="<?= $d['nidn'] ?>">

    <label class="fw-semibold mt-2">Foto (biarkan kosong kalau tidak diganti)</label>
    <input type="file" name="foto_url" class="form-control">

    <p class="mt-2">Foto saat ini:</p>
    <img src="uploads/<?= $d['foto_url'] ?>" width="120">

    <div class="mt-3 d-flex gap-2">
      <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
      <a href="landingAdmin.php?tab=tentangKami&inner=tenagaPengajar" class="btn btn-secondary">Batal</a>
    </div>
</form>

</body>
</html>