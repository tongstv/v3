<?php

namespace elatic;
if (!defined('JSON_PRESERVE_ZERO_FRACTION')) {
    define('JSON_PRESERVE_ZERO_FRACTION', 1024);
}
require __DIR__ . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

function getById($id)
{
    global $client,$home_db_db;

    $params['index'] = $home_db_db;
    $params['type'] = "_doc";
    $params['id'] = $id;
    $response = [];

    $response = $client->get($params)['_source'];


    return $response;

}


function log($log)
{
    global $client,$home_db_db;

    $params['index'] = $home_db_db."_logs";
    $params['type'] = "_doc";
    $params['body'] = $log;
    $client->index($params);
}
function error_log($log)
{
    global $client;

    $params['index'] = $home_db_db."_error_logs";
    $params['type'] = "_doc";
    $params['body'] = $log;
    $client->index($params);
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
        'sim-tien-don' => 8,
        'sim-luc-quy-giua' => 9,
        'sim-loc-phat' => 10,
        'sim-than-tai' => 11,
        'sim-ong-dia' => 12,
        'sim-kep' => 13, // bổ xung
        'sim-lap' => 14, // nâng cấp
        'sim-ngu-quy-giua' => 15,
        'sim-tu-quy-giua' => 16,
        'sim-dao' => 17, // bổ xung
        'sim-ganh' => 18, /// sim gánh
        'sim-phu-quy' => 19,
        'sim-dac-biet' => 20,
        'sim-nam-sinh' => 21,
        'sim-dau-co' => 22,
        'sim-de-nho' => 23,
        'sim-ngay-thang-nam-sinh' => 21

    );
    return $loais[$url];
}
function deletesimdl($simdl)
{
    global $client, $home_db_db;
    $client->deleteByQuery([
        'index' => $home_db_db,
        'type' => '_doc',
        'body' => [
            'query' => [
                'match' =>
                    ['simdl' => $simdl]


            ]]
    ]);
}

function num_rows($sql)
{
    global $client;
    $body = SqlToElatic($sql);
    $result = $client->search($body);
    require $result['hits']['total'];
}

function getSim($i, $sql)
{
    global $client;

    $body = SqlToElatic($sql);

    $result = $client->search($body);
//print_r($result);
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

    $total = $total < 10000 ? $total : 10000;
    return ['data' => $data, 'total' => $total];


}



