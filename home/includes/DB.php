<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/3
 * Time: 15:49
 */
header('Content-Type:text/html;charset=utf-8');
//if(!defined('IN_TG')) exit('Access Defined!');
class DB{
    private $host='localhost';
    private $user='root';
    private $password='root';
    private $dbname='testguest';
    private $port='3306';
    private $char='utf8';
    private $link;

    private static $sdbcon=false;

    private function __construct()
    {
        $this->db_connect();
        $this->db_charset();

    }

    private function db_connect(){
        $this->link = new mysqli($this->host,$this->user,$this->password,$this->dbname);
        if($this->link->connect_errno){
            $this->db_error('连接数据库失败!');

        }
        return $this->link;
    }

    private function db_charset(){
        mysqli_set_charset($this->link,$this->char) or die('设置字符串失败!');
    }

    private function  __clone()
    {
        die('clone is not allowed');
    }

    public static function db_sgetIntance(){
        if(self::$sdbcon==false){
            self::$sdbcon = new self();
        }
        return self::$sdbcon;
    }

    /**
     * db_isUserRepeat()  检测用户名是否重复
     * @param $_name    需要检测的用户名
     * @return bool     返回true用户名已存在
     */
    public function db_isUserRepeat($_name){
        $sql = "SELECT * FROM `tg_user` WHERE `tg_username` LIKE '{$_name}'";
        $this->link->query($sql);
        if($this->link->affected_rows>0) {
            return true; //用户名已存在
        }
        return false;
    }

    /**
     * db_UserRegister()    函数名称,注册用户
     * @param $_did 用户id  可不填
     * @param $_uniqid  唯一标识符 防止恶意注册
     * @param $_active  唯一标识符 邮箱激活用户登录
     * @param $_username    用户名
     * @param $_password    密码
     * @param $_question    密码提示问题
     * @param $_answer  密码回答
     * @param $_sex     性别
     * @param $_face    头像
     * @param $_email   邮箱
     * @param $_qq      qq
     * @param $_url     网址url
     * @param string $_reg_time     注册时间
     * @param string $_loglast_time     最后登录时间
     * @return void 用来注册用户
     */
    public function db_UserRegister($_did,$_uniqid,$_active,
                              $_username,$_password,$_question,$_answer,$_sex,$_face,
                              $_email,$_qq,$_url,
                              $_reg_time="NOW()",$_loglast_time="NOW()"){
        //需要转义 过滤
        //判断用户名是否存在
        if($this->db_isUserRepeat($_username)){
            func_alert_back('用户名已存在!');
        }
        $sql = "INSERT INTO tg_user(
                    `tg_id` ,`tg_uniqid` ,`tg_active` ,
                    `tg_username` ,`tg_password` ,`tg_question` ,`tg_answer` ,`tg_sex` ,`tg_face` ,
                    `tg_email` ,`tg_qq` ,`tg_url` ,
                    `tg_reg_time` ,`tg_loglast_time` ,`tg_reg_ip` ,`tg_loglast_ip` ) 
                    VALUES (
                        '{$_did}','{$_uniqid}','$_active',
                        '$_username','{$_password}','$_question','$_answer','$_sex','{$_face}',
                        '{$_email}','{$_qq}','{$_url}',
                        now(),now(),'{$_SERVER['REMOTE_ADDR']}','{$_SERVER['REMOTE_ADDR']}')";


        $this->link->query($sql);


    }


    /**
     * db_query() 获取sql语句后的资源
     * @param $_sql SQL语句
     * @return resource 返回执行sql语句话的资源
     */
    public function db_query($_sql){

        if(!$result = $this->link->query($_sql)){
            $this->db_error('db_query函数出错');
        }
        return $result;
    }

    /**
     * db_fetch_array()  获取sql语句后的结果集 只能一条数据
     * @param $_sql
     * @return array|null  返回sql语句后的结果集
     */
    public function db_fetch_array($_sql){

        //return $this->link->fetch_array();
        return mysqli_fetch_array($this->db_query($_sql),MYSQLI_ASSOC);
    }


    /**
     * func_get_fetch_array()   用来获取sql资源结果集  只能一条数据
     * @param $result  mysql_query  执行后的结果集
     * @return array|null  返回sql资源结果集
     */
    public function db_get_fetch_array_result($result){
        return mysqli_fetch_array($result,MYSQLI_ASSOC);
    }


    /**
     * db_fetch_array_list()  返回结果集所有的数据
     * @param $_result  sql执行后的资源
     * @return array|null  返回sql资源所有数据
     */
    //存在问题
    public function db_fetch_array_list($_result){
//        mysqli_fetch_array 这里出错 显示只有一条数据
        return mysqli_fetch_array($_result,MYSQLI_ASSOC);

    }

    function get_query_nums(){
        return $this->link->num_rows;

    }
    function  db_insert_id(){
        return $this->link->insert_id;
    }




    /*
     * get_affected_rows() 用来获取执行sql语句受影响的行数
     * @access public
     * @return int 返回执行sql语句受影响的行数
     */
    public function get_affected_rows(){
        return $this->link->affected_rows;
    }


    /**
     * get_affected_rows_sql()  用来执行sql受影响的行数
     * @param $_sql  sql语句
     * @return int  返回执行sql语句影响的行数
     */
    public function get_affected_rows_sql($_sql){
        $this->db_query($_sql);
        return $this->link->affected_rows;
    }


    /**
     * db_error()   函数名称
     * @param $_msg     提示错误信息的标题
     * @return void     用来输出用户错误信息
     */
    private function db_error($_msg){
        echo $_msg."<br/>";
        echo "错误编码：".mysqli_errno($this->link ).'<br/>';
        echo "错误信息：".mysqli_error($this->link ).'<br/>';
        exit();

    }


    /**
     * db_free_result()  释放结果集
     */
    public function db_free_result($data){

    }


}







/*


    $mysqli = new mysqli('localhost','root','root','testguest');

    if($mysqli->connect_errno){
        die("Connect Error:".$mysqli->connect_errno);
    }
    function func_isUserRepeat($_mysqli,$_name){
        $sql = "SELECT * FROM `tg_user` WHERE `tg_username` LIKE '{$_name}'";
        $_mysqli->query($sql);
        if($_mysqli->affected_rows>0) {
            return true; //用户名已存在
        }
        return false;
    }

    function func_mysqliQuery($_did,$_uniqid,$_active,
                              $_username,$_password,$_question,$_answer,$_sex,$_face,
                              $_email,$_qq,$_url,
                              $_reg_time,$_loglast_time,$_reg_ip,$_loglast_ip
                                ){
        $sql = "INSERT INTO 
                    tg_user(`tg_did` ,`tg_uniqid` ,`tg_active` ,
                    `tg_username` ,`tg_password` ,`tg_question` ,`tg_answer` ,`tg_sex` ,`tg_face` ,
                    `tg_email` ,`tg_qq` ,`tg_url` ,
                    `tg_reg_time` ,`tg_loglast_time` ,`tg_reg_ip` ,`tg_loglast_ip` 
                    ) 
                    VALUES (
                        '{$_did}','{$_uniqid}','$_active}',
                        '$_username}','{$_password}','$_question}','$_answer}','$_sex}','{$_face}',
                        '{$_email}','{$_qq}','{$_url}',
                        '{$_reg_time}','{$_loglast_time}','{$_reg_ip}','{$_loglast_ip}'
                    )";
        if(!func_isUserRepeat($_username)){
            if(@$_mysqli->query($sql)){
                func_alert_back('恭喜您,'.$_username.',\n注册成功!');

            }
        }
    }

*/
































