<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục nhà sản xuất</title>
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
                <h2>Danh sách Nhà sản xuất</h2>
                <?php
                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    // include_once(__DIR__ . '/dbconnect.php');

                    // 2. Chuẩn bị QUERY
                    $sql ="SELECT nsx_ma, nsx_ten FROM `nhasanxuat`";

                    // 3. Thực thi QUERY
                    $result = mysqli_query($conn, $sql);

                    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array(
                            'nsx_ma' => $row['nsx_ma'],
                            'nsx_ten' => $row['nsx_ten'],
                        );
                    }
                    // var_dump($data);die;
                    // print_r($data);die;
                ?>
                    <a href="create.php" class="btn btn-primary">Thêm mới</a>
                    <table id="tblNhasanxuat" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã nhà sản xuất</th>
                                <th>Tên nhà sản xuất</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <?php foreach($data as $item): ?>
                        <tr>
                            <!-- Dấu '=' tương ứng với php echo -->
                            <td><?php echo $item['nsx_ma']; ?></td>
                            <td><?= $item['nsx_ten']; ?></td>
                            <td>
                                <a href="edit.php?nsx_ma=<?= $item['nsx_ma'] ?>" class="btn btn-outline-warning">Sửa</a>
                                <button class="btn btn-danger btnDelete" data-nsx_ma="<?= $item['nsx_ma'] ?>">Xóa</button>
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
        $('#tblNhasanxuat').DataTable( {
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
                    var nsx_ma = $(this).data('nsx_ma');
                    var url = "delete.php?nsx_ma=" + nsx_ma;
                    // Điều hướng sang trang xóa với REQUEST GET cùng tham số nsx_ma=...
                    location.href = url;
                } else {
                    swal("Bạn hãy cẩn thận hơn!");
                }
                });
            })
    })
    </script>
</body>
</html>