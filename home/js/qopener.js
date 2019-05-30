function _opener(src) {  //opener 这个是保留关键字 切记！！！切记！！！
   opener.document.getElementsByTagName('form')[0].content.value += '[img]'+src+'[/img]';

    // opener.document.getElementById('faceImage').src = src;
    // opener.document.regsiter.face.value = src;
}
window.onload = function () {
    var img = document.getElementsByTagName('img');
    for(var i=0;i<img.length;i++){
        img[i].onclick = function () {
            _opener(this.alt);

        }
    }
}





