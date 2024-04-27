<?php
class Vente {
    private $id;
    private $id_article;
    private $id_client;
    private $quantite;
    private $prix;
    private $date_vente;
    private $etat;

    // Constructeur
    public function __construct($id_article, $id_client, $quantite, $prix, $date_vente, $etat) {
        $this->id_article = $id_article;
        $this->id_client = $id_client;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->date_vente = $date_vente;
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
     * Get the value of id_client
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * Set the value of id_client
     */
    public function setIdClient($id_client): self
    {
        $this->id_client = $id_client;

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
     * Get the value of date_vente
     */
    public function getDateVente()
    {
        return $this->date_vente;
    }

    /**
     * Set the value of date_vente
     */
    public function setDateVente($date_vente): self
    {
        $this->date_vente = $date_vente;

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
