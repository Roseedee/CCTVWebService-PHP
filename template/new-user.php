<?php
  session_start();

  if(!isset($_SESSION['user-login-id'])) { //check is login
    header('location: ../');
  }else if($_SESSION['user-acc-type'] != 'admin') { //check is customer
    header('location: ./profile/?user-id=' . $_SESSION['user-login-id']);
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CCTV Web service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../static/css/view/new-user.css" rel="stylesheet">
  <link href="../static/css/main.css" rel="stylesheet">
</head>
<body>
  <header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img src="../static/image/logo-sm.png" height="45" alt="">
        </a>

        <ul class="nav nav-pills col-12 col-lg-auto me-lg-auto justify-content-center ms-5">
          <li class="nav-item"><a href="./" class="nav-link">หน้าหลัก</a></li>
          <li class="nav-item"><a href="./new-user.php" class="nav-link">เพิ่มลูกค้าใหม่</a></li>
          <li class="nav-item"><a href="./new-worksite.php" class="nav-link">เพิ่มหน้างานใหม่</a></li>
        </ul>

        <a href="./notify-services.php" class="btn btn-light me-3 btn-sm">แจ้งเตือน</a>
        <?php echo $_SESSION['admin-user-name'] ?>
        <div class="dropdown text-end ms-3 ">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../uploads/user-img/<?php echo isset($_SESSION['user-image-login']) ? $_SESSION['user-image-login'] : "default.png" ; ?>" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="./profile/?user-id=<?php echo $_SESSION['user-login-id']?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="signout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  
  <center class="container my-container mb-4">
    <form action="./action/insert-user.php" method="POST" class="my-form" enctype="multipart/form-data">
      <h2 class="mt-3 text-center">เพิ่มลูกค้าใหม่</h2>
      <div class="col mt-2">
        <div class="col d-flex flex-column align-items-center justify-content-center p-3 mb-3">
          <div id="image-container" onclick="document.getElementById('image-selector-add-user').click()">
            <img class="user-image-preview" src="../static/icon/user-lg.png">
          </div>
          <input type="file" class="form-control" id="image-selector-add-user" name="user_img" style="display: none;">
        </div>
        <div class="col container-sm p-0">
          <p class="fw-bold text-start">ข้อมูลส่วนตัว</p>
          <div class="row">
            <div class="col input-group mb-3"> 
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="ชื่อ-นามสกุล" name="name-lastname">
                <label>ชื่อ-นามสกุล</label>
              </div>
            </div>
            <div class="col input-group mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="เบอร์โทร" name="phone">
                <label>เบอร์โทร</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col input-group mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="อีเมล์" name="email">
                <label>อีเมล์</label>
              </div>
            </div>
            <div class="col input-group mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="ที่อยู่" name="address">
                <label>ที่อยู่</label>
              </div>
            </div>
          </div>
          <p class="col fw-bold text-start mt-2">บัญชี</p>
          <div class="row">
            <div class="col input-group mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username">
                <label>ชื่อผู้ใช้</label>
              </div>
            </div>
            <div class="col input-group mb-3">
              <div class="form-floating">
                <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password">
                <label>รหัสผ่าน</label>
              </div>
            </div>
          </div>
          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" type="submit">เพิ่มลูกค้าใหม่</button>
          </div>
        </div>
      </div>
    </form>
</center>

  <footer class="pt-3">
    <ul class="nav align-items-center justify-content-center mb-2">
      <img src="../static/image/logo-sm.png" class="me-3" height="40" alt="">
      <li class="nav-item">ระบบให้บริการกล้องวงจรปิด</li>
    </ul>
    <p class="text-center text-body-secondary">© 2024 YALANETCOM</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="../static/js/file-input-user.js"></script>
</body>
</html>