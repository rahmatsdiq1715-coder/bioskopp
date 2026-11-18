<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hapus User</title>
  <style>
    body {
      background: linear-gradient(135deg, #ff4e50, #f9d423);
      font-family: 'Poppins', sans-serif;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .confirm-box {
      background: rgba(255,255,255,0.1);
      padding: 40px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
      animation: popIn 0.6s ease;
    }
    @keyframes popIn {
      from {transform: scale(0.8); opacity: 0;}
      to {transform: scale(1); opacity: 1;}
    }
    button, a {
      margin: 10px;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      color: white;
      text-decoration: none;
      font-weight: 500;
    }
    .btn-ya { background: #e84118; }
    .btn-tidak { background: #00a8ff; }
  </style>
</head>
<body>
  <div class="confirm-box">
    <h2>Apakah Anda yakin ingin menghapus user ini?</h2>
    <a href="../controller/c_user.php?aksi=hapus&id=<?= (int)($_GET['id'] ?? 0); ?>" class="btn-ya">Ya, Hapus</a>
    <a href="../controller/c_user.php" class="btn-tidak">Batal</a>
  </div>
</body>
</html>