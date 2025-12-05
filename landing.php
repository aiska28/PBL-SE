<?php
// koneksi ke database
include 'konekDB.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laboratorium Rekayasa Perangkat Lunak</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="landing.css">
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

<!-- Header Lab -->
<div class="lab-profile text-center mt-4">
  <img src="img/logoLab.png" alt="Logo Lab" style="width:450px; height:auto;">
</div>

<!-- PROFILE LAB -->
<section class="container">
  <?php
    $qProfile = pg_query($conn, "SELECT * FROM ProfileLab LIMIT 1");
    $profile = pg_fetch_assoc($qProfile);
  ?>
  <h3 class="section-title"><?= $profile['judul']; ?></h3>
  <p class="text-center"><?= nl2br($profile['deskripsi']); ?></p>

  <!-- Carousel Multi-item -->
  <div id="labCarousel" class="carousel slide mt-4 mb-5" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="d-flex justify-content-center gap-3">
          <img src="img/lab1.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 1">
          <img src="img/lab2.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 2">
          <img src="img/lab3.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 3">
        </div>
      </div>
      <div class="carousel-item">
        <div class="d-flex justify-content-center gap-3">
          <img src="img/lab4.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 4">
          <img src="img/lab5.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 5">
          <img src="img/lab6.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 6">
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#labCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#labCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</section>

