document.getElementById('file-upload').addEventListener('change', function(event) {
  var container = document.getElementById('image-list');
  container.innerHTML = ''; // Clear previous images
  
  var files = event.target.files;
  alert(files)
  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    if (file.type.match('image.*')) {
      var reader = new FileReader();
      reader.onload = function(e) {

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
      }
      reader.readAsDataURL(file);
    }
  }
});