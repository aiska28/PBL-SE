<?php
session_start();

// Panggil koneksi PostgreSQL
require "konekDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user
    $query = "SELECT * FROM users WHERE username = $1 LIMIT 1";
    $result = pg_query_params($conn, $query, [$username]);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['admin'] = $user['username'];

        header("Location: LandingAdmin.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - JTI Polinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
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


  <!-- LOGIN FORM -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card login-card text-center shadow-lg">
          <div class="login-header">
            LOGIN ADMIN
          </div>

          <form class="p-3" method="POST">
            <div class="input-group mb-4">
              <div class="form-floating form-floating-custom w-100 position-relative">
                <input type="text" name="username" class="form-control form-control-custom" id="username" placeholder="USERNAME" required>
                <label for="username">USERNAME</label>
                <span class="position-absolute end-0 top-50 translate-middle-y input-group-text-custom me-2">
                  <i class="fa-solid fa-user"></i>
                </span>
              </div>
            </div>

            <div class="input-group mb-4">
              <div class="form-floating form-floating-custom w-100 position-relative">
                <input type="password" name="password" class="form-control form-control-custom" id="password" placeholder="PASSWORD" required>
                <label for="password">PASSWORD</label>
                <span class="position-absolute end-0 top-50 translate-middle-y input-group-text-custom me-2">
                  <i class="fa-solid fa-lock"></i>
                </span>
              </div>
            </div>

            <div class="clearfix">
              <button type="submit" class="btn btn-sign-in">SIGN IN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>