function SqlToElatic($sql2)
{
    global  $home_db_db;
    $sql = strtolower($sql2);
    $sql=str_replace('[0-9]',".*",$sql);


    if (preg_match('/from(\s)?([\S]+)/', $sql, $index)) {
        $body['index'] = $home_db_db;
    }

    if (preg_match('/limit(\s)?([0-9]+)(\s)?\,(\s)?([0-9]+)/', $sql, $limit)) {
        $from = $limit[2];
        $size = $limit[5];
        $body['body']['from'] = $from;
        $body['body']['size'] = $size;

    }


    if (preg_match('/order(\s)?by(\s)?([\S]+)(\s)?([\S]+)/', $sql, $orderby)) {
        if (in_array($orderby[5], ['desc', 'asc'])) {
            $body['body']['sort'][$orderby[3]]['order'] = strtolower($orderby[5]);
        }

    }


    $and = [];
    if (preg_match('/r?like(\s)?\'([0-9\.*]+)\'/', $sql, $rlike)) {

        $and[] = [
            'wildcard' => [

                'sim2' => [
                    'wildcard' => "*" . str_replace(".*", "", $rlike[2])

                ]
            ]

        ];


    }


    if (preg_match('/and(\s)?\(RIGHT\(sim2\,([\d]+)\)(\s)?=(\s)?\'([0-9]+)\')/', $sql, $duoi)) {

        $and[] = [
            'wildcard' => [

                'sim2' => [
                    'wildcard' => "*" . $duoi[5]

                ]
            ]

        ];


    }
    if (preg_match('/sim2(\s)?rlike(\s)?\'\^([0-9]+).*\'/', $sql, $dau)) {

        $and[] = [
            'wildcard' => [

                'sim2' => [
                    'wildcard' => $dau[3] . "*"

                ]
            ]

        ];


    }

    if (preg_match('/right\(tong\,1\)(\s)?=(\s)?([0-9]+)/', $sql, $tong)) {


        $and[] = [
            'term' => [
                'tong' =>
                    ['value' => $tong[3]]
            ]
        ];


    }

    if (preg_match('/r?like(\s)?\'\.\*([0-9]+)\\$\'/', $sql, $rlike)) {

        $and[] = [
            'wildcard' => [

                'sim2' => [
                    'wildcard' => "*" . str_replace(".*", "", $rlike[2])

                ]
            ]

        ];


    }

    if (preg_match('/r?like(\s)?\'\^([0-9]+)\.\*([0-9]+)\$\'/', $sql, $rlike)) {

        $and[] = [
            'wildcard' => [

                'sim2' => [
                    'wildcard' => $rlike[2] . "*" . $rlike[3]

                ]
            ]

        ];


    }
    if (preg_match('/and(\s)?\(?mang(\s)?=(\s)?([\d]+)\)?/', $sql, $mang)) {

        $and[] = [
            'term' => [
                'mang' =>
                    ['value' => $mang[4]]
            ]
        ];
    }
    if (preg_match('/loai(\s)?=(\s?)([0-9]+)/', $sql, $loai)) {

        $and[] = [
            'term' => [
                'loai' =>
                    ['value' => $loai[3]]
            ]
        ];
    }


    if (preg_match('/simdl(\s)?in(\s)?\(([0-9]+)\)/', $sql, $simdl)) {


        $and[] = [
            'terms' => [
                'simdl' => @explode(",", $simdl[3])

            ]
        ];
    }
    if (preg_match('/and(\s)?\(?tong(\s)?=(\s)?([\d]+)\)?/', $sql, $tong)) {
        $and[] = [
            'term' => [
                'tong' =>
                    ['value' => $tong[4]]
            ]
        ];
    }
    if (preg_match('/and(\s)?\(left\(sim2,2\)(\s)?=(\s)?\'([0-9]+)\'\)/', $sql, $dau)) {
        $and[] = [
            'term' => [
                'dau' =>
                    ['value' => $dau[4]]
            ]
        ];
    }
    if (preg_match('/and(\s)?\(?tongnut(\s)?=(\s)?([\d]+)\?\)?/', $sql, $tongnut)) {
        $and[] = [
            'term' => [
                'tongnut' =>
                    ['value' => $tongnut[3]]
            ]
        ];
    }

    if (preg_match('/and(\s)?\(?left\(sim2\,2\)(\s)?=(\s)?([\d]+)\)?/', $sql, $dauso)) {
        $and[] = [
            'term' => [
                'dauso' =>
                    ['value' => $dauso[4]]
            ]
        ];
    }


    if (preg_match('/and(\s)?\(giaban(\s)?>=(\s)?([\d]+)(\s)?and(\s)?giaban(\s)?<=(\s)?([\d]+)\)/', $sql, $range)) {


        $and[] = ['range' =>
            ['giaban' =>
                [
                    'from' => $range[4],
                    'to' => $range[9]
                ]

            ]
        ];


    }

    if (preg_match('/and(\s)?\(?giaban(\s)?>(\s)?100\)?/', $sql, $range)) {


        $and[] = ['range' =>
            ['giaban' =>
                [
                    'from' => 100,
                    'to' => null
                ]

            ]
        ];

    }


    if (preg_match('/right\(tong\,1\)=([0-9+])/', $sql, $tong)) {

        $and[] = [
            'term' => [
                'diem' =>
                    ['value' => $tong[1]]
            ]
        ];


    }


    if (preg_match('/and(\s)?sim2(\s)?not(\s)?rlike\'\[([0-9]+)\]\'/', $sql, $rlike)) {


        $and[] =
            [
                "bool" => [
                    "must_not" => [
                        [
                            "regexp" => [
                                "sim2.keyword" => [
                                    "value" => "[" . $rlike[4] . "]",
                                    "flags_value" => 65535,
                                    "max_determinized_states" => 10000,
                                    "boost" => 1
                                ]
                            ]
                        ]
                    ],
                    "adjust_pure_negative" => true,
                    "boost" => 1
                ]
            ];


    }

    $i = 0;

    foreach ($and as $bool) {
        $i++;
        $tempbool[] = $bool;
        if ($i % 2 == 0) {
            $body['body']['query']['bool']['must'][]['bool']['must'] = array_values($tempbool);
            unset($tempbool);
        }
    }

    if (isset($tempbool)) {
        $body['body']['query']['bool']['must'][]['bool']['must'] = $tempbool;
    }



    if (preg_match('/and(\s)?simnamsinh(\s)?=\'([0-9-]+)\'(\s)?and(\s)?type(\s)?=\'([0-9]+)\'/', $sql, $array)) {

        list($ngay, $thang, $nam) = explode("-", $array[3]);
        $type = $array[7];


        if ($ngay < 10 AND $thang < 10) {
            $jayParsedAry =
                [
                    "bool" => [
                        "should" => [
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . $thang . $nam

                                    ]
                                ]
                            ],
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . $thang . substr($nam, -2, 2)
                                    ]
                                ]
                            ],
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . substr($ngay, -1, 1) . substr($thang, -1, 1) . $nam
                                    ]
                                ]
                            ],

                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . substr($ngay, -1, 1) . $thang . $nam
                                    ]
                                ]
                            ],


                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . substr($thang, -1, 1) . $nam
                                    ]
                                ]
                            ]

                        ]
                    ]

                ];

        } else if ($ngay >= 10 AND $thang < 10) {
            $jayParsedAry =
                [
                    "bool" => [
                        "should" => [
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . $thang . $nam

                                    ]
                                ]
                            ],
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . $thang . substr($nam, -2, 2)
                                    ]
                                ]
                            ],
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . substr($thang, -1, 1) . $nam
                                    ]
                                ]
                            ]

                        ]
                    ]

                ];

        } else {
            $jayParsedAry =
                [
                    "bool" => [
                        "should" => [
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . $thang . $nam

                                    ]
                                ]
                            ],
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . $ngay . $thang . substr($nam, -2, 2)
                                    ]
                                ]
                            ],
                            [
                                "wildcard" => [
                                    "sim2" => [
                                        "wildcard" => "*" . substr($ngay, -1, 1) . $thang . $nam
                                    ]
                                ]
                            ]

                        ]
                    ]

                ];

        }


        if ($type == 2) {


            if ($ngay < 10 AND $thang < 10) {
                $jayParsedAry =
                    [
                        "bool" => [
                            "should" => [

                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . $thang . substr($nam, -2, 2)
                                        ]
                                    ]
                                ],


                            ]
                        ]

                    ];

            } else if ($ngay >= 10 AND $thang < 10) {
                $jayParsedAry =
                    [
                        "bool" => [
                            "should" => [
                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . $thang . substr($nam, -2, 2)
                                        ]
                                    ]
                                ]

                            ]
                        ]

                    ];

            } else {
                $jayParsedAry =
                    [
                        "bool" => [
                            "should" => [
                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . $thang . substr($nam, -2, 2)
                                        ]
                                    ]
                                ]

                            ]
                        ]

                    ];

            }

        }
        if ($type == 1) {
            if ($ngay < 10 AND $thang < 10) {
                $jayParsedAry =
                    [
                        "bool" => [
                            "should" => [
                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . $thang . $nam

                                        ]
                                    ]
                                ],

                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . substr($ngay, -1, 1) . substr($thang, -1, 1) . $nam
                                        ]
                                    ]
                                ],

                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . substr($ngay, -1, 1) . $thang . $nam
                                        ]
                                    ]
                                ],


                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . substr($thang, -1, 1) . $nam
                                        ]
                                    ]
                                ]

                            ]
                        ]

                    ];

            } else if ($ngay >= 10 AND $thang < 10) {
                $jayParsedAry =
                    [
                        "bool" => [
                            "should" => [
                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . $thang . $nam

                                        ]
                                    ]
                                ],

                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . substr($thang, -1, 1) . $nam
                                        ]
                                    ]
                                ]

                            ]
                        ]

                    ];

            } else {
                $jayParsedAry =
                    [
                        "bool" => [
                            "should" => [
                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . $ngay . $thang . $nam

                                        ]
                                    ]
                                ],
                                [
                                    "wildcard" => [
                                        "sim2" => [
                                            "wildcard" => "*" . substr($ngay, -1, 1) . $thang . $nam
                                        ]
                                    ]
                                ]

                            ]
                        ]

                    ];

            }
        }


        unset($body);
        $body['body']['query'] = $jayParsedAry;


    }

    if (isset($body)) {
        $array['url'] =($_SERVER['HTTPS'] ? 'https://' :'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $array['sql']=preg_replace('/limit(.*)/','',$sql);
        $array['elatic']=json_encode($body);
        log($array);
        file_put_contents(__DIR__ . "/logs/elatic.txt", json_encode($body));
        $sql .= "\n\n==================================\n\n";
        $sql .= str_replace(['(', ')', ' '], ['\(', '\)', '(\s)?'], $sql);
        file_put_contents(__DIR__ . "/logs/sql.txt", $sql);


    }



    return $body;

}

//print_r(SqlToElatic("select * from sim where sim=1"));