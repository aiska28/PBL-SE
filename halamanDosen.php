<?php 
include 'konekDB.php'; 
?>

<!DOCTYPE html>
<html lang="id"> 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Dosen</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/halamanDosen.css">
</head>

<body>

<div class="container-fluid header-box">
  <div class="d-flex align-items-center">
    <i class="bi bi-person-circle fs-3 me-2 text-primary"></i>
    <h4 class="fw-bold mb-0 text-uppercase text-primary">Welcome Dosen</h4>
  </div>

  <div class="nav-right">
    <a href="landing.php" class="btn btn-home fw-semibold">
      <i class="bi bi-house-door-fill me-1"></i> HOME
    </a>
    <a href="login.php" class="btn btn-outline-danger fw-semibold">
      <i class="bi bi-box-arrow-right me-1"></i> Logout
    </a>
  </div>
</div>

  <!-- BODY MENU -->
<div class="center-panel">

  <h2 class="text-center fw-bold mb-4" style="color:#fd7e14;">Menu Dosen</h2>

  <div class="row justify-content-center g-4">

    <!-- PERMOHONAN -->
    <div class="col-md-4">
    <a href="permohonan.php?from=dosen" class="text-decoration-none text-dark">
        <div class="menu-card text-center">
        <i class="bi bi-list-ul menu-icon text-primary"></i>
        <h5 class="fw-bold">Daftar Permohonan</h5>
        <p>Cek dan approve permohonan layanan laboratorium.</p>
        </div>
    </a>
    </div>

    <!-- REKRUITMEN -->
    <div class="col-md-4">
      <a href="reqkruitmen.php?from=dosen" class="text-decoration-none text-dark">
        <div class="menu-card text-center">
          <i class="bi bi-people-fill menu-icon text-success"></i>
          <h5 class="fw-bold">Daftar Rekruitmen</h5>
          <p>Lihat dan kelola data pendaftar rekruitmen lab.</p>
        </div>
      </a>
    </div>

  </div>
</div>


</body>
</html>
