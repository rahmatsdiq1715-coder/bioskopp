<?php
require_once __DIR__ . "/../controller/c_auth.php";
$username = $_SESSION['username'] ?? 'User';
$activePage = basename($_SERVER['PHP_SELF']);
?>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Icon Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<!-- Animate CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
.navbar {
    background: rgba(0, 0, 0, 0.9);
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
}

.navbar-brand {
    font-weight: bold;
    font-size: 1.4rem;
    color: #ffd700 !important;
    letter-spacing: 1px;
}

.nav-link {
    color: #ddd !important;
    transition: all 0.3s;
    border-radius: 8px;
    padding: 8px 12px;
}

.nav-link:hover,
.nav-link.active {
    color: #fff !important;
    background: linear-gradient(90deg, #b58e00, #ffd700);
}

.offcanvas {
    background-color: #1a1a1a;
}

.offcanvas-title {
    color: #ffd700;
    font-weight: bold;
    letter-spacing: 1px;
}

.logout-btn {
    color: #ff4d4d !important;
    font-weight: 500;
}

.logout-btn:hover {
    color: #fff !important;
    background: #ff4d4d;
}
</style>

<nav class="navbar navbar-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">🎬 XXI User</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuUser">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end text-bg-dark" id="menuUser">
      <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title">Menu User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>

      <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 pe-3">

          <li class="nav-item">
            <a class="nav-link <?= ($activePage == 'v_home_user.php') ? 'active' : '' ?>" href="v_home_user.php">
              <i class="bi bi-house"></i> Home
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= ($activePage == 'v_daftar_film.php') ? 'active' : '' ?>" href="v_daftar_film.php">
              <i class="bi bi-film"></i> Daftar Film
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= ($activePage == 'v_riwayat.php') ? 'active' : '' ?>" href="v_riwayat.php">
              <i class="bi bi-clock-history"></i> Riwayat Pesanan
            </a>
          </li>

          <hr class="text-secondary">

          <li class="nav-item">
            <a class="nav-link logout-btn" href="v_logout.php">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>

        </ul>
      </div>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>