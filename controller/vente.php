<?php
require_once 'isAuth.php';

ob_start();


include_once '../model/Vente/CRUDVente.php';
include_once '../model/Client/CRUDClient.php';
include_once '../model/Article/CRUDArticle.php';
$CRUD_Article = new CRUDArticle();
$CRUD_Client = new CRUDClient();
$CRUD_Vente = new CRUDVente();

$articles = $CRUD_Article->getArticle();
$clients = $CRUD_Client->getClient();
$ventes = $CRUD_Vente->getAllVentes();
if (isset($_GET['id'])) {
    $article = $CRUD_Vente->getVente($_GET['id']);
}

if (isset($_POST['ajouter'])) {
    $vente = new Vente(0, $_POST['id_article'], $_POST['id_client'], $_POST['quantite'], $_POST['prix'], date('Y-m-d'), 1);
    $CRUD_Vente->ajoutVente($vente);
}

if (isset($_POST['modifier'])) {
    $vente = new Vente($article['id'], $_POST['id_article'], $_POST['id_client'], $_POST['quantite'], $_POST['prix'], date('Y-m-d'), 1);
    $CRUD_Vente->modifierVente($vente);
}

if (isset($_GET['delete']) and isset($_GET['id'])) {
    $CRUD_Vente->annulerVente($_GET['id'], $_GET['idArticle'], $_GET['quantite']);
}

include_once "../vue/vente.php";

?>