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
        var img = document.createElement('img');
        img.src = e.target.result;
        img.style.height = '150px'; // Set maximum height for display
        container.appendChild(img);
      }
      reader.readAsDataURL(file);
    }
  }
});