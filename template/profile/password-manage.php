<?php
  session_start();
  $user_id = $_GET['user-id'];
  require_once('./action/load-account.php');
  require_once('./action/load-worksites.php');
  $_SESSION['current-password'] = $acc_info[0]['password'];
  $img_type = $_SESSION['user-img-type']
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
        <a href="../" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img src="../../static/image/logo-sm.png" height="45" alt="">
        </a>

        <ul class="nav nav-pills col-12 col-lg-auto me-lg-auto justify-content-center ms-5">
          <li class="nav-item"><a href="../" class="nav-link">หน้าหลัก</a></li>
          <li class="nav-item"><a href="../new-user.php" class="nav-link">เพิ่มลูกค้าใหม่</a></li>
          <li class="nav-item"><a href="../new-worksite.php" class="nav-link">เพิ่มหน้างานใหม่</a></li>
        </ul>

        <a href="../notify-services.php" class="btn btn-light me-3 btn-sm">แจ้งเตือน</a>
        <?php echo $_SESSION['admin-user-name'] ?>
        <div class="dropdown text-end ms-3 ">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../uploads/user-img/<?php echo isset($_SESSION['admin-user-image']) ? $_SESSION['admin-user-image'] : "default.png" ; ?>" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="./?user-id=<?php echo $_SESSION['admin-user-id']?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../signout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <div class="container my-container">
    <h2 class="mt-3 text-center">โปรไฟล์</h2>
    <form class="about-user mt-3" action="./action/update-password.php?img-type=<?php echo $img_type?>&user-id=<?php echo $user_id;?>" method="POST" enctype="multipart/form-data">
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
                <a class="nav-link active" href="">เปลี่ยนรหัสผ่าน</a>
              </li>
          </ul>
          <button type="submit" class="btn btn-primary" id="submitBtn" style="display: none">บันทึก</button>
        </div>
        <div class="col mt-4">
          <div class="row">
            <div class="col input-group mb-3"> 
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="รหัสผ่านเดิม" name="old-password" value="<?php echo isset($_GET['current-password']) ? $_GET['current-password'] : '';?>" required>
                <label>รหัสผ่านเดิม</label>
              </div>
            </div>
            <span class="text-muted"><?php echo isset($_GET['password-incorrect']) ? $_GET['password-incorrect'] : "";?></span>
          </div>
          <div class="row">
            <div class="col input-group mb-3"> 
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="รหัสผ่านใหม่" name="new-password" required>
                <label>รหัสผ่านใหม่</label>
              </div>
            </div>
            <div class="col input-group mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="confirm-password" required>
                <label>ยืนยันรหัสผ่าน</label>
              </div>
            </div>
            <span class="text-muted"><?php echo isset($_GET['password-notmatch']) ? $_GET['password-notmatch'] : "";?></span>
          </div>
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
      <li class="nav-item">ระบบให้บริการกล้องวงจรปิด</li>
    </ul>
    <p class="text-center text-body-secondary">© 2024 YALANETCOM</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script>
    const inputFields = document.querySelectorAll('.about-user input');

    inputFields.forEach(inputField => {
      inputField.addEventListener('input', () => {
        // Display the submit button
        document.getElementById('submitBtn').style.display = 'block';
      });
    });
  </script>
</body>
</html>