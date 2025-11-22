<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laboratorium Rekayasa Perangkat Lunak</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- File CSS Eksternal -->
  <link rel="stylesheet" href="landing.css">
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

        <!-- Dropdown Tentang Kami -->
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
    <div class="lab-profile text-center mt-4">
        <img src="img/logoLab.png" alt="Logo Lab">
    </div>


  <!-- Profile -->
  <section class="container">
    <h3 class="section-title">PROFILE LABORATORIUM</h3>
    <p class="text-center">
      Laboratorium Rekayasa Perangkat Lunak merupakan fasilitas akademik di bawah naungan Jurusan Teknologi Informasi
      yang berfokus pada bidang rekayasa pengembangan perangkat lunak. Laboratorium ini diharapkan tumbuh menjadi pusat
      aktivitas penelitian dan pengabdian masyarakat yang berorientasi pada pengembangan teknologi perangkat lunak.
    </p>

    <!-- Carousel Multi-item -->
<div id="labCarousel" class="carousel slide mt-4 mb-5" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="d-flex justify-content-center gap-3">
        <img src="img/lab1.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 1">
        <img src="img/lab2.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 2">
        <img src="img/lab3.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 3">
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="d-flex justify-content-center gap-3">
        <img src="img/lab4.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 4">
        <img src="img/lab5.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 5">
        <img src="img/lab6.jpg" class="d-block rounded" style="width: 30%;" alt="Lab 6">
      </div>
    </div>

  </div>

  <!-- Tombol navigasi -->
  <button class="carousel-control-prev" type="button" data-bs-target="#labCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#labCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

  </section>

  <!-- Visi dan Misi -->
  <section class="container vision-mission text-center">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card p-4">
          <h4>VISI</h4>
          <p>Menjadi pusat unggulan dalam pengembangan ilmu <br>
            pengetahuan, teknologi, dan inovasi di bidang <br>
            Rekayasa Perangkat Lunak yang berdaya saing global, <br>
            dengan kontribusi nyata pada kemajuan akademik,<br>
            industri, dan masyarakat.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card p-4">
          <h4>MISI</h4>
          <ul class="text-start">
            <li>Mengembangkan kompetensi mahasiswa.</li>
            <li>Mendorong penelitian fundamental dan terapan.</li>
            <li>Meningkatkan kolaborasi multi-disiplin.</li>
            <li>Mengoptimalkan pemanfaatan teknologi terkini.</li>
            <li>Mewujudkan pengabdian masyarakat berbasis riset.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Fokus Riset -->
    <section class="container mt-5">
        <h4 class="section-title">Fokus Riset</h4>
        <div class="d-flex flex-wrap gap-3" style="justify-content:flex-start;">
            <span class="badge rounded-pill bg-light text-primary fs-5 px-4 py-3 border">Software Engineering Methodologies and Architecture</span>
            <span class="badge rounded-pill bg-light text-primary fs-5 px-4 py-3 border">Domain-Specific Software Engineering Applications</span>
            <span class="badge rounded-pill bg-light text-primary fs-5 px-4 py-3 border">Emerging Technologies in Software Engineering</span>
        </div>
    </section>


  <!--  SECTION PUBLIKASI & DOSEN  -->
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

    <!-- Dosen -->
    <div class="col-md-4 d-flex">
      <div class="card dosen text-white flex-fill">
        <div class="card-header text-center">
          <strong class="mb-0">ANGGOTA TIM</strong>
        </div>
        <div class="card-body text-center d-flex flex-column justify-content-between">
          <div>
            <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png" 
                 class="rounded-circle mb-3" width="100" alt="Dosen">
            <h6>Imam Fahrul Rozi, ST., MT.</h6>
            <p class="mb-3 text-light">Kepala Lab</p>
          </div>
          <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="dataDosen.php?id_dosen=1"
                  class="btn btn-outline-primary btn-sm px-4 rounded-pill fw-semibold shadow-sm selengkapnya-btn">
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


<!--  FASILITAS & PERALATAN  -->
<section class="container my-5">
  <h4 class="section-title">Fasilitas & Peralatan</h4>
  <div class="row g-4 mt-3 text-center">

    <div class="col-md-3">
      <div class="card fasilitas">
        <div class="card-body">
          <h4>Studio Pengembangan</h4>
          <p>Workspace untuk pengembangan perangkat lunak dengan IDE, OS, dan software pendukung.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card fasilitas">
        <div class="card-body">
          <h4>Ruang Pengujian & QA</h4>
          <p>Tempat untuk testing software, dengan alat bantu analisis dan debugging.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card fasilitas">
        <div class="card-body">
          <h4>DevOps & Version Control</h4>
          <p>Peralatan CI/CD, repository, serta sistem kolaborasi dan pengembangan tim.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card fasilitas">
        <div class="card-body">
          <h4>Fasilitas Penunjang</h4>
          <p>Server, jaringan berkecepatan tinggi, ruang diskusi, dan alat kolaboratif.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!--  KEGIATAN & PROYEK  -->
