<?php

require_once 'isAuth.php';

include_once '../model/Commande/CRUDCommande.php';
include_once '../model/Vente/CRUDVente.php';
include_once '../model/Article/CRUDArticle.php';
$CRUD_Commande = new CRUDCommande();
$CRUD_Vente = new CRUDVente();
$CRUD_Article = new CRUDArticle();

$nbreCommande = $CRUD_Commande->getCountCommande()['nbre'];
$nbreVente = $CRUD_Vente->getCountVente()['nbre'];
$nbreArticle = $CRUD_Article->getCountArticle()['nbre'];
$chiffreAffaire = $CRUD_Vente->getCA()['prix'];
$allVentes = $CRUD_Vente->getAllVentes();
$mostVenteArticle = $CRUD_Vente->getMostVente();

ob_start();

include_once "../vue/dashboard.php";
?>