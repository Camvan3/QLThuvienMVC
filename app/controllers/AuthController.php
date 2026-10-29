<?php

require_once APP_ROOT . '/app/services/AuthService.php';

class AuthController
{
    // Hien thi trang dang ky
    public function register()
    {
        include APP_ROOT . '/app/views/auth/register.php';
    }

    // Xu ly dang ky
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: ?controller=auth&action=register');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Kiem tra du lieu
        if ($username == '' || $email == '' || $password == '') {
            echo 'Vui long nhap day du thong tin!';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Email khong hop le!';
            return;
        }

        if ($password !== $confirmPassword) {
            echo 'Mat khau xac nhan khong khop!';
            return;
        }

        $authService = new AuthService();

        if ($authService->isUsernameExists($username)) {
            echo 'Ten dang nhap da ton tai!';
            return;
        }

        if ($authService->isEmailExists($email)) {
            echo 'Email da duoc su dung!';
            return;
        }

        // Tao doi tuong User
        $user = new User(
            null,
            $username,
            $email,
            $password,
            'user'
        );

        // Luu tai khoan
        $result = $authService->registerUser($user);

        if ($result) {
            header('Location: ?controller=auth&action=login');
            exit;
        } else {
            echo 'Dang ky that bai!';
        }
    }

    // Hien thi trang dang nhap
    public function login()
    {
        include APP_ROOT . '/app/views/auth/login.php';
    }

    // Xu ly dang nhap
    
    // Xu ly dang nhap
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: ?controller=auth&action=login');
            exit;
        }

        // Lay ten dang nhap hoac email va mat khau
        $loginName = trim($_POST['loginName'] ?? '');
        $password = $_POST['password'] ?? '';

        // Kiem tra du lieu
        if ($loginName == '' || $password == '') {
            echo 'Vui long nhap ten dang nhap/email va mat khau!';
            return;
        }

        // Goi AuthService de kiem tra tai khoan
        $authService = new AuthService();
        $user = $authService->login($loginName, $password);

        if ($user != null) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user->getIdUser();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['role'] = $user->getRole();

            header('Location: ?controller=home');
            exit;
        } else {
            echo 'Ten dang nhap/email hoac mat khau khong chinh xac!';
        }
    }

    // Dang xuat
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        header('Location: ?controller=auth&action=login');
        exit;
    }
}