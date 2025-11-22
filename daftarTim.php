<?php
include 'konekDB.php';

// Ambil data dosen dari database
$query = "
    SELECT 
        id_dosen,
        nama,
        jabatan,
        foto
    FROM dosen
    ORDER BY nama;
";

$result = pg_query($conn, $query);

if (!$result) {
    die("Gagal mengambil data dari database.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Tim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="daftarTim.css">
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
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" data-bs-toggle="dropdown">
            Tentang Kami
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Sejarah</a></li>
            <li><a class="dropdown-item" href="#">Visi Misi</a></li>
            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
            <li><a class="dropdown-item" href="#">Tenaga Pengajar</a></li>
            <li><a class="dropdown-item" href="#">Tenaga Kependidikan</a></li>
            <li><a class="dropdown-item" href="#">Sarana & Prasarana</a></li>
          </ul>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link text-white fw-semibold" href="#">Berita & Pengumuman</a>
        </li>
      </ul>
    </div>

  </div>
</nav>

<!-- Judul -->
<div class="container my-4">

  <div class="d-flex justify-content-between align-items-center">
    <h3 class="fw-semibold text-secondary mb-0">Tim Laboratorium</h3>
    <a href="landing.php" class="btn btn-outline-primary btn-sm">← Kembali</a>
  </div>

  <hr>

  <div class="row">
    <?php 
    while ($row = pg_fetch_assoc($result)) {
        // jika ada foto, gunakan path aslinya, kalau tidak gunakan default
        $foto = !empty($row['foto']) ? $row['foto'] : 'uploads/default.png';
        if (!file_exists($foto)) {
            $foto = 'uploads/default.png';
        }
    ?>
      <div class="col-md-4 col-lg-3 mb-4">
        <div class="card text-center shadow-sm border-0">
          <img src="<?php echo htmlspecialchars($foto); ?>"
               class="card-img-top mx-auto mt-3"
               style="width:100px;height:100px;border-radius:50%;object-fit:cover;">

          <div class="card-body">
            <h6 class="card-title fw-bold"><?php echo htmlspecialchars($row['nama']); ?></h6>
            <p class="badge bg-primary">
              <?php echo htmlspecialchars($row['jabatan'] ?: 'Tidak Ada Jabatan'); ?>
            </p>
            <!-- Tombol Detail Dosen -->
            <a href="dataDosen.php?id_dosen=<?= $row['id_dosen']; ?>" class="btn btn-sm btn-outline-secondary mt-2">Detail Dosen</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- Footer -->
<footer class="bg-primary text-white py-4 mt-5">
  <div class="container text-center">
    <p class="mb-1 fw-bold">JURUSAN TEKNOLOGI INFORMASI - POLITEKNIK NEGERI MALANG</p>
    <p class="mb-0 small">Jl. Soekarno Hatta No.9, Malang</p>
    <a href="https://polinema.ac.id" class="text-white text-decoration-underline small">Polinema.ac.id</a>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>