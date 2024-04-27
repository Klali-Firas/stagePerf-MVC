<?php
include 'connexion.php'; // Including the connection script to connect to the database.

// Checking if all the required fields are not empty in the POST data.
if (
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['telephone']) &&
    !empty($_POST['adresse'])
) {
    // If all required fields are present, constructing the SQL query to insert data into the 'client' table.
    $sql = "INSERT INTO client(nom, prenom, telephone, adresse)
            VALUES(?, ?, ?, ?)";

    // Preparing the SQL statement to be executed.
    $req = $connexion->prepare($sql);

    // Executing the prepared statement by passing the values from the POST data.
    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
    ));

    // Checking if any rows were affected by the insert operation.
    if ($req->rowCount() != 0) {
        // If rows were affected, setting a success message to be displayed.
        $_SESSION['message']['text'] = "Le client est ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        // If no rows were affected, setting a failure message to be displayed.
        $_SESSION['message']['text'] = "Il y a une erreur lors de l'ajout du client";
        $_SESSION['message']['type'] = "fail";
    }
} else {
    // If any required field is missing in the POST data, setting a failure message to be displayed.
    $_SESSION['message']['text'] = "Une information obligatoire est manquée";
    $_SESSION['message']['type'] = "fail";
}

// Redirecting the user to the client.php page after processing.
header('Location: ../vue/client.php');
?>
