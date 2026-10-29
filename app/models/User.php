<?php

class User
{
    // Properties
    private $id_user;
    private $username;
    private $email;
    private $password;
    private $role;

    // Constructor
    public function __construct($id_user, $username, $email, $password, $role)
    {
        $this->id_user = $id_user;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Getters
    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    // Setters
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}