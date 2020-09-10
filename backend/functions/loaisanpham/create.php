<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới loại sản phẩm</title>
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
                <h2>Thêm loại sản phẩm</h2>
                <form name="frmThem" id="frmThem" method="post" action="">                                                                                          
                    <div class="form-group">
                        <label for="lsp_ten">Loại sản phẩm</label>                                    
                        <input type="text" class="form-control" id="lsp_ten" name="lsp_ten">
                    </div>                                                
                    <div class="form-group">
                        <label for="lsp_mota">Mô tả</label>
                        <input type="text" class="form-control" id="lsp_mota" name="lsp_mota">
                    </div>
                    <button name="btnSave" id="btnSave" class="btn btn-primary">Lưu dữ liệu</button>      
                </form>                                                    
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->

    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

    <script>
    
    // $(document).ready(function() {
    //     $("#frmThem").validate({
    //         rules:{
    //             txt_httt_ten:{
    //                 required: true,
    //                 minlength: 3,
    //                 maxlength: 50
    //             },
    //         },
    //         messages:{
    //             txt_httt_ten:{
    //                 required: "Vui lòng nhập tên Hình thức sản phẩm",
    //                 minlength: "Tên hình thức sản phẩm phải có ít nhất 3 kí tự",
    //                 maxlength: "Tên hình thức sản phẩm phải nhỏ hơn 50 kí tự"
    //             },
    //         },

    //         errorElement: "em",
    //         errorPlacement: function(error, element) {
    //         // Thêm class `invalid-feedback` cho field đang có lỗi
    //         error.addClass("invalid-feedback");
    //         if (element.prop("type") === "checkbox") {
    //             error.insertAfter(element.parent("label"));
    //         } else {
    //             error.insertAfter(element);
    //         }
    //         },
    //         success: function(label, element) {},
    //         highlight: function(element, errorClass, validClass) {
    //         $(element).addClass("is-invalid").removeClass("is-valid");
    //         },
    //         unhighlight: function(element, errorClass, validClass) {
    //         $(element).addClass("is-valid").removeClass("is-invalid");
    //         }
    //     });
    // });
    
    </script>

    <?php
        // Truy vấn database
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../../../dbconnect.php');

        // 2. Nếu người dùng có bấm nút "Lưu dữ liệu" thì kiểm tra VALIDATE dữ liệu
        if(isset($_POST['btnSave'])) {
        // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
        $lsp_ten = $_POST['lsp_ten'];
        $lsp_mota = $_POST['lsp_mota'];

        // Kiểm tra ràng buộc dữ liệu (Validation)
        // Tạo biến lỗi để chứa thông báo lỗi
        $errors = [];
        
        // Validate tên Hình thức sản phẩm   
        // required
            if (empty($lsp_ten)) {
                $errors['lsp_ten'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $lsp_ten,
                'msg' => 'Vui lòng nhập Loại sản phẩm'
                ];
            }
        // minlength 3
            if (!empty($lsp_ten) && strlen($lsp_ten) < 3) {
                $errors['lsp_ten'][] = [
                'rule' => 'minlength',
                'rule_value' => 3,
                'value' => $lsp_ten,
                'msg' => 'Loại sản phẩm phải có ít nhất 3 ký tự'
                ];
            }
        // maxlength 50
            if (!empty($lsp_ten) && strlen($lsp_ten) > 50) {
                $errors['lsp_ten'][] = [
                'rule' => 'maxlength',
                'rule_value' => 50,
                'value' => $lsp_ten,
                'msg' => 'Tên loại sản phẩm không được vượt quá 50 ký tự'
                ];
            }
        }
    ?>

        <!-- Nếu có lỗi VALIDATE dữ liệu thì hiển thị ra màn hình 
        - Sử dụng thành phần (component) Alert của Bootstrap
        - Mỗi một lỗi hiển thị sẽ in theo cấu trúc Danh sách không thứ tự UL > LI
        -->
        <?php if (
            isset($_POST['btnSave'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
            && isset($errors)         // Nếu biến $errors có tồn tại
            && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
        ) : ?>
          <div id="errors-container" class="alert alert-danger face my-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <ul>
                <?php foreach ($errors as $fields) : ?>
                    <?php foreach ($fields as $field) : ?>
                    <li><?php echo $field['msg']; ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    <?php
    // Khi người dùng nhấn button Lưu
    if(isset($_POST['btnSave']) && (!isset($errors) || (empty($errors))) 
    )   {
        // VALIDATE dữ liệu đã hợp lệ
        // Thực thi câu lệnh SQL QUERY
        // 2. Chuẩn bị QUERY
        $sql = "INSERT INTO `loaisanpham`(lsp_ten, lsp_mota) VALUES (N'$lsp_ten',N'$lsp_mota');";

        // 3. Thực thi
        mysqli_query($conn, $sql);
        // Đóng kết nối
        mysqli_close($conn);

        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
        // Điều hướng bằng Javascript
        echo '<script>location.href = "index.php";</script>';
        }
    ?>

</body>
</html>