#Hướng dẫn update v2 lên v3
- Các file  cần nâng cấp

- **search.php**
- **home.php**
- **sodep.php**
- **simhot.php**
- **ordered.php**
- ** cron.php **

================================================
##Thay đổi trong các file

         $page = explode("page=", $_SERVER['REQUEST_URI']);
            $page = isset($page[1]) ? $page[1] : 1;

            $max = 60;
            $bg = ($page - 1) * $max;

            $sql = "SELECT * FROM " . TABLE_SIM . " {$where} {$orderby} limit $bg,$max";

            $result = \elatic\getSim($bg, $sql);

            $this->assign("data", $result['data']);


            $pages = new Paginator($result['total'], 9, array(
                100,
                250,
                500));
            $paging = $pages->display_pages();


            $this->assign("paging", $paging);
   
## các  bước nâng cấp
1. upload thư mục **v3** lên thư mục root
2. conf2.php thêm 

```
        define('version','3');
        register_shutdown_function("shutdown_error_handler");
        
        function shutdown_error_handler()
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
```


3. include file **v3/elatic.php** vào file **index.php**

```
<?php
session_start();


$start_time = microtime(true); 
header('Content-Type: text/html; charset=utf-8');

require_once "app/lib/cache.php";
require_once "conf.inc.php";
require_once "app/lib/Database.class.php";

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
//$db->query("SET NAMES utf8");
require_once "app/lib/page.class.php";
require_once "app/lib/libs/SmartyBC.class.php";
require_once "app/lib/function.php";
require_once "app/lib/auth.php";
require_once "app/lib/mysqli.php";
require_once "app/lib/querycache.php";

require_once "v3/elatic.php"; #Thêm dòng này

```


#function create_loai
```
function create_loai($loai, $sloai)
{
    $str = "";
    $loais = \elatic\loais1();
    foreach ($loais AS $link_url => $link_name) {

        $str .= "<a class=\"list-group-item\" href='" . $link_url . ".html'>" . $link_name . "</a>
        ";


    }
    return $str;
}

```


#file ordered.php
```
        if (isset($_SERVER['HTTP_REFERER'])) {


            if (isset($_GET['cart'])) {

                $where = "WHERE sim2 IN('" . implode("', '", array_keys($_SESSION['mycart'])) . "')";
            } else
                $where = "WHERE sim2='" . $_GET['sosim'] . "'";


            $row = \elatic\getById($_GET['sosim']); /// Doạn thay đổi

                $tt += $row['giaban'];
                $row['doctien'] = doctien($row['giaban'] * 1000000);
                $data[] = $row;


        } else {
            $row = array();
            $row['sim1'] = $sosim;
            $row['sim2'] = $sosim;
            $row['giaban'] = "Call";

            $data[] = $row;
        }
```
#file search.php fix function
```
    function namsinh($d, $m, $y, $x)
    {


        $where = "and simnamsinh ='" . $d . "-" . $m . "-" . $y . "' and type ='" . $x . "'";

        return $where;
    }

```

#$fix cron.php
modules/cron.php

```
<?php 
ini_set("display_errors",1);
include __DIR__."/../v3/syncdb.php";
include 'app/share/cron.php';


```


