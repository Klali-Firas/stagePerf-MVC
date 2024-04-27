<?php
session_start(); 
include 'connexion.php'; 

if (!empty($_GET['id'])) {
    $id_article = $_GET['id'];

    $sql_check_dependents = "SELECT COUNT(*) FROM vente WHERE id_article=?";
    $req_check_dependents = $connexion->prepare($sql_check_dependents);
    $req_check_dependents->execute([$id_article]);
    $count_dependents = $req_check_dependents->fetchColumn();

    if ($count_dependents > 0) {
        $_SESSION['message']['text'] = "Impossible de supprimer l'article car il est associé à des ventes ou commandes.";
        $_SESSION['message']['type'] = "warning";
    } else {
        $sql_delete_article = "DELETE FROM article WHERE id=?";
        $req_delete_article = $connexion->prepare($sql_delete_article);
        $req_delete_article->execute([$id_article]);

        if ($req_delete_article->rowCount() != 0) {
            $_SESSION['message']['text'] = "L'article a été supprimé avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Erreur lors de la suppression de l'article";
            $_SESSION['message']['type'] = "warning";
        }
    }
} else {
    $_SESSION['message']['text'] = "Aucun ID d'article spécifié";
    $_SESSION['message']['type'] = "fail";
}

header('Location: ../vue/article.php');
?>
