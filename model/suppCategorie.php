<?php
session_start(); 
include 'connexion.php'; 

if (!empty($_GET['id'])) {
    $id_categorie = $_GET['id'];

    $sql_check_dependents = "SELECT COUNT(*) FROM article WHERE id_categorie=?";
    $req_check_dependents = $connexion->prepare($sql_check_dependents);
    $req_check_dependents->execute([$id_categorie]);
    $count_dependents = $req_check_dependents->fetchColumn();

    if ($count_dependents > 0) {
        $_SESSION['message']['text'] = "Impossible de supprimer la catégorie car elle est associée à des articles.";
        $_SESSION['message']['type'] = "warning";
    } else {
        $sql_delete_categorie = "DELETE FROM categorie_article WHERE id=?";
        $req_delete_categorie = $connexion->prepare($sql_delete_categorie);
        $req_delete_categorie->execute([$id_categorie]);

        if ($req_delete_categorie->rowCount() != 0) {
            $_SESSION['message']['text'] = "La catégorie a été supprimée avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Erreur lors de la suppression de la catégorie";
            $_SESSION['message']['type'] = "warning";
        }
    }
} else {
    $_SESSION['message']['text'] = "Aucun ID de catégorie spécifié";
    $_SESSION['message']['type'] = "fail";
}

header('Location: ../vue/categorie.php');
?>
