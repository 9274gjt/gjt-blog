<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/9
 * Time: 14:36
 */
require_once "includes/includes.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GjtBlog</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="author" href="humans.txt">
</head>
<body>
    <div class="bg"></div>
    <div class="login_box">
        <div class="login">
            <form action="cores/dologin.php?act=login" method="post">
                <h1 class="login_title">MyBlog</h1>
                <input type="text" class="username" name="username" placeholder="请输入登录账号！">
    
                <input type="password" class="password" name="password" placeholder="请输入密码!">

                <div class="coder">
                    <input type="text" class="verifycode" name="verifycode" placeholder="请输入验证码">
                    <img class="coderimage" src="libs/test.php" alt="" onclick="this.src='libs/test.php?r='+Math.random()">

                </div>
                <button class="login_btn">登录</button>
            </form>
            <a class="back" href="index.php"><———————— 返回博客首页</a>
        </div>
    </div>
</body>
</html>