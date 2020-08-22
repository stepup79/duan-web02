<?php

    $nameproduct = $_POST['nameproduct'];
    // Xử lý chk Loaisanpham
    $Loaisanpham = [];
    if(isset($_POST['chkLoaisanpham'])) {
        $Loaisanpham = $_POST['chkLoaisanpham'];
    }
    // Xử lý chk Nhasanxuat
    $Nhasanxuat = [];
    if(isset($_POST['chkNhasanxuat'])) {
        $Nhasanxuat = $_POST['chkNhasanxuat'];
    }
    // Xử lý rad Khuyenmai
    $Khuyenmai = null;
    if(isset($_POST['radKhuyenmai'])) {
        $Khuyenmai = $_POST['radKhuyenmai'];
    }

    // Hiển thị
    echo '<ul>';

    echo "Tìm kiếm tên sản phẩm là: {$nameproduct}";
    if(!empty($Loaisanpham)) {
        $Loaisanpham_string = implode(',',$Loaisanpham);
        echo "<li>Loại sản phẩm: {$Loaisanpham_string}</li>";
    }
    if(!empty($Nhasanxuat)) {
        $Nhasanxuat_string = implode(',',$Nhasanxuat);
        echo "<li>Nhà sản xuất: {$Nhasanxuat_string}</li>";
    }
    if(!empty($Khuyenmai)) {
        echo "<li>Hình thức khuyến mãi: {$Khuyenmai}</li>";
    }

    echo '</ul>';

?>