<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/3
 * Time: 12:27
 */
require_once '../includes/includes.php';
$act=$_REQUEST['act'];
switch ($act){
    case "save":
    case "add":
        $title = @$_POST['title'];
        $author = @$_POST['author'];
        $tid = @$_POST['tag'];
        $intro = @$_POST['intro'];
        $content = @$_POST['content'];
        $time=time();
        if(empty($title)||empty($intro)||empty($content)){
            alertMess("文章标题，简介，内容不能为空！","../admin/article_add.php");
        }else{
            if($act=="add"){
                $sql="INSERT INTO gjt_article(title,author,intro,content,time,tid)VALUES('{$title}','{$author}','{$intro}','{$content}','{$time}','{$tid}')";
            }elseif($act=="save"){
                $sql="INSERT INTO gjt_article(title,author,intro,content,time,state,tid)VALUES('{$title}','{$author}','{$intro}','{$content}','{$time}',1,'{$tid}')";
            }
            $res=mysqli_query($link,$sql);
            if ($res) {
                alertMess("文章添加成功！", "../admin/article_list.php");
            } else {
                mLog($sql."\n".mysqli_error($link));
                alertMess("文章添加失败！", "../admin/article_add.php");
            }
        }
        break;
    case "recycle":
    case "reduction":
        $aid = $_REQUEST['aid'];
        if(!is_numeric($aid)){
           exit("文章id不合法");
        }else{
            $sql = "SELECT * FROM gjt_article WHERE aid={$aid}";
            $res=mysqli_query($link,$sql);
            if(mysqli_num_rows($res)==0){
                exit("文章不存在！");
            }else{
                if($act=="recycle"){
                    $sql="UPDATE gjt_article SET state=2 WHERE aid={$aid}";
                    $mess="文章已经入回收站！";
                }elseif($act=="reduction"){
                    $sql="UPDATE gjt_article SET state=1 WHERE aid={$aid}";
                    $mess="文章已还原！";
                }
                $res=mysqli_query($link,$sql);
                if ($res) {
                    alertMess($mess, "../admin/article_list.php");
                } else {
                    mLog($sql."\n".mysqli_error($link));
                    alertMess("文章移动失败！", "../admin/artice_list.php");
                }
            }
        }
        break;
    case "upsave":
    case "update":
        $aid=$_REQUEST['aid'];
        $title = @$_POST['title'];
        $author = @$_POST['author'];
        $tid = @$_POST['tag'];
        $intro = @$_POST['intro'];
        $content = @$_POST['content'];
        $time=time();
        if(empty($title)||empty($intro)||empty($content)){
            alertMess("文章标题，简介，内容不能为空！","../admin/article_add.php");
        }else {
            if ($act == "update") {
                $sql = "UPDATE gjt_article SET title='{$title}',author='{$author}',intro='{$intro}',content='{$content}',time='{$time}' WHERE aid={$aid}";
            } elseif ($act == "upsave") {
                $sql = "UPDATE gjt_article SET title='{$title}',author='{$author}',intro='{$intro}',content='{$content}',time='{$time}',state=1 WHERE aid={$aid}";
            }
            $res = mysqli_query($link, $sql);
            if ($res) {
                alertMess("文章修改成功！", "../admin/article_list.php");
            } else {
                mLog($sql . "\n" . mysqli_error($link));
                alertMess("文章修改失败！", "../admin/article_list.php");
            }
        }
    break;
    case "delete":
        $aid = $_REQUEST['aid'];
        if(!is_numeric($aid)){
            exit("文章id不合法");
        }else{
            $sql = "SELECT * FROM gjt_article WHERE aid={$aid}";
            $res=mysqli_query($link,$sql);
            if(mysqli_num_rows($res)==0){
                exit("文章不存在！");
            }else{
                $sql="DELETE FROM gjt_article WHERE aid={$aid}";
                $res=mysqli_query($link,$sql);
                if ($res) {
                    alertMess("文章删除成功！", "../admin/recycle.php");
                } else {
                    mLog($sql."\n".mysqli_error($link));
                    alertMess("文章删除失败！", "../admin/recycle.php");
                }
            }
        }
        break;
}