document.getElementById('img-input').addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('user-img').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
})