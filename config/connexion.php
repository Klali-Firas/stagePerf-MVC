<?php


class connexion
{
    function getConnexion()
    {
        $dsn = "mysql:host=localhost;dbname=copy_stage";
        $username = "root";
        $password = "";

        $connexion = new PDO($dsn, $username, $password);

        return $connexion;
    }
}
?>