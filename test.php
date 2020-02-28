<?php
require_once __DIR__."/elatic.php";

$sql="SELECT sim1, sim2, giaban, mang, tong FROM sim WHERE sim2 and simdl IN(1006) and mang=1 ORDER BY giaban ASC limit 0,68";

$a= \elatic\SqlToElatic($sql);
print_r($a);


$s=\elatic\getById("0796009999");
print_r($s);


//print_r(\elatic\getSim(2,$sql));


