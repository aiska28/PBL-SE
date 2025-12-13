<?php 
include 'konekDB.php';

if (isset($_POST['simpan'])) {

    $judul   = $_POST['judul'];
    $konten  = $_POST['konten'];
    $tanggal = $_POST['tanggal'];

    // Upload gambar
    $gambar = "";
    if (!empty($_FILES['gambar']['name'])) {
        $fname = "img/berita_" . time() . "_" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $fname);
        $gambar = $fname;
    }

    $sql = "INSERT INTO berita (judul, konten, tanggal, gambar) VALUES ($1, $2, $3, $4)";
    pg_query_params($conn, $sql, array($judul, $konten, $tanggal, $gambar));

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=BeritaTab&msg=berita_added");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3 class="text-primary fw-bold mb-3">Tambah Berita</h3>

<form method="POST" enctype="multipart/form-data">

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

    <div class="mb-3">
        <label class="form-label">Gambar</label>
        <input type="file" name="gambar" class="form-control">
    </div>

    <button class="btn btn-primary" name="simpan">Simpan</button>
        <a href="landingAdmin.php?tab=tampilanBerita&inner=BeritaTab" 
        class="btn btn-secondary">
        Kembali
        </a>


</form>

</body>
</html>