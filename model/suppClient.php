<?php
include 'connexion.php';

if (!empty($_GET['id'])) {
    $id_client = $_GET['id'];


    $sql_delete_vente = "DELETE FROM vente WHERE id_client=?";
    $req_delete_vente = $connexion->prepare($sql_delete_vente);
    $req_delete_vente->execute([$id_client]);


    $sql_delete_client = "DELETE FROM client WHERE id=?";
    $req_delete_client = $connexion->prepare($sql_delete_client);
    $req_delete_client->execute([$id_client]);

    if ($req_delete_client->rowCount() != 0) {
        $_SESSION['message']['text'] = "Le client a été supprimé avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Erreur lors de la suppression du client";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Aucun ID de client spécifié";
    $_SESSION['message']['type'] = "fail";
}

header('Location: ../vue/client.php');
?>
