<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แสดงข้อมูลบริการเสริม</title>
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
        <li class="nav-item"><a class="nav-link" href="cms_bookings_show.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_rooms_show.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_roomtypes_show.php">Roomtypes</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_services_show.php">Services</a></li>
      </ul>
    </div>
  </div>
</nav>

<body>
<header>
    <form method="post" action="">
        <div class="container">
            <h2 class="text-center text-dark">จัดการข้อมูลบริการเสริม</h2>
            <p class="text-center text-dark">กรุณาเลือกการดำเนินการที่ต้องการ</p>
            <div class="text-center mb-4">
                <a href="cms_services_insert.php" class="btn btn-primary">เพิ่มข้อมูลบริการเสริม</a>
                <a href="cms_services_update.php" class="btn btn-secondary">แก้ไขข้อมูลบริการเสริม</a>
                <a href="cms_services_delete.php" class="btn btn-danger">ลบข้อมูลบริการเสริม</a>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <input class="form-control w-75 text-center" type="text" name="search" id="search" placeholder="ค้นหาข้อมูลบริการเสริม">
            </div>
            <div class="col-12 text-center">
                <input type="hidden" name="chk" id="chk" value="ค้นหา">
                <button type="submit" class="btn btn-success">ค้นหา</button>
            </div>
        </div>
    </form>
</header>

<?php
    include 'conn.php';
    $sql = "SELECT * FROM services";

    $search = isset($_POST['search']) ? $_POST['search'] : '';
    if($search <> ''){
        $sql.= " WHERE service_name LIKE '%".$search."%' OR service_id LIKE '%".$search."%' OR price LIKE '%".$search."%'";
    }
    $sql.= " ORDER BY price ASC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table width='95%' border='0' align='center'>";
        echo "<tr bgcolor='green'>";
        echo "<td width='15%'><center>ชื่อบริการเสริม</center></td>";
        echo "<td width='50%'><center>คำอธิบายการบริการเสริม</center></td>";
        echo "<td width='25%'><center>ราคา</center></td>";
        echo "</tr>";

    while($result_array = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><center>".$result_array['service_name']."</center></td>";
        echo "<td><center>".$result_array['description']."</center></td>";
        echo "<td><center>".$result_array['price']."</center></td>";
        echo  "</tr>";
    }
        echo "</table>";
    }else{
        echo "<center>ไม่พบข้อมูล</center>";
    }

    $conn->close();
?>
</body>
</html>