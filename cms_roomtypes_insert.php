<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: เพิ่มข้อมูลประเภทห้องพัก</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="container mt-3">
    <form class="row g-3" name="cms_roomtypes_insert" id="cms_roomtypes_insert" method="post" action="cms_exec.php" enctype="multipart/form-data">
        <h2 class="text-center mb-4">เพิ่มข้อมูลประเภทห้องพัก</h2>
        <div>
            <label class="form-label">ชื่อประเภทห้องพัก</label>
            <input class="form-control" type="text" name="type_name" id="type_name" placeholder="ชื่อประเภทห้องพัก" required>
        </div>
        <div>
            <label class="form-label">คำอธิบายห้องพัก</label>
            <input class="form-control" type="text" name="description" id="description" placeholder="คำอธิบายห้องพัก" required>
        </div>
        <div>
            <label class="form-label">ราคาห้องพัก / คืน</label>
            <input class="form-control" type="number" name="price_per_night" id="price_per_night" placeholder="ราคาห้องพัก / คืน" required>
        </div>
        <div class="col-12 text-center">
            <input type="hidden" name="roomtypes_chk" id="roomtypes_chk" value="insert">
            <button type="submit" name="submit" id="submit" class="btn btn-success">บันทึกข้อมูล</button>
        </div>
    </form>
  </div>
</body>
</html>