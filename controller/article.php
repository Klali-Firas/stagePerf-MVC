<?php
require_once 'isAuth.php';
ob_start();




include_once '../model/Article/CRUDArticle.php';
include_once '../model/CategorieArticle/CRUDCategorieArticle.php';
$CRUD_CategorieArticle = new CRUDCategorieArticle();
$CRUD_Article = new CRUDArticle();

$categories = $CRUD_CategorieArticle->getAllCategorie();
$articles = $CRUD_Article->getArticle();
if (isset($_GET['chercher'])) {
    $articles = $CRUD_Article->getArticle(null, $_GET);

}
if (isset($_GET['id'])) {
    $article = $CRUD_Article->getArticle($_GET['id']);
}

if (isset($_POST['ajouter'])) {
    $article = new Article(0, $_POST['nom_article'], $_POST['id_categorie'], $_POST['quantite'], $_POST['prix_unitaire'], $_POST['date_fabrication']);
    $CRUD_Article->ajoutArticle($article);
}

if (isset($_POST['modifier'])) {
    $article = new Article($article['id'], $_POST['nom_article'], $_POST['id_categorie'], $_POST['quantite'], $_POST['prix_unitaire'], $_POST['date_fabrication']);
    $CRUD_Article->modifArticle($article);
}

if (isset($_GET['delete']) and isset($_GET['id'])) {
    $CRUD_Article->suppArticle($_GET['id']);
}

include_once "../vue/article.php";

?>