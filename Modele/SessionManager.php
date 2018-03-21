<?php
require_once 'Modele/Modele.php';

class SessionManager extends Modele {

    public function login($username, $password) {
        $sql = 'select * from ADMIN where username = :username and password = :password';
        $req = $this->executerRequete($sql, array($username, $password));
        $user = $req->fetch();
    }
}