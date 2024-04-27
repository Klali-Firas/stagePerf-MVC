<?php
include 'connexion.php';

if (
    !empty($_POST['libelle_categorie']) &&
    !empty($_POST['id'])

) {

    $sql="UPDATE categorie_article SET libelle_categorie=? WHERE id=? ";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['libelle_categorie'],
        $_POST['id']

    ));

if ($req->rowCount()!=0) {
    $_SESSION['message']['text']="La catégorie est modifiée avec succès";
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

header('Location: ../vue/categorie.php');