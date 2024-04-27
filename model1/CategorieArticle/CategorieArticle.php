<?php
class CategorieArticle {
    private $id;
    private $libelle_categorie;

    // Constructeur
    public function __construct($libelle_categorie) {
        $this->libelle_categorie = $libelle_categorie;
    }

    // Méthodes Getter et Setter pour les propriétés
    // (à implémenter selon vos besoins)

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of libelle_categorie
     */
    public function getLibelleCategorie()
    {
        return $this->libelle_categorie;
    }

    /**
     * Set the value of libelle_categorie
     */
    public function setLibelleCategorie($libelle_categorie): self
    {
        $this->libelle_categorie = $libelle_categorie;

        return $this;
    }
}
?>
