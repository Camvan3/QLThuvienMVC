<?php
require_once APP_ROOT . '/services/CategoryService.php';

class CategoryController {
    private $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    public function index() {
        $categories = $this->categoryService->getAllCategories();
        require_once APP_ROOT . '/views/categories/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $des = trim($_POST['des']);
            $this->categoryService->addCategory($name, $des);
            header('Location: ' . BASE_URL . '/index.php?controller=category&action=index');
            exit();
        }
        require_once APP_ROOT . '/views/categories/add.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $des = trim($_POST['des']);
            $this->categoryService->updateCategory($id, $name, $des);
            header('Location: ' . BASE_URL . '/index.php?controller=category&action=index');
            exit();
        }
        $category = $this->categoryService->getCategoryById($id);
        require_once APP_ROOT . '/views/categories/edit.php';
    }

    // Xóa thể loại
    public function delete() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
            exit();
        }

        $id = $_GET['id'] ?? null;
        $category = $this->categoryService->getCategoryById($id);

        if (!$category) {
            header('Location: ' . BASE_URL . '/index.php?controller=category&action=index');
            exit();
        }

        // Nếu bấm nút Xác nhận xóa (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->categoryService->deleteCategory($id);
            header('Location: ' . BASE_URL . '/index.php?controller=category&action=index');
            exit();
        }

        require_once APP_ROOT . '/views/categories/delete.php';
    }
}