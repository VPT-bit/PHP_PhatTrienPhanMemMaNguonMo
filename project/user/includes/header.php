<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        <?php echo $page_title; ?>

    </title>
    <link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>

    <div id="header">
        <div class="header-container">
            <!-- Logo và tên cửa hàng -->
            <div class="logo-title">
                <a href="index.php"><img src="includes/image_menu/logo.jpg" alt="Store Logo" class="logo" /></a>
                <div class="title">
                    <h1>3TL Store</h1>
                    <h2>Uy Tín Tạo Niềm Tin</h2>
                </div>
            </div>


            <!-- Menu + nút -->
            <div class="menu-buttons">
                <ul class="main-menu">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="gio_hang.php" class="active">Giỏ Hàng</a></li>
                    <li><a href="don_hang_cua_toi.php" class="active">Đơn Hàng Của Tôi</a></li>

                    <?php
                    if (isset($_SESSION['ma_quyen']) && ($_SESSION['ma_quyen'] == 'Q1' || $_SESSION['ma_quyen'] == 'Q2')) {
                        echo '<li><a href="../admin/index_admin.php">Quản Lý</a></li>';
                    }
                    ?>

                    <li><a href="#">Link Five</a></li>
                </ul>
                <div class="action-buttons">
                    <?php if (isset($_SESSION['username'])): ?>
                        <!-- Đã đăng nhập -->
                        <span class="welcome-message">
                            Xin chào, <strong>
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </strong>
                        </span>
                        <a href="logout.php" class="btn">Logout</a>
                    <?php else: ?>
                        <!-- Chưa đăng nhập -->
                        <a href="login.php" class="btn">Login</a>
                        <a href="register.php" class="btn">Register</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <div id="content">
        <!-- Page content -->
    </div>
</body>

</html>