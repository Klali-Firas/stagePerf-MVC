<?php

require_once "Article.php";
require_once "../config/connexion.php";

class CRUDArticle
{
    private $pdo;

    function __construct()
    {
        $obj = new connexion();
        $this->pdo = $obj->getConnexion();
    }

    function getArticle($id = null, $searchData = array())
    {
        if (!empty($id)) {
            $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire,
                    date_fabrication, id_categorie, a.id
                    FROM article AS a, categorie_article AS c
                    WHERE a.id_categorie=c.id AND a.id=?";
            $req = $this->pdo->prepare($sql);
            $req->execute(array($id));
            return $req->fetch();
        } else {
            $search = "";

            if (!empty($searchData)) {
                extract($searchData);
                if (!empty($nom_article))
                    $search .= " AND a.nom_article LIKE '%$nom_article%' ";
                if (!empty($id_categorie))
                    $search .= " AND a.id_categorie = $id_categorie ";
                if (!empty($quantite))
                    $search .= " AND a.quantite = $quantite ";
                if (!empty($prix_unitaire))
                    $search .= " AND a.prix_unitaire = $prix_unitaire ";
                if (!empty($date_fabrication))
                    $search .= " AND DATE(a.date_fabrication) = '$date_fabrication' ";


            }
            $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire,
                    date_fabrication, id_categorie, a.id
                    FROM article AS a, categorie_article AS c
                    WHERE a.id_categorie=c.id $search";
            //this is the search bar
            $req = $this->pdo->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }

    }
    function getAllArticle()
    {
        $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire,
                    date_fabrication, id_categorie, a.id
                    FROM article AS a, categorie_article AS c
                    WHERE a.id_categorie=c.id";
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    function getCountArticle()
    {
        $sql = "SELECT COUNT(*) AS nbre FROM article";
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    function ajoutArticle(Article $article)
    {
        if (
            !empty($article->getNomArticle()) &&
            !empty($article->getIdCategorie()) &&
            !empty($article->getQuantite()) &&
            !empty($article->getPrixUnitaire()) &&
            !empty($article->getDateFabrication())
        ) {
            $sql = "INSERT INTO article (nom_article, id_categorie, quantite, prix_unitaire, date_fabrication)
                    VALUES (?, ?, ?, ?, ?)";
            $req = $this->pdo->prepare($sql);
            $req->execute(
                array(
                    $article->getNomArticle(),
                    $article->getIdCategorie(),
                    $article->getQuantite(),
                    $article->getPrixUnitaire(),
                    $article->getDateFabrication()
                )
            );

            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "L'article est ajouté avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Il y'a une erreur lors de l'ajout d'un article";
                $_SESSION['message']['type'] = "fail";
            }
        } else {
            $_SESSION['message']['text'] = "Une information obligatoire est manquée";
            $_SESSION['message']['type'] = "fail";
        }
        header("Location:article.php");
        exit;
    }

    function modifArticle(Article $article)
    {
        if (
            !empty($article->getNomArticle()) &&
            !empty($article->getIdCategorie()) &&
            !empty($article->getQuantite()) &&
            !empty($article->getPrixUnitaire()) &&
            !empty($article->getDateFabrication()) &&
            !empty($article->getId())
        ) {
            $sql = "UPDATE article SET nom_article=?, id_categorie=?, quantite=?, prix_unitaire=?,
                    date_fabrication=? WHERE id=?";
            $req = $this->pdo->prepare($sql);
            $req->execute(
                array(
                    $article->getNomArticle(),
                    $article->getIdCategorie(),
                    $article->getQuantite(),
                    $article->getPrixUnitaire(),
                    $article->getDateFabrication(),
                    $article->getId()
                )
            );

            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "L'article est modifié avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Rien n'a été modifié";
                $_SESSION['message']['type'] = "warning";
            }
        } else {
            $_SESSION['message']['text'] = "Une information obligatoire est manquée";
            $_SESSION['message']['type'] = "fail";
        }
        header("Location:article.php?id=" . $article->getId());
        exit;
    }

    function suppArticle($id)
    {
        if (!empty($id)) {
            $id_article = $id;

            $sql_check_dependents = "SELECT COUNT(*) FROM vente WHERE id_article=?";
            $req_check_dependents = $this->pdo->prepare($sql_check_dependents);
            $req_check_dependents->execute([$id_article]);
            $count_dependents = $req_check_dependents->fetchColumn();

            if ($count_dependents > 0) {
                $_SESSION['message']['text'] = "Impossible de supprimer l'article car il est associé à des ventes ou commandes.";
                $_SESSION['message']['type'] = "warning";
            } else {
                $sql_delete_article = "DELETE FROM article WHERE id=?";
                $req_delete_article = $this->pdo->prepare($sql_delete_article);
                $req_delete_article->execute([$id_article]);

                if ($req_delete_article->rowCount() != 0) {
                    $_SESSION['message']['text'] = "L'article a été supprimé avec succès";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Erreur lors de la suppression de l'article";
                    $_SESSION['message']['type'] = "warning";
                }
            }
        } else {
            $_SESSION['message']['text'] = "Aucun ID d'article spécifié";
            $_SESSION['message']['type'] = "fail";
        }
        header("Location:article.php");
        exit;
    }
}

?>