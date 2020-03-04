<?php










function strstr_array_needle($haystack, $arrayNeedles)
{
    foreach ($arrayNeedles as $needle) {

        if (stristr($haystack, (string)$needle)) return true;

    }
    return false;
}

function loai($num)
{

    $loai = [
        1 => ['Sim Lục quý', 'sim-luc-quy'],
        2 => ['Sim ngũ quý', 'sim-ngu-quy'],
        3 => ['Sim tứ quý', 'sim-tu-quy'], //3
        4 => ['Sim tam hoa kép', 'sim-tam-hoa-kep'], //4
        5 => ['Sim Taxi hai', 'sim-taxi-hai'], //5
        6 => ['Sim Taxi ba', 'sim-taxi-ba'], //6
        7 => ['Sim tam hoa', 'sim-tam-hoa'], //7
        8 => ['Sim tiến đơn', 'sim-tien-don'], //8
        9 => ['Sim Lục quý giữa', 'sim-luc-quy-giua'],
        10 => ['Sim Lộc Phát', 'sim-loc-phat'], //10
        11 => ['Sim Thần Tài', 'sim-than-tai'], //11
        12 => ['Sim Ông Địa', 'sim-ong-dia'], //12
        13 => ['Sim kép', 'sim-kep'], //13
        14 => ['Sim lặp', 'sim-lap'], //14
        15 => ['Sim ngũ quý giữa', 'sim-ngu-quy-giua'], //15
        16 => ['Sim tứ quý giũa', 'sim-tu-quy-giua'], //16
        17 => ['Sim đảo', 'sim-dao'], //17
        18 => ['Sim gánh', 'sim-ganh'], //18
        19 => ['Sim Phú Quý', 'sim-phu-quy'], //19
        20 => ['Sim đặc biệt', 'sim-dac-biet'], //20
        21 => ['Sim Năm sinh', 'sim-nam-sinh'], //21
        22 => ['Sim đầu số cổ', 'sim-dau-co'], //22
        23 => ['Sim dễ nhớ', 'sim-de-nho'], //23
        24 => ['sim ngày tháng năm sinh','sim-ngay-thang-nam-sinh']
    ];
    return $loai[$num] ? $loai[$num] : '';
}

function loais()
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
    return $loais;
}

