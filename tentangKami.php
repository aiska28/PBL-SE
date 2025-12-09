<?php 
include 'konekDB.php';

// ================== SEJARAH ===================
$q_sejarah = pg_query($conn, "SELECT * FROM sejarah ORDER BY id DESC LIMIT 1");
$sejarah = pg_fetch_assoc($q_sejarah);

// ================== VISI MISI TUJUAN ===================
$q_visi = pg_query($conn, "SELECT * FROM visi_misi_tujuan ORDER BY id DESC LIMIT 1");
$vt = pg_fetch_assoc($q_visi);

// ================== STRUKTUR ORGANISASI ===================
$q_struktur = pg_query($conn, "SELECT * FROM struktur_organisasi ORDER BY id ASC");

// ================== TENAGA PENGAJAR ===================
$q_pengajar = pg_query($conn, "SELECT * FROM tenaga_pengajar ORDER BY id ASC");

// ================== TENAGA KEPENDIDIKAN ===================
$q_kependidikan = pg_query($conn, "SELECT * FROM tenaga_kependidikan ORDER BY id ASC");

// ================== SARANA & PRASARANA ===================
$q_sapras = pg_query($conn, "SELECT * FROM sarana_prasarana ORDER BY id ASC");


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tentangKami.css">
    <title>Profil Sekolah</title>

    <style>
        .section { display: none; }
        .section.active { display: block; }
        body { background-color: #ecf0f1; }
    </style>
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

        <li class="nav-item mx-3">
          <a class="nav-link text-white fw-semibold" href="landing.php" onclick="showSection('sejarah')">Beranda</a>
        </li>

        <li class="nav-item dropdown mx-3">
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="tentangDropdown" data-bs-toggle="dropdown">
            Tentang Kami
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="showSection('sejarah')">Sejarah</a></li>
            <li><a class="dropdown-item" href="#" onclick="showSection('visi')">Visi, Misi dan Tujuan</a></li>
            <li><a class="dropdown-item" href="#" onclick="showSection('struktur')">Struktur Organisasi</a></li>
            <li><a class="dropdown-item" href="#" onclick="showSection('pengajar')">Tenaga Pengajar</a></li>
            <li><a class="dropdown-item" href="#" onclick="showSection('kependidikan')">Tenaga Kependidikan</a></li>
            <li><a class="dropdown-item" href="#" onclick="showSection('Sarana')">Sarana dan Prasarana</a></li>
          </ul>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link text-white fw-semibold" href="berita.php">Berita & Pengumuman</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container py-4">

    <div id="sejarah" class="section active">
        <h2><?= $sejarah['judul']; ?></h2>
        <p><?= nl2br($sejarah['deskripsi']); ?></p>
    </div>

    <div id="visi" class="section">
        <h2>Visi, Misi dan Tujuan</h2>

        <h3>Visi</h3>
        <p><?= nl2br($vt['visi']); ?></p>

        <h3>Misi</h3>
        <p><?= nl2br($vt['misi']); ?></p>

        <h3>Tujuan</h3>
        <p><?= nl2br($vt['tujuan']); ?></p>
    </div>

    <div id="struktur" class="section">
        <h2 class="text-center mb-4">Struktur Organisasi</h2>

        <!-- Gambar struktur -->
        <div class="text-center mb-4">
            <img src="uploads/struktur.jpg" style="max-width:100%; height:auto;">
        </div>

        <div class="container">
            <?php while($st = pg_fetch_assoc($q_struktur)) { ?>
                <div class="mb-3">
                    <p>
                        <strong><?= $st['jabatan']; ?>:</strong><br>
                        <?= $st['nama']; ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="pengajar" class="section">
        <h2>Tenaga Pengajar</h2>
        
        <div class="row">
            <?php while($pg = pg_fetch_assoc($q_pengajar)) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card p-2 shadow">
                        <img src="uploads/<?= $pg['foto_url']; ?>" class="card-img-top mb-2"
                             style="height:200px; object-fit:cover;">
                        <h5 class="text-center"><?= $pg['nama_dosen']; ?></h5>
                        <p class="text-center"><?= $pg['jabatan']; ?></p>
                        <p class="text-center text-muted">NIDN: <?= $pg['nidn']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="kependidikan" class="section">
        <h2>Tenaga Kependidikan</h2>
        
        <div class="row">
            <?php while($kp = pg_fetch_assoc($q_kependidikan)) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow p-3">
                        <h5 class="text-center"><?= $kp['nama_pegawai']; ?></h5>
                        <p class="text-center text-muted"><?= $kp['jabatan']; ?></p>
                        <p><?= nl2br($kp['deskripsi']); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="Sarana" class="section">
        <h2>Sarana dan Prasarana</h2>
        
        <div class="row">
            <?php while($sp = pg_fetch_assoc($q_sapras)) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow p-2">

                        <?php if (!empty($sp['foto_url'])) { ?>
                            <img src="uploads/<?= $sp['foto_url']; ?>" 
                                class="card-img-top mb-2"
                                style="height:220px; object-fit:cover;">
                        <?php } ?>

                        <div class="card-body">
                            <h5><?= $sp['nama_ruangan']; ?></h5>
                            <p><?= nl2br($sp['deskripsi']); ?></p>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

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

<script>
    function showSection(id) {
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => section.classList.remove('active'));

        document.getElementById(id).classList.add('active');
    }
</script>

</body>
</html>
