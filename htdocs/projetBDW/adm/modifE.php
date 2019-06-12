<?php
    // modification de l'adresse puis de l'edition avec les vleurs fournies
    include("../includes/connexionBD.php");
    $id = intval(substr($_GET["course"], 1));
    $query = 'UPDATE ADRESSE SET ';
    if ($_POST["rue"] != '') {$query .= "rue = '" . $_POST["rue"] . "', ";}
    if ($_POST["codePost"] != '') {$query .= "codePost = " . $_POST["codePost"] . ", ";}
    if ($_POST["ville"] != '') {$query .= "ville = '" . $_POST["ville"] . "'";}
    $query .= " WHERE idadr = (SELECT idadr FROM EDITION WHERE ided = " . $id . ");";
    traiterRequete($query);

    
    $query = 'UPDATE EDITION SET annee = ' . $_POST["annee"];
    if (isset($_FILES["plan"])) {
        echo("content");
        $query .= ', plan = "' . $_FILES["plan"]["name"] . '"';
        move_uploaded_file($_FILES['plan']['tmp_name'], "projetBDW1/files/" . basename($_FILES["plan"]["name"]));
    }
    if ($_POST["debI"] != '') {$query .= ', debI = "' . $_POST["debI"] . '"';}
    if ($_POST["finI"] != '') {$query .= ', finI = "' . $_POST["finI"] . '"';}
    if ($_POST["debC"] != '') {$query .= ', debC = "' . $_POST["debC"] . '"';}
    if ($_POST["finC"] != '') {$query .= ', finC = "' . $_POST["finC"] . '"';}
    if ($_POST["debD"] != '') {$query .= ', debD = "' . $_POST["debD"] . '"';}
    if ($_POST["finD"] != '') {$query .= ', finD = "' . $_POST["finD"] . '"';}
    $query .= " WHERE ided = " . $id;
    
    header( 'Location: http://localhost/projetBDW/espaceperso.php?page=course&course=' . $_GET["course"] );
?>