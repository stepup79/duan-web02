<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    echo '<ul>';
    echo '<li>Đăng ký thành công</li>';
    echo "<li>Tên đăng nhập: {$username}</li>";
    echo "<li>Tên đăng nhập: {$password}</li>";
    echo "<li>Tên đăng nhập: {$fullname}</li>";
    echo '</ul>';


?>