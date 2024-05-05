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
  <header class="p-3 mb-3 border-bottom" id="header">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img src="../static/image/logo-sm.png" height="45" alt="">
        </a>  
        <ul class="nav nav-pills col-12 col-lg-auto me-lg-auto justify-content-center ms-5">
          <li class="nav-item"><a href="./" class="nav-link">หน้าหลัก</a></li>
          <li class="nav-item"><a href="./new-user.html" class="nav-link">เพิ่มลูกค้าใหม่</a></li>
          <li class="nav-item"><a href="./new-worksite.html" class="nav-link active">เพิ่มหน้างานใหม่</a></li>
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
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  
  <div class="container my-container text-center">
    <h2 class="mt-3">เพิ่มหน้างานใหม่</h2>
    <div class="row mt-3 mb-3 justify-content-center">
      <form action="" class="my-form p-0">
        <div class="col">
          <p class="text-start mb-1">รูปหน้างาน</p>
          <div class="d-flex">
            <div class="img-add-btn p-0">
              <label for="images-selector-add-worksite" class="file-upload-label">
                <img src="../static/icon/add.png" alt="">
              </label>
              <input id="images-selector-add-worksite" type="file" accept=".jpg, .jpeg, .png, .pdf" multiple style="display: none;">
            </div>
            <div class="img-container p-0">
              <div class="img-list p-0" id="image-list">
                <div class="img-list-item-empty">Empty</div>
                <div class="img-list-item-empty">Empty</div>
                <div class="img-list-item-empty">Empty</div>
                <div class="img-list-item-empty">Empty</div>
                <div class="img-list-item-empty">Empty</div>
                <div class="img-list-item-empty">Empty</div>
              </div>
            </div>
          </div>
        </div>
        <div id="show-all-img-name"></div>
        <div class="col input-group mt-3">
          <span class="input-group-text"><img src="/static/icon/user.png" width="32"></span>
          <div class="form-floating">
            <input type="text" class="form-control" id="user-search" placeholder="รหัสลูกค้า, ชื่อ-นามสกุลลูกค้า">
            <label for="user-search">รหัสลูกค้า, ชื่อ-นามสกุลลูกค้า</label>
          </div>
        </div>
        <div class="my-user-selector" id="user-list">
          <div class="user-selector-item">
            <div class="about-user">
              <p class="user-id m-0 text-muted">0010</p>
              <p class="user-name m-0">รอซีดี เจีะแล๊ะ</p>
            </div>
            <div class="user-img">
              <img src="../static/image/test/2.jpg" alt="">
            </div>
          </div>
          <div class="user-selector-item">
            <div class="about-user">
              <p class="user-id m-0 text-muted">0010</p>
              <p class="user-name m-0">รอซีดี เจีะแล๊ะ</p>
            </div>
            <div class="user-img">
              <img src="../static/icon/user.png" alt="">
            </div>
          </div>
          <div class="user-selector-item">
            <div class="about-user">
              <p class="user-id m-0 text-muted">0010</p>
              <p class="user-name m-0">รอซีดี เจีะแล๊ะ</p>
            </div>
            <div class="user-img">
              <img src="../static/icon/user.png" alt="">
            </div>
          </div>
          <div class="user-selector-item">
            <div class="about-user">
              <p class="user-id m-0 text-muted">0010</p>
              <p class="user-name m-0">รอซีดี เจีะแล๊ะ</p>
            </div>
            <div class="user-img">
              <img src="../static/image/test/2.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col input-group mb-3"> 
            <div class="form-floating">
              <input type="text" class="form-control" placeholder="ชื่อหน้างาน">
              <label>ชื่อหน้างาน</label>
            </div>
          </div>
          <div class="col input-group mb-3">
            <div class="form-floating">
              <input type="text" class="form-control" placeholder="ที่อยู่หน้างาน">
              <label>ที่อยู่หน้างาน</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col input-group mb-3"> 
            <div class="form-floating">
              <input type="number" class="form-control" placeholder="จำนวนกล้องวงจรปิด">
              <label>จำนวนกล้องวงจรปิด</label>
            </div>
          </div>
          <div class="col input-group mb-3">
            <div class="form-floating">
              <input type="date" class="form-control" placeholder="วันที่ติดตั้ง">
              <label>วันที่ติดตั้ง</label>
            </div>
          </div>
        </div>
        <div class="col">
          <textarea name="" id="" class="form-control" rows="5" style="padding: 10px; border-radius: 5px;" placeholder="รายละเอียดเพิ่มเติม"></textarea>
        </div>
        <div class="d-grid gap-2 mt-3">
          <button class="btn btn-primary btn-lg" type="button">บันทึกข้อมูล</button>
        </div>
      </form>
    </div>
  </div>

  <footer class="pt-3">
    <ul class="nav align-items-center justify-content-center border-bottom pb-3 mb-3">
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
  <script src="../static/js/new-worksite.js"></script>
  <script>
    function onLoadUser() {
      let user_list = document.getElementById('user-list');
      user_list.innerHTML = '';
      
      var users = [
          {
              userId: "0001",
              userName: "Roseedee Cehlaeh",
              userImg: '1.jpg'
          },
          {
              userId: "0002",
              userName: "Solahudeen Cehlaeh",
              userImg: '2.jpg'
          },
          {
              userId: "0003",
              userName: "Muhammad Cehlaeh",
              userImg: '3.jpg'
          }
      ];
      
      users.forEach(user => {
          const userDiv = document.createElement("a");
          userDiv.href = "./new-worksite.php?user_id=" + user.userId;
          userDiv.classList.add("user-selector-item");
          userDiv.innerHTML = `
              <div class="about-user">
                  <p class="user-id m-0 text-muted">${user.userId}</p>
                  <p class="user-name m-0">${user.userName}</p>
              </div>
              <div class="user-img">
                  <img src="../static/image/test/${user.userImg}" alt="">
              </div>
          `;
          user_list.appendChild(userDiv);
      });
    }
  </script>
</body>
</html>