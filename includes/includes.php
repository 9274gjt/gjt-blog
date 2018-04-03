<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/2
 * Time: 16:47
 */
header("content-type:text/html,charset=utf-8");
session_start();
define("ROOT",substr(dirname(__FILE__),0,-8));
set_include_path(".".PATH_SEPARATOR.ROOT."libs".PATH_SEPARATOR.ROOT."configs".PATH_SEPARATOR.ROOT."cores".PATH_SEPARATOR.get_include_path());
require_once "configs.php";
require_once "connect.php";
require_once "common_func.php";
require_once "string_func.php";
require_once "coder_func.php";
require_once "upload.php";
$link=connect();