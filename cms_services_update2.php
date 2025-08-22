<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: แก้ไขข้อมูลบริการเสริม</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

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
</html>
