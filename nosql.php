<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

require "app/v3/nosql_function.php";
///require __DIR__ . "/elatic.php";
register_shutdown_function("shutdown_error_handler");

function shutdown_error_handler()
{


    $lasterror = error_get_last();
    if (isset($lasterror)) {
        $message = '' . $lasterror['type'] . ') | PHP Stopped | Message (' . $lasterror['message'] . ') | File (' . $lasterror['file'] . '';

        $lasterror['url'] = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'];
        $lasterror['domain'] = @$_SERVER['HTTP_HOST'];
        $lasterror['time'] =time();
        \elatic\error_log($lasterror);
    }


}
use Elasticsearch\ClientBuilder;


class nosql
{

    protected $index;
    protected $client;

    public function __construct($config)
    {
        $this->client = ClientBuilder::create()->build();
        $this->index = $config['index'];
    }

    public function map($index = null)
    {
        if ($index == null) $index = $this->index;
        /**
         * string
         * text and keyword
         * Numeric datatypes
         * long, integer, short, byte, double, float, half_float, scaled_float
         */

        $table = ['index' => $index, 'body' => ['settings' => ['number_of_shards' =>
            5, 'number_of_replicas' => 5], 'mappings' => ["_doc" => ['properties' =>

            [


                'sim1' => ['type' => 'keyword'],

                'sim2' => ['type' => 'keyword'],
                'giaban' => ['type' => 'double'],
                'gianhap' => ['type' => 'double'],
                'mang' => ['type' => 'integer'],
                'dau' => ['type' => 'integer'],
                'tong' => ['type' => 'integer'],
                'diem' => ['type' => 'integer'],
                'loai' => ['type' => 'integer'],
                'simdl' => ['type' => 'integer'],


            ]
        ]

        ]]];


        $indexParams['index'] = $index;
        $exists = $this->client->indices()->exists($indexParams);
        if (!$exists) {
            $response = $this->client->indices()->create($table);
        }


    }

    public function search($query, $sort, $from = 0, $size = 100)
    {

        $params = ['index' => $this->index,
            'body' => ['query' => $query,
                'sort' => $sort,
                'from' => $from,
                'size' => $size]];

        $response = $client->search($params);
        $this->toArray($response);
    }

    public function get($id, $index = null)
    {
        if ($index == null) $index = $this->index;
        $params = [
            'index' => $index,
            'id' => $id
        ];

        $source = $this->client->getSource($params);
        return $source;
    }

    public function index($data, $index = null)
    {
        if ($index == null) $index = $this->index;
        $params = [
            'index' => $index,
            'type' => '_doc',
            'body' => $data
        ];

        $result = $this->client->index($params);

        $status = ($result['result'] = 'created') ? 1 : 0;

        return $status;

    }

    public function toArray($data)
    {

        $array = [];
        $r = [];
        $total = 0;

        if (is_array($data)) {
            $hits = $data['hits']['hits'];
            $total = $data['hits']['total'];
            foreach ($hits AS $row) {
                $r[] = $row['_source'];
            }
        }

        $array = ['total' => $total, 'data' => $r];
        return $array;
    }

    public function bulk_data($data, $index = null)
    {

        if ($index == null) $index = $this->index;
        $i = 0;
        foreach ($data as $row) {
            $i++;


            $params['body'][] = [
                'index' => [
                    '_index' => $index,
                    '_type' => '_doc',
                    '_id' => $row['sim2']
                ]
            ];

            $params['body'][] = $row;

            if ($i % 1000 == 0) {

                $responses = $this->client->bulk($params);
                unset($responses);
                unset($params);


            }


        }

        if (isset($params)) {
            $responses = $this->client->bulk($params);
            unset($responses);
            unset($params);
        }


    }

    function addcol($db)
    {


        $sql = "SHOW COLUMNS FROM sim LIKE 'sync'";

        $query = $db->query($sql);

        if (empty($query->num_rows)) {
            $db->query("ALTER TABLE `sim` ADD `sync` int(1) NOT NULL default '0';");
        }


    }

    public function syncdb($config, $new = 0)
    {

        global $home_db_db;
        $this->map($home_db_db);

        $db = new mysqli($config['host'], $config['db_user'], $config['db_pass'],
            $config['db_name']);

        deletesynced($db);
        $sync = "where sync =0";
        if ($new == 1) {
            $db->query("update sim SET sync=0");
            $this->client->indices()->delete(['index' => $this->index]);
            $db->query("CREATE TRIGGER `syncdelete` AFTER DELETE ON `sim`
 FOR EACH ROW INSERT INTO sync (_type,simdl)
   VALUES ('DELETE', OLD.simdl)");
            echo "Hoàn thành đồng bộ lại\n";
            $sync = "";

        }


        $this->addcol($db);
        $data = [];


        if($new==1)
        {
            $count = $db->query("select count(*) from sim {$sync}");
            $count = $count->fetch_row();

            $count = $count[0];
        }
        else
        {
            $count =20000;
        }



        $max = 20000;
        $num = ceil($count / $max);


        for ($i = 0; $i < $num; $i++) {

            $bg = $max * $i;
            print "start " . $bg . "\n";

            $query = $db->query("select * from sim  {$sync}  limit $bg,$max");

            while ($row = $query->fetch_assoc()) {


                unset($row['stype']);

                $row['loai'] = phanloai($row['sim1']);
                $row['tong'] = tinhtong($row['sim2']);
                $row['mang'] = simtomang($row['sim2']);
                $row['dau'] = substr($row['sim2'], 0, 2);
                $row['diem'] = substr($row['tong'], -1, 1);

                if ($row['diem'] == 0) $row['diem'] = 10;

                $sims[] = "'" . $row['sim2'] . "'";
                $data[] = $row;


            }
            $this->bulk_data($data, $this->index);


            if ($sync) {
                if ($db->query("update sim SET sync = 1 WHERE sim2 IN(" . @join(', ', $sims) . ")")) {


                }

            }
            unset($sims);


            unset($data);
            $query->free();
            unset($row);
            unset($query);

        }
        $db->close();
    }
}



