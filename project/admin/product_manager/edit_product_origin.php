<?php
$id_detail = $_GET['id'];
$query_detail = "SELECT * FROM xuat_xu WHERE Ma_xuat_xu = '$id_detail'";
$query_detail_result = mysqli_query($conn, $query_detail);

// Xử lý submit form
if (isset($_POST['submit'])) {

    $ten = trim($_POST['Ten_xuat_xu']);

    //Kiểm tra trùng
    $query_duplicate = "SELECT Ma_xuat_xu, Ten_xuat_xu from xuat_xu where Ten_xuat_xu = '$ten' and Ma_xuat_xu != '$id_detail'";
    $query_duplicate_result = mysqli_query($conn, $query_duplicate);
    $duplicate_result = mysqli_fetch_assoc($query_duplicate_result);

    if (mysqli_num_rows($query_duplicate_result) > 0) {
        echo '<div class="alert alert-danger">xuất xứ đã tồn tại! Mã LSP: ' . $duplicate_result['Ma_xuat_xu'] . '</div>';
    } else {
        $query_update_detail = "
    UPDATE xuat_xu 
    SET 
        Ten_xuat_xu = '$ten'
    WHERE Ma_xuat_xu = '$id_detail' ";
        $result_update = mysqli_query($conn, $query_update_detail);
        if ($result_update) {
            echo '
          <script>
              setTimeout(function() {
                  window.location.href = "index_admin.php?page=edit_product_origin&id=' . $id_detail . '";
              },);
          </script>';
        } else {
            echo "Lỗi cập nhật xuất xứ: " . mysqli_error($conn);
        }
    }
}
?>

<form method="post" action="" enctype="multipart/form-data">
    <h3>Cập nhât xuất xứ</h3>
    <?php while ($sp = mysqli_fetch_assoc($query_detail_result)) { ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <label>Mã xuất xứ:</label>
                <input type="text" name="Ma_xuat_xu_san_pham" class="form-control" value="<?php echo $sp['Ma_xuat_xu']; ?>" readonly>
            </div>
            <div class="col-md-12">
                <label>Tên xuất xứ:</label>
                <input type="text" name="Ten_xuat_xu" class="form-control" required value="<?php echo $sp['Ten_xuat_xu'] ?>">
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc muốn cập nhật xuất xứ này?')">Cập nhật xuất xứ</button>
        <a href="index_admin.php?page=list_product_origin" class="btn btn-secondary">Về trang xuất xứ</a>
    <?php } ?>
</form>