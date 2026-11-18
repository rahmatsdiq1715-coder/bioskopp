<?php
require_once __DIR__ . "/../controller/c_auth.php";
// Sudah login? langsung ke home sesuai role
if (isset($_SESSION['id_user'])) {
    header("Location: " . ($_SESSION['role'] === 'admin' ? 'v_home_admin.php' : 'v_home_user.php'));
    exit;
}
$pesan = ambil_pesan();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login XXI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: linear-gradient(135deg, #c9d6ff, #e2e2e2, #d9c5a0);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      background-size: 200% 200%;
      animation: bgMove 10s ease infinite;
    }

    @keyframes bgMove {
      0% { background-position: 0 0; }
      50% { background-position: 100% 100%; }
      100% { background-position: 0 0; }
    }

    .login-container {
      background: rgba(255, 255, 255, 0.9);
      padding: 45px 35px;
      border-radius: 20px;
      width: 340px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      position: relative;
      animation: fadeInUp 1s ease;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .xxi-logo {
      width: 110px;
      height: auto;
      margin-bottom: 10px;
      animation: logoFloat 3s ease-in-out infinite;
    }

    @keyframes logoFloat {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .login-container h2 {
      color: #333;
      margin-bottom: 20px;
      font-size: 22px;
      font-weight: 600;
      animation: fadeIn 1.5s ease;
    }

    .input-group {
      position: relative;
      margin-bottom: 18px;
      animation: slideIn 1s ease;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateX(-30px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .input-group input {
      width: 100%;
      padding: 10px 40px 10px 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
      outline: none;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .input-group input:focus {
      border-color: #d4af37;
      box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
    }

    .input-group i {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      cursor: pointer;
      transition: color 0.3s;
    }

    .input-group i:hover {
      color: #d4af37;
    }

    .login-container button {
      width: 100%;
      padding: 10px;
      background: linear-gradient(to right, #d4af37, #f1d97c);
      border: none;
      color: #333;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .login-container button:hover {
      background: linear-gradient(to right, #b89625, #e0c766);
      transform: scale(1.03);
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      margin-top: 10px;
      animation: fadeIn 1.8s ease;
    }

    .options a {
      text-decoration: none;
      color: #007bff;
      transition: color 0.3s;
    }

    .options a:hover {
      color: #0056b3;
    }

    .sukses { color: #198754; font-size: 13px; margin-bottom: 10px; }

    .error {
      color: red;
      font-size: 13px;
      margin-bottom: 10px;
      animation: shake 0.5s ease;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-10px); }
      40%, 80% { transform: translateX(10px); }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <img src="../assets/img/logo_xxi.png" alt="XXI Logo" class="xxi-logo">
    <h2>Halaman Login</h2>

    <?php if ($pesan): ?>
      <div class="<?= $pesan['tipe'] === 'success' ? 'sukses' : 'error' ?>"><?= e($pesan['teks']) ?></div>
    <?php endif; ?>

    <form method="POST" action="../controller/c_login.php?aksi=proses_login">
      <div class="input-group">
        <input type="text" name="username" placeholder="Username atau email" required>
        <i class="fa fa-user" style="pointer-events:none"></i>
      </div>

      <div class="input-group">
        <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" required>
        <i class="fa fa-eye" id="togglePassword"></i>
      </div>

      <div class="options">
        <label><input type="checkbox" onclick="showPassword()"> Tampilkan sandi</label>
        <a href="v_aksi_lupa_sandi.php">Lupa Password?</a>
      </div>

      <button type="submit" name="login">Masuk</button>
    </form>

    <p style="margin-top:15px; font-size:12px; color:#777;">
      © 2025 XXI | Desain oleh Siapa ya ✨
    </p>
    <p style="margin-top:5px; font-size:13px;">Belum punya akun? <a href="v_register.php" style="color:#007bff;text-decoration:none;">Daftar</a></p>
  </div>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });

    function showPassword() {
      const pwd = document.getElementById("password");
      pwd.type = (pwd.type === "password") ? "text" : "password";
    }
  </script>

</body>
</html>