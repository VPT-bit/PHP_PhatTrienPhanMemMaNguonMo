<?php
// --- Tạo mã SP tự động ---
$query_max = "SELECT MAX(CAST(SUBSTRING(Ma_mau, 2) AS UNSIGNED)) AS max_id FROM mau_sac";
$result_max = mysqli_query($conn, $query_max);
$row_max = mysqli_fetch_assoc($result_max);

$new_MS = 'M' . ($row_max['max_id'] + 1);

// Xử lý submit form
if (isset($_POST['submit'])) {
    $ten_MS = trim($_POST['Ten_mau_sac']);
    //Kiểm tra trùng
    $query_duplicate = "SELECT Ma_mau, Ten_mau from mau_sac where Ten_mau = '$ten_MS'";
    $query_duplicate_result = mysqli_query($conn, $query_duplicate);
    $duplicate_result = mysqli_fetch_assoc($query_duplicate_result);

    if (mysqli_num_rows($query_duplicate_result) > 0) {
        echo '<div class="alert alert-danger">màu đã tồn tại! Mã MM: ' . $duplicate_result['Ma_mau'] . '</div>';
    } else {
        $insert = "INSERT INTO mau_sac (Ma_mau, Ten_mau)
               VALUES ('$new_MS', '$ten_MS')";

        if (mysqli_query($conn, $insert)) {
            echo '<div class="alert alert-success">Thêm màu thành công! Mã MS: ' . $new_MS . '</div>';
        } else {
            echo '<div class="alert alert-danger">Lỗi: ' . mysqli_error($conn) . '</div>';
        }
    }
}
?>

<h3>Thêm màu mới</h3>
<form action="" method="post" enctype="multipart/form-data" class="mt-3">
    <div class="row mb-3">
        <div class="col-md-12">
            <label>Mã màu:</label>
            <input type="text" name="Ma_mau_sac" class="form-control" value="<?php echo $new_MS; ?>" readonly>
        </div>
        <div class="col-md-12">
            <label>Tên màu:</label>
            <input type="text" name="Ten_mau_sac" class="form-control" required value="<?php echo isset($_POST['Ten_mau_sac']) ? $_POST['Ten_mau_sac'] : ''; ?>">
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Thêm màu</button>
    <a href="index_admin.php?page=list_product_color" class="btn btn-secondary">Về trang màu</a>
</form>