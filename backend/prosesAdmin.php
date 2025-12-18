<?php
include '../konekDB.php';

// Gabungkan semua data GET dan POST untuk pemeriksaan yang mudah
$request_data = array_merge($_GET, $_POST);
$action = null;

// Tentukan aksi yang akan dieksekusi berdasarkan kunci unik
foreach ($request_data as $key => $value) {
    if (strpos($key, 'hapus_') === 0 || strpos($key, 'update_') === 0 || strpos($key, 'add_') === 0) {
        $action = $key;
        break;
    }
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}

if (isset($_POST['simpan_kegiatan'])) {
    $action = 'simpan_kegiatan';
}

// Untuk operasi 
if (!$action && isset($_POST['simpan'])) {
    if (isset($_POST['nama_kegiatan']) && isset($_POST['waktu'])) {
        $action = 'simpan_agenda';
    } elseif (isset($_POST['judul']) && isset($_POST['konten']) && isset($_FILES['gambar'])) {
        $action = 'simpan_berita';
    } elseif (isset($_POST['nama_pegawai']) && isset($_POST['jabatan'])) {
        $action = 'simpan_kependidikan'; // Asumsi: 'nama_pegawai' untuk kependidikan
    } elseif (isset($_POST['nama']) && isset($_POST['nidn']) && isset($_FILES['foto'])) {
        $action = 'simpan_pengajar'; // Asumsi: 'nama', 'nidn', 'foto' untuk pengajar
    } elseif (isset($_POST['judul']) && isset($_POST['konten']) && !isset($_FILES['gambar'])) {
        $action = 'simpan_pengumuman'; // Asumsi: 'judul', 'konten' tanpa gambar untuk pengumuman
    } elseif (isset($_POST['nama']) && isset($_POST['deskripsi']) && isset($_FILES['foto'])) {
        $action = 'simpan_sarpras'; // Asumsi: 'nama' dan 'foto' untuk sarpras
    } elseif (isset($_POST['jabatan']) && isset($_POST['nama'])) {
        $action = 'simpan_struktur'; // Asumsi: 'jabatan' dan 'nama' untuk struktur
    } elseif (isset($_POST['nip']) && isset($_POST['mata_kuliah_ganjil'])) {
        $action = 'simpan_tim'; // Asumsi: 'nip' dan 'mata_kuliah_ganjil' untuk tim dosen
    }
}

if (!$action && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deskripsi']) && isset($_POST['id_dosen'])) {
        $action = 'simpan_publikasi';
    } elseif (isset($_POST['deskripsi']) && isset($_POST['id'])) {
         // Sudah dicover update_riset dll
    } elseif (isset($_POST['judul']) && isset($_POST['deskripsi'])) {
        // Ini berpotensi bentrok, perlu kunci unik di form
        if (strpos($_SERVER['REQUEST_URI'], 'fasilitas')) {
            $action = 'simpan_fasilitas';
        } elseif (strpos($_SERVER['REQUEST_URI'], 'kegiatan')) {
            $action = 'simpan_kegiatan';
        } elseif (strpos($_SERVER['REQUEST_URI'], 'kuliah')) {
            $action = 'simpan_kuliah';
        } elseif (strpos($_SERVER['REQUEST_URI'], 'riset')) {
            $action = 'simpan_riset';
        }
    }
}

