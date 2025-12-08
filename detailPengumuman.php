<?php
// detailPengumuman.php
include 'konekDB.php';

// Ambil id dan validasi
$id = $_GET['id'] ?? null;
if ($id === null || $id === '') {
    http_response_code(400);
    echo "<h2>ID pengumuman tidak ditemukan.</h2>";
    echo '<p><a href="pengumuman.php">Kembali ke daftar pengumuman</a></p>';
    exit;
}
if (!ctype_digit((string)$id)) {
    http_response_code(400);
    echo "<h2>Parameter ID tidak valid.</h2>";
    echo '<p><a href="pengumuman.php">Kembali ke daftar pengumuman</a></p>';
    exit;
}

// Ambil data pengumuman dari tabel pengumuman
$sql = "SELECT * FROM pengumuman WHERE id = $1 LIMIT 1";
$res = pg_query_params($conn, $sql, array($id));
$data = pg_fetch_assoc($res);

if (!$data) {
    http_response_code(404);
    echo "<h2>Pengumuman tidak ditemukan.</h2>";
    echo '<p><a href="pengumuman.php">Kembali ke daftar pengumuman</a></p>';
    exit;
}

// ==================== PERBAIKAN BAGIAN GAMBAR ====================
$gambarList = [];

$qGambar = pg_query_params($conn,
    "SELECT gambar, gambar2, gambar3 FROM pengumuman WHERE id = $1",
    array($id)
);

if ($qGambar) {
    $g = pg_fetch_assoc($qGambar);

    if (!empty($g['gambar']))  $gambarList[] = $g['gambar'];
    if (!empty($g['gambar2'])) $gambarList[] = $g['gambar2'];
    if (!empty($g['gambar3'])) $gambarList[] = $g['gambar3'];
}
// ==================== END PERBAIKAN GAMBAR ====================
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($data['judul'] ?? 'Detail Pengumuman') ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="detailPengumuman.css">
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #1d2c8a;">
  <div class="container-fluid px-5">
    <div class="d-flex align-items-center me-auto">
      <img src="img/logoPolinema.png" alt="Logo" style="height: 60px;" class="me-3">
      <div class="text-white lh-1">
        <div style="font-size: 14px; font-weight: 600;">JURUSAN TEKNOLOGI INFORMASI</div>
        <div style="font-size: 18px; font-weight: 700;">POLITEKNIK NEGERAL MALANG</div>
      </div>
    </div>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="landing.php">Beranda</a></li>
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="berita.php">Berita</a></li>
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold active" href="pengumuman.php">Pengumuman</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container my-5">
  <div class="pengumuman-container">

    <h1 class="pengumuman-title"><?= htmlspecialchars($data['judul']) ?></h1>

    <?php if (!empty($data['tanggal'])): ?>
      <div class="pengumuman-date"><?= htmlspecialchars(date("F j, Y", strtotime($data['tanggal']))) ?></div>
    <?php endif; ?>

    <?php if (!empty($data['konten'])): ?>
        <p class="pengumuman-desc"><?= nl2br(htmlspecialchars($data['konten'])) ?></p>
    <?php endif; ?>


    <!-- ================= GAMBAR DITAMPILKAN DI SINI ================= -->
    <?php if (!empty($gambarList)): ?>
      <div class="dokumen-wrapper">
        <?php foreach ($gambarList as $img): ?>
            <img src="<?= htmlspecialchars($img) ?>" width="300" style="margin:10px 0; border-radius:10px;">
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <!-- =============================================================== -->

    <a href="berita.php" class="back-btn">← Kembali</a>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
