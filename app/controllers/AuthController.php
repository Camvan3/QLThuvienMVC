<?php
require_once APP_ROOT . '/services/AuthService.php';

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    // Đăng nhập
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->authService->login($username, $password);
            if ($user) {
                $_SESSION['user'] = [
                    'id_user'  => $user->getIdUser(),
                    'username' => $user->getUsername(),
                    'email'    => $user->getEmail(),
                    'role'     => $user->getRole()
                ];
                header('Location: ' . BASE_URL . '/index.php');
                exit();
            } else {
                $error = "Mật khẩu hoặc tài khoản chưa chính xác!";
                require_once APP_ROOT . '/views/auth/login.php';
                return;
            }
        }
        require_once APP_ROOT . '/views/auth/login.php';
    }

    // ĐĂNG KÝ (Đã thêm để khắc phục lỗi Action 'register' không tồn tại)
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);

            $result = $this->authService->register($username, $email, $password);
            if ($result) {
                // Đăng ký thành công -> Chuyển hướng sang trang đăng nhập
                header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
                exit();
            } else {
                $error = "Tên đăng nhập hoặc Email đã tồn tại trong hệ thống!";
                require_once APP_ROOT . '/views/auth/register.php';
                return;
            }
        }
        require_once APP_ROOT . '/views/auth/register.php';
    }

    // Đăng xuất
    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
        exit();
    }
}