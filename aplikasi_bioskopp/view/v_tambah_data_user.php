<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah User</title>
  <style>
    body {
      background: linear-gradient(120deg, #1e3c72, #2a5298);
      font-family: 'Poppins', sans-serif;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .form-box {
      background: rgba(255,255,255,0.1);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.4);
      width: 350px;
      animation: slideIn 0.8s ease;
    }
    @keyframes slideIn {
      from {opacity: 0; transform: translateY(50px);}
      to {opacity: 1; transform: translateY(0);}
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      outline: none;
    }
    button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 8px;
      background: #00b894;
      color: white;
      font-size: 15px;
      cursor: pointer;
    }
    button:hover { background: #019874; }
    a { color: #fff; text-decoration: none; display: block; text-align: center; margin-top: 10px; }
  </style>
</head>
<body>
  <form class="form-box" method="POST" action="../controller/c_user.php?aksi=tambah">
    <h2>Tambah User</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role" required>
      <option value="">-- Pilih Role --</option>
      <option value="admin">Admin</option>
      <option value="user">User</option>
    </select>
    <button type="submit" name="submit">Simpan</button>
    <a href="../controller/c_user.php">Kembali</a>
  </form>
</body>
</html>