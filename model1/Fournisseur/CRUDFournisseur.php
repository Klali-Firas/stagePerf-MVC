<?php

require_once "Fournisseur.php";
require_once "../config/connexion.php";

class CRUDFournisseur {
    private $pdo;

    function __construct() {
        $obj = new connexion();
        $this->pdo = $obj->getConnexion();
    }

    function getFournisseur($id=null) {
        if (!empty($id)) {
            $sql = "SELECT * FROM fournisseur WHERE id=?";
            $req = $this->pdo->prepare($sql);
            $req->execute(array($id));
            return $req->fetch();
        } else {
            $sql = "SELECT * FROM fournisseur";
            $req = $this->pdo->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }
    }

    function ajoutFournisseur(Fournisseur $fournisseur) {
        if (
            !empty($fournisseur->getNom()) &&
            !empty($fournisseur->getPrenom()) &&
            !empty($fournisseur->getTelephone()) &&
            !empty($fournisseur->getAdresse())
        ) {
            $sql = "INSERT INTO fournisseur (nom, prenom, telephone, adresse) VALUES (?, ?, ?, ?)";
            $req = $this->pdo->prepare($sql);
            $req->execute(array(
                $fournisseur->getNom(),
                $fournisseur->getPrenom(),
                $fournisseur->getTelephone(),
                $fournisseur->getAdresse()
            ));

            if ($req->rowCount()!=0) {
                $_SESSION['message']['text'] = "Le fournisseur est ajouté avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Il y'a une erreur lors de l'ajout du fournisseur";
                $_SESSION['message']['type'] = "fail";
            }
        } else {
            $_SESSION['message']['text'] = "Une information obligatoire est manquée";
            $_SESSION['message']['type'] = "fail";
        }
    }

    function modifFournisseur(Fournisseur $fournisseur) {
        if (
            !empty($fournisseur->getNom()) &&
            !empty($fournisseur->getPrenom()) &&
            !empty($fournisseur->getTelephone()) &&
            !empty($fournisseur->getAdresse()) &&
            !empty($fournisseur->getId())
        ) {
            $sql = "UPDATE fournisseur SET nom=?, prenom=?, telephone=?, adresse=? WHERE id=?";
            $req = $this->pdo->prepare($sql);
            $req->execute(array(
                $fournisseur->getNom(),
                $fournisseur->getPrenom(),
                $fournisseur->getTelephone(),
                $fournisseur->getAdresse(),
                $fournisseur->getId()
            ));

            if ($req->rowCount()!=0) {
                $_SESSION['message']['text'] = "Le fournisseur est modifié avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Rien n'a été modifié";
                $_SESSION['message']['type'] = "warning";
            }
        } else {
            $_SESSION['message']['text'] = "Une information obligatoire est manquée";
            $_SESSION['message']['type'] = "fail";
        }
    }

    function suppFournisseur($id) {
        if (!empty($id)) {
            $id_fournisseur = $id;

            $sql_check_dependents = "SELECT COUNT(*) FROM commande WHERE id_fournisseur=?";
            $req_check_dependents = $this->pdo->prepare($sql_check_dependents);
            $req_check_dependents->execute([$id_fournisseur]);
            $count_dependents = $req_check_dependents->fetchColumn();

            if ($count_dependents > 0) {
                $_SESSION['message']['text'] = "Impossible de supprimer le fournisseur car il a des commandes associées.";
                $_SESSION['message']['type'] = "warning";
            } else {
                $sql_delete_fournisseur = "DELETE FROM fournisseur WHERE id=?";
                $req_delete_fournisseur = $this->pdo->prepare($sql_delete_fournisseur);
                $req_delete_fournisseur->execute([$id_fournisseur]);

                if ($req_delete_fournisseur->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Le fournisseur a été supprimé avec succès";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Erreur lors de la suppression du fournisseur";
                    $_SESSION['message']['type'] = "warning";
                }
            }
        } else {
            $_SESSION['message']['text'] = "Aucun ID de fournisseur spécifié";
            $_SESSION['message']['type'] = "fail";
        }
    }
}
?>
