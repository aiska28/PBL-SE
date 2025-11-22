<?php
include 'konekDB.php';

if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}


/*  DELETE DATA (Jika tombol hapus ditekan) */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryDelete = "DELETE FROM layanan WHERE id_lay = $1";
    $resultDelete = pg_query_params($conn, $queryDelete, [$id]);

    if ($resultDelete) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='adminLayanan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!');</script>";
    }
}


/* AMBIL TOTAL PERMOHONAN */
$sqlTotal = "SELECT COUNT(*) AS total FROM layanan";
$resTotal = pg_query($conn, $sqlTotal);
$total = pg_fetch_assoc($resTotal)['total'];


/* AMBIL SEMUA DATA LAYANAN */
$sql = "
    SELECT 
        l.id_lay AS id,
        l.full_name AS fullname,
        l.phone_number AS phone,
        l.email,
        l.tempat_pelaksanaan AS tempat,
        l.tanggal,
        l.file_surat AS surat,
        jl.nama_layanan AS jenis_layanan
    FROM layanan l
    LEFT JOIN jenis_layanan jl ON l.jenis_layanan = jl.id
    ORDER BY l.created_at DESC
";
$result = pg_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DATA LAYANAN</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="permohonan.css">

</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color:#012970;">
  <div class="container-fluid px-5">

    <!-- Logo / Title -->
    <a class="navbar-brand text-white fw-bold d-flex align-items-center">
      <i class="bi bi-people-fill me-2"></i> ADMIN PANEL
    </a>

    <!-- Tombol Kembali -->
    <a href="landingAdmin.php" class="btn btn-warning fw-bold shadow-sm">
      <i class="bi bi-arrow-left-circle me-1"></i> Kembali
    </a>

  </div>
</nav>

<div class="container mt-4">

<div class="text-center">
  <h2 class="fw-bold">Data Permohonan Layanan</h2>
  <h4>Laboratorium Software Engineering</h4>
</div>

<div class="row mt-4">

  <div class="col-md-2">
    <div class="card side-card shadow-sm border-0">
      <div class="card-body text-center">
        <h4 class="fw-bold"><?= $total ?></h4>
        <p>Total Permohonan</p>
      </div>
    </div>
  </div>

  <div class="col-md-10">

    <div class="input-group mb-3">
      <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
      <input type="text" id="searchInput" class="form-control" placeholder="Cari nama...">
    </div>

    <div class="row" id="dataList">

    <?php while($row = pg_fetch_assoc($result)): ?>
      <div class="col-md-4 mb-4 layanan-card-item">
        <div class="layanan-card">

          <h6 class="fw-bold"><?= htmlspecialchars($row['fullname']) ?></h6>
          <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
          <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
          <p><strong>Layanan:</strong> <?= htmlspecialchars($row['jenis_layanan']) ?></p>
          <p><strong>Tempat:</strong> <?= htmlspecialchars($row['tempat']) ?></p>
          <p><strong>Tanggal:</strong> <?= htmlspecialchars($row['tanggal']) ?></p>

            <a href="<?= $row['surat'] ?>" 
            target="_blank" 
            class="btn btn-surat btn-sm mt-2">
            SURAT
            </a>

            <hr class="mt-3 mb-2">

            <div class="text-end">
                <a href="adminLayanan.php?delete=<?= $row['id'] ?>" 
                onclick="return confirm('Hapus permohonan layanan ini?')"
                class="btn btn-hapus btn-sm">
                Hapus
                </a>
            </div>

      </div>
    <?php endwhile; ?>

    </div>
  </div>
</div>
</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let items = document.querySelectorAll("#dataList .layanan-card-item");

    items.forEach(item => {
        let name = item.querySelector(".fw-bold").textContent.toLowerCase();
        item.style.display = name.includes(filter) ? "" : "none";
    });
});
</script>

</body>
</html>