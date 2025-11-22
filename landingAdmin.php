<?php 
include 'konekDB.php'; 

// ------------------ HANDLE HAPUS PUBLIKASI ------------------
if (isset($_GET['hapus_publikasi'])) {
    $id = $_GET['hapus_publikasi'];

    $query = "DELETE FROM publikasi WHERE id_publikasi = $1";
    pg_query_params($conn, $query, array($id));

    header("Location: LandingAdmin.php?msg=deleted");
    exit;
}

// ------------------ HANDLE HAPUS DOSEN ------------------
if (isset($_GET['hapus_dosen'])) {
    $id = $_GET['hapus_dosen'];

    $query = "DELETE FROM dosen WHERE id_dosen = $1";
    pg_query_params($conn, $query, array($id));

    header("Location: LandingAdmin.php?msg=deleted");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="LandingAdmin.css">
</head>
<body>

  <!-- HEADER -->
  <div class="container-fluid bg-light py-3 shadow-sm">
    <div class="d-flex justify-content-between align-items-center px-5 flex-wrap text-center text-md-start">
      <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2 mb-md-0">
        <i class="bi bi-person-circle fs-3 me-2 text-primary"></i>
        <h4 class="fw-bold mb-0 text-uppercase text-primary">Welcome Admin</h4>
      </div>

      <div class="d-flex flex-wrap justify-content-center gap-2">
        <a href="landing.php" class="btn btn-outline-primary fw-semibold">
          <i class="bi bi-house-door-fill me-1"></i> HOME
        </a>
        <a href="reqkruitmen.php" target="_blank" class="btn btn-outline-success fw-semibold">
          <i class="bi bi-globe me-1"></i> Daftar Rekruitmen
        </a>
        <a href="permohonan.php" class="btn btn-outline-secondary fw-semibold">
          <i class="bi bi-list-ul me-1"></i> Daftar Permohonan
        </a>
      </div>
    </div>
  </div>

  <!-- TAB SECTION -->
  <div class="container my-4">
    <div class="card border-primary shadow-sm">
      <div class="card-body">

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs mb-3" id="adminTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active fw-semibold" id="publikasi-tab" data-bs-toggle="tab" data-bs-target="#publikasi" type="button" role="tab">📘 Publikasi</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="anggota-tab" data-bs-toggle="tab" data-bs-target="#anggota" type="button" role="tab">📘 Anggota Lab</button>
          </li>
        </ul>

        <div class="tab-content" id="adminTabContent">

          <!-- TAB PUBLIKASI -->
          <div class="tab-pane fade show active" id="publikasi" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
              <h5 class="text-primary fw-bold mb-0">Daftar Publikasi</h5>
              <a href="TambahPublikasi.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Publikasi</a>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center">
                <thead class="table-primary">
                  <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>Jenis Publikasi</th>
                    <th>Link</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = pg_query($conn, "
                    SELECT p.id_publikasi, d.nama AS nama_dosen, p.jenis_publikasi, p.link_publikasi
                    FROM publikasi p
                    JOIN dosen d ON p.id_dosen = d.id_dosen
                    ORDER BY p.id_publikasi ASC
                  ");

                  $no = 1;
                  while ($row = pg_fetch_assoc($query)) {
                    echo "<tr>
                          <td>{$no}</td>
                          <td>{$row['nama_dosen']}</td>
                          <td>{$row['jenis_publikasi']}</td>
                          <td><a href='{$row['link_publikasi']}' target='_blank' class='text-decoration-none text-primary'>Lihat Publikasi</a></td>
                          <td>
                            <a href='LandingAdmin.php?hapus_publikasi={$row['id_publikasi']}'
                              class='btn btn-sm btn-outline-danger'
                              onclick='return confirm(\"Hapus publikasi ini?\")'> Hapus
                            </a>
                          </td>
                        </tr>";
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- TAB ANGGOTA LAB -->
          <div class="tab-pane fade" id="anggota" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
              <h5 class="text-primary fw-bold mb-0">Daftar Anggota Lab</h5>
              <a href="TambahTim.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Anggota</a>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center">
                <thead class="table-primary">
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>NIDN</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Alamat Kantor</th>
                    <th>Mata Kuliah Ganjil</th>
                    <th>Mata Kuliah Genap</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = pg_query($conn, "
                    SELECT d.*, 
                           STRING_AGG(CASE WHEN mk.semester='Ganjil' THEN mk.nama_mk END, ', ') AS mk_ganjil,
                           STRING_AGG(CASE WHEN mk.semester='Genap' THEN mk.nama_mk END, ', ') AS mk_genap
                    FROM dosen d
                    LEFT JOIN mata_kuliah mk ON d.id_dosen = mk.id_dosen
                    GROUP BY d.id_dosen
                    ORDER BY d.nama ASC
                  ");

                  while ($row = pg_fetch_assoc($query)) {
                      echo "<tr>
                              <td>{$row['nip']}</td>
                              <td>{$row['nama']}</td>
                              <td>{$row['program_studi']}</td>
                              <td>{$row['nidn']}</td>
                              <td>{$row['jabatan']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['alamat_kantor']}</td>
                              <td>".($row['mk_ganjil'] ? $row['mk_ganjil'] : '-') ."</td>
                              <td>".($row['mk_genap'] ? $row['mk_genap'] : '-') ."</td>
                              <td>
                                <a href='LandingAdmin.php?hapus_dosen={$row['id_dosen']}'
                                  class='btn btn-sm btn-outline-danger'
                                  onclick='return confirm(\"Hapus data dosen ini?\")'> Hapus </a>
                              </td>
                            </tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>