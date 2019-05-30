<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','member_message');  //定义常量 用来指定本页的内容(CSS)//global
    $conn = DB::db_sgetIntance();

    //为登录进行访问 非法访问
    if(!isset($_COOKIE['username'])){
        func_location(null,'index.php');
    }
    //短信删除模块
    if (isset($_GET['action'])){
        if($_GET['action'] == 'delete' && !empty($_POST['ids'])){
            $ids = implode(',',$_POST['ids']);
            $sql = "DELETE FROM tg_message WHERE tg_id in($ids)";
            if($conn->get_affected_rows_sql($sql)){
                func_location('批量删除成功!','member_message.php');
            }else{
                func_location('批量删除失败!','member_message.php');
            }
        }

    }
// page_text($page_id,$page,$resultCount,SCRIPT);

    $pagesize = 5;  //显示的内容的数量
    $sql = "SELECT tg_id,tg_touser FROM tg_message WHERE tg_touser = '{$_COOKIE['username']}'";
    //短信总数量
    $resultCount = mysqli_num_rows($conn->db_query($sql));
    if($resultCount>0){
        //总页数
        $page = ceil($resultCount/$pagesize);
        $page_id = isset($_GET['page']) ? $_GET['page']:1;
        //当前页面  $_GET['page'] 值
        $page_id = func_check_page($page_id,$page);
        //sql查询语句 开始位置
        $pageNum = ceil(($page_id-1)*$pagesize);
        //输出结果
        $sql = "SELECT * FROM tg_message WHERE tg_touser='username' ORDER BY tg_date DESC LIMIT $pageNum,$pagesize ";
        $results = $conn->db_query($sql);

    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--短信中心</title>
    <link rel="shortcuticon" href="#"><!--设置ico图标 显示在浏览器网页窗口-->
    <?php require ROOT_PATH.'/includes/title.inc.php';?>
    <link rel="stylesheet" type="text/css" href="style/1/blog.css"/>
    <script type="text/javascript" src="js/member_message.js"></script>
</head>

<body>

<?php require ROOT_PATH.'includes/header.inc.php'; ?>

<div id="member">
    <?php require ROOT_PATH.'includes/member.inc.php'?>

    <div id="member_message">
        <h2>短信管理中心</h2>
        <table cellspacing="1">

            <form method="post" action="?action=delete">
                <tr><th>发信人</th><th>短信内容</th><th>时间</th><th>状态</th></th><th>操作</th></tr>
                <?php
                    //如果存在短信数据
                    if($resultCount>0){
                        while ($rows = $conn->db_get_fetch_array_result($results)){
                            $rows = global_html($rows);
                            //状态图片
                            $stateImg = !empty($rows['tg_state']) ? "<img src='image/noread.gif'>" :"<img src='image/read.gif'>";
                            $rows['tg_content'] = empty($rows['tg_state']) ? "<strong>{$rows['tg_content']}</strong>":$rows['tg_content'];

                            echo '<tr>
                                    <td>'.$rows['tg_fromuser'].'</td>
                                    <td><a href="member_message_detail.php?id='.$rows['tg_id'].'">'.func_content_substr($rows['tg_content'],0,30).'</a></td>
                                    <td>'.$rows['tg_date'].'</td>
                                    <td>'.$stateImg.'</td>
                                    <td><input type="checkbox" name="ids[]" value="'.$rows['tg_id'].'"></td>
                                </tr>';
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
        //显示分页处理
            if ($resultCount>0){
                page_text($page_id,$page,$resultCount,SCRIPT);
            }
        ?>
    </div>


</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>



