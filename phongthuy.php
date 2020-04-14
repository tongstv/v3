<?php

namespace phongthuy;


class phongthuy
{

    function quanhets($sosim)
    {
        $hathu = array(
            0 => 'Thủy',
            1 => 'Thủy',
            2 => 'Thổ',
            3 => 'Mộc',
            4 => 'Mộc',
            5 => 'Thổ',
            6 => 'Kim',
            7 => 'Kim',
            8 => 'Thổ',
            9 => 'Hỏa');

        $sosim = (string )$sosim;


        $khac = 0;
        $sinh = 0;

        for ($i = 0; $i < strlen($sosim); $i++) {


            if ($i < strlen($sosim) - 1) {

                $nguhanh = ($hathu[$sosim[$i]]);
                $nguhanh2 = ($hathu[$sosim[$i + 1]]);

                $tuongsinh = $this->nguhangtuongsinh($nguhanh, $nguhanh2);

                if ($tuongsinh == 'Tương Sinh') {
                    $sinh++;
                } else if ($tuongsinh == 'Tương khắc') {
                    $khac++;
                }
            }


        }


        return ['sinh' => $sinh, 'khac' => $khac];
    }

    function nguhanhso($sosim)
    {
        $hathu = array(
            0 => 'Thủy',
            1 => 'Thủy',
            2 => 'Thổ',
            3 => 'Mộc',
            4 => 'Mộc',
            5 => 'Thổ',
            6 => 'Kim',
            7 => 'Kim',
            8 => 'Thổ',
            9 => 'Hỏa');
        $lacdo = array(
            0 => 'Thổ',
            1 => 'Thủy',
            2 => 'Hỏa',
            3 => 'Mộc',
            4 => 'Kim',
            5 => 'Thổ',
            6 => 'Thủy',
            7 => 'Hỏa',
            8 => 'Mộc',
            9 => 'Kim');


        $sosim = (string )$sosim;


        $str = '';
        $td1 = '';
        $td2 = '';
        $td3 = '';
        $tuongsinh = 0;

        $tuongkhac = 0;
        for ($i = 0; $i < strlen($sosim); $i++) {


            $nguhanh = ($hathu[$sosim[$i]]);
            $nguhanh2 = ($hathu[$sosim[$i + 1]]);

            $tuongsinh2 = $this->nguhangtuongsinh($nguhanh, $nguhanh2);


            $td1 .= '<td class="text-center"><strong>' . $sosim[$i] . '</strong></td>';
            $td2 .= '<td class="text-center">' . $hathu[$sosim[$i]] . '</td>';


            if ($i % 2 == 0) {

                if ($tuongsinh == 'Tương Sinh') {
                    $tuongsinh++;
                }
                if ($tuongsinh == 'Tương khắc') {
                    $tuongkhac++;
                }

                if ($tuongsinh2 == 'Tương Sinh') $tuongsinh2 = '<span class="text-success">' . $tuongsinh2 . '</span>';

                if ($tuongsinh2 == 'Tương Khắc') $tuongsinh2 = '<span class="text-danger">' . $tuongsinh2 . '</span>';

                $td3 .= '<td class="text-center" colspan="2">' . str_replace('Không sinh không khắc',
                        '', $tuongsinh2) . '</td>';
            }


        }
        $str .= '<tr>';
        $str .= $td1;
        $str .= '</tr>';

        $str .= '<tr>';
        $str .= $td2;
        $str .= '</tr>';

        $str .= '<tr>';
        $str .= $td3;
        $str .= '</tr>';


        return $str;

    }

