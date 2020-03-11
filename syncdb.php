<?php
require __DIR__ . "/nosql.php";
if (!defined('JSON_PRESERVE_ZERO_FRACTION')) {
    define('JSON_PRESERVE_ZERO_FRACTION', 1024);
}

$config['hosts'] = ["http://localhost:9200"];


$db2=[];
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
    $ids=[];
    while ($row = $res->fetch_assoc()) {

        \elatic\deletesimdl($row['simdl']);

        $ids[]=$row['id'];
    }
    $db->query("delete from sync where id IN(".join(",",$ids).")");


}


$nosql = new nosql($config);
$new=0;
if(isset($argv[1]) AND $argv[1]=="new")
{
    $new =1;
    echo "Đồng bộ lại";
}

$nosql->syncdb($db2,$new);