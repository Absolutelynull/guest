<?php
    session_start();

    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','member_modify');  //定义常量 用来指定本页的内容(CSS)

    //为登录进行访问 非法访问
    if(!isset($_COOKIE['username'])){
        func_location(null,'index.php');
    }

    $conn = DB::db_sgetIntance();
    $result = $conn->db_fetch_array('SELECT tg_level,tg_username,tg_sex,tg_face,tg_email,tg_url,tg_url,tg_qq FROM tg_user where tg_username = "'.$_COOKIE['username'].'"');
    $rows = global_html($result);



    if(isset($_GET['action'])){
        func_check_code($_POST['code'],$_SESSION['code']);  //判断验证码是否相等

        $password = func_modify_Password($_POST['password']);
        $email = func_check_email($_POST['email']);
        $url = func_check_url($_POST['url']);
        $qq = func_check_qq($_POST['qq']);

        if(empty($_POST['password'])){
            $conn->db_query("UPDATE tg_user SET 
                                                tg_sex = '{$_POST['sex']}',
                                                tg_face = '{$_POST['face']}',
                                                tg_email = '{$email}',
                                                tg_url = '{$url}',
                                                tg_qq = '{$qq}'
                                             WHERE 
                                                tg_username = '{$_COOKIE['username']}'
                             ");

        }else {
             $conn->db_query("UPDATE tg_user SET 
                                                tg_password = '{$password}',
                                                tg_sex = '{$_POST['sex']}',
                                                tg_face = '{$_POST['face']}',
                                                tg_email = '{$email}',
                                                tg_url = '{$url}',
                                                tg_qq = '{$qq}'
                                             WHERE 
                                                tg_username = '{$_COOKIE['username']}'
                             ");
        }
        if($conn->get_affected_rows() == 1){
            func_location('修改成功!','member.php');
        }else{
            func_location('修改失败','member.php');
        }
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
    <script type="text/javascript" src="js/member_modify.js"></script>
</head>

<body>

<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="member">
    <?php require ROOT_PATH.'includes/member.inc.php'?>

    <div id="member_main">
        <h2>会员修改资料</h2>
        <form method="post" action="?action=modify">
            <dl>
                <dd>用户名：<?php echo $rows['tg_username']?></dd>
                <dd>密    码：<input type="password" class="text" name="password""/></dd>
                <?php
                //性别设置
                $rows['tg_sex_html']  = '';
                if($rows['tg_sex'] == '男'){
                    $rows['tg_sex_html'] = '<input type="radio" value="男" name="sex" checked="checked">男 &nbsp;&nbsp;&nbsp;&nbsp;';
                    $rows['tg_sex_html'] .= '<input type="radio" name="sex"  value="女">女';

                }else{
                    $rows['tg_sex_html'] = '<input type="radio" name="sex"  value="男">男 &nbsp;&nbsp;&nbsp;&nbsp;';
                    $rows['tg_sex_html'] .= '<input type="radio" name="sex"  value="女" checked="checked">女';
                }

                ?>
                <dd>性&nbsp;&nbsp;&nbsp;&nbsp;别：<?php echo $rows['tg_sex_html']?></dd>
                <?php
                //头像设置
                    $rows['face_html'] = '';
                    $rows['face_html'].= '<select  name="face">';
                        foreach (range(1,9) as $num){
                            $rows['face_html'].= '<option value="face/m0'.$num.'.gif">face/m0'.$num.'.gif</option>';
                        }
                        foreach (range(10,64) as $num){
                            $rows['face_html'].= '<option value="face/m'.$num.'.gif">face/m'.$num.'.gif</option>';
                        }
                    $rows['face_html'].= '</select>';


                ?>
                <dd>头&nbsp;&nbsp;&nbsp;&nbsp;像：<?php echo $rows['face_html'];?></dd>
                <dd>电子邮件：<input type="text" class="text" name="email" value="<?php echo $rows['tg_email']?>"/></dd>
                <dd>主&nbsp;&nbsp;&nbsp;&nbsp;页：<input type="text" class="text" name="url" value="<?php echo $rows['tg_url']?>"></dd>
                <dd>Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q：<input type="text" class="text" name="qq" value="<?php echo $rows['tg_qq'];?>"></dd>
                <dd>
                    验证码：<input type="text" class="text code" name="code">
                    <img src="code.php" id="code">
                </dd>
                <dd>
                    <input type="submit" class="submit" name="submit" value="修改">
                    <input type="reset" class="submit" name="reset" value="重置">
                </dd>
            </dl>
        </form>
    </div>



</div>




<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>






