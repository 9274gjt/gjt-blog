<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/2
 * Time: 14:43
 */
require_once '../includes/includes.php';
verifyAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Untitled</title>
    <link rel="stylesheet" href="..\plugs\bootstrap\dist\css\bootstrap.css">
    <link rel="stylesheet" href="css/base.css">
</head>
<body>
    <div class="wrapper">
        <?php require_once "../includes/admin_public.php" ?>
        <div class="page-wrapper">
            <div class="page-inner">
                <table class="table table-responsive table-striped">
                    <caption>系统简介</caption>
                    <tr>
                        <td>操作系统</td>
                        <td><?php echo PHP_UNAME()?></td>
                    </tr>
                    <tr>
                        <td>开发人员</td>
                        <td>Gjt</td>
                    </tr>
                    <tr>
                        <td>脚本语言</td>
                        <td><?php echo "PHP".PHP_VERSION ?></td>
                    </tr>
                    <tr>
                        <td>数据库</td>
                        <td>MySQL</td>
                    </tr>
                    <tr>
                        <td>开发环境</td>
                        <td>windows 10</td>
                    </tr>
                    <tr>
                        <td>服务器引擎</td>
                        <td><?php echo  $_SERVER['SERVER_SOFTWARE']?></td>
                    </tr>
                    <tr>
                        <td>浏览器兼容</td>
                        <td>Google/Firefox/IE</td>
                    </tr>
                    <tr>
                        <td>功能简介</td>
                        <td>此系统用于博客的建立，涉及博文的发表，管理，以及项目的查看</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<script src="js/min.js"></script>
</body>
</html>