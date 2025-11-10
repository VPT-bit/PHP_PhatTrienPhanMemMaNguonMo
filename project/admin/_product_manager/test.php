<?php
// --- Xử lý Xoá sản phẩm ---
if (isset($_GET['Ma_san_pham'])) {
    $id = $_GET['Ma_san_pham'];
    $del_sql = "DELETE FROM san_pham WHERE Ma_san_pham='$id'";
    $result_delete = mysqli_query($conn, $del_sql);
}

// --- Xử lý truy vấn ---



// --- Xử lý tìm kiếm ---
// $search = isset($_GET['search']) ? $_GET['search'] : "";

// --- Phân trang ---
// $limit = 5;
// $current_page = isset($_GET['p']) ? intval($_GET['p']) : 1;
// $start = ($current_page - 1) * $limit;

// --- Lấy tổng số sản phẩm (dùng cho phân trang) ---
// $total_query = "SELECT COUNT(*) as total FROM san_pham WHERE Ten_san_pham LIKE ?";
// $stmt = $conn->prepare($total_query);
// $search_like = "%$search%";
// $stmt->bind_param("s", $search_like);
// $stmt->execute();
// $result = $stmt->get_result();
// $total = $result->fetch_assoc()['total'];
// $stmt->close();

// $total_pages = ceil($total / $limit);

// --- Lấy dữ liệu sản phẩm ---
$query_all = "select * from san_pham";
$result_query_all = mysqli_query($conn, $del_sql);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        <form method="get" class="form-inline">
            <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary ml-2">Tìm</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên SP</th>
                        <th>Mã loại</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Mã NCC</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_query_all)) {
                    }
                    ?>
                    <tr>

                        <td><?php echo $row['Ma_san_pham']; ?></td>
                        <td><?php echo $row['Ten_san_pham']; ?></td>
                        <td><?php echo $row['Ma_loai']; ?></td>
                        <td><?php echo $row['So_luong']; ?></td>
                        <td><?php echo number_format($row['Don_gia'], 0); ?></td>
                        <td><?php echo $row['Ma_nha_cung_cap']; ?></td>
                        <td><?php echo $row['Mo_ta']; ?></td>
                        <td>
                            <a href="../admin/index.php?page=edit_product?id=<?php echo $row['Ma_san_pham']; ?>"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <a href="/BTL_cuoi_ki/project/admin/index.php?page=list_product?Ma_san_pham=<?php echo $row['Ma_san_pham']; ?>"
                                class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav>
            <!-- <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
                        <a class="page-link" href="?page=list_product&p=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul> -->
        </nav>
    </div>
</div>





<?php
// --- Xử lý Xoá sản phẩm ---
if (isset($_GET['Ma_san_pham'])) {
    $id = $_GET['Ma_san_pham'];
    $del_sql = "DELETE FROM san_pham WHERE Ma_san_pham='$id'";
    $result_delete = mysqli_query($conn, $del_sql);

    // Chuyển hướng để tránh xoá nhiều lần khi refresh
    header("Location: index.php?page=list_product");
    exit();
}

// --- Xử lý tìm kiếm ---
$search = isset($_GET['search']) ? $_GET['search'] : "";

// --- Lấy dữ liệu sản phẩm ---
// SỬA LỖI 1: Sử dụng biến $query_all thay vì $del_sql
$query_all = "SELECT * FROM san_pham";
$result_query_all = mysqli_query($conn, $query_all);

// Kiểm tra lỗi kết nối
if (!$result_query_all) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        <form method="get" class="form-inline">
            <input type="hidden" name="page" value="list_product">
            <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary ml-2">Tìm</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên SP</th>
                        <th>Mã loại</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Mã NCC</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_query_all)) {
                    ?>
                        <tr>
                            <td><?php echo $row['Ma_san_pham']; ?></td>
                            <td><?php echo $row['Ten_san_pham']; ?></td>
                            <td><?php echo $row['Ma_loai']; ?></td>
                            <td><?php echo $row['So_luong']; ?></td>
                            <td><?php echo number_format($row['Don_gia'], 0); ?> VNĐ</td>
                            <td><?php echo $row['Ma_nha_cung_cap']; ?></td>
                            <td><?php echo $row['Mo_ta']; ?></td>
                            <td>
                                <!-- SỬA LỖI 3: Sửa đường dẫn sửa sản phẩm -->
                                <a href="index.php?page=edit_product&id=<?php echo $row['Ma_san_pham']; ?>"
                                    class="btn btn-sm btn-warning">Sửa</a>
                                <!-- SỬA LỖI 4: Sửa đường dẫn xoá sản phẩm -->
                                <a href="index.php?page=list_product&Ma_san_pham=<?php echo $row['Ma_san_pham']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?')">Xoá</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>