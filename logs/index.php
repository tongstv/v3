<?php

if (file_exists(__DIR__ . "/../conf2.php")) {
    require __DIR__ . "/../conf2.php";
    $db['host'] = "localhost";
    $db['db_user'] = $home_db_user;
    $db['db_name'] = $home_db_db;
    $db['db_pass'] = $home_db_pass;
    $config['index'] = $home_db_db;


}
include  __DIR__."/../elatic.php";

$params['index'] = $home_db_db."_error_logs";
$params['body']['sort']['_id']['order']="desc";
$params['body']['size']=100;

$result = $client->search($params);

$result = $client->search($params);

$data=[];
foreach ($result['hits']['hits'] AS $row)
{
    $data[]=$row['_source'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>


<table class="table">
    <thead>
    <tr>
        <th>TIME</th>
        <th>FILE</th>
        <th>LINE</th>
        <th>MSG</th>
    </tr>
    </thead>
    <tbody>
   <?php foreach ($data AS $row):?>
    <tr>
        <td scope="row"><?php echo date('d.m.Y h:i:s',$row['time']);?></td>
        <td scope="row"><?php echo $row['file'];?></td>
        <td><?php echo $row['line'];?></td>
        <td><?php echo $row['message'];?></td>

    </tr>
    <?php endforeach;?>

    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
