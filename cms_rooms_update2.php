<?php
  include 'conn.php';
  
  $val_param      = isset($_GET['val']) ? $_GET['val'] : '';
  $room_id_param  = isset($_GET['room_id']) ? $_GET['room_id'] : '';

  $room_id = '';
  $room_number_current = '';
  $type_id_current = '';
  $status_current = 'available';

  if ($val_param !== '') {
      $q = "SELECT room_id, room_number, type_id, status
            FROM rooms
            WHERE md5(room_id) = '$val_param'
            LIMIT 1";
  } elseif ($room_id_param !== '') {
      $q = "SELECT room_id, room_number, type_id, status
            FROM rooms
            WHERE room_id = '$room_id_param'
            LIMIT 1";
  } else {
      echo "<div class='container mt-4'><div class='alert alert-danger'>ไม่พบพารามิเตอร์อ้างอิงห้อง</div></div>";
      exit;
  }

  $rs = $conn->query($q);
  if ($rs && $rs->num_rows > 0) {
      $row = $rs->fetch_assoc();
      $room_id             = $row['room_id'];
      $room_number_current = $row['room_number'];
      $type_id_current     = $row['type_id'];
      $status_current      = $row['status'];
  } else {
      echo "<div class='container mt-4'><div class='alert alert-danger'>ไม่พบข้อมูลห้องพัก</div></div>";
      exit;
  }

  // type_id ที่เลือกมาทาง GET (ตอนกดปุ่มยืนยันประเภท)
  $selected_type_id = (isset($_GET['type_id']) && $_GET['type_id'] !== '')
                      ? $_GET['type_id']
                      : $type_id_current;

  // ถ้าเลือก type ใหม่ → คำนวณหมายเลขห้องแนะนำ แล้วโชว์แทนเลขเดิม
  $suggested_room_number = '';
  if ($selected_type_id !== '') {
      $q2 = "SELECT MAX(CAST(room_number AS UNSIGNED)) AS max_no
             FROM rooms
             WHERE type_id = '$selected_type_id'";
      $rs2 = $conn->query($q2);
      if ($rs2 && $r2 = $rs2->fetch_assoc()) {
          if ($r2['max_no'] !== null && $r2['max_no'] !== '') {
              $suggested_room_number = (string)($r2['max_no'] + 1);
          } else {
              $suggested_room_number = (string)($selected_type_id * 100 + 1);
          }
      }

      // ใช้เลขแนะนำแทนเลขเดิมเมื่อเปลี่ยนประเภท
      if ($selected_type_id != $type_id_current) {
          $room_number_current = $suggested_room_number;
      }
  }
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แก้ไขข้อมูลห้องพัก</title>
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
    <form class="row g-3" name="cms_rooms_update" id="cms_rooms_update" method="post" action="cms_exec.php" enctype="multipart/form-data">
      <h2 class="text-center mb-4">แก้ไขข้อมูลห้องพัก</h2>
      <div>
        <input type="hidden" name="room_id" id="room_id" value="<?php echo $room_id; ?>">
        <label class="form-label">รหัสห้องพัก</label>
        <input class="form-control" type="text" name="hidden_room_id" id="hidden_room_id" value="<?php echo $room_id; ?>" disabled>
      </div>
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
        <small class="text-muted">เลือกประเภทแล้วกด “ยืนยันประเภทห้องพัก” เพื่อกำหนดหมายเลขห้องอัตโนมัติ</small>
      </div>
      <div>
        <label class="form-label">หมายเลขห้องพัก</label>
        <input class="form-control" type="number" name="room_number" id="room_number" placeholder="หมายเลขห้องพัก" value="<?php echo $room_number_current; ?>" disabled>
      </div>
      <div>
        <label class="form-label">สถานะห้องพัก</label>
        <select class="form-select" name="status" id="status">
          <option value="available"   <?php echo ($status_current=="available"   ? "selected" : ""); ?>>available</option>
          <option value="booked"      <?php echo ($status_current=="booked"      ? "selected" : ""); ?>>booked</option>
          <option value="maintenance" <?php echo ($status_current=="maintenance" ? "selected" : ""); ?>>maintenance</option>
        </select>
      </div>
      <div class="col-12 text-center mt-4">
        <input type="hidden" name="rooms_chk" id="rooms_chk" value="update">
        <button type="submit" name="submit" id="submit" class="btn btn-success">บันทึกการแก้ไข</button>
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