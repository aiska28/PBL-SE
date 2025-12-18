<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Pelayanan - Laboratorium Software Engineering</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/formPerLay.css">
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
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="landing.php">Beranda</a></li>
        <li class="nav-item dropdown mx-3">
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="tentangKami.php" id="tentangDropdown" data-bs-toggle="dropdown">Tentang Kami</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="tentangKami.php?section=sejarah">Sejarah</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=visi">Visi, Misi dan Tujuan</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=struktur">Struktur Organisasi</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=pengajar">Tenaga Pengajar</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=kependidikan">Tenaga Kependidikan</a></li>
            <li><a class="dropdown-item" href="tentangKami.php?section=sarana">Sarana dan Prasarana</a></li>
          </ul>
        </li>
        <li class="nav-item mx-3"><a class="nav-link text-white fw-semibold" href="berita.php">Berita & Pengumuman</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTENT (TIDAK DIUBAH) -->
<main class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
      <div class="card-form p-4 shadow-lg rounded-3">

        <h4 class="section-title text-center">FORM PELAYANAN</h4>
        <h5 class="text-center mb-4 fw-bold">Laboratorium Software Engineering</h5>

        <!-- ACTION SAJA YANG DIUBAH -->
        <form action="backend/detail.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" name="action" value="simpan_layanan">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Nama Lengkap :</label>
              <input type="text" class="form-control" name="fullname" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Nomer Telepon :</label>
              <input type="tel" class="form-control" name="phone" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Email :</label>
              <input type="email" class="form-control" name="email" required>
            </div>

            <div class="col-12">
              <label class="form-label">Detail Kegiatan :</label>
              <input type="text" class="form-control" name="detail" required>
            </div>

            <div class="col-12">
              <label class="form-label">Jenis Layanan :</label>
              <select class="form-select" name="layanan" required>
                <option value="" disabled selected>Pilih Layanan</option>
                <option>Pelatihan & Workshop</option>
                <option>Pendampingan Tugas Akhir</option>
                <option>Pengujian Perangkat Lunak</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Tanggal :</label>
              <input type="date" class="form-control" name="tanggal" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Jam Pelaksanaan :</label>
              <input type="time" class="form-control" name="jam" required>
            </div>

            <div class="col-12">
              <label class="form-label">Kirim Surat Layanan:</label>
              <input type="file" class="form-control" name="surat">
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="landing.php" class="back-btn"><b>Kembali</b></a>
              <button type="submit" class="btn btn-primary px-4"><b>Kirim</b></button>
            </div>

          </div>
        </form>

      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
