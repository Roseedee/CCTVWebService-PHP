<?php
  require_once("./template/action/dbconnect.php");

  $login_status = isset($_GET['login_error']) ? $_GET['login_error'] : 0;

  if($login_status) {
    echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง')</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CCTV Web service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="static/css/view/sign-in.css" rel="stylesheet">
  <link href="static/css/main.css" rel="stylesheet">
</head>
<body class="background">
  <div class="login-error"></div>
  <div class="my-form">
     <div class="my-card pt-3 d-flex flex-column">
      <div class="d-flex justify-content-center">
          <img src="static/image/logo-sm.png" height="100">
      </div>
      <form action="./template/action/login.php" class="p-3" method="POST">
          <div class="input-group mb-3">
            <span class="input-group-text"><img src="./static/icon/user.png" width="32"></span>
            <div class="form-floating">
              <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><img src="./static/icon/lock.png" width="32"></span>
            <div class="form-floating">
              <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" type="submit">เข้าสู่ระบบ</button>
          </div>
      </form>
     </div> 
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>