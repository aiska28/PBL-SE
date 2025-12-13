<?php 
include 'konekDB.php'; 

// ------------------ HANDLE HAPUS PUBLIKASI ------------------
if (isset($_GET['hapus_publikasi'])) {
    $id = $_GET['hapus_publikasi'];
    $query = "DELETE FROM publikasi WHERE id_publikasi = $1";
    pg_query_params($conn, $query, array($id));
    header("Location: landingAdmin.php?tab=publikasi&msg=deleted");
    exit;
}

// ------------------ HANDLE HAPUS DOSEN ------------------
if (isset($_GET['hapus_dosen'])) {
    $id = $_GET['hapus_dosen'];

    // Hapus relasi dulu
    pg_query_params($conn, "DELETE FROM publikasi WHERE id_dosen=$1", [$id]);
    pg_query_params($conn, "DELETE FROM mata_kuliah WHERE id_dosen=$1", [$id]);
    pg_query_params($conn, "DELETE FROM pendidikan WHERE id_dosen=$1", [$id]);

    // Baru hapus dosen
    pg_query_params($conn, "DELETE FROM dosen WHERE id_dosen=$1", [$id]);

    header("Location: landingAdmin.php?tab=anggota&msg=deleted");
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

    header("Location: landingAdmin.php?tab=tampilan&inner=profileLab&msg=profile_updated");
    exit;
}

