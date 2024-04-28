<?php
class Article
{
    private $id;
    private $nom_article;
    private $id_categorie;
    private $quantite;
    private $prix_unitaire;
    private $date_fabrication;

    // Constructeur
    public function __construct($id, $nom_article, $id_categorie, $quantite, $prix_unitaire, $date_fabrication)
    {
        $this->id = $id;
        $this->nom_article = $nom_article;
        $this->id_categorie = $id_categorie;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
        $this->date_fabrication = $date_fabrication;
    }

    // Méthodes Getter et Setter pour les propriétés
    // (à implémenter selon vos besoins)

    /**
     * Get the value of date_fabrication
     */
    public function getDateFabrication()
    {
        return $this->date_fabrication;
    }

    /**
     * Set the value of date_fabrication
     */
    public function setDateFabrication($date_fabrication): self
    {
        $this->date_fabrication = $date_fabrication;

        return $this;
    }

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
     * Get the value of nom_article
     */
    public function getNomArticle()
    {
        return $this->nom_article;
    }

    /**
     * Set the value of nom_article
     */
    public function setNomArticle($nom_article): self
    {
        $this->nom_article = $nom_article;

        return $this;
    }

    /**
     * Get the value of id_categorie
     */
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     */
    public function setIdCategorie($id_categorie): self
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    /**
     * Get the value of quantite
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     */
    public function setQuantite($quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of prix_unitaire
     */
    public function getPrixUnitaire()
    {
        return $this->prix_unitaire;
    }

    /**
     * Set the value of prix_unitaire
     */
    public function setPrixUnitaire($prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }
}
?>