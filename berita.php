<?php
include 'konekDB.php';

// Ambil parameter search/tahun/page jika diakses tanpa ajax (server-side initial render)
$search = isset($_GET['search']) ? $_GET['search'] : '';
$tahun  = isset($_GET['tahun']) ? (int)$_GET['tahun'] : 0;
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 6;
$offset  = ($page - 1) * $perPage;

// Buat where sederhana (digunakan hanya untuk initial PHP render count dan fetch)
$where = [];
if($search !== '') $where[] = "judul ILIKE '%".pg_escape_string($search)."%'";
if($tahun > 0) $where[] = "EXTRACT(YEAR FROM tanggal) = $tahun";
$whereSQL = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';

// Ambil total berita (untuk pagination awal)
$resCount = pg_query($conn, "SELECT COUNT(*) AS total FROM view_berita $whereSQL");
$totalRow = $resCount ? (int)pg_fetch_assoc($resCount)['total'] : 0;
$totalPage = $perPage > 0 ? (int)ceil($totalRow / $perPage) : 1;

// Ambil berita sesuai page
$qBerita = pg_query($conn, "SELECT * FROM view_berita $whereSQL ORDER BY tanggal DESC LIMIT $perPage OFFSET $offset");

// Ambil daftar tahun unik untuk filter
$qTahun = pg_query($conn, "SELECT DISTINCT EXTRACT(YEAR FROM tanggal) AS tahun FROM view_berita ORDER BY tahun DESC");
$daftarTahun = [];
while($r = pg_fetch_assoc($qTahun)) $daftarTahun[] = (int)$r['tahun'];

