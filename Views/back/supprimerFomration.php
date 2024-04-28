<?php
require_once ('../../Controller/FormationC.php'); // Assuming the path to your CoursC class

$formationc = new FormationC();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $formationc->supprimerFormation($id);
}

header("Location: formations.php");
?>