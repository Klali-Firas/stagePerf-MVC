<?php

require_once "Commande.php";
require_once "../config/connexion.php";

class CRUDCommande
{
    private $pdo;
    function __construct()
    {
        $obj = new connexion();
        $this->pdo = $obj->getConnexion();
    }
    function getCountCommande()
    {
        $sql = "SELECT COUNT(*) AS nbre FROM commande";

        $req = $this->pdo->prepare($sql);

        $req->execute();

        return $req->fetch();

    }

    function getCommande($id)
    {

        $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, prix_unitaire, adresse, telephone
        FROM fournisseur AS f, commande AS co, article AS a WHERE co.id_article=a.id AND co.id_fournisseur=f.id AND co.id=?";

        $req = $this->pdo->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

    }
    function getAllCommande()
    {
        $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, prix_unitaire, adresse, telephone, a.id AS idArticle
        FROM fournisseur AS f, commande AS co, article AS a WHERE co.id_article=a.id AND co.id_fournisseur=f.id";

        $req = $this->pdo->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }

    function ajoutCommande(Commande $commande)
    {
        if (!empty($commande->getIdArticle()) && !empty($commande->getIdFournisseur()) && !empty($commande->getQuantite()) && !empty($commande->getPrix())) {
            $sql_insert_commande = "INSERT INTO commande (id_article, id_fournisseur, quantite, prix) VALUES (?, ?, ?, ?)";
            $req_insert_commande = $this->pdo->prepare($sql_insert_commande);

            $req_insert_commande->execute(array($commande->getIdArticle(), $commande->getIdFournisseur(), $commande->getQuantite(), $commande->getPrix()));

            if ($req_insert_commande->rowCount() != 0) {
                $sql_update_article = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
                $req_update_article = $this->pdo->prepare($sql_update_article);

                $req_update_article->execute(array($commande->getQuantite(), $commande->getIdArticle()));

                if ($req_update_article->rowCount() != 0) {
                    $_SESSION['message']['text'] = "La commande est effectuée avec succès";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Impossible de faire cette commande";
                    $_SESSION['message']['type'] = "fail";
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la commande";
                $_SESSION['message']['type'] = "fail";
            }
        } else {
            $_SESSION['message']['text'] = "Une information obligatoire est manquée";
            $_SESSION['message']['type'] = "fail";
        }
        header("Location: commande.php");
        exit;
    }
    function modifCommande(Commande $commande)
    {
        if (!empty($commande->getId()) && !empty($commande->getIdArticle()) && !empty($commande->getIdFournisseur()) && !empty($commande->getQuantite()) && !empty($commande->getPrix())) {
            $sql = "UPDATE commande SET id_article=?, id_fournisseur=?, quantite=?, prix=? WHERE id=?";
            $req = $this->pdo->prepare($sql);

            $req->execute([$commande->getIdArticle(), $commande->getIdFournisseur(), $commande->getQuantite(), $commande->getPrix(), $commande->getId()]);

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
        header("Location: commande.php?id=" . $commande->getId());
        exit;
    }

    function annuleCommande($idCommande, $idArticle, $quantite)
    {
        if (!empty($idCommande) && !empty($idArticle) && !empty($quantite)) {
            $sql_update_article = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
            $req_update_article = $this->pdo->prepare($sql_update_article);
            $req_update_article->execute([$quantite, $idArticle]);

            $sql_delete_commande = "DELETE FROM commande WHERE id = ?";
            $req_delete_commande = $this->pdo->prepare($sql_delete_commande);
            $req_delete_commande->execute([$idCommande]);

            if ($req_delete_commande->rowCount() != 0) {
                $_SESSION['message']['text'] = "La commande a été annulée avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Erreur lors de l'annulation de la commande";
                $_SESSION['message']['type'] = "warning";
            }
        } else {
            $_SESSION['message']['text'] = "Données manquantes pour annuler la commande";
            $_SESSION['message']['type'] = "fail";
        }
        header("Location: commande.php");
        exit;
    }

}