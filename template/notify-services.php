<?php
  session_start();
  
  if(!isset($_SESSION['admin-user-id'])) {
    header('location: ../');
  }
  
  require_once("./action/load-notifications.php");
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

  <div class="container my-container">
    <div class="d-flex justify-content-between py-2">
      <div class="d-flex align-items-center">
        <a href="./new-notification.php" class="btn btn-primary btn-sm">เพิ่ม</a>
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
          <th>หน้างาน</th>
          <th>ที่อยู่</th>
          <th>ปัญหาที่ลูกค้าแจ้ง</th>
          <th class="text-center">สถานะ</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($notification_list as $notification) {
        ?>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <img src="../uploads/user-img/<?php echo $notification['img_type'] ? $notification['user_id'] . "." . $notification['img_type'] : "default.png" ; ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle"/>
              <div class="ms-3 d-flex flex-column">
                <p class="m-0 text-muted" style="font-size: 12px;"><?php echo $notification['user_id']?></p>
                <a href="./profile/?user-id=<?php echo $notification['user_id']?>"><p class="fw-bold mb-0"><?php echo $notification['name_lastname']?></p></a>
                <p class="text-muted m-0"><?php echo strlen($notification['phone']) == 0 ? $notification['email'] : $notification['phone']?></p>
              </div>
            </div>
          </td>
          <td>
            <p class="m-0 text-muted" style="font-size: 12px;"><?php echo $notification['worksite_id']?></p>
            <a href="./profile/worksite-details.php?worksite-id=<?php echo $notification['worksite_id']?>&user-id=<?php echo $notification['user_id']?>"><p class="fw-bold mb-0"><?php echo $notification['worksite_name']?></p></a>
            <p class="text-muted m-0">วันที่แจ้ง : 
              <?php 
                $datetime_str = $notification['noti_datetime'];
                $datetime = new DateTime($datetime_str);
                $date = $datetime->format('d/m/y');
                echo $date;
              ?>
            </p>
          </td>
          <td>
            <?php echo $notification['address']?>
          </td>
          <td>
          <?php echo $notification['notification']?>
          </td>
          
          <td class="text-center">
            <div class="d-flex align-items-center justify-content-center">
              <?php
                if($notification['install_date_status']) {
                  echo '<div class="me-2" style="width: 5px; height: 5px; border-radius: 50%; background-color: yellow;"></div>อยู่ในประกัน';
                }else {
                  echo '<div class="me-2" style="width: 5px; height: 5px; border-radius: 50%; background-color: red;"></div>หมดประกันแล้ว';
                }
              ?>
            </div>
          </td>
          <td class="text-center">
            <?php
              if($notification['noti_status']) {
                echo '<a href="./service.php?noti-id=' . $notification['noti_id'] . '" class="btn btn-primary btn-sm btn-rounded">Service</a>';
              }else {
                echo '<a class="btn btn-light btn-sm btn-rounded disabled">Serviced</a>';
              }
            ?>
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
      <li class="nav-item">ระบบให้บริการกล้องวงจรปิด</li>
    </ul>
    <p class="text-center text-body-secondary">© 2024 YALANETCOM</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>