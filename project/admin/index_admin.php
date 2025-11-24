<?php
session_start(); // Bắt đầu session
include('_includes_admin/config.php');
$page = isset($_GET['page']) ? $_GET['page'] : null;
// Nếu chưa có page, redirect sang dashboard
if (!$page) {
    header('Location: index_admin.php?page=list_bill');
    exit();
}
// --- Mảng ánh xạ page => file ---
$pages = [
    'list_product' => 'product_manager/list_product.php',
    'add_product' => 'product_manager/add_product.php',
    'edit_product' => 'product_manager/edit_product.php',
    'list_product_category' => 'product_manager/list_product_category.php',
    'add_product_category' => 'product_manager/add_product_category.php',
    'edit_product_category' => 'product_manager/edit_product_category.php',
    'list_product_brand' => 'product_manager/list_product_brand.php',
    'add_product_brand' => 'product_manager/add_product_brand.php',
    'edit_product_brand' => 'product_manager/edit_product_brand.php',
    'list_user_customer' => 'user_manager/list_user_customer.php',
    'add_user_customer' => 'user_manager/add_user_customer.php',
    'edit_user_customer' => 'user_manager/edit_user_customer.php',
    'list_user_employee' => 'user_manager/list_user_employee.php',
    'add_user_employee' => 'user_manager/add_user_employee.php',
    'edit_user_employee' => 'user_manager/edit_user_employee.php',
    'list_bill' => 'revenue_manager/list_bill.php',
    'list_bill_detail' => 'revenue_manager/list_bill_detail.php',
    'add_bill' => 'revenue_manager/add_bill.php',
    'list_authorization' => 'authorization_acount_manager/list_authorization.php',
    'list_account' => 'authorization_acount_manager/list_account.php',
    'edit_account' => 'authorization_acount_manager/edit_account.php',
    'add_account_customer' => 'authorization_acount_manager/add_account_customer.php',
    'add_account_employee' => 'authorization_acount_manager/add_account_employee.php',
    'dashboard' => 'dashboard_manager/dashboard.php'
];
// Kiểm tra page hợp lệ
$isValidPage = isset($pages[$page]) && file_exists($pages[$page]);
$q2_allowed_pages = [
    'list_bill',
    'list_bill_detail',
    'add_bill',
    'list_account',
    'add_account_customer'
];

// Kiểm tra đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    include('../user/login.php'); // chưa đăng nhập → bắt login
    exit();
}

// Kiểm tra quyền
if (!isset($_SESSION['ma_quyen'])) {
    include('./_includes_admin/index_404.php');
    exit();
}

if ($_SESSION['ma_quyen'] == 'Q2') {
    // Q2 chỉ được phép truy cập các page trong danh sách
    if (!in_array($page, $q2_allowed_pages)) {
        include('./_includes_admin/index_404.php');
        exit();
    }
} elseif ($_SESSION['ma_quyen'] != 'Q1') {
    // Những quyền khác ngoài Q1 và Q2 → 404
    include('./_includes_admin/index_404.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="_includes_admin/style_admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../_assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="../_assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../_assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Nếu có dashboard dùng biểu đồ -->
    <script src="../_assets/admin/custom_js/chart.js"></script>

    <!-- jQuery UI cho autocomplete -->
    <link rel="stylesheet" href="../_assets/admin/custom_js/jquery-ui.css">
    <script src="../_assets/admin/custom_js/jquery-ui.min.js"></script>
</head>
<?php if ($isValidPage): ?>

    <body>
        <!-- header (start) -->
        <div id="header">
            <?php include('_includes_admin/header.php') ?>
        </div>
        <!-- header (end) -->

        <!-- main content (Start) -->
        <div id="main-container">
            <!-- Sidebar (start) -->
            <div id="sidebar">
                <ul>
                    <?php include('_includes_admin/sidebar.php') ?>
                </ul>
            </div>
            <!-- sidebar (end) -->

            <!-- content (start) -->
            <div id="content">
                <?php include($pages[$page]); ?>
            </div>
            <!-- content (end) -->
        </div>
        <!-- main content (end) -->

        <!-- footer (start) -->
        <div id="footer">
            <?php include('_includes_admin/footer.php') ?>
        </div>
        <!-- footer (end) -->
    </body>
<?php else: ?>
    <?php include('_includes_admin/index_404.php'); ?>

<?php endif; ?>

</html>