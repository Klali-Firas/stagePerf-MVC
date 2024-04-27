<?php
include 'connexion.php';

if (
    !empty($_POST['libelle_categorie'])
) {

    $sql="INSERT INTO categorie_article(libelle_categorie) VALUES(?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['libelle_categorie']
    ));

if ($req->rowCount()!=0) {
    $_SESSION['message']['text']="La catégorie est ajouté avec succès";
    $_SESSION['message']['type']="success";

}else {
    $_SESSION['message']['text']="Il y'a une erreur lors de l'ajout du catégorie";
    $_SESSION['message']['type']="fail";
    
}


}
else{
    $_SESSION['message']['text']="Une information obligatoire est manquée";
    $_SESSION['message']['type']="fail";
}

header('Location: ../vue/categorie.php');