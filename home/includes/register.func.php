<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/2
 * Time: 13:16
 */

    /*
     * func_check_isStringCount()  判断字符串长度
     * @access private
     * @param string $_string   需要判断长度的字符串
     * @param int $_min   最小值
     * @param int $_max   最大值
     * @param string $_encoding  编码 默认为： utf-8
     * @return boolean true|false  true为正确
     *
     * */
    function func_check_isStringCount($_string,$_min = 2,$_max = 12,$_encoding = 'utf-8'){
        if(mb_strlen($_string,$_encoding)>=$_min && mb_strlen($_string,$_encoding)<=$_max){
            return true;
        }
        return false;
    }

    /*
     * func_check_username()  函数名称
     * @param string $_user  用户名
     * @param int $min  用户名最小位数
     * @param int $man  用户名最大位数
     * @return string $_user  返回符合规划的$_user
     * */
    function func_check_username($_user,$_min=2,$_max=12){
        $username = trim($_user);
        $preg = '/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]{6,20}$/u';
        if(!preg_match($preg,$username)){
            func_alert_back('用户名不能包含特殊字符!');
        }
        if(empty($username)){
            func_alert_back('用户名不能为空!');
        }
        if (!func_check_isStringCount($username,$_min,$_max)){
            func_alert_back("用户名不能小于{$_min}位,并且不能大于{$_max}位!");
        }
        //$patten = '/[\'\"\ \    ]/';
        return $username;
    }



    /*
     * func_check_password()    返回sha1加密后的密码
     * @param string $_password     密码
     * @param string $_notPassword      确认密码
     * @param int $_min     密码最小位数
     * @param int $_max     密码最大位数
     * @return string $password     返回sha1加密后的密码
     * */
    function func_check_password($_password,$_notPassword,$_min = 6,$_max = 16){


        $preg = "/^[\w]{6,16}$/";
        if(!preg_match($preg,$_password)){
            func_alert_back('密码不能包含特殊字符!');
        }

        $notPassword = trim($_notPassword);
        if(strlen($_password) < $_min || strlen($_password)>$_max){
            func_alert_back("密码不能小于{$_min}位,并且不能大于{$_max}位!");
        }
        if($_password !== $notPassword){
            func_alert_back("密码与确认密码不一致");
        }
        return sha1($_password);
    }

    /**
     * func_modify_Password()  过滤修改密码
     * @param $_password
     * @param int $_min
     * @param int $_max
     * @return string  返回已经过滤好的字符串 并以sha1加密方式返回
     */
    function func_modify_Password($_password,$_min=6,$_max=16){
        $preg = "/^[\w]{6,16}$/";
        if(!empty($_password)){
            if(!preg_match($preg,$_password)){
                func_alert_back('密码不能包含特殊字符!');
            }
            if(!func_check_isStringCount($_password,$_min,$_max)){
                func_alert_back("密码只允许{$_min}~{$_max}");
            }
            return sha1($_password);
        }
        return null;
    }



    /*
     * func_check_question()    返回密码提示字符串
     * @access public
     * @param string $_question    字符串
     * @param int $_min     最小值
     * @param int $_max     最大值
     * @return string $question     返回结果 密码提示字符串
     * */
    function func_check_question($_question,$_min = 2,$_max = 40){
        $question = trim($_question);
        if(!func_check_isStringCount($question,$_min,$_max)){
            func_alert_back("密码提示问题长度不得小于{$_min}位,并且不能大于{$_max}位!");
        }
        return $question;
    }



    /*
    * func_check_answer()    密码问题 回答
    * @access public
    * @param string $_question    字符串
    * @param string $_answer    字符串
    * @param int $_min     最小值
    * @param int $_max     最大值
    * @return string $question     返回结果 密码问题回答
    * */
    function func_check_answer($_question,$_answer,$_min = 2,$_max = 20){
        $question = trim($_question);
        $answer = trim($_answer);
        if($question === $answer){
            func_alert_back('密码提示问题与回答不得相同,请重新填写!');
        }

        if(!func_check_isStringCount($answer,$_min,$_max)){
            func_alert_back("密码回答长度不得小于{$_min}位,并且不能大于{$_max}位!");
        }
        return sha1($answer);
    }


    /*
     * func_check_email()  正则表达 匹配邮箱
     * @access public
     * @param string $_string   待匹配的数据
     * @return string|null  $_string|null  返回匹配成功的字符串
     * */
    function func_check_email($_string){
        //aa@163.com
        $pattern = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
        if(!preg_match($pattern,$_string)){
            func_alert_back('邮箱格式不正确!');
        }

        return $_string;
    }

    /*
     * func_check_email()  正则表达 匹配邮箱
     * @access public
     * @param string $_string   待匹配的数据
     * @return string|null $_string|null  返回匹配成功的字符串
     * */
    function func_check_qq($_qq){
        if(empty($_qq)){
            return null;
        }else{
            $pattern = '/^[1-9]\d{4,13}$/';
            if (!preg_match($pattern,$_qq)){
                func_alert_back('QQ格式不正确');
            }
        }
        return $_qq;
    }



    /*
    * func_check_email()  正则表达 匹配邮箱
    * @access public
    * @param string $_string   待匹配的数据
    * @return string|null $_string|null  返回匹配成功的字符串
    * */
    function func_check_url($_url){
        if(empty($_url) || $_url =='http://'){
            return null;
        }else{
            //http://www.baidu.com
            //https://www.baidu.com
            //https://baidu.com
            $pattern  = '/^https?:\/\/(\w+\.)?[\.\w+\.]+[\.\w+\.]+$/';
            if(!preg_match($pattern,$_url)){
                func_alert_back('URL不正确!');
            }
        }
        return $_url;
    }

    /*
     * func_check_uniqid()  验证标识符是否一致
     * @access public
     * @param string $_firstUniqid      开始变量
     * @param string $_endUniqid    结束变量
     * @return string $_firstUniqid 返回标识符
     * */
    function func_check_uniqid($_firstUniqid,$_endUniqid){

        if((strlen($_firstUniqid)!=40) || ($_firstUniqid != $_endUniqid)){
            func_alert_back('唯一标识符出现异常!');
        }
        return $_firstUniqid;

    }





















