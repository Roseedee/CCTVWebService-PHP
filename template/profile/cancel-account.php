<?php
  session_start();
  require_once('../action/dbconnect.php');
  require_once('action/load-worksites.php');
  $img_type = $_SESSION['user-img-type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CCTV Web service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../../static/css/main.css" rel="stylesheet">
  <link href="../../static/css/view/profile.css" rel="stylesheet">
</head>
<body>
  <header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img src="../../static/image/logo-sm.png" height="45" alt="">
        </a>

        <ul class="nav nav-pills col-12 col-lg-auto me-lg-auto justify-content-center ms-5">
          <?php
            if($_SESSION['user-acc-type'] == 'admin') {
          ?>
            <li class="nav-item"><a href="../" class="nav-link">หน้าหลัก</a></li>
            <li class="nav-item"><a href="../new-user.php" class="nav-link">เพิ่มลูกค้าใหม่</a></li>
            <li class="nav-item"><a href="../new-worksite.php" class="nav-link">เพิ่มหน้างานใหม่</a></li>
          <?php
            }
          ?>
        </ul>

        <a href="../notify-services.php" class="btn btn-light me-3 btn-sm"><?php echo $_SESSION['user-acc-type'] == 'admin' ? 'แจ้งเตือน' : 'แจ้งปัญหา' ?></a>
        <?php echo $_SESSION['admin-user-name'] ?>
        <div class="dropdown text-end ms-3 ">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../uploads/user-img/<?php echo isset($_SESSION['user-image-login']) ? $_SESSION['user-image-login'] : "default.png" ; ?>" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="./?user-id=<?php echo $_SESSION['user-login-id']?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../signout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <div class="container my-container">
    <h2 class="mt-3 text-center">โปรไฟล์</h2>
    <form class="about-user mt-3" action="./action/delete-user.php?user-id=<?php echo $user_id ?>" method="POST" enctype="multipart/form-data">
      <div tool class="user-img">
        <img src="../../uploads/user-img/<?php echo $img_type != NULL ? $user_id . "." . $img_type : 'default.png' ; ?>" alt="" id="user-img">
      </div>
      <div class="user-info ps-5">
        <div class="profile-nav pe-0">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="./?user-id=<?php echo $user_id; ?>">ข้อมูลส่วนตัว</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./account.php?user-id=<?php echo $user_id; ?>">ข้อมูลบัญชี</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./password-manage.php?user-id=<?php echo $user_id; ?>">เปลี่ยนรหัสผ่าน</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="">ลบบัญชีผู้ใช้</a>
            </li>
          </ul>
        </div>
        <div class="col mt-4">
          <div class="row">
              <div class="col input-group mb-1"> 
                  <div class="form-floating">
                      <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username" required>
                      <label>ชื่อผู้ใช้</label>
                  </div>
              </div>
              <div class="col input-group mb-1">
                  <div class="form-floating">
                      <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" required>
                      <label>รหัสผ่าน</label>
                  </div>
              </div>
          </div>
          <?php
            echo isset($_GET['error-msg']) ? '<span class="text-muted">' . $_GET['error-msg'] . '</span>' : '';
          ?>
        </div>
        <div class="col d-flex justify-content-end">           
            <button type="submit" class="btn btn-danger btn-sm">ลบบัญชีผู้ใช้</button>
        </div>
      </div>
    </form>
    <p style="width: 100%; font-weight: bold; text-align: left;" class="mb-0 pb-1 pt-4">ข้อมูลกล้องวงจรปิด</p>
    <div class="container p-0">
    <table class="table align-middle mb-0 bg-white">
        <thead>
          <tr>
            <th>หน้างาน</th>
            <th>รายละเอียดเกี่ยวกับหน้างาน</th>
            <th>ที่อยู่</th>
            <th class="text-center">จำนวนกล้อง</th>
            <th class="text-center">เซอร์วิส(ครั้ง)</th>
            <th class="text-center">สถานะ</th>
          </tr>
        </thead>
        <tbody>
        <?php
          foreach ($worksite_list as $worksite) {
        ?>
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img src="../../static/icon/worksite.png" alt="" style="width: 70px; height: 70px" class="rounded"/>
                <input type="file" name="user-img" id="img-input" style="display: none;">
                <div class="ms-3 d-flex flex-column">
                  <p class="m-0 text-muted" style="font-size: 12px;"><?php echo $worksite['worksite_id']; ?></p>
                  <a href="./worksite-details.php?user-id=<?php echo $user_id?>&worksite-id=<?php echo $worksite['worksite_id']?>"><p class="fw-bold mb-0"><?php echo $worksite['worksite_name']; ?></p></a>
                  <p class="text-muted m-0">วันที่ติดตั้ง : <?php echo $worksite['install_date']; ?></p>
                </div>
              </div>
            </td>
            <td>
            <?php echo $worksite['other_details']; ?>
            </td>
            <td>
              <?php echo $worksite['address']; ?>
            </td>
            <td class="text-center">
              <?php echo $worksite['camera_number']; ?>
            </td>
            <td class="text-center">
              <?php echo $worksite['num_services']; ?>
            </td>
            <td class="text-center">
              <div class="d-flex align-items-center justify-content-center">
                <?php
                  if($worksite['install_date_status']) {
                    echo '<div class="me-2" style="width: 5px; height: 5px; border-radius: 50%; background-color: yellow;"></div>อยู่ในประกัน';
                  }else {
                    echo '<div class="me-2" style="width: 5px; height: 5px; border-radius: 50%; background-color: red;"></div>หมดประกันแล้ว';
                  }
                ?>
              </div>
            </td>
          </tr>
        <?php
          }
        ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer class="pt-3">
    <ul class="nav align-items-center justify-content-center mb-2">
      <img src="../../static/image/logo-sm.png" class="me-3" height="40" alt="">
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
  <script src="../../static/js/profile.js"></script>
</body>
</html>