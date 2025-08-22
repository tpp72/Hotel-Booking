<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: ลบข้อมูลประเภทห้องพัก</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<form class="row g-3" method="get" action="">
    <div class="container mt-5">
        <h2 class="text-center mb-4">ลบข้อมูลประเภทห้องพัก</h2>
        <div class="d-flex justify-content-center mb-4">
            <input class="form-control w-25" type="text" name="search" id="search" placeholder="ค้นหาข้อมูลประเภทห้องพัก">
        </div>
        <div class="col-12 text-center mb-4">
            <input type="hidden" name="roomtypes_chk" id="roomtypes_chk" value="ค้นหา">
            <button type="submit" class="btn btn-success">ค้นหา</button>
        </div>
    </div>
</form>

<?php
    include 'conn.php';
    $sql = "SELECT * FROM roomtypes";

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if($search <> ''){
        $sql.= " WHERE type_name LIKE '%".$search."%'OR type_id LIKE '%".$search."%' OR price_per_night LIKE '%".$search."%'";
    }
    $sql.= " ORDER BY type_id ASC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table width='95%' border='0' align='center'>";
        echo "<tr bgcolor='green'>";
        echo "<td width='15%'><center>ประเภทห้องพัก</center></td>";
        echo "<td width='50%'><center>คำอธิบายห้องพัก</center></td>";
        echo "<td width='25%'><center>ราคาห้องพัก / คืน</center></td>";
        echo "<td width='5%'><center>ลบ</center></td>";
        echo "</tr>";

    while($result_array = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><center>".$result_array['type_name']."</center></td>";
        echo "<td><center>".$result_array['description']."</center></td>";
        echo "<td><center>".$result_array['price_per_night']."</center></td>";
        echo "<td><center><a href='cms_exec.php?val=".md5($result_array['type_id'])."&roomtypes_chk=delete' target='_self' onclick='return confirm(\"ยืนยันการลบข้อมูล\")' role='button' class='btn btn-danger'>ลบ</a></center></td>";
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