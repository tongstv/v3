"# v3" 
#Hướng dẫn update v2 lên v3
- Các file  cần nâng cấp

- search.php
- home.php
- sodep.php
- simhot.php

================================================
#php replace

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
