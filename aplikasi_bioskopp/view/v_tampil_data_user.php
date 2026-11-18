<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('admin');
require_once __DIR__ . "/../model/m_users.php";
$model = new m_users();
$data = $model->tampil();

$notif = [
  'berhasil_tambah'     => ['ok',  'User berhasil ditambahkan.'],
  'berhasil_ubah'       => ['ok',  'Data user berhasil diubah.'],
  'berhasil_hapus'      => ['ok',  'User berhasil dihapus.'],
  'duplikat'            => ['err', 'Username atau email sudah digunakan!'],
  'tidak_bisa_hapus_diri' => ['err', 'Kamu tidak bisa menghapus akunmu sendiri.'],
];
$status = $_GET['status'] ?? '';
include __DIR__ . '/v_navbar.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data User | CRUD Bioskop</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
    }
    body {
      margin: 0;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      min-height: 100vh;
    }
    h2 {
      text-align: center;
      padding-top: 30px;
      color: #f5f5f5;
      letter-spacing: 2px;
      font-size: 28px;
    }
    .container {
      width: 90%;
      margin: 40px auto;
      background: rgba(255,255,255,0.08);
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      overflow: hidden;
      animation: fadeIn 1s ease;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    table {
      width: 100%;
      border-collapse: collapse;
      color: #fff;
    }
    th, td {
      padding: 15px;
      text-align: center;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    th {
      background: rgba(255,255,255,0.15);
      font-weight: bold;
      text-transform: uppercase;
    }
    tr:hover {
      background: rgba(255,255,255,0.1);
      transform: scale(1.01);
    }
    .btn {
      text-decoration: none;
      color: #fff;
      padding: 8px 15px;
      border-radius: 8px;
      font-weight: 500;
      margin: 0 3px;
      display: inline-block;
    }
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .btn-tambah {
      background: #00b894;
      display: inline-block;
      margin: 20px auto;
      padding: 12px 20px;
      border-radius: 8px;
      text-align: center;
      font-size: 15px;
    }
    .notif { width: 90%; margin: 15px auto 0; padding: 12px; border-radius: 8px; text-align: center; }
    .notif.ok { background: #00b894; }
    .notif.err { background: #d63031; }
    .btn-edit { background: #0984e3; }
    .btn-hapus { background: #d63031; }
  </style>
</head>
<body>
  <h2 style="padding-top:90px">Daftar Data User</h2>

  <?php if (isset($notif[$status])): ?>
    <div class="notif <?= $notif[$status][0] ?>"><?= e($notif[$status][1]) ?></div>
  <?php endif; ?>

  <div align="center">
    <a href="../controller/c_user.php?aksi=tambah" class="btn btn-tambah">+ Tambah User</a>
  </div>

  <div class="container">
    <table>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
      </tr>
      <?php 
      $no = 1;
      foreach ($data as $row) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= e($row['username']); ?></td>
        <td><?= e($row['email']); ?></td>
        <td><?= e($row['role']); ?></td>
        <td>
          <a href="../controller/c_user.php?aksi=ubah&id=<?= (int)$row['id_user']; ?>" class="btn btn-edit">Edit</a>
          <a href="../controller/c_user.php?aksi=hapus&id=<?= (int)$row['id_user']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>