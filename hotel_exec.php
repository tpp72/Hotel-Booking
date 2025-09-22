<?php
    // login.php
    session_start();
    include 'conn.php';

    if (isset($_POST['chk']) && $_POST['chk'] == "login") {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

    $sql = "SELECT * FROM users WHERE email = '".$username."' AND password = '".$password."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $result_array = $result->fetch_assoc();
        $_SESSION['user_id']    = $result_array['user_id'];
        $_SESSION['first_name'] = $result_array['first_name'];
        $_SESSION['last_name']  = $result_array['last_name'];
        $_SESSION['email']      = $result_array['email'];
        $_SESSION['phone']      = $result_array['phone'];

        echo "<br><center><h3>ยินดีต้อนรับคุณ ".$_SESSION['first_name']." ".$_SESSION['last_name']."</h3></center>";
        echo "<br><center><h3>กรุณารอสักครู่...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=index.php'>";
    } else {
        echo "<br><center><h3>ไม่พบข้อมูลผู้ใช้</h3></center>";
        echo "<center><h3>กรุณาสมัครสมาชิกก่อน</h3></center><br>";
        echo "<meta http-equiv='refresh' content='2;url=register.php'>";
    }

    $conn->close();
    }

    // register.php
    if (isset($_POST['chk']) && $_POST['chk'] == "register"){
        $first_name   = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name    = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $email        = isset($_POST['email']) ? $_POST['email'] : '';
        $password     = isset($_POST['password']) ? $_POST['password'] : '';
        $phone        = isset($_POST['phone']) ? $_POST['phone'] : '';

    // 🔒 ป้องกันชื่อสงวน (Admin)
    if (strtolower($first_name) === "admin") {
        echo "<br><center><h3>ไม่สามารถสมัครสมาชิกชื่อ Admin ได้</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=register.php'>";
    exit();
    }

    $sql = "INSERT INTO users(first_name , last_name , email , password , phone)";
    $sql.= " VALUES('$first_name','$last_name','$email','$password','$phone')";

    if($conn->query($sql) === TRUE){
        echo "<br><center>สมัครสมาชิกเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='2;url=index.php'>";
    }else{
        echo "<br><center><h3>สมัครสมาชิกไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=register.php'>";
    }

    $conn->close();
    }

    // Booking index.php
    if (isset($_POST['chk']) && $_POST['chk'] == "booking") {
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
        echo "<meta http-equiv='refresh' content='3;url=index.php'>";
    }

    $sql = "INSERT INTO bookings (user_id, room_id, service_id, check_in, check_out, status) 
            VALUES ('$user_id', '$room_id', '$service_id', '$check_in', '$check_out', 'available')";

    if ($conn->query($sql) === TRUE) {
        $booking_id = $conn->insert_id;

        // อัพเดทสถานะห้อง
        $conn->query("UPDATE rooms SET status='booked' WHERE room_id='$room_id'");
        $conn->query("UPDATE bookings SET status='booked' WHERE booking_id='$booking_id'");

        echo "<br><center>จองห้องพักเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='2;url=index.php'>";

    } else {
        echo "<br><center><h3>ไม่สามารถจองได้: " . $conn->error . "</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='3;url=register.php'>";

    }

    $conn->close();
}

?>