<?php
    include("../includes/connexionBD.php");
    if ($_GET["annee"] != '') { // l'annee ne peut etre null
        // MEME PRINCIPE QUE POUR L'AJOUT DE COURSE
        // on commence par créer une adresse
        // attention si il y a une rue ou un CP, il doit y avoir une ville
        $table = "INSERT INTO ADRESSE (";
        $values = "VALUES (";
        // a chaque fois on ajoute a la requete les champs qui ne sont pas null
        if ($_GET["rue"] != '') {$table .= "rue, "; $values .= "'" . $_GET["rue"] . "', ";}
        if ($_GET["codePost"] != '') {$table .= "codePost, "; $values .=  $_GET["codePost"] . ", ";}
        if ($_GET["ville"] != '') {$table .= "ville"; $values .= "'" . $_GET["ville"] . "'";}
        $table .= ")";
        $values .= ")";

        $query = $table.$values.";";
        $query .= "\nSELECT LAST_INSERT_ID() AS 'id';";
        $res = traiterRequeteMult($query);
        $idadr = $res[1]['id'];

        $res = traiterRequete("SELECT idc FROM COURSE WHERE nom='" . $_GET["course"] . "'");
        $idc = $res[1]["idc"];
        $table = "INSERT INTO EDITION (annee";
        $values = "VALUES (" . $_GET["annee"];
        $table .= ", idc";
        $values .= ", " . $idc;
        $table .= ", idadr";
        $values .= ", " . $idadr;
        if ($_GET["plan"] != '') {$table .= ", plan"; $values .= ", '" . $_GET["plan"] . "'";}
        if ($_GET["debI"] != '') {$table .= ", debI"; $values .= ", '" . $_GET["debI"] . "'";}
        if ($_GET["finI"] != '') {$table .= ", finI"; $values .= ", '" . $_GET["finI"] . "'";}
        if ($_GET["debI"] != '') {$table .= ", debC"; $values .= ", '" . $_GET["debC"] . "'";}
        if ($_GET["finI"] != '') {$table .= ", finC"; $values .= ", '" . $_GET["finC"] . "'";}
        if ($_GET["debI"] != '') {$table .= ", debD"; $values .= ", '" . $_GET["debD"] . "'";}
        if ($_GET["finI"] != '') {$table .= ", finD"; $values .= ", '" . $_GET["finD"] . "'";}


        $table .= ")";
        $values .= ")";

        $query = $table.$values;
        traiterRequete($query);
    }
    

    
    header( 'Location: http://localhost/projetBDW/espaceperso.php?page=course' );
?>