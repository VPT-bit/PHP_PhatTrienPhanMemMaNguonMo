<?php
session_start();
include_once('includes/ket_noi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Lấy dữ liệu từ form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 2. SQL lấy thông tin tài khoản
    $sql = "SELECT * FROM tai_khoan WHERE Ten_dang_nhap = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // 3. Kiểm tra mật khẩu
    if ($user && password_verify($password, $user["Mat_khau"])) {
        // Lưu thông tin vào session
        $_SESSION["username"] = $user["Ten_dang_nhap"];
        $_SESSION["ma_quyen"] = $user["Ma_quyen"];
        $_SESSION["ma_khach_hang"] = $user["Ma_khach_hang"];
        $_SESSION["Ma_nhan_vien"] = $user["Ma_nhan_vien"];
        // 4. Chuyển hướng theo quyền
        if ($user["Ma_quyen"] == 'Q1') {
            header("Location: index.php"); // Admin
        } elseif ($user["Ma_quyen"] == 'Q2') {
            header("Location: index.php"); // Nhân viên
        } else {
            header("Location: index.php"); // Khách hàng
        }
        exit();
    } else {
        echo "<div class='alert alert-danger'>Sai username hoặc password!</div>";
    }
}
?>

<form method="POST">
    <h2>Đăng nhập</h2>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Đăng nhập</button>
</form>

<a href="./index.php">Trang chủ</a>