<?php
include "konekDB.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $desk = $_POST['deskripsi'];

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $foto);

    $q = "INSERT INTO sarana_prasarana (nama_ruangan, deskripsi, foto_url)
          VALUES ($1, $2, $3)";
    
    pg_query_params($conn, $q, array($nama, $desk, $foto));

    header("Location: landingAdmin.php?tab=tentangKami&inner=sarpras&msg=updated");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Sarpras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning fw-bold">Tambah Sarana & Prasarana</div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <label class="fw-semibold">Nama Ruangan</label>
                <input type="text" name="nama" class="form-control" required>

                <label class="fw-semibold mt-2">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>

                <label class="fw-semibold mt-2">Foto</label>
                <input type="file" name="foto" class="form-control" required>

                <button name="simpan" class="btn btn-primary mt-3">Simpan</button>
                <a href="landingAdmin.php?tab=tentangKami&inner=sarpras"
                class="btn btn-secondary mt-3">Kembali</a>

            </form>

        </div>
    </div>
</div>

</body>
</html>