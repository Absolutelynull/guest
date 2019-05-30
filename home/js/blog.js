window.onload = function () {

    //弹出发信息窗口
    var message = document.getElementsByName('message');
    for (var i =0;i<message.length;i++){
        message[i].onclick = function () {
            centerWindow('blog_message.php?id='+this.id,'message');
        }
    }

    //弹出加好友窗口
    var friend = document.getElementsByName('friend');
    for(var i = 0;i<friend.length;i++){
        friend[i].onclick = function () {
            centerWindow('blog_friend.php?id='+this.id,'friend');
        }
    }

    var flower = document.getElementsByName('flower');
    for(var i = 0;i<flower.length;i++){
        flower[i].onclick = function () {
            centerWindow('flower.php?id='+this.id,'flower');
        }
    }



};
function centerWindow(url,name,height=350,width=500) {
    var left = (screen.width - width)/2;
    var top = (screen.height - height)/2;
    window.open(url,name,'height='+height+',width='+width+',top=0'+top+',left='+left+'');

}

