window.onload = function(){
    var all = document.getElementById('all');
    var fm = document.getElementsByTagName('form')[0];
    all.onclick = function () {
        //form.elements 获取表单内的所有表单
        //alert(form.elements.length());

       if(all.checked == true){
           for(var i=0;i<fm.elements.length;i++){
               if(fm.elements[i].name != 'chkall'){
                   fm.elements[i].checked = fm.chkall.checked;
                  // fm.elements[i].checked = true;
               }
           }
       }else{
           for(var i=0;i<fm.elements.length;i++){
               if(fm.elements[i].name != 'chkall'){
                   fm.elements[i].checked = false;
               }
           }
       }
    }

    fm.onsubmit = function () {
        if(confirm('是否确定删除？')){
            return true;
        }
        return false;
    }
}