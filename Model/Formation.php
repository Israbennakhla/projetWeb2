<?php
class Formation
{
    private $id;
    private $title;
    private $description;
    private $tuteur;
    private $prix;
    private $coursList; //List of Cours objects
    // Constructor de la class "Formation" qui prend en paramètre l'ID, le titre et la description de la formation.

    public function __construct($id, $title, $description, $tuteur, $prix)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->tuteur = $tuteur;
        $this->prix = $prix;
        $this->coursList = array();
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
     *
     */
    public function setId($id)
    {
        $this->id = $id;

    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     */
    public function setTitle($title)
    {
        $this->title = $title;

    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     */
    public function setDescription($description)
    {
        $this->description = $description;

    }

    /**
     * Get the value of tuteur
     */
    public function getTuteur()
    {
        return $this->tuteur;
    }
    /**
     * Set the value of tuteur
     *
     */
    public function setTuteur($tuteur)
    {
        return $this->tuteur = $tuteur;
    }

    public function getPrix()
    {
        return $this->prix;
    }



    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    // Method to add a Cours object to the list
    public function addCours($cours)
    {
        $this->coursList[] = $cours;
    }

    // Method to get the list of Cours objects
    public function getCoursList()
    {
        return $this->coursList;
    }




}


?>