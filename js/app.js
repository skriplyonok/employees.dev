window.onload = function() {
    var selectLimit = document.getElementsByName('select-limit')[0];
    var selectForm = document.getElementById('select-menu-form');
    var selectDepartment = document.getElementsByName('select-department')[0];

    selectLimit.onchange = function () {
        selectForm.submit();
        return false;
    }

    selectDepartment.onchange = function () {
        var value = this.options[this.selectedIndex].value;
        var url = window.location.pathname;
        url = url.split('/');
        if(!isNaN(url[url.length-1])){
            url.pop();
        }
        if(url.length == 2){
            url[url.length] = value;
        }else{
            url[url.length-1] = value;
        }
        url = url.join('/');
        window.location.pathname = url;
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
}