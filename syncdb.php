<?php
require __DIR__ . "/nosql.php";

$config['hosts'] = ["http://localhost:9200"];


register_shutdown_function("shutdown_error_handler1");

function shutdown_error_handler1()
{


    $lasterror = error_get_last();
    if (isset($lasterror)) {
        $message = '' . $lasterror['type'] . ') | PHP Stopped | Message (' . $lasterror['message'] . ') | File (' . $lasterror['file'] . '';

        $lasterror['url'] = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'];
        $lasterror['domain'] = @$_SERVER['HTTP_HOST'];
        $lasterror['time'] = time();
        \elatic\error_log($lasterror);
    }


}


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
    $sql = "CREATE TABLE IF NOT EXISTS `sync` (
    `id` int(11) unsigned NOT NULL auto_increment,
    `_type` varchar(255) NOT NULL default '',
    `simdl` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`id`))";

    $db->query($sql);

    $db->query("CREATE TRIGGER `syncdelete` AFTER DELETE ON `sim`
 FOR EACH ROW INSERT INTO sync (_type,simdl)
   VALUES ('DELETE', OLD.simdl)");

    $res = $db->query("select * from sync");
    $simdls = [];
    $ids = [];
    while ($row = $res->fetch_assoc()) {

        \elatic\deletesimdl($row['simdl']);

        $ids[] = $row['id'];
    }
    $db->query("delete from sync where id IN(" . join(",", $ids) . ")");


}


$nosql = new nosql($config);
$new = 0;
if (isset($argv[1]) AND $argv[1] == "new") {
    $new = 1;
    echo "Đồng bộ lại";
}

$nosql->syncdb($db2, $new);