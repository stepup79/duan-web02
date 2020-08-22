<?php

    $ten_tai_khoan = $_GET['username'];
    $mat_khau = $_GET['password'];

    if($ten_tai_khoan == 'admin' && $mat_khau == '123456') {
        echo "<h1>Chào mừng bạn {$ten_tai_khoan} đã đăng nhập thành công!</h1>";
      } else {
        echo "<h1>Đăng nhập Thất bại!</h1>";
      }    

?>