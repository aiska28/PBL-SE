<?php
include 'konekDB.php';

/* EDIT DATA (AMBIL DATA BERDASARKAN ID) */
$editData = false;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $queryEdit = "SELECT * FROM open_recruitment WHERE id_or = $1";
    $resEdit = pg_query_params($conn, $queryEdit, [$id]);
    $editData = pg_fetch_assoc($resEdit);
}


/* UPDATE DATA REKRUITMEN */
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    /* File CV */
    $newCV = $editData['file_cv'];
    if (!empty($_FILES['cv']['name'])) {
        $cvName = time() . "_CV_" . $_FILES['cv']['name'];
        move_uploaded_file($_FILES['cv']['tmp_name'], "uploads/" . $cvName);
        $newCV = $cvName;
    }

    /* File KTM */
    $newKTM = $editData['file_ktm'];
    if (!empty($_FILES['ktm']['name'])) {
        $ktmName = time() . "_KTM_" . $_FILES['ktm']['name'];
        move_uploaded_file($_FILES['ktm']['tmp_name'], "uploads/" . $ktmName);
        $newKTM = $ktmName;
    }

    $queryUpdate = "
        UPDATE open_recruitment 
        SET full_name = $1, email_kampus = $2, phone_number = $3, 
            file_cv = $4, file_ktm = $5 
        WHERE id_or = $6
    ";

    $update = pg_query_params($conn, $queryUpdate, [
        $fullname, $email, $phone, $newCV, $newKTM, $id
    ]);

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='reqkruitmen.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}


/* DELETE DATA */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryDel = "DELETE FROM open_recruitment WHERE id_or = $1";
    $del = pg_query_params($conn, $queryDel, [$id]);

    if ($del) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='reqkruitmen.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!');</script>";
    }
}


/* HITUNG TOTAL PENDAFTAR */
$totalQuery = "SELECT COUNT(*) AS total FROM open_recruitment";
$totalRes = pg_query($conn, $totalQuery);
$total = pg_fetch_assoc($totalRes)['total'];


/* AMBIL SEMUA DATA PENDAFTAR */
$sql = "
    SELECT 
        id_or AS id,
        full_name AS fullname,
        email_kampus AS email,
        phone_number AS phone,
        file_cv AS cv_path,
        file_ktm AS ktm_path
    FROM open_recruitment
    ORDER BY created_at DESC
";
$result = pg_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DAFTAR REKRUITMEN</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body { background-color: #f7f7f7; }
    .side-card { width: 160px; background-color: #2E1973; color: white; border-radius: 12px; }
    .recruit-card img { height: 180px; object-fit: cover; border-radius: 12px 12px 0 0; }
</style>
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

<?php if ($editData): ?>
<div class="card p-4 shadow">
  <h4 class="fw-bold mb-3">Edit Data Pendaftar</h4>

  <form method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= htmlspecialchars($editData['id'] ?? '') ?>">

    <label class="form-label">Fullname</label>
    <input type="text" name="fullname" class="form-control mb-2" value="<?= htmlspecialchars($editData['fullname'] ?? '') ?>" required>

    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control mb-2" value="<?= htmlspecialchars($editData['email'] ?? '') ?>" required>

    <label class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control mb-2" value="<?= htmlspecialchars($editData['phone'] ?? '') ?>" required>

    <label class="form-label">CV (kosongkan jika tidak ganti)</label>
    <?php if (!empty($editData['file_cv'])): ?>
      <div class="mb-2">
        <a href="uploads/<?= htmlspecialchars($editData['file_cv']) ?>" class="btn btn-outline-success btn-sm" download>
          <i class="bi bi-download"></i> Download CV
        </a>
      </div>
    <?php endif; ?>
    <input type="file" name="cv" class="form-control mb-2">

    <label class="form-label">KTM (kosongkan jika tidak ganti)</label>
    <?php if (!empty($editData['file_ktm'])): ?>
      <div class="mb-2">
        <a href="uploads/<?= htmlspecialchars($editData['file_ktm']) ?>" class="btn btn-outline-success btn-sm" download>
          <i class="bi bi-download"></i> Download KTM
        </a>
      </div>
    <?php endif; ?>
    <input type="file" name="ktm" class="form-control mb-3">

    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
    <a href="reqkruitmen.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
<?php endif; ?>

<div class="text-center">
  <h2 class="fw-bold">Open Recruitment</h2>
  <h4>Laboratorium Software Engineering</h4>
</div>

<div class="row mt-4">

  <div class="col-md-2">
    <div class="card side-card shadow-sm border-0">
      <div class="card-body text-center">
        <h4 class="fw-bold"><?= $total ?></h4>
        <p>Total Pendaftar</p>
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
      <div class="col-md-4 mb-4">
        <div class="card recruit-card shadow-sm border-0">

          <div class="card recruit-card shadow-sm border-0 p-3">

          <h6 class="fw-bold"><?= htmlspecialchars($row['fullname']) ?></h6>
          <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
          <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>

          <div class="d-flex justify-content-between mt-2">
            <a href="<?= $row['cv_path'] ?>" target="_blank" class="btn btn-outline-primary btn-sm">CV</a>
            <a href="<?= $row['ktm_path'] ?>" target="_blank" class="btn btn-outline-secondary btn-sm">KTM</a>
          </div>

          <hr>

          <div class="d-flex justify-content-between">
            <a href="reqkruitmen.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm w-50 me-1">Edit</a>
            <a href="reqkruitmen.php?delete=<?= $row['id'] ?>" 
              onclick="return confirm('Hapus data ini?')"
              class="btn btn-danger btn-sm w-50 ms-1">Hapus</a>
          </div>

        </div>

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
    let cards = document.querySelectorAll("#dataList .card");

    cards.forEach(card => {
        let name = card.querySelector(".fw-bold").textContent.toLowerCase();
        card.style.display = name.includes(filter) ? "" : "none";
    });
});
</script>

</body>
</html>