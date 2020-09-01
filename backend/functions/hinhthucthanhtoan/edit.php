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

            <?php
                //Select lấy dữ liệu của id muốn xóa vào ô input
                //Lấy id muốn xóa
                $idmuonxoa = $_GET['idmuonxoa'];

                // Truy vấn database để lấy danh sách
                // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                include_once(__DIR__ . '/../../../dbconnect.php');
                // include_once(__DIR__ . '/dbconnect.php');

                // 2. Chuẩn bị QUERY
                $sqlSelect =<<<EOT
                    SELECT httt_ma AS MaThanhToan, httt_ten AS TenThanhToan FROM `hinhthucthanhtoan`
                    WHERE httt_ma = $idmuonxoa
EOT;

                // 3. Thực thi QUERY
                $result = mysqli_query($conn, $sqlSelect);

                // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data = array( // Lấy 1 dòng dữ liệu nên data ko có mảng data[]
                        'ma' => $row['MaThanhToan'],
                        'ten' => $row['TenThanhToan'],
                    );
                }

            ?>

            <div class="col-md-8">
                <h2>Thực hành form Edit</h2>
                <form name="frmUpdate" id="frmUpdate" method="post" action="">
                    <table>
                        <tr>
                            <td><label for="txt_httt_ten">Sửa hình thức thanh toán</label></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">                                    
                                    <input type="text" class="form-control" id="txt_httt_ten" name="txt_httt_ten" value="<?php echo $data['ten']?>">
                                </div>
                                <button name="btnLuu" id="btnLuu" class="btn btn-primary">Lưu dữ liệu</button>
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
                    $sql =<<<EOT
                        UPDATE hinhthucthanhtoan
                        SET httt_ten = (N'$httt_ten')
                        WHERE httt_ma = $idmuonxoa;
EOT;

                    // 3. Thực thi
                    mysqli_query($conn, $sql);
                }
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