<?php

    //Lấy id muốn xóa
    $idmuonxoa = $_GET['idmuonxoa'];

    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../dbconnect.php');
    // include_once(__DIR__ . '/dbconnect.php');

    // 2. Chuẩn bị QUERY
    $sql =<<<GICUNGDC
        DELETE FROM hinhthucthanhtoan
        WHERE httt_ma = $idmuonxoa;
GICUNGDC;

    // 3. Thực thi
    mysqli_query($conn, $sql);

?>