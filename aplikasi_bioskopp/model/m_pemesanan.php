<?php
require_once __DIR__ . "/m_koneksi.php";

class m_pemesanan {
    private $conn;

    // Pilihan yang dipakai form & validasi
    public static $daftar_bioskop = ['XXI Central Mall', 'XXI City Plaza', 'XXI Grand Square'];
    public static $daftar_jam     = ['10:00', '13:00', '16:00', '19:00', '21:30'];

    public function __construct() {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }

    public function tampil() {
        $sql = "SELECT p.id_pemesanan, u.username AS nama_user, p.judul_film, p.bioskop,
                       p.tanggal, p.jam, p.kursi
                FROM tb_pemesanan p
                JOIN users u ON p.id_user = u.id_user
                ORDER BY p.id_pemesanan DESC";
        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function tampilByUser($id_user) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM tb_pemesanan WHERE id_user = ? ORDER BY id_pemesanan DESC"
        );
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Daftar kursi yang sudah dipesan untuk satu jadwal
    public function kursiTerpakai($judul, $bioskop, $tanggal, $jam) {
        $stmt = $this->conn->prepare(
            "SELECT kursi FROM tb_pemesanan
             WHERE judul_film = ? AND bioskop = ? AND tanggal = ? AND jam = ?"
        );
        $stmt->bind_param("ssss", $judul, $bioskop, $tanggal, $jam);
        $stmt->execute();
        $terpakai = [];
        foreach ($stmt->get_result()->fetch_all(MYSQLI_ASSOC) as $row) {
            foreach (preg_split('/[\s,]+/', $row['kursi'], -1, PREG_SPLIT_NO_EMPTY) as $k) {
                $terpakai[] = strtoupper($k);
            }
        }
        return $terpakai;
    }

    public function simpan($id_user, $judul, $bioskop, $tanggal, $jam, $kursi, $jumlah) {
        $stmt = $this->conn->prepare(
            "INSERT INTO tb_pemesanan (id_user, judul_film, bioskop, tanggal, jam, kursi, jumlah)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("isssssi", $id_user, $judul, $bioskop, $tanggal, $jam, $kursi, $jumlah);
        return $stmt->execute();
    }

    public function hapus($id) {
        $stmt = $this->conn->prepare("DELETE FROM tb_pemesanan WHERE id_pemesanan = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
