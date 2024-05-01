document.getElementById('images-selector-add-worksite').addEventListener('change', function(event) {
  var container = document.getElementById('image-list');
  var showAllImgName = document.getElementById('show-all-img-name');
  container.innerHTML = '';
  showAllImgName.innerHTML = '';
  
  var files = event.target.files;

  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    if (file.type.match('image.*')) {
      var reader = new FileReader();
      reader.onload = (function(file) {
        return function(e) {
          var divImg = document.createElement('div')
          divImg.classList.add('img-list-item')

          var iconDelete = document.createElement('img')
          iconDelete.src = '../static/icon/trash-bin.png'

          var btnDelete = document.createElement('div')
          btnDelete.classList.add('img-btn-delete')

          var img = document.createElement('img');
          img.src = e.target.result;

          btnDelete.appendChild(iconDelete)
          divImg.appendChild(img);
          divImg.appendChild(btnDelete)
          container.appendChild(divImg);
          btnDelete.addEventListener('click', function() {
            var index = Array.prototype.indexOf.call(container.children, divImg);
            container.removeChild(divImg);
            files = removeFile(files, index);
            updateFileNames();
          });

          updateFileNames();
        };
      })(file);
      reader.readAsDataURL(file);
    }
  }
  
  function removeFile(arrayLike, index) {
    var newArray = Array.from(arrayLike);
    newArray.splice(index, 1);
    return createFileList(newArray);
  }
  
  function createFileList(array) {
    var dataTransfer = new DataTransfer();
    array.forEach(function(file) {
      dataTransfer.items.add(file);
    });
    return dataTransfer.files;
  }
  
  function updateFileNames() {
    showAllImgName.innerHTML = '';
    for (var i = 0; i < files.length; i++) {
      var fileNameSpan = document.createElement('span');
      fileNameSpan.textContent = files[i].name;
      showAllImgName.appendChild(fileNameSpan);
    }
  }
});

document.getElementById('user-search').addEventListener('input', function(event) {
    const user_search = document.getElementById('user-search').value
    alert(user_search)
});

document.getElementById('user-search').addEventListener('focus', function(event) {
    const user_list = document.getElementById('user-list').style;
    user_list.display = 'block'
});

document.getElementById('user-search').addEventListener('blur', function(event) {
    const userList = document.getElementById('user-list').style;
    userList.display = 'none';
});

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
        const userDiv = document.createElement("div");
        userDiv.classList.add("user-selector-item");
        userDiv.dataset.userid = user.userId;

        userDiv.innerHTML = `
            <div class="about-user">
                <p class="user-id m-0 text-muted">${user.userId}</p>
                <p class="user-name m-0">${user.userName}</p>
            </div>
            <div class="user-img">
                <img src="../static/image/test/${user.userImg}" alt="">
            </div>
        `;

        userDiv.addEventListener('click', selectUserItem);

        user_list.appendChild(userDiv);
    });
}

function selectUserItem(event) {
    const userId = event.currentTarget.dataset.userid;
    alert('Selected user ID: ' + userId);
}


