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
        23 => ['Sim Phú Quý', 'sim-phu-quy'], //23
        24 => ['Sim đặc biệt', 'sim-dac-biet'], //24
        25 => ['Sim Năm sinh', 'sim-nam-sinh'], //25
        26 => ['Sim đầu số cổ', 'sim-dau-co'], //26
        27 => ['Sim dễ nhớ', 'sim-de-nho'], //27
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
    } else if (

        (in_array($r62, array_merge(['00'], range(11, 99, 11)))
            && in_array($r42, array_merge(['00'], range(11, 99, 11)))
            && in_array($r22, array_merge(['00'], range(11, 99, 11)))
            && (($r41 == $r61 + 1 && $r21 == $r61 + 2)
                || ($r41 == $r61 + 2 && $r21 == $r61 + 4)
                || ($r41 == $r61 + 3 && $r21 == $r61 + 6)))

        ||
        (
            in_array($r62, array_merge(['00'], range(11, 99, 11)))
            && in_array($r42, array_merge(['00'], range(11, 99, 11)))
            && in_array($r22, array_merge(['00'], range(11, 99, 11)))
            && ($r31 > $r51  && $r11 > $r31)

        )


    ) {
        return 8; // sim-tien-kep


    } else if (
        (($r61 == $r41 && $r41 == $r21)

            && (
                ($r11 == $r31 + 1) && ($r11 == $r51 + 2)
                || (($r11 == $r31 + 2) && ($r11 == $r51 + 4))
                || (($r11 == $r31 + 3) && ($r11 == $r51 + 6))


            )

        )
        ||
        (
            ($r51 == $r31 && $r31 == $r11)

            && (
                ($r21 == $r41 + 1 && $r21 == $r61 + 2)
                || ($r21 == $r41 + 2 && $r21 == $r61 + 4)
                || ($r21 == $r41 + 3 && $r21 == $r61 + 6)
            )

        )



    ) {
        return 9; //sim-tien-doi

    } else if (

        in_array($r62, array_merge(['00'], range(11, 99, 11)))
        && in_array($r42, array_merge(['00'], range(11, 99, 11)))
        && in_array($r22, array_merge(['00'], range(11, 99, 11)))

        && ($r31 != $r11)
        && ($r62 == $r22)

    ) {
        return 10; //sim-ganh-kep

    } else
        if (in_array($r62, array_merge(['00'], range(11, 99, 11)))
            && in_array($r42, array_merge(['00'], range(11, 99, 11)))
            && in_array($r22, array_merge(['00'], range(11, 99, 11)))

            && ($r51 != $r31 && $r31 != $r11)

        ) {
            return 11; // sim-kep-ba

        } else if ((in_array(substr($sim2, -3, 3), ['012', '123', '234', '345', '456', '567', '678', '789'])) || (in_array(substr($sim2, -4, 4), ['0123', '1234', '2345', '3456', '4567', '5678', '6789', '1357', '0246'])) || (in_array(substr($sim2, -5, 5), ['01234', '12345', '23456', '34567', '45678', '56789'])) || (in_array(substr($sim2, -6, 6), ['012345', '123456', '234567', '345678', '456789']))) {
            return 12; // tim tiến đơn
        } else if (strstr_array_needle($sim2, array_merge(['000000'], range(111111, 999999, 111111)))) {
            return 13; // sim lục quý giữa
        } else if (in_array(substr($sim2, -2, 2), ['68', '86'])) {
            return 14; // lộc phát
        } else if (in_array(substr($sim2, -2, 2), ['39', '79'])) {
            return 15; // sim thần tài
        } else if (in_array(substr($sim2, -2, 2), ['38', '78'])) {
            return 16; // sim ông địa
        } else if (substr($sim2, -4, 1) == substr($sim2, -3, 1) && substr($sim2, -2, 1) == substr($sim2, -1, 1) && (substr($sim2, -3, 1) != substr($sim2, -2, 1))) {
            return 17;  //  sim kép
        } else if (substr($sim2, -4, 1) == substr($sim2, -2, 1) && substr($sim2, -3, 1) == substr($sim2, -1, 1) && substr($sim2, -2, 1) != substr($sim2, -1, 1)) {
            return 18;  // sim lặp
        } else if (strstr_array_needle($sim2, array_merge(['00000'], range(11111, 99999, 11111)))) {
            return 19;  //sim ngũ quý giũa
        } else if (strstr_array_needle($sim2, array_merge(['0000'], range(1111, 9999, 1111))) and substr($sim2, -2, 1) != substr($sim2, -1, 1)) {
            return 20;  // sim tứ quý giữa
        } else if (((substr($sim2, -4, 1) == substr($sim2, -1, 1)) && (substr($sim2, -3, 1) == substr($sim2, -2, 1)) && (substr($sim2, -2, 1) != substr($sim2, -1, 1))) || ((substr($sim2, -5, 1) == substr($sim2, -1, 1)) && (substr($sim2, -2, 1) != substr($sim2, -1, 1)) && ((substr($sim2, -4, 1) == substr($sim2, -3, 1)) && (substr($sim2, -3, 1) == substr($sim2, -2, 1)))) || ((substr($sim2, -6, 1) == substr($sim2, -1, 1)) && (substr($sim2, -4, 1) == substr($sim2, -3, 1)) && (substr($sim2, -5, 1) == substr($sim2, -2, 1)))) {
            return 21; // sim đảo
        } else if ((($r61 == $r41) && ($r61 == $r31) && ($r61 == $r11) && ($r61 != $r51) && ($r61 != $r21) && ($r51 != $r21)) || (($r61 == $r41) && ($r51 == $r21) && ($r31 == $r11) && ($r61 != $r51) && ($r61 != $r31) && ($r51 != $r31)) || (($r61 == $r41) && ($r31 == $r11) && ($r61 != $r51) && ($r61 != $r31) && ($r61 != $r21) && ($r51 != $r31) && ($r51 != $r21) && ($r31 != $r21)) || (($r61 == $r21) && ($r51 == $r11) && ($r41 == $r31) && ($r61 != $r51) && ($r61 != $r41) && ($r51 != $r41)) || (($r61 == $r51) && ($r61 == $r21) && ($r61 == $r11) && ($r61 != $r41) && ($r61 != $r31) && ($r41 != $r31))) {
            return 22; // sim ganh
        } else if (in_array(substr($sim2, -2, 2), ['66', '88', '99'])) {
            return 23; // sim phú quý
        } else if (in_array(substr($sim2, -4, 4), ['1102', '2204', '1618', '4404', '4953', '4078', '3456', '8683', '0378', '1668', '8386', '8683']) || substr($sim2, -7, 7) == '6677028' || substr($sim2, -5) == '36578' || substr($sim2, -6, 6) == '154078' || substr($sim2, -6, 6) == '838689' || substr($sim2, -5) == '55078') {
            return 24; // sim đặc biệt
        } else if (in_array(substr($sim2, -4, 4), range(1950, date('Y'))) || (in_array(substr($sim2, -6, 2), range(1, 31)) && in_array(substr($sim2, -4, 2), range(1, 12))) && (in_array(substr($sim2, -2), range(50, 99)) || in_array(substr($sim2, -2), range(00, 21)))) {
            return 25; // sim năm sinh
        } else if (in_array(substr($sim2, 0, 4), ['0903', '0908', '0909', '0913', '0918', '0919', '0983', '0986', '0988', '0989', '0977', '0979', '0929', '0926', '0993', '0996', '0879'])) {
            return 26; // đầu số cổ

        } else {
            return 27;
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
        '059',
        '052'
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