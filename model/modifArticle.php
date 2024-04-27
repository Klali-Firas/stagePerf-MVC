<?php
include 'connexion.php';

if (
    !empty($_POST['nom_article']) &&
    !empty($_POST['id_categorie']) &&
    !empty($_POST['quantite']) &&
    !empty($_POST['prix_unitaire']) && 
    !empty($_POST['date_fabrication']) &&
    !empty($_POST['id'])

) {

    $sql="UPDATE article SET nom_article=?, id_categorie=?, quantite=?, prix_unitaire=?,
          date_fabrication=? WHERE id=? ";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'], 
        $_POST['date_fabrication'],
        $_POST['id']

    ));

if ($req->rowCount()!=0) {
    $_SESSION['message']['text']="L'article est modifié avec succès";
    $_SESSION['message']['type']="success";

}else {
    $_SESSION['message']['text']="Rien n'a été modifié";
    $_SESSION['message']['type']="warning";
    
}

}
else{
    $_SESSION['message']['text']="Une information obligatoire est manquée";
    $_SESSION['message']['type']="fail";
}

header('Location: ../vue/article.php');