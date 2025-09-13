<?php
    include 'conn.php';
    $val = $_GET['val'];
    $sql = "SELECT * FROM services";
    $sql.= " WHERE md5(service_id) = '".$val."'";
    $result = $conn->query($sql);
    while($result_array    = $result->fetch_assoc()) {
        $service_id        = $result_array['service_id'] ?? '';
        $service_name      = $result_array['service_name'] ?? '';
        $description       = $result_array['description'] ?? '';
        $price             = $result_array['price'] ?? '';
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แก้ไขข้อมูลบริการเสริม</title>
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
        <li class="nav-item"><a class="nav-link" href="cms_rooms_show.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_roomtypes_show.php">Roomtypes</a></li>
        <li class="nav-item"><a class="nav-link active" href="cms_services_show.php">Services</a></li>
      </ul>
    </div>
  </div>
</nav>

<body class="d-flex flex-column min-vh-100">
  <div class="container mt-3">
    <form class="row g-3" name="cms_services_update" id="cms_services_update" method="get" action="cms_exec.php" enctype="multipart/form-data">
        <h2 class="text-center mb-4">แก้ไขข้อมูลบริการเสริม</h2>
        <div>
            <input type="hidden" name="service_id" id="services_id" value="<?php echo $service_id;?>">
            <input class="form-control" type="text" name="service_id_hidden" id="service_id_hidden" value="<?php echo $service_id;?>" disabled>
        </div>
        <div>
            <label class="form-label">ชื่อบริการเสริม</label>
            <input class="form-control" type="text" name="service_name" id="service_name" value="<?php echo $service_name;?>" placeholder="ชื่อบริการเสริม" required>
        </div>
        <div>
            <label class="form-label">คำอธิบายการบริการเสริม</label>
            <input class="form-control" type="text" name="description" id="description" value="<?php echo $description;?>" placeholder="คำอธิบายการบริการเสริม" required>
        </div>
        <div>
            <label class="form-label">ราคา</label>
            <input class="form-control" type="number" name="price" id="price" value="<?php echo $price;?>" placeholder="ราคา" required>
        </div>
        <div class="col-12 text-center mt-4">
            <input type="hidden" name="services_chk" id="services_chk" value="update">
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
