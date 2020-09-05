<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách sản phẩm</title>
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
                <h2>Danh sách sản phẩm</h2>
                <?php
                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    // include_once(__DIR__ . '/dbconnect.php');

                    // 2. Chuẩn bị QUERY
                    $sql =<<<EOT
                        SELECT sp.*
                        ,lsp.lsp_ten
                        ,nsx.nsx_ten
                        ,km.km_ten, km.km_noidung, km.km_tungay, km.km_denngay
                        FROM sanpham sp
                        JOIN loaisanpham lsp ON sp.lsp_ma = lsp.lsp_ma
                        JOIN nhasanxuat nsx ON sp.nsx_ma = nsx.nsx_ma
                        LEFT JOIN khuyenmai km ON sp.km_ma = km.km_ma
                        ORDER BY sp.sp_ma DESC
EOT;

                    // 3. Thực thi QUERY
                    $result = mysqli_query($conn, $sql);

                    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $km_tomtat = '';
                        if(!empty($row['km_ten'])) {
                            // Sử dụng hàm sprintf() để chuẩn bị mẫu câu với các giá trị truyền vào tương ứng từng vị trí placeholder
                            $km_tomtat = sprintf("Khuyến mãi: %s, nội dung: %s thời gian: %s đến %s",
                                        $row['km_ten'],
                                        $row['km_noidung'],
                                        // Sử dụng hàm date($format, $timestamp) để chuyển đổi ngày thành định dạng Việt Nam (ngày/tháng/năm)
                                        // Do hàm date() nhận vào là đối tượng thời gian, chúng ta cần sử dụng hàm strtotime()
                                        // để chuyển đổi từ chuỗi có định dạng 'yyyy-mm-dd' trong MYSQL thành đối tượng ngày tháng
                                        date('d/m/Y', strtotime($row['km_tungay'])),    //vd: '2019-04-25'
                                        date('d/m/Y', strtotime($row['km_denngay'])));  //vd: '2019-05-10'
                        }
                        $data[] = array(
                            'sp_ma' => $row['sp_ma'],
                            'sp_ten' => $row['sp_ten'],
                            // Sử dụng hàm number_format(số tiền, số lẻ thập phân, dấu phân cách số lẻ, dấu phân cách hàng nghìn)
                            // để định dạng số khi hiển thị trên giao diện. Vd: 15800000 -> format thành 15,800,000.00 vnđ
                            'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
                            'lsp_ten' => $row['lsp_ten'],
                            'nsx_ten' => $row['nsx_ten'],
                            'km_tomtat' => $km_tomtat,
                        );
                    }
                    // Test lấy dữ liệu
                    // var_dump($data);die;
                    // print_r($data);die;
                ?>
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                <table class="table table-bordered">
                    <tr>
                        <td>Mã sản phẩm</td>
                        <td>Tên sản phẩm</td>
                        <td>Giá sản phẩm</td>
                        <td>Loại sản phẩm</td>
                        <td>Nhà sản xuất</td>
                        <td>Khuyến mãi</td>
                        <td>Hành động</td>
                    </tr>
                    <?php foreach($data as $item):?>
                        <tr>
                            <td><?= $item['sp_ma']; ?></td>
                            <td><?= $item['sp_ten']; ?></td>
                            <td><?= $item['sp_gia']; ?></td>
                            <td><?= $item['lsp_ten']; ?></td>
                            <td><?= $item['nsx_ten']; ?></td>
                            <td><?= $item['km_tomtat']; ?></td>
                            <td>
                                <a href="edit.php?masp=<?= $item['sp_ma'] ?>" class="btn btn-outline-warning">Sửa</a>
                                <a href="delete.php?masp=<?= $item['sp_ma'] ?>" class="btn btn-outline-danger">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
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