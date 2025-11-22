<style>
    /* Thiết lập chung */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
    }

    /* --- HEADER --- */
    .header {
        width: 100%;
        height: 150px;
        background-color: #003b95;
    }

    .admin-header {
        background-image: linear-gradient(0, #003b95, #2c3e50);
        color: white;
        padding: 10px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        width: 100%;
        height: 100px;
        /* Chiều cao cố định */
        z-index: 2;
        transition: all 0.3s ease;
    }

    .header-left,
    .header-right {
        display: flex;
        align-items: center;
    }

    .logo {
        font-size: 1.2rem;
        font-weight: bold;
        margin-left: 15px;
    }

    /* Toggle Button */
    .sidebar-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 5px;
    }

    /* Search Bar */
    .search-bar {
        background-color: #4a637a;
        padding: 5px 10px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .search-bar input {
        border: none;
        background: transparent;
        color: white;
        margin-left: 8px;
        width: 300px;
        outline: none;
    }

    .search-bar input::placeholder {
        color: #b0c2d6;
    }

    /* Header Right */
    .icon-notification {
        position: relative;
        margin-right: 20px;
        cursor: pointer;
    }

    .badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #e74c3c;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 0.7rem;
    }

    .quick-action {
        background-color: #2ecc71;
        /* Màu xanh lá cây */
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        margin-right: 15px;
        cursor: pointer;
        font-weight: bold;
    }

    .user-profile {
        display: flex;
        position: relative;
        align-items: center;
        margin-left: 10px;
    }

    .user-profile_action {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;

    }

    .user-profile_action a {
        color: white;
        text-decoration: none;
    }

    .user-profile:hover>.user-profile_action {
        display: block;
    }

    .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #95a5a6;
        /* Màu nền cho ảnh nếu không có */
        margin-right: 10px;
    }

    /* --- MAIN CONTAINER & SIDEBAR --- */
    .main-container {
        display: flex;

    }

    .sidebar {
        width: 250px;
        height: 100vh;
        min-width: 250px;
        background-color: #34495e;
        /* Màu đậm hơn cho Sidebar */
        color: white;
        padding: 20px 0;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .sidebar.collapsed {
        width: 70px;
        /* Kích thước khi thu gọn */
        min-width: 70px;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu-heading {
        color: #bdc3c7;
        font-size: 0.8rem;
        padding: 10px 20px 5px 20px;
        text-transform: uppercase;
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .sidebar.collapsed .menu-heading,
    .sidebar.collapsed .menu-item span {
        opacity: 0;
        /* Ẩn chữ khi thu gọn */
        width: 0;
        white-space: nowrap;
        overflow: hidden;
    }

    .menu-item a {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        transition: background-color 0.2s;
    }

    .menu-item a i {
        font-size: 1.1rem;
        width: 30px;
        /* Giữ khoảng cách cố định cho icon */
    }

    .menu-item a span {
        margin-left: 10px;
        transition: all 0.3s ease;
    }

    .menu-item:hover,
    .menu-item.active {
        background-color: #2980b9;
        /* Màu hover/active */
    }

    /* --- NỘI DUNG CHÍNH --- */
    .content {
        flex-grow: 1;
        margin-left: 5px;
        /* Bằng chiều rộng Sidebar */
        padding: 20px;
        transition: margin-left 0.3s ease;
    }

    .content.shifted {
        margin-left: 70px;
        /* Bằng chiều rộng Sidebar khi thu gọn */
    }
</style>
<div class="header">
    <header class="admin-header">
        <div class="header-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo">TourManager Admin</div>
        </div>

        <div class="header-center">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Tìm kiếm Tour, Booking, Khách hàng...">
            </div>
        </div>

        <div class="header-right">


            <div class="icon-notification">
                <i class="fas fa-bell"></i>
                <span class="badge">4</span>
            </div>

            <div class="user-profile">
                <img src="avatar.png" alt="Admin Avatar" class="user-avatar">
                <span class="user-name">Admin Nam</span>
                <div class="user-profile_action">
                    <a href="<?= BASE_URL . '?controller=auth&action=logout' ?>" class="btn btn-danger">logout</a>
                </div>
            </div>
        </div>
    </header>
</div>
<div class="main-container">
    <aside class="sidebar">
        <nav>
            <ul class="sidebar-menu">

                <li class="menu-heading">Quản lý Sản phẩm</li>
                <li class="menu-item <?= $_GET['action'] == 'dashboard' ? 'active' : '' ?>"><a
                        href="<?= BASE_URL . '?controller=admin&action=dashboard' ?>"><i class="fas fa-plane"></i>
                        <span>Quản lý Tour</span></a></li>
                <li class="menu-item"><a href="#"><i class="fas fa-map-marker-alt"></i> <span>Địa điểm & Điểm
                            đến</span></a></li>

                <li class="menu-item">
                    <a href="<?= BASE_URL . '?controller=home&action=bookingView' ?>" target="_blank">
                        <i class="fas fa-external-link-alt" style="color: #f1c40f;"></i>
                        <span>Thông tin chi tiết tour</span>
                    </a>
                </li>

                <li class="menu-heading">Quản lý Đặt chỗ</li>
                <li class="menu-item"><a href="#"><i class="fas fa-dollar-sign"></i> <span>Booking & Hóa đơn</span></a>
                </li>
                <li class="menu-item"><a href="#"><i class="fas fa-users"></i> <span>Khách hàng</span></a></li>

                <li class="menu-heading">Cấu hình Hệ thống</li>
                <li class="menu-item <?= $_GET['action'] == 'guides_manager' ? 'active' : '' ?>"><a
                        href="<?= BASE_URL . '?controller=admin&action=guides_manager' ?>"><i
                            class="fa-solid fa-users"></i>
                        <span>Quản lý HDV</span></a></li>
            </ul>
        </nav>
    </aside>

    <main class="content">
        <?php
        if (isset($into)) {
            require_once PATH_VIEWS_ADMIN . $into . '.php';
        }
        ?>
    </main>

</div>


<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const header = document.querySelector('.admin-header');

        sidebar.classList.toggle('collapsed');
        content.classList.toggle('shifted');
        header.classList.toggle('shifted');
    }

</script>

</html>