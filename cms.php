<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hotel Booking System</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="cms.php">ADMIN</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_users_show.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="#booking">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/tpp_72/">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="cms.php">Roomtypes</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Services</a></li>
      </ul>
    </div>
  </div>
</nav>

<body>
<header>
    <form method="post" action="">
        <div class="container">
            <h2 class="text-center text-dark">Database Management System</h2>
            <p class="text-center text-dark">ระบบจัดการฐานข้อมูล </p>
            <select class="form-select mb-3" name="options" id="options">
                <option>ข้อมูลผู้ใช้</option>
                <option>ข้อมูลการจองห้องพัก</option>
                <option>ข้อมูลห้องพัก</option>
                <option>ข้อมูลประเภทห้องพัก</option>
                <option>ข้อมูลบริการ</option>
            </select>
        <div class="col-12 text-center">
            <input type="hidden" name="chk" id="chk" value="confirm">
            <button type="submit" class="btn btn-success">ยืนยัน</button>
        </div>
        </div>
    </form>
</header>

<?php 
    if (isset($_POST['chk']) && $_POST['chk'] == 'confirm') {
        $search = $_POST['options'] ?? '';
        if ($search == 'ข้อมูลผู้ใช้') {
            header("Location: cms_users_show.php");
        } elseif ($search == 'ข้อมูลการจองห้องพัก') {
            header("Location: cms_bookings_show.php");
        } elseif ($search == 'ข้อมูลห้องพัก') {
            header("Location: cms_rooms_show.php");
        } elseif ($search == 'ข้อมูลประเภทห้องพัก') {
            header("Location: cms_roomtypes_show.php");
        } elseif ($search == 'ข้อมูลบริการ') {
            header("Location: cms_services_show.php");
        }
    }
?>
</body>
</html>