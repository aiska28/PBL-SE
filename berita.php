<?php
include 'konekDB.php';

/* ====== AMBIL TAHUN UNTUK FILTER ====== */
$qTahun = pg_query($conn,"SELECT DISTINCT EXTRACT(YEAR FROM tanggal) AS tahun FROM view_berita ORDER BY tahun DESC");
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Berita & Pengumuman - Laboratorium RPL</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/berita.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg" style="background-color:#1d2c8a;">
  <div class="container px-5">
    <div class="d-flex align-items-center me-auto">
      <img src="img/logoPolinema.png" height="60" class="me-3">
      <div class="text-white lh-1">
        <div style="font-size:14px;font-weight:600;">JURUSAN TEKNOLOGI INFORMASI</div>
        <div style="font-size:18px;font-weight:700;">POLITEKNIK NEGERI MALANG</div>
      </div>
    </div>

    <button class="navbar-toggler bg-light" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mx-3">
          <a class="nav-link text-white fw-semibold" href="landing.php">Beranda</a>
        </li>

        <li class="nav-item dropdown mx-3">
          <a class="nav-link dropdown-toggle text-white fw-semibold" data-bs-toggle="dropdown">Tentang Kami</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="tentangKami.php">Sejarah</a></li>
            <li><a class="dropdown-item" href="tentangKami.php">Visi & Misi</a></li>
            <li><a class="dropdown-item" href="tentangKami.php">Struktur Organisasi</a></li>
          </ul>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link text-white fw-semibold active" href="berita.php">Berita & Pengumuman</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- ================= HEADER ================= -->
<section class="container mt-4 text-center">
  <h1 class="section-title">BERITA & PENGUMUMAN</h1>
  <p class="lead">SELAMAT DATANG DI LABORATORIUM SOFTWARE ENGINEERING</p>
</section>

<!-- ================= PENGUMUMAN & AGENDA ================= -->
<section class="container my-4 px-4 py-4 rounded" style="background:#f5f5f5;">
<div class="row g-4">

    <!-- Pengumuman -->
    <div class="col-lg-6 col-md-12">
      <div class="card h-100 shadow-sm p-3">
         <h4 class="section-title">PENGUMUMAN</h4>
        <div class="list-group">
          <?php
          $qPengumuman = pg_query($conn, "SELECT * FROM view_pengumuman ORDER BY tanggal DESC LIMIT 5");
          while($p = pg_fetch_assoc($qPengumuman)){
              echo '<a href="detailPengumuman.php?id='.intval($p['id']).'" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start mb-2 shadow-sm">
                      <div class="ms-2 me-auto text-wrap">
                        <div class="fw-bold">'.htmlspecialchars($p['judul']).'</div>
                        '.htmlspecialchars(substr($p['konten'],0,150)).'...
                      </div>
                      <span class="badge bg-primary rounded-pill">'.date('d M Y',strtotime($p['tanggal'])).'</span>
                    </a>';
          }
          ?>
        </div>
      </div>
    </div>

    <!-- Agenda -->
    <div class="col-lg-6 col-md-12">
      <div class="card h-100 shadow-sm p-3">
         <h4 class="section-title">AGENDA</h4>
        <div class="list-group">
        <?php
        $qAgenda = pg_query($conn, "SELECT * FROM view_agenda ORDER BY tanggal DESC LIMIT 1");
        $a = pg_fetch_assoc($qAgenda);

        if ($a) {
            echo '
            <a href="detailAgenda.php?id='.intval($a['id']).'" 
              class="list-group-item list-group-item-action d-flex justify-content-between align-items-start mb-2 shadow-sm">

                <div class="ms-2 me-auto text-wrap">
                    <div class="fw-bold">'.htmlspecialchars($a['judul']).'</div>
                    '.htmlspecialchars(substr($a['deskripsi'],0,200)).'...
                </div>

            </a>';
        }
        ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= BERITA ================= -->
<section class="container my-4">
<h4 class="section-title">BERITA</h4>

<!-- SEARCH & FILTER -->
<div class="d-flex justify-content-center gap-2 mb-4">
  <input type="text" id="searchBerita" class="form-control" placeholder="Cari Berita..." style="max-width:360px;">
  <select id="filterTahun" class="form-select" style="width:160px;">
    <option value="0">Semua Tahun</option>
    <?php while($t = pg_fetch_assoc($qTahun)): ?>
      <option value="<?= $t['tahun'] ?>"><?= $t['tahun'] ?></option>
    <?php endwhile ?>
  </select>
</div>

<!-- HASIL AJAX -->
<div id="beritaContainer"></div>
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

<script>
function loadBerita(search='', tahun=0, page=1){
  $.get('backend/detail.php',{search,tahun,page},function(res){
    $('#beritaContainer').html(res);
  });
}

$(document).ready(function(){
  loadBerita();

  $('#searchBerita').on('input',()=>loadBerita($('#searchBerita').val(),$('#filterTahun').val(),1));
  $('#filterTahun').on('change',()=>loadBerita($('#searchBerita').val(),$('#filterTahun').val(),1));

  $(document).on('click','.page-link',function(e){
    e.preventDefault();
    loadBerita($('#searchBerita').val(),$('#filterTahun').val(),$(this).data('page'));
  });
});
</script>

</body>
</html>
