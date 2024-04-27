<?php
include 'connexion.php';

if (
    !empty($_GET['idCommande']) &&
    !empty($_GET['idArticle']) &&
    !empty($_GET['quantite'])
) {
    $idCommande = $_GET['idCommande'];
    $idArticle = $_GET['idArticle'];
    $quantite = $_GET['quantite'];


    $sql_update_article = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
    $req_update_article = $connexion->prepare($sql_update_article);
    $req_update_article->execute([$quantite, $idArticle]);


    $sql_delete_commande = "DELETE FROM commande WHERE id = ?";
    $req_delete_commande = $connexion->prepare($sql_delete_commande);
    $req_delete_commande->execute([$idCommande]);

    if ($req_delete_commande->rowCount() != 0) {
        $_SESSION['message']['text'] = "La commande a été annulée avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Erreur lors de l'annulation de la commande";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Données manquantes pour annuler la commande";
    $_SESSION['message']['type'] = "fail";
}

header('Location: ../vue/commande.php');
?>
