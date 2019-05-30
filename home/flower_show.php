<?php
    session_start();
    define('IN_TG',true);  //判断是否非法调用 未授权php文件
    require dirname(__FILE__).'/includes/common.inc.php';  //引用授权文件
    define('SCRIPT','flower_show');  //定义常量 用来指定本页的内容(CSS)//global
    $conn = DB::db_sgetIntance();

    //为登录进行访问 非法访问
    if(!isset($_COOKIE['username'])){
        func_location(null,'index.php');
    }
    //短信删除模块
    if (isset($_GET['action'])){
        if($_GET['action'] == 'delete' && !empty($_POST['ids'])){
            $ids = implode(',',$_POST['ids']);
            $sql = "DELETE FROM tg_flower WHERE tg_id in($ids)";
            if($conn->get_affected_rows_sql($sql)){
                func_location('批量删除成功!','flower_show.php');
            }else{
                func_location('批量删除失败!','flower_show.php');
            }
        }

    }

    $pagesize= 1;


    //显示模块
    $sql = "SELECT * FROM tg_flower WHERE tg_touser = '{$_COOKIE['username']}'";  //按时间排序
    $result = $conn->db_query($sql);
    $resultCount = mysqli_num_rows($result);

    if($resultCount>0){
        $pageCount = ceil($resultCount/$pagesize);  //总页数
        $page_id = isset($_GET['page'])?$_GET['page']:1;  //当前页面id
        $page_id= func_check_page($page_id,$pageCount);   //当前页面id

        $pageNum = ceil(($page_id - 1)*$pagesize);
        //显示分页后的内容
        $sql = "SELECT * FROM tg_flower WHERE tg_touser = '{$_COOKIE['username']}' ORDER BY tg_date DESC LIMIT $pageNum,$pagesize ";
        $result = $conn->db_query($sql);

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
        <h2>花朵管理中心</h2>
        <table cellspacing="1">

            <form method="post" action="?action=delete">
                <tr><th>送花人</th><th>花朵数量</th><th>送花感言</th><th>时间</th><th>操作</th></tr>
                <?php
                    $flowerCount = 0;
                    if($resultCount >0){ //存在别人送花给自己
                        while ($rows = global_html($conn->db_get_fetch_array_result($result))){
                            $flowerCount += $rows['tg_flower'];
                            echo "<tr>
                                    <td>{$rows['tg_formuser']}</td>
                                    <td><strong>{$rows['tg_flower']}</strong></td>
                                    <td>".func_content_substr($rows['tg_content'],0,30)."</td>
                                    <td>{$rows['tg_date']}</td>
                                    <td><input type='checkbox' name='ids[]' value='{$rows['tg_id']}'></td></tr>";
                        }
                    }
                    echo "<tr><td></td><td>花朵总数量：$flowerCount</td><td></td><td></td><td></td></tr>";
                    echo '<tr>';
                    echo '<td colspan="5">';
                    echo '<label for="all">全选&nbsp;&nbsp;<input type="checkbox" name="chkall" id="all"/></label>';
                    echo '<input type="submit" id="submit" value="批量删除">';
                    echo '</td>';
                    echo '</tr>';

                ?>

            </form>
        </table>
        <?php
            if($resultCount > 0){
                page_text($page_id,$pageCount,$resultCount,SCRIPT);

            }
        ?>


    </div>


</div>

<?php require ROOT_PATH.'includes/footer.inc.php'; ?>
</body>
</html>





