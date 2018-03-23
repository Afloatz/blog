<?php
require_once 'Model/Model.php';

class AdminManager extends Model {

    public function login($username, $password) {
        $sql = 'select * from ADMIN where username = ? and password = ?';
        $req = $this->executeRequest($sql, array($username, $password));
        $user = $req->fetch();
        return $user;
    }
}