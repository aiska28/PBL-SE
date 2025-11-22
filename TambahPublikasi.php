<?php
include 'konekDB.php';

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_dosen = $_POST['id_dosen'];
    $jenis_publikasi = $_POST['jenis_publikasi'];
    $link_publikasi = $_POST['link_publikasi'];

    $query = "INSERT INTO publikasi (id_dosen, jenis_publikasi, link_publikasi)
              VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($id_dosen, $jenis_publikasi, $link_publikasi));

    if ($result) {
        $pesan = "Data publikasi berhasil disimpan!";
    } else {
        $pesan = "Gagal menyimpan data: " . pg_last_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambahkan Publikasi</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="TambahPublikasi.css">
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

<div class="container mt-3 text-end">
  <a href="landingAdmin.php" class="btn btn-secondary btn-sm">Kembali</a>
</div>

  <!-- FORM -->
  <div class="container my-5">
    <div class="card publikasi-card mx-auto p-4 shadow-lg border-warning">
      <h3 class="text-center text-warning mb-4">Tambahkan Publikasi</h3>

      <?php if (!empty($pesan)): ?>
        <div class="alert alert-info text-center"><?= $pesan; ?></div>
      <?php endif; ?>

      <form method="post" action="">
        <label for="id_dosen" class="form-label">Pilih Dosen :</label>
            <select name="id_dosen" id="id_dosen" class="form-select mb-3" required>
              <option value="">-- Pilih Dosen --</option>
              <?php
              $queryDosen = pg_query($conn, "SELECT id_dosen, nama FROM dosen ORDER BY nama ASC");
              while ($dosen = pg_fetch_assoc($queryDosen)) {
                echo "<option value='{$dosen['id_dosen']}'>{$dosen['nama']}</option>";
              }
              ?>
            </select>



        <div class="mb-3">
          <label class="form-label">Jenis Publikasi :</label><br>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_publikasi" value="Scopus" required>
            <label class="form-check-label">Scopus</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_publikasi" value="Google Scholar">
            <label class="form-check-label">Google Scholar</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_publikasi" value="Sinta">
            <label class="form-check-label">Sinta</label>
          </div>
        </div>


        <div class="mb-3">
          <label class="form-label">Link Publikasi :</label>
          <input type="url" name="link_publikasi" class="form-control" placeholder="Masukkan URL publikasi" required>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-warning text-dark px-5 fw-bold">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>