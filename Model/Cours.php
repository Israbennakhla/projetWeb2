<?php
class Cours
{
    private $id;
    private $nom;
    private $description;
    private $duree;
    private $tuteur;
    private $nbrEtudiants;

    // Constructor
    public function __construct($id, $nom, $description, $duree, $tuteur, $nbrEtudiants)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->duree = $duree;
        $this->tuteur = $tuteur;
        $this->nbrEtudiants = $nbrEtudiants;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }


    public function getDuree()
    {
        return $this->duree;
    }

    public function getTuteur()
    {
        return $this->tuteur;
    }

    public function getNbrEtudiants()
    {
        return $this->nbrEtudiants;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    public function setTuteur($tuteur)
    {
        $this->tuteur = $tuteur;
    }

    public function setNbrEtudiants($nbrEtudiants)
    {
        $this->nbrEtudiants = $nbrEtudiants;
    }
}

?>