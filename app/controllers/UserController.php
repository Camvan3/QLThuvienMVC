<?php
require_once APP_ROOT . '/services/ReaderService.php';

class UserController {
    private $readerService;

    public function __construct() {
        $this->readerService = new ReaderService();
    }

    // Quản lý độc giả (Admin)
    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
            exit();
        }

        $search = $_GET['search'] ?? '';
        $readers = $this->readerService->getAllUsersWithReaders($search);
        require_once APP_ROOT . '/views/readers/index.php';
    }

    // Trang Hồ sơ cá nhân (User)
    public function profile() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
            exit();
        }

        $id_user = $_SESSION['user']['id_user'];
        $reader_info = $this->readerService->getReaderByUserId($id_user);
        require_once APP_ROOT . '/views/users/profile.php';
    }

    // XỬ LÝ CẬP NHẬT HỒ SƠ (Khắc phục lỗi Action 'updateProfile' không tồn tại)
   public function updateProfile() {
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_user   = $_SESSION['user']['id_user'];
        $full_name = trim($_POST['full_name']);
        $phone     = trim($_POST['phone']);
        $address   = trim($_POST['address']);

        $this->readerService->updateReaderProfile($id_user, $full_name, $phone, $address);
        
        // Tạo thông báo thành công
        $_SESSION['success'] = "Cập nhật thông tin cá nhân thành công!";

        header('Location: ' . BASE_URL . '/index.php?controller=user&action=profile');
        exit();
    }
}

    // Xóa độc giả
    public function delete() {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $this->readerService->deleteUserAndReader($id);
            }
        }
        header('Location: ' . BASE_URL . '/index.php?controller=user&action=index');
        exit();
    }
}