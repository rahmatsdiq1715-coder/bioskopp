<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('admin');

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Admin XXI Bioskop</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      padding-top: 80px;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
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

    .glow {
      text-shadow: 0 0 10px #ffd700, 0 0 20px #ffae00;
    }

    .logout-btn {
      color: #ff4d4d !important;
    }

    .logout-btn:hover {
      color: #fff !important;
      background: #ff4d4d;
    }
  </style>
</head>
<body>

<?php include "v_navbar.php"; ?>

<!-- Konten Selamat Datang -->
<div class="welcome-box animate__animated animate__fadeInUp">
  <h2 class="glow">Selamat Datang, <?= e(ucfirst($username)) ?> 👋</h2>
  <p>Anda berhasil login sebagai <b>Admin XXI Bioskop</b>.<br>
     Silakan gunakan menu di atas untuk mengelola data user dan tiket 🎬</p>
</div>

<footer>
  © <?= date('Y'); ?> XXI Bioskop | Dibuat oleh <b>Eka, Rahmat, Shintia</b> ✨
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>