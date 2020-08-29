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
                <h2>Thực hành form Insert</h2>
                    <form name="frmThem" id="frmThem" method="post" action="">
                        <table>
                            <tr>
                                <td>Hình thức thanh toán</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="txt_httt_ten" id="txt_httt_ten"/>
                                    <button name="btnLuu" id="btnLuu" class="btn btn-primary">Lưu dữ liệu</button>
                                    <a href="index.php" class="btn btn-outline-primary">Quay về danh sách</a>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <?php
                    // Khi người dùng nhấn button Lưu
                    if(isset($_POST['btnLuu'])) {
                        // Truy vấn database để lấy danh sách
                        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                        include_once(__DIR__ . '/../../../dbconnect.php');

                        // 2. Chuẩn bị QUERY
                        $httt_ten = $_POST['txt_httt_ten']; //Lấy dữ liệu người dùng nhập vào
                        $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES (N'$httt_ten');";

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