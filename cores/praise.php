<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/14
 * Time: 22:00
 */
require_once "../includes/includes.php";
$ip=getRealIp();//获取用户ip;
$id=$_POST['id'];
if(!isset($id)||empty($id))exit();

$sql="SELECT ip FROM gjt_ip WHERE ip='{$ip}'";
$res=mysqli_query($link,$sql);
if(mysqli_num_rows($res)==0){
    $like=praise($id,$ip,$link);
    echo $like;
}else{
    $sql="SELECT ip FROM gjt_ip WHERE aid='{$id}' AND ip='{$ip}'";
    $res=mysqli_query($link,$sql);
    if(mysqli_num_rows($res)==0){
        $like=praise($id,$ip,$link);
        echo $like;
    }else{
        exit("赞过了");
    }
}

function praise($id,$ip,$link){
    $sql="UPDATE gjt_article SET click=click+1 WHERE aid='{$id}'";
    mysqli_query($link,$sql);
    $sql1="INSERT INTO gjt_ip (ip,aid) VALUES ('{$ip}','{$id}')";
    mysqli_query($link,$sql1);
    $sql2="SELECT click FROM gjt_article WHERE aid='{$id}'";
    $res=mysqli_query($link,$sql2);
    $value=mysqli_fetch_assoc($res);
    return $value['click'];
}

