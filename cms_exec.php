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
    
?>