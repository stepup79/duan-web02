<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form name="frmTimkiem" id="frmTimkiem" method="POST" action="xu-ly-tim-kiem.php">
    <h3>Tên sản phẩm</h3>
        <input type="text" name="nameproduct" id="nameproduct"/><br/>
    <h3>Loại sản phẩm</h3>
        <input type="checkbox" name="chkLoaisanpham[]" 
            id="chkLoaisanpham_1" value="1"/> Máy tính bảng <br />
        <input type="checkbox" name="chkLoaisanpham[]" 
            id="chkLoaisanpham_2" value="2"/> Máy tính xách tay <br />
        <input type="checkbox" name="chkLoaisanpham[]" 
            id="chkLoaisanpham_3" value="3"/> Điện thoại <br />
        <input type="checkbox" name="chkLoaisanpham[]" 
            id="chkLoaisanpham_4" value="4"/> Linh phụ kiện <br />
    <h3>Nhà sản xuất</h3>
        <input type="checkbox" name="chkNhasanxuat[]" 
            id="chkNhasanxuat_1" value="1"/> Apple <br />
        <input type="checkbox" name="chkNhasanxuat[]" 
            id="chkNhasanxuat_2" value="2"/> Samsung <br />
        <input type="checkbox" name="chkNhasanxuat[]" 
            id="chkNhasanxuat_3" value="3"/> HTC <br />
        <input type="checkbox" name="chkNhasanxuat[]" 
            id="chkNhasanxuat_4" value="4"/> Noia <br />
    <h3>Khuyến mãi</h3>
        <input type="radio" name="radKhuyenmai" id="radKhuyenmai_1"
            value="trungthu"/>Trung thu<br/>
        <input type="radio" name="radKhuyenmai" id="radKhuyenmai_2"
            value="sinhnhat"/>Nhân dịp sinh nhật<br/>

    <!-- <input type="submit" name="btnTimkiem" id="btnTimkiem" value="Tìm kiếm"/> -->
    <button name="btnTimkiem" id="btnTimkiem">Tìm kiếm</button>
</form>
<div class="ketqua" border=1></div>

</body>
</html>