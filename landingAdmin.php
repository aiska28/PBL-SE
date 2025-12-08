<?php 
include 'konekDB.php'; 

// ------------------ HANDLE HAPUS PUBLIKASI ------------------
if (isset($_GET['hapus_publikasi'])) {
    $id = $_GET['hapus_publikasi'];
    $query = "DELETE FROM publikasi WHERE id_publikasi = $1";
    pg_query_params($conn, $query, array($id));
    header("Location: landingAdmin.php?msg=deleted");
    exit;
}

// ------------------ HANDLE HAPUS DOSEN ------------------
if (isset($_GET['hapus_dosen'])) {
    $id = $_GET['hapus_dosen'];
    $query = "DELETE FROM dosen WHERE id_dosen = $1";
    pg_query_params($conn, $query, array($id));
    header("Location: landingAdmin.php?msg=deleted");
    exit;
}

// ------------------ HANDLE UPDATE PROFILE LAB ------------------
if (isset($_POST['update_profilelab'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params($conn,
        "UPDATE ProfileLab SET judul=$1, deskripsi=$2 WHERE id=$3",
        array($judul, $deskripsi, $id)
    );

    header("Location: landingAdmin.php?msg=profile_updated");
    exit;
}

// ------------------ HANDLE UPDATE VISI MISI ------------------
if (isset($_POST['update_visimisi'])) {

    $id = $_POST['id'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    pg_query_params($conn,
        "UPDATE visi_misi SET visi=$1, misi=$2 WHERE id=$3",
        array($visi, $misi, $id)
    );

    header("Location: landingAdmin.php?msg=vm_updated");
    exit;
}


// ------------------ HANDLE HAPUS RISET ------------------
if (isset($_GET['hapus_riset'])) {
    pg_query_params($conn,
        "DELETE FROM FokusRiset WHERE id=$1",
        array($_GET['hapus_riset'])
    );
    header("Location: landingAdmin.php?msg=riset_deleted");
    exit;
}

// ------------------ HANDLE HAPUS FASILITAS ------------------
if (isset($_GET['hapus_fasilitas'])) {
    pg_query_params($conn,
        "DELETE FROM FasilitasPeralatan WHERE id=$1",
        array($_GET['hapus_fasilitas'])
    );
    header("Location: landingAdmin.php?msg=fasilitas_deleted");
    exit;
}

// ------------------ HANDLE HAPUS KEGIATAN ------------------
if (isset($_GET['hapus_kegiatan'])) {
    pg_query_params($conn,
        "DELETE FROM KegiatanProyek WHERE id=$1",
        array($_GET['hapus_kegiatan'])
    );
    header("Location: landingAdmin.php?msg=kegiatan_deleted");
    exit;
}

// ------------------ HANDLE HAPUS KULIAH ------------------
if (isset($_GET['hapus_kuliah'])) {
    pg_query_params($conn,
        "DELETE FROM PerkuliahanTerkait WHERE id=$1",
        array($_GET['hapus_kuliah'])
    );
    header("Location: landingAdmin.php?msg=kuliah_deleted");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id"> 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="landingAdmin.css">

</head>
<body>

  <!-- HEADER -->
  <div class="container-fluid bg-light py-3 shadow-sm">
    <div class="d-flex justify-content-between align-items-center px-3 px-md-5 flex-wrap text-center text-md-start">
      <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2 mb-md-0 flex-wrap">
        <i class="bi bi-person-circle fs-3 me-2 text-primary"></i>
        <h4 class="fw-bold mb-0 text-uppercase text-primary">Welcome Admin</h4>
      </div>

      <div class="d-flex flex-wrap justify-content-center gap-2">
        <a href="landing.php" class="btn btn-outline-primary fw-semibold">
          <i class="bi bi-house-door-fill me-1"></i> HOME
        </a>
        <a href="reqkruitmen.php" class="btn btn-outline-success fw-semibold">
          <i class="bi bi-globe me-1"></i> Daftar Rekruitmen
        </a>
        <a href="permohonan.php" class="btn btn-outline-secondary fw-semibold">
          <i class="bi bi-list-ul me-1"></i> Daftar Permohonan
        </a>
        <a href="login.php" class="btn btn-outline-secondary fw-semibold">
          <i class="bi bi-list-ul me-1"></i> Logout
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
          <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tampilan-tab" data-bs-toggle="tab" data-bs-target="#tampilan" type="button" role="tab">📘 Tampilan Lab</button>
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
              <table class="table table-bordered align-middle text-center table-hover">
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
                      <td class='text-truncate'>{$row['nama_dosen']}</td>
                      <td class='text-truncate'>{$row['jenis_publikasi']}</td>
                      <td><a href='{$row['link_publikasi']}' target='_blank' class='text-decoration-none text-primary small'>Lihat</a></td>
                      <td>
                          <a href='editAdmin.php?id_publikasi=" . $row['id_publikasi'] . "' 
                            class='btn btn-sm btn-outline-primary me-1 mb-1 mb-md-0'
                            onclick='return confirm(\"Apakah ingin mengedit publikasi ini?\")'>
                            Edit
                          </a>

                          <a href='landingAdmin.php?hapus_publikasi=" . $row['id_publikasi'] . "'
                            class='btn btn-sm btn-outline-danger mb-1 mb-md-0'
                            onclick='return confirm(\"Hapus publikasi ini?\")'>
                            Hapus
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
              <table class="table table-bordered align-middle text-center table-hover">
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
                  SELECT 
                    d.id_dosen,
                    d.nip,
                    d.nama,
                    d.program_studi,
                    d.nidn,
                    d.jabatan,
                    d.email,
                    d.alamat_kantor,
                    STRING_AGG(CASE WHEN mk.semester='Ganjil' THEN mk.nama_mk END, ', ') AS mk_ganjil,
                    STRING_AGG(CASE WHEN mk.semester='Genap' THEN mk.nama_mk END, ', ') AS mk_genap
                  FROM dosen d
                  LEFT JOIN mata_kuliah mk ON d.id_dosen = mk.id_dosen
                  GROUP BY 
                    d.id_dosen, d.nip, d.nama, d.program_studi, d.nidn, d.jabatan, 
                    d.email, d.alamat_kantor
                  ORDER BY d.nama ASC
                ");

                  while ($row = pg_fetch_assoc($query)):
                  ?>
                  <tr>
                    <td class="text-truncate"><?= $row['nip'] ?></td>
                    <td class="text-truncate"><?= $row['nama'] ?></td>
                    <td class="text-truncate"><?= $row['program_studi'] ?></td>
                    <td class="text-truncate"><?= $row['nidn'] ?></td>
                    <td class="text-truncate"><?= $row['jabatan'] ?></td>
                    <td class="text-truncate"><?= $row['email'] ?></td>
                    <td class="text-truncate"><?= $row['alamat_kantor'] ?></td>
                    <td class="text-truncate"><?= $row['mk_ganjil'] ? $row['mk_ganjil'] : '-' ?></td>
                    <td class="text-truncate"><?= $row['mk_genap'] ? $row['mk_genap'] : '-' ?></td>
                    <td class="d-flex flex-wrap justify-content-center gap-1">
                      <a href="editAdmin.php?id_dosen=<?= $row['id_dosen'] ?>"
                        class="btn btn-sm btn-outline-primary"
                        onclick="return confirm('Apakah ingin mengedit data anggota ini?')">
                        Edit
                      </a>

                      <a href="landingAdmin.php?hapus_dosen=<?= $row['id_dosen'] ?>"
                        class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Hapus data dosen ini?')">
                        Hapus
                      </a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
          
          <!-- TAB TAMPILAN LAB -->
          <div class="tab-pane fade" id="tampilan" role="tabpanel">

          <!-- NAVIGASI TAB DALAM -->
          <ul class="nav nav-pills mb-3" id="innerTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profileLab">Profile Lab</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#visiMisi">Visi & Misi</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#riset">Fokus Riset</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#fasilitas">Fasilitas</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#kegiatan">Kegiatan</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#kuliah">Kuliah Terkait</button></li>
          </ul>

          <div class="tab-content">

          <!-- ---------------- PROFILE LAB ---------------- -->
          <div class="tab-pane fade show active" id="profileLab">
            <h5 class="text-primary fw-bold">Profile Laboratorium</h5>
            <?php $qProfile = pg_query($conn, "SELECT * FROM ProfileLab LIMIT 1"); $profile = pg_fetch_assoc($qProfile); ?>
            <form method="POST" action="landingAdmin.php">
              <input type="hidden" name="id" value="<?= $profile['id']; ?>">
              <input type="hidden" name="update_profilelab" value="1">
                <div class="mb-3">
                  <label class="form-label fw-semibold">Judul</label>
                  <input type="text" name="judul" class="form-control" value="<?= $profile['judul']; ?>">
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Deskripsi</label>
                  <textarea name="deskripsi" id="deskripsi" class="form-control summernote" rows="4"><?= $profile['deskripsi']; ?></textarea>
                </div>
              <button class="btn btn-primary">Simpan</button>
            </form>
          </div>

          <!-- ---------------- VISI MISI ---------------- -->
          <div class="tab-pane fade" id="visiMisi">
            <h5 class="text-primary fw-bold">Visi & Misi</h5>
            <?php $qVM = pg_query($conn, "SELECT * FROM visi_misi LIMIT 1"); $vm = pg_fetch_assoc($qVM); ?>
            <form method="POST" action="landingAdmin.php">
              <input type="hidden" name="id" value="<?= $vm['id']; ?>">
              <input type="hidden" name="update_visimisi" value="1">
                <div class="mb-3">
                  <label class="form-label fw-semibold">Visi</label>
                  <textarea name="visi" class="form-control summernote"><?= $vm['visi']; ?></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Misi</label>
                  <textarea name="misi" class="form-control summernote"><?= $vm['misi']; ?></textarea>
                </div>
              <button class="btn btn-primary">Simpan</button>
            </form>
          </div>

          <!-- ---------------- FOKUS RISET ---------------- -->
          <div class="tab-pane fade" id="riset">
          <div class="d-flex justify-content-between">
            <h5 class="text-primary fw-bold">Fokus Riset</h5>
            <a href="TambahRiset.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Riset</a>
          </div>

          <div class="table-responsive mt-3">
          <table class="table table-bordered mt-3 text-center">
            <thead class="table-primary">
              <tr>
                <th>No</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>
            </thead>
              <tbody>
                <?php
                $qR = pg_query($conn, "SELECT * FROM FokusRiset ORDER BY id ASC");
                $no = 1;
                while ($r = pg_fetch_assoc($qR)) {
                echo "
                  <tr>
                    <td>{$no}</td>
                      <td>{$r['deskripsi']}</td>
                        <td>
                          <a href='editRiset.php?id={$r['id']}' class='btn btn-sm btn-outline-primary'>Edit</a>
                          <a href='landingAdmin.php?hapus_riset={$r['id']}'
                            class='btn btn-sm btn-outline-danger'
                            onclick=\'return confirm('Hapus riset ini?')\">Hapus</a>
                        </td>
                      </tr>";
                    $no++;
                  }
                ?>
              </tbody>
            </table>
            </div>
          </div>

          <!-- ---------------- FASILITAS ---------------- -->
          <div class="tab-pane fade" id="fasilitas">
            <div class="d-flex justify-content-between">
              <h5 class="text-primary fw-bold">Fasilitas & Peralatan</h5>
              <a href="TambahFasilitas.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Fasilitas</a>
            </div>

            <div class="table-responsive mt-3">
            <table class="table table-bordered mt-3 text-center">
              <thead class="table-primary">
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $qF = pg_query($conn, "SELECT * FROM FasilitasPeralatan ORDER BY id ASC");
                  $no=1;
                  while ($f = pg_fetch_assoc($qF)) {
                    echo "
                      <tr>
                        <td>{$no}</td>
                        <td>{$f['judul']}</td>
                        <td>{$f['deskripsi']}</td>
                      <td>
                          <a href='editFasilitas.php?id={$f['id']}' class='btn btn-sm btn-outline-primary'>Edit</a>
                          <a href='landingAdmin.php?hapus_fasilitas={$f['id']}'
                            class='btn btn-sm btn-outline-danger'
                            onclick=\"return confirm('Hapus fasilitas ini?')\">Hapus</a>
                        </td>
                      </tr>";
                    $no++;
                  }
                ?>
              </tbody>
            </table>
            </div>
          </div>

          <!-- ---------------- KEGIATAN ---------------- -->
          <div class="tab-pane fade" id="kegiatan">
            <div class="d-flex justify-content-between">
              <h5 class="text-primary fw-bold">Kegiatan & Proyek</h5>
              <a href="TambahKegiatan.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Kegiatan</a>
            </div>

            <div class="table-responsive mt-3">
            <table class="table table-bordered mt-3 text-center">
              <thead class="table-primary">
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $qK = pg_query($conn, "SELECT * FROM KegiatanProyek ORDER BY id ASC");
                  $no=1;
                  while ($k = pg_fetch_assoc($qK)) {
                    echo "
                      <tr>
                        <td>{$no}</td>
                        <td>{$k['judul']}</td>
                        <td>{$k['deskripsi']}</td>
                        <td>
                          <a href='editKegiatan.php?id={$k['id']}' class='btn btn-sm btn-outline-primary'>Edit</a>
                          <a href='landingAdmin.php?hapus_kegiatan={$k['id']}'
                            class='btn btn-sm btn-outline-danger'
                            onclick=\"return confirm('Hapus kegiatan ini?')\">Hapus</a>
                        </td>
                      </tr>";
                    $no++;
                  }
                ?>
              </tbody>
            </table>
            </div>
          </div>

          <!-- ---------------- KULIAH ---------------- -->
          <div class="tab-pane fade" id="kuliah">
            <div class="d-flex justify-content-between">
              <h5 class="text-primary fw-bold">Perkuliahan Terkait</h5>
              <a href="TambahKuliah.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Kuliah</a>
            </div>

            <div class="table-responsive mt-3">
            <table class="table table-bordered mt-3 text-center">
              <thead class="table-primary">
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
               <?php
                  $qP = pg_query($conn, "SELECT * FROM PerkuliahanTerkait ORDER BY id ASC");
                  $no=1;
                  while ($p = pg_fetch_assoc($qP)) {
                    echo "
                      <tr>
                        <td>{$no}</td>
                        <td>{$p['judul']}</td>
                        <td>{$p['deskripsi']}</td>
                        <td>
                          <a href='editKuliah.php?id={$p['id']}' class='btn btn-sm btn-outline-primary'>Edit</a>
                          <a href='landingAdmin.php?hapus_kuliah={$p['id']}'
                            class='btn btn-sm btn-outline-danger'
                            onclick=\"return confirm('Hapus kuliah ini?')\">Hapus</a>
                        </td>
                      </tr>";
                    $no++;
                  }
                ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>

  <!-- jQuery WAJIB paling atas -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Summernote CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css">

  <!-- Summernote JS -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



  <script>
  document.addEventListener("DOMContentLoaded", function() {
    $('.summernote').summernote({
        placeholder: 'Tulis konten di sini...',
        tabsize: 2,
        height: 200,  
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview']]
        ]
    });
  });
</script>

</body>
</html>
