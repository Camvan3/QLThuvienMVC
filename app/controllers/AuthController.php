<?php

require_once APP_ROOT . '/services/AuthService.php';

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    // ĐĂNG NHẬP
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Gọi Service kiểm tra tài khoản
            $user = $this->authService->login($username, $password);

            if ($user) {

                // Lưu thông tin người dùng vào SESSION
                $_SESSION['user'] = [
                    'id_user'  => $user->getIdUser(),
                    'username' => $user->getUsername(),
                    'email'    => $user->getEmail(),
                    'role'     => $user->getRole()
                ];

                // Đăng nhập thành công
                header('Location: ' . BASE_URL . '/index.php');
                exit();

            } else {

                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                require_once APP_ROOT . '/views/auth/login.php';
                return;
            }
        }

        require_once APP_ROOT . '/views/auth/login.php';
    }

    // ĐĂNG KÝ
    public function register() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Kiểm tra dữ liệu nhập
            if ($username == '' || $email == '' || $password == '') {
                $error = "Vui lòng nhập đầy đủ thông tin!";
                require_once APP_ROOT . '/views/auth/register.php';
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không đúng định dạng!";
                require_once APP_ROOT . '/views/auth/register.php';
                return;
            }

            if (strlen($password) < 6) {
                $error = "Mật khẩu phải có ít nhất 6 ký tự!";
                require_once APP_ROOT . '/views/auth/register.php';
                return;
            }

            // Gọi Service thực hiện đăng ký
            $result = $this->authService->register(
                $username,
                $email,
                $password
            );

            if ($result) {

                header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
                exit();

            } else {

                $error = "Tên đăng nhập hoặc Email đã tồn tại, hoặc không thể tạo hồ sơ độc giả!";

                require_once APP_ROOT . '/views/auth/register.php';
                return;
            }
        }

        require_once APP_ROOT . '/views/auth/register.php';
    }

    // ĐĂNG XUẤT
    public function logout() {

        unset($_SESSION['user']);

        session_destroy();

        header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
        exit();
    }
}
