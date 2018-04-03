<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/2
 * Time: 17:31
 */
/**
 * @param $mes弹出提示信息
 * @param $url跳转页面链接
 */
function alertMess($mes,$url){
    echo '<html>'; 
    echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>'; 
    echo "<script>alert('{$mes}')</script>";
    echo "<script>window.location='{$url}'</script>";
    echo '</html>'; 
 
}

/**
 * @param $str错误信息
 * 错误日志函数
 */
function mLog($str){
    $filename=ROOT.'log/'.date('Ymd').'.txt';
    $log="----------------------------------------------------\n".date('Y/m/d H:i:s')."\n".$str."\n"."----------------------------------------------------\n\n";
    file_put_contents($filename,$log,FILE_APPEND);
}

/**
 * @return null|string
 * 获取来访者ip
 */
function getRealIp(){
    static $realIp=null;
    if($realIp!==null){
        return $realIp;
    }
    if(getenv('REMOTE_ADDR')){
        $realIp=getenv('REMOTE_ADDR');
    }elseif(getenv('HTTP_CLIENT_IP')){
        $realIp=getenv('HTTP_CLIENT_IP');
    }elseif(getenv('HTTP_X_FROWARD_FOR')){
        $realIp=getenv('HTTP_X_FROWARD_FOR');
    }
    return $realIp;
}

/**
 * 检验是否有权限登录
 */
function verifyAdmin(){
    if($_SESSION['aid']==""){
        alertMess("请先登录！","../login.php");
    }
}

/**
 * 使用反斜线转移字符串
 */
function _addslashes($arr){
    foreach($arr as $k=>$v){
        if(is_string($v)){
            $arr[$k]=addslashes($v);
        }else if(is_array($v)){
            $arr[$k]=_addslashes($v);
        }
    }
    return $arr;
}

/**
 * 生成分页代码
 * @param int $num 文章总数
 * @param  int $curr 当前显示的页码数
 * @param  int $set 每页显示的条数
 */
function getPage($num,$curr,$set){
    $max=ceil($num/$set);
    $left=max(1,$curr-2);
    $right=min($left+4,$max);
    $left=max(1,$right-4);
    $page=array();
    for($i=$left;$i<=$right;$i++){
        $_GET['page']=$i;
        $page[$i]=http_build_query($_GET);
    }
    return $page;
}