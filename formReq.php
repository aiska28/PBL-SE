<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Open Recruitment</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/formReq.css">
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

<!-- FORM -->
<div class="container my-5">
  <div class="card mx-auto form-card shadow">
    <div class="card-body">
      <h4 class="text-center fw-bold">FORM OPEN RECRUITMENT</h4>

      <form action="backend/detail.php" method="POST" enctype="multipart/form-data">
        <!-- ACTION IDENTIFIER -->
        <input type="hidden" name="action" value="simpan_open_recruitment">

        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="fullname" class="form-control" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="mb-3">
          <label>NIM</label>
          <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
        </div>

        <div class="mb-3">
          <label>Email Kampus</label>
          <input type="email" name="email" class="form-control" placeholder="Masukkan email kampus" required>
        </div>

        <div class="mb-3">
          <label>No Telepon</label>
          <input type="tel" name="phone" class="form-control" placeholder="Masukkan nomor telepon aktif" required>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label>Upload CV</label>
            <input type="file" name="cv" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Upload KTM</label>
            <input type="file" name="ktm" class="form-control" required>
          </div>
        </div>

        <div class="d-flex justify-content-between">
          <a href="landing.php" class="back-btn"><b>Kembali</b></a>
          <button type="submit" class="btn btn-primary px-4"><b>Kirim</b></button>
        </div>

      </form>
    </div>
  </div>
</div>

</body>
</html>
