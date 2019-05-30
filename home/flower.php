<?php
    session_start();

    define('SCRIPT','flower');
    define('IN_TG',true);
    require dirname(__FILE__).'/includes/common.inc.php';
    if (!isset($_COOKIE['username'])){func_alert_close('此账号未登陆!');}
    $conn = DB::db_sgetIntance();

    if(!isset($_GET['action']) && !isset($_GET['id'])){
        func_location('非法操作!','blog.php');
    }

//获取用户名称
    if(isset($_GET['id'])){
        $id = global_html($_GET['id']);
        $sql = "SELECT tg_id,tg_username FROM tg_user WHERE tg_id='$id' LIMIT 1";

        if($rows =$conn->db_fetch_array($sql)){
            //存在此用户
            $_html = array();
            $_html['touser'] = $rows['tg_username'];
            $_html = global_html($_html);

        }else{
            func_alert_close('用户不存在!');
        }
    }

    //送花朵模块
    if(isset($_GET['action'])){
        if($_GET['action'] == 'send'){
            $_POST = global_html($_POST);
            $sql = "INSERT INTO tg_flower(tg_id,tg_touser,tg_formuser,tg_flower,tg_content,tg_date) 
                                VALUES(null,'{$_POST['touser']}','{$_COOKIE['username']}','{$_POST['flower']}','{$_POST['content']}',NOW())";

            if($conn->get_affected_rows_sql($sql) == 1){
                func_alert_close('赠送成功');
            }else{
                func_alert_close('赠送失败');
            }
        }
    }
    //显示用户名模块
    $id = func_isSetVariable($_GET['id']);
    $sql = "SELECT tg_id,tg_username FROM tg_user WHERE tg_id={$id} LIMIT 1";
    $result = $conn->db_fetch_array($sql);
    $result = global_html($result);






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--写短信</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'/includes/title.inc.php';?>
    <script type="text/javascript" src="js/blog_message.js"></script>
</head>
<body>
<div id="blog_message">
    <h2>送花</h2>
    <form method="POST" action="?action=send">
        <dl>
            <dd>
                <input type="text" readonly="readonly" class="text" id="<?php echo $result['tg_id']?>" name="touser" value="<?php echo $result['tg_username']?>">
                <select name="flower">
                    <?php
                        foreach (range(1,50) as $num){
                            echo "<option value='$num'>x{$num}朵</option>";
                        }
                    ?>
                </select>
            </dd>
            <dd><textarea name="content">俺非常的欣赏你，所以给你送一朵小红花~~~</textarea></dd>
            <dd>
                验证码：<input type="text" class="text yzm" name="code" maxlength="4">
                <img src="code.php" id="code">
            </dd>

            <dd><input type="submit" name="submit" value="添加好友" class="submit"></dd>
        </dl>
    </form>
</div>
</body>
</html>
