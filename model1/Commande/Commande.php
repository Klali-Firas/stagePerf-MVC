<?php
class Commande {
    private $id;
    private $id_article;
    private $id_fournisseur;
    private $quantite;
    private $prix;
    private $date_commande;
    private $etat;

    // Constructeur
    public function __construct($id_article, $id_fournisseur, $quantite, $prix, $date_commande, $etat) {
        $this->id_article = $id_article;
        $this->id_fournisseur = $id_fournisseur;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->date_commande = $date_commande;
        $this->etat = $etat;
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
     * Get the value of id_article
     */
    public function getIdArticle()
    {
        return $this->id_article;
    }

    /**
     * Set the value of id_article
     */
    public function setIdArticle($id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }

    /**
     * Get the value of id_fournisseur
     */
    public function getIdFournisseur()
    {
        return $this->id_fournisseur;
    }

    /**
     * Set the value of id_fournisseur
     */
    public function setIdFournisseur($id_fournisseur): self
    {
        $this->id_fournisseur = $id_fournisseur;

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
     * Get the value of prix
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     */
    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of date_commande
     */
    public function getDateCommande()
    {
        return $this->date_commande;
    }

    /**
     * Set the value of date_commande
     */
    public function setDateCommande($date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    /**
     * Get the value of etat
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     */
    public function setEtat($etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
?>
