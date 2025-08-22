<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แก้ไขข้อมูลประเภทห้องพัก</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php
    include 'conn.php';
    $val = $_GET['val'];
    $sql = "SELECT * FROM roomtypes";
    $sql.= " WHERE md5(type_id) = '".$val."'";
    $result = $conn->query($sql);
    while($result_array    = $result->fetch_assoc()) {
        $type_id           = $result_array['type_id'] ?? '';
        $type_name         = $result_array['type_name'] ?? '';
        $description       = $result_array['description'] ?? '';
        $price_per_night   = $result_array['price_per_night'] ?? '';
    }
?>

  <div class="container mt-3">
    <form class="row g-3" name="cms_roomtypes_update" id="cms_roomtypes_update" method="get" action="cms_exec.php" enctype="multipart/form-data">
        <h2 class="text-center mb-4">แก้ไขข้อมูลประเภทห้องพัก</h2>
        <div>
            <input type="hidden" name="type_id" id="type_id" value="<?php echo $type_id;?>">
            <input class="form-control" type="text" name="type_id_hidden" id="type_id_hidden" value="<?php echo $type_id;?>" disabled>
        </div>
        <div>
            <label class="form-label">ชื่อบริการเสริม</label>
            <input class="form-control" type="text" name="type_name" id="type_name" value="<?php echo $type_name;?>" placeholder="ชื่อประเภทห้องพัก" required>
        </div>
        <div>
            <label class="form-label">คำอธิบายการบริการเสริม</label>
            <input class="form-control" type="text" name="description" id="description" value="<?php echo $description;?>" placeholder="คำอธิบายห้องพัก" required>
        </div>
        <div>
            <label class="form-label">ราคา</label>
            <input class="form-control" type="number" name="price_per_night" id="price_per_night" value="<?php echo $price_per_night;?>" placeholder="price_per_night" required>
        </div>
        <div class="col-12 text-center mt-4">
            <input type="hidden" name="roomtypes_chk" id="roomtypes_chk" value="update">
            <button type="submit" name="submit" id="submit" class="btn btn-success">บันทึกข้อมูล</button>
        </div>
    </form>
  </div>
</body>
</html>
