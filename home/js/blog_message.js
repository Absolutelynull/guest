window.onload = function () {
    var img = document.getElementById('code');
    img.onclick = function () {
        img.src = 'code.php?='+Math.random();
    };

    var fm = document.getElementsByTagName('form')[0];
    fm.onsubmit = function () {
        if(fm.code.value == ''){
            alert('验证码不能为空');
            fm.code.focus();
            return false;
        }
        return true;
    }


};