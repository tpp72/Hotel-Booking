<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hotel Booking System</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php
    include 'conn.php';
    $val = $_GET['val'];
    $sql = "SELECT * FROM users";
    $sql.= " WHERE md5(user_id) = '".$val."'";
    $result = $conn->query($sql);
    while($result_array = $result->fetch_assoc()) {
        $user_id = $result_array['user_id'] ?? '';
        $first_name = $result_array['first_name'] ?? '';
        $last_name = $result_array['last_name'] ?? '';
        $email = $result_array['email'] ?? '';
        $password = $result_array['password'] ?? '';
        $phone = $result_array['phone'] ?? '';
    }
?>

  <div class="container mt-3">
    <form class="row g-3" name="cms_users_update" id="cms_users_update" method="post" action="cms_exec.php" enctype="multipart/form-data">
        <h2 class="text-center mb-4">แก้ไขข้อมูลผู้ใช้</h2>
        <div>
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
            <input class="form-control" type="text" name="user_id_hidden" id="user_id_hidden" value="<?php echo $user_id;?>" disabled>
        </div>
        <div>
            <label class="form-label">ชื่อจริง</label>
            <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo $first_name;?>">
        </div>
        <div>
            <label class="form-label">นามสกุล</label>
            <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $last_name;?>">
        </div>
        <div>
            <label class="form-label">อีเมล</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $email;?>">
        </div>
        <div>
            <label class="form-label">รหัสผ่าน</label>
            <input class="form-control" type="password" name="password" id="password" value="<?php echo $password;?>">
        </div>
        <div>
            <label class="form-label">เบอรโทรศัพท์</label>
            <input class="form-control" type="number" name="phone" id="phone" value="<?php echo $phone;?>">
        </div>
        <div class="col-12 text-center mt-4">
            <input type="hidden" name="users_chk" id="users_chk" value="update">
            <button type="submit" name="submit" id="submit" class="btn btn-success">บันทึกข้อมูล</button>
        </div>
    </form>
  </div>
</body>
</form>