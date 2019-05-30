<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/31
 * Time: 12:53
 */


//获取绝对路径 C:\phpStudy\PHPTutorial\WWW\home\
    define('ROOT_PATH',substr(dirname(__FILE__),0,-8));



//防止恶意调用
    if(!defined('IN_TG')) exit('Access Defined!');



//低版本检测
    if(PHP_VERSION < '5.0.0')
        exit('Version is to low!');

//引用全局函数库
    require ROOT_PATH.'/includes/global.func.php';

//程序开始时间
    define('START_TIME',func_runTime());


    //创建一个自定转义的常量
    define('GPC',get_magic_quotes_gpc());


    require ROOT_PATH.'/includes/DB.php';

    require ROOT_PATH.'/includes/register.func.php';




