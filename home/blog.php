<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','blog');  //定义常量 用来指定本页的内容(CSS)


    $conn =  DB::db_sgetIntance();
    //分页处理
    $page = 1;  //当前的页数  $_GET['id']
    $pagesize = 10;   //显示的的数量
    //需要将它转换为int $_GET['page']  进行过滤 避免sql注入
    if(isset($_GET['page'])){
        $page = intval($_GET['page']);
    }
    if(empty($page) || $page < 0 || !is_numeric($page)) {
        $page = 1;
    }
    //查询受影响的记录行数
    $num = mysqli_num_rows($conn->db_query('SELECT tg_id FROM tg_user'));
    if($num == 0){
        $pageabsolute = 1;
    }else{
        $pageabsolute = ceil($num/$pagesize);  //总页数
    }
    if($page > $pageabsolute){
        $page = $pageabsolute;
    }
    $pageNum = ceil(($page-1)*$pagesize);


    //显示结果
    $result = $conn->db_query("SELECT tg_id,tg_username,tg_sex,tg_face FROM tg_user ORDER BY tg_reg_time DESC LIMIT $pageNum,$pagesize");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--博友</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'/includes/title.inc.php';?>
    <link rel="stylesheet" type="text/css" href="style/1/blog.css"/>
    <script type="text/javascript" src="js/blog.js"></script>
</head>

<body>

<?php
require ROOT_PATH.'includes/header.inc.php';
?>

<div id="blog">
    <h2>博友列表</h2>
    <?php while ($rows = global_html($conn->db_fetch_array_list($result))){?>
    <dl>
        <dd class="user"><?php echo global_html($rows['tg_username']);?>（男）</dd>
        <dt><img src="<?php echo global_html($rows['tg_face']);?>" alt="<?php echo $rows['tg_username'];?>" style="width: 80px;height: 80px;"></dt>
        <dd class="message"><a href="#" name="message" id="<?php echo global_html($rows['tg_id']);?>">发消息</a></dd>
        <dd class="friend"><a href="javascript:;" name="friend" id="<?php echo global_html($rows['tg_id']);?>">加为好友</a></dd>
        <dd class="guest">写留言</dd>
        <dd class="flower"><a href="javascript:;" name="flower" id="<?php echo global_html($rows['tg_id']);?>">给他送花</a></dd>
    </dl>
    <?php }?>

    <?php

        //进行分页处理  1|2  数字|文本 类型分页
        global_paging(2);
    ?>







</div>




<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>