// Jika permintaan AJAX, tangani dan return partial HTML (cards + pagination)
if(isset($_GET['ajax'])) {
    // baca param ajax lebih aman
    $search = isset($_GET['search']) ? pg_escape_string($_GET['search']) : '';
    $tahun  = isset($_GET['tahun']) ? (int)$_GET['tahun'] : 0;
    $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 6;
    $offset  = ($page - 1) * $perPage;

    // Hitung total dengan filter
    $sqlCount = "SELECT COUNT(*) FROM view_berita WHERE 1=1";
    if($search !== '') $sqlCount .= " AND judul ILIKE '%$search%'";
    if($tahun != 0) $sqlCount .= " AND EXTRACT(YEAR FROM tanggal) = $tahun";
    $resCount = pg_query($conn, $sqlCount);
    $totalBerita = $resCount ? (int)pg_fetch_result($resCount, 0, 0) : 0;
    $totalPage = $perPage > 0 ? (int)ceil($totalBerita / $perPage) : 1;

    // Query berita per halaman
    $sql = "SELECT * FROM view_berita WHERE 1=1";
    if($search !== '') $sql .= " AND judul ILIKE '%$search%'";
    if($tahun != 0) $sql .= " AND EXTRACT(YEAR FROM tanggal) = $tahun";
    $sql .= " ORDER BY tanggal DESC LIMIT $perPage OFFSET $offset";
    $qBeritaAjax = pg_query($conn, $sql);

    // CETAK KARTU BERITA
    echo '<div class="row g-4 mt-2">';
    while($berita = pg_fetch_assoc($qBeritaAjax)){
        $imgHtml = $berita['gambar'] ? '<img src="'.htmlspecialchars($berita['gambar']).'" class="card-img-top" alt="'.htmlspecialchars($berita['judul']).'">' : '';
        echo '<div class="col-md-4 berita-item" data-judul="'.htmlspecialchars(strtolower($berita['judul'])).'" data-tahun="'.date('Y', strtotime($berita['tanggal'])).'">
                <div class="card h-100">
                    '.$imgHtml.'
                    <div class="card-body">
                        <h5 class="card-title">'.htmlspecialchars($berita['judul']).'</h5>
                        <p class="card-text">'.htmlspecialchars(substr($berita['konten'],0,110)).'...</p>
                        <small class="text-muted"> '.date('d M Y',strtotime($berita['tanggal'])).'</small>
                    </div>
                    <div class="card-footer text-end">
                        <a href="detailBerita.php?id='.intval($berita['id']).'" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                    </div>
                </div>
            </div>';
    }
    echo '</div>';

    // PAGINATION
    if ($totalPage > 1){
        echo '<nav aria-label="Page navigation"><ul class="pagination justify-content-center mt-3">';
        for($i=1; $i <= $totalPage; $i++){
            echo '<li class="page-item '.($i==$page?'active':'').'">
                    <a href="#" class="page-link" data-page="'.$i.'">'.$i.'</a>
                  </li>';
        }
        echo '</ul></nav>';
    }
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Berita & Pengumuman - Laboratorium RPL</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="berita.css">

<!-- jQuery (digunakan ajax kecil) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" style="background-color: #1d2c8a;">
  <div class="container px-5">
    <div class="d-flex align-items-center me-auto">
      <img src="img/logoPolinema.png" alt="Logo" style="height:60px;" class="me-3">
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
            <li><a class="dropdown-item" href="tentangKami.php">Sejarah</a></li>
            <li><a class="dropdown-item" href="tentangKami.php">Visi, Misi dan Tujuan</a></li>
            <li><a class="dropdown-item" href="tentangKami.php">Struktur Organisasi</a></li>
            <li><a class="dropdown-item" href="tentangKami.php">Tenaga Pengajar</a></li>
            <li><a class="dropdown-item" href="tentangKami.php">Tenaga Kependidikan</a></li>
            <li><a class="dropdown-item" href="tentangKami.php">Sarana dan Prasarana</a></li>
          </ul>
        </li>
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold active" href="berita.php">Berita & Pengumuman</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HEADER -->
<section class="container mt-4 text-center">
   <h1 class="section-title">BERITA & PENGUMUMAN</h1>
  <p class="lead">SELAMAT DATANG DI LABORATORIUM SOFTWARE ENGINEERING</p>
</section>

<!-- PENGUMUMAN & AGENDA -->
<section class="container my-4 px-4 py-4 rounded" style="background-color: #f5f5f5;">
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

<!-- BERITA -->
<section class="container my-4">
  <h4 class="section-title">BERITA</h4>

  <!-- SEARCH & FILTER -->
  <div class="d-flex justify-content-center gap-2 mb-4">
      <input type="text" id="searchBerita" class="form-control" placeholder="Cari Berita..." style="max-width:360px;">
      <select id="filterTahun" class="form-select" style="width:160px;">
          <option value="0">Semua Tahun</option>
          <?php foreach($daftarTahun as $t): ?>
              <option value="<?= intval($t) ?>"><?= intval($t) ?></option>
          <?php endforeach; ?>
      </select>
  </div>

  <!-- BERITA & PAGINATION (Kontainer AJAX akan mengganti bagian ini saat filter/search/paging) -->
  <div id="beritaContainer">
    <?php
    echo '<div class="row g-4 mt-2">';
    while($berita = pg_fetch_assoc($qBerita)){
        echo '<div class="col-md-4 mb-3 berita-item" data-judul="'.htmlspecialchars(strtolower($berita['judul'])).'" data-tahun="'.date('Y',strtotime($berita['tanggal'])).'">
                <div class="card h-100">';
        if($berita['gambar']) echo '<img src="'.htmlspecialchars($berita['gambar']).'" class="card-img-top" alt="'.htmlspecialchars($berita['judul']).'">';
        echo '<div class="card-body">
                <h5 class="card-title">'.htmlspecialchars($berita['judul']).'</h5>
                <p class="card-text">'.htmlspecialchars(substr($berita['konten'],0,200)).'...</p>
                <small class="text-muted"> '.date('d M Y',strtotime($berita['tanggal'])).'</small>
              </div>
              <div class="card-footer text-end">
                <a href="detailBerita.php?id='.intval($berita['id']).'" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
              </div>
            </div>
          </div>';
    }
    echo '</div>';

    // pagination server-side awal
    if($totalPage > 1){
        echo '<nav aria-label="Page navigation"><ul class="pagination justify-content-center mt-3">';
        for($i=1;$i<=$totalPage;$i++){
            echo '<li class="page-item '.($i==$page?'active':'').'">
                    <a href="#" class="page-link" data-page="'.$i.'">'.$i.'</a>
                  </li>';
        }
        echo '</ul></nav>';
    }
    ?>
  </div>
</section>

<!-- FOOTER (full width) -->
<footer class="footer-custom mt-5">
  <div class="container-fluid" style="max-width:1300px;">
    <div class="row align-items-start text-white py-4 px-4">
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
          <a href="#" class="social-link me-2"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" width="28"></a>
          <a href="#" class="social-link"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" width="28"></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/**
 * Debounce helper
 */
function debounce(fn, delay){
    let timer = null;
    return function(...args){
        clearTimeout(timer);
        timer = setTimeout(() => fn.apply(this, args), delay);
    };
}

/**
 * loadBerita via AJAX (mengambil partial HTML dari server)
 */
function loadBerita(search = '', tahun = 0, page = 1){
    $.get(window.location.pathname, {
        ajax: 1,
        search: search,
        tahun: tahun,
        page: page
    }, function(data){
        $('#beritaContainer').html(data);
        // scroll ke atas hasil
        $('html, body').animate({ scrollTop: $("#beritaContainer").offset().top - 120 }, 200);
    }).fail(function(){
        console.error('Gagal memuat data berita via AJAX.');
    });
}

$(document).ready(function(){
    const debounced = debounce(function(){
        loadBerita($('#searchBerita').val(), $('#filterTahun').val(), 1);
    }, 300);

    $('#searchBerita').on('input', debounced);
    $('#filterTahun').on('change', function(){ loadBerita($('#searchBerita').val(), $(this).val(), 1); });

    // Delegated pagination click yang dibuat oleh server (partial)
    $(document).on('click', '.page-link', function(e){
        e.preventDefault();
        const page = $(this).data('page') || 1;
        loadBerita($('#searchBerita').val(), $('#filterTahun').val(), page);
    });

    // Opsional: jika ingin langsung load AJAX di awal uncomment baris dibawah
    // loadBerita($('#searchBerita').val(), $('#filterTahun').val(), <?= (int)$page ?>);
});
</script>

</body>
</html>
