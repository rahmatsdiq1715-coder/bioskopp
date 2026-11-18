<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('user');
require_once __DIR__ . "/../model/m_film.php";
require_once __DIR__ . "/../model/m_pemesanan.php";

$judulDipilih = $_GET['judul'] ?? '';
$username     = $_SESSION['username'];
$films        = (new m_film())->tampil();
include __DIR__ . "/v_navbar_user.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Tiket XXI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 80px;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Poppins', sans-serif;
    }
    .pesan-box {
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 215, 0, 0.5);
      border-radius: 15px;
      max-width: 600px;
      margin: 30px auto 60px;
      padding: 40px;
      box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
    }
    h3 { color: #ffd700; text-align: center; text-shadow: 0 0 10px rgba(255, 215, 0, 0.6); }
    label { font-weight: 500; color: #ffd700; }
    .form-control, .form-select {
      background-color: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,215,0,0.3);
      color: white;
    }
    .form-control:focus, .form-select:focus {
      background-color: rgba(255,255,255,0.15);
      color: white;
      box-shadow: 0 0 10px rgba(255,215,0,0.5);
      border-color: #ffd700;
    }
    .form-select option { color: #000; }
    .form-text { color: #bbb; }
    .btn-warning { font-weight: bold; color: black; }
  </style>
</head>
<body>

<div class="pesan-box">
  <h3>🎟️ Pesan Tiket Film</h3>
  <hr style="border-color: rgba(255,215,0,0.4);">

  <?= render_pesan() ?>

  <form action="../controller/c_pemesanan.php?aksi=simpan" method="POST">
    <div class="mb-3">
      <label>Nama User</label>
      <input type="text" class="form-control" value="<?= e($username) ?>" readonly>
    </div>

    <div class="mb-3">
      <label>Judul Film</label>
      <select class="form-select" name="judul" required>
        <option value="">-- Pilih Film --</option>
        <?php foreach ($films as $f): ?>
          <option value="<?= e($f['judul']) ?>" <?= ($f['judul'] == $judulDipilih) ? 'selected' : '' ?>><?= e($f['judul']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Bioskop</label>
      <select class="form-select" name="bioskop" required>
        <option value="">-- Pilih Bioskop --</option>
        <?php foreach (m_pemesanan::$daftar_bioskop as $b): ?>
          <option value="<?= e($b) ?>"><?= e($b) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Tanggal Tayang</label>
        <input type="date" class="form-control" name="tanggal" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Jadwal Tayang</label>
        <select class="form-select" name="jam" required>
          <option value="">-- Pilih Jam --</option>
          <?php foreach (m_pemesanan::$daftar_jam as $j): ?>
            <option value="<?= e($j) ?>"><?= e($j) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label>Jumlah Tiket</label>
      <input type="number" class="form-control" name="jumlah" min="1" max="10" required>
    </div>

    <div class="mb-3">
      <label>Nomor Kursi</label>
      <input type="text" class="form-control" name="kursi" placeholder="Contoh: A1, A2" required>
      <div class="form-text">Baris A-J, nomor 1-12. Jumlah kursi harus sama dengan jumlah tiket.</div>
    </div>

    <div class="text-center mt-4">
      <button type="submit" class="btn btn-warning px-4">Pesan Sekarang</button>
      <a href="v_daftar_film.php" class="btn btn-secondary ms-2">Kembali</a>
    </div>
  </form>
</div>

</body>
</html>
