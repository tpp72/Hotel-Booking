<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: เข้าสู่ระบบ</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/styles.css">
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">CS Hotel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php#rooms">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#booking">Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/tpp_72/" target="_blank">Contact</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="cms.php">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<body class="d-flex flex-column min-vh-100">
  <div class="container mt-3">
    <form class="row g-3" name="login" id="login" method="post" action="hotel_exec.php" enctype="multipart/form-data">
        <h2 class="text-center mb-4">เข้าสู่ระบบ</h2>
        <div>
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="username" id="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
        </div>
        <div>
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="กรุณากรอกรหัสผ่าน" required>
        </div>
        <div class="col-12 text-center">
            <input type="hidden" name="chk" id="chk" value="login">
            <button type="submit" name="submit" id="submit" class="btn btn-success">เข้าสู่ระบบ</button>
        </div>
    </form>
  </div>
</body>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 CS Hotel. All rights reserved.</p>
  </div>
</footer>
</html>