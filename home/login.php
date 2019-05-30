
<?php
    session_start();
    header('Content-Type:text/html;charset=utf-8');
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','login');  //定义常量 用来指定本页的内容(CSS)
    if(func_getLoginStatus()){
        func_location(null,'index.php');
    }

    if(isset($_COOKIE['username'])){
        func_location('您已经成功登录了!','index.php');
        //header('location:index.php');
    }

    if(isset($_GET['action'])){
        if($_GET['action'] == 'login'){
            if(isset($_POST['code'])){
                if($_SESSION['code'] != $_POST['code']){
                    //  //验证码不正确
                    //return false;
                    func_alert_back('验证码错误,请重新输入!');
                }
            }else{
                func_location(null,'login.php');
            }
            $conn = DB::db_sgetIntance();

            //这个需要加过滤用户名和密码
            $username = global_html($_POST['username']);
            $password = global_html(sha1($_POST['password']));
            $sql = "SELECT * FROM tg_user WHERE tg_username='$username' AND tg_password='$password' ";
            echo $sql;
            $conn->db_query($sql);
            if($conn->get_affected_rows()== 1){
                //登录成功!
                $conn->db_query("UPDATE tg_user SET 
                                                        tg_loglast_time=NOW(),
                                                        tg_loglast_ip='{$_SERVER["REMOTE_ADDR"]}',
                                                        tg_login_count =tg_login_count+1
                                                    WHERE tg_username = '$username' LIMIT 1");
                func_setCookie($username,$_POST['time']);
                func_location(null,'index.php');

            }else{
                func_location('登录失败!','login.php');
            }
            print_r($conn);
            unset($conn);
            print_r($conn);



        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--首页</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <script type="text/javascript" src="js/login.js"></script>
    <?php require ROOT_PATH.'includes/title.inc.php';?>
</head>

<body>

<?php
    require ROOT_PATH.'includes/header.inc.php';
?>
<div id="login">
    <form method="post" action="login.php?action=login" name="form">
        <h2>会员登录</h2>
        <dl>
            <dt>请认真填写以下内容</dt>
            <dd>账&nbsp;&nbsp;&nbsp;号：<input type="text" name="username" value="username"></dd>
            <dd>密&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" value="password"></dd>
            <dd>
                验证码：<input type="text" name="code" size="7">
                <img src="code.php" id="code" name="code">
            </dd>
            <dd>保&nbsp;&nbsp;&nbsp;留：
                <input type="radio" name="time" value="0" checked="checked">不保留
                <input type="radio" name="time" value="1">一天
                <input type="radio" name="time" value="2">三天
            </dd>

            <dd>
                <input type="submit" name="submit" value="登录" class="btn"/>
                <input type="reset" name="reset" value="重置" class="btn"/>
            </dd>
        </dl>


    </form>


</div>



<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>














