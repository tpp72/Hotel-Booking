<?php
    include 'conn.php';

#############################################################################################
#                                 CMS USER EXECUTION SCRIPT                                 #
#############################################################################################

    // cms_users_insert.php
    if (isset($_POST['users_chk']) && $_POST['users_chk'] == "insert"){
        $first_name   = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name    = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $email        = isset($_POST['email']) ? $_POST['email'] : '';
        $password     = isset($_POST['password']) ? $_POST['password'] : '';
        $phone        = isset($_POST['phone']) ? $_POST['phone'] : '';

    // 🔒 ป้องกันชื่อสงวน (Admin)
    if (strtolower($first_name) === "admin") {
        echo "<br><center><h3>ไม่สามารถเพิ่มข้อมูลใช้ชื่อ Admin ได้</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=register.php'>";
    exit();
    }

    $sql = "INSERT INTO users(first_name , last_name , email , password , phone)";
    $sql.= " VALUES('$first_name','$last_name','$email','$password','$phone')";

    if($conn->query($sql) === TRUE){
        echo "<br><center>เพิ่มข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_users_show.php'>";
    }else{
        echo "<br><center><h3>เพิ่มข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_users_insert.php'>";
    }

    $conn->close();
    }

    // cms_users_delete.php
    if (isset($_GET['users_chk']) && $_GET['users_chk'] == "delete"){
        $val = $_GET['val'];
        $sql = "DELETE FROM users WHERE md5(user_id)='$val'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>ลบข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_users_delete.php'>";
    }else{
        echo "<br><center><h3>ลบข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_users_delete.php'>";
    }

    $conn->close();
    }

    // cms_users_update.php
    if (isset($_GET['users_chk']) && $_GET['users_chk'] == "update"){
        $user_id    = isset($_GET['user_id']) ? $_GET['user_id'] : '';
        $first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
        $last_name  = isset($_GET['last_name']) ? $_GET['last_name'] : '';
        $email      = isset($_GET['email']) ? $_GET['email'] : '';
        $password   = isset($_GET['password']) ? $_GET['password'] : '';
        $phone      = isset($_GET['phone']) ? $_GET['phone'] : '';

    // 🔒 ป้องกันชื่อสงวน (Admin)
    if (strtolower($first_name) === "admin") {
        echo "<br><center><h3>ไม่สามารถแก้ไขชื่อเป็น Admin ได้</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=register.php'>";
    exit();
    }

        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', phone = '$phone'";
        $sql.= " WHERE user_id = '$user_id'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>แก้ไขข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_users_update.php'>";
    }else{
        echo "<br><center><h3>เเก้ไขข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_users_update2.php'>";
    }

    $conn->close();
    }

