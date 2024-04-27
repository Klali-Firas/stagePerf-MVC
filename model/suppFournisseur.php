<?php
include 'connexion.php';

if (!empty($_GET['id'])) {
    $id_fournisseur = $_GET['id'];


    $sql_check_dependents = "SELECT COUNT(*) FROM commande WHERE id_fournisseur=?";
    $req_check_dependents = $connexion->prepare($sql_check_dependents);
    $req_check_dependents->execute([$id_fournisseur]);
    $count_dependents = $req_check_dependents->fetchColumn();

    if ($count_dependents > 0) {
        $_SESSION['message']['text'] = "Impossible de supprimer le fournisseur car il a des commandes associées.";
        $_SESSION['message']['type'] = "warning";
    } else {

        $sql_delete_fournisseur = "DELETE FROM fournisseur WHERE id=?";
        $req_delete_fournisseur = $connexion->prepare($sql_delete_fournisseur);
        $req_delete_fournisseur->execute([$id_fournisseur]);

        if ($req_delete_fournisseur->rowCount() != 0) {
            $_SESSION['message']['text'] = "Le fournisseur a été supprimé avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Erreur lors de la suppression du fournisseur";
            $_SESSION['message']['type'] = "warning";
        }
    }
} else {
    $_SESSION['message']['text'] = "Aucun ID de fournisseur spécifié";
    $_SESSION['message']['type'] = "fail";
}

header('Location: ../vue/fournisseur.php');
?>
