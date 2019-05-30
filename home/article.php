<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','article');  //定义常量 用来指定本页的内容(CSS)
    $conn = DB::db_sgetIntance();

    //回帖设置
    if(isset($_GET['action'])){
        if($_GET['action'] == 'rearticle'){
            $html = global_html($_POST);
            func_check_code($_SESSION['code'],$_POST['code']);
            if(empty($html['content'])){
                func_location('回帖内容不能为空哦!','article.php?id='.$html['id']);
            }
            $sql = "INSERT INTO tg_reply(tg_id,tg_commentid,tg_username,tg_content,tg_date)
                                 VALUES(null,'{$html['id']}','{$_COOKIE['username']}','{$html['content']}',NOW())";
            $result = $conn->get_affected_rows_sql($sql);
            if($result == 1){
                $conn->db_query("UPDATE tg_article SET tg_commentcount = tg_commentcount+1 WHERE tg_id = '{$html['id']}'");
                func_location('回帖成功!','article.php?id='.$html['id']);
            }else{
                func_location('回帖错误!','article.php?id='.$html['id']);
            }
        }
    }
    //帖子显示
    if(isset($_GET['id'])){
        $id = intval(global_html($_GET['id']));
        if (!empty($id) && is_numeric($id)){
            $sql = "SELECT * FROM tg_article WHERE tg_id = '$id'";
            $result = global_html($conn->db_fetch_array($sql));
//            print_r($result);
            if(!$result){
                func_alert_close('文章不存在!');
            }
            //阅读量
            $conn->db_query("UPDATE tg_article SET tg_readcount = tg_readcount+1 WHERE tg_id = '$id'");

            //最后修改时间
            if($result['tg_last_modify_date'] != '0000-00-00 00:00:00'){
                $result['tg_last_modify_date_string'] = "作者：[{$result['tg_username']}] 于{$result['tg_last_modify_date']} 修改该文章";
            }
            //文章作者模块
            $member_sql = "SELECT tg_id,tg_username,tg_sex,tg_face,tg_email,tg_url FROM tg_user WHERE tg_username = '{$result['tg_username']}'";
            $member_result = global_html($conn->db_fetch_array($member_sql));
//            print_r($member_result);
            if(!$member_result){
                //会员已被删除
            }
            //回帖评论模块
            $pagesize=5;
            $sql = "SELECT tg_id FROM tg_reply WHERE tg_commentid = '$id'";
            $reply_count = $conn->db_query($sql);
            $resultCount = mysqli_num_rows($reply_count); //获取评论总数

            //主题帖子修改
            if(isset($_COOKIE['username'])){
                $member_modify = array();
                if($member_result['tg_username'] == $_COOKIE['username']){
                    $subject_modify['article_modify'] = "<a href='article_modify.php?id=$id'>[修改]</a>";
                }
            }
            echo $resultCount;

            //显示回帖
            $page_id = isset($_GET['page']) ? $_GET['page']:1;
            if($resultCount>0){
                $page = ceil($resultCount/$pagesize);  //总页数
                //当前页面  $_GET['page'] 值
                $page_id = func_check_page($page_id,$page);
                //sql查询语句 开始位置
                $pageNum = ceil(($page_id-1)*$pagesize);
                //输出结果
                $sql = "SELECT * FROM tg_reply WHERE tg_commentid = '$id' ORDER BY tg_date DESC LIMIT $pageNum,$pagesize";;
                $reply_Result = $conn->db_query($sql);
            }

        }else{
            func_location('非法访问1','index.php');
        }
    }else{
        //没有传入文章id参数
        func_location('非法访问2','index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--帖子详情</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'/includes/title.inc.php';?>
    <link rel="stylesheet" type="text/css" href="style/1/blog.css"/>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/blog.js"></script>
    <script type="text/javascript" src="js/post.js"></script>
</head>
<body>

<?php
    require ROOT_PATH.'includes/header.inc.php';
?>

<div id="article">
    <?php
        if($page_id == 1){
    ?>
    <h2>主题：<?php echo $result['tg_title'];?></h2>
    <div id="subject">
        <dl>
            <dd class="user"><?php echo $member_result['tg_username']?>(<?php echo $member_result['tg_sex']?>)  [楼主]</dd>
            <dt><img src="<?php echo $member_result['tg_face']?>" alt="" style="width: 80px;height: 80px;"></dt>
            <dd class="message"><a href="#" name="message" id="<?php echo $member_result['tg_id']?>">发消息</a></dd>
            <dd class="friend"><a href="javascript:;" name="friend" id="<?php echo $member_result['tg_id']?>">加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href="javascript:;" name="flower" id="<?php echo $member_result['tg_id']?>">给他送花</a></dd>
            <dd class="email"><a href="mailto:<?php echo $member_result['tg_id']?>">邮件：<?php echo $member_result['tg_email']?></a></dd>
            <dd class="url">网址：<a href="<?php echo $member_result['tg_url']?>" target="_blank"><?php echo $member_result['tg_url']?></a></dd>
        </dl>
        <div class="content">
            <div class="user">
                <span><?php echo isset($subject_modify) ?$subject_modify['article_modify']:"";?>   楼主</span><?php echo $member_result['tg_username'];?>   发表时间：<?php echo $result['tg_date']?>
            </div>
            <h3>主题：<?php echo $result['tg_title']?><img src="image/icon<?php echo $result['tg_type']?>.gif" alt="icon"></h3>
            <div class="detail">
                <?php echo func_ubb($result['tg_content'])?>
            </div>
            <div class="read">
                <p><?php echo isset($result['tg_last_modify_date_string']) ?$result['tg_last_modify_date_string']:"" ?></p>
                阅读量：(<?php echo $result['tg_readcount']?>)  评论量(<?php echo $result['tg_commentcount']?>)
            </div>
        </div>
    </div>
    <?php }?>

    <p class="line">
    <?php
    if($resultCount > 0 ){
        $floor = 1;
        while ($rows = global_html($conn->db_get_fetch_array_result($reply_Result))){
            if($floor == 1){
                if($rows['tg_username'] == $member_result['tg_username']){
                    $floor_user = '&nbsp;&nbsp;[楼主]';
                }else{
                    $floor_user = '&nbsp;&nbsp;[沙发]';
                }
            }else{
                $floor_user ='';
            }
            //显示评论者信息
            $sql = "SELECT tg_id,tg_username,tg_sex,tg_face,tg_email,tg_url FROM tg_user WHERE tg_username = '{$rows['tg_username']}'";
            $member_detail = $conn->db_fetch_array($sql);  //评论者详细信息

    ?>
    <div class="re">
        <dl>
            <dd class="user"><?php echo $member_detail['tg_username']?>(<?php echo $member_detail['tg_sex']?>)<?php echo $floor_user;?></dd>
            <dt><img src="<?php echo $member_detail['tg_face']?>" alt="" style="width: 80px;height: 80px;"></dt>
            <dd class="message"><a href="#" name="message" id="<?php echo $member_detail['tg_id']?>">发消息</a></dd>
            <dd class="friend"><a href="javascript:;" name="friend" id="<?php echo $member_detail['tg_id']?>">加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href="javascript:;" name="flower" id="<?php echo $member_detail['tg_id']?>">给他送花</a></dd>
            <dd class="email"><a href="mailto:<?php echo $member_detail['tg_id']?>">邮件：<?php echo $member_detail['tg_email']?></a></dd>
            <dd class="url">网址：<a href="<?php echo $member_detail['tg_url']?>" target="_blank"><?php echo $member_detail['tg_url']?></a></dd>
        </dl>
        <div class="content">
            <div class="user">
                <span><?php echo $floor+($page_id-1)*$pagesize;?>#</span>发表时间：<?php echo $rows['tg_date']?>
            </div>
            <div class="detail">
                <?php echo func_ubb($rows['tg_content']);?>
            </div>
        </div>
    </div>
    <p class="line">
    <?php $floor++; }}?>

    <?php
        if($resultCount>0){
            page_text(1,$pageNum,$resultCount,SCRIPT,'id='.$id);
        }
    ?>
    <p class="line">
    <div id="post">
        <h3>回复帖子</h3>
        <form method="post" action="?action=rearticle">
            <dl>
                <dd><input type="hidden" name="id" value="<?php echo $result['tg_id']?>"></dd>
                <dd id="q">贴　　图：<a href="javascript:;">Q图系列[1]</a>　　<a href="javascript:;">Q图系列[2]</a>　　<a href="javascript:;">Q图系列[3]</a>　　</dd>
                <dd>
                    <?php include ROOT_PATH.'/includes/ubb.inc.php'?>
                    <textarea name="content" rows="9"></textarea>
                </dd>
                <dd>验 证 码：<input type="text" name="code" class="text yzm"  /> <img src="code.php" id="code" /> <input type="submit" class="submit" name="" value="回复帖子" /></dd>
            </dl>
        </form>
    </div>

</div>




<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>






