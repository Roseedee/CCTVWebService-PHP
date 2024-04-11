

function getPageHeight() {
    var headerHeight = document.getElementById('header').clientHeight;
    var footerHeight = document.getElementById('footer').clientHeight;  
    var my_container = document.getElementById('my-container');
    var bodyHeight = document.body.clientHeight;

    var min_height = bodyHeight - headerHeight - footerHeight - 47;
    //set min height
    my_container.setAttribute("style", "min-height: " + min_height + "px;");
}