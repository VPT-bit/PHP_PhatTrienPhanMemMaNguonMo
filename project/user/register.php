<?php 
$page_title = 'Register';
include ('includes/header.php');
include('includes/ket_noi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Lấy dữ liệu từ form
    $ten_khach_hang = $_POST["ten_khach_hang"];
    $phai = $_POST["phai"];
    $dia_chi = $_POST["dia_chi"];
    $dien_thoai = $_POST["dien_thoai"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // 2. Tạo mã khách hàng tự động
    $ma_khach_hang = uniqid('KH');

    // 3. Tạo ngày tạo tài khoản
    $ngay_tao = date("Y-m-d H:i:s");

    // 4. SQL thêm khách hàng
    $sql_kh = "
        INSERT INTO khach_hang (Ma_khach_hang, Ten_khach_hang, Phai, Dia_chi, Dien_thoai, Email)
        VALUES ('$ma_khach_hang', '$ten_khach_hang', '$phai', '$dia_chi', '$dien_thoai', '$email')
    ";

    // 5. SQL thêm tài khoản với quyền Khách hàng Q3
    $ma_quyen = 'Q3';
    $trang_thai = 1;
    $sql_tk = "
        INSERT INTO tai_khoan (Ten_dang_nhap, Mat_khau, Ma_quyen, Ma_khach_hang, Trang_thai, Ngay_tao)
        VALUES ('$username', '$password', '$ma_quyen', '$ma_khach_hang', '$trang_thai', '$ngay_tao')
    ";

    // 6. Thực hiện transaction
    mysqli_begin_transaction($conn);
    try {
        mysqli_query($conn, $sql_kh);
        mysqli_query($conn, $sql_tk);
        mysqli_commit($conn);

        echo "<div class='alert alert-success'>Đăng ký thành công! <a href='login.php'>Đăng nhập</a></div>";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<div class='alert alert-danger'>Lỗi: " . $e->getMessage() . "</div>";
    }
}
?>

<form method="POST">
    <h2>Đăng ký</h2>
    Họ và tên: <input type="text" name="ten_khach_hang" required><br>
    Giới tính:
    <select name="phai">
        <option value="1">Nam</option>
        <option value="0">Nữ</option>
    </select><br>
    Địa chỉ: <input type="text" name="dia_chi" required><br>
    Điện thoại: <input type="text" name="dien_thoai" required><br>
    Email: <input type="email" name="email" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Đăng ký</button>
</form>

<?php include ('includes/footer.html'); ?>