<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thực hành PHP</title>
    <style>
    .dongchan{
        background: red;
    }
    .dongle{
        background: blue;
        color: #fff;
    }
    </style>
</head>
<body>
    
<?php
    // define('TEN_PHIM','Fast and furius');
    // echo 'Bộ phim yêu thích là ' . TEN_PHIM . '<br/>';

    // $tenphim = 'Marvel';
    // echo 'Hãng phim yêu thích là ' . $tenphim . '<br/>';

    // $a = 20;
    // $b = 3;
    // $tong = $a + $b;
    // $hieu = $a - $b;
    // $thuong = $a / $b;
    // $tich = $a * $b;
    // $chiadu = $a % $b;
    // $chiasonguyen = floor($thuong);
    // $trungbinhcong = $tong / 2;

    // echo 'Chúng ta có số a: ' . $a . ' và số b: ' . $b;
    // echo '<ul>';
    // echo '<li>Tổng là ' . $tong . '</li>';
    // echo '<li>Hiệu là ' . $hieu . '</li>';
    // echo '<li>Thương là ' . $thuong . '</li>';
    // echo '<li>Tích là ' . $tich . '</li>';
    // echo '<li>Số dư của thương a và b là ' . $chiadu . '</li>';
    // echo '<li>Số nguyên của thương a và b là ' . $chiasonguyen . '</li>';
    // echo '<li>Trung bình cộng là ' . $trungbinhcong . '</li>';
    // echo '</ul>';

    // echo 'Các số chia hết cho 7: ';
    // for( $i = 0; $i <= 100; $i++ ) {
    //     if( ($i % 7) == 0 ) {
    //         echo $i . ' ';
    //     }
    // };

    // RENDER CÁCH 1
    echo '<table border = 1>';
    for( $i = 0; $i < 4; $i++ ) {
        if( $i % 2 == 0 ) {
            echo '<tr class="dongchan">';
        } else {
            echo '<tr class="dongle">';
        }       
        for( $j = 0; $j < 5; $j++ ) {
            echo "<td> Dòng {$i} cột {$j} </td>";
        }
        echo '</tr>';
    }
    echo '</table>';   

?>
    <h1>RENDER CÁCH 2</h1>
    <table border = 1>
    <?php for( $i = 0; $i < 4; $i++ ):?>
        <?php if($i % 2 == 0):?>
            <tr class="dongchan">
            <?php else:?>
            <tr class="dongle">
        <?php endif;?>
        <?php for( $j = 0; $j < 5; $j++ ):?>
            <?php echo "<td> Dòng {$i} cột {$j} </td>";?>
        <?php endfor;?>
        </tr>
    <?php endfor;?>
    </table>

</body>
</html>