#############################################################################################
#                               CMS BOOKINGS EXECUTION SCRIPT                               #
#############################################################################################

    // cms_bookings_insert.php
    if (isset($_POST['bookings_chk']) && $_POST['bookings_chk'] == "insert") {
        $first_name   = isset ($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name    = isset ($_POST['last_name']) ? $_POST['last_name'] : '';
        $email        = isset ($_POST['email']) ? $_POST['email'] : '';
        $phone        = isset ($_POST['phone']) ? $_POST['phone'] : '';
        $check_in     = isset ($_POST['check_in']) ? $_POST['check_in'] : '';
        $check_out    = isset ($_POST['check_out']) ? $_POST['check_out'] : '';
        $room_type    = isset ($_POST['room_type']) ? $_POST['room_type'] : '';
        $service_id     = isset($_POST['service_id']) ? $_POST['service_id'] : [];

    // ตรวจวันที่
    if ($check_in == '' || $check_out == '' || $check_out <= $check_in) {
        echo "<center><h3>กรุณาเลือกช่วงวันที่ให้ถูกต้อง</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=index.php'>";
        exit;
    }

    // 1. หาว่ามี user อยู่หรือยัง
    $sql = "SELECT user_id FROM users WHERE email='$email' LIMIT 1";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
    }else{
        // ถ้าไม่มี → insert user ใหม่
        $default_pass = '1234';
        $sql = "INSERT INTO users(first_name,last_name,email,phone,password) 
                VALUES ('$first_name','$last_name','$email','$phone','$default_pass')";
        if($conn->query($sql) === TRUE) {
            $user_id = $conn->insert_id;
        }else{
            die("Error insert user: " . $conn->error);
        }
    }

    // หา room_id ที่ available ตาม room_type
    $sql = "SELECT r.room_id 
            FROM rooms r 
            JOIN roomtypes t ON r.type_id=t.type_id 
            WHERE t.type_id='$room_type' AND r.status='available' 
            LIMIT 1";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $room_id = $row['room_id'];
    } else {
        die("<center><h3></h3>ไม่มีห้องว่างในประเภทนี้</h3></center>");
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='3;url=cms_bookings_insert.php'>";
    }

    $sql = "INSERT INTO bookings (user_id, room_id, service_id, check_in, check_out, status) 
            VALUES ('$user_id', '$room_id', '$service_id', '$check_in', '$check_out', 'available')";

    if ($conn->query($sql) === TRUE) {
        $booking_id = $conn->insert_id;

        // อัพเดทสถานะห้อง
        $conn->query("UPDATE rooms SET status='booked' WHERE room_id='$room_id'");

        echo "<br><center>จองห้องพักเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_bookings_show.php'>";

    } else {
        echo "<br><center><h3>ไม่สามารถจองได้: " . $conn->error . "</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='3;url=cms_bookings_show.php'>";

    }

    $conn->close();
    }

    // cms_bookings_delete.php
    if (isset($_GET['bookings_chk']) && $_GET['bookings_chk'] == "delete") {
    $val = $_GET['val'];

    // หา room_id จาก booking_id
    $sql_room = "SELECT room_id FROM bookings WHERE md5(booking_id)='$val' LIMIT 1";
    $result_room = $conn->query($sql_room);
    $room_id = null;
    if ($result_room && $result_room->num_rows > 0) {
        $row = $result_room->fetch_assoc();
        $room_id = $row['room_id'];
    }

    $sql = "DELETE FROM bookings WHERE md5(booking_id)='$val'";
    if ($conn->query($sql) === TRUE) {
        //คืนสถานะห้องให้ available
        if ($room_id !== null) {
            $conn->query("UPDATE rooms SET status='available' WHERE room_id='$room_id'");
        }

        echo "<br><center>ลบข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_bookings_delete.php'>";
    } else {
        echo "<br><center><h3>ลบข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_bookings_delete.php'>";
    }

    $conn->close();
    }

    // cms_bookings_update.php
    if (isset($_GET['bookings_chk']) && $_GET['bookings_chk'] == "update") {

    $booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
    $room_id    = isset($_GET['room_id'])    ? $_GET['room_id']    : '';
    $first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
    $last_name  = isset($_GET['last_name'])  ? $_GET['last_name']  : '';
    $email      = isset($_GET['email'])      ? $_GET['email']      : '';
    $phone      = isset($_GET['phone'])      ? $_GET['phone']      : '';
    $check_in   = isset($_GET['check_in'])   ? $_GET['check_in']   : '';
    $check_out  = isset($_GET['check_out'])  ? $_GET['check_out']  : '';
    $room_type  = isset($_GET['room_type'])  ? $_GET['room_type']  : '';
    $service_in = isset($_GET['service_id']) ? $_GET['service_id'] : '';

    // กรณี service_id ส่งมาเป็น array
    if (is_array($service_in)) {
        $service_id = min($service_in);
    } else {
        $service_id = ($service_in === '' ? null : $service_in);
    }

    // หา room_id เดิม
    $old_room_id = null;
    $res0 = $conn->query("SELECT room_id FROM bookings WHERE booking_id = '$booking_id' LIMIT 1");
    if ($res0 && $res0->num_rows > 0) {
        $row0 = $res0->fetch_assoc();
        $old_room_id = $row0['room_id'];
    }

    // SQL UPDATE
    $sql  = "UPDATE bookings SET ";
    $sql .= "room_id = '$room_id', ";
    if ($service_id === null) {
        $sql .= "service_id = NULL, ";
    } else {
        $sql .= "service_id = '$service_id', ";
    }
    $sql .= "check_in = '$check_in', ";
    $sql .= "check_out = '$check_out', ";
    $sql .= "status = 'booked' ";
    $sql .= "WHERE booking_id = '$booking_id'";

    if ($conn->query($sql) === TRUE) {

        // อัพเดตสถานะ ถ้ามีการเปลี่ยนห้อง
        if ($old_room_id !== null && $old_room_id !== $room_id) {
            $conn->query("UPDATE rooms SET status='available' WHERE room_id='$old_room_id'");
            $conn->query("UPDATE rooms SET status='booked' WHERE room_id='$room_id'");
        } else {
            $conn->query("UPDATE rooms SET status='booked' WHERE room_id='$room_id'");
        }

        echo "<br><center>แก้ไขข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_bookings_update.php'>";
    } else {
        echo "<br><center><h3>แก้ไขข้อมูลไม่สำเร็จ: ".$conn->error."</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_bookings_update2.php'>";
    }

    $conn->close();
    }