<section class="container my-5">
  <h4 class="section-title">Kegiatan & Proyek</h4>
  <div class="row g-4 mt-3 text-center">

    <div class="col-md-3">
      <div class="card kegiatan">
        <div class="card-body">
          <h4>Pengembangan Kompetensi Mahasiswa</h4>
          <p>Mendukung mahasiswa dalam kegiatan proyek, skripsi, penelitian, atau kompetisi teknologi.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card kegiatan">
        <div class="card-body">
          <h4>Penelitian Fundamental</h4>
          <p>Fokus pada metodologi, manajemen proyek perangkat lunak, dan arsitektur sistem.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card kegiatan">
        <div class="card-body">
          <h4>Kolaborasi Multi-Disiplin</h4>
          <p>Kolaborasi lintas bidang untuk menciptakan solusi inovatif berbasis teknologi.</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card kegiatan">
        <div class="card-body">
          <h4>Pengabdian Masyarakat</h4>
          <p>Implementasi hasil penelitian untuk menyelesaikan masalah nyata di masyarakat.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- PERKULIAHAN TERKAIT -->
  <section class="container mt-5">
    <h4 class="section-title">Perkuliahan Terkait</h4>

    <div class="card-container mt-4">
      <div class="row g-4">
        <div class="col-md-4">
          <h6>Analisis & Perancangan Sistem Informasi</h6>
          <p>Proses sistematis yang membahas pemenuhan kebutuhan bisnis dan perancangan solusi informasi.</p>
        </div>
        <div class="col-md-4">
          <h6>Analisis dan Desain Berorientasi Objek (ADBO)</h6>
          <p>Metodologi pengembangan perangkat lunak dengan objek sebagai dasar untuk analisis kebutuhan sistem.</p>
        </div>
        <div class="col-md-4">
          <h6>Desain & Pemrograman Web</h6>
          <p>Pemahaman prinsip perancangan antarmuka dan fungsionalitas dasar berbasis web.</p>
        </div>

        <div class="col-md-4">
          <h6>Pemrograman Backend</h6>
          <p>Fokus pada pengelolaan server, database, dan API sebagai bagian dari aplikasi web dinamis.</p>
        </div>
        <div class="col-md-4">
          <h6>Pemrograman Berbasis Framework</h6>
          <p>Membahas framework kerja untuk pengembangan web efisien dan terstruktur.</p>
        </div>
        <div class="col-md-4">
          <h6>Pemrograman Web</h6>
          <p>Pemahaman dasar-dasar pembuatan struktur web dengan HTML, CSS, dan JavaScript.</p>
        </div>

        <div class="col-md-4">
          <h6>Pemrograman Web Lanjut</h6>
          <p>Lanjutan dari Pemrograman Web, fokus pada teknologi web modern seperti React dan Vue.</p>
        </div>
        <div class="col-md-4">
          <h6>Penjaminan Mutu Perangkat Lunak</h6>
          <p>Membahas teknik uji perangkat lunak untuk memastikan kualitas produk sebelum rilis.</p>
        </div>
        <div class="col-md-4">
          <h6>Rekayasa Perangkat Lunak</h6>
          <p>Pengantar tentang struktur dan manajemen proyek perangkat lunak skala besar.</p>
        </div>
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
  </section>

<!-- FOOTER -->
<footer class="footer-custom mt-5">
  <div class="container py-4">

    <!-- BARIS UTAMA -->
    <div class="row align-items-start text-white">  

      <!-- LOGO -->
      <div class="col-md-2 d-flex justify-content-center mb-3 mb-md-0">
        <img src="img/logoPolinema.png" width="120" alt="Logo JTI">
      </div>

      <!-- NAMA JTI -->
      <div class="col-md-4">
        <div class="footer-subtitle">JURUSAN TEKNOLOGI INFORMASI</div>
        <div class="footer-subtitle-bold">POLITEKNIK NEGERI MALANG</div>
      </div>

      <!-- ALAMAT -->
      <div class="col-md-3 footer-address">
        Jl. Soekarno Hatta No.9, Jatimulyo,<br>
        Lowokwaru, Malang, Jawa Timur 65141
      </div>

      <!-- WEBSITE POLINEMA -->
      <div class="col-md-3">
        <div class="footer-title">Website Polinema</div>
        <hr class="footer-line">

        <a href="https://polinema.ac.id" target="_blank" class="footer-link">
          Polinema.ac.id
        </a>

        <div class="d-flex align-items-center mt-3">
          <a href="https://www.youtube.com/@PoliteknikNegeriMalangOfficial/featured" 
             target="_blank" class="social-link me-2">
            <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" width="28">
          </a>

          <a href="https://www.instagram.com/polinema_campus" 
             target="_blank" class="social-link">
            <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" width="28">
          </a>
        </div>
      </div>

    </div>
  </div>
</footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>