<!-- VISI & MISI -->
<section class="container vision-mission text-center">
  <?php
    $qVM = pg_query($conn, "SELECT * FROM visi_misi LIMIT 1");
    $vm = pg_fetch_assoc($qVM);
  ?>
  <div class="row g-4 align-items-stretch">
    <div class="col-md-6">
      <div class="card p-4 h-100 vm-box text-center">
        <h4>VISI</h4>
        <p><?= nl2br($vm['visi']); ?></p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4 h-100 vm-box text-center">
        <h4>MISI</h4>
        <ul class="text-start">
          <?php
            $misiList = explode("\n", $vm['misi']);
            foreach($misiList as $misi) {
              $misi = trim(preg_replace('/^\d+\.\s*/', '', $misi));
              echo "<li>{$misi}</li>";
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- FOKUS RISET -->
<section class="container mt-5">
  <h4 class="section-title">Fokus Riset</h4>
  <div class="d-flex flex-wrap gap-3" style="justify-content:flex-start;">
    <?php
      $qRiset = pg_query($conn, "SELECT * FROM FokusRiset");
      while($riset = pg_fetch_assoc($qRiset)) {
        echo '<span class="badge rounded-pill bg-light text-primary fs-5 px-4 py-3 border">'.$riset['deskripsi'].'</span>';
      }
    ?>
  </div>
</section>

<!-- PUBLIKASI & ANGGOTA TIM (Statis) -->
<div class="container my-5">
  <div class="row g-4 align-items-stretch">

    <!-- Publikasi -->
    <div class="col-md-8 d-flex">
      <div class="card publikasi flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="text-white mb-0">Publikasi</h5>
          <span class="tahun">2025</span>
        </div>
        <div class="card-body text-white d-flex flex-column justify-content-between">
          <div>
            <ol class="mb-4">
              <!-- Versi statis -->
              <li>Imam Fahrul Rozi, ST., MT.</li>
              <li>Ridwan Rismanto, S.M., Kom.</li>
              <li>Dian Hanifudin Subhi, S.Kom., M.Kom.</li>
              <li>Moch. Zawaruuddin Abdullah, S.ST., M.Kom.</li>
              <li>Ariadi Retno Ririd, S.Kom., M.Kom.</li>
              <li>Elok Nur Hamdana, S.T., M.T.</li>
            </ol>
          </div>
          <div class="d-flex justify-content-between mt-4">
            <a href="daftarPublikasi.php" class="text-white text-decoration-none">Lihat Publikasi ➜</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Anggota Tim -->
    <div class="col-md-4 d-flex">
      <div class="card dosen text-white flex-fill">
        <div class="card-header text-center">
          <strong class="mb-0">ANGGOTA TIM</strong>
        </div>
        <div class="card-body text-center d-flex flex-column justify-content-between">
          <div>
            <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png" class="rounded-circle mb-3" width="100" alt="Dosen">
            <h6>Imam Fahrul Rozi, ST., MT.</h6>
            <p class="mb-3 text-light">Kepala Lab</p>
          </div>
          <div class="d-flex justify-content-center gap-2 mt-3">
            <a href="dataDosen.php?id_dosen=1" class="btn btn-outline-primary btn-sm px-4 rounded-pill fw-semibold shadow-sm selengkapnya-btn">
              <i class="bi bi-people-fill me-1"></i> Detail
            </a>
            <a href="daftarTim.php" class="btn btn-outline-primary btn-sm px-4 rounded-pill fw-semibold shadow-sm selengkapnya-btn">
              <i class="bi bi-people-fill me-1"></i> Anggota Selengkapnya
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- FASILITAS & PERALATAN -->
<section class="container my-5">
  <h4 class="section-title">Fasilitas & Peralatan</h4>
  <div class="row g-4 mt-3 text-center">
    <?php
      $qFasilitas = pg_query($conn, "SELECT * FROM FasilitasPeralatan");
      while($fasilitas = pg_fetch_assoc($qFasilitas)) {
        echo '<div class="col-md-3">
                <div class="card fasilitas">
                  <div class="card-body">
                    <h4>'.$fasilitas['judul'].'</h4>
                    <p>'.$fasilitas['deskripsi'].'</p>
                  </div>
                </div>
              </div>';
      }
    ?>
  </div>
</section>

<!-- KEGIATAN & PROYEK -->
<section class="container my-5">
  <h4 class="section-title">Kegiatan & Proyek</h4>
  <div class="row g-4 mt-3 text-center">
    <?php
      $qKegiatan = pg_query($conn, "SELECT * FROM KegiatanProyek");
      while($kegiatan = pg_fetch_assoc($qKegiatan)) {
        echo '<div class="col-md-3">
                <div class="card kegiatan">
                  <div class="card-body">
                    <h4>'.$kegiatan['judul'].'</h4>
                    <p>'.$kegiatan['deskripsi'].'</p>
                  </div>
                </div>
              </div>';
      }
    ?>
  </div>
</section>

<!-- PERKULIAHAN TERKAIT -->
<section class="container mt-5">
  <h4 class="section-title">Perkuliahan Terkait</h4>
  <div class="card-container mt-4">
    <div class="row g-4">
      <?php
        $qKuliah = pg_query($conn, "SELECT * FROM PerkuliahanTerkait");
        while($kuliah = pg_fetch_assoc($qKuliah)) {
          echo '<div class="col-md-4">
                  <h6>'.$kuliah['judul'].'</h6>
                  <p>'.$kuliah['deskripsi'].'</p>
                </div>';
        }
      ?>
    </div>
  </div>
</section>

<!-- SOP LAYANAN -->
<section class="container sop-section">
  <h5 class="sop-title mb-3">SOP LAYANAN</h5>
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="sop-box">
        <p><strong>Lokasi:</strong> Gedung Jurusan Teknologi Informasi, Lantai 8 Barat</p>
        <p><strong>Jam layanan:</strong> Senin - Jumat, 08.00 - 16.00</p>
      </div>
    </div>
    <div class="col-md-6 text-md-end text-center mt-3 mt-md-0">
      <a href="formPerLay.php" class="btn btn-outline-primary sop-btn me-2">Permohonan Layanan</a>
      <a href="formReq.php" class="btn btn-outline-primary sop-btn me-2">Bergabung dengan Tim</a>
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
          <a href="https://www.youtube.com/@PoliteknikNegeriMalangOfficial/featured" target="_blank" class="social-link me-2">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
