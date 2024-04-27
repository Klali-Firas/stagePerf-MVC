<?php
include 'connexion.php'; // Including the connection script to connect to the database.

// Checking if all the required fields are not empty in the POST data.

if (
    !empty($_POST['nom_article']) &&
    !empty($_POST['id_categorie']) &&
    !empty($_POST['quantite']) &&
    !empty($_POST['prix_unitaire']) && 
    !empty($_POST['date_fabrication'])
) {

    // If all required fields are present, constructing the SQL query to insert data into the database table.

    $sql="INSERT INTO $nom_base_de_donnee.article(nom_article, id_categorie, quantite, prix_unitaire, date_fabrication )
          VALUES(?, ?, ?, ?, ?)";

    // Preparing the SQL statement to be executed.

    $req = $connexion->prepare($sql);

    // Executing the prepared statement by passing the values from the POST data.

    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'], 
        $_POST['date_fabrication']
    ));

    // Checking if any rows were affected by the insert operation.

if ($req->rowCount()!=0) {
    $_SESSION['message']['text']="L'article est ajouté avec succès";
    $_SESSION['message']['type']="success";

}else {

    // If no rows were affected, setting a failure message to be displayed.

    $_SESSION['message']['text']="Il y'a une erreur lors de l'ajout d'un article";
    $_SESSION['message']['type']="fail";
    
}


}
else{
       
    // If any required field is missing in the POST data, setting a failure message to be displayed.

    $_SESSION['message']['text']="Une information obligatoire est manquée";
    $_SESSION['message']['type']="fail";
}

// Redirecting the user to the article.php page after processing.

header('Location: ../vue/article.php');