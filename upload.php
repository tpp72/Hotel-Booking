<?php
  include 'conn.php';
  session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบว่ามีไฟล์ถูกส่งมาจริง
    if (isset($_FILES['picture_path_name']) && $_FILES['picture_path_name']['name'] != "") {
        $uploadPath = "uploads/"; // โฟลเดอร์ที่เก็บไฟล์
        $filename = uniqid('img_', true) . ".jpg";

        if (move_uploaded_file($_FILES['picture_path_name']['tmp_name'], $uploadPath . $filename)) {
            echo "<center><h3>อัพโหลดไฟล์สำเร็จ</h3></center>";
            echo "<meta http-equiv='refresh' content='0;url=gallery.php'>";
        } else {
            echo "<center><h3>อัพโหลดไฟล์ไม่สำเร็จ</h3></center>";
        }
    } else {
        echo "<center><h3>กรุณาเลือกไฟล์ก่อน</h3></center>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: หน้าแรก</title>
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
        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#rooms">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#booking">Booking</a></li>
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

<header>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="container">
            <h2 class="text-center text-dark">ระบบอัพโหลดรูปภาพ</h2>
            <p class="text-center text-dark">เลือกรูปภาพที่ต้องการอัพโหลด </p>
            <input id="picture_path_name" name="picture_path_name" type="file" class="form-control input-lg" placeholder="เลือกภาพ"/>
        <div class="col-12 text-center">
            <input type="hidden" name="chk" id="chk" value="Upload">
            <button type="Upload" class="btn btn-success mt-3">ยืนยัน</button>
        </div>
        </div>
    </form>
</header>
</body>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 CS Hotel. All rights reserved.</p>
  </div>
</footer>
</html>
