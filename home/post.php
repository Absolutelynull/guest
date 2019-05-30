<?php
    session_start();
    //定义个常量，用来授权调用includes里面的文件
    define('IN_TG',true);
    //定义个常量，用来指定本页的内容
    define('SCRIPT','post');
    //引入公共文件
    require dirname(__FILE__).'/includes/common.inc.php';
    if (!isset($_COOKIE['username'])){
        func_location(null,'login.php');
    }
    if(isset($_GET['action'])){
        if($_GET['action'] == 'post'){
            func_check_code($_SESSION['code'],$_POST['code']); //验证码比较
            $conn = DB::db_sgetIntance();
            $data = global_html($_POST);
            $sql = "INSERT INTO tg_article(tg_username,tg_type,tg_title,tg_content,tg_date)
                                VALUES('{$_COOKIE['username']}','{$data['type']}','{$data['title']}','{$data['content']}',NOW())";
            $result = $conn->get_affected_rows_sql($sql);
            $id = $conn->db_insert_id();
            if($result == 1){
                func_location('发表帖子成功！','article.php?id='.$id);
            }else{
                func_location('发表帖子失败','post.php');
            }
        }
    }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>多用户留言系统--发表帖子</title>
        <?php
        require ROOT_PATH.'includes/title.inc.php';
        ?>
        <script type="text/javascript" src="js/code.js"></script>
        <script type="text/javascript" src="js/post.js"></script>
    </head>
<body>
<?php 
	require ROOT_PATH.'includes/header.inc.php';
?>

<div id="post">
	<h2>发表帖子</h2>
	<form method="post" name="post" action="?action=post">
		<dl>
			<dt>请认真填写一下内容</dt>
			<dd>
				类　　型：
				<?php 
					foreach (range(1,16) as $_num) {
						if ($_num == 1) {
							echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'" checked="checked" /> ';
						} else {
							echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'" /> ';
						}
						echo ' <img src="image/icon'.$_num.'.gif" alt="类型" /></label>';
						if ($_num == 8) {
							echo '<br />　　　 　　';
						}
					}
				?>
			</dd>
			<dd>标　　题：<input type="text" name="title" class="text" /> (*必填，2-40位)</dd>
            <dd id="q">贴　　图：<a href="javascript:;">Q图系列[1]</a>　　<a href="javascript:;">Q图系列[2]</a>　　<a href="javascript:;">Q图系列[3]</a>　　</dd>
            <<dd>
                <?php include ROOT_PATH.'/includes/ubb.inc.php'?>
                <textarea name="content" rows="9"></textarea>
            </dd>
			<dd>验 证 码：<input type="text" name="code" class="text yzm"  /> <img src="code.php" id="code" /> <input type="submit" class="submit" value="发表帖子" /></dd>
		</dl>
	</form>
</div>

<?php 
	require ROOT_PATH.'/includes/footer.inc.php';
?>
</body>
</html>
