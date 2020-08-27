<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thực hành câu lệnh Select</title>
</head>
<body>
    
<?php

    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../dbconnect.php');
    // include_once(__DIR__ . '/dbconnect.php');

    // 2. Chuẩn bị QUERY
    $sql =<<<GICUNGDC
        SELECT httt_ma AS MaThanhToan, httt_ten AS TenThanhToan FROM `hinhthucthanhtoan`
GICUNGDC;

    // 3. Thực thi QUERY
    $result = mysqli_query($conn, $sql);

    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
    $data = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = array(
            'ma' => $row['MaThanhToan'],
            'ten' => $row['TenThanhToan'],
        );
    }
    // var_dump($data);die;
    // print_r($data);die;
?>

    <table border="1" width="100%">
    <tr>
        <th>Mã thanh toán</th>
        <th>Tên thanh toán</th>
    </tr>
    <?php foreach($data as $item): ?>
    <tr>
        <!-- Dấu '=' tương ứng với php echo -->
        <td><?php echo $item['ma']; ?></td>
        <td><?= $item['ten']; ?></td>
        <td>
            <a href="xu-ly-delete.php?idmuonxoa=<?= $item['ma'] ?>">Xóa</a>
            <a href="xu-ly-update.php?idmuonxoa=<?= $item['ma'] ?>">Sửa</a>
        </td>
      
    </tr>
    <?php endforeach; ?>
    </table>

</body>
</html>