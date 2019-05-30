<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','index');  //定义常量 用来指定本页的内容(CSS)
    $conn = DB::db_sgetIntance();
    
    //显示模块
    //分页模块
    $sql = "SELECT tg_id FROM tg_article";
    $pagesize = 5;
    $resultCount = mysqli_num_rows($conn->db_query($sql));  //帖子总数
    if($resultCount > 0){
        $page = ceil($resultCount/$pagesize);   //总页数
        $page_id = isset($_GET['page']) ? $_GET['page'] : 1;
        $page_id = func_check_page($page_id,$page);  //当前页面
        $pageNum = ceil(($page_id-1)*$pagesize);
        $sql = "SELECT * FROM tg_article ORDER BY tg_date DESC LIMIT $pageNum,$pagesize";
        $result = $conn->db_query($sql);
    }
    //xml
    $filename = "filexml.xml";
    $html = func_get_xml($filename);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--首页</title>
    <link rel="shortcuticon" href="favicon.ico"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <link type="text/css" href="style/1/index.css">
    <script type="text/javascript" src="js/blog.js"></script>
</head>

<body>

<?php
    require ROOT_PATH.'includes/header.inc.php';
?>

<div id="list">
    <h2>帖子列表</h2>
    <a href="post.php" class="post">发表帖子</a>

    <ul class="article">
        <?php
            if($resultCount > 0){
                while ($rows = global_html($conn->db_get_fetch_array_result($result))) {
                   //print_r($rows);
                    echo "<li class='icon{$rows['tg_type']}'><em>阅读(<strong>{$rows['tg_readcount']}</strong>) 评论(<strong>{$rows['tg_commentcount']}</strong>)</em><a href='article.php?id={$rows['tg_id']}'>{$rows['tg_title']}</a></li>";
                }
            }
        ?>
        <?php
        //显示分页处理
        if ($resultCount>0){
            page_text($page_id,$page,$resultCount,SCRIPT);
        }
        ?>

    </ul>
</div>

<div id="user">
    <h2>新进会员</h2>
    <dl>
        <dd class="user"><?php echo $html['username']."({$html['sex']})"?></dd>
        <dt><img src="<?php echo $html['face']?>" alt="" style="width: 80px;height: 80px;"></dt>
        <dd class="message"><a href="#" name="message" id="<?php echo $html['id']?>">发消息</a></dd>
        <dd class="friend"><a href="javascript:;" name="friend" id="<?php echo $html['id']?>">加为好友</a></dd>
        <dd class="guest">写留言</dd>
        <dd class="flower"><a href="javascript:;" name="flower" id="<?php echo $html['id']?>">给他送花</a></dd>
        <dd class="email">邮件：<a href="mailto:<?php echo $html['email']?>"><?php echo $html['email']?></a></dd>
        <dd class="url">网址：<a href="<?php echo $html['url']?>" target="_blank"><?php echo $html['url']?></a></dd>
    </dl>
</div>

<div id="pics">
    <h2>最近图片</h2>
</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>