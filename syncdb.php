<?php
require __DIR__ . "/nosql.php";

$config_server=require __DIR__'/config_server.php';
$config['hosts'] = [$config_server['host']];



if (!isset($home_db_db)) {
    require "../conf2.php";
    require "elatic.php";
}

$db2 = [];
$db2['host'] = "localhost";
$db2['db_user'] = $home_db_user;
$db2['db_name'] = $home_db_db;
$db2['db_pass'] = $home_db_pass;
$config['index'] = $home_db_db;


function deletesynced($db)
{



}


$nosql = new nosql($config);
$new = 0;
if (isset($argv[1]) AND $argv[1] == "new") {
    $new = 1;
    echo "Đồng bộ lại";
}

$nosql->syncdb($db2, $new);