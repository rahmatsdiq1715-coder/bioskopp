<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah User</title>
  <style>
    body {
      background: linear-gradient(120deg, #2b5876, #4e4376);
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
    }
    h2 { text-align: center; margin-bottom: 20px; }
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
      background: #0984e3;
      color: white;
      font-size: 15px;
      cursor: pointer;
    }
    button:hover { background: #0872c4; }
    a { color: #fff; text-decoration: none; display: block; text-align: center; margin-top: 10px; }
  </style>
</head>
<body>
  <form class="form-box" method="POST" action="../controller/c_user.php?aksi=ubah&id=<?= (int)$data['id_user']; ?>">
    <h2>Ubah User</h2>
    <input type="text" name="username" value="<?= e($data['username']); ?>" required>
    <input type="email" name="email" value="<?= e($data['email']); ?>" required>
    <input type="password" name="password" placeholder="Password baru (kosongkan jika tidak diganti)">
    <select name="role" required>
      <option value="admin" <?= $data['role']=='admin'?'selected':''; ?>>Admin</option>
      <option value="user" <?= $data['role']=='user'?'selected':''; ?>>User</option>
    </select>
    <button type="submit" name="submit">Ubah</button>
    <a href="../controller/c_user.php">Kembali</a>
  </form>
</body>
</html>