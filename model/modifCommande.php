<?php
include 'connexion.php';

if (
    !empty($_POST['id']) &&
    !empty($_POST['id_article']) &&
    !empty($_POST['id_fournisseur']) &&
    !empty($_POST['quantite']) &&
    !empty($_POST['prix'])
) {
    $id = $_POST['id'];
    $id_article = $_POST['id_article'];
    $id_fournisseur = $_POST['id_fournisseur'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];


    $sql = "UPDATE commande SET id_article=?, id_fournisseur=?, quantite=?, prix=?
            WHERE id=?";
    $req = $connexion->prepare($sql);

    $req->execute([$id_article, $id_fournisseur, $quantite, $prix, $id]);

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "La commande a été modifiée avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Rien n'a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire est manquée";
    $_SESSION['message']['type'] = "fail";
}

header('Location: ../vue/commande.php');
?>
