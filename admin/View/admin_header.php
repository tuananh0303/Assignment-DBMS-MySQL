<?php
session_start();
if (isset($message)) {
    foreach ($message as $message) {
        echo '
    <div class="message">
        <span>' . $message . '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
    ';
    }
}
?>

<header class="header">

    <div class="flex">

        <a href="admin_page.php" class="logo">Trang<span> Admin</span></a>

        <nav class="navbar">
            <a href="admin_page.php">Trang chủ</a>
            <a href="admin_product.php">Sách</a>
            <a href="./admin_order.php">Đơn đặt hàng</a>
            <a href="admin_user.php">Người dùng</a>
            <a href="admin_request.php">Yêu cầu</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="account-box">
            <p>username : <span>
                    <?php echo $_SESSION['admin_name']; ?>
                </span></p>
            <p>email : <span>
                    <?php echo $_SESSION['admin_email']; ?>
                </span></p>
            <a href="logout.php" class="delete-btn">logout</a>
            <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
        </div>

    </div>

</header>