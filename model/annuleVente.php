<?php
include 'connexion.php';


if (!empty($_GET['idVente']) && !empty($_GET['idArticle']) && !empty($_GET['quantite'])) {
    $sql = "UPDATE vente SET etat=? WHERE id=? ";
    $req = $connexion->prepare($sql);


    $success = $req->execute(array(0, $_GET['idVente']));


    if ($success && $req->rowCount() != 0) {
        $sql = "UPDATE article SET quantite =quantite+? WHERE id=?";
        $req = $connexion->prepare($sql);


        $success = $req->execute(array($_GET['quantite'], $_GET['idArticle']));

        if ($success && $req->rowCount() != 0) {

            $_SESSION['message']['text'] = "La vente a été annulée avec succès.";
            $_SESSION['message']['type'] = "success";
        } else {

            $_SESSION['message']['text'] = "Erreur lors de l'annulation de la vente.";
            $_SESSION['message']['type'] = "error";
        }
    } else {

        $_SESSION['message']['text'] = "Erreur lors de l'annulation de la vente.";
        $_SESSION['message']['type'] = "error";
    }
} else {

    $_SESSION['message']['text'] = "Paramètres manquants pour annuler la vente.";
    $_SESSION['message']['type'] = "error";
}


header('Location: ../vue/vente.php');