#############################################################################################
#                                 CMS ROOM EXECUTION SCRIPT                                 #
#############################################################################################

    // cms_rooms_insert.php
    if (isset($_POST['rooms_chk']) && $_POST['rooms_chk'] == "insert"){
        $type_id       = isset($_POST['type_id']) ? $_POST['type_id'] : '';
        $room_number   = isset($_POST['room_number']) ? $_POST['room_number'] : '';
        $status        = isset($_POST['status']) ? $_POST['status'] : '';


    $sql = "INSERT INTO rooms(room_number , type_id , status)";
    $sql.= " VALUES('$room_number','$type_id','$status')";

    if($conn->query($sql) === TRUE){
        echo "<br><center>เพิ่มข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_rooms_show.php'>";
    }else{
        echo "<br><center><h3>เพิ่มข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_rooms_insert.php'>";
    }

    $conn->close();
    }

    // cms_rooms_delete.php
    if (isset($_GET['rooms_chk']) && $_GET['rooms_chk'] == "delete"){
        $val = $_GET['val'];
        $sql = "DELETE FROM rooms WHERE md5(room_id)='$val'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>ลบข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_rooms_delete.php'>";
    }else{
        echo "<br><center><h3>ลบข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_rooms_delete.php'>";
    }

    $conn->close();
    }

    // cms_rooms_update.php
    if (isset($_GET['rooms_chk']) && $_GET['rooms_chk'] == "update"){
        $room_id         = isset($_GET['room_id']) ? $_GET['room_id'] : '';
        $type_id         = isset($_POST['type_id']) ? $_POST['type_id'] : '';
        $room_number     = isset($_POST['room_number']) ? $_POST['room_number'] : '';
        $status          = isset($_POST['status']) ? $_POST['status'] : '';

        $sql = "UPDATE roomtypes SET type_name = '$type_name', description = '$description', price_per_night = '$price_per_night'";
        $sql.= " WHERE type_id = '$type_id'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>แก้ไขข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_rooms_update.php'>";
    }else{
        echo "<br><center><h3>เเก้ไขข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_rooms_update2.php'>";
    }

    $conn->close();
    }

