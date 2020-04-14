<?php

namespace v3;
require dirname(__FILE__) . '/app/v3/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

function curl($query)
{
    $data = array("query" => $query);
    $data_string = json_encode($data);


    $ch = curl_init('http://localhost:9200/_xpack/sql/translate');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );

    $result = curl_exec($ch);


    $data = json_decode($result, true);

    return $data;

}

function maploai($url)
{
    $loais = array(

        'sim-luc-quy' => 1,
        'sim-ngu-quy' => 2,
        'sim-tu-quy' => 3,
        'sim-tam-hoa-kep' => 4,
        'sim-taxi-hai' => 5, /// nâng cấp
        'sim-taxi-ba' => 6, // bổ xung
        'sim-tam-hoa' => 7,
        'sim-tien-kep' => 8, // bổ xung
        'sim-tien-doi' => 9, // bổ xung
        'sim-ganh-kep' => 10, // bổ xung
        'sim-kep-ba' => 11, // bổ xung
        'sim-tien-don' => 12,
        'sim-luc-quy-giua' => 13,
        'sim-loc-phat' => 14,
        'sim-than-tai' => 15,
        'sim-ong-dia' => 16,
        'sim-kep' => 17, // bổ xung
        'sim-lap' => 18, // nâng cấp
        'sim-ngu-quy-giua' => 19,
        'sim-tu-quy-giua' => 20,
        'sim-dao' => 21, // bổ xung
        'sim-ganh' => 22, /// sim gánh
        'sim-phu-quy' => 23,
        'sim-dac-biet' => 24,
        'sim-nam-sinh' => 25,
        'sim-dau-co' => 26,
        'sim-de-nho' => 27,

    );
    return $loais[$url];
}

function loais()
{

    $loai = [
        1 => ['Sim Lục quý', 'sim-luc-quy'], //1
        2 => ['Sim ngũ quý', 'sim-ngu-quy'], //2
        3 => ['Sim tứ quý', 'sim-tu-quy'], //3
        4 => ['Sim tam hoa kép', 'sim-tam-hoa-kep'], //4
        5 => ['Sim Taxi hai', 'sim-taxi-hai'], //5
        6 => ['Sim Taxi ba', 'sim-taxi-ba'], //6
        7 => ['Sim tam hoa', 'sim-tam-hoa'], //7
        8 => ['Sim tiến kép', 'sim-tien-kep'], //8
        9 => ['Sim tiến đôi', 'sim-tien-doi'], //9
        10 => ['Sim gánh kép', 'sim-ganh-kep'], //10
        11 => ['Sim kép ba', 'sim-kép-ba'], //11
        12 => ['Sim tiến đơn', 'sim-tien-don'], //12
        13 => ['Sim Lục quý giữa', 'sim-luc-quy-giua'], //13
        14 => ['Sim Lộc Phát', 'sim-loc-phat'], //14
        15 => ['Sim Thần Tài', 'sim-than-tai'], //15
        16 => ['Sim Ông Địa', 'sim-ong-dia'], //16
        17 => ['Sim kép', 'sim-kep'], //17
        18 => ['Sim lặp', 'sim-lap'], //18
        19 => ['Sim ngũ quý giữa', 'sim-ngu-quy-giua'], //19
        20 => ['Sim tứ quý giũa', 'sim-tu-quy-giua'], //20
        21 => ['Sim đảo', 'sim-dao'], //21
        22 => ['Sim gánh', 'sim-ganh'], //22
        24 => ['Sim đặc biệt', 'sim-dac-biet'], //24
        25 => ['Sim Năm sinh', 'sim-nam-sinh'], //25
        26 => ['Sim đầu số cổ', 'sim-dau-co'], //26
        27 => ['Sim dễ nhớ', 'sim-de-nho'] //27
    ];
    $loais = [];
    foreach ($loai AS $row) {
        $loais[$row[1]] = $row[0];
    }
    return $loais;
}

function getSim($i, $sql)
{


    global $home_db_db;

    $sql = str_replace("from sim", "from " . $home_db_db, $sql);
    $body = curl($sql);
    $result = $client->search($body);

    $hits = $result['hits']['hits'];
    $total = $result['hits']['total'];

    $data = [];

    if (is_array($hits)) {

        foreach ($hits AS $row) {
            $i++;
            $row['_source']['stt'] = $i;
            $data[] = $row['_source'];
        }
    }

    return $data;

}

function fetch_all_array($sql)
{

    $sql = strtolower($sql);


    global $home_db_db;

    $sql = str_replace("from sim", "from " . $home_db_db, $sql);

    $body = curl($sql);
    $result = $client->search($body);

    $hits = $result['hits']['hits'];
    $total = $result['hits']['total'];

    $data = [];

    if (is_array($hits)) {

        foreach ($hits AS $row) {
            $i++;
            $row['_source']['stt'] = $i;
            $data[] = $row['_source'];
        }
    }

    return $data;


}