<?php

// Khoi tao duong dan goc cua du an
define('APP_ROOT', dirname(__DIR__));

// Khoi tao session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Nap cac file can thiet
require_once APP_ROOT . '/app/libs/DBConnection.php';
require_once APP_ROOT . '/app/models/User.php';
require_once APP_ROOT . '/app/services/AuthService.php';
require_once APP_ROOT . '/app/controllers/AuthController.php';

// Lay controller va action tu URL
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Khoi tao controller
switch ($controller) {

    case 'auth':
        $authController = new AuthController();

        switch ($action) {
            case 'register':
                $authController->register();
                break;

            case 'store':
                $authController->store();
                break;

            case 'login':
                $authController->login();
                break;

            case 'authenticate':
                $authController->authenticate();
                break;

            case 'logout':
                $authController->logout();
                break;

            default:
                echo 'Chuc nang khong ton tai!';
                break;
        }
        break;

    case 'home':
        echo '<h1>Website quan ly thu vien sach</h1>';
        echo '<p>Chao mung ban den voi website!</p>';
        echo '<a href="?controller=auth&action=register">Dang ky</a>';
        echo ' | ';
        echo '<a href="?controller=auth&action=login">Dang nhap</a>';
        break;

    default:
        echo 'Trang khong ton tai!';
        break;
}
