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
  
  document.getElementById('user-search').addEventListener('focus', function(event) {
    const userList = document.getElementById('worksite-list').style;
      userList.display = 'none';
      const user_list = document.getElementById('user-list').style;
      user_list.display = 'block'
  });
  
  document.getElementById('my-dropdown').addEventListener('mouseleave', function(event) {
      const userList = document.getElementById('user-list').style;
      userList.display = 'none';
  });

  document.getElementById('worksite-search').addEventListener('focus', function(event) {
      const userList = document.getElementById('user-list').style;
      userList.display = 'none';
      const user_list = document.getElementById('worksite-list').style;
      user_list.display = 'block'
  });
  
  document.getElementById('my-dropdown').addEventListener('mouseleave', function(event) {
      const userList = document.getElementById('worksite-list').style;
      userList.display = 'none';
  });