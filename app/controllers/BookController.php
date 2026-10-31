<?php
require_once APP_ROOT . '/services/BookService.php';
require_once APP_ROOT . '/services/CategoryService.php';

class BookController {
    private $bookService;
    private $categoryService;

    public function __construct() {
        $this->bookService = new BookService();
        $this->categoryService = new CategoryService();
    }

    // Hiển thị danh sách sách
    public function index() {
        $books = $this->bookService->getAllBooks();
        require_once APP_ROOT . '/views/books/index.php';
    }

    // THÊM SÁCH MỚI (Khắc phục lỗi Action 'add' không tồn tại)
    public function add() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cover_image = '';
        
        // Kiểm tra và xử lý file ảnh trực tiếp gửi lên từ form
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
            $ext = pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION);
            $cover_image = time() . '_' . uniqid() . '.' . $ext;
            
            // Đường dẫn thư mục chứa ảnh
            $targetDir = APP_ROOT . '/../public/uploads/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // Tự tạo thư mục uploads nếu chưa có
            }
            
            move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetDir . $cover_image);
        }

        $data = [
            'id_category' => $_POST['id_category'],
            'title'        => trim($_POST['title']),
            'author'       => trim($_POST['author']),
            'publisher'    => trim($_POST['publisher']),
            'publish_year' => $_POST['publish_year'],
            'quantity'     => $_POST['quantity'],
            'cover_image'  => $cover_image,
            'des'          => trim($_POST['des'])
        ];

        $this->bookService->addBook($data);
        header('Location: ' . BASE_URL . '/index.php?controller=book&action=index');
        exit();
    }

    $categories = $this->categoryService->getAllCategories();
    require_once APP_ROOT . '/views/books/add.php';
}

    // SỬA THÔNG TIN SÁCH
    // Hàm sửa sách trong BookController.php
    public function edit() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
            exit();
        }

        $id = $_GET['id'] ?? null;
        $book = $this->bookService->getBookById($id);

        if (!$book) {
            header('Location: ' . BASE_URL . '/index.php?controller=book&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mặc định giữ lại tên ảnh cũ
            $cover_image = $book->getCoverImage(); 

            // Nếu có chọn file ảnh mới và không bị lỗi
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION);
                // Tạo tên file mới tránh trùng lặp
                $cover_image = time() . '_' . uniqid() . '.' . $ext;
                
                // Đường dẫn lưu file
                $targetDir = APP_ROOT . '/../public/uploads/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                
                // Di chuyển file từ bộ nhớ tạm vào public/uploads/
                move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetDir . $cover_image);
            }

            $data = [
                'id_category' => $_POST['id_category'],
                'title'        => trim($_POST['title']),
                'author'       => trim($_POST['author']),
                'publisher'    => trim($_POST['publisher']),
                'publish_year' => $_POST['publish_year'],
                'quantity'     => $_POST['quantity'],
                'cover_image'  => $cover_image, // Tên ảnh mới hoặc tên ảnh cũ
                'des'          => trim($_POST['des'])
            ];

            // Thực thi câu lệnh CSDL
            $this->bookService->updateBook($id, $data);
            
            // Chuyển hướng về trang chủ để xem ngay kết quả
            header('Location: ' . BASE_URL . '/index.php?controller=home');
            exit();
        }

        $categories = $this->categoryService->getAllCategories();
        require_once APP_ROOT . '/views/books/edit.php';
    }
    // XÓA SÁCH
    public function delete() {
    $id = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $this->bookService->deleteBook($id);
        header('Location: ' . BASE_URL . '/index.php?controller=book&action=index');
        exit();
    }

    $book = $this->bookService->getBookById($id);
    require_once APP_ROOT . '/views/books/delete.php';
}
}