<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-warning fw-bold">Tambah Tenaga Pengajar</div>
    <div class="card-body">

      <form method="POST" action="backend/prosesAdmin.php" enctype="multipart/form-data">

        <label class="fw-semibold">Nama Dosen</label>
        <input type="text" name="nama" class="form-control" required>

        <label class="fw-semibold mt-2">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" required>

        <label class="fw-semibold mt-2">NIDN</label>
        <input type="text" name="nidn" class="form-control">

        <label class="fw-semibold mt-2">Foto</label>
        <input type="file" name="foto" class="form-control" required>

        <button name="simpan" class="btn btn-primary mt-3">Simpan</button>
        <a href="landingAdmin.php?tab=tentangKami&inner=tenagaPengajar" class="btn btn-secondary mt-3">Kembali</a>

      </form>

    </div>
  </div>
</div>

</body>
</html>