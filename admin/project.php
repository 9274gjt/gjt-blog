<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/10
 * Time: 19:43
 */
require_once '../includes/includes.php';
verifyAdmin();
$sql="SELECT * FROM gjt_project";
$res=mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($res)){
    $rows[] = $row;
};
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
                <form action="../cores/doproject.php?act=add" method="post" enctype="multipart/form-data">
                    <h4>添加新项目</h4>
                    <p>名称</p>
                    <input class="tname form-control" type="text" name="proname">
                    <p>这将是它在站点上显示的名字</p>
                    <br>
                    <p>关键字</p>
                    <input class="keyword form-control" type="text" name="keyword">
                    <p>标签的关键字搜索</p>
                    <br>
                    <p>描述</p>
                    <input class="description form-control" type="text" name="description">
                    <p>用于对所属标签的文章的大致描述</p>
                    <br>
                    <p>项目地址</p>
                    <input class="description form-control" type="text" name="link">
                    <p>项目的链接地址</p>
                    <br>
                    <p>图片选择</p>
                    <input class="description form-control" type="file" name="pic">
                    <p>项目的背景图片</p>
                    <button class="btn btn-default btn-success">添加新项目</button>
                </form>
            </div>
            <div class="alltag">
                <table class="table table-responsive table-striped ">
                    <tr>
                        <th>项目名称</th>
                        <th>关键字</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    if(empty($rows)) {
                        ?>
                        <tr>
                            暂无项目，请管理员添加项目！
                        </tr>
                        <?php
                    }else {
                        foreach ($rows as $value) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $value['proname']?>
                                </td>
                                <td>
                                    <?php echo $value['keyword']?>
                                </td>
                                <td><?php echo $value['description']?></td>
                                <td class="action">
                                    <a href="../cores/doproject.php?act=delete&pid=<?php echo $value['pid'] ?>">删除标签</a> | <a href="<?php echo $value['link']?>">查看文章</a>
                                </td>
                            </tr>
                            <?php
                        }
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
</html>