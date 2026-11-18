<?php
require_once __DIR__ . "/m_koneksi.php";

class m_film {
    private $conn;

    public function __construct() {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }

    public function tampil() {
        $result = $this->conn->query("SELECT * FROM film ORDER BY id_film ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ada($judul) {
        $stmt = $this->conn->prepare("SELECT id_film FROM film WHERE judul = ? LIMIT 1");
        $stmt->bind_param("s", $judul);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
}
