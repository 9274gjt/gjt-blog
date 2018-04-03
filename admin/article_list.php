<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/3
 * Time: 21:02
 */
date_default_timezone_set('PRC'); //东八时区 echo date('Y-m-d H:i:s');
require_once '../includes/includes.php';
verifyAdmin();
$sql1="SELECT * FROM gjt_tag  ORDER BY tid DESC";
$res1=mysqli_query($link,$sql1);
while($row1 = mysqli_fetch_assoc($res1)){
    $rows1[] = $row1;
};
if(isset($_GET['post_status'])){
    if($_GET['post_status']=="all"){
        $where=" AND state !=2";
    }elseif($_GET['post_status']=="published"){
        $where=" AND state = 0";
    }elseif($_GET['post_status']=="draft"){
        $where=" AND state = 1";
    }
}else{
    $where="AND state !=2";
}
$time=!empty($_GET['time'])?$_GET['time']:null;

$Time=str_replace('-','',$time);
$tag=!empty($_GET['tag'])?$_GET['tag']:null;
$start=strtotime($time);
$end=strtotime('+1 month',$start);
if(is_numeric($Time)||is_numeric($tag)){
    if(is_numeric($tag) && is_numeric($Time)){
        $where1="time>={$start} AND time<={$end} AND gjt_article.tid={$tag}";
    }elseif(! is_numeric($tag) && is_numeric($Time)){
        $where1="time>={$start} AND time<={$end}";
    }else{
        $where1="gjt_article.tid={$tag}";
    }
}else {
    $where1 = "1 ";
}
$sql="SELECT aid,title,author,time,state,gjt_article.tid,tname FROM gjt_article LEFT JOIN gjt_tag ON gjt_article.tid=gjt_tag.tid WHERE ".$where1.$where." ORDER BY aid DESC";
$res=mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($res)){
    $rows[] = $row;
};
$all=mysqli_query($link,"SELECT aid FROM gjt_article WHERE state !=2");
$allrow=mysqli_num_rows($all);
$pub=mysqli_query($link,"SELECT aid FROM gjt_article WHERE state=0");
$pubrow=mysqli_num_rows($pub);
$craft=mysqli_query($link,"SELECT aid FROM gjt_article WHERE state=1");
$craftrow=mysqli_num_rows($craft);

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
    <link rel="stylesheet" href="css/manager.css">
</head>
<body>
<div class="wrapper">
    <?php require_once "../includes/admin_public.php" ?>
    <div class="page-wrapper">
        <div class="page-inner">
            <h1 class="article_header">文章 </h1>
            <a class="write_article"   href="article_add.php">写文章</a>
            <div class="article_instructions">
                <ul class="info">
                    <li class="all "><a class="active" href="article_list.php?post_status=all">全部</a><span>(<?php echo $allrow?>)</span>|</li>
                    <li class="published"><a href="article_list.php?post_status=published">发布</a><span>(<?php echo $pubrow?>)</span>|</li>
                    <li class="draft"><a href="article_list.php?post_status=draft">草稿</a><span>(<?php echo $craftrow?>)</span></li>
                </ul>
                <form id="post_filter" method="get">
                    <input  id="post_status" type="hidden" name="post_status" value="<?php echo $status?>">
                    <select name="time" id="select_time" >
                        <option value="alltime">全部日期</option>
                        <?php
                        foreach ($rows as $val) {
                            $data[]=date("Y年m月",$val['time']);
                        }
                        $time=array_unique($data);
                        for($i=0;$i<sizeof($time);$i++){
                            $a = array("年", "月");
                            $b = array('-', '');
                            $value[$i] = str_replace($a, $b, $time[$i]);
                            ?>
                            <option value="<?php echo $value[$i]?>"><?php echo $time[$i]?></option>
                        <?php }?>
                    </select>
                    <select name="tag" id="select_tag">
                        <option value="alltag">全部标签</option>
                        <?php
                        foreach ($rows1 as $item) {
                            ?>
                            <option value="<?php echo $item['tid']?>"><?php echo $item['tname']?></option>
                            <?php
                        }
                        mysqli_free_result($res1);
                        ?>
                    </select>
                    <button class="select">筛选</button>
                </form>
                    <table class="table table-responsive table-striped table_self">
                        <tr>
                            <th>标题</th>
                            <th>作者</th>
                            <th>标签</th>
                            <th>状态</th>
                            <th>评论</th>
                            <th>最后修改日期</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        if(empty($rows)) {
                        ?>
                        <tr>
                           没有文章!
                        </tr>
                        <?php
                        }else {
                            foreach ($rows as $value) {
                                ?>
                                <tr>
                                <td><?php echo $value['title']?></td>
                                <td><?php echo $value['author']?></td>
                                <td><?php echo $value['tname']?></td>
                                <td><?php
                                        if($value['state']==0)echo "发布";
                                        elseif($value['state']==1)echo "草稿";
                                        ?></td>
                                <td class="comments"><a href="#">2</a></td>
                                <td><?php echo date('Y-m-d H:i:s',$value['time']); ?></td>
                                <td class="action">
                                    <a href="../cores/doarticle.php?act=recycle&aid=<?php echo $value['aid'] ?>">移至回收站</a>
                                    | <a
                                        href="article_editor.php?aid=<?php echo $value['aid'] ?>">修改</a> | <a href="#">查看</a>
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