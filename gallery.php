<?php
  include 'conn.php';
  session_start();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แกลเลอรี่</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">CS Hotel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
        <li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="#booking">Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/tpp_72/" target="_blank">Contact</a></li>
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['first_name']) && $_SESSION['first_name'] === 'Admin'): ?>
          <li class="nav-item"><a class="nav-link" href="cms.php">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php elseif (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<hr>
<div class="container">
  <h4 class="text-center mt-5">📷 แกลเลอรี่รูปภาพทั้งหมด</h4>
  
  <div class="gallery">
    <?php
    $folder = "uploads/";
    $files = glob($folder . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

    if (count($files) > 0) {
        foreach ($files as $file) {
            echo '<img src="'.$file.'" class="img-thumbnail" style="width:150px; height:150px; object-fit:cover;">';
        }
    } else {
        echo "<p class='text-center'>ยังไม่มีรูปภาพในระบบ</p>";
    }
    ?>
  </div>
</div>
</body>

<!-- Footer -->
<footer id="contact" class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 CS Hotel. All rights reserved.</p>
  </div>
</footer>
</html>


