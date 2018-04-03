<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/9
 * Time: 13:36
 */ /**
 * 产生验证码
 */
require_once "string_func.php";
//生成真彩图片，默认输出为黑色背景
/**
 * @param int $width
 * @param int $height
 * @param int $type
 * @param int $length
 * @param int $pixel
 * @param int $line
 */
function verifyImage($width=100, $height=30, $type=3, $length=4, $pixel=100, $line=4){
    session_start();
    $image=imagecreatetruecolor($width,$height);
    $bgcolor=imagecolorallocate($image,255,255,255);
    imagefill($image,0,0,$bgcolor);
//生成随机验证内容（数字+字母）
    $chars=bulidRandomString($type,$length);
    $_SESSION['verifycode']=strtolower($chars);
    $fontfiles=array("AGENCYB.TTF","AGENCYR.TTF","ARLRDBD.TTF","BERNHC.TTF","BOD_PSTC.TTF","CASTELAR.TTF");
    for($i=0;$i<$length;$i++){
        $size=18;
        $angle=mt_rand(-15,15);
        $x=($i*100/4)+rand(5,10);
        $y=mt_rand(20,25);
        $fontfile="../fonts/".$fontfiles[mt_rand(0,count($fontfiles)-1)];
        $color=imagecolorallocate($image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
        $text=substr($chars,$i,1);
        imagettftext($image,$size,$angle,$x,$y,$color,$fontfile,$text);
    }
//增加干扰点
    if($pixel){
        for($i=0;$i<$pixel;$i++){
            $pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
            imagesetpixel($image,rand(1,99),rand(1,29),$pointcolor);
        }
    }
//增加干扰线段
    if($line){
        for($i=0;$i<$line;$i++){
            $linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
            imageline($image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);
        }
    }

    header('content-type:image/png');
    imagepng($image);
    imagedestroy($image);
}
