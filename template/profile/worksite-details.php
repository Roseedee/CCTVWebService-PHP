<?php
    session_start();
    require_once('action/load-worksite.php');
    require_once('action/load-worksite-img.php');
    require_once('action/load-serviced.php');
    $user_id = $_GET['user-id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CCTV Web service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../../static/css/view/new-worksite.css" rel="stylesheet">
  <link href="../../static/css/main.css" rel="stylesheet">
</head>
<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="../" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
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

            <a href="../notify-services.php" class="btn btn-light me-3 btn-sm">แจ้งเตือน</a>
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

    <div class="container my-container text-center">
        <div class="row mt-3 mb-3 justify-content-center">
            <form action="" class="my-form p-0">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="./?user-id=<?php echo $user_id?>" class="btn btn-primary btn-sm me-1">กลับไปที่หน้าโปรไฟล์</a>
                    <a href="./form-update-worksite.php?worksite-id=<?php echo $worksite_id?>&user-id=<?php echo $user_id?>" class="btn btn-warning btn-sm me-1">แก้ไขข้อมูล</a>
                </div>
                <div class="col mt-3">
                <p class="text-start mb-1">รูปหน้างาน</p>
                <div class="d-flex">
                    <div class="img-container p-0">
                    <div class="img-list p-0" id="image-list">
                        <?php foreach ($worksite_img_list as $image) { ?>
                            <div class="img-list-item">
                                <img src="../../uploads/worksite-img/<?php echo $image['img_url']?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                    </div>
                </div>
                </div>
                <div id="show-all-img-name" class="mt-1"></div>
                <div class="row mt-2">
                <div class="col input-group mb-3"> 
                    <div class="form-floating">
                    <input type="text" class="form-control" placeholder="ชื่อหน้างาน" name="worksite-name" required value="<?php echo $worksite['worksite_name']?>" disabled>
                    <label>ชื่อหน้างาน</label>
                    </div>
                </div>
                <div class="col input-group mb-3">
                    <div class="form-floating">
                    <input type="text" class="form-control" placeholder="ที่อยู่หน้างาน" name="address" required value="<?php echo $worksite['address']?>"  disabled>
                    <label>ที่อยู่หน้างาน</label>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col input-group mb-3"> 
                    <div class="form-floating">
                    <input type="number" class="form-control" placeholder="จำนวนกล้องวงจรปิด" name="camera-number" min="1" value="<?php echo $worksite['camera_number']?>" required  disabled>
                    <label>จำนวนกล้องวงจรปิด</label>
                    </div>
                </div>
                <div class="col input-group mb-3">
                    <div class="form-floating">
                    <input type="date" class="form-control" placeholder="วันที่ติดตั้ง" id="install-date" name="install-date" required value="<?php echo $worksite['install_date']?>"  disabled>
                    <label>วันที่ติดตั้ง</label>
                    </div>
                </div>
                </div>
                <div class="col">
                <textarea name="other-details" id="" class="form-control" rows="5" style="padding: 10px; border-radius: 5px;" placeholder="รายละเอียดเพิ่มเติม" disabled><?php echo $worksite['other_details']?></textarea>
                </div>
                <div class="d-flex mt-4">
                    <h4>บริการหลังการติดตั้ง</h4>
                </div>
                <table class="table align-middle mb-0 bg-white">
                    <thead>
                        <tr>
                            <th class='text-start'>แจ้งปัญหากล้องวงจรปิด</th>
                            <th class='text-start'>รายละเอียดปัญหา</th>
                            <th class='text-start'>การให้บริการ</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($noti_info as $notification) {
                        ?>
                        <tr>
                            <td class="text-start">
                                <p class="m-0 text-muted" style="font-size: 12px;"><?php echo $notification['noti_id'];?></p>
                                <p class="fw-bold mb-0">ปัญหากล้องวงจรปิด</p>
                                <p class="m-0 text-muted" style="font-size: 12px;">วันที่แจ้งปัญหา : <?php echo $notification['noti_datetime']?></p>
                            </td>
                            <td class="text-start">
                                <?php echo $notification['notification'];?>
                            </td>
                            <td class="text-start">
                                <?php
                                    if(!$notification['noti_status']) {
                                ?>
                                    <p class="m-0 text-muted" style="font-size: 12px;">วันที่ให้บริการ : <?php echo $notification['service_datetime'];?></p>
                                    <?php echo $notification['service_details'];?>
                                <?php
                                    }else {
                                        echo 'ยังไม่มีข้อมูล';
                                    }
                                ?>
                            </td>
                            
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <?php
                                        if($notification['noti_status']) {
                                    ?>
                                        <div class="me-2" style="width: 5px; height: 5px; border-radius: 50%; background-color: yellow;"></div><a href='../service.php?noti-id=<?php echo $notification['noti_id'];?>' style="color: black;">กำลังดำเนินการ</a>
                                    <?php
                                        }else {
                                    ?>
                                        <div class="me-2" style="width: 5px; height: 5px; border-radius: 50%; background-color: gray;"></div><a href='../service.php?noti-id=<?php echo $notification['noti_id'];?>' style="color: black;">ดำเนินการแล้ว</a>
                                    <?php
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
            </form>
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
</body>
</html>