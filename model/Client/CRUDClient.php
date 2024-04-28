<?php

require_once "Client.php";
require_once "../config/connexion.php";

class CRUDClient
{
    private $pdo;
    function __construct()
    {
        $obj = new connexion();
        $this->pdo = $obj->getConnexion();
    }

    function getClient($id = null)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM client WHERE id=?";

            $req = $this->pdo->prepare($sql);

            $req->execute(array($id));

            return $req->fetch();
        } else {
            $sql = "SELECT * FROM client";

            $req = $this->pdo->prepare($sql);

            $req->execute();

            return $req->fetchAll();
        }
    }
    function ajoutClient(Client $client)
    {
        if (
            !empty($client->getNom()) &&
            !empty($client->getPrenom()) &&
            !empty($client->getTelephone()) &&
            !empty($client->getAdresse())
        ) {
            // Construct the SQL query
            $sql = "INSERT INTO client(nom, prenom, telephone, adresse)
                VALUES(?, ?, ?, ?)";

            // Prepare the SQL statement
            $req = $this->pdo->prepare($sql);

            // Execute the prepared statement by passing the values from the Client object
            $success = $req->execute(
                array(
                    $client->getNom(),
                    $client->getPrenom(),
                    $client->getTelephone(),
                    $client->getAdresse()
                )
            );

            // Check if the query executed successfully
            if ($success && $req->rowCount() != 0) {
                $_SESSION['message']['text'] = "Le client est ajouté avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Il y a une erreur lors de l'ajout du client";
                $_SESSION['message']['type'] = "fail";
            }
        } else {

            $_SESSION['message']['text'] = "Une information obligatoire est manquée";
            $_SESSION['message']['type'] = "fail";
        }
        header('Location: client.php');
        exit;


    }
    function modifClient(Client $client)
    {
        if (
            !empty($client->getNom()) &&
            !empty($client->getPrenom()) &&
            !empty($client->getTelephone()) &&
            !empty($client->getAdresse()) &&
            !empty($client->getId())
        ) {
            // Construct the SQL query
            $sql = "UPDATE client SET nom=?, prenom=?, telephone=?, adresse=?
                WHERE id=? ";
            // Prepare the SQL statement
            $req = $this->pdo->prepare($sql);

            // Execute the prepared statement by passing the values from the Client object
            $req->execute(
                array(
                    $client->getNom(),
                    $client->getPrenom(),
                    $client->getTelephone(),
                    $client->getAdresse(),
                    $client->getId()
                )
            );

            // Check if any rows were affected by the update operation
            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "Le client est modifié avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Rien n'a été modifié";
                $_SESSION['message']['type'] = "warning";
            }
        } else {
            $_SESSION['message']['text'] = "Une information obligatoire est manquée";
            $_SESSION['message']['type'] = "fail";
        }
        header('Location: client.php?id=' . $client->getId());
        exit;

    }

    function suppClient($id)
    {
        if (!empty($id)) {
            $id_client = $id;


            $sql_delete_vente = "DELETE FROM vente WHERE id_client=?";
            $req_delete_vente = $this->pdo->prepare($sql_delete_vente);
            $req_delete_vente->execute([$id_client]);


            $sql_delete_client = "DELETE FROM client WHERE id=?";
            $req_delete_client = $this->pdo->prepare($sql_delete_client);
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
        header('Location: client.php');
        exit;



    }
}