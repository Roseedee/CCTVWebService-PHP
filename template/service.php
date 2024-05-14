<?php
  session_start();
  
  if(!isset($_SESSION['admin-user-id'])) {
    header('location: ../');
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>CCTV Web service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../static/css/view/service.css" rel="stylesheet">
  <link href="../static/css/main.css" rel="stylesheet">
</head>
<body onload="onLoadUser()">
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
            <img src="../uploads/user-img/<?php echo isset($_SESSION['admin-user-image']) ? $_SESSION['admin-user-image'] : "default.png" ; ?>" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="./profile/?user-id=<?php echo $_SESSION['admin-user-id']?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="signout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  
  <div class="container my-container text-center">
    <h2 class="mt-3">ปัญหาที่ลูกค้าแจ้ง</h2>
    <div class="row mt-2 mb-3 justify-content-center">
      <form action="./action/insert-worksite.php" class="my-form p-0" method="POST" enctype="multipart/form-data">
        <div class="col mt-3 noti-img">
            <img src="../static/image/test/1.jpg" alt="">
        </div>
        <div class="col input-group mt-3" id="user-item">
          <span class="input-group-text"><img src="../static/icon/user.png" width="32"></span>
          <div class="form-floating">
            <input type="text" class="form-control" id="user-search" placeholder="รหัสประจำตัวลูกค้า" value="" readonly>
            <label for="user-search">รหัสประจำตัวลูกค้า</label>
          </div>
          <div class="my-user-selector" id="user-list"></div>
        </div>
        <div class="row mt-3">
          <div class="col input-group mb-3"> 
            <div class="form-floating">
              <input type="text" class="form-control" placeholder="หน้างาน" readonly>
              <label>หน้างาน</label>
            </div>
          </div>
          <div class="col input-group mb-3">
            <div class="form-floating">
              <input type="date" class="form-control" placeholder="วันที่แจ้งปัญหา" readonly>
              <label>วันที่แจ้งปัญหา</label>
            </div>
          </div>
        </div>
        <div class="col">
          <textarea name="other-details" class="form-control" rows="5" style="padding: 10px; border-radius: 5px;" placeholder="รายละเอียดเพิ่มเติม" readonly></textarea>
        </div>
        <div class="d-grid gap-2 mt-3">
          <button class="btn btn-primary btn-lg" type="submit">บันทึกการให้บริการ</button>
        </div>
      </form>
    </div>
  </div>

  <footer class="pt-3">
    <ul class="nav align-items-center justify-content-center mb-2">
      <img src="../static/image/logo-sm.png" class="me-3" height="40" alt="">
      <li class="nav-item">ระบบให้บริการกล้องวงจรปิด</li>
    </ul>
    <p class="text-center text-body-secondary">© 2024 YALANETCOM</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="../static/js/new-worksite.js"></script>
  <script>
    
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var formattedDate = `${year}-${month}-${day}`;
    document.getElementById('install-date').value = formattedDate;
  </script>
</body>
</html>