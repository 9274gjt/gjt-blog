<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/16
 * Time: 17:27
 */
require_once '../includes/includes.php';
$act=$_REQUEST['act'];
switch ($act) {
    case "add":
        $username = $_POST['username'];
        $salt="q!.c/`~*";
        $password = md5($_POST['password'].$salt);
        $emial = $_POST['email'];
        $realname = $_POST['name'];
        $sql="SELECT * FROM gjt_admin WHERE username='{$username}'";
        $res=mysqli_query($link,$sql);
        if(mysqli_num_rows($res)!==0){
            alertMess("该用户已存在！请重新添加！","../admin/admin.php");
        }else{
            $sql="insert into gjt_admin(username,password,salt,email,realname)values('{$username}','{$password}','{$salt}','{$emial}','{$realname}')";
            $res=mysqli_query($link,$sql);
            if($res){
                alertMess("添加成功！","../admin/admin.php");
            }else {
                mLog($sql."\n".mysqli_error($link));
                alertMess("添加失败！", "../admin/admin.php");
            }
        }
        break;
    case "delete":
        $id=$_REQUEST['id'];
        $sql="delete from gjt_admin where aid='{$id}'";
        $res=mysqli_query($link,$sql);
        if($res){
            alertMess("删除成功！",'../admin/admin.php');
        }else{
            alertMess("删除失败！",'../admin/admin.php');
        }
        break;
}