<?php $activePage = basename($_SERVER['PHP_SELF']); ?>
<!-- Bootstrap CSS & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
.navbar {
    background: rgba(0,0,0,0.9);
    box-shadow: 0 4px 12px rgba(255,215,0,0.2);
}

.navbar-brand {
    font-weight: bold;
    color: #ffd700 !important;
}

.nav-link {
    color: #ddd !important;
    border-radius: 6px;
    padding: 6px 10px;
    transition: all 0.3s;
}

.nav-link:hover,
.nav-link.active {
    color: #fff !important;
    background: linear-gradient(90deg, #b58e00, #ffd700);
}

.offcanvas {
    background-color: #111;
}

.offcanvas-title {
    color: #ffd700;
    font-weight: bold;
}

.logout-btn {
    color: #ff4d4d !important;
}

.logout-btn:hover {
    color: #fff !important;
    background: #ff4d4d;
}
</style>

<!-- Navbar -->
<nav class="navbar navbar-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="v_home.php">🍿 XXI Bioskop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuUser" aria-controls="menuUser">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="menuUser">
      <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 pe-3">
          <!-- Home -->
          <li class="nav-item">
            <a class="nav-link <?= ($activePage == 'v_home.php') ? 'active' : '' ?>" href="v_home.php">
              <i class="bi bi-house"></i> Home
            </a>
          </li>

          <!-- Register -->
          <li class="nav-item">
            <a class="nav-link <?= ($activePage == 'v_register.php') ? 'active' : '' ?>" href="v_register.php">
              <i class="bi bi-card-list"></i> Register
            </a>
          </li>

          <hr class="text-secondary">

          <!-- Logout -->
          <li class="nav-item">
            <a class="nav-link <?= ($activePage == 'v_login.php') ? 'active' : '' ?>" href="v_login.php">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
