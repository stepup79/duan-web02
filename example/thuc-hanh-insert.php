<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thực hành câu lệnh Insert</title>
</head>
<body>
    
<?php

    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../dbconnect.php');
    // include_once(__DIR__ . '/dbconnect.php');

    // 2. Chuẩn bị QUERY
    $hinhthuc = 'Tiết kiệm';
    $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES (N'$hinhthuc');";

    // 3. Thực thi
    mysqli_query($conn, $sql);
?>

</body>
</html>