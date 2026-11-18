<?php
require_once __DIR__ . "/c_auth.php";
require_once __DIR__ . "/../model/m_users.php";

$model = new m_users();
$aksi  = $_GET['aksi'] ?? '';

// ============ LOGIN ============
if ($aksi === 'proses_login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $identitas = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';

    $hasil = $model->cekLogin($identitas, $password);

    if ($hasil['user']) {
        $u = $hasil['user'];
        session_regenerate_id(true);
        $_SESSION['id_user']  = $u['id_user'];
        $_SESSION['username'] = $u['username'];
        $_SESSION['role']     = $u['role'];
        $_SESSION['foto']     = $u['foto'];

        header("Location: ../view/" . ($u['role'] === 'admin' ? 'v_home_admin.php' : 'v_home_user.php'));
    } else {
        set_pesan('error', $hasil['pesan']);
        header("Location: ../view/v_login.php");
    }
    exit;
}

// ============ REGISTER ============
if ($aksi === 'proses_register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $ulangi   = $_POST['ulangi_password'] ?? '';
    $foto     = $_FILES['foto'] ?? null;

    $kembali = "../view/v_register.php";

    if ($nama === '' || $email === '' || $password === '' || $ulangi === '') {
        set_pesan('error', 'Semua field harus diisi!');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_pesan('error', 'Format email tidak valid!');
    } elseif ($password !== $ulangi) {
        set_pesan('error', 'Password dan konfirmasi tidak sama!');
    } elseif (strlen($password) < 6) {
        set_pesan('error', 'Password minimal 6 karakter!');
    } elseif ($model->sudahAda($nama, $email)) {
        set_pesan('error', 'Username atau email sudah digunakan!');
    } else {
        $nama_file = null;

        if ($foto && $foto['error'] === UPLOAD_ERR_OK) {
            $ekstensi = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
            if (!in_array($ekstensi, ['jpg', 'jpeg', 'png'], true) || !@getimagesize($foto['tmp_name'])) {
                set_pesan('error', 'Format foto tidak didukung! Hanya JPG, JPEG, atau PNG.');
                header("Location: $kembali"); exit;
            }
            if ($foto['size'] > 2 * 1024 * 1024) {
                set_pesan('error', 'Ukuran foto maksimal 2 MB!');
                header("Location: $kembali"); exit;
            }
            $folder = __DIR__ . "/../assets/uploads/";
            if (!is_dir($folder)) mkdir($folder, 0777, true);
            $nama_file = uniqid('user_') . '.' . $ekstensi;
            move_uploaded_file($foto['tmp_name'], $folder . $nama_file);
        }

        if ($model->tambahUser($nama, $email, $password, 'user', $nama_file)) {
            set_pesan('success', 'Pendaftaran berhasil! Silakan login.');
            header("Location: ../view/v_login.php"); exit;
        }
        set_pesan('error', 'Gagal mendaftar, coba lagi.');
    }
    header("Location: $kembali");
    exit;
}

// ============ LUPA SANDI ============
// Catatan: versi sederhana (tanpa kirim email) -> password diganti langsung jika email terdaftar.
if ($aksi === 'proses_lupa' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email  = trim($_POST['email'] ?? '');
    $baru   = $_POST['password'] ?? '';
    $ulangi = $_POST['ulangi_password'] ?? '';

    if ($baru !== $ulangi) {
        set_pesan('error', 'Password dan konfirmasi tidak sama!');
    } elseif (strlen($baru) < 6) {
        set_pesan('error', 'Password minimal 6 karakter!');
    } elseif (!$model->emailTerdaftar($email)) {
        set_pesan('error', 'Email tidak terdaftar!');
    } else {
        $model->resetPasswordByEmail($email, $baru);
        set_pesan('success', 'Password berhasil diubah. Silakan login.');
        header("Location: ../view/v_login.php"); exit;
    }
    header("Location: ../view/v_aksi_lupa_sandi.php");
    exit;
}

// ============ LOGOUT ============
if ($aksi === 'logout') {
    session_unset();
    session_destroy();
    header("Location: ../view/v_login.php");
    exit;
}

header("Location: ../view/v_login.php");
exit;
