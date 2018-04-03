<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/2
 * Time: 17:44
 */
require_once '../includes/includes.php';
$act=$_REQUEST['act'];
switch ($act) {
    case "add":
        $tname = @$_POST['tname'];
        $keyword = @$_POST['keyword'];
        $description = @$_POST['description'];
        $sql = "INSERT INTO gjt_tag(tname,keyword,description)VALUES('{$tname}','{$keyword}','{$description}')";
        $res = mysqli_query($link, $sql);
        if ($res) {
            alertMess("添加标签成功！", "../admin/tag.php");
        } else {
            mLog($sql."\n".mysqli_error($link));
            alertMess("添加标签失败！", "../admin/tag.php");
        }  
        break;
    case "delete":
            $tid = $_REQUEST['tid'];
            if(!is_numeric($tid)){
               exit("标签不合法");
            }else{
                $sql = "SELECT * FROM gjt_tag WHERE tid={$tid}";
                $res=mysqli_query($link,$sql);
                if(mysqli_num_rows($res)==0){
                    exit("标签不存在！");
                }else{
                    $sql="SELECT * FROM gjt_article WHERE tid={$tid}";
                    $res=mysqli_query($link,$sql);
                    if(mysqli_num_rows($res)!=0){
                        alertMess("该标签下有文章,无法删除！", "../admin/tag.php");
                    }else{
                        $sql="DELETE FROM gjt_tag WHERE tid={$tid}";
                        $res=mysqli_query($link,$sql);
                        if ($res) {
                            alertMess("删除签标成功！", "../admin/tag.php");
                        } else {
                            mLog($sql."\n".mysqli_error($link));
                            alertMess("删除标签失败！", "../admin/tag.php");
                        }
                    }
                }
            }
        break;
    case "update":
        $tid = $_REQUEST['tid'];
        $state=($_REQUEST['state']==0)?1:0;
        $sql = "UPDATE gjt_tag SET isoff={$state} WHERE tid={$tid}";
        $res = mysqli_query($link, $sql);
        if ($res) {
            alertMess("操作成功！", "../admin/tag.php");
        } else {
            mLog($sql."\n".mysqli_error($link));
            alertMess("操作失败！", "../admin/tag.php");
        }
        break;
}

