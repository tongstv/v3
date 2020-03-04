<?php
require __DIR__ . "/nosql.php";
if (!defined('JSON_PRESERVE_ZERO_FRACTION')) {
    define('JSON_PRESERVE_ZERO_FRACTION', 1024);
}

$config['hosts'] = ["http://localhost:9200"];
$config['index'] = "sim";


$db['host'] = "localhost";
$db['db_user'] = "";
$db['db_name'] = "";
$db['db_pass'] = "";

if (file_exists(__DIR__ . "/../conf2.php")) {
    require __DIR__ . "/../conf2.php";
    $db['host'] = "localhost";
    $db['db_user'] = $home_db_user;
    $db['db_name'] = $home_db_db;
    $db['db_pass'] = $home_db_pass;


}

$nosql = new nosql($config);
$new=0;
if(isset($argv[1]) AND $argv[1]=="new")
{
    $new =1;
    echo "Đồng bộ lại";
}

$nosql->syncdb($db,$new);