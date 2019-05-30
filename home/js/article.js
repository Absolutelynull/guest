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



    code();
    var ubb = document.getElementById('ubb');
    var ubbimg = ubb.getElementsByTagName('img');
    var fm = document.getElementsByTagName('form')[0];
    var font = document.getElementById('font');
    var color = document.getElementById('color');
    var html = document.getElementsByTagName('html')[0];

    alert(fm);
    var q = document.getElementById('q');
    var qa = q.getElementsByTagName('a');
    qa[0].onclick = function (){
        window.open('q.php?num=48&page=qpic/1/','q','width=400,height=400,scrollbars=1');
    };
    qa[1].onclick = function (){
        window.open('q.php?num=10&page=qpic/2/','q','width=400,height=400,scrollbars=1');
    };
    qa[2].onclick = function (){
        window.open('q.php?num=39&page=qpic/3/','q','width=400,height=400,scrollbars=1');
    };


    ubbimg[0].onclick = function () {
        //字体大小
        font.style.display = 'block';
        html.onmouseup = function () {
            font.style.display = 'none';
        }

    };
    ubbimg[2].onclick = function () {
        //粗体
        content("[b][/b]");
    };
    ubbimg[3].onclick = function () {
        //斜体
        content("[i][/i]");

    };
    ubbimg[4].onclick = function () {
        //下划线
        content("[u][/u]");

    };
    ubbimg[5].onclick = function () {
        //删除线
        content("[s][/s]");

    };
    ubbimg[7].onclick = function () {
        //颜色

        color.style.display = 'block';
        fm.f.focus();
        html.onmouseup = function () {
            color.style.display = 'none';
        }


    };
    ubbimg[8].onclick = function () {
        //超链接
        var url = prompt('请输入网址:','http://');
        if(url){
            if(url != 'http://'){
                content('[url]'+url+'[/url]');
            }
        }

    };
    ubbimg[9].onclick = function () {
        //邮件
        content("邮件");

    };
    ubbimg[10].onclick = function () {
        //图片
        content("图片");

    };
    ubbimg[11].onclick = function () {
        //flash
        content("flash");

    };
    ubbimg[12].onclick = function () {
        //影片
        content("影片");

    };
    ubbimg[14].onclick = function () {
        //左区域
        content("左区域");
    };
    ubbimg[15].onclick = function () {
        //中区域
        content("中区域");
    };
    ubbimg[16].onclick = function () {
        //右区域
        content("右区域");
    };
    ubbimg[18].onclick = function () {
        //扩大区域
        fm.content.rows += 1;
    };
    ubbimg[19].onclick = function () {
        //缩小区域
        fm.content.rows -= 1;
    };
    function content(string) {
        fm.content.value += string;
    }

    fm.t.onclick = function () {
        showcolor(this.value);
    }
};
function centerWindow(url,name,height=350,width=500) {
    var left = (screen.width - width)/2;
    var top = (screen.height - height)/2;
window.open(url,name,'height='+height+',width='+width+',top=0'+top+',left='+left+'');
}
function font(size) {
    document.getElementsByTagName('form')[0].content.value += '[size='+size+'][/size]';
}
function showcolor(color) {
    document.getElementsByTagName('form')[0].content.value += '[color]'+color+'[/color]';
}

