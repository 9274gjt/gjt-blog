<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/2
 * Time: 16:43
 */

/**
 * @return mysqli返回数据库连接
 * 数据库连接
 */
function connect(){
    $link=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE) or die('Connect Error:'.mysqli_connect_error());
    mysqli_set_charset($link,CHARSET);
    return $link;
}