function phanloai($sim1)
{
    $sim2 = preg_replace('/[^0-9]/', '', $sim1);
    $r61 = substr($sim2, -6, 1);
    $r51 = substr($sim2, -5, 1);
    $r41 = substr($sim2, -4, 1);
    $r31 = substr($sim2, -3, 1);
    $r21 = substr($sim2, -2, 1);
    $r11 = substr($sim2, -1, 1);
    $r62 = substr($sim2, -6, 2);
    $r52 = substr($sim2, -5, 2);
    $r42 = substr($sim2, -4, 2);
    $r32 = substr($sim2, -3, 2);
    $r22 = substr($sim2, -2, 2);

    if (in_array(substr($sim2, -6, 6), array_merge(['000000'], range(111111, 999999, 111111)))) {
        return 1; // sim lục quý
    } else if (in_array(substr($sim2, -5, 5), array_merge(['00000'], range(11111, 99999, 11111)))) {
        return 2; // sim ngũ quý
    } else if (in_array(substr($sim2, -4, 4), array_merge(['0000'], range(1111, 9999, 1111)))) {
        return 3; // sim tứ quý
    } else if (in_array(substr($sim2, -3, 3), array_merge(['000'], range(111, 999, 111))) && in_array(substr($sim2, -6, 3), array_merge(['000'], range(111, 999, 111)))) {
        return 4; // sim tam hoa kép
    } else if ((substr($sim2, -2, 2) == substr($sim2, -4, 2)) && (substr($sim2, -4, 2) == substr($sim2, -6, 2)) && (substr($sim2, -1, 1) != substr($sim2, -2, 1))) {
        return 5; // sim taxi
    } else if ((substr($sim2, -3, 3) == substr($sim2, -6, 3) && substr($sim2, -1, 1) != substr($sim2, -2, 1))) {
        return 6; // sim taxi ba
    } else if (in_array(substr($sim2, -3), array_merge(['000'], range(111, 999, 111)))) {
        return 7; // sim tam hoa
    } else if ((in_array(substr($sim2, -3, 3), ['012', '123', '234', '345', '456', '567', '678', '789'])) || (in_array(substr($sim2, -4, 4), ['0123', '1234', '2345', '3456', '4567', '5678', '6789', '1357', '0246'])) || (in_array(substr($sim2, -5, 5), ['01234', '12345', '23456', '34567', '45678', '56789'])) || (in_array(substr($sim2, -6, 6), ['012345', '123456', '234567', '345678', '456789']))) {
        return 8; // tim tiến lên
    } else if (strstr_array_needle($sim2, array_merge(['000000'], range(111111, 999999, 111111)))) {
        return 9; // sim lục quý giữa
    } else if (in_array(substr($sim2, -2, 2), ['68', '86'])) {
        return 10; // lộc phát
    } else if (in_array(substr($sim2, -2, 2), ['39', '79'])) {
        return 11; // sim thần tài
    } else if (in_array(substr($sim2, -2, 2), ['38', '78'])) {
        return 12; // sim ông địa
    } else if (substr($sim2, -4, 1) == substr($sim2, -3, 1) && substr($sim2, -2, 1) == substr($sim2, -1, 1) && (substr($sim2, -3, 1) != substr($sim2, -2, 1))) {
        return 13;  //  sim kép
    } else if (substr($sim2, -4, 1) == substr($sim2, -2, 1) && substr($sim2, -3, 1) == substr($sim2, -1, 1) && substr($sim2, -2, 1) != substr($sim2, -1, 1)) {
        return 14;  // sim lặp
    } else if (strstr_array_needle($sim2, array_merge(['00000'], range(11111, 99999, 11111)))) {
        return 15;  //sim ngũ quý giũa
    } else if (strstr_array_needle($sim2, array_merge(['0000'], range(1111, 9999, 1111))) and substr($sim2, -2, 1) != substr($sim2, -1, 1)) {
        return 16;  // sim tứ quý giữa
    } else if (((substr($sim2, -4, 1) == substr($sim2, -1, 1)) && (substr($sim2, -3, 1) == substr($sim2, -2, 1)) && (substr($sim2, -2, 1) != substr($sim2, -1, 1))) || ((substr($sim2, -5, 1) == substr($sim2, -1, 1)) && (substr($sim2, -2, 1) != substr($sim2, -1, 1)) && ((substr($sim2, -4, 1) == substr($sim2, -3, 1)) && (substr($sim2, -3, 1) == substr($sim2, -2, 1)))) || ((substr($sim2, -6, 1) == substr($sim2, -1, 1)) && (substr($sim2, -4, 1) == substr($sim2, -3, 1)) && (substr($sim2, -5, 1) == substr($sim2, -2, 1)))) {
        return 17; // sim đảo
    } else if ((($r61 == $r41) && ($r61 == $r31) && ($r61 == $r11) && ($r61 != $r51) && ($r61 != $r21) && ($r51 != $r21)) || (($r61 == $r41) && ($r51 == $r21) && ($r31 == $r11) && ($r61 != $r51) && ($r61 != $r31) && ($r51 != $r31)) || (($r61 == $r41) && ($r31 == $r11) && ($r61 != $r51) && ($r61 != $r31) && ($r61 != $r21) && ($r51 != $r31) && ($r51 != $r21) && ($r31 != $r21)) || (($r61 == $r21) && ($r51 == $r11) && ($r41 == $r31) && ($r61 != $r51) && ($r61 != $r41) && ($r51 != $r41)) || (($r61 == $r51) && ($r61 == $r21) && ($r61 == $r11) && ($r61 != $r41) && ($r61 != $r31) && ($r41 != $r31))) {
        return 18; // sim ganh
    } else if (in_array(substr($sim2, -2, 2), ['66', '88', '99'])) {
        return 19; // sim phú quý
    } else if (in_array(substr($sim2, -4, 4), ['1102', '2204', '1618', '4404', '4953', '4078', '3456', '8683', '0378', '1668', '8386', '8683']) || substr($sim2, -7, 7) == '6677028' || substr($sim2, -5) == '36578' || substr($sim2, -6, 6) == '154078' || substr($sim2, -6, 6) == '838689' || substr($sim2, -5) == '55078') {
        return 20; // sim số độc
    } else if (in_array(substr($sim2, -4, 4), range(1950, date('Y'))) || (in_array(substr($sim2, -6, 2), range(1, 31)) && in_array(substr($sim2, -4, 2), range(1, 12))) && (in_array(substr($sim2, -2), range(50, 99)) || in_array(substr($sim2, -2), range(00, 21)))) {
        return 21; // sim năm sinh
    } else if (in_array(substr($sim2, 0, 4), ['0903', '0908', '0909', '0913', '0918', '0919', '0983', '0986', '0988', '0989', '0977', '0979', '0929', '0926', '0993', '0996', '0879'])) {
        return 22; // đầu số cổ

    } else {
        return 23;
    }
}


function tinhtong($sim2)
{
    $tong = 0;

    for ($i = 0; $i < strlen($sim2); $i++) {
        $tong += $sim2[$i];
    }

    return substr($tong, -2);
}

function simtomang($sim)
{
    $mang[1] = array(

        '097',
        '098',
        '096',
        '0162',
        '0163',
        '0164',
        '0165',
        '0166',
        '0167',
        '0168',
        '0169',
        '086',
        '039',
        '038',
        '037',
        '036',
        '035',
        '034',
        '033',
        '032'
    );
    $mang[2] = array(

        '090',
        '093',
        '0120',
        '0121',
        '0122',
        '0126',
        '0128',
        '089',

        '070',
        '079',
        '077',
        '076',
        '078'
    );
    $mang[3] = array(

        '091',
        '094',
        '0123',
        '0124',
        '0125',
        '0127',
        '0129',
        '088',

        '084',
        '081',
        '082',
        '083',
        '085'
    );
    $mang[4] = array(

        '092',
        '0186',
        '0188',
        '056',
        '058'
    );
    $mang[5] = array(

        '099',
        '0199',
        '059'
    );
    $mang[6] = array(
        '087'
    );

    $dau3 = substr($sim, 0, 3);
    $dau4 = substr($sim, 0, 4);

    foreach ($mang as $key => $array) {
        if (in_array($dau3, $array) || in_array($dau4, $array)) {
            return $key;
            break;
        }
    }

}