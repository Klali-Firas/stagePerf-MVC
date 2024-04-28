<?php

require_once "Admin.php";
require_once "../config/connexion.php";

class CRUDAdmin
{
    private $pdo;

    function __construct()
    {
        $obj = new connexion();
        $this->pdo = $obj->getConnexion();
    }

    function login(Admin $admin)
    {
        $email = $admin->getEmail();
        $password = $admin->getPassword();

        $sql = "SELECT * FROM admin WHERE Email='$email' AND Password='$password' ";
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetch();

    }
}
