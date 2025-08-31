<?php
  include 'conn.php';
    $val = isset($_GET['val']) ? $_GET['val'] : '';

    $sql = "SELECT * FROM bookings WHERE md5(booking_id) = '".$val."' LIMIT 1";
    $result = $conn->query($sql);
    if (!$result || $result->num_rows === 0) {
        echo "<div>ไม่พบข้อมูลการจอง</div>";
        exit;
    }

    $booking = $result->fetch_assoc();
    $booking_id = $booking['booking_id'] ?? '';
    $room_id    = $booking['room_id'] ?? '';
    $service_id = $booking['service_id'] ?? '';
    $status     = $booking['status'] ?? 'available';
    $check_in   = $booking['check_in'] ?? '';
    $check_out  = $booking['check_out'] ?? '';

    // room_id ปัจจุบันจาก bookings
    $room_id = $booking['room_id'];

    // หา type_name ของห้องนั้น
    $sql_type = "SELECT rt.type_name FROM rooms r ";
    $sql_type.= "INNER JOIN roomtypes rt ON r.type_id = rt.type_id ";
    $sql_type.= "WHERE r.room_id = '$room_id' LIMIT 1";
    $rsType = $conn->query($sql_type);
    $cur_type = "";
    if ($rsType && $rsType->num_rows > 0) {
        $rowType = $rsType->fetch_assoc();
        $cur_type = $rowType['type_name'];
    }

    $cur_room = null;
    if ($room_id !== '') {
        $rsCur = $conn->query("SELECT room_id, room_number FROM rooms WHERE room_id = '$room_id' LIMIT 1");
        if ($rsCur && $rsCur->num_rows > 0) {
            $cur_room = $rsCur->fetch_assoc();
        }
    }
    $roomsAvail = $conn->query("SELECT room_id, room_number FROM rooms WHERE status='available' ORDER BY room_number");
    $services = $conn->query("SELECT service_id, service_name FROM services ORDER BY service_name");
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แก้ไขข้อมูลการจองห้องพัก</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/styles.css">
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="cms.php">ADMIN</a>
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
  <form class="row g-3" method="get" action="cms_exec.php">
    <h2 class="text-center mb-4">แก้ไขข้อมูลการจองห้องพัก</h2>
    <div>
      <label class="form-label">หมายเลขการจอง</label>
      <input type="hidden" name="booking_id" id="booking_id" value="<?php echo $booking_id; ?>">
      <input class="form-control" type="text" name="booking_id_hidden" id="booking_id_hidden" value="<?php echo $booking_id; ?>" disabled>
    </div>
    <div>
        <label class="form-label">ประเภทห้องพัก</label>
        <select class="form-select" name="room_type" required>
            <option value="Standard" <?php if($cur_type=="Standard") echo "selected"; ?>>Standard</option>
            <option value="Deluxe" <?php if($cur_type=="Deluxe") echo "selected"; ?>>Deluxe</option>
            <option value="Suite" <?php if($cur_type=="Suite") echo "selected"; ?>>Suite</option>
        </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">หมายเลขห้องพัก</label>
      <select class="form-select" name="room_id" required>
        <?php
          if ($cur_room) {
              echo "<option value='{$cur_room['room_id']}' selected>Room {$cur_room['room_number']} (ปัจจุบัน)</option>";
          }
          if ($roomsAvail && $roomsAvail->num_rows > 0) {
              while ($r = $roomsAvail->fetch_assoc()) {
                  if ($cur_room && $r['room_id'] == $cur_room['room_id']) continue;
                  echo "<option value='{$r['room_id']}'>Room {$r['room_number']}</option>";
              }
          }
        ?>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">สถานะการจอง</label>
      <select class="form-select" name="status" required>
        <option value="available"   <?php echo ($status=="available"   ? "selected" : ""); ?>>Available</option>
        <option value="booked"      <?php echo ($status=="booked"      ? "selected" : ""); ?>>Booked</option>
        <option value="maintenance" <?php echo ($status=="maintenance" ? "selected" : ""); ?>>Maintenance</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">วันที่เช็คอิน</label>
      <input class="form-control" type="date" name="check_in" value="<?php echo $check_in; ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">วันที่เช็คเอาต์</label>
      <input class="form-control" type="date" name="check_out" value="<?php echo $check_out; ?>" required>
    </div>
    <div>
      <label class="form-label">บริการเสริม</label>
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
      <input type="hidden" name="bookings_chk" value="update">
      <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
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