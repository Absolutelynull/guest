<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/31
 * Time: 14:03
 */

    /*
     * runTime() 是用来获取执行耗时(函数名)
     * @access public 表示函数对外公开
     * @return float  表示返回出来的时候浮点型
     */
    function func_runTime(){
        $mtime = explode(' ',microtime());
        return $mtime[1]-$mtime[0];
    }

    /*
     * code() 函数名称
     * @access public
     * @param int $_width 画布宽度
     * @param int $_height 画布高度
     * @param int $code_count 验证码的数量
     * @param bool $code_border 表示是否需要边框 false|true  默认不显示false
     * @return void 用来获取验证码
     * */
    function func_code($_width = 80,$_height = 25,$_code_count = 4,$_code_border = false){
        $code = '';
        for ($i=0;$i<$_code_count;$i++){
            $code .=dechex(mt_rand(0,15));
        }
        $_SESSION['code'] = $code;
        //创建画布
        $img = imagecreatetruecolor($_width,$_height);
        //白色
        $color = imagecolorallocate($img,255,255,255);
        //进行填充 //设置背景为白色
        imagefill($img,0,0,$color);
        //是否添加边框
        if($_code_border){
            $black = imagecolorallocate($img,0,0,0);
            imagerectangle($img,0,0,$_width-1,$_height-1,$black);
        }
        //画出6个线条
        for ($i=0;$i<6;$i++){
            $rand_line_color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            ImageLine($img,mt_rand(1,$_width-1), mt_rand(1,$_height-1), mt_rand(1,$_width-1), mt_rand(1,$_height-1), $rand_line_color);
        }
        //雪花
        for($i=0;$i<100;$i++){
            //200-255  数值越大的话，颜色越浅
            $rand_color = imagecolorallocate($img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($img,1,mt_rand(1,$_width-1),mt_rand(1,$_height-1),'*',$rand_color);
        }

        //写入字符
        for ($i=0;$i<strlen($_SESSION['code']);$i++){
            $x = rand(5,10)+$i*$_width/$_code_count;
            $y = rand(5,10);
            $rand_color = imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
            imagestring($img,5,$x,$y,$_SESSION['code'][$i],$rand_color);
        }
        imagepng($img);
        imagedestroy($img);
    };

    /*
     * _alert_back() 函数名称
     * @access public
     * @return void  跳出一个信息窗口
     * */
    function func_alert_back($_info){
        exit("<script type='text/javascript'>alert('{$_info}');history.back();</script>");
    }



    /*
     * func_check_code()  用来判断验证码是否一致
     * @access public
     * @param string $_startCode    第一个参数
     * @param string $_entCode      第二个参数
     * @return void  弹窗
     * */
    function func_check_code($_startCode,$_entCode){

        if(strcasecmp($_startCode,$_entCode)!=0){
            func_alert_back('验证码不正确!');
        }

    }

    //转移sql 存在问题
    function func_mysql_string($_string){
        if (!get_magic_quotes_gpc()){
            //高版本已经废弃
            return mysql_real_escape_string($_string);
        }
        return $_string;
    }


    /*
    * func_sha1_uniqid() 返回唯一标识符
    * @access public
    * @return float sha1(uniqid(rand(),true)) 返回唯一标识符
    * */
    function func_sha1_uniqid(){
        return sha1(uniqid(rand(),true));
    }


    /**
     * func_location()  跳转页面
     * @param $_msg 显示信息
     * @param $_adress  需要跳转的页面地址
     *
     */
    function func_location($_msg,$_adress){
        if($_msg == null){
            echo "<script>window.location.href='{$_adress}'</script>";
        }else{
            echo "<script>alert('{$_msg}');window.location.href='{$_adress}'</script>";
        }
        exit();
    }


    /**
     * func_setCookie() 设置cookie
     * @param $_username 用户名
     * @param $_time cookie有效时间
     */
    function func_setCookie($_username,$_time){
        switch ($_time){
            case 0:
                //默认不保留
                setcookie('username',$_username);
                setcookie('time','0');
                break;
            case 1:
                //一天
                setcookie('username',$_username);
                setcookie('time','1', 86400 );  //一天时间
                break;
            case 2:
                //三天
                setcookie('username',$_username);
                setcookie('time','2', 259200 ); //三天时间
                break;
        }
    }


    /**
     * 删除session
     */
    function func_session_destroy(){
        //session_destroy();
    }

    /**
     * 删除cookie 以及 session
     */
    function unsetCookie(){
        setcookie('username','',time()-1);
        setcookie('time','',time()-1);
        func_session_destroy();
        func_location(null,'index.php');

    }

    /**
     * func_getLoginStatus()  获取登录状态
     * @return bool
     *
     */
    function func_getLoginStatus(){
        if(isset($_COOKIE['username'])){
            return true;
        }
        else{
            return false;
        }
    }


    /**
     * global_paging()  进行分页处理
     * @param $_type 1|2  1表示为数字类型  2表示文本类型
     * @return void 返回分页
     */
    function global_paging($_type){
        global $pageabsolute,$page,$num;
        if($_type == 1) {
            echo '<div id="page_num">';
                echo '<ul>';
                    for ($i=0;$i<$pageabsolute;$i++){
                        if($page == ($i+1)){
                            echo "<li><a class='selected' href='blog.php?page=".($i+1)."'>".($i+1)."</a></li>";
                        }
                        echo "<li><a href='blog.php?page=".($i+1)."'>".($i+1)."</a></li>";
                    }
                echo '</ul>';
            echo '</div>';
        }
        else if ($_type == 2){
            echo '<div id="page_text">';
                echo '<ul>';
                    echo '<li>'.$page.'/'.$pageabsolute.'页 | </li>';
                    echo '<li>共有<strong>'.$num.'</strong>个会员 |</li>';
                        if($page == 1){  //首页
                            echo "<li><a href='#'>首页</a>|</li>";
                            echo "<li><a href='#'>上一页</a>|</li>";
                        }else{
                            echo '<li><a href="'.SCRIPT.'.php?page=1">首页</a>|</li>';
                            echo '<li><a href="'.SCRIPT.'.php?page='.($page-1).'">上一页</a>|</li>';
                        }
                        if($page == $pageabsolute){ //尾页
                            echo '<li><a href="#">下一页</a>|</li>';
                            echo '<li><a href="#">尾页</a>|</li>';
                        }else{
                            echo '<li><a href="'.SCRIPT.'.php?page='.($page+1).'">下一页</a>|</li>';

                            echo '<li><a href="'.SCRIPT.'.php?page='.$pageabsolute.'">尾页</a>|</li>';
                        }
                echo '</ul>';
            echo '</div>';

        }

    }



    /*
     * 需要将分页处理封装为函数 blog.php  分页处理
     */
    function global_page($_sql,$_pagesize){

    }


    /**
     * global_html()  进行转义  避免sql xss漏洞
     * @param $_string
     * @return string  返回已经转义后的字符串
     */
    function global_html($_string){
        $string = '';
        if(is_array($_string)){
            foreach ($_string as $key => $value){
                $string[$key] = global_html($value);  //这里使用递归
            }
        }else{
            $string = addslashes(htmlspecialchars($_string));
        }

        return $string;
    }

    /**
     * func_alert_close()  弹出一个窗口并返回上一次窗口
     * @param $_info 弹窗信息
     */
    function func_alert_close($_info){
        exit("<script type='text/javascript'>alert('{$_info}');window.close();</script>");
    }


    /**
     * func_content()  截取指定长度字符串
     * @param $_string  字符串
     * @param int $_start  开始截取位置
     * @param int $_length  截取长度
     * @param string $_encoding  字符串编码
     * @return string  返回截取指定长度字符串
     */
    function func_content_substr($_string,$_start=0,$_length = 16,$_encoding = 'utf-8'){
        if(mb_strlen($_string,$_encoding) >$_length){
            $_string = mb_substr($_string,$_start,$_length,$_encoding);
            return $_string.'...';
        }
        return $_string;
    }

    /**
     * @param $_fitst  当前的页数
     * @param $_end     最大页数
     * @param $_count    数据总数
     * @param $_addres  需要链接的地址
     */
    function page_text($_fitst,$_pageCount,$_resultCount,$_addres,$_param=""){
        $pageContent = '<div id="page_text">';
        $pageContent .= '<ul>';
        $pageContent .= '<li>'.$_fitst.'/'.$_pageCount.'页 | </li>';
        $pageContent .= '<li>共有<strong>'.$_resultCount.'</strong>条短信|</li>';
        $pageContent .= '<li><a href="'.$_addres.'.php?'.$_param.'&page=1">首页</a>|</li>';
        $pageContent .= '<li><a href="'.$_addres.'.php?'.$_param.'&page='.($_fitst-1).'">上一页</a>|</li>';
        $pageContent .= '<li><a href="'.$_addres.'.php?'.$_param.'&page='.($_fitst+1).'">下一页</a>|</li>';
        $pageContent .= '<li><a href="'.$_addres.'.php?'.$_param.'&page='.$_pageCount.'">尾页</a>|</li>';
        $pageContent .= '</ul>';
        $pageContent .= '</div>';
        echo $pageContent;
    }

    /**
     * func_check_page()  用来过滤当前页面id
     * @param $_page_id  当前页面的id
     * @param $_pageCount   页面的总数
     * @return int  返回过滤的当前页面id
     */

    function func_check_page($_page_id,$_pageCount){
        $page_id = $_page_id;
        if(!isset($page_id) ||  $page_id <= 0 || !is_numeric($page_id)){
            $page_id = 1;
        }
        if($_page_id > $_pageCount){
            $page_id = $_pageCount;
        }
        return $page_id;
    }

    /**
     * func_isSetVariable()  更改后 判断变量是否设置 2019/2/24 更改
     * func_isSetId()    原来函数名
     * @param $_string  需要判断变量
     * @param int $_default 变量如果不存在 返回的数据
     * @return int  返回指定字符串
     */
    function func_isSetVariable($_string,$_default = 1){
        if (!isset($_string)){
            $_string = $_default;
        }
        return $_string;
    }


    /**
     * func_set_xml()  设置xml
     * @param $_filename  文件路径
     * @param $_array  数据数组
     * @return  void
     */
    function func_set_xml($_filename,$_array){
        $fp = fopen($_filename,'w');
        if(!$fp){
            exit('打开文件出错!');
        }
        flock($fp,LOCK_EX);
        $string = "<?xml version='1.0' encoding='utf-8'?>\r\n";
        $string .= "<vip>\r\n";
        $string .= "\t<id>{$_array['id']}</id>\r\n";
        $string .= "\t<username>{$_array['username']}</username>\r\n";
        $string .= "\t<sex>{$_array['sex']}</sex>\r\n";
        $string .= "\t<face>{$_array['face']}</face>\r\n";
        $string .= "\t<email>{$_array['email']}</email>\r\n";
        $string .= "\t<url>{$_array['url']}</url>\r\n";
        $string .= "</vip>";
        fwrite($fp,$string);
        flock($fp,LOCK_UN);
        fclose($fp);
    }


    /**
     * func_get_xml()  获取xml
     * @param $_filename  文件路径
     * @return array 返回xml结果
     */
    function func_get_xml($_filename){
        $html = array();
        if(file_exists($_filename)){
            $xml = file_get_contents($_filename);
            $preg = '/<vip>(.*)<\/vip>/s';
            preg_match_all($preg,$xml,$content);
            foreach ($content[1] as $item){
                preg_match_all('/<id>(.*)<\/id>/s',$item,$_id);
                preg_match_all('/<username>(.*)<\/username>/s',$item,$_username);
                preg_match_all('/<sex>(.*)<\/sex>/s',$item,$_sex);
                preg_match_all('/<face>(.*)<\/face>/s',$item,$_face);
                preg_match_all('/<email>(.*)<\/email>/s',$item,$_email);
                preg_match_all('/<url>(.*)<\/url>/s',$item,$_url);
                $html['id'] = $_id[1][0];
                $html['username'] = $_username[1][0];
                $html['sex'] = $_sex[1][0];
                $html['face'] = $_face[1][0];
                $html['email'] = $_email[1][0];
                $html['url'] = $_url[1][0];
                $html = global_html($html);
            }
        }else{
            //xml not exist
        }
        return $html;
    }


    function func_ubb($_string){
        $_string = nl2br($_string);
        $_string = preg_replace('/\[size=(.*)\](.*)\[\/size\]/U','<span style="font-size: \1px">\2</span>',$_string);  //加粗
        $_string = preg_replace('/\[b\](.*)\[\/b\]/U','<strong>\1</strong>',$_string);  //加粗
        $_string = preg_replace('/\[i\](.*)\[\/i\]/U','<em>\1</em>',$_string);  //斜体
        $_string = preg_replace('/\[u\](.*)\[\/u\]/U','<span style="text-decoration: underline">\1</span>',$_string);  //下划线
        $_string = preg_replace('/\[s\](.*)\[\/s\]/U','<span style="text-decoration: line-through">\1</span>',$_string);  //删除线
        $_string = preg_replace('/\[b\](.*)\[\/b\]/U','<strong>\1</strong>',$_string);
        $_string = preg_replace('/\[color=(.*)\](.*)\[\/color\]/U','<span style="color:\1">\2</span>',$_string);
        $_string = preg_replace('/\[url\](.*)\[\/url\]/U','<a href="\1" target="_blank">\1</a>',$_string);
        $_string = preg_replace('/\[email\](.*)\[\/email\]/U','<a href="mailto:\1">\1</a>',$_string);
        $_string = preg_replace('/\[img\](.*)\[\/img\]/U','<img src="\1" alt="图片"></img>',$_string);
        $_string = preg_replace('/\[flash\](.*)\[\/flash\]/U','<embed style="width: 400px;height: 400px;" src="\1" />',$_string);
        return $_string;
    }




