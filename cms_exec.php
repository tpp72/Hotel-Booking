<?php
    include 'conn.php';
    if (isset($_POST['chk']) && $_POST['chk'] == "insert"){
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

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

    if (isset($_GET['chk']) && $_GET['chk'] == "delete"){
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

    if (isset($_POST['chk']) && $_POST['chk'] == "update"){
        $user_id = $_POST['user_id'] ?? '';
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $phone = $_POST['phone'] ?? '';

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