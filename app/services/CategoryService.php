<?php
require_once APP_ROOT . '/libs/DbConnection.php';
require_once APP_ROOT . '/models/Category.php';

class CategoryService {

    public function getAllCategories() {
        $dbConnection = new DBConnection();
        $categories = [];
        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM categories";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch()) {
                    $categories[] = new Category($row['id_category'], $row['name_category'], $row['des']); 
                }
            }
        }
        return $categories;
    }

    public function addCategory(Category $category) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $nameCategory = $category->getNameCategory();
                $des = $category->getDes();
                $sql = "INSERT INTO categories (name_category, des) VALUES ('$nameCategory', '$des')";
                $conn->exec($sql);
            }
        }
    }

    public function getCategoryById($idCategory) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM categories WHERE id_category = '$idCategory'";
                $stmt = $conn->query($sql);
                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();
                    $category = new Category(
                        $row['id_category'], 
                        $row['name_category'], 
                        $row['des']
                    );
                    return $category;
                }
            }
        }
        return null;
    }

    public function updateCategory(Category $category) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $idCategory = $category->getIdCategory();
                $nameCategory = $category->getNameCategory();
                $des = $category->getDes();
                $sql = "UPDATE categories SET name_category = '$nameCategory', des = '$des' WHERE id_category = '$idCategory'";
                $conn->exec($sql);
            }
        }
    }

    public function destroyCategory($idCategory) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "DELETE FROM categories WHERE id_category = '$idCategory'";
                $conn->exec($sql);
            }
        }
    }
}