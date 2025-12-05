<?php
include "konekDB.php";

// Pastikan ada id di URL
if (!isset($_GET['id_dosen'])) {
    die("ID dosen tidak ditemukan.");
}

$id = intval($_GET['id_dosen']);

// === Ambil Data Dosen dari VIEW ===
$q_dosen = "SELECT * FROM v_dosen_detail_halaman WHERE id_dosen = $id LIMIT 1";
$result_dosen = pg_query($conn, $q_dosen);
$dosen = pg_fetch_assoc($result_dosen);

if (!$dosen) {
    die("Data dosen tidak ditemukan.");
}

// Decode JSON dari view
$mk_genap = json_decode($dosen['mk_semester_genap'], true);
$mk_ganjil = json_decode($dosen['mk_semester_ganjil'], true);
$pendidikan = json_decode($dosen['riwayat_pendidikan'], true);
$publikasi = json_decode($dosen['publikasi'], true);
$link_sosial = json_decode($dosen['link_sosial'], true);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Tim Laboratorium</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="dataDosen.css">
</head>
<body>
  
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg" style="background-color: #1d2c8a;">
    <div class="container-fluid px-5">
      <!-- LOGO + TEXT -->
      <div class="d-flex align-items-center me-auto">
        <img src="img/logoPolinema.png" alt="Logo" style="height: 60px;" class="me-3">
        <div class="text-white lh-1">
          <div style="font-size: 14px; font-weight: 600;">JURUSAN TEKNOLOGI INFORMASI</div>
          <div style="font-size: 18px; font-weight: 700;">POLITEKNIK NEGERI MALANG</div>
        </div>
      </div>

      <!-- Toggle button (mobile) -->
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- MENU -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item mx-3">
            <a class="nav-link text-white fw-semibold" href="#">Beranda</a>
          </li>
          <li class="nav-item dropdown mx-3">
            <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="tentangDropdown"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tentang Kami
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Sejarah</a></li>
              <li><a class="dropdown-item" href="#">Visi, Misi dan Tujuan</a></li>
              <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
              <li><a class="dropdown-item" href="#">Tenaga Pengajar</a></li>
              <li><a class="dropdown-item" href="#">Tenaga Kependidikan</a></li>
              <li><a class="dropdown-item" href="#">Sarana dan Prasarana</a></li>
            </ul>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link text-white fw-semibold" href="#">Berita & Pengumuman</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <div class="container mt-4">
    <div class="lab-header p-3 rounded text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Tim Laboratorium</h4>
    <a href="daftarTim.php" class="btn btn-warning fw-bold shadow-sm">
      <i class="bi bi-arrow-left-circle me-1"></i> Kembali
  </a>
    </div>
  </div>

  <!-- Profil Dosen -->
  <section class="container mt-3 bg-white p-4 rounded shadow-sm">
    <div class="row">
      <!-- Foto -->
      <div class="col-md-3 text-center">
        <?php  
          $folder = "uploads/";
          $fotoFile = trim($dosen['foto']);
          $fotoPath = $folder . $fotoFile;
          if (empty($fotoFile) || !file_exists($fotoPath)) {
              $fotoPath = $folder . "default.jpg";
          }
        ?>
        <img 
          src="<?= $fotoPath ?>"
          alt="Foto Dosen"
          class="img-fluid rounded mt-3 mb-4"
          style="width: 150px; height: 150px; object-fit: contain; background: #fff; padding: 5px;"
        >

        <p><strong>NIP:</strong> <?= $dosen['nip'] ?></p>
        <p><strong>NIDN:</strong> <?= $dosen['nidn'] ?></p>
        <p><strong>Program Studi:</strong><br><?= $dosen['program_studi'] ?></p>
        <p><strong>Jabatan:</strong><br><?= $dosen['jabatan'] ?></p>
      </div>

      <!-- Detail Profil -->
      <div class="col-md-9">
        <div class="bg-primary text-white p-3 rounded mb-3">
          <h5 class="mb-0"><?= $dosen['nama'] ?></h5>
          <small>Programming | Software | Data Mining | Text Processing</small>
        </div>

        <div class="card border-0 shadow-sm p-3 mb-3">
          <p><strong>Kontak:</strong></p>
          <ul class="list-unstyled mb-2">
            <li><strong>Email:</strong> <?= $dosen['email'] ?></li>
            <li><strong>Alamat Kantor:</strong> <?= $dosen['alamat_kantor'] ?></li>
          </ul>
        </div>

        <div class="row">
          <!-- Mata Kuliah -->
          <div class="col-md-6 mb-3">
            <div class="card bg-primary text-white p-3 h-100">
              <h6 class="fw-bold">Mata Kuliah</h6>
              <p class="mt-2 mb-1"><strong>Semester Genap:</strong></p>
              <ul>
                <?php if($mk_genap) foreach ($mk_genap as $mk) : ?>
                  <li><?= htmlspecialchars($mk) ?></li>
                <?php endforeach; ?>
              </ul>

              <p class="mb-1"><strong>Semester Ganjil:</strong></p>
              <ul>
                <?php if($mk_ganjil) foreach ($mk_ganjil as $mk) : ?>
                  <li><?= htmlspecialchars($mk) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>

          <!-- Pendidikan -->
          <div class="col-md-6 mb-3">
            <div class="card bg-light p-3 h-100">
              <ul>
                <?php if($pendidikan) foreach ($pendidikan as $edu) : ?>
                  <li><?= htmlspecialchars($edu['jenjang'] . " | " . $edu['jurusan'] . " | " . $edu['universitas'] . " | " . $edu['tahun']) ?></li>
                <?php endforeach; ?>
              </ul>

              <div class="mt-3 d-flex gap-3">
                <!-- Publikasi / Link Sosial -->
                <a href="<?= htmlspecialchars($publikasi[0]['link'] ?? '#') ?>" target="_blank">
                  <img src="img/googlescholar.jpg" alt="Google Scholar" style="width: 55px; height: 45px; cursor: pointer;">
                </a>
                <a href="<?= htmlspecialchars($publikasi[1]['link'] ?? '#') ?>" target="_blank">
                  <img src="img/sinta.jpg" alt="Sinta" style="width: 55px; height: 45px; cursor: pointer;">
                </a>
                <a href="<?= htmlspecialchars($publikasi[2]['link'] ?? '#') ?>" target="_blank">
                  <img src="img/scopus.png" alt="Scopus" style="width: 60px; height: 45px; cursor: pointer;">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer-custom mt-5">
    <div class="container py-4">
      <div class="row align-items-start text-white">  
        <div class="col-md-2 d-flex justify-content-center mb-3 mb-md-0">
          <img src="img/logoPolinema.png" width="120" alt="Logo JTI">
        </div>
        <div class="col-md-4">
          <div class="footer-subtitle">JURUSAN TEKNOLOGI INFORMASI</div>
          <div class="footer-subtitle-bold">POLITEKNIK NEGERI MALANG</div>
        </div>
        <div class="col-md-3 footer-address">
          Jl. Soekarno Hatta No.9, Jatimulyo,<br>
          Lowokwaru, Malang, Jawa Timur 65141
        </div>
        <div class="col-md-3">
          <div class="footer-title">Website Polinema</div>
          <hr class="footer-line">
          <a href="https://polinema.ac.id" target="_blank" class="footer-link">Polinema.ac.id</a>
          <div class="d-flex align-items-center mt-3">
            <a href="https://www.youtube.com/@PoliteknikNegeriMalangOfficial/featured" 
               target="_blank" class="social-link me-2">
              <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" width="28">
            </a>
            <a href="https://www.instagram.com/polinema_campus" target="_blank" class="social-link">
              <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" width="28">
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
