<?php
require_once 'isAuth.php';

ob_start();


include_once '../model/Commande/CRUDCommande.php';

$CRUD_Commande = new CRUDCommande();


if (isset($_GET['id'])) {
    $commande = $CRUD_Commande->getCommande($_GET['id']);
}

include_once "../vue/recuCommande.php";
?>