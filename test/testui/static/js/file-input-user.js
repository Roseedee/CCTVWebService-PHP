document.getElementById('image-selector-add-user').addEventListener('change', function(event) {
    var container = document.getElementById('image-container');
    container.innerHTML = '';
    
    var file = event.target.files[0];
    
    if (file && file.type.match('image.*')) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('user-image-preview');
        container.appendChild(img);
      };
      reader.readAsDataURL(file);
    }
  });