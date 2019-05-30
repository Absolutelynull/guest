window.onload = function () {
    /**
     * 点击验证码之后更新验证码
     * @type {HTMLElement | null}
     */
    var faceimg = document.getElementById('faceImage');
    var code = document.getElementById('code');
    code.onclick = function(){
        this.src='code.php?='+Math.random();
    };
    faceimg.onclick = function () {
        window.open('face.php','face','width=400,height=400,top=0,self=0,scrollbars=1');
    };

    var fm = document.getElementsByTagName('form')[0];
    fm.onsubmit = function () {
        if (fm.username.value.length < 2 || fm.username.value.length > 12){
            alert('js用户名不得小于2位或者大于12位');
            fm.username.value = '';
            fm.username.focus();
            return false;
        }


        if(fm.password.value.length < 6 || fm.password.value.length >16){
            alert('js密码不得小于6位或者大于16位');
            fm.password.value = '';
            fm.password.focus();
            return false;
        }
        if(fm.password.value != fm.notpassword.value){
            alert('js二次密码不一致,请重新填写!');
            fm.notpassword.value = '';
            fm.notpassword.focus();
            return false;
        }

        if(fm.question.value.length < 2 || fm.question.value.length > 40){
            alert('js密码提示不得小于2位或者大于40位!');
            fm.question.value = '';
            fm.question.focus();
            return false;

        }
        if(fm.question.value.length < 2 || fm.question.value.length > 40){
            alert('js密码提示不得小于2位或者大于40位!');
            fm.question.value = '';
            fm.question.focus();
            return false;

        }
        if(fm.answer.value.length < 2 || fm.answer.value.length > 20){
            alert('js密码提示不得小于2位或者大于20位!');
            fm.answer.value = '';
            fm.answer.focus();
            return false;
        }
        if(fm.question.value == fm.answer.value){
            alert('js密码提示问题与密码回答不得相同!');
            fm.answer.value = '';
            fm.answer.focus();
            return false;
        }



        if(!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(fm.email.value)) {
            alert('js邮箱格式不正确!!');
            fm.email.value = '';
            fm.email.focus();
            return false;
        }

        if(fm.qq.value != ''){
            if(!/^[1-9]\d{4,13}$/.test(fm.qq.value)) {
                alert('jsQQ格式不正确!!');
                fm.qq.value = '';
                fm.qq.focus();
                return false;
            }
        }


        // if(fm.url.value != '' || fm.url.value !='http://'){
        //     if(!/^https?:\/\/(\w+\.)?[\.\w+\.]+[\.\w+\.]+$/.test(fm.url.value)){
        //         alert('js url地址不正确!');
        //         fm.url.value = '';
        //         fm.url.focus();
        //         return false;
        //     }
        // }
        return true;

    }

}