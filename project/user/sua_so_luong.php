<?php
session_start();
include('includes/ket_noi.php');

// 1. Kiểm tra đăng nhập
if (!isset($_SESSION['ma_khach_hang'])) {
    header("Location: login.php");
    exit;
}

$ma_khach_hang = $_SESSION['ma_khach_hang'];

// 2. Lấy dữ liệu từ form
$maSP = isset($_POST['ma_san_pham']) ? $_POST['ma_san_pham'] : '';
$soLuong = isset($_POST['so_luong']) ? intval($_POST['so_luong']) : 0;

// 3. Nếu số lượng > 0 → Cập nhật
if ($soLuong > 0) {

    $query_Update = "
        UPDATE gio_hang 
        SET so_luong = $soLuong
        WHERE ma_khach_hang = '$ma_khach_hang'
          AND ma_san_pham = '$maSP'
    ";

    mysqli_query($conn, $query_Update);

} else {

    // 4. Nếu số lượng <= 0 → Xóa sản phẩm khỏi giỏ hàng
    $query_Delete = "
        DELETE FROM gio_hang
        WHERE ma_khach_hang = '$ma_khach_hang'
          AND ma_san_pham = '$maSP'
    ";

    mysqli_query($conn, $query_Delete);
}

// 5. Quay về trang giỏ hàng
header("Location: gio_hang.php");
exit;
?>