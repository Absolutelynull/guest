<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/31
 * Time: 11:53
 */
if(!defined('IN_TG')) exit('Access Defined!');


?>

<div id="header">
    <h1><a href="index.php"><img src='image/logo1.jpg'></a></h1>
    <ul>
        <li><a href="index.php">首页</a></li>
        <?php
            if(!isset($_COOKIE['username'])){
                echo "<li><a href='register.php'>注册</a></li>";
                echo "\n";
                echo "<li><a href='login.php'>登录</a></li>";
                echo "\n";
            }else{
                echo "<li><a href='member.php'>".$_COOKIE['username']." · 个人中心</a></li>";
                echo "\n";
                //短信显示模块
                $conn = DB::db_sgetIntance();
                //未读短信数量
                $messageResultCount = $conn->db_fetch_array("SELECT COUNT(tg_id) AS count FROM tg_message WHERE tg_state=0 AND tg_touser='{$_COOKIE['username']}'");
                $GLOBALS['messageCount'] = $messageResultCount['count'];
                if($GLOBALS['messageCount']>0){
                    echo "<li><a href='member_message.php'>短信({$GLOBALS['messageCount']})<img src='image/meg.gif'></a></li>";
                }else{
                    echo "<li><a href='member_message.php'>短信({$GLOBALS['messageCount']})<img src='image/noread.gif'></a></li>";
                }
                echo "\n";
                echo "<li><a href='blog.php'>博友</a></li>";
                echo "\n";
            }
        ?>
        <li><a href="#">风格</a></li>
        <li><a href="#">管理</a></li>
        <li><a href="logout.php">退出</a></li>
    </ul>

</div>