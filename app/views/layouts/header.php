<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư viện Đại học Thủy Lợi</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #333;
        }
        /* Sidebar styling */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #eef2f5;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 20px 15px;
        }
        .main-content {
            margin-left: 250px;
            padding: 25px 35px;
        }
        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #4a5568;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background-color: #eef5ff;
            color: #2563eb;
        }
        .menu-icon-box {
            width: 28px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 1.25rem;
            margin-right: 10px;
        }
        .logout-link {
            color: #ef4444 !important;
        }
        .logout-link:hover {
            background-color: #fef2f2 !important;
        }

        /* Banner & Card Soft Blue */
        .banner-pastel {
            background: linear-gradient(135deg, #71b1f9 0%, #4893ee 100%) !important;
            border-radius: 16px;
            color: #ffffff !important;
            padding: 35px;
        }
        .banner-pastel h2, .banner-pastel p, .banner-pastel small {
            color: #ffffff !important;
        }

        .book-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transition: transform 0.2s;
        }
        .book-card:hover {
            transform: translateY(-4px);
        }
       .book-img-placeholder {
            background-color: #edf4ff !important;
            height: 250px; /* Tăng chiều cao để tạo form chữ nhật dọc */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            font-weight: 600;
            border-radius: 10px;
            overflow: hidden;
        }

        .btn-soft-blue {
            background-color: #3b82f6 !important;
            color: #ffffff !important;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 18px;
        }
        .btn-soft-blue:hover {
            background-color: #2563eb !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        }
    </style>
</head>
<body>

<!-- SIDEBAR BÊN TRÁI -->
<div class="sidebar d-flex flex-column justify-content-between">
    <div>
        <!-- LOGO -->
        <div class="d-flex align-items-center gap-3 mb-4 px-2">
            <span class="fs-1"><i class="fa-solid fa-graduation-cap" style="color: #4f46e5;"></i></span>
            <div>
                <h5 class="fw-bold mb-0" style="color: #2563eb; letter-spacing: -0.5px;">THƯ VIỆN TLU</h5>
                <small class="text-muted" style="font-size: 0.8rem;">Đại học Thủy Lợi</small>
            </div>
        </div>

        <hr class="my-3 text-muted opacity-25">

        <!-- MENU ĐIỀU HƯỚNG -->
        <?php 
            $controller = $_GET['controller'] ?? 'home';
            $action = $_GET['action'] ?? 'index';
        ?>
        <nav class="nav flex-column">
            <a class="nav-link-custom <?= ($controller == 'home') ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php?controller=home">
                <span class="menu-icon-box"><i class="fa-regular fa-compass text-primary"></i></span> Trang chủ
            </a>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a class="nav-link-custom <?= ($controller == 'book') ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php?controller=book">
                    <span class="menu-icon-box"><i class="fa-solid fa-layer-group" style="color: #06b6d4;"></i></span> Quản lý sách
                </a>
                <a class="nav-link-custom <?= ($controller == 'user' && $action == 'index') ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php?controller=user&action=index">
                    <span class="menu-icon-box"><i class="fa-solid fa-users" style="color: #4f46e5;"></i></span> Quản lý độc giả
                </a>
                <a class="nav-link-custom <?= ($controller == 'category') ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php?controller=category">
                    <span class="menu-icon-box"><i class="fa-solid fa-folder" style="color: #f59e0b;"></i></span> Quản lý thể loại
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link-custom <?= ($controller == 'user' && $action == 'profile') ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php?controller=user&action=profile">
                    <span class="menu-icon-box"><i class="fa-solid fa-user-gear" style="color: #8b5cf6;"></i></span> Thông tin tài khoản
                </a>
            <?php endif; ?>
        </nav>
    </div>

    <!-- ĐĂNG XUẤT / ĐĂNG NHẬP -->
    <div>
        <?php if (isset($_SESSION['user'])): ?>
            <a class="nav-link-custom logout-link" href="<?= BASE_URL ?>/index.php?controller=auth&action=logout">
                <span class="menu-icon-box"><i class="fa-solid fa-right-from-bracket" style="color: #ef4444;"></i></span> Đăng xuất
            </a>
        <?php else: ?>
            <a class="nav-link-custom text-primary" href="<?= BASE_URL ?>/index.php?controller=auth&action=login">
                <span class="menu-icon-box"><i class="fa-solid fa-right-to-bracket text-primary"></i></span> Đăng nhập
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- NỘI DUNG CHÍNH BÊN PHẢI -->
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h5 class="fw-bold text-secondary mb-0">Hệ thống quản lý thư viện</h5>
        <div class="small">
            <?php if (isset($_SESSION['user'])): ?>
                Xin chào, <b><?= htmlspecialchars($_SESSION['user']['username']) ?></b>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/index.php?controller=auth&action=login" class="text-decoration-none me-3 <?= ($controller == 'auth' && $action == 'login') ? 'text-primary fw-bold' : 'text-secondary fw-semibold' ?>">
                    Đăng nhập
                </a>
                <a href="<?= BASE_URL ?>/index.php?controller=auth&action=register" class="text-decoration-none <?= ($controller == 'auth' && $action == 'register') ? 'text-primary fw-bold' : 'text-secondary fw-semibold' ?>">
                    Đăng ký
                </a>
            <?php endif; ?>
        </div>
    </div>