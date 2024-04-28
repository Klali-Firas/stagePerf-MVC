<?php
require_once 'isAuth.php';

ob_start();

include_once '../model/Fournisseur/CRUDFournisseur.php';
$CRUD_Fournisseur = new CRUDFournisseur();
$fournisseurs = $CRUD_Fournisseur->getFournisseur();
if (isset($_GET['id'])) {
    $fournisseur = $CRUD_Fournisseur->getFournisseur($_GET['id']);
}

if (isset($_POST['ajouter'])) {
    $fournisseur = new Fournisseur(0, $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['adresse']);
    $CRUD_Fournisseur->ajoutFournisseur($fournisseur);
}

if (isset($_POST['modifier'])) {
    $fournisseur = new Fournisseur($fournisseur['id'], $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['adresse']);
    $CRUD_Fournisseur->modifFournisseur($fournisseur);
}

if (isset($_GET['delete']) and isset($_GET['id'])) {
    $CRUD_Fournisseur->suppFournisseur($_GET['id']);
}



include_once "../vue/fournisseur.php";
?>