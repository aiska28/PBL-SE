<?php 
include 'konekDB.php';

$query = "
    SELECT 
        d.id_dosen,
        d.nama AS nama_dosen,
        MAX(CASE WHEN p.jenis_publikasi='Scopus' THEN p.link_publikasi END) AS scopus,
        MAX(CASE WHEN p.jenis_publikasi='Google Scholar' THEN p.link_publikasi END) AS google_scholar,
        MAX(CASE WHEN p.jenis_publikasi='Sinta' THEN p.link_publikasi END) AS sinta
    FROM dosen d
    LEFT JOIN publikasi p ON p.id_dosen = d.id_dosen
    GROUP BY d.id_dosen, d.nama
    ORDER BY d.nama;
";

$result = pg_query($conn, $query);

if (!$result) {
    die("Query gagal dijalankan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Publikasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="daftarPublikasi.css">
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

    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

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

<div class="container mt-3">
  <a href="landing.php" class="btn btn-warning fw-bold">
    <i class="bi bi-arrow-left-circle"></i> Kembali
  </a>
</div>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-md-12">
      <div class="card shadow-lg border-0">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-custom mb-0">
              <thead>
                <tr class="header-bg bg-primary text-white">
                  <th scope="col" class="text-start ps-4" style="width: 50%;">DOSEN</th>
                  <th scope="col" class="text-center">SCOPUS</th>
                  <th scope="col" class="text-center">GOOGLE SCHOLAR</th>
                  <th scope="col" class="text-center pe-4">SINTA</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if (!$result) {
                  echo "<tr><td colspan='4' class='text-center text-danger'>Gagal mengambil data.</td></tr>";
              } else {
                  $no = 1;
                  while ($row = pg_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td class='ps-4'>{$no}. {$row['nama_dosen']}</td>";

                      echo !empty($row['scopus'])
                          ? "<td class='text-center'><a href='{$row['scopus']}' class='detail-link' target='_blank'>DETAIL</a></td>"
                          : "<td class='text-center text-muted'>-</td>";

                      echo !empty($row['google_scholar'])
                          ? "<td class='text-center'><a href='{$row['google_scholar']}' class='detail-link' target='_blank'>DETAIL</a></td>"
                          : "<td class='text-center text-muted'>-</td>";

                      echo !empty($row['sinta'])
                          ? "<td class='text-center pe-4'><a href='{$row['sinta']}' class='detail-link' target='_blank'>DETAIL</a></td>"
                          : "<td class='text-center text-muted pe-4'>-</td>";

                      echo "</tr>";
                      $no++;
                  }
              }

              pg_close($conn);
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>