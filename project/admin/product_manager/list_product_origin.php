<?php
// --- Xoá xuất xứ ---
if (isset($_GET['Ma_xuat_xu'])) {
    $id = $_GET['Ma_xuat_xu'];
    // Lấy tên ảnh của sản phẩm
    $query_image = "SELECT Hinh_anh FROM san_pham WHERE Ma_xuat_xu = '$id'";
    $result_query_image = mysqli_query($conn, $query_image);
    while ($row_image = mysqli_fetch_assoc($result_query_image)) {
        $file_name = $row_image['Hinh_anh'];
        $path = __DIR__ . "/../_images/" . $file_name;
        if (file_exists($path) && !empty($file_name)) {
            unlink($path); // xóa file
        }
    }

    // Xóa xuất xứ
    $delete_product_cat = "DELETE FROM xuat_xu WHERE Ma_xuat_xu='$id'";
    if (mysqli_query($conn, $delete_product_cat)) {
        echo '<div id="alert-box" class="alert alert-success"
          style="position:fixed; top:20px; right:20px; z-index:9999;">
          </div>
          <script>
              setTimeout(function() {
                  document.getElementById("alert-box").remove();
                  window.location.href = "index_admin.php?page=list_product_origin";
              });
          </script>';
    } else {
        echo "Lỗi xóa xuất xứ: " . mysqli_error($conn);
    }
}

// --- Tìm dữ liệu xuất xứ ---
$search_result = isset($_GET['search']) ? trim($_GET['search']) : '';
$where_search = '';
if ($search_result != '') {
    $where_search = "WHERE Ten_xuat_xu LIKE '%$search_result%'";
}

// --- Phân trang ---
$rows_per_page = 5;
$current_page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
$start = ($current_page - 1) * $rows_per_page;

// Lấy dữ liệu để hiển thị
$query_to_show = "
SELECT * FROM xuat_xu
$where_search
ORDER BY CAST(SUBSTRING(Ma_xuat_xu, 2) AS UNSIGNED) ASC
LIMIT $start, $rows_per_page
";
$result_to_show = mysqli_query($conn, $query_to_show);

// Lấy tổng số dòng để tính tổng số trang
$query_count = "SELECT * FROM xuat_xu $where_search";
$result_count = mysqli_query($conn, $query_count);
$total_rows = mysqli_num_rows($result_count);
$total_pages = ceil($total_rows / $rows_per_page);

?>


<div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap">
    <h6 class="m-0 font-weight-bold text-primary">Danh sách xuất xứ</h6>
    <form action="index_admin.php" method="get">
        <input type="hidden" name="page" value="list_product_origin">
        <!-- Input tìm kiếm -->
        <div class="input-group mb-3" style="max-width: 400px; margin: 0 auto;">
            <input type="text" name="search" class="form-control" placeholder="Tìm tên xuất xứ..." value="<?php echo trim($search_result); ?>">
            <button class="btn btn-primary" type="submit">Tìm</button>
        </div>
    </form>
    <a href="index_admin.php?page=add_product_origin" class="btn btn-success">Thêm xuất xứ</a>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã xuất xứ</th>
                    <th>Tên xuất xứ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = $start + 1;
                while ($row = mysqli_fetch_assoc($result_to_show)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['Ma_xuat_xu']; ?></td>
                        <td><?php echo $row['Ten_xuat_xu']; ?></td>
                        <td>
                            <a href="index_admin.php?page=edit_product_origin&id=<?php echo $row['Ma_xuat_xu']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                            <a href="index_admin.php?page=list_product_origin&Ma_xuat_xu=<?php echo $row['Ma_xuat_xu']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xoá xuất xứ này?')">Xoá</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                } ?>
            </tbody>
        </table>
        <!-- Phân trang với Bootstrap -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <!-- Nút Previous -->
                <li class="page-item <?php if ($current_page <= 1) echo 'disabled'; ?>">
                    <?php
                    $prev_page = $current_page - 1;
                    $prev_link = "index_admin.php?page=list_product_origin&page_num=$prev_page";
                    if ($search_result != '') $prev_link .= "&search=" . $search_result;
                    ?>
                    <a class="page-link" href="<?php echo $prev_link; ?>" tabindex="-1">Trước</a>
                </li>

                <!-- Các số trang -->
                <?php
                for ($p = 1; $p <= $total_pages; $p++) {
                    $link = "index_admin.php?page=list_product_origin&page_num=$p";
                    if ($search_result != '') $link .= "&search=" . $search_result;

                    $active = ($p == $current_page) ? 'active' : '';
                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . $link . '">' . $p . '</a></li>';
                }
                ?>

                <!-- Nút Next -->
                <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
                    <?php
                    $next_page = $current_page + 1;
                    $next_link = "index_admin.php?page=list_product_origin&page_num=$next_page";
                    if ($search_result != '') $next_link .= "&search=" . $search_result;
                    ?>
                    <a class="page-link" href="<?php echo $next_link; ?>">Sau</a>
                </li>

            </ul>
        </nav>

    </div>
</div>