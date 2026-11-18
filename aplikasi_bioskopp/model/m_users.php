<?php
require_once __DIR__ . "/m_koneksi.php";

class m_users {
    private $conn;

    public function __construct() {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }

    public function tampil() {
        $result = $this->conn->query("SELECT * FROM users ORDER BY id_user ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id_user) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Login: boleh pakai username atau email
    public function cekLogin($identitas, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
        $stmt->bind_param("ss", $identitas, $identitas);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if (!$user) {
            return ['user' => false, 'pesan' => 'Username atau email tidak ditemukan!'];
        }
        if (!password_verify($password, $user['password'])) {
            return ['user' => false, 'pesan' => 'Password salah!'];
        }
        return ['user' => $user, 'pesan' => ''];
    }

    // true jika username/email sudah dipakai user lain
    public function sudahAda($username, $email, $kecualiId = 0) {
        $stmt = $this->conn->prepare(
            "SELECT id_user FROM users WHERE (username = ? OR email = ?) AND id_user <> ? LIMIT 1"
        );
        $stmt->bind_param("ssi", $username, $email, $kecualiId);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function emailTerdaftar($email) {
        $stmt = $this->conn->prepare("SELECT id_user FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function tambahUser($username, $email, $password, $role, $foto = null) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, email, password, role, foto) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $username, $email, $hash, $role, $foto);
        return $stmt->execute();
    }

    // Password kosong = password lama tidak diubah
    public function ubahUser($id_user, $username, $email, $password, $role) {
        if ($password !== '') {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare(
                "UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE id_user = ?"
            );
            $stmt->bind_param("ssssi", $username, $email, $hash, $role, $id_user);
        } else {
            $stmt = $this->conn->prepare(
                "UPDATE users SET username = ?, email = ?, role = ? WHERE id_user = ?"
            );
            $stmt->bind_param("sssi", $username, $email, $role, $id_user);
        }
        return $stmt->execute();
    }

    public function resetPasswordByEmail($email, $passwordBaru) {
        $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hash, $email);
        return $stmt->execute();
    }

    public function hapusUser($id_user) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        return $stmt->execute();
    }
}
