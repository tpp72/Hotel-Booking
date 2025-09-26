<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: ระบบจัดการเนื้อหา</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="bi bi-gear navbar-brand fw-bold" href="cms.php"> ADMIN</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_users_show.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_bookings_show.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_rooms_show.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_roomtypes_show.php">Roomtypes</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_services_show.php">Services</a></li>
      </ul>
    </div>
  </div>
</nav>

<body class="d-flex flex-column min-vh-100">
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

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบว่ามีไฟล์ถูกส่งมาจริง
    if (isset($_FILES['picture_path_name']) && $_FILES['picture_path_name']['name'] != "") {
        $uploadPath = "uploads/"; // โฟลเดอร์ที่เก็บไฟล์
        $filename = uniqid('img_', true) . ".jpg";

        if (move_uploaded_file($_FILES['picture_path_name']['tmp_name'], $uploadPath . $filename)) {
            echo "<center><h3>อัพโหลดไฟล์สำเร็จ</h3></center>";
        } else {
            echo "<center><h3>อัพโหลดไฟล์ไม่สำเร็จ</h3></center>";
        }
    } else {
        echo "<center><h3>กรุณาเลือกไฟล์ก่อน</h3></center>";
    }
}
?>
</body>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 CS Hotel. All rights reserved.</p>
  </div>
</footer>
</html>
