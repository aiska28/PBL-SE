<?php
include 'konekDB.php'; 

if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}

if (isset($_POST['submit_recruitment'])) {

    $full_name = $_POST['full_name'];
    $email_kampus = $_POST['email_kampus'];
    $phone_number = $_POST['phone_number'];

    // Folder upload
    $uploadCvDir = "uploads_cv/";
    $uploadKtmDir = "uploads_ktm/";

    if (!is_dir($uploadCvDir)) mkdir($uploadCvDir, 0777, true);
    if (!is_dir($uploadKtmDir)) mkdir($uploadKtmDir, 0777, true);

    // Upload CV
    $cvName = null;
    if (!empty($_FILES['file_cv']['name'])) {
        $extCV = strtolower(pathinfo($_FILES['file_cv']['name'], PATHINFO_EXTENSION));
        $cvName = time() . "_cv." . $extCV;
        move_uploaded_file($_FILES['file_cv']['tmp_name'], $uploadCvDir . $cvName);
    }

    // Upload KTM
    $ktmName = null;
    if (!empty($_FILES['file_ktm']['name'])) {
        $extKTM = strtolower(pathinfo($_FILES['file_ktm']['name'], PATHINFO_EXTENSION));
        $ktmName = time() . "_ktm." . $extKTM;
        move_uploaded_file($_FILES['file_ktm']['tmp_name'], $uploadKtmDir . $ktmName);
    }

    $query = "INSERT INTO open_recruitment 
        (full_name, email_kampus, phone_number, file_cv, file_ktm, status) 
        VALUES ($1,$2,$3,$4,$5,'pending')";
    pg_query_params($conn, $query, [$full_name, $email_kampus, $phone_number, $cvName, $ktmName]);

    echo "<script>
        alert('Pendaftaran recruitment berhasil!');
        window.location.href = 'recruitment.php';
    </script>";
    exit;
}

if (isset($_POST['approve'])) {
    $id = $_POST['approve'];
    $queryApprove = "UPDATE open_recruitment SET status='approved' WHERE id_or=$1";
    pg_query_params($conn, $queryApprove, [$id]);
    echo "<script>
        alert('Recruitment berhasil di-approve!');
        window.location.href = 'reqkruitmen.php';
    </script>";
    exit;
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $queryDelete = "DELETE FROM open_recruitment WHERE id_or=$1";
    pg_query_params($conn, $queryDelete, [$id]);
    echo "<script>
        alert('Data berhasil dihapus!');
        window.location.href = 'reqkruitmen.php';
    </script>";
    exit;
}

$total = pg_fetch_assoc(pg_query($conn,"SELECT COUNT(*) AS total FROM open_recruitment"))['total'];
$approved = pg_fetch_assoc(pg_query($conn,"SELECT COUNT(*) AS approve FROM open_recruitment WHERE status='approved'"))['approve'];

$result = pg_query($conn, "SELECT * FROM open_recruitment ORDER BY created_at DESC");

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Recruitment</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- JTABLE START -->
<link href="https://cdn.jsdelivr.net/npm/jtable@2.6.0/lib/themes/metro/blue/jtable.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jtable@2.6.0/lib/jquery.jtable.min.js"></script>
<!-- JTABLE END -->
<link rel="stylesheet" href="reqkruitmen.css">
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color:#012970;">
  <div class="container-fluid px-5">
    <a class="navbar-brand text-white fw-bold"><i class="bi bi-person-fill me-2"></i> RECRUITMENT ANGGOTA LABORATORIUM SOFTWARE ENGINEERING</a>
    <a href="landingAdmin.php" class="btn btn-warning fw-bold shadow-sm">
      <i class="bi bi-arrow-left-circle me-1"></i> Kembali
    </a>
  </div>
</nav>

<div class="container mt-4">

<div class="text-center">
  <h1 class="fw-bold">Data Recruitment Anggota Lab</h1>
  <h4>Laboratorium Software Engineering</h4>
</div>

