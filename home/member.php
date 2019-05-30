<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','member');  //定义常量 用来指定本页的内容(CSS)

    //为登录进行访问 非法访问
    if(!isset($_COOKIE['username'])){
        func_location(null,'index.php');
    }

    $conn = DB::db_sgetIntance();
    $result = $conn->db_fetch_array('SELECT * FROM tg_user where tg_username = "'.$_COOKIE['username'].'"');
    $rows = global_html($result);
    switch ($rows['tg_level']){
        case 0:
            $rows['tg_level'] = '普通身份';
            break;
        case 1:
            $rows['tg_level'] = '管理员';
            break;
        default:
            $rows['tg_level'] = 'null';
            break;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--个人中心</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'/includes/title.inc.php';?>
    <link rel="stylesheet" type="text/css" href="style/1/blog.css"/>
</head>

<body>

<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="member">
    <?php require ROOT_PATH.'includes/member.inc.php'?>

    <div id="member_main">
        <h2>会员管理中心</h2>
        <dl>
            <dd>用户名：<?php echo global_html($rows['tg_username'])?></dd>
            <dd>性&nbsp;&nbsp;&nbsp;&nbsp;别：<?php echo global_html($rows['tg_sex'])?></dd>
            <dd>头&nbsp;&nbsp;&nbsp;&nbsp;像：<?php echo global_html($rows['tg_face'])?></dd>
            <dd>电子邮件：<?php echo global_html($rows['tg_email'])?></dd>
            <dd>主&nbsp;&nbsp;&nbsp;&nbsp;页：<?php echo global_html($rows['tg_url'])?></dd>
            <dd>Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q：<?php echo global_html($rows['tg_qq'])?></dd>
            <dd>注册时间：<?php echo global_html($rows['tg_reg_time'])?></dd>
            <dd>上一次登录IP：<?php echo global_html($rows['tg_loglast_ip'])?></dd>
            <dd>上一次登录时间：<?php echo global_html($rows['tg_loglast_time'])?></dd>
            <dd>登录次数：<?php echo global_html($rows['tg_login_count'])?></dd>
            <dd>身&nbsp;&nbsp;&nbsp;&nbsp;份：<?php echo global_html($rows['tg_level'])?></dd>
        </dl>

    </div>



</div>




<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>






