<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('user');

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home User XXI Bioskop</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      padding-top: 80px;
      background: linear-gradient(135deg, #141e30, #243b55);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    .welcome-box {
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 215, 0, 0.5);
      border-radius: 20px;
      padding: 50px;
      text-align: center;
      max-width: 700px;
      margin: 80px auto;
      box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
    }

    .welcome-box h2 {
      color: #ffd700;
      text-shadow: 0 0 10px rgba(255, 215, 0, 0.7);
    }

    .welcome-box p {
      color: #e6e6e6;
      font-size: 1.1rem;
    }

    .glow {
      text-shadow: 0 0 10px #ffd700, 0 0 20px #ffae00;
    }

    .btn-pesan {
      background: linear-gradient(135deg, #ffcc00, #ff9900);
      color: #000;
      font-weight: bold;
      border: none;
      padding: 12px 24px;
      border-radius: 10px;
      margin-top: 15px;
      transition: 0.3s;
    }

    .btn-pesan:hover {
      background: linear-gradient(135deg, #ffb700, #ffaa00);
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
    }

html, body {
height: 100%;
}

body {
display: flex;
flex-direction: column;
}

footer {
margin-top: auto;
background: #000;
color: #aaa;
text-align: center;
padding: 12px;
font-size: 0.9rem;
border-top: 1px solid rgba(255, 215, 0, 0.2);
}
  </style>
</head>
<body>

<?php include_once 'v_navbar_user.php'?>

<!-- Konten Selamat Datang -->
<div class="welcome-box animate__animated animate__fadeInUp">
  <h2 class="glow">Selamat Datang, <?= e(ucfirst($username)) ?> 👋</h2>
  <p>Senang melihatmu kembali di <b>XXI Bioskop</b>!<br>
     Pilih film favoritmu dan nikmati pengalaman menonton terbaik 🎬</p>
  <a href="v_daftar_film.php" class="btn btn-pesan">🎟️ Pesan Tiket Sekarang</a>
</div>

<footer>
  © <?= date('Y'); ?> XXI Bioskop | Dibuat oleh <b>Eka, Rahmat, Shintia</b> ✨
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>