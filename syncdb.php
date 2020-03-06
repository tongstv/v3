<?php
require __DIR__ . "/nosql.php";
if (!defined('JSON_PRESERVE_ZERO_FRACTION')) {
    define('JSON_PRESERVE_ZERO_FRACTION', 1024);
}

$config['hosts'] = ["http://localhost:9200"];


if (file_exists(__DIR__ . "/../conf2.php")) {
   if(!function_exists('create_loai'))
   {
       require __DIR__ . "/../conf2.php";
   }

    $db2['host'] = "localhost";
    $db2['db_user'] = $home_db_user;
    $db2['db_name'] = $home_db_db;
    $db2['db_pass'] = $home_db_pass;
    $config['index'] = $home_db_db;


}

$nosql = new nosql($config);
$new=0;
if(isset($argv[1]) AND $argv[1]=="new")
{
    $new =1;
    echo "Đồng bộ lại";
}

$nosql->syncdb($db2,$new);