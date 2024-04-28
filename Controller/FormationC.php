<?php
include "../../configC.php";
require_once '../../Model/Formation.php';

class FormationC
{

    function ajouterFormation($formation)
    {
        $sql = "INSERT INTO formations (title, description, tuteur, prix) VALUES (:title, :description, :tuteur,:prix);";

        $db = configC::getConnexion();
        try {
            $query = $db->prepare($sql);

            $query->execute([
                'title' => $formation->getTitle(),
                'description' => $formation->getDescription(),
                'tuteur' => $formation->getTuteur(),
                'prix' => $formation->getPrix(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function afficherFormation()
    {
        $sql = "SELECT * FROM formations";
        $db = configC::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function supprimerFormation($id)
    {
        $sql = "DELETE FROM formations WHERE id = :id";
        $db = configC::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function getFormationById($id)
    {
        $sql = "SELECT * FROM formations WHERE id = :id";
        $db = configC::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function modifierFormation(Formation $formation)
    {
        try {
            $db = configC::getConnexion();
            $query = $db->prepare(
                'UPDATE formations SET 
                title = :title,
                description = :description,
                tuteur = :tuteur,
                prix = :prix
                WHERE id = :id'
            );
            $query->execute([
                'title' => $formation->getTitle(),
                'description' => $formation->getDescription(),
                'tuteur' => $formation->getTuteur(),
                'prix' => $formation->getPrix(),
                'id' => $formation->getId()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }


}

?>