<!-- STATISTIK -->
<div class="row justify-content-center mt-4">
  <div class="col-md-3">
    <div class="stats-card total-card shadow">
      <div class="stats-number"><?= $total ?></div>
      <div>Total Pendaftar</div>
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

<!-- JTABLE WRAPPER START -->
<div id="RecruitmentTable">

<div class="table-responsive shadow-sm bg-white p-3 rounded">
      <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>NIM</th>
            <th>Email Kampus</th>
            <th>No HP</th>
            <th>CV</th>
            <th>KTM</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody id="tableBody">
          <?php 
          $no = 1;
          pg_result_seek($result, 0); 
          while($row = pg_fetch_assoc($result)): ?>
          <tr class="data-row">
            <td><?= $no++ ?></td>

            <td class="nama-cell fw-bold"><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['email_kampus']) ?></td>
            <td><?= htmlspecialchars($row['phone_number']) ?></td>

            <td>
            <?php if(!empty($row['file_cv']) && file_exists('uploads_cv/' . $row['file_cv'])): ?>
              <a href="uploads_cv/<?= $row['file_cv'] ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm">Lihat CV</a>
            <?php else: ?>
              <span class="text-danger">Tidak ada</span>
            <?php endif; ?>
            </td>

            <td>
              <?php if(!empty($row['file_ktm']) && file_exists('uploads_ktm/' . $row['file_ktm'])): ?>
                <a href="uploads_ktm/<?= $row['file_ktm'] ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm">Lihat KTM</a>
              <?php else: ?>
                <span class="text-danger">Tidak ada</span>
              <?php endif; ?>
            </td>

            <td>
              <?php if ($row['status']=='approved'): ?>
                <span class="badge bg-success">Approved</span>
              <?php else: ?>
                <span class="badge bg-secondary">Pending</span>
              <?php endif; ?>
            </td>

            <td>
              <div class="d-flex gap-2 justify-content-center">

                <?php if($row['status'] != 'approved'): ?>
                <form method="POST" action="" onsubmit="return confirm('Approve pendaftar ini?')">
                  <input type="hidden" name="approve" value="<?= $row['id_or'] ?>">
                  <button class="btn btn-success btn-sm">Approve</button>
                </form>
                <?php endif; ?>

                <form method="POST" action="" onsubmit="return confirm('Hapus data recruitment ini?')">
                  <input type="hidden" name="delete" value="<?= $row['id_or'] ?>">
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
<!-- JTABLE WRAPPER END -->

</div>
</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableBody .data-row");

    rows.forEach(row => {
        let nama = row.querySelector(".nama-cell").textContent.toLowerCase();
        let email = row.children[2].textContent.toLowerCase();
        let hp = row.children[3].textContent.toLowerCase();

        if (nama.includes(filter) || email.includes(filter) || hp.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>

<!-- JTABLE SCRIPT -->
<script>
$(function () {

    $("#RecruitmentTable").jtable({
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
            full_name: { title: "Nama Lengkap", width: "18%" },
            email_kampus: { title: "Email Kampus", width: "18%" },
            phone_number: { title: "No HP", width: "12%" },
            file_cv: { title: "CV", width: "10%" },
            file_ktm: { title: "KTM", width: "10%" },
            status: { title: "Status", width: "10%" },
            aksi: { title: "Aksi", width: "10%" }
        }
    });

    function getLocalData() {
        let data = [];

        $("#tableBody .data-row").each(function () {
            let tds = $(this).find("td");

            data.push({
                no: tds.eq(0).html(),
                full_name: tds.eq(1).html(),
                email_kampus: tds.eq(2).html(),
                phone_number: tds.eq(3).html(),
                file_cv: tds.eq(4).html(),
                file_ktm: tds.eq(5).html(),
                status: tds.eq(6).html(),
                aksi: tds.eq(7).html()
            });
        });

        return data;
    }

    $("#RecruitmentTable").jtable("load");
});
</script>

</body>
</html>
