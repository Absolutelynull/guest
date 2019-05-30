<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','blog_friend');  //定义常量 用来指定本页的内容(CSS)
    require_once ROOT_PATH.'/includes/DB.php';

    if(!isset($_COOKIE['username'])){ func_alert_close('此账号未登陆!');}
    $conn = DB::db_sgetIntance();
    if(!isset($_GET['action']) && !isset($_GET['id'])){
        func_location('非法操作!','blog.php');

    }


    //获取用户名称
    if(isset($_GET['id'])){
        $id = global_html($_GET['id']);
        $sql = "SELECT tg_username FROM tg_user WHERE tg_id='$id' LIMIT 1";
        if($rows =$conn->db_fetch_array($sql)){
            //存在此用户
            $_html = array();
            $_html['touser'] = $rows['tg_username'];
            $_html = global_html($_html);

        }else{
            func_alert_close('用户不存在!');
        }
    }
    $userRows = global_html($conn->db_fetch_array("SELECT tg_id,tg_username FROM tg_user WHERE  tg_id = '{$_GET['id']}'"));


    if(isset($_GET['action'])){
        if($_GET['action'] == 'add'){
            $postDate = global_html($_POST);
            //验证码判断
            func_check_code($_SESSION['code'],$_POST['code']);
            //判断是否添加自己
            if($postDate['touser'] == $_COOKIE['username']){
                func_alert_close('最近你自己长得丑,但是也不能添加自己为好友噢!');
            }

            //查看申请已经发送好友申请  0表示验证未通过,过未验证   1验证成功,好友关系
            $checkFriendSql_0 = "SELECT tg_touser,tg_fromuser,tg_state FROM tg_friend WHERE (tg_touser='{$postDate['touser']}' AND tg_fromuser='{$_COOKIE['username']}' AND tg_state = 0) OR (tg_touser='{$_COOKIE['username']}' AND tg_fromuser='{$postDate['touser']}' AND tg_state = 0) LIMIT 1";
            $checkFriendSql_1 = "SELECT tg_touser,tg_fromuser,tg_state FROM tg_friend WHERE (tg_touser='{$postDate['touser']}' AND tg_fromuser='{$_COOKIE['username']}' AND tg_state = 1) OR (tg_touser='{$_COOKIE['username']}' AND tg_fromuser='{$postDate['touser']}' AND tg_state = 1) LIMIT 1";
            if($A1 = $conn->get_affected_rows_sql($checkFriendSql_1) == 1){  //判断是否已经是好友了
                func_alert_close('不要在申请好友了,日了dog!您们已经是好友啦~~~');
            }else if($a2 = $conn->get_affected_rows_sql($checkFriendSql_0) == 1){//判断是否已经发送过验证信息

                func_alert_close('您已发送过验证信息了~~~');
            }else{
                $sql = "INSERT INTO 
                                tg_friend(
                                        tg_id,
                                        tg_touser,  
                                        tg_fromuser,  
                                        tg_content, 
                                        tg_state, 
                                        tg_date)
                                values(
                                    NULL,
                                    '{$postDate['touser']}',
                                    '{$_COOKIE['username']}',
                                    '{$postDate['content']}',
                                    0,
                                    NOW()
                                )";
                if($conn->get_affected_rows_sql($sql)){
                    func_alert_close('恭喜您,发送验证信息成功,坐等好友验证通过吧~');
                }else{
                    func_alert_close('发送好友申请失败~');
                }

            }

        }
    }






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
        <h2>添加好友</h2>
        <form method="POST" action="?action=add&id=<?php echo $userRows['tg_id']?>">
            <dl>
                <dd><input type="text" readonly="readonly" class="text" name="touser" value="<?php echo $userRows['tg_username'];?>"></dd>
                <dd><textarea name="content">我非常想和你交朋友~~~</textarea></dd>
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






