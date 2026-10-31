<?php
class Reader {
    private $id_reader;
    private $id_user;
    private $full_name;
    private $phone;
    private $address;
    private $username;
    private $email;
    private $role;

    public function __construct($data = []) {
        $this->id_reader = $data['id_reader'] ?? null;
        $this->id_user = $data['id_user'] ?? null;
        $this->full_name = $data['full_name'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->address = $data['address'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->role = $data['role'] ?? 'user';
    }

    public function getIdUser() { return $this->id_user; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getFullName() { return $this->full_name; }
    public function getPhone() { return $this->phone; }
    public function getRole() { return $this->role; }
}