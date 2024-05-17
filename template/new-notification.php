<?php
  session_start();
  
  if(!isset($_SESSION['user-login-id'])) {
    header('location: ../');
  }

  require_once('action/load-user.php');
  
  if(isset($_GET['user-id'])) {
    require_once('action/load-worksite.php');
  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>CCTV Web service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../static/css/view/new-worksite.css" rel="stylesheet">
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
          <?php
            if($_SESSION['user-acc-type'] == 'admin') {
          ?>
            <li class="nav-item"><a href="./" class="nav-link">หน้าหลัก</a></li>
            <li class="nav-item"><a href="./new-user.php" class="nav-link">เพิ่มลูกค้าใหม่</a></li>
            <li class="nav-item"><a href="./new-worksite.php" class="nav-link">เพิ่มหน้างานใหม่</a></li>
          <?php
            }
          ?>
        </ul>

        <a href="./notify-services.php" class="btn btn-light me-3 btn-sm"><?php echo $_SESSION['user-acc-type'] == 'admin' ? 'แจ้งเตือน' : 'แจ้งปัญหา' ?></a>
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
  
  <div class="container my-container text-center">
    <h2 class="mt-3">แจ้งปัญหากล้องวงจรปิด</h2>
    <div class="row mt-4 mb-3 justify-content-center">
      <form action="./action/insert-notification.php" class="my-form p-0" method="POST" enctype="multipart/form-data">
        <div class="row" id="my-dropdown">
            <div class="col input-group">
              <span class="input-group-text"><img src="../static/icon/user.png" width="32"></span>
              <div class="form-floating">
                <input type="text" class="form-control" id="user-search" placeholder="เลือกลูกค้า" value="<?php echo isset($_GET['user-id']) ? $_GET['user-id'] : "" ?>" name="user-id" required>
                <label for="user-search">เลือกลูกค้า</label>
              </div>
            </div>
            <div class="col input-group">
                <span class="input-group-text"><img src="../static/icon/worksite.png" width="32"></span>
                <div class="form-floating">
                    <input type="text" class="form-control" id="worksite-search" placeholder="เลือกหน้างาน" value="<?php echo isset($_GET['worksite-id']) ? $_GET['worksite-id'] : "" ?>" name="worksite-id" required>
                    <label for="worksite-search">เลือกหน้างาน</label>
                </div>
            </div>
            <div class="my-user-selector" id="user-list"></div>
            <div class="my-user-selector" id="worksite-list">
              <p class="text-center p-0 m-0 mt-2">กรุณาเลือกลูกค้าก่อน</p>
            </div>
        </div>
        <div class="col mt-3">
          <p class="text-start mb-1">กดพื่อเพิ่มรูป สามารถเพิ่มรูปได้แค่รูปเดียว</p>
          <div class="d-flex">
            <div class="img-add-btn p-0">
              <label for="images-selector-add-worksite" class="file-upload-label">
                <img src="../static/icon/add.png" alt="">
              </label>
              <input id="images-selector-add-worksite" type="file" accept=".jpg, .jpeg, .png, .pdf" style="display: none;" name="notification-img">
            </div>
            <div class="img-container p-0">
              <div class="img-list p-0" id="image-list">
              </div>
            </div>
          </div>
        </div>
        <div id="show-all-img-name" class="mt-1"></div>
        <div class="col mt-2">
          <textarea name="notification-details" id="" class="form-control" rows="5" style="padding: 10px; border-radius: 5px;" placeholder="แจ้งรายละเอียดปัญหา"></textarea>
        </div>
        <div class="d-grid gap-2 mt-3">
          <button class="btn btn-primary btn-lg" type="submit">แจ้งปัญหา</button>
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
  <script src="../static/js/new-notification.js"></script>
  <script>
    function onLoadUser() {
        let user_list = document.getElementById('user-list');
        user_list.innerHTML = '';

        var users = [
            <?php
            foreach ($customers as $customer) {
            ?>
            {
                userId: "<?php echo $customer['user_id']?>",
                userName: "<?php echo $customer['name_lastname']?>",
                imgType: '<?php echo $customer['img_type']?>'
            },
            <?php
            }
            ?>
        ];
        
        users.forEach(user => {
            const userItem = document.createElement("a");
            userItem.href = "./new-notification.php?user-id=" + user.userId;
            userItem.classList.add("user-selector-item");
            if(user.imgType) {
                userItem.innerHTML = `
                    <div class="about-user">
                        <p class="user-id m-0 text-muted">${user.userId}</p>
                        <p class="user-name m-0">${user.userName}</p>
                    </div>
                    <div class="user-img">
                        <img src="../uploads/user-img/${user.userId}.${user.imgType}" alt="">
                    </div>
                `;
            }else {
                userItem.innerHTML = `
                    <div class="about-user">
                        <p class="user-id m-0 text-muted">${user.userId}</p>
                        <p class="user-name m-0">${user.userName}</p>
                    </div>
                    <div class="user-img">
                        <img src="../uploads/user-img/default.png" alt="">
                    </div>
                `;
            }

            user_list.appendChild(userItem);
        });

        <?php
            if(isset($_GET['user-id'])) {
                echo "1";
        ?>

        var worksites = [
            <?php
            foreach ($worksite_list as $worksite) {
            ?>
                {
                    worksiteId: "<?php echo $worksite['worksite_id']?>",
                    worksiteName: "<?php echo $worksite['worksite_name']?>",
                    userId: "<?php echo $worksite['user_id']?>"
                },
            <?php
            }
            ?>
        ]

        let worksite_list = document.getElementById('worksite-list');
        worksite_list.innerHTML = '';
        
        if(worksites.length > 0) {
          worksites.forEach(worksite => {
              const userItem = document.createElement("a");
              userItem.href = "./new-notification.php?worksite-id=" + worksite.worksiteId + "&user-id=" + worksite.userId;
              userItem.classList.add("user-selector-item");
              userItem.innerHTML = `
                      <div class="about-user">
                          <p class="user-id m-0 text-muted">${worksite.worksiteId}</p>
                          <p class="user-name m-0">${worksite.worksiteName}</p>
                      </div>
                      <div class="user-img">
                          <img src="../static/icon/worksite.png" alt="">
                      </div>
                  `;
  
              worksite_list.appendChild(userItem);
          });
        }else {
          const emptyText = document.createElement('p');
          
          worksite_list.innerHTML = '<p class="text-center p-0 m-0 mt-2">ไม่มีหน้างาน</p>';
        }

        <?php
            }
        ?>
    }
  </script>
</body>
</html>