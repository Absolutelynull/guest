window.onload = function (){
    var ret = document.getElementById('return');
    var del = document.getElementById('delete');
    //返回列表
    ret.onclick = function () {
        history.back();
    };
    del.onclick = function () {
        // window. = "member_message_detail_delete?id="+this.value;
        if (confirm('是否确定删除短信？')){
            window.location.href = "?action=delete&id="+this.name;
        }
    }
};