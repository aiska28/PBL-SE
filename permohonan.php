<?php
include 'konekDB.php';

if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}

/* SUBMIT APPROVE */
if (isset($_POST['approve'])) {
    $id = $_POST['approve'];
    $queryApprove = "UPDATE layanan SET status='approved' WHERE id_lay=$1";
    pg_query_params($conn, $queryApprove, [$id]);
    echo "<script>
        alert('Data berhasil di-approve!');
        window.location.href = 'permohonan.php';
    </script>";
    exit;
}

/* DELETE DATA */
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $queryDelete = "DELETE FROM layanan WHERE id_lay=$1";
    pg_query_params($conn, $queryDelete, [$id]);
    echo "<script>
        alert('Data berhasil dihapus!');
        window.location.href = 'permohonan.php';
    </script>";
    exit;
}

/* HITUNG TOTAL & APPROVED */
$total = pg_fetch_assoc(pg_query($conn,"SELECT COUNT(*) AS total FROM layanan"))['total'];
$approved = pg_fetch_assoc(pg_query($conn,"SELECT COUNT(*) AS approve FROM layanan WHERE status='approved'"))['approve'];

/* AMBIL DATA LAYANAN */
$result = pg_query($conn, "
    SELECT 
        l.id_lay AS id,
        l.full_name AS fullname,
        l.phone_number AS phone,
        l.email,
        l.tempat_pelaksanaan AS tempat,
        l.tanggal,
        l.file_surat AS surat,
        l.status,
        jl.nama_layanan AS jenis_layanan
    FROM layanan l
    LEFT JOIN jenis_layanan jl ON l.jenis_layanan = jl.id
    ORDER BY l.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Permohonan Layanan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- JTABLE -->
<link href="https://cdn.jsdelivr.net/npm/jtable@2.6.0/lib/themes/metro/blue/jtable.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jtable@2.6.0/lib/jquery.jtable.min.js"></script>

<link rel="stylesheet" href="permohonan.css">
<style>
.stats-card {
    border-radius: 15px;
    padding: 25px;
    color: white;
    font-weight: bold;
    text-align: center;
}
.total-card { background-color: #012970; }
.approved-card { background-color: #28a745; }
.stats-number { font-size: 40px; font-weight: bold; }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color:#012970;">
  <div class="container-fluid px-5">
    <a class="navbar-brand text-white fw-bold"><i class="bi bi-people-fill me-2"></i>PERMOHONAN LAYANAN LABORATORIUM SOFTWARE ENGINEERING</a>
    <a href="landingAdmin.php" class="btn btn-warning fw-bold shadow-sm">
      <i class="bi bi-arrow-left-circle me-1"></i> Kembali
    </a>
  </div>
</nav>

<div class="container mt-4">

<div class="text-center">
  <h1 class="fw-bold">Data Permohonan Layanan</h1>
  <h4>Laboratorium Software Engineering</h4>
</div>

<!-- STATISTIK -->
<div class="row justify-content-center mt-4">
  <div class="col-md-3">
    <div class="stats-card total-card shadow">
      <div class="stats-number"><?= $total ?></div>
      <div>Total Permohonan</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stats-card approved-card shadow">
      <div class="stats-number"><?= $approved ?></div>
      <div>Approved</div>
    </div>
  </div>
</div>

<!-- SEARCH -->
<div class="row mt-4 mb-3">
  <div class="col-12 d-flex justify-content-center">
    <input 
      type="text" 
      id="searchInput" 
      class="form-control"
      placeholder="Cari"
      style="max-width: 550px; border-radius: 10px;"
    >
  </div>
</div>

<!-- JTABLE WRAPPER -->
<div id="PermohonanTable">
<div class="table-responsive shadow-sm bg-white p-3 rounded">
  <table class="table table-bordered table-striped align-middle text-center">
    <thead class="table-primary">
      <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Layanan</th>
        <th>Tempat</th>
        <th>Tanggal</th>
        <th>Surat</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <?php $no=1; pg_result_seek($result,0); while($row = pg_fetch_assoc($result)): ?>
      <tr class="data-row">
        <td><?= $no++ ?></td>
        <td class="nama-cell fw-bold"><?= htmlspecialchars($row['fullname']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['jenis_layanan']) ?></td>
        <td><?= htmlspecialchars($row['tempat']) ?></td>
        <td><?= htmlspecialchars($row['tanggal']) ?></td>
        <td>
          <?php if(!empty($row['surat']) && file_exists('uploads/' . $row['surat'])): ?>
            <a href="uploads/<?= $row['surat'] ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm">Lihat Surat</a>
          <?php else: ?>
            <span class="text-danger">Belum ada</span>
          <?php endif; ?>
        </td>
        <td>
          <?php if($row['status']=='approved'): ?>
            <span class="badge bg-success">Approved</span>
          <?php else: ?>
            <span class="badge bg-secondary">Pending</span>
          <?php endif; ?>
        </td>
        <td>
          <div class="d-flex gap-2 justify-content-center">
            <?php if($row['status']!='approved'): ?>
            <form method="POST" onsubmit="return confirm('Approve permohonan ini?')">
              <input type="hidden" name="approve" value="<?= $row['id'] ?>">
              <button class="btn btn-success btn-sm">Approve</button>
            </form>
            <?php endif; ?>
            <form method="POST" onsubmit="return confirm('Hapus permohonan ini?')">
              <input type="hidden" name="delete" value="<?= $row['id'] ?>">
              <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</div>

</div>

<script>
// Search table
document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableBody .data-row");

    rows.forEach(row => {
        let nama = row.querySelector(".nama-cell").textContent.toLowerCase();
        let email = row.children[2].textContent.toLowerCase();
        let phone = row.children[3].textContent.toLowerCase();

        row.style.display = (nama.includes(filter) || email.includes(filter) || phone.includes(filter)) ? "" : "none";
    });
});
</script>

<!-- JTABLE SCRIPT -->
<script>
$(function () {
    $("#PermohonanTable").jtable({
        paging: true,
        pageSize: 5,
        sorting: true,
        columnSelectable: false,
        animationsEnabled: true,
        actions: {
            listAction: function () {
                return {
                    Result: "OK",
                    Records: getLocalData(),
                    TotalRecordCount: $("#tableBody .data-row").length
                };
            }
        },
        fields: {
            no: { title: "No", width: "5%" },
            fullname: { title: "Nama Lengkap", width: "15%" },
            email: { title: "Email", width: "15%" },
            phone: { title: "No HP", width: "12%" },
            jenis_layanan: { title: "Layanan", width: "12%" },
            tempat: { title: "Tempat", width: "10%" },
            tanggal: { title: "Tanggal", width: "10%" },
            surat: { title: "Surat", width: "10%" },
            status: { title: "Status", width: "8%" },
            aksi: { title: "Aksi", width: "15%" }
        }
    });

    function getLocalData() {
        let data = [];
        $("#tableBody .data-row").each(function () {
            let tds = $(this).find("td");
            data.push({
                no: tds.eq(0).html(),
                fullname: tds.eq(1).html(),
                email: tds.eq(2).html(),
                phone: tds.eq(3).html(),
                jenis_layanan: tds.eq(4).html(),
                tempat: tds.eq(5).html(),
                tanggal: tds.eq(6).html(),
                surat: tds.eq(7).html(),
                status: tds.eq(8).html(),
                aksi: tds.eq(9).html()
            });
        });
        return data;
    }

    $("#PermohonanTable").jtable("load");
});
</script>

</body>
</html>
