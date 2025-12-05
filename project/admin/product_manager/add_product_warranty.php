<?php
// --- Tạo mã BH tự động ---
$query_max = "SELECT MAX(CAST(SUBSTRING(Ma_bao_hanh, 3) AS UNSIGNED)) AS max_id FROM bao_hanh";
$result_max = mysqli_query($conn, $query_max);
$row_max = mysqli_fetch_assoc($result_max);

$new_bh = 'BH' . ($row_max['max_id'] + 1);

// Xử lý submit form
if (isset($_POST['submit'])) {
    $ten_bh = trim($_POST['Thoi_gian']);
    $dieu_kien = trim($_POST['Dieu_kien']);
    //Kiểm tra trùng
    $query_duplicate = "SELECT Ma_bao_hanh, Thoi_gian from bao_hanh where Thoi_gian = '$ten_bh'";
    $query_duplicate_result = mysqli_query($conn, $query_duplicate);
    $duplicate_result = mysqli_fetch_assoc($query_duplicate_result);

    if (mysqli_num_rows($query_duplicate_result) > 0) {
        echo '<div class="alert alert-danger">Bảo hành đã tồn tại! Mã BH: ' . $duplicate_result['Ma_bao_hanh'] . '</div>';
    } else {
        $insert = "INSERT INTO bao_hanh (Ma_bao_hanh, Thoi_gian, Dieu_kien)
               VALUES ('$new_bh', '$ten_bh', '$dieu_kien')";

        if (mysqli_query($conn, $insert)) {
            echo '<div class="alert alert-success">Thêm bảo hành thành công! Mã BH: ' . $new_bh . '</div>';
        } else {
            echo '<div class="alert alert-danger">Lỗi: ' . mysqli_error($conn) . '</div>';
        }
    }
}
?>

<h3>Thêm bảo hành mới</h3>
<form action="" method="post" enctype="multipart/form-data" class="mt-3">
    <div class="row mb-3">
        <div class="col-md-12">
            <label>Mã bảo hành:</label>
            <input type="text" name="Ma_bao_hanh" class="form-control" value="<?php echo $new_bh; ?>" readonly>
        </div>
        <div class="col-md-12">
            <label>Thời gian:</label>
            <input type="number" min="0" onkeypress="if (event.key === '-' || event.key === '+') event.preventDefault();" name="Thoi_gian" class="form-control" required value="<?php echo isset($_POST['Thoi_gian']) ? $_POST['Thoi_gian'] : ''; ?>">
        </div>
        <div class="col-md-12">
            <label>Điều kiện:</label>
            <input type="text" name="Dieu_kien" class="form-control" required value="<?php echo isset($_POST['Dieu_kien']) ? $_POST['Dieu_kien'] : ''; ?>">
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Thêm bảo hành</button>
    <a href="index_admin.php?page=list_product_warranty" class="btn btn-secondary">Về trang bảo hành</a>
</form>