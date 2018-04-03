<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/9
 * Time: 14:08
 */

function uploadFile($fileInfo,$uploadPath='upload',$allowExt=array('jpg','jpeg','gif','png'), $flag=true,$maxSize=2097152){
    //判断错误号
    if($fileInfo['error']>0)
    {
        switch ($fileInfo['error']) {
            case 1:
                $mes='上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                break;
            case 2:
                $mes= '上传文件超过了表单MAX_FILE_SIZE限制的大小';
                break;
            case 3:
                $mes= '文件部分被上传';
                break;
            case 4:
                $mes= '没有选择上传文件';
                break;
            case 6:
                $mes= '没有找到临时目录';
                break;
            case 7:
            case 8:
                $mes= '系统错误';
                break;
        }
        echo( $mes );
        return false;
    }

    if(! is_array($allowExt))
    {
        exit  ('系统错误');
    }


    //检测上传文件的类型
    $ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
    // $allowExt=array('jpg','jpeg','png','gif');
    if(! in_array($ext,$allowExt)){
        exit('非法文件类型');
    }


    //检测图片是否为真实的图片类型
    // $flag=true;
    if($flag){
        if(! @getimagesize($fileInfo['tmp_name']))
        {
            exit('不是真实图片文件');
        }
    }



    //检测上传文件的大小是否符合规范
    // $maxSize=2097152;
    if($fileInfo['size']>$maxSize){
        exit("上传文件过大");
    }

    //检测文件是否是通过HTTP_POST方式上传过来的
    if(! is_uploaded_file($fileInfo['tmp_name'])){
        exit('文件不是通过HTTP_POST方式上传上来的');
    }



    // $uploadPath='file';
    if(!file_exists($uploadPath)){
        mkdir($uploadPath,0777,true);
        chmod($uploadPath,0777);
    }
    
    $uniName=time().'.'.$ext;
    $destation=$uploadPath.'/'.$uniName;
    if(!@move_uploaded_file($fileInfo['tmp_name'],$destation))
    {
        exit('文件上传失败');

    }


    // echo '文件上传失败';
    // return array(
    // 	'newName'=>$destation,
    // 	'size'=>$fileInfo['size'],
    // 	'type'=>$fileInfo['type']

    // 	);
    return $uniName;

}
