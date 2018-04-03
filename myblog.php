<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/8
 * Time: 10:25
 */
date_default_timezone_set('PRC');//东八时区 echo date('Y-m-d H:i:s');
require_once "includes/includes.php";
error_reporting(E_ALL);

//查出所有开启标签
$sql1="SELECT tid,tname FROM gjt_tag WHERE isoff=0";
$res1=mysqli_query($link,$sql1);
while($row1=mysqli_fetch_assoc($res1)){
    $rows1[]=$row1;
}
//标签分类
if(isset($_GET['tag'])){
    $where = $_GET['tag'] == "all" ? "" : "AND gjt_article.tid = $_GET[tag]";
}else{
    $where="";
}
//分页代码
$sql="SELECT COUNT(aid) AS total FROM gjt_article WHERE 1 ".$where;
$res=mysqli_query($link,$sql);
$num=mysqli_fetch_assoc($res)['total'];
$curr=isset($_GET['page'])?$_GET['page']:1;
$set=9;//每页显示记录条数
$page=getPage($num,$curr,$set);
$sql="SELECT *,tname FROM gjt_article LEFT JOIN gjt_tag ON gjt_article.tid=gjt_tag.tid WHERE gjt_tag.isoff=0 AND state=0 ".$where." ORDER BY aid DESC LIMIT ".($curr-1)*$set.','.$set;
$res=mysqli_query($link,$sql);
while($row=mysqli_fetch_assoc($res)){
    $rows[]=$row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GjtBlog</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="author" href="humans.txt">
</head>
<body>
    <div class="container">
        <?php require_once 'includes/front_header.php' ?>
        <section class="banner">
            <div class="content_box">
                <img class="face_box" src="images/pai.jpg" alt="">
                <h1 class="content_title">We All Dreamer</h1>
            </div>
        </section>
        <div class="article_box">
            <div class="article_box_header big_header">
                <div class='tag' id="tag">
                    <a  class="current" href="myblog.php?tag=all">全部标签：</a>
                    <?php
                        foreach ($rows1 as $item) {
                            ?>
                            <a href="myblog.php?tag=<?php echo$item['tid']?>"><?php echo $item['tname']?></a>
                            <?php
                        }
                    ?>
                </div>
                <div class='search'>
                    <input type="text" placeholder ="you could search here">
                </div>
            </div>
            <div class="article_list">
                <?php
                if(empty($rows)) {
                    ?>
                    <p style="color:red"> 此栏目下暂无文章，请管理员添加文章！</p>
                    <?php
                }else {
                    foreach ($rows as $value) {
                        $like=$value['click']
                        ?>
                        <div class='article_txt'>
                            <p class='publish_time'>Published in <span
                                    style="color:red"><?php echo date('Y-m-d', $value['time']) ?></span></p>
                            <span class='artcile_txt_tag'><?php echo $value['tname'] ?></span>
                            <article class="article_txt_content">
                                <h1><?php echo $value['title'] ?></h1>
                                <a href="article.php?aid=<?php echo $value['aid'] ?>"><?php echo $value['intro'] ?></a>
                            </article>
                            <div class='article_txt_footer'>
                                <img src="images/github.png" alt="">
                                <span><?php echo $value['author'] ?></span>
                                <div class='article_information'>
                                    <a href="#" class="praise" rel="<?php echo $value['aid'] ?>"><img src="images/like.png"
                                                     alt=""><span><?php echo $like ?></span></a>
                                    <a href="article.php?aid=<?php echo $value['aid'] ?>"><img src="images/view.png"
                                                     alt=""><span><?php echo $value['view'] ?></span></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                mysqli_free_result($res);
                mysqli_close($link);
                ?>
             </div>
            <!--分页-->
            <?php if($num<=$set){?>
                 <div style="display:none;"></div>
                    <?php }else{?>
            <div class="paging">
                <ul class="pagination">
                    <?php
                    $pre=($curr==1)?$curr:$curr-1;
                    $next=($curr==ceil($num/$set))?$curr:$curr+1;
                    ?>
                    <li><a href="myblog.php?page=<?php echo $pre?>"><<</a></li>
                    <?php foreach ($page as $k=>$v) {
                        if($k==$curr) {
                            ?>
                            <li><a  class="active"><?php echo $k; ?></a></li>
                            <?php
                        }else{
                         ?>
                            <li><a href="myblog.php?<?php echo $v?>"><?php echo $k;?></a></li>
                    <?php
                        }
                        }?>
                    <li><a href="myblog.php?page=<?php echo $next?>">>></a></li>
                </ul>
            </div>
            <?php }?>
        </div>
        <?php require_once 'includes/front_footer.php' ?>
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/min.js"></script>
    <script src="js/blog.js"></script>
    <script src="js/praise.js"></script>
</body>
</html>