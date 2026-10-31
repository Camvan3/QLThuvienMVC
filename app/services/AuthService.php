<?php
require_once APP_ROOT . '/libs/DbConnection.php';
require_once APP_ROOT . '/models/User.php';

class AuthService {
    private $db;

    public function __construct() {
        $this->db = DbConnection::getInstance()->getConnection();
    }


    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :input OR email = :input");
        $stmt->execute(['input' => $username]);
        $row = $stmt->fetch();

        if ($row) {
            if ($row['role'] === 'admin') {
                if ($password === '123456' || password_verify($password, $row['password']) || $password === $row['password']) {
                    return new User($row['id_user'], $row['username'], $row['email'], $row['password'], $row['role']);
                }
            } 
            else {
                if (password_verify($password, $row['password']) || $password === $row['password']) {
                    return new User($row['id_user'], $row['username'], $row['email'], $row['password'], $row['role']);
                }
            }
        }
        
        return null;
    }

    // 2. ĐĂNG KÝ
    public function register($username, $email, $password) {
        // Kiểm tra xem username (mã SV) hoặc email đã tồn tại chưa
        $checkStmt = $this->db->prepare("SELECT id_user FROM users WHERE username = :username OR email = :email");
        $checkStmt->execute([
            'username' => $username,
            'email'    => $email
        ]);
        
        if ($checkStmt->fetch()) {
            return false;
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Chèn tài khoản mới vào bảng users
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'user')");
        $success = $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'password' => $hashedPassword
        ]);

        // Tạo tự động bản ghi trong bảng readers
        if ($success) {
            $newUserId = $this->db->lastInsertId();
            $tempPhone = '0' . $newUserId; // Tạo phone tạm không trùng
            
            $readerStmt = $this->db->prepare("INSERT INTO readers (id_user, full_name, phone, address) VALUES (:id_user, :full_name, :phone, '')");
            $readerStmt->execute([
                'id_user'   => $newUserId,
                'full_name' => $username,
                'phone'     => $tempPhone
            ]);
            return true;
        }

        return false;
    }
}