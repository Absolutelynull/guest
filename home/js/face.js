window.onload = function () {
    var faceimg = document.getElementById('faceImage');
    var code = document.getElementById('code');
    code.onclick = function(){
        this.src='code.php?='+Math.random();
    };

    faceimg.onclick = function () {
        window.open('face.php','face','width=400,height=400,top=0,self=0,scrollbars=1');
    };


};


