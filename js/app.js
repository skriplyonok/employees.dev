window.onload = function() {
    var selectMenu = document.getElementsByName('select-menu')[0];
    var selectForm = document.getElementById('select-menu-form');
    selectMenu.onchange = function () {
        selectForm.submit();
        return false;
    }
    var pagination = document.getElementById('pagination');
    var a = pagination.getElementsByTagName('a');
    for (var i = 0; i < a.length; i++) {
        a[i].onclick = function(){
            selectForm.setAttribute('action', this.getAttribute('href'));
            selectForm.submit();
            return false;
        }
    }
};