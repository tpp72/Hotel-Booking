<?php
    include 'conn.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: เพิ่มข้อมูลการจองห้องพัก</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="bi bi-gear navbar-brand fw-bold" href="cms.php"> ADMIN</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_users_show.php">Users</a></li>
        <li class="nav-item"><a class="nav-link active" href="cms_bookings_show.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_rooms_show.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_roomtypes_show.php">Roomtypes</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_services_show.php">Services</a></li>
      </ul>
    </div>
  </div>
</nav>

<body class="d-flex flex-column min-vh-100">
  <div class="container mt-3">
    <form class="row g-3" name="cms_users_insert" id="cms_users_insert" method="post" action="cms_exec.php" enctype="multipart/form-data">
        <h2 class="text-center mb-4">เพิ่มข้อมูลการจองห้องพัก</h2>
        <div class="col-md-6">
            <label class="form-label">ชื่อจริง</label>
            <input class="form-control" type="text" name="first_name" id="first_name" placeholder="ชื่อจริง" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">นามสกุล</label>
            <input class="form-control" type="text" name="last_name" id="last_name" placeholder="นามสกุล" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">อีเมล</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="อีเมล" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">เบอร์โทรศัพท์</label>
            <input class="form-control" type="number" name="phone" id="phone" placeholder="เบอรโทรศัพท์" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">วันที่เช็คอิน</label>
            <input class="form-control" type="date" name="check_in" id="check_in" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">วันที่เช็คเอาท์</label>
            <input class="form-control" type="date" name="check_out" id="check_out" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">ประเภทห้องพัก</label>
            <select class="form-select" name="room_type" required>
                <option value="Standard">Standard</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Suite">Suite</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label col-md-6">บริการเสริม</label>
            <select class="form-select" name="service_id" id="service_id">
                <option value="">-- ไม่เอาบริการเสริม --</option>
                    <?php
                        $sql = "SELECT service_id, service_name FROM services";
                        $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['service_id']}'>{$row['service_name']}</option>";
                        }
                    }
                    ?>
            </select>
        </div>
        <div class="col-12 text-center mt-4">
            <input type="hidden" name="bookings_chk" id="bookings_chk" value="insert">
            <button type="submit" name="submit" id="submit" class="btn btn-success">บันทึกข้อมูล</button>
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