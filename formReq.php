<?php
include "konekDB.php"; // koneksi PostgreSQL

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil data input
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];

    //  Upload CV
    $cvFile = null;

    if (!empty($_FILES["cv"]["name"])) {

        $folder = "uploads_cv/";
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $cvFile = time() . "_cv_" . basename($_FILES["cv"]["name"]);
        $targetCV = $folder . $cvFile;

        move_uploaded_file($_FILES["cv"]["tmp_name"], $targetCV);
    }

    //  Upload KTM
    $ktmFile = null;

    if (!empty($_FILES["ktm"]["name"])) {

        $folder = "uploads_ktm/";
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $ktmFile = time() . "_ktm_" . basename($_FILES["ktm"]["name"]);
        $targetKTM = $folder . $ktmFile;

        move_uploaded_file($_FILES["ktm"]["tmp_name"], $targetKTM);
    }

    //  Insert ke Database
    $query = "
        INSERT INTO open_recruitment
        (full_name, email_kampus, phone_number, file_cv, file_ktm)
        VALUES ($1, $2, $3, $4, $5)
    ";

    $result = pg_query_params(
        $conn,
        $query,
        array($fullname, $email, $phone, $cvFile, $ktmFile)
    );

    if ($result) {
        echo "
        <script>
            alert('Pendaftaran berhasil dikirim!');
            window.location = 'landing.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal mengirim data.');
            window.history.back();
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Open Recruitment</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="formReq.css">
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

  <!-- FORM -->
  <div class="container my-5">
    <div class="card mx-auto form-card shadow">
      <div class="card-body">
        <h4 class="text-center fw-bold text-dark">FORM OPEN RECRUITMENT</h4>
        <p class="text-center text-muted mb-4">Laboratorium Software Engineering</p>

        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Full Name :</label>
            <input type="text" name="fullname" class="form-control" placeholder="Enter Your Full Name" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email Kampus :</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Campus Email" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Phone Number :</label>
            <input type="tel" name="phone" class="form-control" placeholder="Enter Your Phone Number" required>
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <label class="form-label">Upload CV :</label>
              <input type="file" name="cv" class="form-control" accept=".pdf,.docx" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Upload KTM :</label>
              <input type="file" name="ktm" class="form-control" accept=".jpg,.png,.pdf" required>
            </div>
          </div>

          <div class="d-flex justify-content-between">
            <a href="landing.php" class="btn btn-secondary px-4">Back</a>
            <button type="submit" class="btn btn-primary px-4">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>