switch ($action) {

    // --- HAPUS OPERASI (GET) ---
    case 'hapus_publikasi':
        $id = $_GET['hapus_publikasi'];
        $query = "DELETE FROM publikasi WHERE id_publikasi = $1";
        pg_query_params($conn, $query, array($id));
        header("Location: ../landingAdmin.php?tab=publikasi&msg=deleted");
        exit;

    case 'hapus_dosen':
        $id = $_GET['hapus_dosen'];
        // Hapus relasi dulu
        pg_query_params($conn, "DELETE FROM publikasi WHERE id_dosen=$1", [$id]);
        pg_query_params($conn, "DELETE FROM mata_kuliah WHERE id_dosen=$1", [$id]);
        pg_query_params($conn, "DELETE FROM pendidikan WHERE id_dosen=$1", [$id]);
        // Baru hapus dosen
        pg_query_params($conn, "DELETE FROM dosen WHERE id_dosen=$1", [$id]);
        header("Location: ../landingAdmin.php?tab=anggota&msg=deleted");
        exit;

    case 'hapus_riset':
        pg_query_params($conn, "DELETE FROM FokusRiset WHERE id=$1", array($_GET['hapus_riset']));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=riset&msg=deleted");
        exit;

    case 'hapus_fasilitas':
        pg_query_params($conn, "DELETE FROM FasilitasPeralatan WHERE id=$1", array($_GET['hapus_fasilitas']));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=fasilitas&msg=deleted");
        exit;

    case 'hapus_kegiatan':
        pg_query_params($conn, "DELETE FROM KegiatanProyek WHERE id=$1", array($_GET['hapus_kegiatan']));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=kegiatan&msg=deleted");
        exit;

    case 'hapus_kuliah':
        pg_query_params($conn, "DELETE FROM PerkuliahanTerkait WHERE id=$1", array($_GET['hapus_kuliah']));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=kuliah&msg=deleted");
        exit;

    case 'hapus_organisasi':
        $id = $_GET['hapus_organisasi'];
        pg_query_params($conn, "DELETE FROM struktur_organisasi WHERE id = $1", array($id));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=organisasi&msg=struktur_deleted");
        exit;
    
    case 'hapus_pengajar':
        pg_query_params($conn, "DELETE FROM tenaga_pengajar WHERE id=$1", array($_GET['hapus_pengajar']));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=tenagaPengajar&msg=deleted");
        exit;

    case 'hapus_kependidikan':
        pg_query_params($conn, "DELETE FROM tenaga_kependidikan WHERE id=$1", array($_GET['hapus_kependidikan']));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=deleted");
        exit;

    case 'hapus_sarpras':
        pg_query_params($conn, "DELETE FROM sarana_prasarana WHERE id=$1", array($_GET['hapus_sarpras']));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=sarpras&msg=sarpras_deleted");
        exit;

    case 'hapus_agenda':
        $id = $_GET['hapus_agenda'];
        pg_query_params($conn, "DELETE FROM agenda WHERE id = $1", array($id));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=AgendaTab&msg=agenda_deleted");
        exit;

    case 'hapus_berita':
        $id = $_GET['hapus_berita'];
        pg_query_params($conn, "DELETE FROM berita WHERE id = $1", array($id));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=BeritaTab&msg=berita_deleted");
        exit;

    case 'hapus_pengumuman':
        $id = $_GET['hapus_pengumuman'];
        pg_query_params($conn, "DELETE FROM pengumuman WHERE id = $1", array($id));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_deleted");
        exit;
    
    // --- UPDATE OPERASI (POST) BAGIAN EDIT --- 
    case 'update_publikasi':
        $id = $_POST['update_publikasi'];
        $id_dosen = $_POST['id_dosen'];
        $jenis = $_POST['jenis_publikasi'];
        $link = $_POST['link_publikasi'];

        $query = "UPDATE publikasi SET id_dosen=$1, jenis_publikasi=$2, link_publikasi=$3 WHERE id_publikasi=$4";
        pg_query_params($conn, $query, [$id_dosen, $jenis, $link, $id]);

        header("Location: ../landingAdmin.php?tab=publikasi&msg=updated");
        exit;

    case 'update_dosen':
        $id = $_POST['update_dosen'];

        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $nidn = $_POST['nidn'];
        $program_studi = $_POST['program_studi'];
        $jabatan = $_POST['jabatan'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        if (!empty($_FILES['foto']['name'])) {
            $filename = time() . '_' . basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/' . $filename);

            $query = "UPDATE dosen SET nama=$1, nip=$2, nidn=$3, program_studi=$4, jabatan=$5, email=$6, alamat_kantor=$7, foto=$8 WHERE id_dosen=$9";
            pg_query_params(
                $conn,
                $query,
                [$nama,$nip,$nidn,$program_studi,$jabatan,$email,$alamat,$filename,$id]
            );
        } else {
            $query = "UPDATE dosen SET nama=$1, nip=$2, nidn=$3, program_studi=$4, jabatan=$5, email=$6, alamat_kantor=$7 WHERE id_dosen=$8";
            pg_query_params(
                $conn,
                $query,
                [$nama,$nip,$nidn,$program_studi,$jabatan,$email,$alamat,$id]
            );
        }

        header("Location: ../landingAdmin.php?tab=anggota&msg=updated");
        exit;

    case 'update_profilelab':
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "UPDATE ProfileLab SET judul=$1, deskripsi=$2 WHERE id=$3", array($judul, $deskripsi, $id));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=profileLab&msg=update_profilelab");
        exit;

    case 'update_visi_misi':
        $id = $_POST['id'];
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];
        pg_query_params($conn, "UPDATE visi_misi SET visi=$1, misi=$2 WHERE id=$3", array($visi, $misi, $id));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=visiMisi&msg=profile_updated");
        exit;

    case 'update_riset':
        $id = $_POST['id'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "UPDATE FokusRiset SET deskripsi=$1 WHERE id=$2", array($deskripsi, $id));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=riset&msg=updated");
        exit;

    case 'update_fasilitas':
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "UPDATE FasilitasPeralatan SET judul=$1, deskripsi=$2 WHERE id=$3", array($judul, $deskripsi, $id));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=fasilitas&msg=updated");
        exit;

    case 'update_kegiatan':
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "UPDATE kegiatanproyek SET judul=$1, deskripsi=$2 WHERE id=$3", array($judul, $deskripsi, $id));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=kegiatan&msg=updated");
        exit;

    case 'update_kuliah':
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "UPDATE PerkuliahanTerkait SET judul=$1, deskripsi=$2 WHERE id=$3", array($judul, $deskripsi, $id));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=kuliah&msg=updated");
        exit;

    case 'update_sejarah':
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "UPDATE sejarah SET judul=$1, deskripsi=$2 WHERE id=$3", array($judul, $deskripsi, $id));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=sejarah&msg=updated");
        exit;

    case 'update_vmt':
        $id = $_POST['id'];
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];
        $tujuan = $_POST['tujuan'];
        pg_query_params($conn, "UPDATE visi_misi_tujuan SET visi=$1, misi=$2, tujuan=$3 WHERE id=$4", array($visi, $misi, $tujuan, $id));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=visiMisiTujuan&msg=updated");
        exit;

    case 'update_organisasi':
        $id = $_POST['id'];
        $jabatan = $_POST['jabatan'];
        $nama = $_POST['nama'];

        if ($id == "" || $jabatan == "" || $nama == "") {
            die("Data tidak boleh kosong");
        }

        $query = "UPDATE struktur_organisasi SET jabatan = $1, nama = $2 WHERE id = $3";
        $result = pg_query_params($conn, $query, array($jabatan, $nama, $id));

        if ($result) {
            header("Location: ../landingAdmin.php?tab=tentangKami&inner=organisasi&msg=updated");
            exit;
        } else {
            die("GAGAL UPDATE: " . pg_last_error($conn));
        }
    
    case 'update_pengajar':
        $id = $_POST['id'];
        $nama = $_POST['nama_dosen'];
        $jabatan = $_POST['jabatan'];
        $nidn = $_POST['nidn'];

        if (!empty($_FILES['foto_url']['name'])) {
            $foto = $_FILES['foto_url']['name'];
            $tmp = $_FILES['foto_url']['tmp_name'];
            move_uploaded_file($tmp, "../uploads/" . $foto);
            pg_query_params($conn, "UPDATE tenaga_pengajar SET nama_dosen=$1, jabatan=$2, nidn=$3, foto_url=$4 WHERE id=$5", array($nama, $jabatan, $nidn, $foto, $id));
        } else {
            pg_query_params($conn, "UPDATE tenaga_pengajar SET nama_dosen=$1, jabatan=$2, nidn=$3 WHERE id=$4", array($nama, $jabatan, $nidn, $id));
        }
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=tenagaPengajar&msg=pengajar_updated");
        exit;
    
    case 'update_kependidikan':
        $id = $_POST['id'];
        $nama = $_POST['nama_pegawai'];
        $jabatan = $_POST['jabatan'];
        pg_query_params($conn, "UPDATE tenaga_kependidikan SET nama_pegawai=$1, jabatan=$2 WHERE id=$3", array($nama, $jabatan, $id));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=kependidikan_updated");
        exit;
    
    case 'update_sarpras':
        $id   = $_POST['id'];
        $nama = $_POST['nama_ruangan'];
        $desk = $_POST['deskripsi'];

        if (!empty($_FILES['foto_url']['name'])) {
            $foto = time() . "_" . $_FILES['foto_url']['name'];
            $tmp  = $_FILES['foto_url']['tmp_name'];
            move_uploaded_file($tmp, "../uploads/" . $foto);

            $q = "UPDATE sarana_prasarana SET nama_ruangan=$1, deskripsi=$2, foto_url=$3 WHERE id=$4";
            pg_query_params($conn, $q, [$nama, $desk, $foto, $id]);
        } else {
            $q = "UPDATE sarana_prasarana SET nama_ruangan=$1, deskripsi=$2 WHERE id=$3";
            pg_query_params($conn, $q, [$nama, $desk, $id]);
        }

        header("Location: ../landingAdmin.php?tab=tentangKami&inner=sarpras&msg=updated");
        exit;

    case 'update_agenda':
        $id      = $_POST['id'];
        $desk    = $_POST['deskripsi'];
        $tanggal = $_POST['tanggal'];
        $waktu   = $_POST['waktu'];
        $nama    = $_POST['nama_kegiatan'];

        $sql = "UPDATE agenda SET deskripsi=$1, tanggal=$2, waktu=$3, nama_kegiatan=$4 WHERE id=$5";

        pg_query_params($conn, $sql, [$desk, $tanggal, $waktu, $nama, $id]);

        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=AgendaTab&msg=agenda_updated");
        exit;

    case 'update_berita':
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $konten = $_POST['konten'];
        $tanggal = $_POST['tanggal'];
        $gambar = $_POST['gambar'];
        $query = "UPDATE berita SET judul = $1, konten = $2, tanggal = $3 , gambar = $4 WHERE id = $5";
        pg_query_params($conn, $query, array($judul, $konten, $tanggal, $gambar, $id));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=BeritaTab&msg=berita_updated");
        exit;

    case 'update_pengumuman':
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $konten = $_POST['konten'];
        $tanggal = $_POST['tanggal'];
        $gambar = $_POST['gambar'];
        $query = "UPDATE pengumuman SET judul = $1, konten = $2, tanggal = $3, gambar = $4 WHERE id = $5";
        pg_query_params($conn, $query, array($judul, $konten, $tanggal, $gambar, $id));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_updated");
        exit;

    // --- TAMBAH OPERASI (POST) ENIH NAMBAH IN---
    case 'add_publikasi':
        $id_dosen = $_POST['id_dosen'];
        $jenis = $_POST['jenis_publikasi'];
        $link = $_POST['link_publikasi'];

        $query = "INSERT INTO publikasi (id_dosen, jenis_publikasi, link_publikasi)VALUES ($1, $2, $3)";
        pg_query_params($conn, $query, [$id_dosen, $jenis, $link]);

        header("Location: ../landingAdmin.php?tab=publikasi&msg=added");
        exit;

    case 'add_pengajar':
        pg_query_params($conn, "INSERT INTO tenaga_pengajar (nama, jabatan, deskripsi) VALUES ($1, $2, $3)", array($_POST['nama'], $_POST['jabatan'], $_POST['deskripsi']));
        header("Location: ../landingAdmin.php?tab=tentang&inner=tenagaPengajar&msg=added");
        exit;

    case 'add_kependidikan':
        pg_query_params($conn, "INSERT INTO tenaga_kependidikan (nama, jabatan, deskripsi) VALUES ($1, $2, $3)", array($_POST['nama'], $_POST['jabatan'], $_POST['deskripsi']));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=added");
        exit;
    
    case 'add_sarpras':
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "INSERT INTO sarpras (judul, deskripsi) VALUES ($1, $2)", array($judul, $deskripsi));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=sarpras&msg=sarpras_added");
        exit;
    
    case 'simpan_agenda':
        $desk    = $_POST['deskripsi'];
        $tanggal = $_POST['tanggal'];
        $waktu   = $_POST['waktu'];
        $nama    = $_POST['nama_kegiatan'];

        $sql = "INSERT INTO agenda (deskripsi, tanggal, waktu, nama_kegiatan) VALUES ($1, $2, $3, $4)";

        $res = pg_query_params($conn, $sql, [$desk, $tanggal, $waktu, $nama]);

        if (!$res) {
            die("ERROR AGENDA: " . pg_last_error($conn));
        }

        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=AgendaTab&msg=agenda_added");
        exit;
    
    case 'add_berita':
        pg_query_params($conn, "INSERT INTO berita (judul, konten, tanggal) VALUES ($1, $2, $3)", array($_POST['judul'], $_POST['konten'], $_POST['tanggal']));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=BeritaTab&msg=berita_added");
        exit;

    case 'add_pengumuman':
        pg_query_params($conn, "INSERT INTO pengumuman (judul, konten, tanggal, gambar) VALUES ($1, $2, $3, $4)", array($_POST['judul'], $_POST['konten'], $_POST['tanggal'], $_POST['gambar']));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_added");
        exit;

    case 'simpan_berita':

    $judul   = $_POST['judul'];
    $konten  = $_POST['konten'];
    $tanggal = $_POST['tanggal'];
    $gambar = "";

    if (!empty($_FILES['gambar']['name'])) {

        $namaFile = "berita_" . time() . "_" . basename($_FILES['gambar']['name']);
        $targetPath = "../img/" . $namaFile; 

        move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath);

        $gambar = "img/" . $namaFile; 
    }

    $sql = "INSERT INTO berita (judul, konten, tanggal, gambar)
            VALUES ($1, $2, $3, $4)";

    pg_query_params($conn, $sql, [$judul, $konten, $tanggal, $gambar]);

    header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=BeritaTab");
    exit;

    
    case 'simpan_fasilitas': // Asumsi: Dari kondisi $action
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn,"INSERT INTO fasilitasperalatan (judul, deskripsi) VALUES ($1, $2)", [$judul, $deskripsi]);
        header("Location: ../landingAdmin.php?tab=tampilan&inner=fasilitas&msg=added");
        exit;

    case 'simpan_kegiatan': // Asumsi: Dari kondisi $action
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn, "INSERT INTO kegiatanproyek (judul, deskripsi) VALUES ($1, $2)", [$judul, $deskripsi]);

        header("Location: ../landingAdmin.php?tab=tampilan&inner=kegiatan&msg=added");
        exit;

    case 'simpan_kependidikan': // Asumsi: field unik dari data $_POST
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $q = "INSERT INTO tenaga_kependidikan (nama_pegawai, jabatan) VALUES ($1, $2)";
        pg_query_params($conn, $q, array($nama, $jabatan));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=kependidikan&msg=deleted"); // Perlu periksa kembali msg=deleted
        exit;

    case 'simpan_kuliah': // Asumsi: Dari kondisi $action
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $query = "INSERT INTO perkuliahanterkait (judul, deskripsi) VALUES ($1, $2)";
        pg_query_params($conn, $query, array($judul, $deskripsi));
        header("Location: ../landingAdmin.php?tab=tampilan&inner=kuliah&msg=updated"); // Perlu periksa kembali msg=updated
        exit;
    
    case 'simpan_pengajar': // Asumsi: field unik dari data $_POST
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $nidn = $_POST['nidn'];
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = "../uploads/" . $foto;
        move_uploaded_file($tmp, $folder);
        $q = "INSERT INTO tenaga_pengajar (nama_dosen, jabatan, nidn, foto_url) VALUES ($1, $2, $3, $4)";
        pg_query_params($conn, $q, array($nama, $jabatan, $nidn, $foto));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=tenagaPengajar&msg=pengajar_added");
        exit;

    case 'simpan_pengumuman': // Asumsi: field unik dari data $_POST
        $judul = $_POST['judul'];
        $konten = $_POST['konten'];
        $tanggal = $_POST['tanggal'];
        $gambar = $_files['gambar']['name'];
        $folder = "../img/" . $gambar;
        $sql = "INSERT INTO pengumuman (judul, konten, tanggal, gambar) VALUES ($1, $2, $3, $4)";
        pg_query_params($conn, $sql, array($judul, $konten, $tanggal, $gambar));
        header("Location: ../landingAdmin.php?tab=tampilanBerita&inner=PengumumanTab&msg=pengumuman_added");
        exit;

    case 'simpan_publikasi': // Asumsi: Dari kondisi $action
        $id_dosen = $_POST['id_dosen'];
        $jenis_publikasi = $_POST['jenis_publikasi'];
        $link_publikasi = $_POST['link_publikasi'];
        $query = "INSERT INTO publikasi (id_dosen, jenis_publikasi, link_publikasi) VALUES ($1, $2, $3)";
        $result = pg_query_params($conn, $query, array($id_dosen, $jenis_publikasi, $link_publikasi));
        header("Location: ../landingAdmin.php?tab=anggota&msg=publikasi_added"); // Redirect yang sesuai
        exit;

    case 'simpan_riset':
        $deskripsi = $_POST['deskripsi'];
        pg_query_params($conn,"INSERT INTO FokusRiset (deskripsi) VALUES ($1)",[$deskripsi]);
        header("Location: ../landingAdmin.php?tab=tampilan&inner=riset&msg=added");
        exit;

    case 'simpan_sarpras': // Asumsi: field unik dari data $_POST
        $nama = $_POST['nama'];
        $desk = $_POST['deskripsi'];
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/" . $foto);
        $q = "INSERT INTO sarana_prasarana (nama_ruangan, deskripsi, foto_url) VALUES ($1, $2, $3)";
        pg_query_params($conn, $q, array($nama, $desk, $foto));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=sarpras&msg=updated"); // Perlu periksa kembali msg=updated
        exit;

    case 'simpan_struktur': // Asumsi: field unik dari data $_POST
        $jabatan = $_POST['jabatan'];
        $nama = $_POST['nama'];
        $q = "INSERT INTO struktur_organisasi (jabatan, nama) VALUES ($1, $2)";
        pg_query_params($conn, $q, array($jabatan, $nama));
        header("Location: ../landingAdmin.php?tab=tentangKami&inner=organisasi&msg=struktur_added");
        exit;

    case 'simpan_tim': // Asumsi: Dari kondisi $action (Blok terpanjang untuk menambah dosen)
        // Logika untuk menyimpan data dosen baru
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $program_studi = $_POST['program_studi'];
        $nidn = $_POST['nidn'];
        $jabatan = $_POST['jabatan'];
        $pendidikan = $_POST['pendidikan'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $mk_ganjil = $_POST['mata_kuliah_ganjil'];
        $mk_genap = $_POST['mata_kuliah_genap'];
        
        // ... (Logika Upload Foto dan Insert Dosen/MK/Pendidikan) ...
        // Karena kode ini sangat panjang, saya biarkan di dalam case 'simpan_tim'
        
        $targetDir = "../uploads/";
        if (!file_exists($targetDir)) { mkdir($targetDir, 0777, true); }
        $fotoName = time() . "_" . basename($_FILES['foto']['name']); 
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $fotoPath = $targetDir . $fotoName;
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
             // Logic error handling
        } else if (!move_uploaded_file($fotoTmp, $fotoPath)) {
             // Logic error handling
        } else {
            $queryDosen = "INSERT INTO dosen (nama, gelar, nip, nidn, email, alamat_kantor, program_studi, jabatan, foto)
                           VALUES ('$nama', ' ', '$nip', '$nidn', '$email', '$alamat', '$program_studi', '$jabatan', '$fotoPath')";
            $resultDosen = pg_query($conn, $queryDosen);

            if ($resultDosen) {
                $id_dosen = pg_fetch_result(pg_query($conn, "SELECT currval(pg_get_serial_sequence('dosen','id_dosen'))"), 0, 0);

                // INSERT MATA KULIAH (Ganjil & Genap)
                $mk_list_ganjil = preg_split("/\r\n|\n|\r/", $mk_ganjil);
                foreach ($mk_list_ganjil as $mk) {
                    $mk = trim($mk);
                    if (!empty($mk)) { pg_query_params($conn, "INSERT INTO mata_kuliah (id_dosen, semester, nama_mk) VALUES ($1,$2,$3)", array($id_dosen,'Ganjil',$mk)); }
                }
                $mk_list_genap = preg_split("/\r\n|\n|\r/", $mk_genap);
                foreach ($mk_list_genap as $mk) {
                    $mk = trim($mk);
                    if (!empty($mk)) { pg_query_params($conn, "INSERT INTO mata_kuliah (id_dosen, semester, nama_mk) VALUES ($1,$2,$3)", array($id_dosen,'Genap',$mk)); }
                }

                // INSERT PENDIDIKAN
                $pendidikan_list = preg_split("/\r\n|\n|\r/", $pendidikan);
                foreach ($pendidikan_list as $edu) {
                    $edu = trim($edu);
                    if (!empty($edu)) {
                        $parts = array_map('trim', explode('|', $edu));
                        $jenjang = $parts[0] ?? '';
                        $jurusan = $parts[1] ?? '';
                        $universitas = $parts[2] ?? '';
                        $tahun = $parts[3] ?? '';
                        pg_query_params($conn, "INSERT INTO pendidikan (id_dosen, jenjang, jurusan, universitas, tahun) VALUES ($1,$2,$3,$4,$5)", array($id_dosen, $jenjang, $jurusan, $universitas, $tahun));
                    }
                }

                header("Location: ../landingAdmin.php?tab=anggota&msg=added");
                exit;
            } else {
                // Logic error handling
            }
        }
        break;

    default:
        // Jika tidak ada parameter yang cocok, tidak ada aksi yang dilakukan.
        break;
}

?>