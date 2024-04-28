<?php
require_once 'isAuth.php';

ob_start();

include_once '../model/CategorieArticle/CRUDCategorieArticle.php';
$CRUD_CategorieArticle = new CRUDCategorieArticle();
$categories = $CRUD_CategorieArticle->getAllCategorie();

if (isset($_GET['id'])) {
    $categorie = $CRUD_CategorieArticle->getCategorie($_GET['id']);
}

if (isset($_POST['ajouter'])) {
    $categorie = new CategorieArticle(0, $_POST['libelle_categorie']);
    $CRUD_CategorieArticle->ajoutCategorie($categorie);
}

if (isset($_POST['modifier'])) {
    $categorie = new CategorieArticle($categorie['id'], $_POST['libelle_categorie']);
    $CRUD_CategorieArticle->modifCategorie($categorie);
}

if (isset($_GET['delete']) and isset($_GET['id'])) {
    $CRUD_CategorieArticle->suppCategorie($_GET['id']);
}


include_once "../vue/categorie.php";
?>