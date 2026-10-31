<?php
class User {
    private $id_user;
    private $username;
    private $email;
    private $password;
    private $role;

    public function __construct($id_user, $username, $email, $password, $role) {
        $this->id_user = $id_user;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getIdUser() { return $this->id_user; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }
}