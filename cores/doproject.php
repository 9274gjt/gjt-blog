<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/10
 * Time: 20:12
 */
require_once '../includes/includes.php';
$act=$_REQUEST['act'];
switch ($act){
    case "add":
        $proname = @$_POST['proname'];
        $keyword=@$_POST['keyword'];
        $descirption=@$_POST['description'];
        $prolink=@$_POST['link'];
        $fileinfo=$_FILES['pic'];
        $path='upload/'.date('Ymd');
        $pic=uploadFile($fileinfo,ROOT.$path);
        $picpath=$path.'/'.$pic;
        $sql="INSERT INTO gjt_project(proname,keyword,description,link,pic)VALUES('{$proname}','{$keyword}','{$descirption}','{$prolink}','{$picpath}')";
        $res=mysqli_query($link,$sql);
        print_r($res);
        if ($res) {
            alertMess("项目添加成功！", "../admin/project.php");
        } else {
            mLog($sql."\n".mysqli_error($link));
            alertMess("项目添加失败！", "../admin/project.php");
        }

        break;
    case "delete":
        $pid= $_REQUEST['pid'];
        if(!is_numeric($pid)){
            exit("项目不合法");
        }else{
            $sql = "SELECT * FROM gjt_project WHERE pid={$pid}";
            $res=mysqli_query($link,$sql);
            if(mysqli_num_rows($res)==0){
                exit("项目不存在！");
            }else{
                    $sql="DELETE FROM gjt_project WHERE pid={$pid}";
                    $res=mysqli_query($link,$sql);
                    if ($res) {
                        alertMess("删除项目成功！", "../admin/project.php");
                    } else {
                        mLog($sql."\n".mysqli_error($link));
                        alertMess("删除项目失败！", "../admin/project.php");
                    }
                
            }
        }
        break;
}
