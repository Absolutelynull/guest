window.onload = function () {
    var code = document.getElementById('code');
    code.onclick = function(){
        code.src = 'code.php?='+Math.random();
    }
 

    fm.onsubmit = function () {
        if(fm.password.value != ''){
            if(fm.password.value.length < 6 || fm.password.value.length >16){
                alert('密码不得小于6位或者大于16位');
                fm.password.value = '';
                fm.password.focus();
                return false;
            }
        }

        if(fm.email.value != ''){
            if(!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(fm.email.value)) {
                alert('邮箱格式不正确!!');
                fm.email.value = '';
                fm.email.focus();
                return false;
            }

        }

        if(fm.qq.value != ''){
            if(!/^[1-9]\d{4,13}$/.test(fm.qq.value)) {
                alert('QQ格式不正确!!');
                fm.qq.value = '';
                fm.qq.focus();
                return false;
            }
        }


        if(fm.url.value != ''){
            if(!/^https?:\/\/(\w+\.)?[\.\w+\.]+[\.\w+\.]+$/.test(fm.url.value)){
                alert('url地址不正确!');
                fm.url.value = '';
                fm.url.focus();
                return false;
            }
        }
        return true;
        
    }




}