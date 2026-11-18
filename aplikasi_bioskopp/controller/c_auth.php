<?php
// Helper session & proteksi halaman (dipakai semua view/controller)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Escape output supaya aman dari XSS
function e($teks) {
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}

// Wajib login. $role = 'admin' / 'user' / null (bebas). $loginUrl beda untuk view & controller.
function wajib_login($role = null, $loginUrl = 'v_login.php') {
    if (!isset($_SESSION['id_user'])) {
        header("Location: $loginUrl");
        exit;
    }
    if ($role !== null && $_SESSION['role'] !== $role) {
        // Role tidak cocok -> kembalikan ke halaman home miliknya
        $home = ($_SESSION['role'] === 'admin') ? 'v_home_admin.php' : 'v_home_user.php';
        header("Location: " . (strpos($loginUrl, '../') === 0 ? '../view/' : '') . $home);
        exit;
    }
}

// Ambil pesan flash (sekali tampil)
function ambil_pesan() {
    $pesan = $_SESSION['pesan'] ?? null;
    unset($_SESSION['pesan']);
    return $pesan;
}

function set_pesan($tipe, $teks) {
    $_SESSION['pesan'] = ['tipe' => $tipe, 'teks' => $teks];
}

// Render alert Bootstrap dari pesan flash (kosong jika tidak ada)
function render_pesan() {
    $p = ambil_pesan();
    if (!$p) return '';
    $kelas = ($p['tipe'] === 'success') ? 'alert-success' : 'alert-danger';
    return "<div class='alert $kelas text-center' role='alert'>" . e($p['teks']) . "</div>";
}
