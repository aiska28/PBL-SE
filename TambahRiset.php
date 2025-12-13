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

  <form method="POST" action="backend/prosesAdmin.php">

    <input type="hidden" name="action" value="simpan_riset">

    <div class="mb-3">
      <label class="form-label">Deskripsi Riset</label>
      <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="landingAdmin.php?tab=tampilan&inner=riset" class="btn btn-outline-secondary">Kembali</a>
  </form>
</div>

</body>
</html>