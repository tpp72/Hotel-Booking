<?php
  include 'conn.php';
  session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: หน้าแรก</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">CS Hotel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="#booking">Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/tpp_72/" target="_blank">Contact</a></li>
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['first_name']) && $_SESSION['first_name'] === 'Admin'): ?>
          <li class="nav-item"><a class="nav-link" href="cms.php">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php elseif (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Sign up</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<header class="text-center">
  <img src="./img/hotel.jpg" class="hero-section-img w-100" alt="Hotel Image">
  <div class="position-absolute top-50 start-50 translate-middle">
    <h1 class="display-4 fw-bold">Welcome to CS Hotel</h1>
    <p class="lead">Experience luxury and comfort</p>
    <a href="#booking" class="btn btn-primary btn-lg">จองเลย</a>
  </div>
</header>

<!-- Rooms Section -->
<section id="rooms" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Our Rooms</h2>
    <div class="row g-4">
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <img src="./img/standard.jpg" class="card-img-top" alt="Standard Room">
          <div class="card-body">
            <h5 class="card-title">Standard Room</h5>
            <p class="card-text">ห้องพักมาตรฐาน ราคาประหยัด</p>
            <p><strong>฿1,200 / คืน</strong></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <img src="./img/deluxe.jpg" class="card-img-top" alt="Deluxe Room">
          <div class="card-body">
            <h5 class="card-title">Deluxe Room</h5>
            <p class="card-text">ห้องพักวิวสวย พร้อมสิ่งอำนวยความสะดวกครบครัน</p>
            <p><strong>฿2,500 / คืน</strong></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <img src="./img/suite.jpg" class="card-img-top" alt="Suite Room">
          <div class="card-body">
            <h5 class="card-title">Suite Room</h5>
            <p class="card-text">ห้องสูทสุดหรู พร้อมห้องนั่งเล่นส่วนตัว</p>
            <p><strong>฿4,000 / คืน</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section id="services" class="bg-light py-5">
  <div class="container">
    <h2 class="text-center mb-4">Our Services</h2>
    <div class="row text-center g-4">
      <div class="col-md-3 col-3"><h5>🍳 Breakfast Buffet</h5><p>฿250</p></div>
      <div class="col-md-3 col-3"><h5>🚐 Airport Shuttle</h5><p>฿500</p></div>
      <div class="col-md-3 col-3"><h5>💆 Spa & Massage</h5><p>฿1,200</p></div>
      <div class="col-md-3 col-3"><h5>👕 Laundry</h5><p>฿100</p></div>
    </div>
  </div>
</section>

<!-- Booking Form -->
<section id="booking" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Book a Room</h2>
    <form class="row g-3" name="booking" id="booking" method="post" action="hotel_exec.php" enctype="multipart/form-data">
      
      <div class="col-md-6">
        <label class="form-label">ชื่อ</label>
        <input class="form-control" type="text" name="first_name" id="first_name" 
               value="<?php echo isset ($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?>" placeholder="ชื่อจริง" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">นามสกุล</label>
        <input class="form-control" type="text" name="last_name" id="last_name" 
               value="<?php echo isset ($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?>" placeholder="นามสกุล" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">อีเมล</label>
        <input class="form-control" type="email" name="email" id="email" 
               value="<?php echo isset ($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" placeholder="อีเมล" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">เบอร์โทร</label>
        <input class="form-control" type="tel" name="phone" id="phone" 
               value="<?php echo isset ($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?>" placeholder="เบอร์โทรศัพท์" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Check-in</label>
        <input class="form-control" type="date" name="check_in" id="check_in" min="<?php echo $today; ?>" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Check-out</label>
        <input class="form-control" type="date" name="check_out" id="check_out" min="<?php echo $today; ?>" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Room Type</label>
        <select class="form-select" name="room_type" id="room_type" required>
            <?php
                $sql = "SELECT type_id, type_name FROM roomtypes";
                $result = $conn->query($sql);
              if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['type_id']}'>{$row['type_name']}</option>";
                }
              }
            ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Services</label>
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
      <div class="col-12 text-center">
        <input type="hidden" name="chk" id="chk" value="booking">
        <button type="submit" class="btn btn-success">จองห้องพัก</button>
      </div>
    </form>
  </div>
</section>
</body>

<!-- Footer -->
<footer id="contact" class="bg-dark text-white text-center py-4">
  <div class="container">
    <p class="mb-0">&copy; 2025 CS Hotel. All rights reserved.</p>
  </div>
</footer>
</html>