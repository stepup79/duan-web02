<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<?php
    //Select lấy dữ liệu của id muốn xóa vào ô input
    //Lấy id muốn xóa
    $idmuonxoa = $_GET['idmuonxoa'];

    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../dbconnect.php');
    // include_once(__DIR__ . '/dbconnect.php');

    // 2. Chuẩn bị QUERY
    $sqlSelect =<<<GICUNGDC
        SELECT httt_ma AS MaThanhToan, httt_ten AS TenThanhToan FROM `hinhthucthanhtoan`
        WHERE httt_ma = $idmuonxoa
GICUNGDC;

    // 3. Thực thi QUERY
    $result = mysqli_query($conn, $sqlSelect);

    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
    $data = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data = array( // Lấy 1 dòng dữ liệu nên data ko có mảng []
            'ma' => $row['MaThanhToan'],
            'ten' => $row['TenThanhToan'],
        );
    }

?>

<h2>Thực hành form Update</h2>
    <form name="frmUpdate" id="frmUpdate" method="post" action="">
        <table border="1" cellspacing=0>
            <tr>
                <td>Sửa hình thức thanh toán</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="txt_httt_ten" id="txt_httt_ten" value="<?php echo $data['ten']?>"/>
                    <input type="submit" name="btnLuu" id="btnLuu" value="Lưu dữ liệu"/>
                </td>           
            </tr>
        </table>
    </form>

<?php

    // Khi người dùng nhấn button Lưu
    if(isset($_POST['btnLuu'])) {
        // 1. Lấy dữ liệu người dùng nhập vào
        $httt_ten = $_POST['txt_httt_ten'];
        // 2. Chuẩn bị QUERY
        $sql =<<<GICUNGDC
            UPDATE hinhthucthanhtoan
            SET httt_ten = (N'$httt_ten')
            WHERE httt_ma = $idmuonxoa;
GICUNGDC;

        // 3. Thực thi
        mysqli_query($conn, $sql);
    }
?>

</body>
</html>

