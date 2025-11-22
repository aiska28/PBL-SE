<?php
include 'konekDB.php';

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // DATA DOSEN
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $nidn = $_POST['nidn'];
    $jabatan = $_POST['jabatan'];
    $pendidikan = $_POST['pendidikan'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    // DATA MATA KULIAH
    $mk_ganjil = $_POST['mata_kuliah_ganjil'];
    $mk_genap = $_POST['mata_kuliah_genap'];

    // === UPLOAD FOTO ===
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fotoName = time() . "_" . basename($_FILES['foto']['name']); 
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoPath = $targetDir . $fotoName;

    $allowed = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        $pesan = "Format foto harus jpg, jpeg atau png!";
    } else if (!move_uploaded_file($fotoTmp, $fotoPath)) {
        $pesan = "Gagal mengupload foto!";
    } else {

        // === INSERT DOSEN ===
        $queryDosen = "
            INSERT INTO dosen (nama, gelar, nip, nidn, email, alamat_kantor, program_studi, jabatan, foto)
            VALUES ('$nama', ' ', '$nip', '$nidn', '$email', '$alamat', '$program_studi', '$jabatan', '$fotoPath')
        ";

        $resultDosen = pg_query($conn, $queryDosen);

        if ($resultDosen) {

            // Ambil ID dosen yg baru dimasukkan
            $id_dosen = pg_fetch_result(
                pg_query($conn, "SELECT currval(pg_get_serial_sequence('dosen','id_dosen'))"),
                0,
                0
            );

            // === INSERT MATA KULIAH ===
            // Semester Ganjil
            $mk_list_ganjil = preg_split("/\r\n|\n|\r/", $mk_ganjil);
            foreach ($mk_list_ganjil as $mk) {
                $mk = trim($mk);
                if (!empty($mk)) {
                    pg_query_params($conn, "INSERT INTO mata_kuliah (id_dosen, semester, nama_mk) VALUES ($1,$2,$3)", 
                        array($id_dosen,'Ganjil',$mk));
                }
            }

            // Semester Genap
            $mk_list_genap = preg_split("/\r\n|\n|\r/", $mk_genap);
            foreach ($mk_list_genap as $mk) {
                $mk = trim($mk);
                if (!empty($mk)) {
                    pg_query_params($conn, "INSERT INTO mata_kuliah (id_dosen, semester, nama_mk) VALUES ($1,$2,$3)", 
                        array($id_dosen,'Genap',$mk));
                }
            }

            // === INSERT PENDIDIKAN ===
            $pendidikan_list = preg_split("/\r\n|\n|\r/", $pendidikan);
              foreach ($pendidikan_list as $edu) {
              $edu = trim($edu);
                if (!empty($edu)) {
                  // Pisahkan data berdasarkan delimiter '|'
                    $parts = array_map('trim', explode('|', $edu));
                      $jenjang = $parts[0] ?? '';
                      $jurusan = $parts[1] ?? '';
                      $universitas = $parts[2] ?? '';
                      $tahun = $parts[3] ?? '';

                      pg_query_params(
                        $conn,
                        "INSERT INTO pendidikan (id_dosen, jenjang, jurusan, universitas, tahun) VALUES ($1,$2,$3,$4,$5)",
                        array($id_dosen, $jenjang, $jurusan, $universitas, $tahun)
                      );
                }
              }

            $pesan = "Data dosen & mata kuliah berhasil disimpan!";
        } else {
            $pesan = "Gagal menyimpan data dosen!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Anggota Lab</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="TambahTim.css">
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid px-4">
      <a class="navbar-brand fw-bold" href="#">Tambah Anggota Lab</a>
    </div>
  </nav>

  <!-- FORM CARD -->
  <div class="container my-5">
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 700px;">
      <div class="card-body p-4">
        <h4 class="text-center text-primary fw-bold mb-4">Tambah Anggota Lab</h4>

        <?php if (!empty($pesan)): ?>
          <div class="alert alert-info text-center"><?= $pesan; ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" autocomplete="off">

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">NIP</label>
              <input type="text" name="nip" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input type="text" name="program_studi" class="form-control" required>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">NIDN</label>
              <input type="text" name="nidn" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Jabatan</label>
              <input type="text" name="jabatan" class="form-control">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Pendidikan (satu per baris)</label>
            <textarea name="pendidikan" rows="5" class="form-control" placeholder="Contoh: S1 | Teknik Informatika | Polinema | 2010-2014&#10;S2 | Sistem Informasi | Universitas B | 2015-2017"></textarea>
            <small class="text-muted">Format: Jenjang | Jurusan | Universitas | Tahun Mulai-Tahun Selesai</small>
          </div>

          <!-- INPUT MATA KULIAH PER SEMESTER -->
          <div class="mb-3">
            <label class="form-label">Mata Kuliah Semester Ganjil (satu per baris)</label>
            <textarea name="mata_kuliah_ganjil" rows="5" class="form-control" placeholder="Contoh: Praktikum Dasar Pemrograman&#10;Perancangan Produk Kreatif" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Mata Kuliah Semester Genap (satu per baris)</label>
            <textarea name="mata_kuliah_genap" rows="5" class="form-control" placeholder="Contoh: Proyek Teknologi Terintegrasi&#10;Praktikum Algoritma dan Struktur Data" required></textarea>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Foto</label>
              <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" rows="3" class="form-control"></textarea>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary px-4 fw-bold">Simpan</button>
            <a href="LandingAdmin.php" class="btn btn-secondary px-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>window.onload = function() {
    document.querySelector('form').reset();
    };
</script>
</body>
</html>