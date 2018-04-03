<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/2
 * Time: 15:40
 */
require_once '../includes/includes.php';
verifyAdmin();
$sql="SELECT tid,tname,description,isoff FROM gjt_tag";
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
                <form action="../cores/dotag.php?act=add" method="post">
                    <h4>添加新标签</h4>
                    <p>名称</p>
                    <input class="tname form-control" type="text" name="tname">
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
                    <button class="btn btn-default btn-success">添加新标签</button>
                </form>
            </div>
            <div class="alltag">
                <table class="table table-responsive table-striped ">
                    <tr>
                        <th>标签名</th>
                        <th>描述</th>
                        <th>文章总数</th>
                        <th>操作</th>
                    </tr>
                    <?php
                        if(empty($rows)) {
                            ?>
                            <tr>
                                暂无标签，请管理员添加标签！
                            </tr>
                            <?php
                        }else {
                            foreach ($rows as $value) {
                                ?>
                                <tr>
                                    <td>
                                       <?php echo $value['tname']?>
                                    </td>
                                    <td>
                                        <?php echo $value['description']?>
                                    </td>
                                    <td>
                                    <?php 
                                    $sql1="SELECT count(1) AS couts FROM gjt_article WHERE tid=".$value['tid'];
                                    $res1=mysqli_query($link,$sql1);
                                    $rows1=mysqli_fetch_array($res1);
                                    echo $rows1[0];
                                    
                                    ?>
                                    </td>
                        
                                    <td class="action">
                                        <a href="../cores/dotag.php?act=delete&tid=<?php echo $value['tid'] ?>">删除标签</a> | <a href="#">查看文章</a> | <a href="../cores/dotag.php?act=update&tid=<?php echo $value['tid']?>&state=<?php echo $value['isoff'] ?>">
                                            <?php
                                           if($value['isoff']==0)echo "关闭";
                                            elseif($value['isoff']==1)echo "开启";
                                            ?></a>
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