#############################################################################################
#                               CMS ROOMTYPE EXECUTION SCRIPT                               #
#############################################################################################

    // cms_roomtypes_insert.php
    if (isset($_POST['roomtypes_chk']) && $_POST['roomtypes_chk'] == "insert"){
        $type_name       = isset($_POST['type_name']) ? $_POST['type_name'] : '';
        $description     = isset($_POST['description']) ? $_POST['description'] : '';
        $price_per_night = isset($_POST['price_per_night']) ? $_POST['price_per_night'] : '';


    $sql = "INSERT INTO roomtypes(type_name , description , price_per_night)";
    $sql.= " VALUES('$type_name','$description','$price_per_night')";

    if($conn->query($sql) === TRUE){
        echo "<br><center>เพิ่มข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_roomtypes_show.php'>";
    }else{
        echo "<br><center><h3>เพิ่มข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_roomtypes_insert.php'>";
    }

    $conn->close();
    }

    // cms_roomtypes_delete.php
    if (isset($_GET['roomtypes_chk']) && $_GET['roomtypes_chk'] == "delete"){
        $val = $_GET['val'];
        $sql = "DELETE FROM roomtypes WHERE md5(type_id)='$val'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>ลบข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_roomtypes_delete.php'>";
    }else{
        echo "<br><center><h3>ลบข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_roomtypes_delete.php'>";
    }

    $conn->close();
    }

    // cms_roomtypes_update.php
    if (isset($_GET['roomtypes_chk']) && $_GET['roomtypes_chk'] == "update"){
        $type_id         = isset($_GET['type_id']) ? $_GET['type_id'] : '';
        $type_name       = isset($_GET['type_name']) ? $_GET['type_name'] : '';
        $description     = isset($_GET['description']) ? $_GET['description'] : '';
        $price_per_night = isset($_GET['price_per_night']) ? $_GET['price_per_night'] : '';

        $sql = "UPDATE roomtypes SET type_name = '$type_name', description = '$description', price_per_night = '$price_per_night'";
        $sql.= " WHERE type_id = '$type_id'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>แก้ไขข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_roomtypes_update.php'>";
    }else{
        echo "<br><center><h3>เเก้ไขข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_roomtypes_update2.php'>";
    }

    $conn->close();
    }
    
#############################################################################################
#                               CMS SERVICES EXECUTION SCRIPT                               #
#############################################################################################

    // cms_services_insert.php
    if (isset($_POST['services_chk']) && $_POST['services_chk'] == "insert"){
        $service_name   = isset($_POST['service_name']) ? $_POST['service_name'] : '';
        $description    = isset($_POST['description']) ? $_POST['description'] : '';
        $price          = isset($_POST['price']) ? $_POST['price'] : '';


    $sql = "INSERT INTO services(service_name , description , price)";
    $sql.= " VALUES('$service_name','$description','$price')";

    if($conn->query($sql) === TRUE){
        echo "<br><center>เพิ่มข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_services_show.php'>";
    }else{
        echo "<br><center><h3>เพิ่มข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_services_insert.php'>";
    }

    $conn->close();
    }

    // cms_services_delete.php
    if (isset($_GET['services_chk']) && $_GET['services_chk'] == "delete"){
        $val = $_GET['val'];
        $sql = "DELETE FROM services WHERE md5(service_id)='$val'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>ลบข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_services_delete.php'>";
    }else{
        echo "<br><center><h3>ลบข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_services_delete.php'>";
    }

    $conn->close();
    }

    // cms_services_update.php
    if (isset($_GET['services_chk']) && $_GET['services_chk'] == "update"){
        $service_id     = isset($_GET['service_id']) ? $_GET['service_id'] : '';
        $service_name   = isset($_GET['service_name']) ? $_GET['service_name'] : '';
        $description    = isset($_GET['description']) ? $_GET['description'] : '';
        $price          = isset($_GET['price']) ? $_GET['price'] : '';

        $sql = "UPDATE services SET service_name = '$service_name', description = '$description', price = '$price'";
        $sql.= " WHERE service_id = '$service_id'";

    if($conn->query($sql) === TRUE){
            echo "<br><center>แก้ไขข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_services_update.php'>";
    }else{
        echo "<br><center><h3>เเก้ไขข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_services_update2.php'>";
    }

    $conn->close();
    }

?>