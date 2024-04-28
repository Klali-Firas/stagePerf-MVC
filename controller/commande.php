<?php
require_once 'isAuth.php';

ob_start();


include_once '../model/Commande/CRUDCommande.php';
include_once '../model/Fournisseur/CRUDFournisseur.php';
include_once '../model/Article/CRUDArticle.php';
$CRUD_Article = new CRUDArticle();
$CRUD_Commande = new CRUDCommande();
$CRUD_Fournisseur = new CRUDFournisseur();

$articles = $CRUD_Article->getArticle();

$clients = $CRUD_Fournisseur->getFournisseur();
$commandes = $CRUD_Commande->getAllCommande();
if (isset($_GET['id'])) {
    $article = $CRUD_Commande->getCommande($_GET['id']);
}

if (isset($_POST['ajouter'])) {
    $commande = new Commande(0, $_POST['id_article'], $_POST['id_fournisseur'], $_POST['quantite'], $_POST['prix'], date('Y-m-d'), 1);
    $CRUD_Commande->ajoutCommande($commande);
}

if (isset($_POST['modifier'])) {
    $commande = new Commande($article['id'], $_POST['id_article'], $_POST['id_fournisseur'], $_POST['quantite'], $_POST['prix'], date('Y-m-d'), 1);
    $CRUD_Commande->modifCommande($commande);
}

if (isset($_GET['delete']) and isset($_GET['id'])) {
    $CRUD_Commande->annuleCommande($_GET['id'], $_GET['idArticle'], $_GET['quantite']);
}

include_once "../vue/commande.php";
?>