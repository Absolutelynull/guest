window.onload = function () {
    var code = document.getElementById('code');
    code.onclick = function () {
        this.src = 'code.php?='+Math.random();

    }


}