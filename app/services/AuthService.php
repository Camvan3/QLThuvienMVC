<?php

require_once APP_ROOT . '/app/models/User.php';

class AuthService
{
    // Tim tai khoan theo email
    public function getUserByEmail($email)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $conn->prepare($sql);

                $stmt->execute([
                    ':email' => $email
                ]);

                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $user = new User(
                        $row['id_user'],
                        $row['username'],
                        $row['email'],
                        $row['password'],
                        $row['role']
                    );

                    return $user;
                }
            }
        }

        return null;
    }

    
    // Tim tai khoan theo ten dang nhap
    public function getUserByUsername($username)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn != null) {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username
            ]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return new User(
                    $row['id_user'],
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['role']
                );
            }
        }

        return null;
    }

    // Kiem tra username da ton tai chua
    public function isUsernameExists($username)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn != null) {
            $sql = "SELECT id_user FROM users
                    WHERE username = :username";
            $stmt = $conn->prepare($sql);

            $stmt->execute([
                ':username' => $username
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC) != false;
        }

        return false;
    }

    // Kiem tra email da ton tai chua
    public function isEmailExists($email)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn != null) {
            $sql = "SELECT id_user FROM users
                    WHERE email = :email";
            $stmt = $conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC) != false;
        }

        return false;
    }

    // Dang ky tai khoan User
    public function registerUser(User $user)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn != null) {
            $username = $user->getUsername();
            $email = $user->getEmail();

            // Ma hoa mat khau truoc khi luu
            $password = password_hash(
                $user->getPassword(),
                PASSWORD_DEFAULT
            );

            // Tai khoan dang ky mac dinh la User
            $role = 'user';

            $sql = "INSERT INTO users
                    (username, email, password, role)
                    VALUES
                    (:username, :email, :password, :role)";

            $stmt = $conn->prepare($sql);

            return $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $password,
                ':role' => $role
            ]);
        }

        return false;
    }
    
    // Dang nhap bang email hoac ten dang nhap
    public function login($loginName, $password)
    {
        // Neu co ky tu @ thi tim theo email
        if (strpos($loginName, '@') !== false) {
            $user = $this->getUserByEmail($loginName);
        } else {
            $user = $this->getUserByUsername($loginName);
        }

        // Kiem tra mat khau
        if ($user != null) {
            if (password_verify($password, $user->getPassword())) {
                return $user;
            }
        }
        return null;
    }

}
