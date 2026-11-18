<?php
require_once __DIR__ . "/../controller/c_auth.php";
$pesan = ambil_pesan();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Kata Sandi | XXI Bioskop</title>
  <style>
    /* ======== STYLE DASAR ======== */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #000000, #1a1a1a);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      padding: 20px;
    }

    /* ======== KONTENER UTAMA ======== */
    .container {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 16px;
      padding: 40px 30px;
      max-width: 400px;
      width: 100%;
      text-align: center;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
      animation: fadeIn 1s ease-in-out;
    }

    /* ======== LOGO ======== */
    .logo {
      width: 180px;
      margin-bottom: 25px;
      animation: slideDown 0.8s ease-in-out;
    }

    /* ======== JUDUL ======== */
    h2 {
      font-size: 22px;
      margin-bottom: 10px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    p {
      font-size: 14px;
      margin-bottom: 25px;
      color: #ccc;
    }

    /* ======== FORM ======== */
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      outline: none;
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      font-size: 14px;
      margin-bottom: 15px;
      transition: 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      background: rgba(255, 255, 255, 0.25);
      box-shadow: 0 0 10px #ffcc00;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #ffcc00;
      border: none;
      border-radius: 8px;
      color: #000;
      font-weight: 600;
      cursor: pointer;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    button:hover {
      background: #ffd633;
      transform: translateY(-2px);
      box-shadow: 0 0 10px #ffd633;
    }

    .back {
      display: inline-block;
      margin-top: 20px;
      font-size: 14px;
      color: #ffcc00;
      text-decoration: none;
      transition: 0.3s;
    }

    .back:hover {
      color: #ffd633;
      text-decoration: underline;
    }

    /* ======== ANIMASI ======== */
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideDown {
      from { transform: translateY(-30px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="../assets/img/logo_xxi.png" alt="Logo XXI" class="logo">
    <h2>Lupa Kata Sandi</h2>
    <p>Masukkan email akunmu yang terdaftar, lalu buat kata sandi baru.</p>

    <?php if ($pesan): ?>
      <div style="margin-bottom:15px;padding:10px;border-radius:8px;font-size:14px;background:<?= $pesan['tipe'] === 'success' ? '#198754' : '#dc3545' ?>;"><?= e($pesan['teks']) ?></div>
    <?php endif; ?>

    <form action="../controller/c_login.php?aksi=proses_lupa" method="POST">
      <input type="email" name="email" placeholder="Masukkan email terdaftar" required>
      <input type="password" name="password" placeholder="Kata sandi baru (min. 6 karakter)" minlength="6" required>
      <input type="password" name="ulangi_password" placeholder="Ulangi kata sandi baru" minlength="6" required>
      <button type="submit">Ubah Kata Sandi</button>
    </form>

    <a href="v_login.php" class="back">← Kembali ke Halaman Login</a>
  </div>
</body>
</html>