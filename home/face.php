<?php
    define('IN_TG',true); //非法调用

    define('SCRIPT','face');  //用来指定本页的内容(CSS)
    //引用公用文件
    require dirname(__FILE__).'/includes/common.inc.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>头像选择</title>
    <?php require ROOT_PATH.'includes/title.inc.php';?>

    <script type="text/javascript" src="js/opener.js"></script>
</head>
<body>
<div id="face">

    <h3>选择头像</h3>
    <dl>

        <?php foreach (range(1,9) as $num){
            echo '<dd><img src="face/m0'.$num.'.gif" alt="face/m0'.$num.'.gif" title="头像'.$num.'" style="width: 80px;height: 80px;"/></dd>';
            }
        ?>
        <?php foreach (range(10,64) as $num){
            echo '<dd><img src="face/m'.$num.'.gif" alt="face/m'.$num.'.gif" title="头像'.$num.'" style="width: 80px;height: 80px;"/></dd>';
        }
        ?>

    </dl>

</div>


</body>
</html>
