<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
</head>
<body>
    
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- End header -->

    <div class="container">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- End sidebar -->
            <div class="col-md-8">
                <h2>Danh sách Hình thức thanh toán</h2>
                <?php
                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    // include_once(__DIR__ . '/dbconnect.php');

                    // 2. Chuẩn bị QUERY
                    $sql =<<<EOT
                        SELECT httt_ma AS MaThanhToan, httt_ten AS TenThanhToan FROM `hinhthucthanhtoan`
EOT;

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
                    <a href="create.php" class="btn btn-primary">Thêm mới</a>
                    <table border="1" width="100%">
                        <tr>
                            <th>Mã thanh toán</th>
                            <th>Tên thanh toán</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach($data as $item): ?>
                        <tr>
                            <!-- Dấu '=' tương ứng với php echo -->
                            <td><?php echo $item['ma']; ?></td>
                            <td><?= $item['ten']; ?></td>
                            <td>
                                <a href="edit.php?idmuonxoa=<?= $item['ma'] ?>">Xóa</a>
                                <a href="delete.php?idmuonxoa=<?= $item['ma'] ?>">Sửa</a>
                            </td>
                        
                        </tr>
                    <?php endforeach; ?>
                    </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->


    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
</body>
</html>