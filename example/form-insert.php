<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thực hành form Insert</title>
</head>
<body>
    
    <h2>Thực hành form Insert</h2>
    <form name="frmThem" id="frmThem" method="post" action="">
        <table>
            <tr>
                <td>
                    Hình thức thanh toán</td>
                    <tr>
                    <td>
                    <input type="text" name="txt_httt_ten" id="txt_httt_ten"/>
                    <input type="submit" name="btnLuu" id="btnLuu" value="Lưu dữ liệu"/>
                    </td>
                </tr>
            </tr>
        </table>
    </form>

    <?php

    // Khi người dùng nhấn button Lưu
    if(isset($_POST['btnLuu'])) {
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../dbconnect.php');

        // 2. Chuẩn bị QUERY
        $httt_ten = $_POST['txt_httt_ten']; //Lấy dữ liệu người dùng nhập vào
        $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES (N'$httt_ten');";

        // 3. Thực thi
        mysqli_query($conn, $sql);
    }

    ?>

</body>
</html>