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
                <h2>Thực hành form Delete</h2>
                <a href="index.php" class="btn btn-outline-primary">Quay về danh sách</a>
                <?php

                    //Lấy id muốn xóa
                    $idmuonxoa = $_GET['idmuonxoa'];

                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');

                    // 2. Chuẩn bị QUERY
                    $sql =<<<GICUNGDC
                        DELETE FROM hinhthucthanhtoan
                        WHERE httt_ma = $idmuonxoa;
GICUNGDC;

                    // 3. Thực thi
                    mysqli_query($conn, $sql);

                ?>
             
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->


    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
</body>
</html>