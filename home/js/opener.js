
//注册页面头像设置  这种方法已经过时

function _opener(src) {  //opener 这个是保留关键字 切记！！！切记！！！
    //Opener 表示父窗口  document表示文档
    /*
    var imgsrc = opener.document.getElementById('faceImage');
    imgsrc.src = src;
    opener.document.regsiter.face.value = src;
    */
    opener.document.getElementById('faceImage').src = src;
    opener.document.regsiter.face.value = src;
}
window.onload = function () {
    var img = document.getElementsByTagName('img');
    for(var i=0;i<img.length;i++){
        img[i].onclick = function () {
            _opener(this.alt);

        }
    }
}





