<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','blog_friend_show');  //定义常量 用来指定本页的内容(CSS)

    //为登录进行访问 非法访问
    if(!isset($_COOKIE['username'])){
        func_location(null,'index.php');
    }
    $conn = DB::db_sgetIntance();
    //添加好友
    if(isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['action']) && !empty($_GET['id'])){
        //通过好友请求
        $id  = global_html($_GET['id']);
        $sqlFriend = "UPDATE tg_friend SET tg_state = 1 WHERE tg_id='$id'";
        if($conn->get_affected_rows_sql($sqlFriend) == 1){
            func_location('您新增加了一名好友','blog_friend_show.php');
        }else{
            func_location('出现异常,请重新操作！','blog_friend_show.php');
        }
    }
    //删除好友模块
    if(isset($_GET['action']) && $_GET['action'] =='delete' && !empty($_POST['ids'])){
        $ids = implode(',',$_POST['ids']);
        $del_sql = "DELETE FROM tg_friend WHERE tg_id IN ($ids)";
        if($conn->get_affected_rows_sql($del_sql)> 0){
            func_location('好友删除成功!','blog_friend_show.php');
        }else{
            func_location('好友删除失败!','blog_friend_show.php');
        }

    }

    $pagesize = 5;
    //好友总数量
    $friendCount = mysqli_num_rows($conn->db_query("SELECT * FROM tg_friend WHERE (tg_touser = '{$_COOKIE['username']}') OR (tg_fromuser='{$_COOKIE['username']}') ORDER BY tg_date DESC"));

    if($friendCount>0){
        //最大页数
        $page = ceil($friendCount/$pagesize);
        $page_id = isset($_GET['page']) ? $_GET['page']:1;
        //当前页面  $_GET['page'] 值
        $page_id = func_check_page($page_id,$page);
        //sql查询语句 开始位置
        $pageNum = ceil(($page_id-1)*$pagesize);
        //好友输出结果
        $result = $conn->db_query("SELECT * FROM tg_friend WHERE (tg_touser = '{$_COOKIE['username']}') OR (tg_fromuser='{$_COOKIE['username']}') ORDER BY tg_date DESC LIMIT $pageNum,$pagesize");


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
    <script type="text/javascript" src="js/blog_friend_show.js"></script>
</head>

<body>

<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="member">
    <?php require ROOT_PATH.'includes/member.inc.php'?>

    <div id="member_message">
        <h2>好友管理中心</h2>
        <table cellspacing="1">

            <form method="post" action="?action=delete">
                <tr><th>好友</th><th>申请内容</th><th>时间</th><th>状态</th></th><th>操作</th></tr>
                <?php
                    if($friendCount>0){
                        while ($rows = $conn->db_get_fetch_array_result($result)){
                            //不管谁加谁  显示的都是对方 不是自己！！！ $rows['friend']
                            $rows['friend']  = $rows['tg_touser'] == $_COOKIE['username'] ?$rows['tg_fromuser']:$rows['tg_touser'];
                            // ?"被人加":"自己加"
                            //$rows['state'] = $rows['tg_touser'] == $_COOKIE['username'] ?"未同意成为好友":"对方还未验证";
                            if(empty($rows['tg_state'])){
                                //验证未通过
                                $rows['state'] = $rows['tg_touser'] == $_COOKIE['username'] ?"<a href='?action=check&id={$rows['tg_id']}' style='color: red;'>你未验证</a>":"<span style='color: blue'>对方未验证</span>";
                            }else{
                                $rows['state'] = '<span style="color: green">通过</span>';
                            }
                            echo "<tr>
                                <td>{$rows['friend']}</td>
                                <td>{$rows['tg_content']}</td>
                                <td>{$rows['tg_date']}</td>
                                <td>{$rows['state']}</td>
                                <td><input type='checkbox' name='ids[]' value='{$rows['tg_id']}'></td>
                             </tr>";
                        }
                        echo '<tr>';
                        echo ' <td colspan="5">';
                        echo '<label for="all">全选&nbsp;&nbsp;<input type="checkbox" name="chkall" id="all"/></label>';
                        echo '<input type="submit" id="submit" value="批量删除">';
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </form>
        </table>
        <?php
        if($friendCount >0){
            page_text($page_id,$page,$friendCount,SCRIPT);
        }
        ?>

    </div>



</div>




<?php require ROOT_PATH.'includes/footer.inc.php'; ?>


</body>
</html>






