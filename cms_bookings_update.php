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
  <form class="row g-3" method="get" action="">
    <div class="container mt-5">
        <h2 class="text-center mb-4">แก้ไขข้อมูลการจองห้องพัก</h2>
        <div class="d-flex justify-content-center mb-4">
            <input class="form-control w-25" type="text" name="search" id="search" placeholder="ค้นหาข้อมูลการจองห้องพัก">
        </div>
        <div class="col-12 text-center mb-4">
            <input type="hidden" name="chk" id="chk" value="ค้นหา">
            <button type="submit" class="btn btn-success">ค้นหา</button>
        </div>
    </div>
  </form>
<?php
    include 'conn.php';
    $sql = "SELECT * FROM bookings";
    $sql.= " INNER JOIN users ON bookings.user_id = users.user_id";
    $sql.= " INNER JOIN rooms ON bookings.room_id = rooms.room_id";
    $sql.= " INNER JOIN roomtypes ON rooms.type_id = roomtypes.type_id";
    $sql.= " LEFT JOIN services ON bookings.service_id = services.service_id";

    $search = isset($_POST['search']) ? $_POST['search'] : '';
    if($search <> ''){
        $sql.= " WHERE booking_id LIKE '%".$search."%' OR user_id LIKE '%".$search."%' OR room_id LIKE '%".$search."%' OR check_in LIKE '%".$search."%' OR check_out LIKE '%".$search."%'";
    }
    $sql.= " ORDER BY booking_id ASC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table width='95%' border='0' align='center'>";
        echo "<tr bgcolor='green'>";
        echo "<td width='7%'><center>หมายเลขห้องพัก</center></td>";
        echo "<td width='11%'><center>ชื่อ</center></td>";
        echo "<td width='11%'><center>นามสกุล</center></td>";
        echo "<td width='13%'><center>อีเมล</center></td>";
        echo "<td width='7%'><center>เบอร์โทร</center></td>";
        echo "<td width='9%'><center>วันที่เช็คอิน</center></td>";
        echo "<td width='9%'><center>วันที่เช็คเอาท์</center></td>";
        echo "<td width='8%'><center>ประเภทห้องพัก</center></td>";
        echo "<td width='12%'><center>บริการเสริม</center></td>";
        echo "<td width='7%'><center>สถานะห้องพัก</center></td>";
        echo "<td width='5%'><center>แก้ไข</center></td>";
        echo "</tr>";

    while($result_array = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><center>".$result_array['room_number']."</center></td>";
        echo "<td><center>".$result_array['first_name']."</center></td>";
        echo "<td><center>".$result_array['last_name']."</center></td>";
        echo "<td><center>".$result_array['email']."</center></td>";
        echo "<td><center>".$result_array['phone']."</center></td>";
        echo "<td><center>".$result_array['check_in']."</center></td>";
        echo "<td><center>".$result_array['check_out']."</center></td>";
        echo "<td><center>".$result_array['type_name']."</center></td>";
        echo "<td><center>".$result_array['service_name']."</center></td>";
        echo "<td><center>".$result_array['status']."</center></td>";
        echo "<td><center><a href='cms_bookings_update2.php?val=".md5($result_array['booking_id'])."'target='_self' role='button' class='btn btn-secondary'>แก้ไข</a></center></td>";
        echo  "</tr>";
    }
        echo "</table>";
    }else{
        echo "<center>ไม่พบข้อมูล</center>";
    }

    $conn->close();
?>
</body>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 CS Hotel. All rights reserved.</p>
  </div>
</footer>
</html>