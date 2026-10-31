<?php
require_once APP_ROOT . '/libs/DbConnection.php';
require_once APP_ROOT . '/models/Reader.php';

class ReaderService {
    private $db;

    public function __construct() {
        $this->db = DbConnection::getInstance()->getConnection();
    }

    // Lấy danh sách tất cả độc giả & người dùng (có tìm kiếm)
    public function getAllUsersWithReaders($search = '') {
        $sql = "SELECT users.id_user, users.username, users.email, users.role, 
                       readers.id_reader, readers.full_name, readers.phone, readers.address 
                FROM users 
                LEFT JOIN readers ON users.id_user = readers.id_user 
                WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (users.username LIKE :s OR users.email LIKE :s OR readers.full_name LIKE :s)";
            $params['s'] = "%$search%";
        }

        $sql .= " ORDER BY users.id_user ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $readers = [];
        while ($row = $stmt->fetch()) {
            $readers[] = new Reader($row);
        }
        return $readers;
    }

    // Lấy thông tin độc giả theo id_user
    public function getReaderByUserId($id_user) {
        $sql = "SELECT users.id_user, users.username, users.email, users.role, 
                       readers.id_reader, readers.full_name, readers.phone, readers.address 
                FROM users 
                LEFT JOIN readers ON users.id_user = readers.id_user 
                WHERE users.id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        $row = $stmt->fetch();
        return $row ? $row : null;
    }

    // CẬP NHẬT HỒ SƠ ĐỘC GIẢ (Khắc phục lỗi cho updateProfile)
    public function updateReaderProfile($id_user, $full_name, $phone, $address) {
        // Kiểm tra xem user đã có bản ghi trong bảng readers chưa
        $check = $this->db->prepare("SELECT id_reader FROM readers WHERE id_user = :id_user");
        $check->execute(['id_user' => $id_user]);
        
        if ($check->fetch()) {
            // Nếu đã có -> UPDATE
            $stmt = $this->db->prepare("UPDATE readers SET full_name = :full_name, phone = :phone, address = :address WHERE id_user = :id_user");
            return $stmt->execute([
                'full_name' => $full_name,
                'phone'     => $phone,
                'address'   => $address,
                'id_user'   => $id_user
            ]);
        } else {
            // Nếu chưa có -> INSERT
            $stmt = $this->db->prepare("INSERT INTO readers (id_user, full_name, phone, address) VALUES (:id_user, :full_name, :phone, :address)");
            return $stmt->execute([
                'id_user'   => $id_user,
                'full_name' => $full_name,
                'phone'     => $phone,
                'address'   => $address
            ]);
        }
    }

    // Xóa tài khoản và hồ sơ độc giả
    public function deleteUserAndReader($id_user) {
        $stmt1 = $this->db->prepare("DELETE FROM readers WHERE id_user = :id_user");
        $stmt1->execute(['id_user' => $id_user]);

        $stmt2 = $this->db->prepare("DELETE FROM users WHERE id_user = :id_user");
        return $stmt2->execute(['id_user' => $id_user]);
    }
}