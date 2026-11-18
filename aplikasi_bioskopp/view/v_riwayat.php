<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('user');

$username = $_SESSION['username'];
$id_user  = (int)$_SESSION['id_user'];

// include controller pemesanan
require_once __DIR__ . "/../controller/c_pemesanan.php";
$ctrl = new c_pemesanan();
$dataPemesanan = $ctrl->tampilByUser($id_user); // ambil data khusus user yang login
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pemesanan | XXI Bioskop</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      padding-top: 80px;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.9);
      box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
    }

    .navbar-brand {
      color: #ffd700 !important;
      font-weight: bold;
    }

    .riwayat-box {
      background: rgba(255,255,255,0.1);
      border: 2px solid rgba(255,215,0,0.5);
      border-radius: 20px;
      padding: 40px;
      margin: 50px auto;
      max-width: 900px;
      box-shadow: 0 0 20px rgba(255,215,0,0.2);
    }

    .riwayat-item {
      background: rgba(255,255,255,0.08);
      border-radius: 15px;
      padding: 15px 20px;
      margin-bottom: 15px;
      transition: all 0.3s;
    }

    .riwayat-item:hover {
      background: rgba(255,255,255,0.18);
      transform: translateY(-3px);
    }

    .badge {
      background: #ffd700;
      color: #000;
      font-weight: 600;
    }

  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">🎬 XXI Bioskop</a>
    <div>
      <a href="v_home_user.php" class="btn btn-warning btn-sm fw-bold">Home</a>
      <a href="v_daftar_film.php" class="btn btn-outline-light btn-sm fw-bold">Daftar Film</a>
      <a href="v_logout.php" class="btn btn-outline-danger btn-sm fw-bold">Logout</a>
    </div>
  </div>
</nav>

<!-- KONTEN -->
<div class="riwayat-box">
  <h3 class="text-center text-warning mb-4">
    <i class="bi bi-clock-history"></i> Riwayat Pemesanan Tiket
  </h3>
  <p class="text-center text-light mb-4">
    Halo <b><?= e(ucfirst($username)) ?></b>! Berikut tiket yang pernah kamu pesan 🎟️
  </p>

  <?= render_pesan() ?>

  <?php
  if (!empty($dataPemesanan)) {
    foreach ($dataPemesanan as $tiket) {
      echo "
      <div class='riwayat-item'>
        <div class='d-flex justify-content-between align-items-center'>
          <div>
            <h5 class='text-warning mb-1'>" . e($tiket['judul_film']) . "</h5>
            <small>" . e($tiket['bioskop']) . " | " . date('d M Y', strtotime($tiket['tanggal'])) . " | " . substr($tiket['jam'], 0, 5) . "</small>
          </div>
          <span class='badge'>Kursi " . e($tiket['kursi']) . "</span>
        </div>
      </div>";
    }
  } else {
    echo "<p class='text-center text-secondary'>Kamu belum pernah memesan tiket.</p>";
  }
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>