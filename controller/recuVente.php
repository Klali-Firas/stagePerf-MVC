<?php
require_once 'isAuth.php';

ob_start();


include_once '../model/Vente/CRUDVente.php';
$CRUD_Vente = new CRUDVente();
if (isset($_GET['id'])) {
    $vente = $CRUD_Vente->getVente($_GET['id']);
}



include_once "../vue/recuVente.php";
?>