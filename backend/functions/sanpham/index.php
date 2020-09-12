<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách sản phẩm</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <!-- DataTable CSS -->
    <link href="/duan-web02/assests/vendor/DataTables/datatables.css" type="text/css" rel="stylesheet"/>
    <link href="/duan-web02/assests/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.css" type="text/css" rel="stylesheet"/>
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
                <table id="tblSanpham" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Nhà sản xuất</th>
                            <th>Khuyến mãi</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $item):?>
                                <tr>
                                    <td><?= $item['sp_ma']; ?></td>
                                    <td><?= $item['sp_ten']; ?></td>
                                    <td><?= $item['sp_gia']; ?></td>
                                    <td><?= $item['lsp_ten']; ?></td>
                                    <td><?= $item['nsx_ten']; ?></td>
                                    <td><?= $item['km_tomtat']; ?></td>
                                    <td>
                                        <a href="edit.php?sp_ma=<?= $item['sp_ma'] ?>" class="btn btn-warning">Sửa</a>
                                        <button class="btn btn-danger btnDelete" data-sp_ma="<?= $item['sp_ma'] ?>">Xóa</button>
                                    </td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->

    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <!-- DataTable JS -->
    <script src="/duan-web02/assests/vendor/DataTables/datatables.min.js"></script>
    <script src="/duan-web02/assests/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/duan-web02/assests/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/duan-web02/assests/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <!-- SweetAlert JS -->
    <script src="/duan-web02/assests/vendor/sweetalert/sweetalert.min.js"></script>

    <script>
    $(document).ready(function() {
        // Xử lý DataTable
        $('#tblSanpham').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
        $('.btnDelete').click(function() {
            swal({
                title: "Bạn có chắc muốn xóa?",
                text: "Khi xóa sẽ không thể phục hồi!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    // debugger;
                if (willDelete) {
                    var sp_ma = $(this).data('sp_ma');
                    var url = "delete.php?sp_ma=" + sp_ma;
                    // Điều hướng sang trang xóa với REQUEST GET cùng tham số sp_ma=...
                    location.href = url;
                } else {
                    swal("Bạn hãy cẩn thận hơn!");
                }
                });
            })
        });
    </script>
</body>
</html>