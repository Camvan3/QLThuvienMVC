<?php
require_once APP_ROOT . '/libs/DbConnection.php';
require_once APP_ROOT . '/models/Category.php';

class CategoryService {
    private $db;

    public function __construct() {
        $this->db = DbConnection::getInstance()->getConnection();
    }

    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT id_category, name_category, des FROM categories ORDER BY id_category DESC");
        $stmt->execute();
        $categories = [];
        while ($row = $stmt->fetch()) {
            $categories[] = new Category($row['id_category'], $row['name_category'], $row['des']);
        }
        return $categories;
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT id_category, name_category, des FROM categories WHERE id_category = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? new Category($row['id_category'], $row['name_category'], $row['des']) : null;
    }

    public function addCategory($name_category, $des) {
        $stmt = $this->db->prepare("INSERT INTO categories (name_category, des) VALUES (:name_category, :des)");
        return $stmt->execute(['name_category' => $name_category, 'des' => $des]);
    }

    public function updateCategory($id, $name_category, $des) {
        $stmt = $this->db->prepare("UPDATE categories SET name_category = :name_category, des = :des WHERE id_category = :id");
        return $stmt->execute(['id' => $id, 'name_category' => $name_category, 'des' => $des]);
    }

    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id_category = :id");
        return $stmt->execute(['id' => $id]);
    }
}