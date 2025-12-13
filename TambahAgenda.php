<!DOCTYPE html>
<html>
<head>
    <title>Tambah Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3 class="text-primary fw-bold mb-3">Tambah Agenda</h3>

<form method="POST" action="backend/prosesAdmin.php">

    <input type="hidden" name="action" value="simpan_agenda">


    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Waktu</label>
        <input type="time" name="waktu" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Kegiatan</label>
        <input type="text" name="nama_kegiatan" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="landingAdmin.php?tab=tampilanBerita&inner=AgendaTab" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>