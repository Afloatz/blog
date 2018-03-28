<?php
require_once 'Model/Model.php';

class AdminManager extends Model {

    public function login($username) {
        $sql = 'select * from ADMIN where username = ?';
        $req = $this->executeRequest($sql, array($username));
        $user = $req->fetch();
        return $user;
    }
}