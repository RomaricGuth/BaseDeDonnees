<?php

    // modifications de l'adresse puis l'adherent avec les valeurs fournies

    include("../includes/connexionBD.php");
    $id = $_GET["adherent"];
    $query = 'UPDATE ADRESSE SET ';
    if ($_POST["rue"] != '') {$query .= "rue = '" . $_POST["rue"] . "', ";}
    if ($_POST["codePost"] != '') {$query .= "codePost = " . $_POST["codePost"] . ", ";}
    if ($_POST["ville"] != '') {$query .= "ville = '" . $_POST["ville"] . "'";}
    $query .= " WHERE idadr = (SELECT idadr FROM adherent WHERE ida = " . $id . ");";
    traiterRequete($query);

    $query = 'UPDATE ADHERENT SET nom = "' . $_POST["nom"] . '"';
    if ($_POST["prenom"] != '') {$query .= ', prenom = "' . $_POST["prenom"] . '"';}
    if ($_POST["dateNaissance"] != '') {$query .= ', dateNaissance = "' . $_POST["dateNaissance"] . '"';}
    if ($_POST["sexe"] != '') {$query .= ', sexe = "' . $_POST["sexe"] . '"';}
    if ($_POST["dateCertif"] != '') {$query .= ', dateCertif = "' . $_POST["dateCertif"] . '"';}
    if ($_POST["club"] != '') {$query .= ', club = "' . $_POST["club"] . '"';}
    $query .= " WHERE ida = " . $id;
    traiterRequete($query);
    header( 'Location: http://localhost/projetBDW/espaceperso.php?page=course&course=' . $_GET["course"] );
?>