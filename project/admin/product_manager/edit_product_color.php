<?php
$id_detail = $_GET['id'];
$query_detail = "SELECT * FROM mau_sac WHERE Ma_mau = '$id_detail'";
$query_detail_result = mysqli_query($conn, $query_detail);

// Xử lý submit form
if (isset($_POST['submit'])) {

    $ten = trim($_POST['Ten_mau_sac']);

    //Kiểm tra trùng
    $query_duplicate = "SELECT Ma_mau, Ten_mau from mau_sac where Ten_mau = '$ten' and Ma_mau != '$id_detail'";
    $query_duplicate_result = mysqli_query($conn, $query_duplicate);
    $duplicate_result = mysqli_fetch_assoc($query_duplicate_result);

    if (mysqli_num_rows($query_duplicate_result) > 0) {
        echo '<div class="alert alert-danger">màu sắc đã tồn tại! Mã MS: ' . $duplicate_result['Ma_mau'] . '</div>';
    } else {
        $query_update_detail = "
    UPDATE mau_sac 
    SET 
        Ten_mau = '$ten'
    WHERE Ma_mau = '$id_detail' ";
        $result_update = mysqli_query($conn, $query_update_detail);
        if ($result_update) {
            echo '
          <script>
              setTimeout(function() {
                  window.location.href = "index_admin.php?page=edit_product_color&id=' . $id_detail . '";
              },);
          </script>';
        } else {
            echo "Lỗi cập nhật màu sắc: " . mysqli_error($conn);
        }
    }
}
?>

<form method="post" action="" enctype="multipart/form-data">
    <h3>Cập nhât màu sắc</h3>
    <?php while ($sp = mysqli_fetch_assoc($query_detail_result)) { ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <label>Mã màu sắc:</label>
                <input type="text" name="Ma_mau_sac" class="form-control" value="<?php echo $sp['Ma_mau']; ?>" readonly>
            </div>
            <div class="col-md-12">
                <label>Tên màu sắc:</label>
                <input type="text" name="Ten_mau_sac" class="form-control" required value="<?php echo $sp['Ten_mau'] ?>">
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc muốn cập nhật màu sắc này?')">Cập nhật màu sắc</button>
        <a href="index_admin.php?page=list_product_color" class="btn btn-secondary">Về trang màu sắc</a>
    <?php } ?>
</form>