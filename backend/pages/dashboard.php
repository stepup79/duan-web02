<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
    
    <!-- header -->
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- End header -->

    <div class="container">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>
            <!-- End sidebar -->
            <div class="col-md-8">
                <h2>Bảng tin DASHBOARD</h2>
                <!-- Start content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-primary mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoSanPham_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số mặt hàng</div>                            
                                </div>
                            </div>
                            <button class="btn btn-primary form-control" id="refreshBaoCaoSanPham">Refresh dữ liệu</button>
                        </div> <!-- Tổng số mặt hàng -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-success mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoKhachHang_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số khách hàng</div>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm form-control" id="refreshBaoCaoKhachHang">Refresh dữ liệu</button>
                            </div> <!-- Tổng số khách hàng -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-warning mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoDonHang_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số đơn hàng</div>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-sm form-control" id="refreshBaoCaoDonHang">Refresh dữ liệu</button>
                            </div> <!-- Tổng số đơn hàng -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-danger mb-2">
                                <div class="card-body pb-0">
                                    <div class="text-value" id="baocaoGopY_SoLuong">
                                        <h1>0</h1>
                                    </div>
                                    <div>Tổng số các góp ý</div>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm form-control" id="refreshBaoCaoGopY">Refresh dữ liệu</button>
                        </div> <!-- Tổng số góp ý -->

                    </div>
                </div>
                <!-- End content -->
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <!-- End footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- Liên kết thư viện ChartJS -->
    <script src="/duan-web02/assets/vendor/Chart.js/Chart.min.js"></script>

    <script>
        $(document).ready(function() {
            // ----------------- Tổng số mặt hàng --------------------------
            function getDuLieuBaoCaoTongSoMatHang() {
                $.ajax('/duan-web02/backend/api/baocao-tongsomathang.php', {
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                    $('#baocaoSanPham_SoLuong').html(htmlString);
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoSanPham_SoLuong').html(htmlString);
                }
                });
            }
            $('#refreshBaoCaoSanPham').click(function(event) {
                event.preventDefault();
                getDuLieuBaoCaoTongSoMatHang();
            });
            // ----------------- Tổng số khách hàng --------------------------
            function getDuLieuBaoCaoTongSoKhachHang() {
                $.ajax('/duan-web02/backend/api/baocao-tongsokhachhang.php', {
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                    $('#baocaoKhachHang_SoLuong').html(htmlString);
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoKhachHang_SoLuong').html(htmlString);
                }
                });
            }
            $('#refreshBaoCaoKhachHang').click(function(event) {
                event.preventDefault();
                getDuLieuBaoCaoTongSoKhachHang();
            });
            // ----------------- Tổng số đơn hàng --------------------------
            function getDuLieuBaoCaoTongSoDonHang() {
                $.ajax('/duan-web02/backend/api/baocao-tongsodonhang.php', {
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                    $('#baocaoDonHang_SoLuong').html(htmlString);
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoDonHang_SoLuong').html(htmlString);
                }
                });
            }
            $('#refreshBaoCaoDonHang').click(function(event) {
                event.preventDefault();
                getDuLieuBaoCaoTongSoDonHang();
            });
            // ----------------- Tổng số Góp ý --------------------------
            function getDuLieuBaoCaoTongSoGopY() {
                $.ajax('/duan-web02/backend/api/baocao-tongsogopy.php', {
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                    $('#baocaoGopY_SoLuong').html(htmlString);
                },
                error: function() {
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#baocaoGopY_SoLuong').html(htmlString);
                }
                });
            }
            $('#refreshBaoCaoGopY').click(function(event) {
                event.preventDefault();
                getDuLieuBaoCaoTongSoGopY();
            });
            // Mới mở web (khi trang web load xong)
            // thì sẽ gọi lập tức một số hàm AJAX gọi API lấy dữ liệu
            getDuLieuBaoCaoTongSoMatHang();
            getDuLieuBaoCaoTongSoKhachHang();
            getDuLieuBaoCaoTongSoDonHang();
            getDuLieuBaoCaoTongSoGopY();
            // renderChartThongKeLoaiSanPham();
        })
    </script>
</body>
</html>