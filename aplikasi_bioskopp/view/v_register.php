<?php
require_once __DIR__ . "/../controller/c_auth.php";
$pesan = ambil_pesan();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun XXI</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
    * {
        transition: all 0.3s ease;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #007bff, #6610f2);
        background-size: 200% 200%;
        animation: gradientShift 6s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .register-container {
        width: 370px;
        background: rgba(255, 255, 255, 0.95);
        padding: 35px 30px 40px;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.2);
        text-align: center;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .profile-pic-container {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto 20px;
    }

    .profile-pic {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #007bff;
        box-shadow: 0 5px 15px rgba(0,123,255,0.4);
    }

    .upload-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #007bff;
        border-radius: 50%;
        padding: 7px;
        cursor: pointer;
        border: 2px solid #fff;
    }

    .upload-icon i {
        color: white;
        font-size: 16px;
    }

    .form-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #333;
    }

    .form-group {
        position: relative;
        margin-bottom: 22px;
        text-align: left;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1.5px solid #ccc;
        border-radius: 10px;
        outline: none;
        font-size: 15px;
        background: #fdfdfd;
    }

    .form-group label {
        position: absolute;
        top: 12px;
        left: 15px;
        color: #777;
        font-size: 14px;
        transition: 0.3s ease;
        pointer-events: none;
        background: #fff;
    }

    .form-group input:focus + label,
    .form-group input:valid + label {
        top: -8px;
        left: 10px;
        font-size: 12px;
        color: #007bff;
        background: #fff;
        padding: 0 5px;
    }

    .form-group input:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0,123,255,0.4);
        transform: scale(1.02);
    }

    .submit-button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        font-size: 17px;
        cursor: pointer;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(32, 201, 151, 0.6); }
        70% { box-shadow: 0 0 0 10px rgba(32, 201, 151, 0); }
        100% { box-shadow: 0 0 0 0 rgba(32, 201, 151, 0); }
    }

    .submit-button:hover {
        background: linear-gradient(135deg, #20c997, #28a745);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(32,201,151,0.5);
    }

    .login-link {
        margin-top: 18px;
        font-size: 14px;
        color: #555;
    }

    .login-link a {
        color: #007bff;
        font-weight: bold;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<?php include_once __DIR__ . '/v_navbar_awal.php'; ?>

<div class="register-container">

    <div class="profile-pic-container">
        <img src="../assets/img/default_profile.png" id="previewImage" class="profile-pic" alt="Profile">
        <label class="upload-icon" for="profileImage"><i class="bi bi-camera-fill"></i></label>
        <input type="file" id="profileImage" name="foto" accept=".jpg,.jpeg,.png" form="formRegister" style="display:none;">
    </div>

    <h2 class="form-title">Daftar Akun</h2>

    <?php if ($pesan): ?>
        <div style="margin-bottom:15px;padding:10px;border-radius:8px;font-size:14px;color:#fff;background:<?= $pesan['tipe'] === 'success' ? '#198754' : '#dc3545' ?>;"><?= e($pesan['teks']) ?></div>
    <?php endif; ?>

    <form id="formRegister" method="POST" action="../controller/c_login.php?aksi=proses_register" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" id="name" name="nama" required>
            <label for="name">Nama Lengkap</label>
        </div>

        <div class="form-group">
            <input type="email" id="email" name="email" required>
            <label for="email">Email</label>
        </div>

        <div class="form-group">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
        </div>

        <div class="form-group">
            <input type="password" id="confirm-password" name="ulangi_password" required>
            <label for="confirm-password">Ulangi Password</label>
        </div>

        <button type="submit" class="submit-button">Daftar Akun</button>
    </form>

    <p class="login-link">
        Sudah punya akun? <a href="v_login.php">Login di sini</a>
    </p>
</div>

<script>
    const inputFile = document.getElementById('profileImage');
    const previewImage = document.getElementById('previewImage');

    inputFile.addEventListener('change', function(){
        const file = this.files[0];
        if (file){
            const reader = new FileReader();
            reader.onload = e => previewImage.src = e.target.result;
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>