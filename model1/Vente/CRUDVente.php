<?php

require_once "Vente.php";
require_once "../config/connexion.php";

class CRUDVente{
    private $pdo;
    function __construct()
    {
        $obj = new connexion();
        $this->pdo = $obj->getConnexion();
    }

    function getVenteById($id) {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone
                FROM client AS c, vente AS v, article AS a 
                WHERE v.id_article=a.id AND v.id_client=c.id AND v.id=? AND etat=?";

        $req = $this->pdo->prepare($sql);
        $req->execute(array($id, 1));

        return $req->fetch();
    }

    function getAllVentes() {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
                FROM client AS c, vente AS v, article AS a 
                WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?";

        $req = $this->pdo->prepare($sql);
        $req->execute(array(1));

        return $req->fetchAll();
    }

    function ajouteVente(Vente $vente) {
    if (!empty($vente->getIdArticle()) && !empty($vente->getIdClient()) && !empty($vente->getQuantite()) && !empty($vente->getPrix())) {
        $article = getArticle($vente->getIdArticle());

        if (!empty($article) && is_array($article)) {
            if ($vente->getQuantite() > $article['quantite']) {
                $_SESSION['message']['text'] = "La quantité à vendre n'est pas disponible";
                $_SESSION['message']['type'] = "fail";
            } else {
                $sql = "INSERT INTO vente(id_article, id_client, quantite, prix) VALUES(?, ?, ?, ?)";
                $req = $this->pdo->prepare($sql);

                $req->execute(array(
                    $vente->getIdArticle(),
                    $vente->getIdClient(),
                    $vente->getQuantite(),
                    $vente->getPrix()
                ));

                if ($req->rowCount() != 0) {
                    $sql = "UPDATE article SET quantite = quantite - ? WHERE id = ?";
                    $req = $this->pdo->prepare($sql);

                    $req->execute(array(
                        $vente->getQuantite(),
                        $vente->getIdArticle()
                    ));

                    if ($req->rowCount() != 0) {
                        $_SESSION['message']['text'] = "Vente est effectuée avec succès";
                        $_SESSION['message']['type'] = "success";
                    } else {
                        $_SESSION['message']['text'] = "Impossible de faire cette vente";
                        $_SESSION['message']['type'] = "fail";
                    }
                } else {
                    $_SESSION['message']['text'] = "Une erreur s'est produite lors de la vente";
                    $_SESSION['message']['type'] = "fail";
                }
            }
        } else {
            $_SESSION['message']['text'] = "L'article spécifié n'existe pas";
            $_SESSION['message']['type'] = "fail";
        }
    } else {
        $_SESSION['message']['text'] = "Une information obligatoire est manquée";
        $_SESSION['message']['type'] = "fail";
    }
}

function modifierVente(Vente $vente) {
    if (!empty($vente->getId()) && !empty($vente->getIdArticle()) && !empty($vente->getIdClient()) && !empty($vente->getQuantite()) && !empty($vente->getPrix())) {
        $sql = "UPDATE vente SET id_article=?, id_client=?, quantite=?, prix=? WHERE id=?";
        $req = $this->pdo->prepare($sql);

        $req->execute(array(
            $vente->getIdArticle(),
            $vente->getIdClient(),
            $vente->getQuantite(),
            $vente->getPrix(),
            $vente->getId()
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "La vente est modifiée avec succès";
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
function annulerVente($idVente, $idArticle, $quantite) {
    if (!empty($idVente) && !empty($idArticle) && !empty($quantite)) {
        $sql = "UPDATE vente SET etat=? WHERE id=?";
        $req = $this->pdo->prepare($sql);
        $success = $req->execute(array(0, $idVente));

        if ($success && $req->rowCount() != 0) {
            $sql = "UPDATE article SET quantite = quantite + ? WHERE id=?";
            $req = $this->pdo->prepare($sql);
            $success = $req->execute(array($quantite, $idArticle));

            if ($success && $req->rowCount() != 0) {
                $_SESSION['message']['text'] = "La vente a été annulée avec succès.";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Erreur lors de l'annulation de la vente.";
                $_SESSION['message']['type'] = "error";
            }
        } else {
            $_SESSION['message']['text'] = "Erreur lors de l'annulation de la vente.";
            $_SESSION['message']['type'] = "error";
        }
    } else {
        $_SESSION['message']['text'] = "Paramètres manquants pour annuler la vente.";
        $_SESSION['message']['type'] = "error";
    }
}


function getCA()
{
    $sql = "SELECT SUM(prix) AS prix FROM vente";

    $req = $this->pdo->prepare($sql);

    $req->execute();

    return $req->fetch();

}

function getLastVente() 
{
        $sql= "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?
        ORDER BY date_vente DESC LIMIT 10 ";

        $req = $this->pdo->prepare($sql);

        $req->execute(array(1));

        return $req->fetchAll();
}

function getMostVente() 
{
        $sql= "SELECT nom_article, SUM(prix) AS prix
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?
        GROUP BY a.id
        ORDER BY SUM(prix) DESC LIMIT 10 ";

        $req = $this->pdo->prepare($sql);

        $req->execute(array(1));

        return $req->fetchAll();
}
function getCountVente(){
    $sql = "SELECT COUNT(*) AS nbre FROM vente WHERE etat=?";

    $req= $this->pdo->prepare($sql);

    $req->execute(array(1));

    return $req->fetch();

}

}?>