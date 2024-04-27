<?php

require_once "CategorieArticle.php";
require_once "../config/connexion.php";

class CRUDCategorieArticle{
    private $pdo;
    function __construct()
    {
        $obj = new connexion();
        $this->pdo = $obj->getConnexion();
    }

function getCategorie($id) 
{
    
        $sql= "SELECT * FROM categorie_article WHERE id=?";

        $req= $this->pdo->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
}
function getAllCategorie(){
     
        $sql= "SELECT * FROM categorie_article";

        $req= $this->pdo->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    
}
    function ajoutCategorie(CategorieArticle $categorieArticle){

    if (!empty($categorieArticle->getLibelleCategorie())) { // Check if the category name is not empty
        $sql="INSERT INTO categorie_article(libelle_categorie) VALUES(?)";
        $req = $this->pdo->prepare($sql);

        $req->execute(array($categorieArticle->getLibelleCategorie()));

        if ($req->rowCount()!=0) {
            $_SESSION['message']['text']="La catégorie est ajouté avec succès";
            $_SESSION['message']['type']="success";
        } else {
            $_SESSION['message']['text']="Il y'a une erreur lors de l'ajout du catégorie";
            $_SESSION['message']['type']="fail";
        }
    } else {
        $_SESSION['message']['text']="Une information obligatoire est manquée";
        $_SESSION['message']['type']="fail";
    }
}

function modifCategorie($libelle, $id) {
        if (!empty($libelle) && !empty($id)) {
            $sql = "UPDATE categorie_article SET libelle_categorie=? WHERE id=?";
            $req = $this->pdo->prepare($sql);

            $req->execute(array($libelle, $id));

            if ($req->rowCount() != 0) {
                $_SESSION['message']['text'] = "La catégorie est modifiée avec succès";
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
    function suppCategorie($id_categorie) {
        if (!empty($id_categorie)) {
            $sql_check_dependents = "SELECT COUNT(*) FROM article WHERE id_categorie=?";
            $req_check_dependents = $this->pdo->prepare($sql_check_dependents);
            $req_check_dependents->execute([$id_categorie]);
            $count_dependents = $req_check_dependents->fetchColumn();

            if ($count_dependents > 0) {
                $_SESSION['message']['text'] = "Impossible de supprimer la catégorie car elle est associée à des articles.";
                $_SESSION['message']['type'] = "warning";
            } else {
                $sql_delete_categorie = "DELETE FROM categorie_article WHERE id=?";
                $req_delete_categorie = $this->pdo->prepare($sql_delete_categorie);
                $req_delete_categorie->execute([$id_categorie]);

                if ($req_delete_categorie->rowCount() != 0) {
                    $_SESSION['message']['text'] = "La catégorie a été supprimée avec succès";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Erreur lors de la suppression de la catégorie";
                    $_SESSION['message']['type'] = "warning";
                }
            }
        } else {
            $_SESSION['message']['text'] = "Aucun ID de catégorie spécifié";
            $_SESSION['message']['type'] = "fail";
        }
    }

}
