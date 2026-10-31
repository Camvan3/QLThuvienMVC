<?php
require_once APP_ROOT . '/libs/DbConnection.php';
require_once APP_ROOT . '/models/Book.php';

class BookService {
    private $db;

    public function __construct() {
        $this->db = DbConnection::getInstance()->getConnection();
    }

    // 1. Lấy tất cả sách (Cho Admin)
    public function getAllBooks($keyword = '') {
        return $this->searchAndFilterBooks($keyword);
    }

    // 2. Tìm kiếm & Lọc theo thể loại
    public function searchAndFilterBooks($keyword = '', $category_id = '') {
        $sql = "SELECT books.*, categories.name_category AS category_name 
                FROM books 
                LEFT JOIN categories ON books.id_category = categories.id_category 
                WHERE 1=1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (books.title LIKE :kw OR books.author LIKE :kw)";
            $params['kw'] = "%$keyword%";
        }

        if (!empty($category_id)) {
            $sql .= " AND books.id_category = :cat_id";
            $params['cat_id'] = $category_id;
        }

        $sql .= " ORDER BY books.id_book DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }
        return $books;
    }

    // 3. Lấy chi tiết 1 cuốn sách
    public function getBookById($id) {
        $stmt = $this->db->prepare("SELECT books.*, categories.name_category AS category_name 
                                     FROM books 
                                     LEFT JOIN categories ON books.id_category = categories.id_category 
                                     WHERE id_book = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? new Book($row) : null;
    }

    // 4. Thêm sách mới
    public function addBook($data) {
        $sql = "INSERT INTO books (id_category, title, author, publisher, publish_year, quantity, cover_image, des) 
                VALUES (:id_category, :title, :author, :publisher, :publish_year, :quantity, :cover_image, :des)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id_category' => $data['id_category'],
            'title'        => $data['title'],
            'author'       => $data['author'],
            'publisher'    => $data['publisher'],
            'publish_year' => $data['publish_year'],
            'quantity'     => $data['quantity'],
            'cover_image'  => $data['cover_image'],
            'des'          => $data['des']
        ]);
    }

    // 5. CẬP NHẬT THÔNG TIN SÁCH (Khắc phục lỗi Call to undefined method BookService::updateBook)
    // Cập nhật thông tin sách (bao gồm cả ảnh bìa)
    public function updateBook($id, $data) {
        $sql = "UPDATE books SET 
                    id_category = :id_category, 
                    title       = :title, 
                    author      = :author, 
                    publisher   = :publisher, 
                    publish_year= :publish_year, 
                    quantity    = :quantity, 
                    cover_image = :cover_image, 
                    des         = :des 
                WHERE id_book = :id_book";
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id_book'      => $id,
            'id_category' => $data['id_category'],
            'title'        => $data['title'],
            'author'       => $data['author'],
            'publisher'    => $data['publisher'],
            'publish_year' => $data['publish_year'],
            'quantity'     => $data['quantity'],
            'cover_image'  => $data['cover_image'],
            'des'          => $data['des']
        ]);
    }

    // 6. Xóa sách
    public function deleteBook($id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id_book = :id");
        return $stmt->execute(['id' => $id]);
    }
}