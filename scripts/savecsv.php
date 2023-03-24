<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nom_prenom = $_POST['nom_prenom'];
    $fonction = $_POST['fonction'];
    $duree_fonction = $_POST['duree_fonction'];
    $autre_fonction = $_POST['autre_fonction'];
    $communication_interne = $_POST['communication_interne'];
    $plateforme_communication = $_POST['plateforme_communication'];
    $communication_externe = $_POST['communication_externe'];
    $effectif_equipe = $_POST['effectif_equipe'];
    $effectif_entreprise = $_POST['effectif_entreprise'];
    $prise_decision = $_POST['prise_decision'];

    $data = array($nom_prenom, $fonction, $duree_fonction, $autre_fonction, $communication_interne, $plateforme_communication, $communication_externe, $effectif_equipe, $effectif_entreprise, $prise_decision);

    $file = fopen('form_data_' . $_POST['nom_prenom'] . '.csv', 'a');
    fputcsv($file, $data);
    fclose($file);
}
?>