// ------------------ HANDLE UPDATE VISI MISI ------------------
if (isset($_POST['update_visi_misi'])) {

    $id = $_POST['id'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    pg_query_params($conn,
        "UPDATE visi_misi SET visi=$1, misi=$2 WHERE id=$3",
        array($visi, $misi, $id)
    );

    header("Location: landingAdmin.php?tab=tampilan&inner=visiMisi&msg=profile_updated");
    exit;
}

// --------- UPDATE RISET ------------
if (isset($_POST['update_visi_misi'])) {

    $id   = $_POST['id'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    pg_query_params(
        $conn,
        "UPDATE visi_misi SET visi=$1, misi=$2 WHERE id=$3",
        array($visi, $misi, $id)
    );

    header("Location: landingAdmin.php?tab=tampilan&inner=visiMisi&msg=updated");
    exit;
}

if (isset($_POST['update_riset'])) {

    $id        = $_POST['id'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params(
        $conn,
        "UPDATE FokusRiset SET deskripsi=$1 WHERE id=$2",
        array($deskripsi, $id)
    );

    header("Location: landingAdmin.php?tab=tampilan&inner=riset&msg=updated");
    exit;
}


// ------------------ HANDLE HAPUS RISET ------------------
if (isset($_GET['hapus_riset'])) {
    pg_query_params($conn,
        "DELETE FROM FokusRiset WHERE id=$1",
        array($_GET['hapus_riset'])
    );
    header("Location: LandingAdmin.php?tab=tampilan&inner=riset&msg=deleted");
    exit;
}

// ------ UPDATE FAILITAS
if (isset($_POST['update_fasilitas'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params(
        $conn,
        "UPDATE FasilitasPeralatan SET judul=$1, deskripsi=$2 WHERE id=$3",
        array($judul, $deskripsi, $id)
    );

    header("Location: LandingAdmin.php?tab=tampilan&inner=fasilitas&msg=updated");
    exit;
}


// ------------------ HANDLE HAPUS FASILITAS ------------------
if (isset($_GET['hapus_fasilitas'])) {
    pg_query_params($conn,
        "DELETE FROM FasilitasPeralatan WHERE id=$1",
        array($_GET['hapus_fasilitas'])
    );
    header("Location: landingAdmin.php?tab=tampilan&inner=fasilitas&msg=deleted");
    exit;
}

// ------ UPDATE KEGIATAN / PROYEK
if (isset($_POST['update_kegiatan'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params(
        $conn,
        "UPDATE KegiatanProyek SET judul=$1, deskripsi=$2 WHERE id=$3",
        array($judul, $deskripsi, $id)
    );

    header("Location: landingAdmin.php?tab=tampilan&inner=kegiatan&msg=updated");
    exit;
}

// ------------------ HANDLE HAPUS KEGIATAN ------------------
if (isset($_GET['hapus_kegiatan'])) {
    pg_query_params($conn,
        "DELETE FROM KegiatanProyek WHERE id=$1",
        array($_GET['hapus_kegiatan'])
    );
    header("Location: landingAdmin.php?tab=tampilan&inner=kegiatan&msg=deleted");
    exit;
}

// ------ UPDATE PERKULIAHAN TERKAIT
if (isset($_POST['update_kuliah'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params(
        $conn,
        "UPDATE PerkuliahanTerkait SET judul=$1, deskripsi=$2 WHERE id=$3",
        array($judul, $deskripsi, $id)
    );

    header("Location: landingAdmin.php?tab=tampilan&inner=kuliah&msg=updated");
    exit;
}

// ------------------ HANDLE HAPUS KULIAH ------------------
if (isset($_GET['hapus_kuliah'])) {
    pg_query_params($conn,
        "DELETE FROM PerkuliahanTerkait WHERE id=$1",
        array($_GET['hapus_kuliah'])
    );
    header("Location: landingAdmin.php?tab=tampilan&inner=kuliah&msg=deleted");
    exit;
}

// ------------------ UPDATE SEJARAH ------------------
if (isset($_POST['update_sejarah'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params($conn,
        "UPDATE sejarah SET judul=$1, deskripsi=$2 WHERE id=$3",
        array($judul, $deskripsi, $id)
    );

    header("Location: landingAdmin.php?tab=tentangKami&inner=sejarah&msg=updated");
}

// ------------------ UPDATE VISI MISI TUJUAN ------------------
if (isset($_POST['update_vmt'])) {

    $id = $_POST['id'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $tujuan = $_POST['tujuan'];

    pg_query_params($conn,
        "UPDATE visi_misi_tujuan SET visi=$1, misi=$2, tujuan=$3 WHERE id=$4",
        array($visi, $misi, $tujuan, $id)
    );

     header("Location: landingAdmin.php?tab=tentangKami&inner=vmt&msg=updated");
    exit;
}

// ------------------ UPDATE STRUKTUR ORGANISASI ------------------
if (isset($_POST['update_organisasi'])) {

    $id      = $_POST['id'];
    $jabatan = $_POST['jabatan'];
    $nama    = $_POST['nama'];

    // Validasi sederhana
    if ($id == "" || $jabatan == "" || $nama == "") {
        die("Data tidak boleh kosong");
    }

    // Query update
    $query = "UPDATE struktur_organisasi 
              SET jabatan = $1, nama = $2
              WHERE id = $3";

    $result = pg_query_params($conn, $query, array($jabatan, $nama, $id));

    if ($result) {
         header("Location: landingAdmin.php?tab=tentangKami&inner=organisasi&msg=updated");
        exit;
    } else {
        die("GAGAL UPDATE: " . pg_last_error($conn));
    }
}

// ------------------ HAPUS STRUKTUR ORGANISASI ------------------
if (isset($_GET['hapus_organisasi'])) {

    $id = $_GET['hapus_organisasi'];

    pg_query_params(
        $conn,
        "DELETE FROM struktur_organisasi WHERE id = $1",
        array($id)
    );

    // KEMBALI KE TAB STRUKTUR ORGANISASI
    header("Location: landingAdmin.php?tab=tentangKami&inner=organisasi&msg=struktur_deleted");
    exit;
}

// ------------------ UPDATE TENAGA PENGAJAR ------------------
if (isset($_POST['update_pengajar'])) {

    $id     = $_POST['id'];
    $nama   = $_POST['nama_dosen'];
    $jabatan= $_POST['jabatan'];
    $nidn   = $_POST['nidn'];

    // Cek apakah ganti foto
    if (!empty($_FILES['foto_url']['name'])) {
        $foto = $_FILES['foto_url']['name'];
        $tmp  = $_FILES['foto_url']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $foto);

        pg_query_params($conn,
            "UPDATE tenaga_pengajar
             SET nama_dosen=$1, jabatan=$2, nidn=$3, foto_url=$4
             WHERE id=$5",
            array($nama, $jabatan, $nidn, $foto, $id)
        );
    } else {
        pg_query_params($conn,
            "UPDATE tenaga_pengajar
             SET nama_dosen=$1, jabatan=$2, nidn=$3
             WHERE id=$4",
            array($nama, $jabatan, $nidn, $id)
        );
    }

    header("Location: landingAdmin.php?tab=tentangKami&inner=tenagaPengajar&msg=pengajar_updated");
    exit;
}

// ------------------ TAMBAH TENAGA PENGAJAR ------------------
if (isset($_POST['add_pengajar'])) {

  pg_query_params($conn,
    "INSERT INTO tenaga_pengajar (nama, jabatan, deskripsi) VALUES ($1, $2, $3)",
       array($_POST['nama'], $_POST['jabatan'], $_POST['deskripsi'])
    );

  header("Location: landingAdmin.php?tab=tentang&inner=tenagaPengajar&msg=added");
  exit;
}

// ------------------ HAPUS TENAGA PENGAJAR ------------------
if (isset($_GET['hapus_pengajar'])) {

    pg_query_params($conn,
        "DELETE FROM tenaga_pengajar WHERE id=$1",
        array($_GET['hapus_pengajar'])
    );

    header("Location: landingAdmin.php?tab=tentang&inner=tenagaPengajar&msg=deleted");
    exit;
}

// ------------------ UPDATE TENAGA KEPENDIDIKAN ------------------
if (isset($_POST['update_kependidikan'])) {

    $id      = $_POST['id'];
    $nama    = $_POST['nama_pegawai'];
    $jabatan = $_POST['jabatan'];

    pg_query_params($conn,
        "UPDATE tenaga_kependidikan
         SET nama_pegawai=$1, jabatan=$2
         WHERE id=$3",
        array($nama, $jabatan, $id)
    );

    // ⬇️ REDIRECT KE TAB TENAGA KEPENDIDIKAN
    header("Location: landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=kependidikan_updated");
    exit;
}


// ------------------ TAMBAH TENAGA KEPENDIDIKAN ------------------
if (isset($_POST['add_kependidikan'])) {

    pg_query_params($conn,
        "INSERT INTO tenaga_kependidikan (nama, jabatan, deskripsi) VALUES ($1, $2, $3)",
        array($_POST['nama'], $_POST['jabatan'], $_POST['deskripsi'])
    );

     header("Location: landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=added");
    exit;
}

// ------------------ HAPUS TENAGA KEPENDIDIKAN ------------------
if (isset($_GET['hapus_kependidikan'])) {

    pg_query_params($conn,
        "DELETE FROM tenaga_kependidikan WHERE id=$1",
        array($_GET['hapus_kependidikan'])
    );

    header("Location: landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=deleted");
    exit;
}

// ------------------ UPDATE SARANA PRASARANA (SAPRAS) ------------------
if (isset($_POST['update_sarpras'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params($conn,
        "UPDATE sarpras SET judul=$1, deskripsi=$2 WHERE id=$3",
        array($judul, $deskripsi, $id)
    );

    header("Location: landingAdmin.php?tab=tentangKami&inner=sarpras&msg=updated");
    exit;
}

// ------------------ TAMBAH SARANA PRASARANA (SARPRAS) ------------------
if (isset($_POST['add_sarpras'])) {

    $judul     = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    pg_query_params($conn,
        "INSERT INTO sarpras (judul, deskripsi) VALUES ($1, $2)",
        array($judul, $deskripsi)
    );

    header("Location: landingAdmin.php?tab=tentangKami&inner=sarpras&msg=sarpras_added");
    exit;
}

// ------------------ HAPUS SARANA PRASARANA ------------------
if (isset($_GET['hapus_sarpras'])) {

    pg_query_params(
        $conn,
        "DELETE FROM sarana_prasarana WHERE id=$1",
        array($_GET['hapus_sarpras'])
    );

    header("Location: landingAdmin.php?tab=tentangKami&inner=sarpras&msg=sarpras_deleted");
    exit;
}

/* ------------------ HAPUS AGENDA ------------------ */
if (isset($_GET['hapus_agenda'])) {
    $id = $_GET['hapus_agenda'];
    pg_query_params($conn, "DELETE FROM agenda WHERE id = $1", array($id));
    header("Location: landingAdmin.php?tab=tampilanBerita&inner=AgendaTab&msg=agenda_deleted");
    exit;
}

/* ------------------ Update AGENDA ------------------ */
if (isset($_POST['update_agenda'])) {

    $id       = $_POST['id'];
    $judul    = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal  = $_POST['tanggal'];

    $query = "
        UPDATE agenda 
        SET judul = $1, deskripsi = $2, tanggal = $3
        WHERE id = $4
    ";

    pg_query_params($conn, $query, array($judul, $deskripsi, $tanggal, $id));

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=AgendaTab&msg=agenda_updated");
    exit;
}

/* ------------------ TAMBAH AGENDA ------------------ */
if (isset($_POST['add_agenda'])) {

    pg_query_params(
        $conn,
        "INSERT INTO agenda (judul, deskripsi, tanggal)
         VALUES ($1, $2, $3)",
        array(
            $_POST['judul'],
            $_POST['deskripsi'],
            $_POST['tanggal']
        )
    );

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=AgendaTab&msg=agenda_added");
exit;

}

/* ------------------ HAPUS BERITA ------------------= */
if (isset($_GET['hapus_berita'])) {
    $id = $_GET['hapus_berita'];
    pg_query_params($conn, "DELETE FROM berita WHERE id = $1", array($id));
    header("Location: landingAdmin.php?tab=tampilanBerita&inner=BeritaTab&msg=berita_deleted");
    exit;
}

/* ------------------ Update BERITA ------------------ */
if (isset($_POST['update_berita'])) {

    $id      = $_POST['id'];
    $judul   = $_POST['judul'];
    $konten  = $_POST['konten'];
    $tanggal = $_POST['tanggal'];

    $query = "
        UPDATE berita 
        SET judul = $1, konten = $2, tanggal = $3
        WHERE id = $4
    ";

    pg_query_params($conn, $query, array($judul, $konten, $tanggal, $id));

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=BeritaTab&msg=berita_updated");
exit;

}

/* ------------------ TAMBAH BERITA ------------------ */
if (isset($_POST['add_berita'])) {

    pg_query_params(
        $conn,
        "INSERT INTO berita (judul, konten, tanggal)
         VALUES ($1, $2, $3)",
        array(
            $_POST['judul'],
            $_POST['konten'],
            $_POST['tanggal']
        )
    );

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=BeritaTab&msg=berita_added");
exit;

}

/* ------------------ HAPUS PENGUMUMAN ------------------ */
if (isset($_GET['hapus_pengumuman'])) {
    $id = $_GET['hapus_pengumuman'];
    pg_query_params($conn, "DELETE FROM pengumuman WHERE id = $1", array($id));
    header("Location: landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_deleted");
    exit;
}

/* ------------------ Update PENGUMUMAN ------------------ */
if (isset($_POST['update_pengumuman'])) {

    $id      = $_POST['id'];
    $judul   = $_POST['judul'];
    $konten  = $_POST['konten'];
    $tanggal = $_POST['tanggal'];

    $query = "
        UPDATE pengumuman 
        SET judul = $1, konten = $2, tanggal = $3
        WHERE id = $4
    ";

    pg_query_params($conn, $query, array($judul, $konten, $tanggal, $id));

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_updated");
    exit;
}

/* ------------------ TAMBAH PENGUMUMAN ------------------ */
if (isset($_POST['add_pengumuman'])) {

    pg_query_params(
        $conn,
        "INSERT INTO pengumuman (judul, konten, tanggal)
         VALUES ($1, $2, $3)",
        array(
            $_POST['judul'],
            $_POST['konten'],
            $_POST['tanggal']
        )
    );

    header("Location: landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_added");
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
          <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tentangKami-tab" data-bs-toggle="tab" data-bs-target="#tentangKami" type="button" role="tab">📘 Tampilan Tentang Kami</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tampilanBerita-tab" data-bs-toggle="tab" data-bs-target="#tampilanBerita" type="button" role="tab">📘 Tampilan Berita</button>
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
              <a href="TambahTim.php?tab=anggota" 
              class="btn btn-warning btn-sm fw-bold text-dark">
              + Tambah Anggota</a>
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
                      <a href="editAdmin.php?id_dosen=<?= $row['id_dosen'] ?>&tab=anggota"
                        class="btn btn-sm btn-outline-primary"
                        onclick="return confirm('Apakah ingin mengedit data anggota ini?')">
                        Edit
                      </a>

                      <a href="LandingAdmin.php?hapus_dosen=<?= $row['id_dosen'] ?>&tab=anggota"
                         class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus anggota ini?')">
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
              <input type="hidden" name="update_visi_misi" value="1">
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
                          <a href='editFasilitas.php?id={$f['id']}&tab=tampilan&inner=fasilitas'
                          class='btn btn-sm btn-outline-primary'>Edit</a>
                          <a href='landingAdmin.php?hapus_fasilitas={$f['id']}&tab=tampilan&inner=fasilitas'
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

        <!-- TAB TAMPILAN LAB -->
          <div class="tab-pane fade" id="tentangKami" role="tabpanel">

          <!-- NAVIGASI TAB DALAM -->
          <ul class="nav nav-pills mb-3" id="innerTabTentang" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sejarah">Sejarah</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#visiMisiTujuan">Visi, Misi dan tujuan</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#organisasi">Struktur Organisasi</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tenagaPengajar">Tenaga Pengajar</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#kependidikan">Tenaga Kependidikan</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sarpras">SAPRAS</button></li>
          </ul>

          <div class="tab-content">

            <!-- ---------------- SEJARAH ---------------- -->
            <div class="tab-pane fade show active" id="sejarah">
              <h5 class="text-primary fw-bold">Sejarah</h5>

              <?php 
                $q = pg_query($conn,"SELECT * FROM sejarah ORDER BY id DESC LIMIT 1");
                $d = pg_fetch_assoc($q);
              ?>

              <form method="POST" action="landingAdmin.php">
                <input type="hidden" name="id" value="<?= $d['id']; ?>">
                <input type="hidden" name="update_sejarah" value="1">

                <div class="mb-3">
                  <label class="form-label fw-semibold">Judul</label>
                  <input type="text" class="form-control" name="judul" value="<?= $d['judul'] ?? '' ?>">
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold">Deskripsi</label>
                  <textarea class="form-control summernote" name="deskripsi"><?= $d['deskripsi']; ?></textarea>
                </div>

                <button class="btn btn-primary">Simpan</button>
              </form>
            </div>

            <!-- ---------------- VISI MISI TUJUAN ---------------- -->
            <div class="tab-pane fade" id="vmt">
              <h5 class="text-primary fw-bold">Visi, Misi & Tujuan</h5>

              <?php 
                $q = pg_query($conn,"SELECT * FROM visi_misi_tujuan ORDER BY id DESC LIMIT 1");
                $d = pg_fetch_assoc($q);
              ?>

              <form method="POST" action="landingAdmin.php">
                <input type="hidden" name="id" value="<?= $d['id']; ?>">
                <input type="hidden" name="update_visi_misi" value="1">

                <label class="fw-semibold mt-2">Visi</label>
                <textarea name="visi" class="form-control summernote"><?= $d['visi']; ?></textarea>

                <label class="fw-semibold mt-3">Misi</label>
                <textarea name="misi" class="form-control summernote"><?= $d['misi']; ?></textarea>

                <label class="fw-semibold mt-3">Tujuan</label>
                <textarea name="tujuan" class="form-control summernote"><?= $d['tujuan']; ?></textarea>

                <button class="btn btn-primary mt-3">Simpan</button>
              </form>
            </div>

            <!-- ---------------- STRUKTUR ORGANISASI ---------------- -->
            <div class="tab-pane fade" id="organisasi">
              <div class="d-flex justify-content-between">
                <h5 class="text-primary fw-bold">Struktur Organisasi</h5>
                <a href="TambahStruktur.php" class="btn btn-warning btn-sm text-dark fw-bold">+ Tambah Struktur</a>
              </div>

              <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                  <thead class="table-primary">
                    <tr>
                      <th>No</th>
                      <th>Jabatan</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
                  $q = pg_query($conn, "SELECT * FROM struktur_organisasi ORDER BY id ASC");
                  $no = 1;

                  while ($s = pg_fetch_assoc($q)) {
                      echo "
                      <tr>
                          <td>{$no}</td>
                          <td>{$s['jabatan']}</td>
                          <td>{$s['nama']}</td>
                          <td>
                              <a href='EditStruktur.php?id={$s['id']}'
                                class='btn btn-sm btn-outline-primary'>Edit</a>

                              <a href='landingAdmin.php?hapus_organisasi={$s['id']}&tab=tentangKami&inner=organisasi'
                                class='btn btn-sm btn-outline-danger'
                                onclick=\"return confirm('Hapus data ini?')\">
                                Hapus
                              </a>
                          </td>
                      </tr>
                      ";
                      $no++;
                  }
                  ?>
                  </tbody>

                </table>
              </div>
            </div>

            <!-- ---------------- TENAGA PENGAJAR ---------------- -->
            <div class="tab-pane fade" id="tenagaPengajar">
              <div class="d-flex justify-content-between">
                <h5 class="text-primary fw-bold">Tenaga Pengajar</h5>
                <a href="TambahPengajar.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Pengajar</a>
              </div>

              <div class="table-responsive mt-3">
              <table class="table table-bordered mt-3 text-center">
                <thead class="table-primary">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>NIDN</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                    $q = pg_query($conn,"SELECT * FROM tenaga_pengajar ORDER BY id ASC");
                    $no = 1;
                    while ($p = pg_fetch_assoc($q)) {
                      echo "
                        <tr>
                          <td>{$no}</td>
                          <td>{$p['nama_dosen']}</td>
                          <td>{$p['jabatan']}</td>
                          <td>{$p['nidn']}</td>
                          <td><img src='uploads/{$p['foto_url']}' width='70'></td>
                          <td>
                            <a href='EditPengajar.php?id={$p['id']}' class='btn btn-sm btn-outline-primary'>Edit</a>
                            <a href='landingAdmin.php?hapus_pengajar={$p['id']}'
                              class='btn btn-sm btn-outline-danger'
                              onclick=\"return confirm('Hapus pengajar ini?')\">Hapus</a>
                          </td>
                      </tr>";
                      $no++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
            </div>

            <!-- ---------------- TENAGA KEPENDIDIKAN ---------------- -->
            <div class="tab-pane fade" id="kependidikan">
              <div class="d-flex justify-content-between">
                <h5 class="text-primary fw-bold">Tenaga Kependidikan</h5>
                <a href="TambahKependidikan.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Pegawai</a>
              </div>

              <div class="table-responsive mt-3">
              <table class="table table-bordered mt-3 text-center">
                <thead class="table-primary">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

               <tbody>
                <?php
                $q = pg_query($conn, "SELECT * FROM tenaga_kependidikan ORDER BY id ASC");
                $no = 1;

                while ($k = pg_fetch_assoc($q)) {
                    echo "
                    <tr>
                        <td>{$no}</td>
                        <td>{$k['nama_pegawai']}</td>
                        <td>{$k['jabatan']}</td>
                        <td>
                            <a href='EditKependidikan.php?id={$k['id']}'
                              class='btn btn-sm btn-outline-primary'>
                              Edit
                            </a>

                            <a href='landingAdmin.php?hapus_kependidikan={$k['id']}&tab=tentangKami&inner=kependidikan'
                              class='btn btn-sm btn-outline-danger'
                              onclick=\"return confirm('Hapus data ini?')\">
                              Hapus
                            </a>
                        </td>
                    </tr>
                    ";
                    $no++;
                }
                ?>
                </tbody>

              </table>
              </div>
            </div>


              <!-- ---------------- SARANA & PRASARANA ---------------- -->
            <div class="tab-pane fade" id="sarpras">
              <div class="d-flex justify-content-between">
                <h5 class="text-primary fw-bold">Sarana & Prasarana</h5>
                <a href="TambahSarpras.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Sarpras</a>
              </div>

              <div class="table-responsive mt-3">
              <table class="table table-bordered mt-3 text-center">
                <thead class="table-primary">
                  <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  $q = pg_query($conn,"SELECT * FROM sarana_prasarana ORDER BY id ASC");
                  $no = 1;
                  while($s = pg_fetch_assoc($q)){
                    echo "
                    <tr>
                      <td>{$no}</td>
                      <td>{$s['nama_ruangan']}</td>
                      <td>{$s['deskripsi']}</td>
                      <td><img src='uploads/{$s['foto_url']}' width='80'></td>
                      <td>
                        <a href='EditSarpras.php?id={$s['id']}' class='btn btn-sm btn-outline-primary'>Edit</a>
                        <a href='landingAdmin.php?hapus_sarpras={$s['id']}&tab=tentangKami&inner=sarpras'
                        class='btn btn-sm btn-outline-danger'
                        onclick=\"return confirm('Hapus data ini?')\">
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
        </div>
      </div>

      <!-- TAB TAMPILAN LAB -->
      <div class="tab-pane fade" id="tampilanBerita" role="tabpanel">

      <!-- NAVIGASI TAB DALAM -->
      <ul class="nav nav-pills mb-3" id="innerTabBerita" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#AgendaTab">Agenda</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#BeritaTab">Berita</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#PengumumanTab">Pengumuman</button></li>
      </ul>

      <div class="tab-content">

      <!-- ======================= TAB AGENDA ======================= -->
      <div class="tab-pane fade show active" id="AgendaTab">
      
      <div class="d-flex justify-content-between">
        <h5 class="text-primary fw-bold">Agenda</h5>
        <a href="TambahAgenda.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Agenda</a>
      </div>

      <div class="table-responsive mt-3">
        <table class="table table-bordered text-center">
          <thead class="table-primary">
            <tr>
              <th>No</th>
              <th>Deskripsi</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Nama Kegiatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qA = pg_query($conn, "SELECT * FROM view_agenda ORDER BY id DESC");
            $no = 1;

            while ($a = pg_fetch_assoc($qA)) {
              echo "
            <tr>
              <td>{$no}</td>
              <td>{$a['deskripsi']}</td>
              <td>{$a['tanggal']}</td>
              <td>{$a['waktu']}</td>
              <td>{$a['nama_kegiatan']}</td>
              <td>
                <a href='editAgenda.php?id={$a['id']}&tab=tampilanBerita&inner=AgendaTab'
                  class='btn btn-sm btn-outline-primary'>
                  Edit
                </a>

                <a href='landingAdmin.php?hapus_agenda={$a['id']}&tab=tampilanBerita&inner=AgendaTab'
                  class='btn btn-sm btn-outline-danger'
                  onclick=\"return confirm('Hapus agenda ini?')\">
                  Hapus
                </a>
              </td>
            </tr>
            ";

              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ======================= TAB BERITA ======================= -->
    <div class="tab-pane fade" id="BeritaTab">
      <div class="d-flex justify-content-between">
        <h5 class="text-primary fw-bold">Berita</h5>
        <a href="TambahBerita.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Berita</a>
      </div>

      <div class="table-responsive mt-3">
        <table class="table table-bordered text-center">
          <thead class="table-primary">
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qB = pg_query($conn, "SELECT * FROM berita ORDER BY id DESC");
            $no = 1;
            while ($b = pg_fetch_assoc($qB)) {
              echo "
              <tr>
                <td>{$no}</td>
                <td>{$b['judul']}</td>
                <td>{$b['tanggal']}</td>
                <td>
                  <a href='editBerita.php?id={$b['id']}' 
                    class='btn btn-sm btn-outline-primary'>Edit</a>

                  <a href='landingAdmin.php?hapus_berita={$b['id']}&tab=tampilanBerita&inner=BeritaTab'
                    class='btn btn-sm btn-outline-danger'
                    onclick=\"return confirm('Hapus berita ini?')\">
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

    <!-- ======================= TAB PENGUMUMAN ======================= -->
    <div class="tab-pane fade" id="PengumumanTab">
      <div class="d-flex justify-content-between">
        <h5 class="text-primary fw-bold">Pengumuman</h5>
        <a href="TambahPengumuman.php" class="btn btn-warning btn-sm fw-bold text-dark">+ Tambah Pengumuman</a>
      </div>

      <div class="table-responsive mt-3">
        <table class="table table-bordered text-center">
          <thead class="table-primary">
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qP = pg_query($conn, "SELECT * FROM pengumuman ORDER BY id DESC");
            $no = 1;
            while ($p = pg_fetch_assoc($qP)) {
              echo "
              <tr>
                <td>{$no}</td>
                <td>{$p['judul']}</td>
                <td>{$p['tanggal']}</td>
                <td>
                  <a href='editPengumuman.php?id={$p['id']}&tab=tampilanBerita&inner=PengumumanTab'
                    class='btn btn-sm btn-outline-primary'>
                    Edit
                  </a>

                  <a href='landingAdmin.php?hapus_pengumuman={$p['id']}&tab=tampilanBerita&inner=PengumumanTab'
                    class='btn btn-sm btn-outline-danger'
                    onclick=\"return confirm('Hapus pengumuman ini?')\">
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
document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);

  const tab = params.get("tab");       // TAB UTAMA
  const inner = params.get("inner");   // TAB DALAM

  if (tab) {
    const trigger = document.querySelector(
      `button[data-bs-target="#${tab}"]`
    );
    if (trigger) {
      new bootstrap.Tab(trigger).show();
    }
  }

  if (inner) {
    const innerTrigger = document.querySelector(
      `button[data-bs-target="#${inner}"]`
    );
    if (innerTrigger) {
      new bootstrap.Tab(innerTrigger).show();
    }
  }
});
</script>



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
