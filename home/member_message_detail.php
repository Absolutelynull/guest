<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','member_message_detail');  //定义常量 用来指定本页的内容(CSS)
    $conn = DB::db_sgetIntance();

    //为登录进行访问 非法访问
    if(!isset($_COOKIE['username'])){
        func_location(null,'index.php');
    }
    if(!isset($_GET['id']) || empty($_GET['id'])){
        func_location(null,'member_message.php');
    }

    //删除模块
    if(isset($_GET['action']) && isset($_GET['id'])){
        if($_GET['action'] == 'delete'){
            $del = $conn->get_affected_rows_sql("DELETE FROM tg_message WHERE tg_id='{$_GET['id']}' LIMIT 1");
            if($del == 1){
                func_location('删除短信成功!','member_message.php');
            }else{
                func_location('删除短信失败!','member_message.php');
            }

        }
    }
    //显示模块
    if(isset($_GET['id'])){
        $id = global_html($_GET['id']);
        $conn->db_query("UPDATE tg_message SET tg_state = 1 WHERE tg_id='$id'");
        //$sql = "SELECT * FROM tg_message WHERE tg_id = '$id'";
        //$result = global_html($conn->db_fetch_array("SELECT * FROM tg_message WHERE tg_id = '$id'"));
        $result = global_html($conn->db_fetch_array("SELECT * FROM tg_message WHERE tg_id = '$id'"));
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--短信中心</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'/includes/title.inc.php';?>
    <link rel="stylesheet" type="text/css" href="style/1/blog.css"/>
    <script type="text/javascript" src="js/member_message_detail.js"></script>
</head>

<body>

<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="member">
    <?php require ROOT_PATH.'includes/member.inc.php'?>

    <div id="member_message_detail">
        <h2>短信相信</h2>
        <dl>
            <dd>发信人：<?php echo $result['tg_fromuser'];?></dd>
            <dd>发信时间：<?php echo $result['tg_date'];?></dd>
            <dd>短信内容：<?php echo $result['tg_content'];?></dd>
            <dd class="button">
                <input type="button" id="return" value="返回列表">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" name="<?php echo $result['tg_id']?>" id="delete" value="删除短信" >
            </dd>

        </dl>
    </div>

</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>



