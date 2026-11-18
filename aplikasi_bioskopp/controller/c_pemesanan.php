<?php
require_once __DIR__ . "/c_auth.php";
require_once __DIR__ . "/../model/m_pemesanan.php";
require_once __DIR__ . "/../model/m_film.php";

class c_pemesanan {
    private $model;

    public function __construct() {
        $this->model = new m_pemesanan();
    }

    public function tampil() {
        return $this->model->tampil();
    }

    public function tampilByUser($id_user) {
        return $this->model->tampilByUser($id_user);
    }

    public function simpan() {
        wajib_login('user', '../view/v_login.php');

        $judul   = trim($_POST['judul'] ?? '');
        $bioskop = trim($_POST['bioskop'] ?? '');
        $tanggal = trim($_POST['tanggal'] ?? '');
        $jam     = trim($_POST['jam'] ?? '');
        $jumlah  = (int)($_POST['jumlah'] ?? 0);
        $kursiIn = strtoupper(trim($_POST['kursi'] ?? ''));

        $kembali = "../view/v_pesanan_tiket.php?judul=" . urlencode($judul);
        $film    = new m_film();

        if (!$film->ada($judul)) {
            return $this->gagal("Film tidak ditemukan!", $kembali);
        }
        if (!in_array($bioskop, m_pemesanan::$daftar_bioskop, true)) {
            return $this->gagal("Bioskop tidak valid!", $kembali);
        }
        if (!in_array($jam, m_pemesanan::$daftar_jam, true)) {
            return $this->gagal("Jadwal tayang tidak valid!", $kembali);
        }
        $tgl = DateTime::createFromFormat('Y-m-d', $tanggal);
        if (!$tgl || $tgl->format('Y-m-d') !== $tanggal || $tanggal < date('Y-m-d')) {
            return $this->gagal("Tanggal tidak valid atau sudah lewat!", $kembali);
        }
        if ($jumlah < 1 || $jumlah > 10) {
            return $this->gagal("Jumlah tiket harus 1 - 10!", $kembali);
        }

        // Kursi: contoh "A1, A2" (baris A-J, nomor 1-12)
        $daftarKursi = array_values(array_unique(preg_split('/[\s,]+/', $kursiIn, -1, PREG_SPLIT_NO_EMPTY)));
        foreach ($daftarKursi as $k) {
            if (!preg_match('/^[A-J](1[0-2]|[1-9])$/', $k)) {
                return $this->gagal("Format kursi '$k' salah. Gunakan contoh: A1, A2 (baris A-J, nomor 1-12).", $kembali);
            }
        }
        if (count($daftarKursi) !== $jumlah) {
            return $this->gagal("Jumlah kursi harus sama dengan jumlah tiket ($jumlah).", $kembali);
        }

        $terpakai = $this->model->kursiTerpakai($judul, $bioskop, $tanggal, $jam . ':00');
        $bentrok  = array_intersect($daftarKursi, $terpakai);
        if ($bentrok) {
            return $this->gagal("Kursi " . implode(', ', $bentrok) . " sudah dipesan orang lain.", $kembali);
        }

        $ok = $this->model->simpan(
            (int)$_SESSION['id_user'], $judul, $bioskop, $tanggal, $jam . ':00',
            implode(', ', $daftarKursi), $jumlah
        );

        if ($ok) {
            set_pesan('success', 'Tiket berhasil dipesan! 🎟️');
            header("Location: ../view/v_riwayat.php");
        } else {
            return $this->gagal("Gagal menyimpan pemesanan, coba lagi.", $kembali);
        }
        exit;
    }

    public function hapus($id) {
        wajib_login('admin', '../view/v_login.php');
        $this->model->hapus((int)$id);
        set_pesan('success', 'Data pemesanan berhasil dihapus.');
        header("Location: ../view/v_riwayat_pesanan_user.php");
        exit;
    }

    private function gagal($teks, $kembali) {
        set_pesan('error', $teks);
        header("Location: $kembali");
        exit;
    }
}

// Jalankan aksi hanya jika file ini dipanggil langsung (bukan di-include oleh view)
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $ctrl = new c_pemesanan();
    $aksi = $_GET['aksi'] ?? '';
    if ($aksi === 'simpan' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $ctrl->simpan();
    } elseif ($aksi === 'hapus' && isset($_GET['id'])) {
        $ctrl->hapus($_GET['id']);
    } else {
        header("Location: ../view/v_login.php");
        exit;
    }
}
