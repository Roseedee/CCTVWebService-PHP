<?php
  require_once("./action/load-users.php");

  if(!isset($_SESSION['user_id'])) {
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
          <li class="nav-item"><a href="./new-worksite.html" class="nav-link">เพิ่มหน้างานใหม่</a></li>
        </ul>

        <a href="./notify-services.html" class="btn btn-light me-3 btn-sm">แจ้งเตือน</a>
        
        <div class="dropdown text-end ms-2">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../static/icon/user.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="signout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <div class="container my-container">
    <div class="d-flex justify-content-between py-2">
      <div class="d-flex align-items-center">
        <a href="./" class="btn btn-primary btn-sm me-1">ลูกค้า</a>
        <a href="./worksite-list.html" class="btn btn-light btn-sm">หน้างาน</a>
      </div>
      <form class="d-flex">
        <input type="text" class="form-control me-2" placeholder="ค้นหา" aria-label="Username" aria-describedby="basic-addon1">
        <button class="btn btn-outline-secondary" type="submit">ค้นหา</button>
      </form>
    </div>
    <table class="table align-middle mb-0 bg-white">
      <thead>
        <tr>
          <th>ลูกค้า</th>
          <th>เบอร์โทร</th>
          <th>ที่อยู่</th>
          <th class="text-center">หน้างาน</th>
          <th class="text-center">เซอร์วิส(ครั้ง)</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($customers as $customer) {
        ?>
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img src="../static/icon/user.png" alt="" style="width: 45px; height: 45px" class="rounded-circle"/>
                <div class="ms-3 d-flex flex-column">
                  <p class="m-0 text-muted" style="font-size: 14px;"><?php echo $customer['user_id']; ?></p>
                  <a href=""><p class="fw-bold mb-0"><?php echo $customer['name_lastname']; ?></p></a>
                  <p class="m-0"><?php echo $customer['email']; ?></p>
                </div>
              </div>
            </td>
            <td>
              <p class="fw-normal mb-0"><?php echo $customer['phone']; ?></p>
            </td>
            <td>
              <p class="fw-normal mb-0"><?php echo $customer['address']; ?></p>
            </td>
            <td class="text-center">
              <span><?php echo $customer['num_worksites'] ?></span>
            </td>
            <td class="text-center">
              <span><?php echo $customer['num_services'] ?></span><br>
              <i class="text-muted" style="font-size: 14px;">ล่าสุด <?php echo $customer['latest_service_date'] ?></i>
            </td>
            <td class="text-center">
            <a class="btn btn-primary btn-sm btn-rounded">เพิ่มหน้างาน</a>
            </td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>

  <footer class="pt-3">
    <ul class="nav align-items-center justify-content-center mb-2">
      <img src="../static/image/logo-sm.png" class="me-3" height="40" alt="">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Service</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>  
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
    </ul>
    <p class="text-center text-body-secondary">© 2024 YALANETCOM</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>