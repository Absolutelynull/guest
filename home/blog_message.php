<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','blog_message');  //定义常量 用来指定本页的内容(CSS)


    if(!isset($_GET['action']) && !isset($_GET['id'])){
        func_location('非法操作!','blog.php');

    }
    if(!isset($_COOKIE['username'])){ func_alert_close('此账号未登陆!');}
    $conn = DB::db_sgetIntance();

    //发送信息模块
    if(isset($_GET['action']) && $_GET['action'] =='write'){
        //发送信息
        func_check_code($_POST['code'],$_SESSION['code']);
        $data = array();
        $data['touser'] = $_POST['touser'];  //收信人
        $data['content'] = $_POST['content'];
        $data['fromuser'] = $_COOKIE['username'];
        $data = global_html($data);
        //判断内容是否超出200字符
        if(!func_check_isStringCount($data['content'],0,200)){
            func_alert_back('短信内容不能超出200字符,请重新填写!');
        }
        global_html($data); //进行转义 过滤

        $sql = "INSERT INTO tg_message(
                                       tg_touser,
                                       tg_fromuser,
                                       tg_content,
                                       tg_date)
                            VALUES (
                                    '{$data['touser']}',
                                    '{$data['fromuser']}',
                                    '{$data['content']}',
                                    NOW())";

        $conn->db_query($sql);
        if($conn->get_affected_rows() == 1){

            func_alert_back('发送成功!');
        }else{
            func_location('发送失败！','blog_message.php');
        }
        exit();
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
        <h2>写短信</h2>
        <form method="post" action="?action=write">
            <dl>
                <dd><input type="text" readonly="readonly" class="text" name="touser" value="<?php echo $_html['touser'];?>"></dd>
                <dd><textarea name="content"></textarea></dd>
                <dd>
                    验证码：<input type="text" class="text yzm" name="code" maxlength="4">
                    <img src="code.php" id="code">
                </dd>
                <dd><input type="submit" name="submit" value="发送信息" class="submit"></dd>


            </dl>

        </form>


    </div>


</body>
</html>






