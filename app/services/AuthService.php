<?php

require_once APP_ROOT . '/libs/DbConnection.php';
require_once APP_ROOT . '/models/User.php';

class AuthService {
    private $db; 

    public function __construct() {
        $this->db = DbConnection::getInstance()->getConnection(); 
    }

    // ĐĂNG NHẬP
    public function login($username, $password) {

        // Tìm tài khoản theo username hoặc email
        $stmt = $this->db->prepare(
            "SELECT * FROM users
             WHERE username = :username OR email = :email"
        );

        $stmt->execute([
            'username' => $username,
            'email' => $username
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra tài khoản và mật khẩu
        if ($row && password_verify($password, $row['password'])) {

            return new User(
                $row['id_user'],
                $row['username'],
                $row['email'],
                $row['password'],
                $row['role']
            );
        }

        return null;
    }

    // ĐĂNG KÝ
    public function register($username, $email, $password) {

        try {

            // Kiểm tra username hoặc email đã tồn tại
            $checkStmt = $this->db->prepare(
                "SELECT id_user FROM users
                 WHERE username = :username OR email = :email"
            );

            $checkStmt->execute([
                'username' => $username,
                'email' => $email
            ]);

            if ($checkStmt->fetch()) {
                return false;
            }

            // Bắt đầu giao dịch
            $this->db->beginTransaction();

            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Thêm tài khoản vào bảng users
            // Tài khoản đăng ký mới mặc định là user
            $stmt = $this->db->prepare(
                "INSERT INTO users (username, email, password, role)
                 VALUES (:username, :email, :password, 'user')"
            );

            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);

            // Lấy ID tài khoản vừa đăng ký
            $newUserId = $this->db->lastInsertId();

            // Tạo hồ sơ độc giả tương ứng
            $tempPhone = '0' . $newUserId;

            $readerStmt = $this->db->prepare(
                "INSERT INTO readers (id_user, full_name, phone, address)
                 VALUES (:id_user, :full_name, :phone, :address)"
            );

            $readerStmt->execute([
                'id_user' => $newUserId,
                'full_name' => $username,
                'phone' => $tempPhone,
                'address' => ''
            ]);

            // Hoàn tất đăng ký
            $this->db->commit();

            return true;

        } catch (PDOException $e) {

            // Nếu có lỗi thì hủy toàn bộ thao tác
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            return false;
        }
    }
}
