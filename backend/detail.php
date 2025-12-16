<?php
include "../konekDB.php";

/* =====================================================
   BAGIAN 1 — BACKEND BERITA (GET / AJAX)
===================================================== */
if (isset($_GET['page']) || isset($_GET['search']) || isset($_GET['tahun'])) {

    $search  = isset($_GET['search']) ? pg_escape_string($_GET['search']) : '';
    $tahun   = isset($_GET['tahun']) ? (int)$_GET['tahun'] : 0;
    $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $perPage = 6;
    $offset  = ($page - 1) * $perPage;

    /* HITUNG TOTAL */
    $sqlCount = "SELECT COUNT(*) FROM view_berita WHERE 1=1";
    if ($search !== '') $sqlCount .= " AND judul ILIKE '%$search%'";
    if ($tahun != 0)   $sqlCount .= " AND EXTRACT(YEAR FROM tanggal) = $tahun";

    $resCount   = pg_query($conn, $sqlCount);
    $totalRow   = (int) pg_fetch_result($resCount, 0, 0);
    $totalPage  = ceil($totalRow / $perPage);

    /* DATA BERITA */
    $sql = "SELECT * FROM view_berita WHERE 1=1";
    if ($search !== '') $sql .= " AND judul ILIKE '%$search%'";
    if ($tahun != 0)   $sql .= " AND EXTRACT(YEAR FROM tanggal) = $tahun";
    $sql .= " ORDER BY tanggal DESC LIMIT $perPage OFFSET $offset";

    $query = pg_query($conn, $sql);

    echo '<div class="row g-4 mt-2">';
    while ($b = pg_fetch_assoc($query)) {
        echo '
        <div class="col-md-4">
          <div class="card h-100">
            '.($b['gambar'] ? '<img src="'.htmlspecialchars($b['gambar']).'" class="card-img-top">' : '').'
            <div class="card-body">
              <h5 class="card-title">'.htmlspecialchars($b['judul']).'</h5>
              <p class="card-text">'.htmlspecialchars(substr($b['konten'],0,120)).'...</p>
              <small class="text-muted">'.date('d M Y',strtotime($b['tanggal'])).'</small>
            </div>
            <div class="card-footer text-end">
            <a href="/PBL-SE/detailBerita.php?id='.$b['id'].'" class="btn btn-outline-primary btn-sm">
                Selengkapnya
            </a>


            </div>
          </div>
        </div>';
    }
    echo '</div>';

    /* PAGINATION */
    if ($totalPage > 1) {
        echo '<nav><ul class="pagination justify-content-center mt-3">';
        for ($i=1; $i <= $totalPage; $i++) {
            echo '<li class="page-item '.($i==$page?'active':'').'">
                    <a href="#" class="page-link" data-page="'.$i.'">'.$i.'</a>
                  </li>';
        }
        echo '</ul></nav>';
    }

    exit;
}

/* =====================================================
   BAGIAN 2 — BACKEND FORM (POST + ACTION)
===================================================== */

$action = $_POST['action'] ?? '';

switch ($action) {

    /* ================= SIMPAN LAYANAN ================= */
    case 'simpan_layanan':

        $fullname = $_POST['fullname'];
        $phone    = $_POST['phone'];
        $email    = $_POST['email'];
        $detail   = $_POST['detail'];
        $layanan  = $_POST['layanan'];
        $tanggal  = $_POST['tanggal'];
        $jam      = $_POST['jam'];

        $queryJenis = "SELECT id FROM jenis_layanan WHERE nama_layanan = $1";
        $resultJenis = pg_query_params($conn, $queryJenis, [$layanan]);

        if ($row = pg_fetch_assoc($resultJenis)) {
            $id_layanan = $row['id'];
        } else {
            echo "<script>alert('Jenis layanan tidak ditemukan');history.back();</script>";
            exit;
        }

        $fileName = null;
        if (!empty($_FILES['surat']['name'])) {
            $folder = "../uploads/";
            if (!is_dir($folder)) mkdir($folder, 0777, true);

            $fileName = time().'_'.basename($_FILES['surat']['name']);
            move_uploaded_file($_FILES['surat']['tmp_name'], $folder.$fileName);
        }

        $queryInsert = "
            INSERT INTO layanan
            (full_name, phone_number, email, detail_kegiatan,
             jenis_layanan, tanggal, jam_pelaksanaan, file_surat)
            VALUES ($1,$2,$3,$4,$5,$6,$7,$8)
        ";

        $resultInsert = pg_query_params($conn, $queryInsert,
            [$fullname,$phone,$email,$detail,$id_layanan,$tanggal,$jam,$fileName]
        );

        if ($resultInsert) {
            echo "<script>alert('Data pelayanan berhasil dikirim!');window.location.href='../landing.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data!');history.back();</script>";
        }
        exit;

    /* ============ SIMPAN OPEN RECRUITMENT ============ */
    case 'simpan_open_recruitment':

        $fullname = $_POST['fullname'];
        $nim      = $_POST['nim'];
        $email    = $_POST['email'];
        $phone    = $_POST['phone'];

        $cvFile = null;
        if (!empty($_FILES['cv']['name'])) {
            $folder = "../uploads_cv/";
            if (!is_dir($folder)) mkdir($folder,0777,true);
            $cvFile = time().'_cv_'.basename($_FILES['cv']['name']);
            move_uploaded_file($_FILES['cv']['tmp_name'], $folder.$cvFile);
        }

        $ktmFile = null;
        if (!empty($_FILES['ktm']['name'])) {
            $folder = "../uploads_ktm/";
            if (!is_dir($folder)) mkdir($folder,0777,true);
            $ktmFile = time().'_ktm_'.basename($_FILES['ktm']['name']);
            move_uploaded_file($_FILES['ktm']['tmp_name'], $folder.$ktmFile);
        }

        $query = "
            INSERT INTO open_recruitment
            (full_name,nim,email_kampus,phone_number,file_cv,file_ktm)
            VALUES ($1,$2,$3,$4,$5,$6)
        ";

        $result = pg_query_params($conn, $query,
            [$fullname,$nim,$email,$phone,$cvFile,$ktmFile]
        );

        if ($result) {
            echo "<script>alert('Pendaftaran berhasil dikirim!');window.location.href='../landing.php';</script>";
        } else {
            echo "<script>alert('Gagal mengirim data!');history.back();</script>";
        }
        exit;

    default:
        echo "<script>alert('Aksi tidak valid');history.back();</script>";
        exit;
}
