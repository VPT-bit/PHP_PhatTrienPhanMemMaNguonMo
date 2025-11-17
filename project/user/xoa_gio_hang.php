<?php
session_start();
include('includes/ket_noi.php');

// 1. Kiểm tra đăng nhập
if (!isset($_SESSION['ma_khach_hang'])) {
    echo "Chưa đăng nhập!";
    exit;
}

$ma_khach_hang = $_SESSION['ma_khach_hang'];

// 2. Kiểm tra mã sản phẩm
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Thiếu mã sản phẩm!";
    exit;
}

$maSP = $_GET['id'];

// 3. Xóa sản phẩm khỏi giỏ hàng
$query_Delete = "
    DELETE FROM gio_hang
    WHERE ma_khach_hang = '$ma_khach_hang'
      AND ma_san_pham = '$maSP'
";

if (mysqli_query($conn, $query_Delete)) {
    echo "<h3>✔ Đã xóa sản phẩm khỏi giỏ hàng!</h3>";
} else {
    echo "❌ Lỗi khi xóa sản phẩm: " . mysqli_error($conn);
}

?>