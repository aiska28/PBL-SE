<?php
include 'konekDB.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Detail Agenda</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/detailAgenda.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" style="background-color: #1d2c8a;">
  <div class="container-fluid px-5">
    <div class="d-flex align-items-center me-auto">
      <img src="img/logoPolinema.png" alt="Logo" style="height: 60px;" class="me-3">
      <div class="text-white lh-1">
        <div style="font-size: 14px; font-weight: 600;">JURUSAN TEKNOLOGI INFORMASI</div>
        <div style="font-size: 18px; font-weight: 700;">POLITEKNIK NEGERI MALANG</div>
      </div>
    </div>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="landing.php">Beranda</a></li>
        <li class="nav-item dropdown mx-3">
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="tentangKami.php" id="tentangDropdown" data-bs-toggle="dropdown">Tentang Kami</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="tentangKami.php?section=sejarah">Sejarah</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=visi">Visi, Misi dan Tujuan</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=struktur">Struktur Organisasi</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=pengajar">Tenaga Pengajar</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=kependidikan">Tenaga Kependidikan</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=sarana">Sarana dan Prasarana</a></li>
          </ul>
        </li>
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="berita.php">Berita & Pengumuman</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-agenda">

<?php
// ambil data agenda (misal id=1 untuk konten deskripsi)
$id = 1; // bisa dinamis via GET
$query = "SELECT * FROM agenda WHERE id = $id";
$result = pg_query($conn, $query);
$data = pg_fetch_assoc($result);

if($data) {

    // Hanya tampilkan H2 jika judul tidak kosong
    if (!empty(trim($data['judul']))) {
        echo "<h2>".htmlspecialchars($data['judul'])."</h2>";
    }

    echo "<p class='deskripsi'>".nl2br(htmlspecialchars($data['deskripsi']))."</p>";
}

// ambil semua data tabel (nama_kegiatan, waktu, tanggal)
$query_table = "SELECT nama_kegiatan, waktu, tanggal FROM agenda ORDER BY tanggal ASC";
$result_table = pg_query($conn, $query_table);
?>

<table id="tableAgenda" class="display table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nama Kegiatan</th>
            <th>Tanggal</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while($row = pg_fetch_assoc($result_table)) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($row['nama_kegiatan'])."</td>";
        echo "<td>".htmlspecialchars($row['tanggal'])."</td>";
        echo "<td>".htmlspecialchars($row['waktu'])."</td>";
        echo "</tr>";
    }
    pg_close($conn);
    ?>
    </tbody>
</table>
<a href="berita.php" class="back-btn"><b>Kembali</b></a>
</div>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<<script>
$(document).ready(function() {
    $('#tableAgenda').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": false   // <-- perbaikan typo dan tambahkan koma
    });
});
</script>

</body>
</html>
