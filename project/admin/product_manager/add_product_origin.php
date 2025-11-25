<?php
// --- Tạo mã SP tự động ---
$query_max = "SELECT MAX(CAST(SUBSTRING(Ma_xuat_xu, 2) AS UNSIGNED)) AS max_id FROM xuat_xu";
$result_max = mysqli_query($conn, $query_max);
$row_max = mysqli_fetch_assoc($result_max);

$new_XX = 'X' . ($row_max['max_id'] + 1);

// Xử lý submit form
if (isset($_POST['submit'])) {
    $ten_XX = trim($_POST['Ten_xuat_xu']);
    //Kiểm tra trùng
    $query_duplicate = "SELECT Ma_xuat_xu, Ten_xuat_xu from xuat_xu where Ten_xuat_xu = '$ten_XX'";
    $query_duplicate_result = mysqli_query($conn, $query_duplicate);
    $duplicate_result = mysqli_fetch_assoc($query_duplicate_result);

    if (mysqli_num_rows($query_duplicate_result) > 0) {
        echo '<div class="alert alert-danger">Xuất xứ đã tồn tại! Mã XX: ' . $duplicate_result['Ma_xuat_xu'] . '</div>';
    } else {
        $insert = "INSERT INTO xuat_xu (Ma_xuat_xu, Ten_xuat_xu)
               VALUES ('$new_XX', '$ten_XX')";

        if (mysqli_query($conn, $insert)) {
            echo '<div class="alert alert-success">Thêm Xuất xứ thành công! Mã XX: ' . $new_XX . '</div>';
        } else {
            echo '<div class="alert alert-danger">Lỗi: ' . mysqli_error($conn) . '</div>';
        }
    }
}
?>

<h3>Thêm Xuất xứ mới</h3>
<form action="" method="post" enctype="multipart/form-data" class="mt-3">
    <div class="row mb-3">
        <div class="col-md-12">
            <label>Mã Xuất xứ:</label>
            <input type="text" name="Ma_xuat_xu" class="form-control" value="<?php echo $new_XX; ?>" readonly>
        </div>
        <div class="col-md-12">
            <label>Tên Xuất xứ:</label>
            <input type="text" name="Ten_xuat_xu" class="form-control" required value="<?php echo isset($_POST['Ten_xuat_xu']) ? $_POST['Ten_xuat_xu'] : ''; ?>">
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Thêm Xuất xứ</button>
    <a href="index_admin.php?page=list_product_origin" class="btn btn-secondary">Về trang Xuất xứ</a>
</form>