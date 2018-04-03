<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/10
 * Time: 19:46
 */
require_once '../includes/includes.php';
$sql="SELECT * FROM gjt_admin ORDER BY aid DESC";
$res=mysqli_query($link,$sql);
if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_assoc($res)){
        $rows[]=$row;
    }
}
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
    <link rel="stylesheet" href="css/tag.css">
</head>
<body>
<div class="wrapper">
    <?php require_once "../includes/admin_public.php" ?>
    <div class="page-wrapper">
        <div class="page-inner">
            <div class="tagadd">
            <form action="../cores/doAdminAction.php?act=add" method="post">
                <h4>添加新用户</h4>
                <p>用户名(必填)</p>
                <input class="tname form-control" type="text" name="username" required>
                <p>登录时用户的信息</p>
                <br>
                <p>电子邮箱(必填</p>
                <input class="keyword form-control" type="email" name="email" required>
                <p>用于联系用户</p>
                <br>
                <p>姓名</p>
                <input class="description form-control" type="text" name="name">
                <p>真实姓名</p>
                <br>
                <p>密码(必填)</p>
                <input class="description form-control" type="password" name="password" required>
                <p>登录密码，至少4位</p>
                <br>
                <button class="btn btn-default btn-success">添加新用户</button>
            </form>
        </div>
            <div class="alltag">
            <table class="table table-responsive table-striped ">
                <tr>
                    <th>用户名</th>
                    <th>姓名</th>
                    <th>电子邮箱</th>
                    <th>操作</th>
                </tr>
                <?php
                foreach ($rows as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['username']?></td>
                        <td><?php
                            if(empty($value['realname'])){
                                echo "--";
                            }else{
                                echo $value['realname'];
                            }
                            ?></td>
                        <td><?php
                            if(empty($value['email'])){
                                echo "--";
                            }else{
                                echo $value['email'];
                            }
                            ?></td></td>
                        <td class="action">
                            <a href="../cores/doAdminAction.php?act=delete&id=<?php echo $value['aid'] ?>">删除用户</a> | <a href="#">编辑用户</a>
                        </td>
                    </tr>
                    <?php
                }
                mysqli_free_result($res);
                mysqli_close($link);
                ?>
            </table>
            <ul class="pagination">
                <li class="prev"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li class="next"><a href="#">&raquo;</a></li>
            </ul>
            </div>
        </div>
    </div>
</div>
<script src="js/min.js"></script>
</body>
</html>l>