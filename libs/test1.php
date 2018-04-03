<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/18
 * Time: 16:06
 */ 
require_once '../includes/includes.php';
$sql = "SELECT time FROM gjt_article";
$res=mysqli_query($link,$sql);
while($row=mysqli_fetch_assoc($res)){
    $rows[]=$row;
};
foreach($rows as $key){
    $data[]=date("Y年m月",$key['time']);
}
$time=array_unique($data);


    for($i=0;$i<sizeof($time);$i++) {
        $a = array("年", "月");
        $b = array('-', '');
        $value[$i] = str_replace($a, $b, $time[$i]);
    }
var_dump($value);