<?php
require_once __DIR__ . "/../controller/c_auth.php";
// Jika sudah login, langsung ke home sesuai role
if (isset($_SESSION['id_user'])) {
    header("Location: " . ($_SESSION['role'] === 'admin' ? 'v_home_admin.php' : 'v_home_user.php'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Home | XXI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      min-height: 100vh;
      overflow-x: hidden;
      font-family: 'Poppins', sans-serif;
    }

    /* Navbar style */
    .navbar {
      background: linear-gradient(90deg, #0d6efd, #6610f2);
    }

    /* Hero section */
    .hero {
      background: linear-gradient(135deg, #0d6efd, #6610f2);
      color: white;
      padding: 100px 20px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      margin-top: 80px;
      animation: fadeInDown 1s ease forwards;
    }

    .hero h1 {
      font-weight: 700;
      letter-spacing: 1px;
    }

    .hero p {
      margin-top: 10px;
      font-size: 1.1rem;
      opacity: 0.9;
    }

    /* Section bawah */
    .content {
      text-align: center;
      margin-top: 60px;
      animation: fadeIn 1.5s ease forwards;
    }

    .content p {
      font-size: 1.1rem;
      margin-bottom: 25px;
      color: #333;
    }

    .btn-primary {
      background: linear-gradient(90deg, #0d6efd, #6610f2);
      border: none;
      padding: 12px 30px;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }

    footer {
      text-align: center;
      margin-top: 80px;
      padding: 20px 0;
      font-size: 0.9rem;
      color: #666;
    }

    /* Animasi */
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>

<?php include __DIR__ . '/v_navbar_awal.php'; ?>

<div class="container">
  <div class="hero" style="margin-top:100px">
    <h1 class="display-5 fw-bold">🎬 Selamat Datang di XXI Bioskop</h1>
    <p class="lead">Nikmati pengalaman menonton terbaik dan pesan tiket film favoritmu dengan mudah.</p>
  </div>

  <div class="content">
    <a href="v_login.php" class="btn btn-primary btn-lg">Login Sekarang</a>
  </div>
</div>

<footer>
  © <?= date('Y'); ?> XXI Cinema | Semua Hak Dilindungi
</footer>

</body>
</html>