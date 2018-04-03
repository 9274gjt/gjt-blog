<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/8
 * Time: 15:22
 */ 
date_default_timezone_set('PRC'); //东八时区 echo date('Y-m-d H:i:s');
require_once "includes/includes.php";
$sql1="SELECT tid,tname FROM gjt_tag";
$res1=mysqli_query($link,$sql1);
while($row1=mysqli_fetch_assoc($res1)){
    $rows1[]=$row1;
}
$aid=$_REQUEST['aid'];
if(empty($aid)){
    exit('文章id为空');
}elseif(! is_numeric($aid)){
    exit("文章id不合法");
}else{
    $sql = "SELECT * FROM gjt_article WHERE aid={$aid}";
    $res=mysqli_query($link,$sql);
    if(mysqli_num_rows($res)==0) {
        exit("文章不存在！");
    }else{
        mysqli_query($link,"UPDATE gjt_article SET view=view+1 WHERE aid={$aid}");//阅读量加一
        $sql="SELECT * FROM gjt_article WHERE aid={$aid} ";
        $res=mysqli_query($link,$sql);
        $row=mysqli_fetch_assoc($res);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="uyan_auth" content="36fd179721" />
    <title>GjtBlog--<?php echo $row['title']?></title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/article.css">
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
        <div class="article_details">
            <article>
                <h1 id="title"><?php echo $row['title']?></h1>
                <h3>作者：<span><?php echo $row['author']?></span>时间: <span><?php echo date("Y-m-d",$row['time'])?></span></h3>
                <pre id="content"><?php echo $row['content']?></pre>
            </article>
            <div class="article_bottom">
                <div class='viewport'>
                    <span>浏览次数：<?php echo $row['view']?></span>
                    <span>点赞次数：<?php echo $row['click']?></span>
                </div>
                <div class="share">
                    <!-- JiaThis Button BEGIN -->
                    <div class="jiathis_style_24x24">
                        <a class="jiathis_button_qzone"></a>
                        <a class="jiathis_button_tsina"></a>
                        <a class="jiathis_button_tqq"></a>
                        <a class="jiathis_button_weixin"></a>
                        <a class="jiathis_button_renren"></a>
                        <a href="http://www.jiathis.com/share?uid=2124971" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                    </div>
                    <script type="text/javascript">
                        var jiathis_config = {data_track_clickback:'true',title:document.getElementById('title').innerHTML};
                    </script>
                    <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=2124971" charset="utf-8"></script>
                    <!-- JiaThis Button END -->
                </div>
            </div>

        </div>
        <div class="article_comment">
            <!-- UY BEGIN -->
            <div id="uyan_frame"></div>
            <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2124971"></script>
            <!-- UY END -->
        </div>
    </div>
    <?php require_once 'includes/front_footer.php' ?>
</div>
<script src="js/min.js"></script>
<script src="js/blog.js"></script>
</body>
</html>