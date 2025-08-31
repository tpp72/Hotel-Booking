<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แก้ไขข้อมูลบริการเสริม</title>
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
        <li class="nav-item"><a class="nav-link" href="cms_bookings_show.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_rooms_show.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_roomtypes_show.php">Roomtypes</a></li>
        <li class="nav-item"><a class="nav-link active" href="cms_services_show.php">Services</a></li>
      </ul>
    </div>
  </div>
</nav>

<body class="d-flex flex-column min-vh-100">
<form class="row g-3" method="get" action="">
    <div class="container mt-5">
        <h2 class="text-center mb-4">แก้ไขข้อมูลบริการเสริม</h2>
        <div class="d-flex justify-content-center mb-4">
            <input class="form-control w-25" type="text" name="search" id="search" placeholder="ค้นหาข้อมูลบริการเสริม">
        </div>
        <div class="col-12 text-center mb-4">
            <input type="hidden" name="chk" id="chk" value="ค้นหา">
            <button type="submit" class="btn btn-success">ค้นหา</button>
        </div>
    </div>
</form>

<?php
    include 'conn.php';
    $sql = "SELECT * FROM services";

    $search = isset($_GET['search']) ? $_GET['search'] : '';
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
        echo "<td width='5%'><center>แก้ไข</center></td>";
        echo "</tr>";

    while($result_array = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><center>".$result_array['service_name']."</center></td>";
        echo "<td><center>".$result_array['description']."</center></td>";
        echo "<td><center>".$result_array['price']."</center></td>";
        echo "<td><center><a href='cms_services_update2.php?val=".md5($result_array['service_id'])."'target='_self' role='button' class='btn btn-secondary'>แก้ไข</a></center></td>";
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