<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CS Hotel :: เข้าสู่ระบบ</title>
  <link rel="icon" type="image/png" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="container mt-3">
    <form class="row g-3" name="login" id="login" method="post" action="hotel_exec.php" enctype="multipart/form-data">
        <h2 class="text-center mb-4">Login</h2>
        <div>
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="username" id="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
        </div>
        <div>
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="กรุณากรอกรหัสผ่าน" required>
        </div>
        <div class="col-12 text-center">
            <input type="hidden" name="chk" id="chk" value="login">
            <button type="submit" name="submit" id="submit" class="btn btn-success">เข้าสู่ระบบ</button>
        </div>
    </form>
  </div>
</body>
</html>