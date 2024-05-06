<?php

include "../../config.php";
require_once '../../Model/Cours.php';


class CoursC
{

    function ajouterCours($cours)
    {
        $sql = "INSERT INTO Cours (nom, description, duree, tuteur, nbrEtudiants, formation_id) 
                VALUES (:nom, :description, :duree, :tuteur, :nbrEtudiants, :formation_id)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);

            $query->execute([
                'nom' => $cours->getNom(),
                'description' => $cours->getDescription(),
                'duree' => $cours->getDuree(),
                'tuteur' => $cours->getTuteur(),
                'nbrEtudiants' => $cours->getNbrEtudiants(),
                'formation_id' => $cours->getFormation()
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function afficherCours()
    {
        $sql = "SELECT * FROM cours";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function supprimerCours($id)
    {
        $sql = "DELETE FROM cours WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function getCoursById($id)
    {
        $sql = "SELECT * FROM cours WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function modifierCours(Cours $cours)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE cours SET 
                    nom = :nom,
                    description = :description,
                    duree = :duree,
                    tuteur = :tuteur,
                    nbrEtudiants = :nbrEtudiants
                    WHERE id = :id'
            );
            $query->execute([
                'nom' => $cours->getNom(),
                'description' => $cours->getDescription(),
                'duree' => $cours->getDuree(),
                'tuteur' => $cours->getTuteur(),
                'nbrEtudiants' => $cours->getNbrEtudiants(),
                'id' => $cours->getId()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function nomExisteDeja($nom)
    {
        $sql = "SELECT COUNT(*) AS count FROM cours WHERE nom = :nom";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':nom', $nom);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0; // Retourne true si le nom existe déjà, sinon false
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false; // En cas d'erreur, retourne false
        }
    }
    function getFormationTitle($formation_id)
    {
        $sql = "select title from formation where id=:id";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);

            $req->bindValue(':id', $formation_id);

            $req->execute();
            $data = $req->fetch();

            $req->closeCursor();
            return $data['title'];
        } catch (exception $e) {
            die("Erreur:  " . $e->getMessage());
        }
    }
}
?>