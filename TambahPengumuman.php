<?php 
include 'konekDB.php';

if (isset($_POST['simpan'])) {

    $judul   = $_POST['judul'];
    $konten  = $_POST['konten'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO pengumuman (judul, konten, tanggal) VALUES ($1, $2, $3)";
    pg_query_params($conn, $sql, array($judul, $konten, $tanggal));

    header("Location: landingAdmin.php?msg=pengumuman_added");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3 class="text-primary fw-bold mb-3">Tambah Pengumuman</h3>

<form method="POST">

    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Konten</label>
        <textarea name="konten" class="form-control" rows="6"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <button class="btn btn-primary" name="simpan">Simpan</button>
    <a href="landingAdmin.php" class="btn btn-secondary">Kembali</a>

</form>

</body>
</html>
