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

    $sql = "INSERT INTO users(first_name , last_name , email , password , phone)";
    $sql.= " VALUES('$first_name','$last_name','$email','$password','$phone')";

    if($conn->query($sql) === TRUE){
        echo "<br><center>เพิ่มข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_users_show.php'>";
    }else{
        echo "<br><center><h3>เพิ่มข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_insert.php'>";
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
    if (isset($_POST['users_chk']) && $_POST['users_chk'] == "update"){
        $user_id      = $_POST['user_id'] ?? '';
        $first_name   = $_POST['first_name'] ?? '';
        $last_name    = $_POST['last_name'] ?? '';
        $email        = $_POST['email'] ?? '';
        $password     = $_POST['password'] ?? '';
        $phone        = $_POST['phone'] ?? '';

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

    //cms_bookings_insert.php
    if (isset($_POST['booking_chk']) && $_POST['booking_chk'] == "insert"){
        $first_name   = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name    = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $email        = isset($_POST['email']) ? $_POST['email'] : '';
        $password     = isset($_POST['password']) ? $_POST['password'] : '';
        $phone        = isset($_POST['phone']) ? $_POST['phone'] : '';

    $sql = "INSERT INTO users(first_name , last_name , email , password , phone)";
    $sql.= " VALUES('$first_name','$last_name','$email','$password','$phone')";

    if($conn->query($sql) === TRUE){
        echo "<br><center>เพิ่มข้อมูลเรียบร้อย</center>";
        echo "<br><center>กรุณารอสักครู่...</center>";
        echo "<meta http-equiv='refresh' content='1;url=cms_show.php'>";
    }else{
        echo "<br><center><h3>เพิ่มข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_insert.php'>";
    }

    $conn->close();
    }

    // cms_bookings_delete.php
    if (isset($_GET['bookings_chk']) && $_GET['bookings_chk'] == "delete"){
        $val = $_GET['val'];
        $sql = "DELETE FROM users WHERE md5(user_id)='$val'";

        if($conn->query($sql) === TRUE){
            echo "<br><center>ลบข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_delete.php'>";
    }else{
        echo "<br><center><h3>ลบข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_delete.php'>";
    }

    $conn->close();
    }

    // cms_bookings_update.php
    if (isset($_POST['bookings_chk']) && $_POST['bookings_chk'] == "update"){
        $user_id      = $_POST['user_id'] ?? '';
        $first_name   = $_POST['first_name'] ?? '';
        $last_name    = $_POST['last_name'] ?? '';
        $email        = $_POST['email'] ?? '';
        $password     = $_POST['password'] ?? '';
        $phone        = $_POST['phone'] ?? '';

        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', phone = '$phone'";
        $sql.= " WHERE user_id = '$user_id'";

        if($conn->query($sql) === TRUE){
            echo "<br><center>แก้ไขข้อมูลเรียบร้อย;</center>";
            echo "<br><center>กรุณารอสักครู่...</center>";
            echo "<meta http-equiv='refresh' content='1;url=cms_update.php'>";
    }else{
        echo "<br><center><h3>เเก้ไขข้อมูลไม่สำเร็จ</h3></center>";
        echo "<center><h3>กรุณาลองใหม่อีกครั้ง...</h3></center>";
        echo "<meta http-equiv='refresh' content='2;url=cms_update.php'>";
    }

    $conn->close();
    }
?>