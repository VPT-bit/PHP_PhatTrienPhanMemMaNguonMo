<?php
session_start();
include('includes/ket_noi.php');

// 1. Kiểm tra đăng nhập
if (!isset($_SESSION['ma_khach_hang'])) {
    echo "Chưa đăng nhập";
    exit;
}

$ma_khach_hang = $_SESSION['ma_khach_hang'];

// 2. Kiểm tra mã sản phẩm gửi lên
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Không có mã sản phẩm!";
    exit;
}

$maSP = $_GET['id'];

// 3. Kiểm tra sản phẩm đã có trong giỏ hay chưa
$query_check = "
    SELECT so_luong 
    FROM gio_hang 
    WHERE ma_khach_hang = '$ma_khach_hang' 
      AND ma_san_pham = '$maSP'
";
$result_check = mysqli_query($conn, $query_check);

// 4. Nếu đã tồn tại → tăng số lượng
if (mysqli_num_rows($result_check) > 0) {

    $query_update = "
        UPDATE gio_hang
        SET so_luong = so_luong + 1
        WHERE ma_khach_hang = '$ma_khach_hang'
          AND ma_san_pham = '$maSP'
    ";

    if (!mysqli_query($conn, $query_update)) {
        echo "❌ Lỗi cập nhật giỏ hàng: " . mysqli_error($conn);
        exit;
    }

} else {

    // 5. Nếu chưa có → thêm mới vào giỏ hàng
    $query_insert = "
        INSERT INTO gio_hang(ma_khach_hang, ma_san_pham, so_luong)
        VALUES ('$ma_khach_hang', '$maSP', 1)
    ";

    if (!mysqli_query($conn, $query_insert)) {
        echo "❌ Lỗi thêm mới giỏ hàng: " . mysqli_error($conn);
        exit;
    }
}

// 6. Thông báo thành công
echo "<h3>✔ Đã thêm sản phẩm vào giỏ hàng!</h3>";

/* Nếu muốn quay về trang trước:
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
*/
?>