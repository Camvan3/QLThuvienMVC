<?php
session_start();
require_once '../app/config/config.php';

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controller) . 'Controller';
$controllerFile = APP_ROOT . '/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $instance = new $controllerClass();
    if (method_exists($instance, $action)) {
        $instance->$action();
    } else {
        die("Action '$action' không tồn tại!");
    }
} else {
    die("Controller '$controllerClass' không tồn tại!");
}