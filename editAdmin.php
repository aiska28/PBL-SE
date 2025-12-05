<?php
include 'konekDB.php';

// Tentukan jenis edit
$edit_type = '';
if (isset($_GET['id_publikasi'])) {
    $edit_type = 'publikasi';
    $id = $_GET['id_publikasi'];

    $res = pg_query_params($conn, "SELECT * FROM publikasi WHERE id_publikasi=$1", array($id));
    if (pg_num_rows($res) == 0) {
        header("Location: LandingAdmin.php?msg=notfound");
        exit;
    }
    $data = pg_fetch_assoc($res);

    // Ambil dosen untuk dropdown
    $dosenQuery = pg_query($conn, "SELECT * FROM dosen ORDER BY nama ASC");

} elseif (isset($_GET['id_dosen'])) {
    $edit_type = 'dosen';
    $id = $_GET['id_dosen'];

    $res = pg_query_params($conn, "SELECT * FROM dosen WHERE id_dosen=$1", array($id));
    if (pg_num_rows($res) == 0) {
        header("Location: LandingAdmin.php?msg=notfound");
        exit;
    }
    $data = pg_fetch_assoc($res);
}

// Handle form submit
if (isset($_POST['submit_edit'])) {
    if ($edit_type == 'publikasi') {
        $id_dosen = $_POST['id_dosen'];
        $jenis = $_POST['jenis_publikasi'];
        $link = $_POST['link_publikasi'];

        $query = "UPDATE publikasi SET id_dosen=$1, jenis_publikasi=$2, link_publikasi=$3 WHERE id_publikasi=$4";
        pg_query_params($conn, $query, array($id_dosen, $jenis, $link, $id));

    } elseif ($edit_type == 'dosen') {
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $nidn = $_POST['nidn'];
        $program_studi = $_POST['program_studi'];
        $jabatan = $_POST['jabatan'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
            $filename = time().'_'.basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/'.$filename);
            $query = "UPDATE dosen SET nama=$1, nip=$2, nidn=$3, program_studi=$4, jabatan=$5, email=$6, alamat_kantor=$7, foto=$8 WHERE id_dosen=$9";
            pg_query_params($conn, $query, array($nama,$nip,$nidn,$program_studi,$jabatan,$email,$alamat,$filename,$id));
        } else {
            $query = "UPDATE dosen SET nama=$1, nip=$2, nidn=$3, program_studi=$4, jabatan=$5, email=$6, alamat_kantor=$7 WHERE id_dosen=$8";
            pg_query_params($conn, $query, array($nama,$nip,$nidn,$program_studi,$jabatan,$email,$alamat,$id));
        }
    }

    header("Location: LandingAdmin.php?msg=updated");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.edit-form { max-width:650px; margin:50px auto; padding:30px; border:2px solid #0d6efd; border-radius:12px; background:#f8f9fa; box-shadow:0 5px 15px rgba(0,0,0,0.1);}
.edit-form h4 { color:#0d6efd; text-align:center; margin-bottom:25px; font-weight:700;}
.edit-form label { font-weight:600;}
.edit-form .btn-primary, .edit-form .btn-secondary { width:100%; margin-top:10px;}
.edit-form img { max-width:120px; border-radius:8px; margin-bottom:10px; }
</style>
</head>
<body>
<div class="container">
  <div class="card shadow-sm edit-form">
    <div class="card-body">
      <?php if ($edit_type == 'publikasi'): ?>
        <h4>Edit Publikasi</h4>
        <form method="POST">
          <div class="mb-3">
            <label for="id_dosen" class="form-label">Nama Dosen</label>
            <select name="id_dosen" id="id_dosen" class="form-select" required>
              <?php
              pg_result_seek($dosenQuery,0);
              while ($dosen = pg_fetch_assoc($dosenQuery)) {
                  $selected = ($dosen['id_dosen'] == $data['id_dosen']) ? "selected" : "";
                  echo "<option value='{$dosen['id_dosen']}' $selected>{$dosen['nama']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Publikasi</label>
            <input type="text" name="jenis_publikasi" class="form-control" value="<?=htmlspecialchars($data['jenis_publikasi'])?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Link Publikasi</label>
            <input type="url" name="link_publikasi" class="form-control" value="<?=htmlspecialchars($data['link_publikasi'])?>" required>
          </div>
          <button type="submit" name="submit_edit" class="btn btn-primary">Submit</button>
          <a href="LandingAdmin.php" class="btn btn-secondary">Batal</a>
        </form>

      <?php elseif ($edit_type == 'dosen'): ?>
        <h4>Edit Anggota Dosen</h4>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?=htmlspecialchars($data['nama'])?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" value="<?=htmlspecialchars($data['nip'])?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">NIDN</label>
            <input type="text" name="nidn" class="form-control" value="<?=htmlspecialchars($data['nidn'])?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input type="text" name="program_studi" class="form-control" value="<?=htmlspecialchars($data['program_studi'])?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="<?=htmlspecialchars($data['jabatan'])?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?=htmlspecialchars($data['email'])?>">
          </div>
         <div class="mb-3">
            <label class="form-label">Foto</label>
            <?php if($data['foto']): ?>
                <img src="uploads/<?= $data['foto'] ?>" alt="Foto">
            <?php endif; ?>
            <input type="file" name="foto" class="form-control">
         </div>
          <div class="mb-3">
            <label class="form-label">Alamat Kantor</label>
            <input type="text" name="alamat" class="form-control" value="<?=htmlspecialchars($data['alamat_kantor'])?>">
          </div>
          <button type="submit" name="submit_edit" class="btn btn-primary">Submit</button>
          <a href="LandingAdmin.php" class="btn btn-secondary">Batal</a>
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
