<?php
require_once('../../Controller/CoursC.php'); // Assuming the path to your CoursC class

$coursC = new CoursC();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $coursC->supprimerCours($id);
}

header("Location: courses.php");
?>