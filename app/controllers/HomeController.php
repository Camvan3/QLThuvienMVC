<?php
require_once APP_ROOT . '/services/BookService.php';
require_once APP_ROOT . '/services/CategoryService.php';

class HomeController {
    public function index() {
        $keyword = $_GET['keyword'] ?? '';
        $category_id = $_GET['category_id'] ?? '';

        $bookService = new BookService();
        $categoryService = new CategoryService();

        $books = $bookService->searchAndFilterBooks($keyword, $category_id);
        $categories = $categoryService->getAllCategories();

        require_once APP_ROOT . '/views/home/index.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        $bookService = new BookService();
        $book = $bookService->getBookById($id);
        
        if (!$book) {
            header('Location: ' . BASE_URL . '/index.php');
            exit();
        }
        require_once APP_ROOT . '/views/home/detail.php';
    }
}