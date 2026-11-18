<?php
class m_koneksi {
    // Sesuaikan dengan server lokal kamu (XAMPP default: root & password kosong)
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "db_bioskop";

    public $koneksi;

    public function __construct() {
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->koneksi = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->koneksi->connect_error) {
            die("Koneksi database gagal: " . $this->koneksi->connect_error);
        }
        $this->koneksi->set_charset("utf8mb4");
    }

    public function hubungkan() {
        return $this->koneksi;
    }
}
