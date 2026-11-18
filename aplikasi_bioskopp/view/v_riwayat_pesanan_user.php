<?php
require_once __DIR__ . "/../controller/c_auth.php";
wajib_login('admin');

$username = $_SESSION['username'];

// include controller pemesanan
require_once __DIR__ . "/../controller/c_pemesanan.php";
$ctrl = new c_pemesanan();
$dataPemesanan = $ctrl->tampil(); // ambil semua data pemesanan dari database
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pemesanan Tiket | Admin XXI</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      padding-top: 80px;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.95);
      box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
    }

    .navbar-brand {
      color: #ffd700 !important;
      font-weight: bold;
    }

    .container-box {
      background: rgba(255,255,255,0.08);
      border: 2px solid rgba(255,215,0,0.4);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(255,215,0,0.15);
      max-width: 1100px;
      margin: 40px auto;
    }

    table {
      color: #fff;
    }

    thead {
      background: rgba(255,215,0,0.3);
    }

    th {
      color: #ffd700;
    }

    tr:hover {
      background: rgba(255,255,255,0.1);
      transition: 0.2s;
    }

    .btn-danger {
      background-color: #ff4d4d;
      border: none;
    }

    .btn-danger:hover {
      background-color: #ff1a1a;
    }

    footer {
      background: #000;
      color: #aaa;
      text-align: center;
      padding: 12px;
      font-size: 0.9rem;
      border-top: 1px solid rgba(255,215,0,0.2);
      margin-top: 60px;
    }
  </style>
</head>
<body>

<?php include __DIR__ . '/v_navbar.php'; ?>

<!-- KONTEN UTAMA -->
<div class="container-box">
  <h3 class="text-center text-warning mb-4">
    <i class="bi bi-clock-history"></i> Riwayat Pemesanan Tiket
  </h3>
  <p class="text-center mb-4 text-light">
    Berikut daftar semua tiket yang telah dipesan oleh pengguna 🎟️
  </p>

  <?= render_pesan() ?>

  <div class="table-responsive">
    <table class="table table-hover align-middle text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama User</th>
          <th>Judul Film</th>
          <th>Bioskop</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Kursi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($dataPemesanan)) {
          $no = 1;
          foreach ($dataPemesanan as $row) {
            echo "
              <tr>
                <td>{$no}</td>
                <td>" . e($row['nama_user']) . "</td>
                <td>" . e($row['judul_film']) . "</td>
                <td>" . e($row['bioskop']) . "</td>
                <td>" . date('d M Y', strtotime($row['tanggal'])) . "</td>
                <td>" . substr($row['jam'], 0, 5) . "</td>
                <td>" . e($row['kursi']) . "</td>
                <td>
                  <a href='../controller/c_pemesanan.php?aksi=hapus&id=" . (int)$row['id_pemesanan'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>
                    <i class='bi bi-trash'></i>
                  </a>
                </td>
              </tr>
            ";
            $no++;
          }
        } else {
          echo "<tr><td colspan='8' class='text-center text-secondary'>Belum ada data pemesanan tiket.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<footer>
  © <?= date('Y'); ?> XXI Bioskop | Panel Admin dibuat oleh <b>Eka, Rahmat, Shintia</b> ✨
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>