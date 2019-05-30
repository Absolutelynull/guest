<?php
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','active');  //定义常量 用来指定本页的内容(CSS)
    require_once 'includes/DB.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--激活账户</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <?php
        if(!isset($_GET['active'])){
            func_alert_back('非法操作');
        }
//    $conn = DB::db_sgetIntance();
//    $conn->db_fetch_array($conn->db_query("SELECT * FROM tg_user"));
        if(isset($_GET['action']) && $_GET['action'] == 'ok' && $_GET['active']){

//            if($conn->db_fetch_array("SELECT tg_active FROM tg_user WHERE tg_active='{$_GET['active']}' LIMIT 1")){
//                echo 1;
//            }
//            else{
//                echo 2;
//            }

            $conn = DB::db_sgetIntance();
            //存在sql注入  $_GET['active']
            if($conn->db_fetch_array("SELECT tg_active FROM tg_user WHERE tg_active='{$_GET['active']}' LIMIT 1")){
                $conn->db_query("UPDATE tg_user SET tg_active=NULL WHERE tg_active='{$_GET['active']}' LIMIT 1");

                if($conn->get_affected_rows() ==1){
                    func_location('激活成功!','login.php');
                }

            }else{
                func_location('激活失败!','register.php');
            }


        }

    ?>
</head>

<body>


<?php require ROOT_PATH.'includes/header.inc.php';?>
<div id="active">
    <h2>激活账户</h2>
    <p>点击下面链接进行账号激活方可登陆</p>
    <p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"/>点击此链接,进行激活用户!</a></p>


</div>


<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>