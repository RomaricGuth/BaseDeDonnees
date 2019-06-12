<?php
    include("../includes/connexionBD.php");
    if ($_GET["nom"] != '') {                   // on demande que le nom soit donné mais le reste peut etre vide
        $table = "INSERT INTO COURSE (nom";
        $values = "VALUES ('" . $_GET["nom"] . "'";
        // a chaque fois on ajoute a la requete les champs qui ne sont pas null
        if ($_GET["mois"] != '') {$table .= ", mois"; $values .= ", " . $_GET["mois"];}
        if ($_GET["url"] != '') {$table .= ", url"; $values .= ", '" . $_GET["url"] . "'";}
        if ($_GET["annee"] != '') {$table .= ", anneeCrea"; $values .= ", " . $_GET["annee"];}

        $table .= ")";
        $values .= ")";

        $query = $table.$values;
        echo($query);
        traiterRequete($query);
    }
    header( 'Location: http://localhost/projetBDW/espaceperso.php?page=courses' );
?>