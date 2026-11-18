<?php
require_once __DIR__ . "/c_auth.php";
wajib_login('admin', '../view/v_login.php');   // hanya admin
require_once __DIR__ . "/../model/m_users.php";

class c_user {
    private $model;

    public function __construct() {
        $this->model = new m_users();
    }

    public function handleRequest() {
        $aksi    = $_GET['aksi'] ?? '';
        $id_user = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($aksi == 'tambah') {
            $this->tambah();
        } elseif ($aksi == 'ubah' && $id_user) {
            $this->ubah($id_user);
        } elseif ($aksi == 'hapus' && $id_user) {
            $this->hapus($id_user);
        } else {
            header("Location: ../view/v_tampil_data_user.php");
            exit;
        }
    }

    private function tambah() {
        if (isset($_POST['submit'])) {
            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);
            $password = $_POST['password'];
            $role     = ($_POST['role'] === 'admin') ? 'admin' : 'user';

            if ($this->model->sudahAda($username, $email)) {
                header("Location: ../view/v_tampil_data_user.php?status=duplikat");
                exit;
            }
            $this->model->tambahUser($username, $email, $password, $role);
            header("Location: ../view/v_tampil_data_user.php?status=berhasil_tambah");
        } else {
            include __DIR__ . "/../view/v_tambah_data_user.php";
        }
        exit;
    }

    private function ubah($id_user) {
        if (isset($_POST['submit'])) {
            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);
            $password = $_POST['password'];   // kosong = tidak diubah
            $role     = ($_POST['role'] === 'admin') ? 'admin' : 'user';

            if ($this->model->sudahAda($username, $email, $id_user)) {
                header("Location: ../view/v_tampil_data_user.php?status=duplikat");
                exit;
            }
            $this->model->ubahUser($id_user, $username, $email, $password, $role);
            header("Location: ../view/v_tampil_data_user.php?status=berhasil_ubah");
        } else {
            $data = $this->model->getById($id_user);
            if (!$data) {
                header("Location: ../view/v_tampil_data_user.php");
                exit;
            }
            include __DIR__ . "/../view/v_ubah_data_user.php";
        }
        exit;
    }

    private function hapus($id_user) {
        // Admin tidak boleh menghapus akunnya sendiri
        if ($id_user === (int)$_SESSION['id_user']) {
            header("Location: ../view/v_tampil_data_user.php?status=tidak_bisa_hapus_diri");
            exit;
        }
        $this->model->hapusUser($id_user);
        header("Location: ../view/v_tampil_data_user.php?status=berhasil_hapus");
        exit;
    }
}

$ctrl = new c_user();
$ctrl->handleRequest();
