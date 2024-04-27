<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['id']) &&
    !empty($_POST['id_article']) &&
    !empty($_POST['id_client']) &&
    !empty($_POST['quantite']) &&
    !empty($_POST['prix'])
) {
    $id = $_POST['id'];
    $id_article = $_POST['id_article'];
    $id_client = $_POST['id_client'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];

    $sql = "UPDATE vente SET id_article=?, id_client=?, quantite=?, prix=? WHERE id=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $id_article,
        $id_client,
        $quantite,
        $prix,
        $id
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "La vente est modifiée avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Rien n'a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire est manquée";
    $_SESSION['message']['type'] = "fail";
}

header('Location: ../vue/vente.php');
?>
