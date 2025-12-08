<?php
// koneksi ke database
include 'konekDB.php';
// Ambil dan validasi id
if (!isset($_GET['id']) || $_GET['id'] === '') {
    http_response_code(400);
    echo "<h2>ID berita tidak ditemukan.</h2>";
    echo '<p><a href="berita.php">Kembali ke daftar berita</a></p>';
    exit;
}

$id = $_GET['id'];
// pastikan numeric (jika id kamu bukan numeric, ubah aturan ini)
if (!ctype_digit((string)$id)) {
    http_response_code(400);
    echo "<h2>Parameter ID tidak valid.</h2>";
    echo '<p><a href="berita.php">Kembali ke daftar berita</a></p>';
    exit;
}

// Ambil data berita dengan parameterized query
$sql = "SELECT * FROM berita WHERE id = $1 LIMIT 1";
$res = pg_query_params($conn, $sql, array($id));

if (!$res) {
    // query gagal
    http_response_code(500);
    echo "<h2>Terjadi kesalahan pada server (query gagal).</h2>";
    echo '<p>' . htmlspecialchars(pg_last_error($conn)) . '</p>';
    exit;
}

$data = pg_fetch_assoc($res);

// Jika tidak ditemukan
if (!$data) {
    http_response_code(404);
    echo "<h2>Berita tidak ditemukan.</h2>";
    echo '<p><a href="berita.php">Kembali ke daftar berita</a></p>';
    exit;
}

// Siapkan field aman untuk ditampilkan (cek keberadaan)
$judul = isset($data['judul']) ? $data['judul'] : 'Tanpa Judul';
$tanggal_raw = isset($data['tanggal']) ? $data['tanggal'] : null;
$konten = isset($data['konten']) ? $data['konten'] : '';
$gambar = isset($data['gambar']) ? $data['gambar'] : '';

// Format tanggal (cek null)
if ($tanggal_raw && $tanggal_raw !== '') {
    $tanggal_formatted = date("F j, Y", strtotime($tanggal_raw));
} else {
    $tanggal_formatted = ''; // kosongkan agar tidak muncul 01 Jan 1970
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail Berita & Pengumuman - Laboratorium RPL</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="detailBerita.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="detailBerita.css">
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
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="#">Beranda</a></li>
        <li class="nav-item dropdown mx-3">
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="tentangDropdown" data-bs-toggle="dropdown">Tentang Kami</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Sejarah</a></li>
            <li><a class="dropdown-item" href="#">Visi, Misi dan Tujuan</a></li>
            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
            <li><a class="dropdown-item" href="#">Tenaga Pengajar</a></li>
            <li><a class="dropdown-item" href="#">Tenaga Kependidikan</a></li>
            <li><a class="dropdown-item" href="#">Sarana dan Prasarana</a></li>
          </ul>
        </li>
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="#">Berita & Pengumuman</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container my-5">
  <div class="detail-container">
    <h1 class="detail-title"><?= htmlspecialchars($judul) ?></h1>

    <?php if ($tanggal_formatted): ?>
        <div class="detail-meta"><?= htmlspecialchars($tanggal_formatted) ?></div>
    <?php endif; ?>

    <!-- gambar (jika ada) -->
    <?php if (!empty($gambar)): ?>
        <div class="mb-1">
            <img src="<?= htmlspecialchars($gambar) ?>" alt="<?= htmlspecialchars($judul) ?>" style="max-width:50%;border-radius:8px;">
        </div>
    <?php endif; ?>

    <div class="detail-content">
      <?php 
        $konten_bersih = htmlspecialchars($konten);
        $konten_format = preg_replace("/\n{2,}/", "</p><p>", $konten_bersih); 
        echo "<p>$konten_format</p>";
      ?>

    </div>

    <a href="berita.php" class="back-btn">← Kembali</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




