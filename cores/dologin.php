<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/9
 * Time: 15:48
 */

$act=$_REQUEST['act'];
require_once '../includes/includes.php';
switch ($act){
    case "login":
        $verify=strtolower($_POST['verifycode']);
        if($verify==$_SESSION['verifycode']){
            $username=trim($_POST['username']);
            $password=trim($_POST['password']);
            $sql="SELECT *FROM gjt_admin WHERE username='{$username}'";
            $res=mysqli_query($link,$sql);
            $row=mysqli_fetch_assoc($res);
            if($res && mysqli_num_rows($res)>0) {
                if(md5($password.$row['salt'])===$row['password']){
                    $_SESSION['adminName']=$row['username'];
                    $_SESSION['aid']=$row['aid'];
                    alertMess("登录成功！","../admin/index.php");
                }else{
                    alertMess("密码错误！请重新登录！","../login.php");
                }
            }else{
                alertMess("用户名错误！请重新登录！","../login.php");
            }
        }else{
            alertMess("验证码错误！请重新输入!","../login.php");
        }

        break;
    case "logout":
        session_destroy();
        header("Location:../login.php");
        break;
}
