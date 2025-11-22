<?php
include "konekDB.php"; // Koneksi ke PostgreSQL

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil data dari form
    $fullname  = $_POST['fullname'];
    $phone     = $_POST['phone'];
    $email     = $_POST['email'];
    $detail    = $_POST['detail'];
    $layanan   = $_POST['layanan'];  
    $tempat    = $_POST['tempat'];
    $tanggal   = $_POST['tanggal'];

    // CARI ID dari jenis_layanan 
    $queryJenis = "SELECT id FROM jenis_layanan WHERE nama_layanan = $1";
    $resultJenis = pg_query_params($conn, $queryJenis, array($layanan));

    if ($row = pg_fetch_assoc($resultJenis)) {
        $id_layanan = $row['id'];
    } else {
        die("Jenis layanan tidak ditemukan!");
    }

    // UPLOAD FILE
    $fileName = null;

    if (!empty($_FILES["surat"]["name"])) {
        $folder = "uploads/";
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES["surat"]["name"]);
        $targetFile = $folder . $fileName;

        move_uploaded_file($_FILES["surat"]["tmp_name"], $targetFile);
    }

    // INSERT KE DATABASE 
    $queryInsert = "
        INSERT INTO layanan (
            full_name, phone_number, email, detail_kegiatan, 
            jenis_layanan, tempat_pelaksanaan, tanggal, file_surat
        ) 
        VALUES ($1,$2,$3,$4,$5,$6,$7,$8)
    ";

    $resultInsert = pg_query_params(
        $conn,
        $queryInsert,
        array($fullname, $phone, $email, $detail, $id_layanan, $tempat, $tanggal, $fileName)
    );

    if ($resultInsert) {
        echo "
            <script>
                alert('Data pelayanan berhasil dikirim!');
                window.location = 'landing.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menyimpan data!');
                window.history.back();
            </script>
        ";
    }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Pelayanan - Laboratorium Software Engineering</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="formPerLay.css">
  
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

  <!-- Content -->
  <main class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card-form p-4 shadow-lg rounded-3">

                <h4 class="section-title text-center">FORM PELAYANAN</h4>
                <h5 class="text-center mb-4 fw-bold">Laboratorium Software Engineering</h5>

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name :</label>
                            <input type="text" class="form-control" name="fullname" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number :</label>
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
                                <option value="" selected disabled>Pilih Layanan</option>
                                <option>Pelatihan & Workshop</option>
                                <option>Pendampingan Tugas Akhir</option>
                                <option>Pengujian Perangkat Lunak</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tempat Pelaksanaan :</label>
                            <input type="text" class="form-control" name="tempat" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal :</label>
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Upload Surat Layanan:</label>
                            <input type="file" class="form-control" name="surat">
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="landing.php" class="btn btn-outline-primary px-4 py-2">BACK</a>
                            <button type="submit" class="btn btn-custom btn-primary px-4">SUBMIT</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>