<?php
require_once ("../../Controller/FormationC.php");
require_once 'phpqrcode/qrlib.php';
$formationc = new FormationC();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formation_id'])) {
    // Assuming you have a function to get formation details by ID
    $formation = $formationc->getFormationById($_POST['formation_id']);

    // Generate QR code with formation details
    $qrData = "Formation: " . $formation['title'] . "\n  ,Description: " . $formation['description'];
    $qrPath = 'img/' . time() . '.png';
    QRcode::png($qrData, $qrPath, 'H', 4, 4);

    // Return QR code image URL
    echo $qrPath;
} else {
    // Invalid request
    http_response_code(400);
}
?>