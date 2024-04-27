<?php
include 'connexion.php';

if (
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['telephone']) &&
    !empty($_POST['adresse'])
) {

    $sql="INSERT INTO fournisseur (nom, prenom, telephone, adresse)
          VALUES(?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
    ));

if ($req->rowCount()!=0) {
    $_SESSION['message']['text']="Le fournisseur est ajouté avec succès";
    $_SESSION['message']['type']="success";

}else {
    $_SESSION['message']['text']="Il y'a une erreur lors de l'ajout du fournisseur";
    $_SESSION['message']['type']="fail";
    
}


}
else{
    $_SESSION['message']['text']="Une information obligatoire est manquée";
    $_SESSION['message']['type']="fail";
}

header('Location: ../vue/fournisseur.php');