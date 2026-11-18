<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('user');
require_once __DIR__ . "/../model/m_film.php";
$films = (new m_film())->tampil();
include __DIR__ . "/v_navbar_user.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Film XXI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 80px;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .judul-halaman {
      text-align: center;
      color: #ffd700;
      text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
      margin-bottom: 40px;
    }

    .film-card {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,215,0,0.3);
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .film-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 0 20px rgba(255,215,0,0.4);
    }

    .film-card img {
      width: 100%;
      height: 340px;
      object-fit: cover;
    }

    .film-info {
      padding: 15px;
      text-align: center;
    }

    .film-info h5 {
      color: #ffd700;
      margin-bottom: 10px;
    }

    .film-info p {
      font-size: 0.9rem;
      color: #ccc;
      min-height: 60px;
    }

    .poster-kosong {
      height: 340px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 20px;
      text-align: center;
      font-size: 3rem;
      background: linear-gradient(135deg, #1a1a1a, #3a3a3a);
    }
    .poster-kosong span { font-size: 1rem; color: #ffd700; font-weight: 600; }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2 class="judul-halaman">🎬 Daftar Film Tersedia</h2>
  <div class="row g-4">
    <?php
    foreach ($films as $film) {
      $posterPath = "../assets/img/" . $film['poster'];
      $adaPoster  = !empty($film['poster']) && file_exists(__DIR__ . "/" . $posterPath);
      echo "<div class='col-md-3 col-sm-6'><div class='film-card'>";
      if ($adaPoster) {
        echo "<img src='" . e($posterPath) . "' alt='" . e($film['judul']) . "'>";
      } else {
        echo "<div class='poster-kosong'>🎬<span>" . e($film['judul']) . "</span></div>";
      }
      echo "<div class='film-info'>
              <h5>" . e($film['judul']) . "</h5>
              <p>" . e($film['deskripsi']) . "</p>
              <a href='v_pesanan_tiket.php?judul=" . urlencode($film['judul']) . "' class='btn btn-warning btn-sm'>Pesan Tiket</a>
            </div></div></div>";
    }
    if (empty($films)) {
      echo "<p class='text-center text-secondary'>Belum ada film yang tersedia.</p>";
    }
    ?>
  </div>
</div>


</body>
</html>