<?php
    session_start();
    header('Content-Type:text/html;charset=utf-8');
    define("IN_TG",TRUE);
    define('SCRIPT','register');  //定义常量 用来指定本页的内容(CSS)
    //引用公共文件
    require dirname(__FILE__).'/includes/common.inc.php';

    if(func_getLoginStatus()){
        func_location(null,'index.php');
    }

    if(!empty($_GET['action']) && $_GET['action'] =='register'){
        //提交表单

        func_check_code($_SESSION['code'],$_POST['code']);  //验证码比较


        $arr_clean = array();

        //uniqid 唯一标识符 可以防止恶意注册，伪装表单跨站攻击
        //这个存放入数据库的唯一标识符还有第二个用处，就是登陆cookie验证
        $arr_clean['uniqid'] = func_check_uniqid($_SESSION['uniqid'],$_POST['uniqid']);  //唯一标识符
        //active 这个也是唯一标识符，用来刚注册的用户进行激活，方可登陆
        $arr_clean['active'] = func_sha1_uniqid();
        $arr_clean['username'] = func_check_username($_POST['username']);
        $arr_clean['password'] = func_check_password($_POST['password'],$_POST['notpassword']);
        $arr_clean['question'] = func_check_question($_POST['question']);
        $arr_clean['answer'] = func_check_answer($_POST['question'],$_POST['answer']);
        $arr_clean['sex'] = $_POST['sex'];
        $arr_clean['face'] = $_POST['face'];
        $arr_clean['email'] = func_check_email($_POST['email']);
        $arr_clean['qq'] = func_check_qq($_POST['qq']);
        $arr_clean['url'] = func_check_url($_POST['url']);



        $conn = DB::db_sgetIntance();
        $conn->db_UserRegister(
                null,
            $arr_clean['uniqid'],
            $arr_clean['active'],
            $arr_clean['username'],
            $arr_clean['password'],
            $arr_clean['question'],
            $arr_clean['answer'],
            $arr_clean['sex'],
            $arr_clean['face'],
            $arr_clean['email'],
            $arr_clean['qq'],
            $arr_clean['url']);
        if($conn->get_affected_rows()==1){
            $arr_clean['id'] = $conn->db_insert_id();
            func_set_xml('filexml.xml',$arr_clean);
            func_location('注册成功!','active.php?active='.$arr_clean['active']);
        }
        else{
            func_location('注册失败!','register.php');

        }
        mysqli_free_result($conn);

    }else{
        $_SESSION['uniqid'] = $uniqid = func_sha1_uniqid();
    }


?>

<html>
<head>
    <meta charset="UTF-8">
    <title>会员注册</title>
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <!--<script type="text/javascript" src="js/face.js"></script>-->
    <script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php';?>


<div id="register">
    <h2>会员注册</h2>
    <form method="post" name="form" action="register.php?action=register">
        <input type="hidden" name="uniqid" value="<?php echo $uniqid;?>">
        <dl>
            <dt>请认真填写以下内容</dt>
            <dd>用户名：<input type="text" name="username" class="text" value="username""/><span>(*必填，至少二位)</span></dd>
            <dd>密&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" class="text" value="password"><span>(*必填，至少六位)</span></dd>
            <dd>确认密码：<input type="password" name="notpassword" class="text" value="password"><span>(*必填，同上)</span></dd></dd>
            <dd>密码提示：<input type="text" name="question" class="text" value="question"><span>(*必填，至少二位)</span></dd>
            <dd>密码回答：<input type="text" name="answer" class="text" value="answer"><span>(*必填，至少二位)</span></dd>
            <dd>
                性&nbsp;&nbsp;&nbsp;&nbsp;别：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="sex" value="男" checked="checked">男
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="sex" value="女">女
            </dd>
            <dd>
                <input type="hidden" name="face" value="face/1.jpg" class="text" style="height: 20px;">
                <img src="face/1.JPG" alt="头像选择" class="face" style="width: 50px;height: 50px" id="faceImage">
            </dd>
            <dd>电子邮件：<input type="text" name="email" class="text"></dd>
            <dd>Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q：<input type="text" name="qq" class="text"></dd>
            <dd>主页地址：<input type="text" name="url" value="http://" class="text"></dd>
            <dd>
                验证码：<input type="text" name="code" class="text code">
                <img src="code.php" id="code">
            </dd>
            <dd>
                <input type="submit" name="submit" class="submit" value="注册">
                <input type="reset" name="reset" class="submit" value="重置">
            </dd>
        </dl>

    </form>
</div>




<?php require ROOT_PATH.'includes/footer.inc.php';?>


</body>
</html>



