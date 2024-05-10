<?php
    require_once('action/load-worksite.php');
    require_once('action/load-worksite-img.php');
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
    <header class="p-3 mb-3 border-bottom" id="header">
        <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="../../" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
            <img src="../../static/image/logo-sm.png" height="45" alt="">
            </a>  
            <ul class="nav nav-pills col-12 col-lg-auto me-lg-auto justify-content-center ms-5">
            <li class="nav-item"><a href="../" class="nav-link">หน้าหลัก</a></li>
            <li class="nav-item"><a href="../new-user.php" class="nav-link">เพิ่มลูกค้าใหม่</a></li>
            <li class="nav-item"><a href="../new-worksite.php" class="nav-link">เพิ่มหน้างานใหม่</a></li>
            </ul> 
            <a href="./notify-services.php" class="btn btn-light me-3 btn-sm">แจ้งเตือน</a>
            <div class="dropdown text-end ms-2">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../static/icon/user.png" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
            </div>
        </div>
        </div>
    </header>

    <div class="container my-container text-center">
        <div class="row mt-3 mb-3 justify-content-center">
            <form action="./action/update-worksite.php?worksite-id=<?php echo $worksite_id?>" class="my-form p-0" method="POST" enctype="multipart/form-data">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="./?user-id=<?php echo $user_id?>" class="btn btn-primary btn-sm me-1" onclick="window.history.back()">ย้อนกลับ</a>
                    <a href="./action/delete-worksite.php?worksite-id=<?php echo $worksite_id?>&user-id=<?php echo $user_id?>" class="btn btn-danger btn-sm me-1">ลบหน้างาน</a>
                </div>
                <div class="col mt-3">
                <p class="text-start mb-1">รูปหน้างาน</p>
                <div class="d-flex">
                    <div class="img-add-btn p-0">
                    <label for="images-selector-add-worksite" class="file-upload-label">
                        <img src="../../static/icon/add.png" alt="">
                    </label>
                    <input id="images-selector-add-worksite" type="file" accept=".jpg, .jpeg, .png, .pdf" multiple style="display: none;" name="worksite-img[]">
                    </div>
                    <div class="img-container p-0">
                    <div class="img-list p-0" id="image-list">
                        <?php foreach ($worksite_img_list as $image) { ?>
                            <div class="img-list-item">
                                <img src="../../uploads/worksite-img/<?php echo $image['img_url']?>" alt="">
                                <a href="./action/delete-worksite-img.php?image-id=<?php echo $image['img_id']?>&image-name=<?php echo $image['img_url']?>&worksite-id=<?php echo $worksite_id?>" class="img-btn-delete delete-img">
                                    <img src="../../static/icon/trash-bin.png" alt="">
                                </a>
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
                    <input type="text" class="form-control" placeholder="ชื่อหน้างาน" name="worksite-name" required value="<?php echo $worksite['worksite_name']?>">
                    <label>ชื่อหน้างาน</label>
                    </div>
                </div>
                <div class="col input-group mb-3">
                    <div class="form-floating">
                    <input type="text" class="form-control" placeholder="ที่อยู่หน้างาน" name="address" required value="<?php echo $worksite['address']?>">
                    <label>ที่อยู่หน้างาน</label>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col input-group mb-3"> 
                    <div class="form-floating">
                    <input type="number" class="form-control" placeholder="จำนวนกล้องวงจรปิด" name="camera-number" min="1" value="<?php echo $worksite['camera_number']?>" required>
                    <label>จำนวนกล้องวงจรปิด</label>
                    </div>
                </div>
                <div class="col input-group mb-3">
                    <div class="form-floating">
                    <input type="date" class="form-control" placeholder="วันที่ติดตั้ง" id="install-date" name="install-date" required value="<?php echo $worksite['install_date']?>">
                    <label>วันที่ติดตั้ง</label>
                    </div>
                </div>
                </div>
                <div class="col">
                <textarea name="other-details" id="" class="form-control" rows="5" style="padding: 10px; border-radius: 5px;" placeholder="รายละเอียดเพิ่มเติม" value="<?php echo $worksite['other_details']?>"></textarea>
                </div>
                <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary btn-lg" type="submit">แก้ไขข้อมูล</button>
                </div>
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
    <script src="../../static/js/worksite-details.js"></script>
    <script>
        
    </script>
</body>
</html>