<?php
require_once APP_ROOT . '/app/services/CategoryService.php';
require_once APP_ROOT . '/app/models/Category.php';

class CategoryController
{
    // 1. Hiển thị danh sách toàn bộ thể loại sách
    public function index()
    {
        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();

        include_once APP_ROOT . '/app/views/categories/index.php';
    }

    // 2. Hiển thị giao diện form thêm mới thể loại
    public function add()
    {
        include_once APP_ROOT . '/app/views/categories/add.php';
    }

    // 3. Xử lý lưu dữ liệu thêm mới (Nhận từ form POST)
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nameCategory = $_POST['name_category'] ?? '';
            $des = $_POST['des'] ?? '';

            // Tạo đối tượng Category mới (id_category để null vì trong CSDL là Auto Increment)
            $category = new Category(null, $nameCategory, $des);

            $categoryService = new CategoryService();
            $categoryService->addCategory($category);

            // Thêm xong chuyển hướng về trang danh sách thể loại
            header('Location: ?controller=category&action=index');
            exit;
        }
    }

    // 4. Hiển thị form chỉnh sửa kèm theo dữ liệu cũ của thể loại theo ID
    public function edit($idCategory)
    {
        if (isset($idCategory)) {
            $categoryService = new CategoryService();
            $category = $categoryService->getCategoryById($idCategory);

            include_once APP_ROOT . '/app/views/categories/edit.php';
        } else {
            echo "ID thể loại không tồn tại!";
        }
    }

    // 5. Xử lý cập nhật thông tin thể loại sau khi sửa
    public function update($idCategory)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nameCategory = $_POST['name_category'] ?? '';
            $des = $_POST['des'] ?? '';

            // Tạo đối tượng Category với đầy đủ ID cũ và thông tin mới cập nhật
            $category = new Category($idCategory, $nameCategory, $des);

            $categoryService = new CategoryService();
            $categoryService->updateCategory($category);

            header('Location: ?controller=category&action=index');
            exit;
        }
    }

    // 6. Xóa một thể loại khỏi cơ sở dữ liệu
    public function destroy($idCategory)
    {
        if (isset($idCategory)) {
            $categoryService = new CategoryService();
            $categoryService->destroyCategory($idCategory);
        }
        
        header('Location: ?controller=category&action=index');
        exit;
    }
}
?>