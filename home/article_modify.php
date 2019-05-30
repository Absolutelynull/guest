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
    $conn = DB::db_sgetIntance();

    //修改模块
    if(isset($_GET['action'])){
        if($_GET['action'] == 'modify'){
            $html = global_html($_POST);
            func_check_code($_SESSION['code'],$_POST['code']);
            if(!empty($html)){
                $sql = "SELECT tg_id FROM tg_article WHERE tg_id = '{$html['id']}' AND tg_username = '{$_COOKIE['username']}'";
                if($conn->get_affected_rows_sql($sql)){
                    $sql = "UPDATE tg_article SET
                                          tg_type='{$html['type']}',
                                          tg_title='{$html['title']}',
                                          tg_content='{$html['content']}',
                                          tg_last_modify_date = NOW()
                                      WHERE tg_id = '{$html['id']}'
                                          ";
                    if($conn->get_affected_rows_sql($sql)){
                        func_location('修改帖子成功!','article.php?id='.$html['id']);
                    }else{
                        func_alert_close('修改帖子失败！');
                    }
                }else{
                    func_location(null,'index.php');  //越权修改帖子
                }
            }else{
                //没有任何数据传过来修改
                func_location(null,'index.php');
            }

        }
    }


    //显示模块
    if(isset($_GET['id'])){
        $id = global_html(intval($_GET['id']));
        if(!empty($id)){
            $sql = "SELECT tg_id FROM tg_article WHERE tg_id = '$id' AND tg_username = '{$_COOKIE['username']}'";
            if($conn->get_affected_rows_sql($sql)){
                $sql = "SELECT tg_id,tg_type,tg_username,tg_title,tg_content FROM tg_article WHERE tg_id = '$id'";
    //            if($article_modify_result->num_rows == 1){  //获取执行sql语句 受影响的语句
                if(!$rows = global_html($conn->db_fetch_array($sql))) {
                    func_location('帖子不存在', 'index.php');
                }
            }else{
                func_location(null,'index.php');  //越权修改帖子
            }
        }else{
            func_location(null,'index.php');
        }

    }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>多用户留言系统--修改帖子</title>
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
	<h2>修改帖子</h2>
	<form method="post" name="post" action="?action=modify">
        <input type="hidden" name="id" value="<?php echo $rows['tg_id']?>">
		<dl>
			<dt>请认真填写一下内容</dt>
			<dd>
				类　　型：
				<?php 
					foreach (range(1,16) as $_num) {
						if ($_num == $rows['tg_type']) {
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
			<dd>标　　题：<input type="text" name="title" class="text" value="<?php echo $rows['tg_title']?>" /> (*必填，2-40位)</dd>
            <dd id="q">贴　　图：<a href="javascript:;">Q图系列[1]</a>　　<a href="javascript:;">Q图系列[2]</a>　　<a href="javascript:;">Q图系列[3]</a>　　</dd>
            <dd>
                <?php include ROOT_PATH.'/includes/ubb.inc.php'?>
                <textarea name="content" rows="9"><?php echo $rows['tg_content']?></textarea>
            </dd>
			<dd>验 证 码：<input type="text" name="code" class="text yzm"  /> <img src="code.php" id="code" /> <input type="submit" class="submit" value="修改帖子" /></dd>
		</dl>
	</form>
</div>

<?php 
	require ROOT_PATH.'/includes/footer.inc.php';
?>
</body>
</html>
