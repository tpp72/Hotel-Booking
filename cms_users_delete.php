<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: ลบข้อมูลผู้ใช้</title>
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
        <li class="nav-item"><a class="nav-link active" href="cms_users_show.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="cms_bookings_show.php">Bookings</a></li>
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
        <h2 class="text-center mb-4">ลบข้อมูลผู้ใช้</h2>
        <div class="d-flex justify-content-center mb-4">
            <input class="form-control w-25" type="text" name="search" id="search" placeholder="ค้นหาข้อมูลผู้ใช้">
        </div>
        <div class="col-12 text-center mb-4">
            <input type="hidden" name="chk" id="chk" value="ค้นหา">
            <button type="submit" class="btn btn-success">ค้นหา</button>
        </div>
    </div>
</form>

<?php
    include 'conn.php';

    $limit = 10; // จำนวนแถวต่อหน้า
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if($page < 1) $page = 1;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT * FROM users";

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if($search <> ''){
        $sql.= " WHERE user_id LIKE '%".$search."%'";
    }
    $sql_count = $sql; // เอาไว้หาจำนวนทั้งหมด
    $sql .= " ORDER BY user_id ASC LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-hover align-middle table-users">';
        echo '<thead class="table-danger">';
        echo '  <tr>';
        echo '    <th class="text-center">รหัสผู้ใช้</th>';
        echo '    <th>ชื่อจริง</th>';
        echo '    <th>นามสกุล</th>';
        echo '    <th>Email</th>';
        echo '    <th>เบอร์โทร</th>';
        echo '    <th class="text-center">ลบ</th>';
        echo '  </tr>';
        echo '</thead>';
        echo '<tbody>';

    while($result_array = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><center>".$result_array['user_id']."</center></td>";
        echo "<td>".$result_array['first_name']."</td>";
        echo "<td>".$result_array['last_name']."</td>";
        echo "<td>".$result_array['email']."</td>";
        echo "<td>".$result_array['phone']."</td>";
        echo "<td><center><a href='cms_exec.php?val=".md5($result_array['user_id'])."&users_chk=delete' target='_self' onclick='return confirm(\"ยืนยันการลบข้อมูล\")' role='button' class='bi bi-trash btn btn-danger'></a></center></td>";
        echo  "</tr>";
    }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';

        // ---- นับจำนวนหน้า ----
        $result_count = $conn->query($sql_count);
        $total_records = $result_count->num_rows;
        $total_pages = ceil($total_records / $limit);

        // ---- แสดงลิงก์แบ่งหน้า ----
        echo '<div class="container mt-auto">';
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="pagination justify-content-center">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $page) ? ' active' : '';
            echo '<li class="page-item'.$active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
        }

        echo '</ul>';
        echo '</nav>';
        echo '</div>';

      } else {
        echo '<p class="text-center text-muted my-5">ไม่พบข้อมูล</p>';
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