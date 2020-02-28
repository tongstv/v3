<?php
require __DIR__ . "/nosql.php";
if (!defined('JSON_PRESERVE_ZERO_FRACTION')) {
    define('JSON_PRESERVE_ZERO_FRACTION', 1024);
}

$config['hosts'] = ["http://localhost:9200"];
$config['index'] = "sim";


$db['host'] = "103.249.103.31";
$db['db_user'] = "tksimcard_home";
$db['db_name'] = "tksimcard_home";
$db['db_pass'] = "@hyn12345";

if (file_exists(__DIR__ . "/../conf2.php")) {
    require __DIR__ . "/../conf2.php";
    $db['host'] = "localhost";
    $db['db_user'] = $home_db_user;
    $db['db_name'] = $home_db_db;
    $db['db_pass'] = $home_db_pass;


}
print_r($db);
$nosql = new nosql($config);
$total = ceil(6000000 / 2000);
for ($i = 1; $i <= $total; $i++) {
    $nosql->syncdb($db);
}