<?php
namespace DB;

class Users {
    private $id;
    private $un;
    private $email;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($un) {
        $this->username = $un;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}