    function namtocungphi($namsinh)
    {
        $data = '{
   "1924": {
      "FIELD2": "Giáp Tý",
      "FIELD3": "Ốc Thượng Chi Thử – Chuột ở nóc nhà",
      "FIELD4": "Hải Trung Kim",
      "FIELD5": "Vàng trong biển",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1925": {
      "FIELD2": "Ất Sửu",
      "FIELD3": "Hải Nội Chi Ngưu – Trâu trong biển",
      "FIELD4": "Hải Trung Kim",
      "FIELD5": "Vàng trong biển",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1926": {
      "FIELD2": "Bính Dần",
      "FIELD3": "Sơn Lâm Chi Hổ – Hổ trong rừng",
      "FIELD4": "Lư Trung Hỏa",
      "FIELD5": "Lửa trong lò",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1927": {
      "FIELD2": "Đinh Mão",
      "FIELD3": "Vọng Nguyệt Chi Thố – Thỏ ngắm trăng",
      "FIELD4": "Lư Trung Hỏa",
      "FIELD5": "Lửa trong lò",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Khôn Thổ"
   },
   "1928": {
      "FIELD2": "Mậu Thìn",
      "FIELD3": "Thanh Ôn Chi Long – Rồng trong sạch, ôn hoà",
      "FIELD4": "Đại Lâm Mộc",
      "FIELD5": "Gỗ rừng già",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1929": {
      "FIELD2": "Kỷ Tỵ",
      "FIELD3": "Phúc Khí Chi Xà – Rắn có phúc",
      "FIELD4": "Đại Lâm Mộc",
      "FIELD5": "Gỗ rừng già",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1930": {
      "FIELD2": "Canh Ngọ",
      "FIELD3": "Thất Lý Chi Mã – Ngựa trong nhà",
      "FIELD4": "Lộ Bàng Thổ",
      "FIELD5": "Đất bên đường",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1931": {
      "FIELD2": "Tân Mùi",
      "FIELD3": "Đắc Lộc Chi Dương – Dê có lộc",
      "FIELD4": "Lộ Bàng Thổ",
      "FIELD5": "Đất bên đường",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1932": {
      "FIELD2": "Nhâm Thân",
      "FIELD3": "Thanh Tú Chi Hầu – Khỉ thanh tú",
      "FIELD4": "Kiếm Phong Kim",
      "FIELD5": "Vàng chuôi kiếm",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1933": {
      "FIELD2": "Quý Dậu",
      "FIELD3": "Lâu Túc Kê – Gà nhà gác",
      "FIELD4": "Kiếm Phong Kim",
      "FIELD5": "Vàng chuôi kiếm",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1934": {
      "FIELD2": "Giáp Tuất",
      "FIELD3": "Thủ Thân Chi Cẩu – Chó giữ mình",
      "FIELD4": "Sơn Đầu Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1935": {
      "FIELD2": "Ất Hợi",
      "FIELD3": "Quá Vãng Chi Trư – Lợn hay đi",
      "FIELD4": "Sơn Đầu Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1936": {
      "FIELD2": "Bính Tý",
      "FIELD3": "Điền Nội Chi Thử – Chuột trong ruộng",
      "FIELD4": "Giản Hạ Thủy",
      "FIELD5": "Nước khe suối",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Khôn Thổ"
   },
   "1937": {
      "FIELD2": "Đinh Sửu",
      "FIELD3": "Hồ Nội Chi Ngưu – Trâu trong hồ nước",
      "FIELD4": "Giản Hạ Thủy",
      "FIELD5": "Nước khe suối",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1938": {
      "FIELD2": "Mậu Dần",
      "FIELD3": "Quá Sơn Chi Hổ – Hổ qua rừng",
      "FIELD4": "Thành Đầu Thổ",
      "FIELD5": "Đất đắp thành",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1939": {
      "FIELD2": "Kỷ Mão",
      "FIELD3": "Sơn Lâm Chi Thố – Thỏ ở rừng",
      "FIELD4": "Thành Đầu Thổ",
      "FIELD5": "Đất đắp thành",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1940": {
      "FIELD2": "Canh Thìn",
      "FIELD3": "Thứ Tính Chi Long – Rồng khoan dung",
      "FIELD4": "Bạch Lạp Kim",
      "FIELD5": "Vàng sáp ong",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1941": {
      "FIELD2": "Tân Tỵ",
      "FIELD3": "Đông Tàng Chi Xà – Rắn ngủ đông",
      "FIELD4": "Bạch Lạp Kim",
      "FIELD5": "Vàng sáp ong",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1942": {
      "FIELD2": "Nhâm Ngọ",
      "FIELD3": "Quân Trung Chi Mã – Ngựa chiến",
      "FIELD4": "Dương Liễu Mộc",
      "FIELD5": "Gỗ cây dương",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1943": {
      "FIELD2": "Quý Mùi",
      "FIELD3": "Quần Nội Chi Dương – Dê trong đàn",
      "FIELD4": "Dương Liễu Mộc",
      "FIELD5": "Gỗ cây dương",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1944": {
      "FIELD2": "Giáp Thân",
      "FIELD3": "Quá Thụ Chi Hầu – Khỉ leo cây",
      "FIELD4": "Tuyền Trung Thủy",
      "FIELD5": "Nước trong suối",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1945": {
      "FIELD2": "Ất Dậu",
      "FIELD3": "Xướng Ngọ Chi Kê – Gà gáy trưa",
      "FIELD4": "Tuyền Trung Thủy",
      "FIELD5": "Nước trong suối",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Khôn Thổ"
   },
   "1946": {
      "FIELD2": "Bính Tuất",
      "FIELD3": "Tự Miên Chi Cẩu – Chó đang ngủ",
      "FIELD4": "Ốc Thượng Thổ",
      "FIELD5": "Đất nóc nhà",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1947": {
      "FIELD2": "Đinh Hợi",
      "FIELD3": "Quá Sơn Chi Trư – Lợn qua núi",
      "FIELD4": "Ốc Thượng Thổ",
      "FIELD5": "Đất nóc nhà",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1948": {
      "FIELD2": "Mậu Tý",
      "FIELD3": "Thương Nội Chi Trư – Chuột trong kho",
      "FIELD4": "Thích Lịch Hỏa",
      "FIELD5": "Lửa sấm sét",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1949": {
      "FIELD2": "Kỷ Sửu",
      "FIELD3": "Lâm Nội Chi Ngưu – Trâu trong chuồng",
      "FIELD4": "Thích Lịch Hỏa",
      "FIELD5": "Lửa sấm sét",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1950": {
      "FIELD2": "Canh Dần",
      "FIELD3": "Xuất Sơn Chi Hổ – Hổ xuống núi",
      "FIELD4": "Tùng Bách Mộc",
      "FIELD5": "Gỗ tùng bách",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1951": {
      "FIELD2": "Tân Mão",
      "FIELD3": "Ẩn Huyệt Chi Thố – Thỏ trong hang",
      "FIELD4": "Tùng Bách Mộc",
      "FIELD5": "Gỗ tùng bách",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1952": {
      "FIELD2": "Nhâm Thìn",
      "FIELD3": "Hành Vũ Chi Long – Rồng phun mưa",
      "FIELD4": "Trường Lưu Thủy",
      "FIELD5": "Nước chảy mạnh",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1953": {
      "FIELD2": "Quý Tỵ",
      "FIELD3": "Thảo Trung Chi Xà – Rắn trong cỏ",
      "FIELD4": "Trường Lưu Thủy",
      "FIELD5": "Nước chảy mạnh",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1954": {
      "FIELD2": "Giáp Ngọ",
      "FIELD3": "Vân Trung Chi Mã – Ngựa trong mây",
      "FIELD4": "Sa Trung Kim",
      "FIELD5": "Vàng trong cát",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Khôn Thổ"
   },
   "1955": {
      "FIELD2": "Ất Mùi",
      "FIELD3": "Kính Trọng Chi Dương – Dê được quý mến",
      "FIELD4": "Sa Trung Kim",
      "FIELD5": "Vàng trong cát",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1956": {
      "FIELD2": "Bính Thân",
      "FIELD3": "Sơn Thượng Chi Hầu – Khỉ trên núi",
      "FIELD4": "Sơn Hạ Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1957": {
      "FIELD2": "Đinh Dậu",
      "FIELD3": "Độc Lập Chi Kê – Gà độc thân",
      "FIELD4": "Sơn Hạ Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1958": {
      "FIELD2": "Mậu Tuất",
      "FIELD3": "Tiến Sơn Chi Cẩu – Chó vào núi",
      "FIELD4": "Bình Địa Mộc",
      "FIELD5": "Gỗ đồng bằng",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1959": {
      "FIELD2": "Kỷ Hợi",
      "FIELD3": "Đạo Viện Chi Trư – Lợn trong tu viện",
      "FIELD4": "Bình Địa Mộc",
      "FIELD5": "Gỗ đồng bằng",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1960": {
      "FIELD2": "Canh Tý",
      "FIELD3": "Lương Thượng Chi Thử – Chuột trên xà",
      "FIELD4": "Bích Thượng Thổ",
      "FIELD5": "Đất tò vò",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1961": {
      "FIELD2": "Tân Sửu",
      "FIELD3": "Lộ Đồ Chi Ngưu – Trâu trên đường",
      "FIELD4": "Bích Thượng Thổ",
      "FIELD5": "Đất tò vò",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1962": {
      "FIELD2": "Nhâm Dần",
      "FIELD3": "Quá Lâm Chi Hổ – Hổ qua rừng",
      "FIELD4": "Kim Bạch Kim",
      "FIELD5": "Vàng pha bạc",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1963": {
      "FIELD2": "Quý Mão",
      "FIELD3": "Quá Lâm Chi Thố – Thỏ qua rừng",
      "FIELD4": "Kim Bạch Kim",
      "FIELD5": "Vàng pha bạc",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Khôn Thổ"
   },
   "1964": {
      "FIELD2": "Giáp Thìn",
      "FIELD3": "Phục Đầm Chi Lâm – Rồng ẩn ở đầm",
      "FIELD4": "Phú Đăng Hỏa",
      "FIELD5": "Lửa đèn to",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1965": {
      "FIELD2": "Ất Tỵ",
      "FIELD3": "Xuất Huyệt Chi Xà – Rắn rời hang",
      "FIELD4": "Phú Đăng Hỏa",
      "FIELD5": "Lửa đèn to",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1966": {
      "FIELD2": "Bính Ngọ",
      "FIELD3": "Hành Lộ Chi Mã – Ngựa chạy trên đường",
      "FIELD4": "Thiên Hà Thủy",
      "FIELD5": "Nước trên trời",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1967": {
      "FIELD2": "Đinh Mùi",
      "FIELD3": "Thất Quần Chi Dương – Dê lạc đàn",
      "FIELD4": "Thiên Hà Thủy",
      "FIELD5": "Nước trên trời",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1968": {
      "FIELD2": "Mậu Thân",
      "FIELD3": "Độc Lập Chi Hầu – Khỉ độc thân",
      "FIELD4": "Đại Trạch Thổ",
      "FIELD5": "Đất nền nhà",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1969": {
      "FIELD2": "Kỷ Dậu",
      "FIELD3": "Báo Hiệu Chi Kê – Gà gáy",
      "FIELD4": "Đại Trạch Thổ",
      "FIELD5": "Đất nền nhà",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1970": {
      "FIELD2": "Canh Tuất",
      "FIELD3": "Tự Quan Chi Cẩu – Chó nhà chùa",
      "FIELD4": "Thoa Xuyến Kim",
      "FIELD5": "Vàng trang sức",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1971": {
      "FIELD2": "Tân Hợi",
      "FIELD3": "Khuyên Dưỡng Chi Trư – Lợn nuôi nhốt",
      "FIELD4": "Thoa Xuyến Kim",
      "FIELD5": "Vàng trang sức",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1972": {
      "FIELD2": "Nhâm Tý",
      "FIELD3": "Sơn Thượng Chi Thử – Chuột trên núi",
      "FIELD4": "Tang Đố Mộc",
      "FIELD5": "Gỗ cây dâu",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Khôn Thổ"
   },
   "1973": {
      "FIELD2": "Quý Sửu",
      "FIELD3": "Lan Ngoại Chi Ngưu – Trâu ngoài chuồng",
      "FIELD4": "Tang Đố Mộc",
      "FIELD5": "Gỗ cây dâu",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1974": {
      "FIELD2": "Giáp Dần",
      "FIELD3": "Lập Định Chi Hổ – Hổ tự lập",
      "FIELD4": "Đại Khe Thủy",
      "FIELD5": "Nước khe lớn",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1975": {
      "FIELD2": "Ất Mão",
      "FIELD3": "Đắc Đạo Chi Thố – Thỏ đắc đạo",
      "FIELD4": "Đại Khe Thủy",
      "FIELD5": "Nước khe lớn",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1976": {
      "FIELD2": "Bính Thìn",
      "FIELD3": "Thiên Thượng Chi Long – Rồng trên trời",
      "FIELD4": "Sa Trung Thổ",
      "FIELD5": "Đất pha cát",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1977": {
      "FIELD2": "Đinh Tỵ",
      "FIELD3": "Đầm Nội Chi Xà – Rắn trong đầm",
      "FIELD4": "Sa Trung Thổ",
      "FIELD5": "Đất pha cát",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1978": {
      "FIELD2": "Mậu Ngọ",
      "FIELD3": "Cứu Nội Chi Mã – Ngựa trong chuồng",
      "FIELD4": "Thiên Thượng Hỏa",
      "FIELD5": "Lửa trên trời",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1979": {
      "FIELD2": "Kỷ Mùi",
      "FIELD3": "Thảo Dã Chi Dương – Dê đồng cỏ",
      "FIELD4": "Thiên Thượng Hỏa",
      "FIELD5": "Lửa trên trời",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1980": {
      "FIELD2": "Canh Thân",
      "FIELD3": "Thực Quả Chi Hầu – Khỉ ăn hoa quả",
      "FIELD4": "Thạch Lựu Mộc",
      "FIELD5": "Gỗ cây lựu đá",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1981": {
      "FIELD2": "Tân Dậu",
      "FIELD3": "Long Tàng Chi Kê – Gà trong lồng",
      "FIELD4": "Thạch Lựu Mộc",
      "FIELD5": "Gỗ cây lựu đá",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Khôn Thổ"
   },
   "1982": {
      "FIELD2": "Nhâm Tuất",
      "FIELD3": "Cố Gia Chi Khuyển – Chó về nhà",
      "FIELD4": "Đại Hải Thủy",
      "FIELD5": "Nước biển lớn",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1983": {
      "FIELD2": "Quý Hợi",
      "FIELD3": "Lâm Hạ Chi Trư – Lợn trong rừng",
      "FIELD4": "Đại Hải Thủy",
      "FIELD5": "Nước biển lớn",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1984": {
      "FIELD2": "Giáp Tý",
      "FIELD3": "Ốc Thượng Chi Thử – Chuột ở nóc nhà",
      "FIELD4": "Hải Trung Kim",
      "FIELD5": "Vàng trong biển",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1985": {
      "FIELD2": "Ất Sửu",
      "FIELD3": "Hải Nội Chi Ngưu – Trâu trong biển",
      "FIELD4": "Hải Trung Kim",
      "FIELD5": "Vàng trong biển",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1986": {
      "FIELD2": "Bính Dần",
      "FIELD3": "Sơn Lâm Chi Hổ – Hổ trong rừng",
      "FIELD4": "Lư Trung Hỏa",
      "FIELD5": "Lửa trong lò",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1987": {
      "FIELD2": "Đinh Mão",
      "FIELD3": "Vọng Nguyệt Chi Thố – Thỏ ngắm trăng",
      "FIELD4": "Lư Trung Hỏa",
      "FIELD5": "Lửa trong lò",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1988": {
      "FIELD2": "Mậu Thìn",
      "FIELD3": "Thanh Ôn Chi Long – Rồng trong sạch, ôn hoà",
      "FIELD4": "Đại Lâm Mộc",
      "FIELD5": "Gỗ rừng già",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1989": {
      "FIELD2": "Kỷ Tỵ",
      "FIELD3": "Phúc Khí Chi Xà – Rắn có phúc",
      "FIELD4": "Đại Lâm Mộc",
      "FIELD5": "Gỗ rừng già",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1990": {
      "FIELD2": "Canh Ngọ",
      "FIELD3": "Thất Lý Chi Mã – Ngựa trong nhà",
      "FIELD4": "Lộ Bàng Thổ",
      "FIELD5": "Đất đường đi",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Cấn Thổ"
   },
   "1991": {
      "FIELD2": "Tân Mùi",
      "FIELD3": "Đắc Lộc Chi Dương – Dê có lộc",
      "FIELD4": "Lộ Bàng Thổ",
      "FIELD5": "Đất đường đi",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "1992": {
      "FIELD2": "Nhâm Thân",
      "FIELD3": "Thanh Tú Chi Hầu – Khỉ thanh tú",
      "FIELD4": "Kiếm Phong Kim",
      "FIELD5": "Vàng mũi kiếm",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "1993": {
      "FIELD2": "Quý Dậu",
      "FIELD3": "Lâu Túc Kê – Gà nhà gác",
      "FIELD4": "Kiếm Phong Kim",
      "FIELD5": "Vàng mũi kiếm",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "1994": {
      "FIELD2": "Giáp Tuất",
      "FIELD3": "Thủ Thân Chi Cẩu – Chó giữ mình",
      "FIELD4": "Sơn Đầu Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "1995": {
      "FIELD2": "Ất Hợi",
      "FIELD3": "Quá Vãng Chi Trư – Lợn hay đi",
      "FIELD4": "Sơn Đầu Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "1996": {
      "FIELD2": "Bính Tý",
      "FIELD3": "Điền Nội Chi Thử – Chuột trong ruộng",
      "FIELD4": "Giảm Hạ Thủy",
      "FIELD5": "Nước cuối nguồn",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "1997": {
      "FIELD2": "Đinh Sửu",
      "FIELD3": "Hồ Nội Chi Ngưu – Trâu trong hồ nước",
      "FIELD4": "Giảm Hạ Thủy",
      "FIELD5": "Nước cuối nguồn",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "1998": {
      "FIELD2": "Mậu Dần",
      "FIELD3": "Quá Sơn Chi Hổ – Hổ qua rừng",
      "FIELD4": "Thành Đầu Thổ",
      "FIELD5": "Đất trên thành",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "1999": {
      "FIELD2": "Kỷ Mão",
      "FIELD3": "Sơn Lâm Chi Thố – Thỏ ở rừng",
      "FIELD4": "Thành Đầu Thổ",
      "FIELD5": "Đất trên thành",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Cấn Thổ"
   },
   "2000": {
      "FIELD2": "Canh Thìn",
      "FIELD3": "Thứ Tính Chi Long – Rồng khoan dung",
      "FIELD4": "Bạch Lạp Kim",
      "FIELD5": "Vàng chân đèn",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "2001": {
      "FIELD2": "Tân Tỵ",
      "FIELD3": "Đông Tàng Chi Xà – Rắn ngủ đông",
      "FIELD4": "Bạch Lạp Kim",
      "FIELD5": "Vàng chân đèn",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "2002": {
      "FIELD2": "Nhâm Ngọ",
      "FIELD3": "Quân Trung Chi Mã – Ngựa chiến",
      "FIELD4": "Dương Liễu Mộc",
      "FIELD5": "Gỗ cây dương",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "2003": {
      "FIELD2": "Quý Mùi",
      "FIELD3": "Quần Nội Chi Dương – Dê trong đàn",
      "FIELD4": "Dương Liễu Mộc",
      "FIELD5": "Gỗ cây dương",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "2004": {
      "FIELD2": "Giáp Thân",
      "FIELD3": "Quá Thụ Chi Hầu – Khỉ leo cây",
      "FIELD4": "Tuyền Trung Thủy",
      "FIELD5": "Nước trong suối",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "2005": {
      "FIELD2": "Ất Dậu",
      "FIELD3": "Xướng Ngọ Chi Kê – Gà gáy trưa",
      "FIELD4": "Tuyền Trung Thủy",
      "FIELD5": "Nước trong suối",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "2006": {
      "FIELD2": "Bính Tuất",
      "FIELD3": "Tự Miên Chi Cẩu – Chó đang ngủ",
      "FIELD4": "Ốc Thượng Thổ",
      "FIELD5": "Đất nóc nhà",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "2007": {
      "FIELD2": "Đinh Hợi",
      "FIELD3": "Quá Sơn Chi Trư – Lợn qua núi",
      "FIELD4": "Ốc Thượng Thổ",
      "FIELD5": "Đất nóc nhà",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "2008": {
      "FIELD2": "Mậu Tý",
      "FIELD3": "Thương Nội Chi Thư – Chuột trong kho",
      "FIELD4": "Thích Lịch Hỏa",
      "FIELD5": "Lửa sấm sét",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Cấn Thổ"
   },
   "2009": {
      "FIELD2": "Kỷ Sửu",
      "FIELD3": "Lâm Nội Chi Ngưu – Trâu trong chuồng",
      "FIELD4": "Thích Lịch Hỏa",
      "FIELD5": "Lửa sấm sét",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Kim"
   },
   "2010": {
      "FIELD2": "Canh Dần",
      "FIELD3": "Xuất Sơn Chi Hổ – Hổ xuống núi",
      "FIELD4": "Tùng Bách Mộc",
      "FIELD5": "Gỗ tùng bách",
      "FIELD6": "Cấn Thổ",
      "FIELD7": "Đoài Kim"
   },
   "2011": {
      "FIELD2": "Tân Mão",
      "FIELD3": "Ẩn Huyệt Chi Thố – Thỏ",
      "FIELD4": "Tùng Bách Mộc",
      "FIELD5": "Gỗ tùng bách",
      "FIELD6": "Đoài Kim",
      "FIELD7": "Cấn Thổ"
   },
   "2012": {
      "FIELD2": "Nhâm Thìn",
      "FIELD3": "Hành Vũ Chi Long – Rồng phun mưa",
      "FIELD4": "Trường Lưu Thủy",
      "FIELD5": "Nước chảy mạnh",
      "FIELD6": "Càn Kim",
      "FIELD7": "Ly Hoả"
   },
   "2013": {
      "FIELD2": "Quý Tỵ",
      "FIELD3": "Thảo Trung Chi Xà – Rắn trong cỏ",
      "FIELD4": "Trường Lưu Thủy",
      "FIELD5": "Nước chảy mạnh",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Khảm Thuỷ"
   },
   "2014": {
      "FIELD2": "Giáp Ngọ",
      "FIELD3": "Vân Trung Chi Mã – Ngựa trong mây",
      "FIELD4": "Sa Trung Kim",
      "FIELD5": "Vàng trong cát",
      "FIELD6": "Tốn Mộc",
      "FIELD7": "Khôn Thổ"
   },
   "2015": {
      "FIELD2": "Ất Mùi",
      "FIELD3": "Kính Trọng Chi Dương – Dê được quý mến",
      "FIELD4": "Sa Trung Kim",
      "FIELD5": "Vàng trong cát",
      "FIELD6": "Chấn Mộc",
      "FIELD7": "Chấn Mộc"
   },
   "2016": {
      "FIELD2": "Bính Thân",
      "FIELD3": "Sơn Thượng Chi Hầu – Khỉ trên núi",
      "FIELD4": "Sơn Hạ Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Khôn Thổ",
      "FIELD7": "Tốn Mộc"
   },
   "2017": {
      "FIELD2": "Đinh Dậu",
      "FIELD3": "Độc Lập Chi Kê – Gà độc thân",
      "FIELD4": "Sơn Hạ Hỏa",
      "FIELD5": "Lửa trên núi",
      "FIELD6": "Khảm Thuỷ",
      "FIELD7": "Cấn Thổ"
   },
   "2018": {
      "FIELD2": "Mậu Tuất",
      "FIELD3": "Tiến Sơn Chi Cẩu – Chó vào núi",
      "FIELD4": "Bình Địa Mộc",
      "FIELD5": "Gỗ đồng bằng",
      "FIELD6": "Ly Hoả",
      "FIELD7": "Càn Ki"
   },
   "Năm": {
      "FIELD2": "Năm âm lịch",
      "FIELD3": "Giải nghĩa",
      "FIELD4": "Ngũ hành",
      "FIELD5": "Giải nghĩa",
      "FIELD6": "Cung mệnh nam",
      "FIELD7": "Cung mệnh nữ"
   }
}';

        $array = json_decode($data, true);


        $cungphi = $array[$namsinh];


        $re = ['namamlich' => $cungphi['FIELD2'], 'giainghia' => $cungphi['FIELD3'],
            'nguhanh' => $cungphi['FIELD4'], 'giainghia2' => $cungphi['FIELD5'],
            'cungmenhnam' => $cungphi['FIELD6'], 'cungmenhnu' => $cungphi['FIELD7']];


        return $re;
    }

    function thuongquehaque($sosim)
    {
        $db = new db;
        $sosim = (string )$sosim;


        $sumthuong = 0;
        $sumha = 0;

        if (strlen($sosim) == 10) {


            $thuong = (string )substr($sosim, 0, 5);

            $ha = (string )substr($sosim, -5, 5);


            for ($i = 0; $i < strlen($thuong); $i++) {
                $sumthuong += $thuong[$i];
            }


            for ($i = 0; $i < strlen($ha); $i++) {
                $sumha += $ha[$i];
            }

        } else {
            $thuong = (string )substr($sosim, 0, 5);

            $ha = (string )substr($sosim, -6, 6);

            for ($i = 0; $i < strlen($thuong); $i++) {
                $sumthuong += $thuong[$i];
            }


            for ($i = 0; $i < strlen($ha); $i++) {
                $sumha += $ha[$i];
            }

        }


        if ($sumthuong > 8)
            $thuongque = $sumthuong % 8;

        if ($sumha > 8)
            $haque = $sumha % 8;


        if (!isset($thuongque))
            $thuongque = $sumthuong;
        if (!isset($haque))
            $haque = $sumha;


        if ($thuongque == 0)
            $thuongque = 8;
        if ($haque == 0)
            $haque = 8;


        $data = '[
 {
   "FIELD1": "",
   "FIELD2": "Càn (1)",
   "FIELD3": "Đoài (2)",
   "FIELD4": "Ly (3)",
   "FIELD5": "Chấn (4)",
   "FIELD6": "Tốn (5)",
   "FIELD7": "Khảm (6)",
   "FIELD8": "Cấn (7)",
   "FIELD9": "Khôn (8)"
 },
 {
   "FIELD1": "Càn (1)",
   "FIELD2": "Quẻ số 1 - Thuần Càn",
   "FIELD3": "Quẻ số 43 - Trạch Thiên Quải",
   "FIELD4": "Quẻ số 14 - Hỏa Thiên Đại Hữu",
   "FIELD5": "Quẻ số 34 - Lôi Thiên Đại Tráng",
   "FIELD6": "Quẻ số 9 - Phong Thiên Tiểu Súc",
   "FIELD7": "Quẻ số 5 - Thủy Thiên Nhu",
   "FIELD8": "Quẻ số 26 - Sơn Thiên Đại Súc",
   "FIELD9": "Quẻ số 11 - Địa Thiên Thái"
 },
 {
   "FIELD1": "Đoài (2)",
   "FIELD2": "Quẻ số 10 - Thiên Trạch Lý",
   "FIELD3": "Quẻ số 58 - Thuần Đoài",
   "FIELD4": "Quẻ số 38 - Hỏa Trạch Khuê",
   "FIELD5": "Quẻ số 54 - Lôi Trạch Quy Muội",
   "FIELD6": "Quẻ số 61 - Phong Trạch Trung Phù",
   "FIELD7": "Quẻ số 60 - Thủy Trạch Tiết",
   "FIELD8": "Quẻ số 41 - Sơn Trạch Tổn",
   "FIELD9": "Quẻ số 19 - Địa Trạch Lâm"
 },
 {
   "FIELD1": "Ly (3)",
   "FIELD2": "Quẻ số 13 - Thiên Hỏa Đồng Nhân",
   "FIELD3": "Quẻ số 49 - Trạch Hỏa Cách",
   "FIELD4": "Quẻ số 30 - Thuần Ly",
   "FIELD5": "Quẻ số 55 - Lôi Hỏa Phong",
   "FIELD6": "Quẻ số 37 - Phong Hỏa Gia Nhân",
   "FIELD7": "Quẻ số 63 - Thủy Hỏa Ký Tế",
   "FIELD8": "Quẻ số 22 - Sơn Hỏa Bí",
   "FIELD9": "Quẻ số 36 - Địa Hỏa Minh Di"
 },
 {
   "FIELD1": "Chấn (4)",
   "FIELD2": "Quẻ số 25 - Thiên Lôi Vô Vọng",
   "FIELD3": "Quẻ số 17 - Trạch Lôi Tùy",
   "FIELD4": "Quẻ số 21 - Hỏa Lôi Phệ Hạp",
   "FIELD5": "Quẻ số 51 - Thuần Chấn",
   "FIELD6": "Quẻ số 42 - Phong Lôi Ích",
   "FIELD7": "Quẻ số 3 - Thủy Lôi Truân",
   "FIELD8": "Quẻ số 27 - Sơn Lôi Di",
   "FIELD9": "Quẻ số 24 - Địa Lôi Phục"
 },
 {
   "FIELD1": "Tốn (5)",
   "FIELD2": "Quẻ số 44 - Thiên Phong Cấu",
   "FIELD3": "Quẻ số 28 - Trạch Phong Đại Quá",
   "FIELD4": "Quẻ số 50 - Hỏa Phong Đỉnh",
   "FIELD5": "Quẻ số 32 - Lôi Phong Hằng",
   "FIELD6": "Quẻ số 57 - Thuần Tốn",
   "FIELD7": "Quẻ số 48 - Thủy Phong Tỉnh",
   "FIELD8": "Quẻ số 18 - Sơn Phong Cổ",
   "FIELD9": "Quẻ số 46 - Địa Phong Thăng"
 },
 {
   "FIELD1": "Khảm (6)",
   "FIELD2": "Quẻ số 6 - Thiên Thủy Tụng",
   "FIELD3": "Quẻ số 47 - Trạch Thủy Khốn",
   "FIELD4": "Quẻ số 64 - Hỏa Thủy Vị Tế",
   "FIELD5": "Quẻ số 40 - Lôi Thủy Giải",
   "FIELD6": "Quẻ số 59 - Phong Thủy Hoán",
   "FIELD7": "Quẻ số 29 - Thuần Khảm",
   "FIELD8": "Quẻ số 4 - Sơn Thủy Mông",
   "FIELD9": "Quẻ số 7 - Địa Thủy Sư"
 },
 {
   "FIELD1": "Cấn (7)",
   "FIELD2": "Quẻ số 33 - Thiên Sơn Độn",
   "FIELD3": "Quẻ số 31 - Trạch Sơn Hàm",
   "FIELD4": "Quẻ số 56 - Hỏa Sơn Lữ",
   "FIELD5": "Quẻ số 62 - Lôi Sơn Tiểu Quá",
   "FIELD6": "Quẻ số 53 - Phong Sơn Tiệm",
   "FIELD7": "Quẻ số 39 - Thủy Sơn Kiển",
   "FIELD8": "Quẻ số 52 - Thuần Cấn",
   "FIELD9": "Quẻ số 15 - Địa Sơn Khiêm"
 },
 {
   "FIELD1": "Khôn (8)",
   "FIELD2": "Quẻ số 12 - Thiên Địa Bĩ",
   "FIELD3": "Quẻ số 45 - Trạch Địa Tụy",
   "FIELD4": "Quẻ số 35 - Hỏa Địa Tấn",
   "FIELD5": "Quẻ số 16 - Lôi Địa Dự",
   "FIELD6": "Quẻ số 20 - Phong Địa Quán",
   "FIELD7": "Quẻ số 8 - Thủy Địa Tỷ",
   "FIELD8": "Quẻ số 23 - Sơn Địa Bác",
   "FIELD9": "Quẻ số 2 - Thuần Khôn"
 }
]';

        $jsonarray = json_decode($data, true);


        $que = $jsonarray[$haque]['FIELD' . ($thuongque + 1) . ''];


        $que = explode('-', $que);

        $queso = (int)preg_replace('/[^0-9]/', '', $que[0]);

        $queten = trim($que[1]);


        $result = $db->getOne("select * from quekinhdich where queso=" . $queso);


        $ynghia = $result['quedich'];


        return ['thuongque' => $thuongque, 'haque' => $haque, 'queso' => $queso,
            'queten' => $queten, 'ynghia' => $ynghia];


    }

    function quecat($sosim)
    {
        $tinh = substr($sosim, -4, 4);

        $tinh = $tinh / 80;
        $tinh2 = explode('.', $tinh);
        $tinh = $tinh - $tinh2[0];


        $tinh = $tinh * 80;


        $data = '{
   "10": {
      "FIELD2": "Tâm sức làm không, không được đến bờ",
      "FIELD3": "Hung"
   },
   "11": {
      "FIELD2": "Vững đi từng bước, được người trọng vọng",
      "FIELD3": "Cát"
   },
   "12": {
      "FIELD2": "Gầy gò yếu đuối, mọi việc khó thành",
      "FIELD3": "Hung"
   },
   "13": {
      "FIELD2": "Trời cho cát vận, được người kính trọng",
      "FIELD3": "Đại cát"
   },
   "14": {
      "FIELD2": "Nữa được nữa bại, dựa vào nghị lực",
      "FIELD3": "Bình"
   },
   "15": {
      "FIELD2": "Đại sự thành tựu, nhất định hưng vượng",
      "FIELD3": "Cát"
   },
   "16": {
      "FIELD2": "Thành tựu to lớn, tên tuổi lừng danh",
      "FIELD3": "Đại cát"
   },
   "17": {
      "FIELD2": "Quý nhân trợ giúp, sẽ đạt thành công",
      "FIELD3": "Cát"
   },
   "18": {
      "FIELD2": "Thuận lợi xương thịnh, trăm việc trôi trải",
      "FIELD3": "Đại cát"
   },
   "19": {
      "FIELD2": "Nội ngoại bất hoà, khó khăn muôn phần",
      "FIELD3": "Hung"
   },
   "20": {
      "FIELD2": "Vượt mọi gian nan, lo xa nghĩ hoài",
      "FIELD3": "Đại hung (quá xấu)"
   },
   "21": {
      "FIELD2": "Chuyên tâm kinh doanh, hay dùng trí tuệ",
      "FIELD3": "Cát"
   },
   "22": {
      "FIELD2": "Có tài không làm, việc không gặp may",
      "FIELD3": "Hung"
   },
   "23": {
      "FIELD2": "Tên tuổi bốn phương, sẽ thành đạt nghiệp",
      "FIELD3": "Đại cát"
   },
   "24": {
      "FIELD2": "Phải dựa tự lập, sẽ thành đại nghiệp",
      "FIELD3": "Đại cát"
   },
   "25": {
      "FIELD2": "Thiên thời địa lợi, vì được nhân cách",
      "FIELD3": "Đại cát"
   },
   "26": {
      "FIELD2": "Bão táp phong ba, qua mọi nguy hiểm",
      "FIELD3": "Hung"
   },
   "27": {
      "FIELD2": "Lúc thắng lúc thua, giữ được thành công",
      "FIELD3": "Cát"
   },
   "28": {
      "FIELD2": "Tiến mãi không lùi, trí tuệ được dùng",
      "FIELD3": "Đại cát"
   },
   "29": {
      "FIELD2": "Cát hung chia đôi, được chia mỗi nữa",
      "FIELD3": "Hung"
   },
   "30": {
      "FIELD2": "Danh lợi được mùa, đại sự thành công",
      "FIELD3": "Đại cát"
   },
   "31": {
      "FIELD2": "Con rồng trong nước, thành công sẽ đến",
      "FIELD3": "Đại cát"
   },
   "32": {
      "FIELD2": "Dùng chí lâu dài, sẽ được xương thịnh",
      "FIELD3": "Cát"
   },
   "33": {
      "FIELD2": "Rủi ro không ngừng, khó có thành công",
      "FIELD3": "Hung"
   },
   "34": {
      "FIELD2": "Số phận trung cát, tiến lùi bảo thủ",
      "FIELD3": "Bình"
   },
   "35": {
      "FIELD2": "Trôi nổi bập bùng, thường hay gặp nạn",
      "FIELD3": "Hung"
   },
   "36": {
      "FIELD2": "Tránh được điềm ác, thuận buồm xuôi gió",
      "FIELD3": "Cát"
   },
   "37": {
      "FIELD2": "Danh thì được tiếng, lợi thì bằng không",
      "FIELD3": "Bình"
   },
   "38": {
      "FIELD2": "Đường rộng thênh thang, nhìn thấy tương lai",
      "FIELD3": "Đại cát"
   },
   "39": {
      "FIELD2": "Lúc thịnh lúc suy, chìm nổi vô định",
      "FIELD3": "Bình"
   },
   "40": {
      "FIELD2": "Thiên ý cát vận, tiền đồ sáng sủa",
      "FIELD3": "Đại cát"
   },
   "41": {
      "FIELD2": "Sự nghiệp không chuyên, hầu như không thành",
      "FIELD3": "Hung"
   },
   "42": {
      "FIELD2": "Nhẫn nhịn chịu đựng, xấu cũng thành tốt",
      "FIELD3": "Cát"
   },
   "43": {
      "FIELD2": "Cây xanh trổ lá, đột nhiên thành công",
      "FIELD3": "Cát"
   },
   "44": {
      "FIELD2": "Ngược với ý mình, tham công lỡ việc",
      "FIELD3": "Hung"
   },
   "45": {
      "FIELD2": "Quanh co khúc khỉu, khó khăn kéo dài",
      "FIELD3": "Hung"
   },
   "46": {
      "FIELD2": "Quý nhân giúp trợ, thành công đại sự",
      "FIELD3": "Đại cát"
   },
   "47": {
      "FIELD2": "Danh lợi đều có, thành công đại sự",
      "FIELD3": "Đại cát"
   },
   "48": {
      "FIELD2": "Gặp cát được cát, gặp hung thì hung",
      "FIELD3": "Bình"
   },
   "49": {
      "FIELD2": "Hung cát cùng có, một thành một bại",
      "FIELD3": "Bình"
   },
   "50": {
      "FIELD2": "Một thịnh một suy, bồng bền sóng gió",
      "FIELD3": "Bình"
   },
   "51": {
      "FIELD2": "Trời quang mây tạnh, đạt được thành công",
      "FIELD3": "Cát"
   },
   "52": {
      "FIELD2": "Xương thịnh nửa số, cát trước hung sao",
      "FIELD3": "Hung"
   },
   "53": {
      "FIELD2": "Nỗ lực hết mình, thành công ít ỏi",
      "FIELD3": "Bình"
   },
   "54": {
      "FIELD2": "Bề ngoài tươi sáng, án hoạn sẽ tới",
      "FIELD3": "Hung"
   },
   "55": {
      "FIELD2": "Ngược lại ý mình, khó được thành công",
      "FIELD3": "Đại hung"
   },
   "56": {
      "FIELD2": "Nỗ lực phấn đấu, phận tốt quay về",
      "FIELD3": "Cát"
   },
   "57": {
      "FIELD2": "Bấp bên nhiều chuyện, hung trước cát sau",
      "FIELD3": "Bình"
   },
   "58": {
      "FIELD2": "Gặp việc do dự, khó có thành công",
      "FIELD3": "Hung"
   },
   "59": {
      "FIELD2": "Mơ mơ hồ hồ, khó định phương hướng",
      "FIELD3": "Bình"
   },
   "60": {
      "FIELD2": "Mây che nửa trăng, dấu hiệu phong ba",
      "FIELD3": "Hung"
   },
   "61": {
      "FIELD2": "Lo nghĩ nhiều điều, mọi việc không thành",
      "FIELD3": "Hung"
   },
   "62": {
      "FIELD2": "Biết hướng nỗ lực, con đường phồn vinh",
      "FIELD3": "Cát"
   },
   "63": {
      "FIELD2": "Mười việc chín không, mất công mất sức",
      "FIELD3": "Hung"
   },
   "64": {
      "FIELD2": "Cát vận tự đến, có được thành công",
      "FIELD3": "Cát"
   },
   "65": {
      "FIELD2": "Nội ngoại bất hoà, thiếu thốn tín nhiệm",
      "FIELD3": "Bình"
   },
   "66": {
      "FIELD2": "Mọi việc như ý , phú quý tự đến",
      "FIELD3": "Đại cát"
   },
   "67": {
      "FIELD2": "Nắm vững thời cơ , thành công sẽ đến",
      "FIELD3": "Cát"
   },
   "68": {
      "FIELD2": "Lo trước nghĩ sau, thường hay gặp nạn",
      "FIELD3": "Hung"
   },
   "69": {
      "FIELD2": "Bấp bênh kinh doanh, khó tránh vất vả",
      "FIELD3": "Hung"
   },
   "70": {
      "FIELD2": "Cát hung đều có, chỉ dựa chí khí",
      "FIELD3": "Bình"
   },
   "71": {
      "FIELD2": "Được rồi lại mất, khó có bình yên",
      "FIELD3": "Hung"
   },
   "72": {
      "FIELD2": "An lạc tự đến, tự nhiên cát tường",
      "FIELD3": "Cát"
   },
   "73": {
      "FIELD2": "Như là vô mưu, khó được thành đạt",
      "FIELD3": "Bình"
   },
   "74": {
      "FIELD2": "Trong lành có hung, tiến không bằng giữ",
      "FIELD3": "Bình"
   },
   "75": {
      "FIELD2": "Nhiều điều đại hung, hiện tượng phá sản",
      "FIELD3": "Đại hung"
   },
   "76": {
      "FIELD2": "Khổ trước sướng sau, không bị thất bại",
      "FIELD3": "Cát"
   },
   "77": {
      "FIELD2": "Nửa được nửa mất, sang mà không thực",
      "FIELD3": "Bình"
   },
   "78": {
      "FIELD2": "Tiền đồ tươi sáng, tràn đầy hy vọng",
      "FIELD3": "Đại cát"
   },
   "79": {
      "FIELD2": "Được rồi lại mất, lo cũng bằng không",
      "FIELD3": "Hung"
   },
   "80": {
      "FIELD2": "Số phận cao nhất sẽ được thành công",
      "FIELD3": "Đại cát"
   },
   "Kết quả": {
      "FIELD2": "Ý nghĩa chung",
      "FIELD3": "Mức độ tốt – xấu"
   },
   "01": {
      "FIELD2": "Đại triển hồng đồ, khả được thành công",
      "FIELD3": "Cát (tốt)"
   },
   "02": {
      "FIELD2": "Thăng trầm không số, về già vô công",
      "FIELD3": "Bình (bình thường)"
   },
   "03": {
      "FIELD2": "Ngày ngày tiến tới, mọi vạn sự thuận toàn",
      "FIELD3": "Đại cát (Đại tốt)"
   },
   "04": {
      "FIELD2": "Tiền đồ gai gốc, đau khổ theo đuổi",
      "FIELD3": "Hung (xấu)"
   },
   "05": {
      "FIELD2": "Làm ăn phát đạt, danh lợi đều có",
      "FIELD3": "Đại cát"
   },
   "06": {
      "FIELD2": "Trời cho số phận, có thể thành công",
      "FIELD3": "Cát"
   },
   "07": {
      "FIELD2": "Ôn hoà êm dịu, nhất phải thành công",
      "FIELD3": "Cát"
   },
   "08": {
      "FIELD2": "Qua đoạn gian nan, có ngày thành công",
      "FIELD3": "Cát"
   },
   "09": {
      "FIELD2": "Tự làm vô sức, thất bại khó lường",
      "FIELD3": "Hung"
   }
}';

        $array = json_decode($data, true);


        $que = $array[$tinh];


        return ['queso' => $tinh, 'ynghia' => $que['FIELD2'], 'mucdo' => $que['FIELD3']];


    }

    function tomin($namsinh)
    {

        $namsinh = (string )$namsinh;

        $sum = 0;

        for ($i = 0; $i < strlen($namsinh); $i++) {
            $sum += $namsinh[$i];
        }

        if ($sum > 9) {
            $sum = tomin($sum);
        }
        return $sum;
    }

    function cungphi($namsinham)
    {


        global $db;


        $result = $db->query(sprintf("select * from tb_cungphi WHERE namsinh ='%s' limit 1",
            $namsinham));

        return $result->fetch(PDO::FETCH_ASSOC);


    }

    function nguhangtuongsinh($nguhan1, $nguhanh2)
    {
        $nguhan1 = (string )($nguhan1);

        $nguhanh2 = (string )($nguhanh2);

        $nguhanh['Kim']['Thủy'] = "Tương Sinh";
        $nguhanh['Thủy']['Mộc'] = "Tương Sinh";
        $nguhanh['Mộc']['Hỏa'] = "Tương Sinh";
        $nguhanh['Hỏa']['Thổ'] = "Tương Sinh";
        $nguhanh['Thổ']['Kim'] = "Tương Sinh";

        $nguhanh['Kim']['Mộc'] = "Tương Khắc";
        $nguhanh['Mộc']['Thổ'] = "Tương Khắc";
        $nguhanh['Thổ']['Thủy'] = "Tương Khắc";
        $nguhanh['Thủy']['Hỏa'] = "Tương Khắc";
        $nguhanh['Hỏa']['Kim'] = "Tương Khắc";

        if (isset($nguhanh[$nguhan1][$nguhanh2]))
            return $nguhanh[$nguhan1][$nguhanh2];
        else
            return "Bình Hòa";
    }

    function namtocanchi($namsinh)
    {
        $can = array(
            "Giáp",
            "Ất",
            "Bính",
            "Đinh",
            "Mậu",
            "Kỷ",
            "Canh",
            "Tân",
            "Nhâm",
            "Quý");
        $chi = array(
            "Tí",
            "Sửu",
            "Dần",
            "Mão",
            "Thìn",
            "Tỵ",
            "Ngọ",
            "Mùi",
            "Thân",
            "Dậu",
            "Tuất",
            "Hợi");
        $sodu_can = ($namsinh + 6) % 10;
        $sodu_chi = ($namsinh + 8) % 12;


        $can = $can[$sodu_can];
        $chi = $chi[$sodu_chi];

        $canchi = $can . " " . $chi;


        if (($can == "Giáp" || $can == "Ất") && ($chi == "Tý" || $chi == "Sửu")) {

            $menhnien = "Hải Trung Kim (Vàng trong biển), thuộc hành KIM";

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Giáp" || $can == "Ất") && ($chi == "Dần" || $chi == "Mão")) {

            $menhnien = "Đại khe thủy (Nước khe lớn), thuộc hành THỦY";

            $hanhcuamenhnien = "Thủy";

        }

        if (($can == "Giáp" || $can == "Ất") && ($chi == "Thìn" || $chi == "Tị" || $chi ==
                "Tỵ")) {

            $menhnien = "Phú Đăng Hỏa (Lửa đèn to), thuộc hành HỎA";

            $hanhcuamenhnien = "Hỏa";

        }

        if (($can == "Giáp" || $can == "Ất") && ($chi == "Ngọ" || $chi == "Mùi")) {

            $menhnien = "Sa trung Kim (Vàng trong cát), thuộc hành KIM";

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Giáp" || $can == "Ất") && ($chi == "Thân" || $chi == "Dậu")) {

            $menhnien = "Tuyền trung Thủy (Nước trong suối), thuộc hành THỦY";

            $hanhcuamenhnien = "Thủy";

        }

        if (($can == "Giáp" || $can == "Ất") && ($chi == "Tuất" || $chi == "Hợi")) {

            $menhnien = "Sơn đầu hỏa (Lửa trên núi), thuộc hành HỎA";

            $hanhcuamenhnien = "Hỏa";

        }

        if (($can == "Bính" || $can == "Đinh") && ($chi == "Tý" || $chi == "Sửu")) {

            $menhnien = "Giản hạ Thủy (Nước khe suối), thuộc hành THỦY"; //

            $hanhcuamenhnien = "Thủy";

        }

        if (($can == "Bính" || $can == "Đinh") && ($chi == "Dần" || $chi == "Mão")) {

            $menhnien = "Lư trung Hỏa (Lửa trong lò), thuộc hành HỎA"; //

            $hanhcuamenhnien = "Hỏa";

        }

        if (($can == "Bính" || $can == "Đinh") && ($chi == "Thìn" || $chi == "Tị" || $chi ==
                "Tỵ")) {

            $menhnien = "Sa trung Thổ (Đất pha Cát), thuộc hành THỔ"; //

            $hanhcuamenhnien = "Thổ";

        }

        if (($can == "Bính" || $can == "Đinh") && ($chi == "Ngọ" || $chi == "Mùi")) {

            $menhnien = "Thiên hà Thủy (Nước trên trời), thuộc hành THỦY"; //

            $hanhcuamenhnien = "Thủy";

        }

        if (($can == "Bính" || $can == "Đinh") && ($chi == "Thân" || $chi == "Dậu")) {

            $menhnien = "Sơn hạ Hỏa (Lửa trên núi), thuộc hành HỎA"; //

            $hanhcuamenhnien = "Hỏa";

        }

        if (($can == "Bính" || $can == "Đinh") && ($chi == "Tuất" || $chi == "Hợi")) {

            $menhnien = "Ốc Thượng Thổ (Đất nóc nhà), thuộc hành THỔ";

            $hanhcuamenhnien = "Thổ";

        }

        if (($can == "Mậu" || $can == "Kỷ") && ($chi == "Tý" || $chi == "Sửu")) {

            $menhnien = "Thích lịch Hỏa Lửa sấm sét), thuộc hành HỎA";

            $hanhcuamenhnien = "Hỏa";

        }

        if (($can == "Mậu" || $can == "Kỷ") && ($chi == "Dần" || $chi == "Mão")) {

            $menhnien = "Thành đầu Thổ (Đất đắp thành), thuộc hành MỘC";

            $hanhcuamenhnien = "Mộc";

        }

        if (($can == "Mậu" || $can == "Kỷ") && ($chi == "Thìn" || $chi == "Tị" || $chi ==
                "Tỵ")) {

            $menhnien = "Đại lâm mộc (Gỗ rừng già), thuộc hành KIM";

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Mậu" || $can == "Kỷ") && ($chi == "Ngọ" || $chi == "Mùi")) {

            $menhnien = "Thiên thượng Hỏa (Lửa trên trời), thuộc hành HỎA";

            $hanhcuamenhnien = "Hỏa";

        }

        if (($can == "Mậu" || $can == "Kỷ") && ($chi == "Thân" || $chi == "Dậu")) {

            $menhnien = "Đại trạch Thổ (Đất nền nhà), thuộc hành THỔ";

            $hanhcuamenhnien = "Thổ";

        }

        if (($can == "Mậu" || $can == "Kỷ") && ($chi == "Tuất" || $chi == "Hợi")) {

            $menhnien = "Bình địa Mộc (Gỗ đồng bằng), thuộc hành KIM";

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Canh" || $can == "Tân") && ($chi == "Tý" || $chi == "Sửu")) {

            $menhnien = "Bích thượng Thổ (Đất tò vò), thuộc hành THỔ"; //

            $hanhcuamenhnien = "Thổ";

        }

        if (($can == "Canh" || $can == "Tân") && ($chi == "Dần" || $chi == "Mão")) {

            $menhnien = "Tùng bách mộc (Gỗ tùng bách), thuộc hành MỘC"; //

            $hanhcuamenhnien = "Mộc";

        }

        if (($can == "Canh" || $can == "Tân") && ($chi == "Thìn" || $chi == "Tị" || $chi ==
                "Tỵ")) {

            $menhnien = "Bạch lạp Kim (Vàng sáp ong), thuộc hành KIM"; //

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Canh" || $can == "Tân") && ($chi == "Ngọ" || $chi == "Mùi")) {

            $menhnien = "Lộ bàng Thổ (Đất bên đường), thuộc hành THỔ"; //

            $hanhcuamenhnien = "Thổ";

        }

        if (($can == "Canh" || $can == "Tân") && ($chi == "Thân" || $chi == "Dậu")) {

            $menhnien = "Thạch lựu mộc (Cây gỗ lựu), thuộc hành MỘC"; //

            $hanhcuamenhnien = "Mộc";

        }

        if (($can == "Canh" || $can == "Tân") && ($chi == "Tuất" || $chi == "Hợi")) {

            $menhnien = "Thoa Xuyến Kim (Vàng trang sức), thuộc hành KIM";

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Nhâm" || $can == "Quý") && ($chi == "Tý" || $chi == "Sửu")) {

            $menhnien = "Tang đố Mộc (Gỗ cây dâu), thuộc hành MỘC";

            $hanhcuamenhnien = "Mộc";

        }

        if (($can == "Nhâm" || $can == "Quý") && ($chi == "Dần" || $chi == "Mão")) {

            $menhnien = "TBạch Kim (Vàng pha Bạc), thuộc hành KIM";

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Nhâm" || $can == "Quý") && ($chi == "Thìn" || $chi == "Tị" || $chi ==
                "Tỵ")) {

            $menhnien = "Trường lưu Thủy (Nước chảy mạnh), thuộc hành THỦY"; //

            $hanhcuamenhnien = "Thủy";

        }

        if (($can == "Nhâm" || $can == "Quý") && ($chi == "Ngọ" || $chi == "Mùi")) {

            $menhnien = "Dương liễu mộc (Gỗ dương liễu), thuộc hành MỘC"; //

            $hanhcuamenhnien = "Mộc";

        }

        if (($can == "Nhâm" || $can == "Quý") && ($chi == "Thân" || $chi == "Dậu")) {

            $menhnien = "Kiếm phong Kim (Vàng chuôi kiếm), thuộc hành KIM"; //

            $hanhcuamenhnien = "Kim";

        }

        if (($can == "Nhâm" || $can == "Quý") && ($chi == "Tuất" || $chi == "Hợi")) {

            $menhnien = "Đại hải Thủy (Nước biển lớn), thuộc hành THỦY";

            $hanhcuamenhnien = "Thủy";
        }


        return array(
            'canchi' => $canchi,
            'menhnien' => $menhnien,
            'hanhcuamenhnien' => $hanhcuamenhnien);
    }

    public function amduongdayso($dayso)
    {
        $dayso = (string )$dayso;
        $tr1 = "";
        $tr2 = "";
        $tr = "";
        $soam = 0;
        $soduong = 0;
        $am = array(
            0,
            2,
            4,
            6,
            8);
        $duong = array(
            1,
            3,
            5,
            7,
            9);
        $strleng = strlen($dayso);
        $row = "";
        for ($i = 0; $i < $strleng; $i++) {

            if (in_array($dayso[$i], $am)) {
                $soam++;
                $tr2 .= "<td class=\"text-center\">-</td>";
            } else {
                $soduong++;

                $tr2 .= "<td class=\"text-center\">+</td>";

            }

            $tr1 .= "<td class=\"text-center\">" . $dayso[$i] . "</td>";

        }

        $tr = "<tr>" . $tr1 . "</tr>";
        $tr .= "<tr>" . $tr2 . "</tr>";
        if ($soduong > $soam)
            $menh = "Dương";
        else
            if ($soduong < $soam) {
                $menh = "Âm";
            } else
                if ($soam == $soduong) {
                    $menh = "Dương";
                }


        return array(
            'tr' => $tr,
            'menh' => $menh,
            'soduong' => $soduong,
            'soam' => $soam);
    }

    public function nguhangdayso($dayso, $kieu = 1)
    {
        $strleng = strlen($dayso);

        if ($kieu == 1)
            $hathu = array(
                0 => 'Thủy',
                1 => 'Thủy',
                2 => 'Thổ',
                3 => 'Mộc',
                4 => 'Mộc',
                5 => 'Thổ',
                6 => 'Kim',
                7 => 'Kim',
                8 => 'Thổ',
                9 => 'Hỏa');
        else
            $lacdo = array(
                0 => 'Thổ',
                1 => 'Thủy',
                2 => 'Hỏa',
                3 => 'Mộc',
                4 => 'Kim',
                5 => 'Thổ',
                6 => 'Thủy',
                7 => 'Hỏa',
                8 => 'Mộc',
                9 => 'Kim');

        $nguhanh = isset($hathu) ? $hathu : $lacdo;

        $temp = array();
        for ($i = 0; $i < $strleng; $i++) {

            if (isset($temp[$dayso[$i]])) {
                $temp[$dayso[$i]]++;
                if ($temp[$dayso[$i]] / $strleng >= 0.4)
                    return $nguhanh[$dayso[$i]];
            } else
                $temp[$dayso[$i]] = 1;

        }

        return $nguhanh[substr($dayso, -1, 1)];


    }

    public function menhnamsinh($namsinh, $menh = "Niên", $gioitinh = "Nam")
    {

        $quai[1] = array(
            'Menh' => '☵',
            'Que' => 'KHẢM',
            'Hanh' => 'THỦY');
        $quai[2] = array(
            'Menh' => '☷',
            'Que' => 'KHÔN',
            'Hanh' => 'THỔ');
        $quai[3] = array(
            'Menh' => '☳',
            'Que' => 'CHẤN',
            'Hanh' => 'MỘC');
        $quai[4] = array(
            'Menh' => '☴ ',
            'Que' => 'TỐN',
            'Hanh' => 'MỘC');
        $quai[6] = array(
            'Menh' => '☰',
            'Que' => 'CÀN',
            'Hanh' => 'KIM');
        $quai[7] = array(
            'Menh' => '☱',
            'Que' => 'ĐOÀI',
            'Hanh' => 'KIM');
        $quai[8] = array(
            'Menh' => '☶',
            'Que' => 'CẤN',
            'Hanh' => 'THỔ');
        $quai[9] = array(
            'Menh' => '☶',
            'Que' => 'LY',
            'Hanh' => 'HỎA');

        for ($i = 0; $i < strlen($namsinh); $i++) {
            $tong += $namsinh[$i];
        }

        $diem = substr($tong, 0, 1) + substr($tong, 1, 1);

        if ($gioitinh == "Nam") {
            $menhquaicham = 11 - $diem;

            if ($menhquaicham > 9)
                $menhquaicham = $menhquaicham - 9;

            if (isset($menh[$menhquaicham]))
                return $menh[$menhquaicham];
            else
                return array(
                    'Menh' => '☷',
                    'Que' => 'KHÔN',
                    'Hanh' => 'THỔ');

        } else {
            $menhquaicham = 4 + $diem;

            if ($menhquaicham > 9)
                $menhquaicham = $menhquaicham - 9;


        }


        if ($menh == 'Quái') {

            if (isset($menh[$menhquaicham]))
                return $menh[$menhquaicham];
            else
                return array(
                    'Menh' => '☶',
                    'Que' => 'CẤN',
                    'Hanh' => 'THỔ');


        } else {

            //** MENH NIÊN ***//

        }


    }
}

class sim
{

    public static function NguHanhToMau($nguhanh)
    {
        $color = [

            'Kim' => '#B9B9B9',
            'Thủy' => '#344EA3',
            'Mộc' => '#01A34D',
            'Hỏa' => '#BB2026',
            'Thổ' => '#F0AF1F'


        ];


        return "<span style=\"color:" . $color[$nguhanh] . " ;\">" . $nguhanh . "</span>";

    }

    public static function YNghiaQueSo($so)
    {
        $so = $so - 1;
        $data = array(
            0 => 'Thuần Càn (乾 qián)
',
            1 => 'Thuần Khôn (坤 kūn)
',
            2 => 'Thủy Lôi Truân (屯 chún)
',
            3 => 'Sơn Thủy Mông (蒙 méng)
',
            4 => 'Thủy Thiên Nhu (需 xū)
',
            5 => 'Thiên Thủy Tụng (訟 sòng)
',
            6 => 'Địa Thủy Sư (師 shī)
',
            7 => 'Thủy Địa Tỷ (比 bǐ)
',
            8 => 'Phong Thiên Tiểu Súc (小畜 xiǎo chù)
',
            9 => 'Thiên Trạch Lý (履 lǚ)
',
            10 => 'Địa Thiên Thái (泰 tài)
',
            11 => 'Thiên Địa Bĩ (否 pǐ)
',
            12 => 'Thiên Hỏa Đồng Nhân (同人 tóng rén)
',
            13 => 'Hỏa Thiên Đại Hữu (大有 dà yǒu)
',
            14 => 'Địa Sơn Khiêm (謙 qiān)
',
            15 => 'Lôi Địa Dự (豫 yù)
',
            16 => 'Trạch Lôi Tùy (隨 suí)
',
            17 => 'Sơn Phong Cổ (蠱 gǔ)
',
            18 => 'Địa Trạch Lâm (臨 lín)
',
            19 => 'Địa Phong Quan (觀 guān)
',
            20 => 'Hỏa Lôi Phệ Hạp (噬嗑 shì kè)
',
            21 => 'Sơn Hỏa Bí (賁 bì)
',
            22 => 'Sơn Địa Bác (剝 bō)
',
            23 => 'Địa Lôi Phục (復 fù)
',
            24 => 'Thiên Lôi Vô Vọng (無妄 wú wàng)
',
            25 => 'Sơn Thiên Đại Súc (大畜 dà chù)
',
            26 => 'Sơn Lôi Di (頤 yí)
',
            27 => 'Trạch Phong Đại Quá (大過 dà guò)
',
            28 => 'Thuần Khảm (坎 kǎn)
',
            29 => 'Thuần Ly (離 lí)
',
            30 => 'Trạch Sơn Hàm (咸 xián)
',
            31 => 'Lôi Phong Hằng (恆 héng)
',
            32 => 'Thiên Sơn Độn (遯 dùn)
',
            33 => 'Lôi Thiên Đại Tráng (大壯 dà zhuàng)
',
            34 => 'Hỏa Địa Tấn (晉 jìn)
',
            35 => 'Địa Hỏa Minh Di (明夷 míng yí)
',
            36 => 'Phong Hỏa Gia Nhân (家人 jiā rén)
',
            37 => 'Hỏa Trạch Khuê (睽 kuí)
',
            38 => 'Thủy Sơn Kiển (蹇 jiǎn)
',
            39 => 'Lôi Thủy Giải (解 xiè)
',
            40 => 'Sơn Trạch Tổn (損 sǔn)
',
            41 => 'Phong Lôi Ích (益 yì)
',
            42 => 'Trạch Thiên Quải (夬 guài)
',
            43 => 'Thiên Phong Cấu (姤 gòu)
',
            44 => 'Trạch Địa Tụy (萃 cuì)
',
            45 => 'Địa Phong Thăng (升 shēng)
',
            46 => 'Trạch Thủy Khốn (困 kùn)
',
            47 => 'Thủy Phong Tỉnh (井 jǐng)
',
            48 => 'Trạch Hỏa Cách (革 gé)
',
            49 => 'Hỏa Phong Đỉnh (鼎 dǐng)
',
            50 => 'Thuần Chấn (震 zhèn)
',
            51 => 'Thuần Cấn (艮 gèn)
',
            52 => 'Phong Sơn Tiệm (漸 jiàn)
',
            53 => 'Lôi Trạch Quy Muội (歸妹 guī mèi)
',
            54 => 'Lôi Hỏa Phong (豐 fēng)
',
            55 => 'Hỏa Sơn Lữ (旅 lǚ)
',
            56 => 'Thuần Tốn (巽 xùn)
',
            57 => 'Thuần Đoài (兌 duì)
',
            58 => 'Phong Thủy Hoán (渙 huàn)
',
            59 => 'Thủy Trạch Tiết (節 jié)
',
            60 => 'Phong Trạch Trung Phu (中孚 zhōng fú)
',
            61 => 'Lôi Sơn Tiểu Quá (小過 xiǎo guò)
',
            62 => 'Thủy Hỏa Ký Tế (既濟 jì jì)
',
            63 => 'Hỏa Thủy Vị Tế (未濟 wèi jì)',);

        return trim($data[$so]);
    }

}


class SunClass
{
    //--------------------------------------------- THE SUN INFO -----------------------------------------------------
    private static function jdFromDate($dd, $mm, $yy)
    {
        $a = floor((14 - $mm) / 12);
        $y = $yy + 4800 - $a;
        $m = $mm + 12 * $a - 3;
        $jd = $dd + floor((153 * $m + 2) / 5) + 365 * $y + floor($y / 4) - floor($y / 100) + floor($y / 400) - 32045;
        if ($jd < 2299161) {
            $jd = $dd + floor((153 * $m + 2) / 5) + 365 * $y + floor($y / 4) - 32083;
        }
        return $jd;
    }

    private static function jdToDate($jd)
    {
        if ($jd > 2299160) { // After 5/10/1582, Gregorian calendar
            $a = $jd + 32044;
            $b = floor((4 * $a + 3) / 146097);
            $c = $a - floor(($b * 146097) / 4);
        } else {
            $b = 0;
            $c = $jd + 32082;
        }
        $d = floor((4 * $c + 3) / 1461);
        $e = $c - floor((1461 * $d) / 4);
        $m = floor((5 * $e + 2) / 153);
        $day = $e - floor((153 * $m + 2) / 5) + 1;
        $month = $m + 3 - 12 * floor($m / 10);
        $year = $b * 100 + $d - 4800 + floor($m / 10);
        //echo "day = $day, month = $month, year = $year\n";
        return array($day, $month, $year);
    }

    private static function getNewMoonDay($k, $timeZone)
    {
        $T = $k / 1236.85; // Time in Julian centuries from 1900 January 0.5
        $T2 = $T * $T;
        $T3 = $T2 * $T;
        $dr = M_PI / 180;
        $Jd1 = 2415020.75933 + 29.53058868 * $k + 0.0001178 * $T2 - 0.000000155 * $T3;
        $Jd1 = $Jd1 + 0.00033 * sin((166.56 + 132.87 * $T - 0.009173 * $T2) * $dr); // Mean new moon
        $M = 359.2242 + 29.10535608 * $k - 0.0000333 * $T2 - 0.00000347 * $T3; // Sun's mean anomaly
        $Mpr = 306.0253 + 385.81691806 * $k + 0.0107306 * $T2 + 0.00001236 * $T3; // Moon's mean anomaly
        $F = 21.2964 + 390.67050646 * $k - 0.0016528 * $T2 - 0.00000239 * $T3; // Moon's argument of latitude
        $C1 = (0.1734 - 0.000393 * $T) * sin($M * $dr) + 0.0021 * sin(2 * $dr * $M);
        $C1 = $C1 - 0.4068 * sin($Mpr * $dr) + 0.0161 * sin($dr * 2 * $Mpr);
        $C1 = $C1 - 0.0004 * sin($dr * 3 * $Mpr);
        $C1 = $C1 + 0.0104 * sin($dr * 2 * $F) - 0.0051 * sin($dr * ($M + $Mpr));
        $C1 = $C1 - 0.0074 * sin($dr * ($M - $Mpr)) + 0.0004 * sin($dr * (2 * $F + $M));
        $C1 = $C1 - 0.0004 * sin($dr * (2 * $F - $M)) - 0.0006 * sin($dr * (2 * $F + $Mpr));
        $C1 = $C1 + 0.0010 * sin($dr * (2 * $F - $Mpr)) + 0.0005 * sin($dr * (2 * $Mpr + $M));
        if ($T < -11) {
            $deltat = 0.001 + 0.000839 * $T + 0.0002261 * $T2 - 0.00000845 * $T3 - 0.000000081 * $T * $T3;
        } else {
            $deltat = -0.000278 + 0.000265 * $T + 0.000262 * $T2;
        };
        $JdNew = $Jd1 + $C1 - $deltat;
        //echo "JdNew = $JdNew\n";
        return floor($JdNew + 0.5 + $timeZone / 24);
    }

    private static function getSunLongitude($jdn, $timeZone)
    {
        $T = ($jdn - 2451545.5 - $timeZone / 24) / 36525; // Time in Julian centuries from 2000-01-01 12:00:00 GMT
        $T2 = $T * $T;
        $dr = M_PI / 180; // degree to radian
        $M = 357.52910 + 35999.05030 * $T - 0.0001559 * $T2 - 0.00000048 * $T * $T2; // mean anomaly, degree
        $L0 = 280.46645 + 36000.76983 * $T + 0.0003032 * $T2; // mean longitude, degree
        $DL = (1.914600 - 0.004817 * $T - 0.000014 * $T2) * sin($dr * $M);
        $DL = $DL + (0.019993 - 0.000101 * $T) * sin($dr * 2 * $M) + 0.000290 * sin($dr * 3 * $M);
        $L = $L0 + $DL; // true longitude, degree
        //echo "\ndr = $dr, M = $M, T = $T, DL = $DL, L = $L, L0 = $L0\n";
        // obtain apparent longitude by correcting for nutation and aberration
        $omega = 125.04 - 1934.136 * $T;
        $L = $L - 0.00569 - 0.00478 * sin($omega * $dr);
        $L = $L * $dr;
        $L = $L - M_PI * 2 * (floor($L / (M_PI * 2))); // Normalize to (0, 2*PI)
        return floor($L / M_PI * 6);
    }

    private static function getSunLongitude2($jdn)
    {
        //var T, T2, dr, M, L0, DL, lambda, theta, omega;
        $T = ($jdn - 2451545.0) / 36525; // Time in Julian centuries from 2000-01-01 12:00:00 GMT
        $T2 = $T * $T;
        $dr = pi() / 180; // degree to radian
        $M = 357.52910 + 35999.05030 * $T - 0.0001559 * $T2 - 0.00000048 * $T * $T2; // mean anomaly, degree
        $L0 = 280.46645 + 36000.76983 * $T + 0.0003032 * $T2; // mean longitude, degree
        $DL = (1.914600 - 0.004817 * $T - 0.000014 * $T2) * sin($dr * $M);
        $DL = $DL + (0.019993 - 0.000101 * $T) * sin($dr * 2 * $M) + 0.000290 * sin($dr * 3 * $M);
        $theta = $L0 + $DL; // true longitude, degree
        // obtain apparent longitude by correcting for nutation and aberration
        $omega = 125.04 - 1934.136 * $T;
        $lambda = $theta - 0.00569 - 0.00478 * sin($omega * $dr);
        // Convert to radians
        $lambda = $lambda * $dr;
        $lambda = $lambda - pi() * 2 * (floor($lambda / (pi() * 2))); // Normalize to (0, 2*PI)
        return $lambda;
    }

    private static function getLunarMonth11($yy, $timeZone)
    {
        $off = self::jdFromDate(31, 12, $yy) - 2415021;
        $k = floor($off / 29.530588853);
        $nm = self::getNewMoonDay($k, $timeZone);
        $sunLong = self::getSunLongitude($nm, $timeZone); // sun longitude at local midnight
        if ($sunLong >= 9) {
            $nm = self::getNewMoonDay($k - 1, $timeZone);
        }
        return $nm;
    }

    private static function getLeapMonthOffset($a11, $timeZone)
    {
        $k = floor(($a11 - 2415021.076998695) / 29.530588853 + 0.5);
        $last = 0;
        $i = 1; // We start with the month following lunar month 11
        $arc = self::getSunLongitude(self::getNewMoonDay($k + $i, $timeZone), $timeZone);
        do {
            $last = $arc;
            $i = $i + 1;
            $arc = self::getSunLongitude(self::getNewMoonDay($k + $i, $timeZone), $timeZone);
        } while ($arc != $last && $i < 14);
        return $i - 1;
    }

    /**
     * Kiểm tra xem năm dương có nhuận không?
     * @param null $yyyy
     * @return string
     */
    private static function isSolarYearLeap($yyyy = null)
    {
        if ($yyyy == null) {
            $yyyy = date('Y');
        }
        if ($yyyy % 4 == 0 || ($yyyy % 100 == 0 && $yyyy % 400 == 0)) {
            return 'Năm dương nhuận';
        } else {
            return 'Năm dương không nhuận';
        }
    }

    /**
     * Kiểm tra xem năm âm tương ứng có nhuận không?
     * @param null $yyyy
     * @return string
     */
    private static function isLunarYearLeap($yyyy = null)
    {
        if ($yyyy == null) {
            $yyyy = date('Y');
        }
        $arr = array(0, 3, 6, 9, 11, 14, 17);
        $leap = $yyyy % 19;
        if (in_array($leap, $arr)) {
            return 'Năm âm nhuận';
        } else {
            return 'Năm âm không nhuận';
        }
    }

    private static function getDayName($id)
    {
        $arr = array(
            'Sunday' => 'Chủ nhật',
            'Monday' => 'Thứ 2',
            'Tuesday' => 'Thứ 3',
            'Wednesday' => 'Thứ 4',
            'Thursday' => 'Thứ 5',
            'Friday' => 'Thứ 6',
            'Saturday' => 'Thứ 7'
        );
        if (array_key_exists($id, $arr)) {
            return $arr[$id];
        } else {
            return '';
        }
    }

    private static function getMonthName($id)
    {
        $arr2 = array('Tháng Giêng', 'Tháng Hai', 'Tháng Ba', 'Tháng Tư', 'Tháng Năm', 'Tháng Sáu', 'Tháng Bảy', 'Tháng Tám', 'Tháng Chín', 'Tháng Mười', 'Tháng Mười Một', 'Tháng Chạp');
        return $arr2[$id];
    }

    private static function getListCan()
    {
        return array('Giáp', 'Ất', 'Bính', 'Đinh', 'Mậu', 'Kỷ', 'Canh', 'Tân', 'Nhâm', 'Quí');
    }

    private static function getListChi()
    {
        return array('Tý', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi');
    }

    static function getCanChiNam($nam)
    {
        $arrCan = self::getListCan();
        $arrChi = self::getListChi();
        $can = ($nam + 6) % 10;
        $chi = ($nam + 8) % 12;
        return 'Năm ' . $arrCan[$can] . ' ' . $arrChi[$chi];
    }

    private static function getCanChiThang($nam, $thang)
    {
        $arrCan = self::getListCan();
        $arrChi = self::getListChi();
        $can = ($nam * 12 + $thang + 3) % 10;
        $chi = ($thang + 1) % 12;
        return 'Tháng ' . $arrCan[$can] . ' ' . $arrChi[$chi];
    }

    private static function getCanChiNgay($jd)
    {
        $arrCan = self::getListCan();
        $arrChi = self::getListChi();
        $can = ($jd + 9) % 10;
        $chi = ($jd + 1) % 12;
        return 'Ngày ' . $arrCan[$can] . ' ' . $arrChi[$chi];
    }

    private static function getCanChiGio($jd)
    {
        $arrCan = self::getListCan();
        $arrChi = self::getListChi();
        $can = ($jd - 1) * 2 % 10;
        return 'Giờ ' . $arrCan[$can] . ' ' . $arrChi[0];
    }

    private static function getTietKhi($jd)
    {
        $arr = array(
            'Xuân phân', 'Thanh minh', 'Cốc vũ', 'Lập hạ', 'Tiểu mãn', 'Mang chủng',
            'Hạ chí', 'Tiểu thử', 'Đại thử', 'Lập thu', 'Xử thử', 'Bạch lộ',
            'Thu phân', 'Hàn lộ', 'Sương giáng', 'Lập đông', 'Tiểu tuyết', 'Đại tuyết',
            'Đông chí', 'Tiểu hàn', 'Đại hàn', 'Lập xuân', 'Vũ thủy', 'Kinh trập'
        );
        $tietkhi = floor(self::getSunLongitude2($jd + 1 - 0.5 - 7.0 / 24.0) / pi() * 12);
        return $arr[$tietkhi];
    }

    private static function getHoangDao($id)
    {
        $arr = array("110100101100", "001101001011", "110011010010", "101100110100", "001011001101", "010010110011");
        return $arr[$id];
    }

    private static function getGioHoangDao($jd)
    {
        $chiOfDay = ($jd + 1) % 12;
        $gioHD = self::getHoangDao($chiOfDay % 6); // same values for Ty' (1) and Ngo. (6), for Suu and Mui etc.
        $ret = "";
        $count = 0;
        for ($i = 0; $i < 12; $i++) {
            $s = substr($gioHD, $i, 1);
            if ($s == '1') {
                $ret .= self::getListChi()[$i];
                $ret .= ' (' . (($i * 2 + 23) % 24) . '-' . (($i * 2 + 1) % 24) . ')';
                if ($count++ < 5) $ret .= ', ';
                //if (count == 3) ret += '\n';
            }
        }
        return $ret;
    }

    private static function getSuKienNam($da, $ma)
    {
        $arr = array(
            '1_1' => 'Tết Nguyên Đán',
            '15_1' => 'Rằm Tháng Giêng',
            '10_3' => 'Giỗ Tổ Hùng Vương',
            '15_4' => 'Lễ Phật Đản',
            '5_5' => 'Tết Đoan Ngọ',
            '15_7' => 'Lễ Vu Lan',
            '15_8' => 'Tết Trung Thu',
            '23_12' => 'Ông Táo chầu trời'
        );

        if (array_key_exists($da . '_' . $ma, $arr)) {
            return $arr[$da . '_' . $ma];
        } else {
            return 'Ngày thường';
        }
    }

    private static function getDateSunInfo($dd, $mm, $yy)
    {
        return date_sun_info(strtotime($yy . '-' . $mm . '-' . $dd), 21.03, 105.85);
    }

    private static function getNewMoon($dd, $mm, $yy)
    {
        $k = floor((self::jdFromDate($dd, $mm, $yy) - 2415021) / 29.530588853);
        $j = self::getNewMoonDay($k, 7.0);
        $arrDate = self::jdToDate($j);
        //
        $preDate = mktime(0, 0, 0, $arrDate[1], $arrDate[0] - 1, $arrDate[2]);
        return date('d/m/Y', $preDate);
    }

    private static function getEndOfMoon($timestamp)
    {
        $synmonth = 29.53058868;
        $arrPhase = self::phasehunt($timestamp, $synmonth);
        $next_new_moon = $arrPhase[4];
        $preDate = mktime(0, 0, 0, date('m', $next_new_moon), date('d', $next_new_moon) - 1, date('Y', $next_new_moon));
        $preDate = self::convertSolar2Lunar(date('d', $preDate), date('m', $preDate), date('Y', $preDate));
        if (is_numeric($preDate)) {
            return date('d', $preDate);
        } else {
            return null;
        }
    }

    /* Comvert solar date dd/mm/yyyy to the corresponding lunar date */
    public static function getArrayDateInfo($dd, $mm, $yy, $timeZone = 7.0)
    {
        $dayNumber = self::jdFromDate($dd, $mm, $yy);
        $k = floor(($dayNumber - 2415021.076998695) / 29.530588853);
        $monthStart = self::getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = self::getNewMoonDay($k, $timeZone);
        }
        $a11 = self::getLunarMonth11($yy, $timeZone);
        $b11 = $a11;
        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = self::getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = self::getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = floor(($monthStart - $a11) / 29);
        $lunarLeap = 0;
        $lunarMonth = $diff + 11;
        if ($b11 - $a11 > 365) {
            $leapMonthDiff = self::getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff == $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear -= 1;
        }

        //
        $intDate = strtotime($yy . '-' . $mm . '-' . $dd);
        $dateSunInfo = self::getDateSunInfo($dd, $mm, $yy);
        $nhuan = ($lunarLeap == 1) ? 'Nhuận' : 'Không';
        $tenthang = (self::getEndOfMoon($intDate) == 30 ? 'Đủ' : 'Thiếu');
        $moon = self::getMoonTimes($dd, $mm, $yy, 21.03, 105.85);

        return array(
            'input_duong' => date('Y-m-d', $intDate),
            'output_am' => date('Y-m-d', strtotime($lunarYear . '-' . $lunarMonth . '-' . $lunarDay)),
            //'lunarLeap' => $lunarLeap,
            'thu_en' => date('l', $intDate),
            'thu_vi' => self::getDayName(date('l', $intDate)),
            'thang_am' => self::getMonthName($lunarMonth - 1),
            'thang_am_nhuan' => $nhuan,
            'thang_am_du_thieu' => $tenthang,
            'nam_duong_nhuan' => self::isSolarYearLeap($yy),
            'nam_am_nhuan' => self::isLunarYearLeap($yy),
            'can_chi_nam' => self::getCanChiNam($lunarYear),
            'can_chi_thang' => self::getCanChiThang($lunarYear, $lunarMonth),
            'can_chi_ngay' => self::getCanChiNgay(self::jdFromDate($dd, $mm, $yy)),
            'can_chi_gio' => self::getCanChiGio(self::jdFromDate($dd, $mm, $yy)),
            'tiet_khi' => self::getTietKhi(self::jdFromDate($dd, $mm, $yy)),
            'day_info' => self::getSuKienNam($lunarDay, $lunarMonth),
            'hoang_dao' => self::getGioHoangDao(self::jdFromDate($dd, $mm, $yy)),
            'sun_info' => array(
                'sunrise' => date('H:i:s', $dateSunInfo['sunrise']),
                'transit' => date('H:i:s', $dateSunInfo['transit']),
                'sunset' => date('H:i:s', $dateSunInfo['sunset']),
                'sun_length' => gmdate('H:i:s', $dateSunInfo['sunset'] - $dateSunInfo['sunrise']),
                //'chang_vang_1' => date('H:i:s', $dateSunInfo['civil_twilight_begin']),
                //'chang_vang_2' => date('H:i:s', $dateSunInfo['civil_twilight_end']),
                //'chang_vang_hang_hai_1' => date('H:i:s', $dateSunInfo['nautical_twilight_begin']),
                //'chang_vang_hang_hai_2' => date('H:i:s', $dateSunInfo['nautical_twilight_end']),
                //'chang_vang_thien_van_1' => date('H:i:s', $dateSunInfo['astronomical_twilight_begin']),
                //'chang_vang_thien_van_2' => date('H:i:s', $dateSunInfo['astronomical_twilight_end'])
            ),
            'moon_info' => array(
                'moonrise' => date('H:i:s', $moon['moonrise']),
                'moonset' => date('H:i:s', $moon['moonset']),
                'moon_lenght' => gmdate('H:i:s', $moon['moonset'] - $moon['moonrise']),
                'moon_phase' => self::getMoonPhase($dd, $mm, $yy)
            ),
            'moon_cycle' => self::getMoonCycle($intDate)
        );
    }

    public static function convertSolar2Lunar($dd, $mm, $yy, $timeZone = 7.0)
    {
        $dayNumber = self::jdFromDate($dd, $mm, $yy);
        $k = floor(($dayNumber - 2415021.076998695) / 29.530588853);
        $monthStart = self::getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = self::getNewMoonDay($k, $timeZone);
        }
        $a11 = self::getLunarMonth11($yy, $timeZone);
        $b11 = $a11;
        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = self::getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = self::getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = floor(($monthStart - $a11) / 29);
        $lunarLeap = 0;
        $lunarMonth = $diff + 11;
        if ($b11 - $a11 > 365) {
            $leapMonthDiff = self::getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff == $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear -= 1;
        }

        return strtotime($lunarYear . '-' . $lunarMonth . '-' . $lunarDay);
    }

    /* Convert a lunar date to the corresponding solar date */
    public static function convertLunar2Solar($lunarDay, $lunarMonth, $lunarYear, $lunarLeap, $timeZone = 7.0)
    {
        if ($lunarMonth < 11) {
            $a11 = self::getLunarMonth11($lunarYear - 1, $timeZone);
            $b11 = self::getLunarMonth11($lunarYear, $timeZone);
        } else {
            $a11 = self::getLunarMonth11($lunarYear, $timeZone);
            $b11 = self::getLunarMonth11($lunarYear + 1, $timeZone);
        }
        $k = floor(0.5 + ($a11 - 2415021.076998695) / 29.530588853);
        $off = $lunarMonth - 11;
        if ($off < 0) {
            $off += 12;
        }
        if ($b11 - $a11 > 365) {
            $leapOff = self::getLeapMonthOffset($a11, $timeZone);
            $leapMonth = $leapOff - 2;
            if ($leapMonth < 0) {
                $leapMonth += 12;
            }
            if ($lunarLeap != 0 && $lunarMonth != $leapMonth) {
                return array(0, 0, 0);
            } else if ($lunarLeap != 0 || $off >= $leapOff) {
                $off += 1;
            }
        }
        $monthStart = self::getNewMoonDay($k + $off, $timeZone);
        return self::jdToDate($monthStart + $lunarDay - 1);
    }

    //--------------------------------------------- THE MOON INFO -----------------------------------------------------

    /**
     * Calculates the moon rise/set for a given location and day of year
     */
    public static function getMoonTimes($day, $month, $year, $lat, $lon)
    {
        $utrise = $utset = 0;
        $timezone = (int)($lon / 15);
        $date = self::modifiedJulianDate($month, $day, $year);
        $date -= $timezone / 24;
        $latRad = deg2rad($lat);
        $sinho = 0.0023271056;
        $sglat = sin($latRad);
        $cglat = cos($latRad);

        $rise = false;
        $set = false;
        $above = false;
        $hour = 1;
        $ym = self::sinAlt($date, $hour - 1, $lon, $cglat, $sglat) - $sinho;

        $above = $ym > 0;
        while ($hour < 25 && (false == $set || false == $rise)) {
            $yz = self::sinAlt($date, $hour, $lon, $cglat, $sglat) - $sinho;
            $yp = self::sinAlt($date, $hour + 1, $lon, $cglat, $sglat) - $sinho;

            $quadout = self::quad($ym, $yz, $yp);
            $nz = $quadout[0];
            $z1 = $quadout[1];
            $z2 = $quadout[2];
            $xe = $quadout[3];
            $ye = $quadout[4];

            if ($nz == 1) {
                if ($ym < 0) {
                    $utrise = $hour + $z1;
                    $rise = true;
                } else {
                    $utset = $hour + $z1;
                    $set = true;
                }
            }

            if ($nz == 2) {
                if ($ye < 0) {
                    $utrise = $hour + $z2;
                    $utset = $hour + $z1;
                } else {
                    $utrise = $hour + $z1;
                    $utset = $hour + $z2;
                }
            }

            $ym = $yp;
            $hour += 2.0;
        }
        // Convert to unix timestamps and return as an array
        $utrise = self::convertTime($utrise);
        $utset = self::convertTime($utset);
        $moonrise = $rise ? mktime($utrise['hrs'], $utrise['min'], 0, $month, $day, $year) : mktime(0, 0, 0, $month, $day + 1, $year);
        $moonset = $set ? mktime($utset['hrs'], $utset['min'], 0, $month, $day, $year) : mktime(0, 0, 0, $month, $day + 1, $year);
        $retVal = array(
            'moonrise' => $moonrise,
            'moonset' => $moonset
        );
        return $retVal;
    }

    /**
     *    finds the parabola throuh the three points (-1,ym), (0,yz), (1, yp)
     *  and returns the coordinates of the max/min (if any) xe, ye
     *  the values of x where the parabola crosses zero (roots of the self::quadratic)
     *  and the number of roots (0, 1 or 2) within the interval [-1, 1]
     *
     *    well, this routine is producing sensible answers
     *
     *  results passed as array [nz, z1, z2, xe, ye]
     */
    private static function quad($ym, $yz, $yp)
    {
        $nz = $z1 = $z2 = 0;
        $a = 0.5 * ($ym + $yp) - $yz;
        $b = 0.5 * ($yp - $ym);
        $c = $yz;
        $xe = -$b / (2 * $a);
        $ye = ($a * $xe + $b) * $xe + $c;
        $dis = $b * $b - 4 * $a * $c;
        if ($dis > 0) {
            $dx = 0.5 * sqrt($dis) / abs($a);
            $z1 = $xe - $dx;
            $z2 = $xe + $dx;
            $nz = abs($z1) < 1 ? $nz + 1 : $nz;
            $nz = abs($z2) < 1 ? $nz + 1 : $nz;
            $z1 = $z1 < -1 ? $z2 : $z1;
        }

        return array($nz, $z1, $z2, $xe, $ye);
    }

    /**
     *    this rather mickey mouse function takes a lot of
     *  arguments and then returns the sine of the altitude of the moon
     */
    private static function sinAlt($mjd, $hour, $glon, $cglat, $sglat)
    {
        $mjd += $hour / 24;
        $t = ($mjd - 51544.5) / 36525;
        $objpos = self::minimoon($t);

        $ra = $objpos[1];
        $dec = $objpos[0];
        $decRad = deg2rad($dec);
        $tau = 15 * (self::lmst($mjd, $glon) - $ra);

        return $sglat * sin($decRad) + $cglat * cos($decRad) * cos(deg2rad($tau));
    }

    /**
     *    returns an angle in degrees in the range 0 to 360
     */
    private static function degRange($x)
    {
        $b = $x / 360;
        $a = 360 * ($b - (int)$b);
        $retVal = $a < 0 ? $a + 360 : $a;
        return $retVal;
    }

    private static function lmst($mjd, $glon)
    {
        $d = $mjd - 51544.5;
        $t = $d / 36525;
        $lst = self::degRange(280.46061839 + 360.98564736629 * $d + 0.000387933 * $t * $t - $t * $t * $t / 38710000);
        return $lst / 15 + $glon / 15;
    }

    /**
     * takes t and returns the geocentric ra and dec in an array mooneq
     * claimed good to 5' (angle) in ra and 1' in dec
     * tallies with another approximate method and with ICE for a couple of dates
     */
    private static function minimoon($t)
    {
        $p2 = 6.283185307;
        $arc = 206264.8062;
        $coseps = 0.91748;
        $sineps = 0.39778;

        $lo = self::frac(0.606433 + 1336.855225 * $t);
        $l = $p2 * self::frac(0.374897 + 1325.552410 * $t);
        $l2 = $l * 2;
        $ls = $p2 * self::frac(0.993133 + 99.997361 * $t);
        $d = $p2 * self::frac(0.827361 + 1236.853086 * $t);
        $d2 = $d * 2;
        $f = $p2 * self::frac(0.259086 + 1342.227825 * $t);
        $f2 = $f * 2;

        $sinls = sin($ls);
        $sinf2 = sin($f2);

        $dl = 22640 * sin($l);
        $dl += -4586 * sin($l - $d2);
        $dl += 2370 * sin($d2);
        $dl += 769 * sin($l2);
        $dl += -668 * $sinls;
        $dl += -412 * $sinf2;
        $dl += -212 * sin($l2 - $d2);
        $dl += -206 * sin($l + $ls - $d2);
        $dl += 192 * sin($l + $d2);
        $dl += -165 * sin($ls - $d2);
        $dl += -125 * sin($d);
        $dl += -110 * sin($l + $ls);
        $dl += 148 * sin($l - $ls);
        $dl += -55 * sin($f2 - $d2);

        $s = $f + ($dl + 412 * $sinf2 + 541 * $sinls) / $arc;
        $h = $f - $d2;
        $n = -526 * sin($h);
        $n += 44 * sin($l + $h);
        $n += -31 * sin(-$l + $h);
        $n += -23 * sin($ls + $h);
        $n += 11 * sin(-$ls + $h);
        $n += -25 * sin(-$l2 + $f);
        $n += 21 * sin(-$l + $f);

        $L_moon = $p2 * self::frac($lo + $dl / 1296000);
        $B_moon = (18520.0 * sin($s) + $n) / $arc;

        $cb = cos($B_moon);
        $x = $cb * cos($L_moon);
        $v = $cb * sin($L_moon);
        $w = sin($B_moon);
        $y = $coseps * $v - $sineps * $w;
        $z = $sineps * $v + $coseps * $w;
        $rho = sqrt(1 - $z * $z);
        $dec = (360 / $p2) * atan($z / $rho);
        $ra = (48 / $p2) * atan($y / ($x + $rho));
        $ra = $ra < 0 ? $ra + 24 : $ra;

        return array($dec, $ra);
    }

    /**
     *    returns the self::fractional part of x as used in self::minimoon and minisun
     */
    private static function frac($x)
    {
        $x -= (int)$x;
        return $x < 0 ? $x + 1 : $x;
    }

    /**
     * Takes the day, month, year and hours in the day and returns the
     * modified julian day number defined as mjd = jd - 2400000.5
     * checked OK for Greg era dates - 26th Dec 02
     */
    private static function modifiedJulianDate($month, $day, $year)
    {
        if ($month <= 2) {
            $month += 12;
            $year--;
        }

        $a = 10000 * $year + 100 * $month + $day;
        $b = 0;
        if ($a <= 15821004.1) {
            $b = -2 * (int)(($year + 4716) / 4) - 1179;
        } else {
            $b = (int)($year / 400) - (int)($year / 100) + (int)($year / 4);
        }

        $a = 365 * $year - 679004;
        return $a + $b + (int)(30.6001 * ($month + 1)) + $day;
    }

    /**
     * Converts an hours decimal to hours and minutes
     */
    private static function convertTime($hours)
    {
        $hrs = (int)($hours * 60 + 0.5) / 60.0;
        $h = (int)($hrs);
        $m = (int)(60 * ($hrs - $h) + 0.5);
        return array('hrs' => $h, 'min' => $m);
    }

    private static function getMoonPhase($day, $month, $year)
    {
        $date = strtotime($year . '-' . $month . '-' . $day);
        // calculate lunar phase (1900 - 2199)
        $year = date('Y', $date);
        $month = date('n', $date);
        $day = date('j', $date);
        if ($month < 4) {
            $year = $year - 1;
            $month = $month + 12;
        }
        $days_y = 365.25 * $year;
        $days_m = 30.42 * $month;
        $julian = $days_y + $days_m + $day - 694039.09;
        $julian = $julian / 29.53;
        $phase = intval($julian);
        $julian = $julian - $phase;
        $phase = round($julian * 8 + 0.5);
        if ($phase == 8) {
            $phase = 0;
        }
        //$phase_array = array('new', 'waxing crescent', 'first quarter', 'waxing gibbous', 'full', 'waning gibbous', 'last quarter', 'waning crescent');
        $phase_array = array(
            'Trăng mới',
            'Trăng lưỡi liềm đầu tháng',
            'Trăng bán nguyệt đầu tháng',
            'Trăng khuyết đầu tháng',
            'Trăng tròn',
            'Trăng khuyết cuối tháng',
            'Trăng bán nguyệt cuối tháng',
            'Trăng lưỡi liềm cuối tháng'
        );
        return $phase_array[$phase];
    }

    //--------------------------------------------- THE MOON INFO -----------------------------------------------------
    public static function getMoonCycle($pdate = null)
    {
        if (is_null($pdate))
            $pdate = time();

        /*  Astronomical constants  */
        $epoch = 2444238.5;            // 1980 January 0.0

        /*  Constants defining the Sun's apparent orbit  */
        $elonge = 278.833540;        // Ecliptic longitude of the Sun at epoch 1980.0
        $elongp = 282.596403;        // Ecliptic longitude of the Sun at perigee
        $eccent = 0.016718;            // Eccentricity of Earth's orbit
        $sunsmax = 1.495985e8;        // Semi-major axis of Earth's orbit, km
        $sunangsiz = 0.533128;        // Sun's angular size, degrees, at semi-major axis distance

        /*  Elements of the Moon's orbit, epoch 1980.0  */
        $mmlong = 64.975464;        // Moon's mean longitude at the epoch
        $mmlongp = 349.383063;        // Mean longitude of the perigee at the epoch
        $mlnode = 151.950429;        // Mean longitude of the node at the epoch
        $minc = 5.145396;            // Inclination of the Moon's orbit
        $mecc = 0.054900;            // Eccentricity of the Moon's orbit
        $mangsiz = 0.5181;            // Moon's angular size at distance a from Earth
        $msmax = 384401;            // Semi-major axis of Moon's orbit in km
        $mparallax = 0.9507;        // Parallax at distance a from Earth
        $synmonth = 29.53058868;    // Synodic month (new Moon to new Moon)
        $lunatbase = 2423436.0;        // Base date for E. W. Brown's numbered series of lunations (1923 January 16)

        /*  Properties of the Earth  */
        // $earthrad = 6378.16;				// Radius of Earth in kilometres
        // $PI = 3.14159265358979323846;	// Assume not near black hole

        $timestamp = $pdate;
        // pdate is coming in as a UNIX timstamp, so convert it to Julian
        $pdate = $pdate / 86400 + 2440587.5;

        /* Calculation of the Sun's position */
        $Day = $pdate - $epoch;                                // Date within epoch
        $N = self::fixangle((360 / 365.2422) * $Day);        // Mean anomaly of the Sun
        $M = self::fixangle($N + $elonge - $elongp);        // Convert from perigee co-ordinates to epoch 1980.0
        $Ec = self::kepler($M, $eccent);                    // Solve equation of Kepler
        $Ec = sqrt((1 + $eccent) / (1 - $eccent)) * tan($Ec / 2);
        $Ec = 2 * rad2deg(atan($Ec));                        // True anomaly
        $Lambdasun = self::fixangle($Ec + $elongp);        // Sun's geocentric ecliptic longitude

        $F = ((1 + $eccent * cos(deg2rad($Ec))) / (1 - $eccent * $eccent));    // Orbital distance factor
        $SunDist = $sunsmax / $F;                            // Distance to Sun in km
        $SunAng = $F * $sunangsiz;                            // Sun's angular size in degrees

        /* Calculation of the Moon's position */
        $ml = self::fixangle(13.1763966 * $Day + $mmlong);                // Moon's mean longitude
        $MM = self::fixangle($ml - 0.1114041 * $Day - $mmlongp);        // Moon's mean anomaly
        $MN = self::fixangle($mlnode - 0.0529539 * $Day);                // Moon's ascending node mean longitude
        $Ev = 1.2739 * sin(deg2rad(2 * ($ml - $Lambdasun) - $MM));        // Evection
        $Ae = 0.1858 * sin(deg2rad($M));                                // Annual equation
        $A3 = 0.37 * sin(deg2rad($M));                                    // Correction term
        $MmP = $MM + $Ev - $Ae - $A3;                                    // Corrected anomaly
        $mEc = 6.2886 * sin(deg2rad($MmP));                                // Correction for the equation of the centre
        $A4 = 0.214 * sin(deg2rad(2 * $MmP));                            // Another correction term
        $lP = $ml + $Ev + $mEc - $Ae + $A4;                                // Corrected longitude
        $V = 0.6583 * sin(deg2rad(2 * ($lP - $Lambdasun)));                // Variation
        $lPP = $lP + $V;                                                // True longitude
        $NP = $MN - 0.16 * sin(deg2rad($M));                            // Corrected longitude of the node
        $y = sin(deg2rad($lPP - $NP)) * cos(deg2rad($minc));            // Y inclination coordinate
        $x = cos(deg2rad($lPP - $NP));                                    // X inclination coordinate

        $Lambdamoon = rad2deg(atan2($y, $x)) + $NP;                        // Ecliptic longitude
        $BetaM = rad2deg(asin(sin(deg2rad($lPP - $NP)) * sin(deg2rad($minc))));        // Ecliptic latitude

        /* Calculation of the phase of the Moon */
        $MoonAge = $lPP - $Lambdasun;                                    // Age of the Moon in degrees
        $MoonPhase = (1 - cos(deg2rad($MoonAge))) / 2;                    // Phase of the Moon

        // Distance of moon from the centre of the Earth
        $MoonDist = ($msmax * (1 - $mecc * $mecc)) / (1 + $mecc * cos(deg2rad($MmP + $mEc)));

        $MoonDFrac = $MoonDist / $msmax;
        $MoonAng = $mangsiz / $MoonDFrac;                                // Moon's angular diameter
        // $MoonPar = $mparallax / $MoonDFrac;							// Moon's parallax

        // store results
        $phase = self::fixangle($MoonAge) / 360;
        $result = array(
            //'phase' => $phase,
            //'illum' => $MoonPhase,
            'illum_percent' => round($MoonPhase * 100, 2),
            'age' => $synmonth * $phase,
            'dist' => $MoonDist,
            //'angdia' => $MoonAng,
            'sundist' => $SunDist,
            //'sunangdia' => $SunAng,
            'new_moon' => self::get_phase(0, $timestamp, $synmonth),
            'first_quarter' => self::get_phase(1, $timestamp, $synmonth),
            'full_moon' => self::get_phase(2, $timestamp, $synmonth),
            'last_quarter' => self::get_phase(3, $timestamp, $synmonth),
            'next_new_moon' => self::get_phase(4, $timestamp, $synmonth),
            'next_first_quarter' => self::get_phase(5, $timestamp, $synmonth),
            'next_full_moon' => self::get_phase(6, $timestamp, $synmonth),
            'next_last_quarter' => self::get_phase(7, $timestamp, $synmonth)
        );
        return $result;
    }

    private static function fixangle($a)
    {
        return ($a - 360 * floor($a / 360));
    }

    //  KEPLER  --   Solve the equation of Kepler.
    private static function kepler($m, $ecc)
    {
        $epsilon = 0.000001;    // 1E-6
        $e = $m = deg2rad($m);
        do {
            $delta = $e - $ecc * sin($e) - $m;
            $e -= $delta / (1 - $ecc * cos($e));
        } while (abs($delta) > $epsilon);
        return $e;
    }

    /*  Calculates  time  of  the mean new Moon for a given
        base date.  This argument K to this function is the
        precomputed synodic month index, given by:
            K = (year - 1900) * 12.3685
        where year is expressed as a year and fractional year.
    */
    private static function meanphase($sdate, $k, $synmonth)
    {
        // Time in Julian centuries from 1900 January 0.5
        $t = ($sdate - 2415020.0) / 36525;
        $t2 = $t * $t;
        $t3 = $t2 * $t;

        $nt1 = 2415020.75933 + $synmonth * $k
            + 0.0001178 * $t2
            - 0.000000155 * $t3
            + 0.00033 * sin(deg2rad(166.56 + 132.87 * $t - 0.009173 * $t2));

        return $nt1;
    }

    /*  Given a K value used to determine the mean phase of
        the new moon, and a phase selector (0.0, 0.25, 0.5,
        0.75), obtain the true, corrected phase time.
    */
    private static function truephase($k, $phase, $synmonth)
    {
        $apcor = false;

        $k += $phase;                // Add phase to new moon time
        $t = $k / 1236.85;            // Time in Julian centuries from 1900 January 0.5
        $t2 = $t * $t;                // Square for frequent use
        $t3 = $t2 * $t;                // Cube for frequent use
        $pt = 2415020.75933            // Mean time of phase
            + $synmonth * $k
            + 0.0001178 * $t2
            - 0.000000155 * $t3
            + 0.00033 * sin(deg2rad(166.56 + 132.87 * $t - 0.009173 * $t2));

        $m = 359.2242 + 29.10535608 * $k - 0.0000333 * $t2 - 0.00000347 * $t3;            // Sun's mean anomaly
        $mprime = 306.0253 + 385.81691806 * $k + 0.0107306 * $t2 + 0.00001236 * $t3;    // Moon's mean anomaly
        $f = 21.2964 + 390.67050646 * $k - 0.0016528 * $t2 - 0.00000239 * $t3;            // Moon's argument of latitude
        if ($phase < 0.01 || abs($phase - 0.5) < 0.01) {
            // Corrections for New and Full Moon
            $pt += (0.1734 - 0.000393 * $t) * sin(deg2rad($m))
                + 0.0021 * sin(deg2rad(2 * $m))
                - 0.4068 * sin(deg2rad($mprime))
                + 0.0161 * sin(deg2rad(2 * $mprime))
                - 0.0004 * sin(deg2rad(3 * $mprime))
                + 0.0104 * sin(deg2rad(2 * $f))
                - 0.0051 * sin(deg2rad($m + $mprime))
                - 0.0074 * sin(deg2rad($m - $mprime))
                + 0.0004 * sin(deg2rad(2 * $f + $m))
                - 0.0004 * sin(deg2rad(2 * $f - $m))
                - 0.0006 * sin(deg2rad(2 * $f + $mprime))
                + 0.0010 * sin(deg2rad(2 * $f - $mprime))
                + 0.0005 * sin(deg2rad($m + 2 * $mprime));
            $apcor = true;
        } else if (abs($phase - 0.25) < 0.01 || abs($phase - 0.75) < 0.01) {
            $pt += (0.1721 - 0.0004 * $t) * sin(deg2rad($m))
                + 0.0021 * sin(deg2rad(2 * $m))
                - 0.6280 * sin(deg2rad($mprime))
                + 0.0089 * sin(deg2rad(2 * $mprime))
                - 0.0004 * sin(deg2rad(3 * $mprime))
                + 0.0079 * sin(deg2rad(2 * $f))
                - 0.0119 * sin(deg2rad($m + $mprime))
                - 0.0047 * sin(deg2rad($m - $mprime))
                + 0.0003 * sin(deg2rad(2 * $f + $m))
                - 0.0004 * sin(deg2rad(2 * $f - $m))
                - 0.0006 * sin(deg2rad(2 * $f + $mprime))
                + 0.0021 * sin(deg2rad(2 * $f - $mprime))
                + 0.0003 * sin(deg2rad($m + 2 * $mprime))
                + 0.0004 * sin(deg2rad($m - 2 * $mprime))
                - 0.0003 * sin(deg2rad(2 * $m + $mprime));
            if ($phase < 0.5)        // First quarter correction
                $pt += 0.0028 - 0.0004 * cos(deg2rad($m)) + 0.0003 * cos(deg2rad($mprime));
            else    // Last quarter correction
                $pt += -0.0028 + 0.0004 * cos(deg2rad($m)) - 0.0003 * cos(deg2rad($mprime));
            $apcor = true;
        }
        if (!$apcor)    // function was called with an invalid phase selector
            return false;

        return $pt;
    }

    /* 	Find time of phases of the moon which surround the current date.
        Five phases are found, starting and
        ending with the new moons which bound the  current lunation.
    */
    private static function phasehunt($timestamp, $synmonth)
    {
        $sdate = self::utctojulian($timestamp);
        $adate = $sdate - 45;
        $ats = $timestamp - 86400 * 45;
        $yy = (int)gmdate('Y', $ats);
        $mm = (int)gmdate('n', $ats);

        $k1 = floor(($yy + (($mm - 1) * (1 / 12)) - 1900) * 12.3685);
        $adate = $nt1 = self::meanphase($adate, $k1, $synmonth);

        while (true) {
            $adate += $synmonth;
            $k2 = $k1 + 1;
            $nt2 = self::meanphase($adate, $k2, $synmonth);
            // if nt2 is close to sdate, then mean phase isn't good enough, we have to be more accurate
            if (abs($nt2 - $sdate) < 0.75)
                $nt2 = self::truephase($k2, 0.0, $synmonth);
            if ($nt1 <= $sdate && $nt2 > $sdate)
                break;
            $nt1 = $nt2;
            $k1 = $k2;
        }

        // results in Julian dates
        $data = array(
            self::truephase($k1, 0.0, $synmonth),
            self::truephase($k1, 0.25, $synmonth),
            self::truephase($k1, 0.5, $synmonth),
            self::truephase($k1, 0.75, $synmonth),
            self::truephase($k2, 0.0, $synmonth),
            self::truephase($k2, 0.25, $synmonth),
            self::truephase($k2, 0.5, $synmonth),
            self::truephase($k2, 0.75, $synmonth)
        );

        $quarters = array();
        foreach ($data as $v) {
            $quarters[] = ($v - 2440587.5) * 86400;    // convert to UNIX time
        }
        return $quarters;
    }

    /*  Convert UNIX timestamp to astronomical Julian time (i.e. Julian date plus day fraction).  */
    private static function utctojulian($ts)
    {
        return $ts / 86400 + 2440587.5;
    }

    private static function get_phase($n, $timestamp, $synmonth)
    {
        $arrPhase = self::phasehunt($timestamp, $synmonth);
        return date('d/m/Y', $arrPhase[$n]);
    }
}

