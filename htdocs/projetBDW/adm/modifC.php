<?php
    // modification d'une course avec les valeurs fournies
    include("../includes/connexionBD.php");
    $query = 'UPDATE COURSE SET nom = "' . $_POST["nom"] . '"';
    if ($_POST["mois"] != '') {$query .= ', mois = ' . $_POST["mois"];}
    if ($_POST["url"] != '') {$query .= ', url = "' . $_POST["url"] . '"';}
    if ($_POST["annee"] != '') {$query .= ', anneeCrea = ' . $_POST["annee"];}
    $query .= " WHERE idc = " . intval(substr($_GET["course"], 1));
    traiterRequete($query);
    header( 'Location: http://localhost/projetBDW/espaceperso.php?page=course&course=' . $_GET["course"] );
?>