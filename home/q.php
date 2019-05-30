<?php
    define('IN_TG',true); //非法调用

    define('SCRIPT','face');  //用来指定本页的内容(CSS)
    //引用公用文件
    require dirname(__FILE__).'/includes/common.inc.php';
    if(isset($_GET['num']) && isset($_GET['page'])){
        if(!is_dir(ROOT_PATH.$_GET['page'])){
            //文件路径不存在
            func_alert_close('非法操作！');
        }
    }else{
        func_alert_close('非法访问!');
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>选择Q图</title>
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <script type="text/javascript" src="js/qopener.js"></script>
</head>
<body>
<div id="face">

    <h3>选择头像</h3>
    <dl>
        <?php foreach (range(1,$_GET['num']) as $num){
            echo '<dd><img src="'.$_GET['page'].'/'.$num.'.gif" alt="'.$_GET['page'].'/'.$num.'.gif" title="头像'.$num.'"/></dd>';
            }
        ?>

    </dl>

</div>


</body>
</html>
