<?php
  include 'conn.php';

  $selected_type_id = isset($_GET['type_id']) ? $_GET['type_id'] : '';

  $suggested_room_number = '';
  if ($selected_type_id !== '') {
      $sql = "SELECT MAX(CAST(room_number AS UNSIGNED)) AS max_no FROM rooms WHERE type_id = '$selected_type_id'";
      $sql = $conn->query($sql);
      if ($sql && $row = $sql->fetch_assoc()) {
          if ($row['max_no'] !== null && $row['max_no'] !== '') {
              $suggested_room_number = (string)($row['max_no'] + 1);
          } else {
              $suggested_room_number = (string)($selected_type_id * 100 + 1);
          }
      }
  }
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: เพิ่มข้อมูลห้องพัก</title>
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
        <li class="nav-item"><a class="nav-link" href="cms_bookings_show.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link active" href="cms_rooms_show.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_roomtypes_show.php">Roomtypes</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_services_show.php">Services</a></li>
      </ul>
    </div>
  </div>
</nav> 

<body class="d-flex flex-column min-vh-100">
  <div class="container mt-3">
    <form class="row g-3" name="cms_rooms_insert" id="cms_rooms_insert" method="post" action="cms_exec.php" enctype="multipart/form-data">
      <h2 class="text-center mb-4">เพิ่มข้อมูลห้องพัก</h2>
      <div>
        <label class="form-label">ประเภทห้องพัก</label>
        <div class="input-group">
          <select class="form-select" name="type_id" id="type_id">
            <?php
              $result = $conn->query("SELECT type_id, type_name FROM roomtypes ORDER BY type_id");
              while ($row = $result->fetch_assoc()) {
                  $sel = ($selected_type_id !== '' && $selected_type_id == $row['type_id']) ? "selected" : "";
                  echo "<option value='{$row['type_id']}' $sel>{$row['type_name']}</option>";
              }
            ?>
          </select>
          <button type="submit" class="btn btn-outline-secondary" formmethod="get" formaction="">ยืนยันประเภทห้องพัก</button>
        </div>
        <small class="text-muted">เลือกประเภทแล้วกด “ยืนยันประเภทห้องพัก” เพื่อกำหนดหมายเลขห้องเริ่มต้นอัตโนมัติ</small>
      </div>
      <div>
        <label class="form-label">หมายเลขห้องพัก</label>
        <input type="hidden" name="room_number" id="room_number" value="<?php echo $suggested_room_number; ?>">
        <input class="form-control" type="number" name="hidden_room_number" id="hidden_room_number" placeholder="หมายเลขห้องพัก (กรอกข้อมูลอัตโนมัติ)" value="<?php echo $suggested_room_number; ?>" required disabled>
      </div>
      <div>
        <label class="form-label">สถานะห้องพัก</label>
        <select class="form-select" name="status" id="status">
          <option>Available</option>
          <option>Booked</option>
          <option>Maintenance</option>
        </select>
      </div>
      <div class="col-12 text-center">
        <input type="hidden" name="rooms_chk" id="rooms_chk" value="insert">
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