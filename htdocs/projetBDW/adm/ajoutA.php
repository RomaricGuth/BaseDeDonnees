<?php
    include("../includes/entete.php");
    include("../includes/connexionBD.php");
    
    // constitution de la requete avec 2 variables
    $table = "INSERT INTO ADRESSE (";
    $values = "VALUES (";
        // a chaque fois on ajoute a la requete les champs qui ne sont pas null
        if ($_POST["rue"] != '') {$table .= "rue, "; $values .= "'" . $_POST["rue"] . "', ";}
        if ($_POST["codePost"] != '') {$table .= "codePost, "; $values .= $_POST["codePost"] . ", ";}
        if ($_POST["ville"] != '') {$table .= "ville"; $values .= "'" . $_POST["ville"] . "'";}
       
        $table .= ")";
        $values .= ")";

        $query = $table.$values.";";

        // pour avoir le dernier ID crée automatiquement
        $query .= "\nSELECT LAST_INSERT_ID() AS 'id';";
        $res = traiterRequeteMult($query);  // on est obligé de passer par une requete multiple(function dans connexionBD)
        $idadr = $res[1]['id'];

    // meme principe que précédemment
    $table = "INSERT INTO ADHERENT (";
    $values = "VALUES (";
        if($_POST["newN"] != '') {$table .= 'nom'; $values .= '"' .$_POST["newN"] . '"';}
        if($_POST["newP"] !='') {$table .= ', prenom'; $values.= ', "' . $_POST["newP"].'"';}
        if($_POST["newDateNaiss"] !='') {$table .= ', dateNaissance'; $values .= ', "' . $_POST["newDateNaiss"].'"';}
        if($_POST["newSexe"] !='') {$table .= ', sexe'; $values .= ', "' . $_POST["newSexe"].'"';}
        if($_POST["newDC"] !='') {$table .= ', dateCertif'; $values .= ', "' . $_POST["newDC"].'"';}
        if($_POST["newClub"] !='') {$table .= ', club'; $values .= ', "' . $_POST["newClub"].'"';}

        $table .= ", idadr)";
        $values .= ", " . $idadr . ")";

        $query = $table.$values.";";
        $query .= "\nSELECT LAST_INSERT_ID() AS 'id';";
        $res = traiterRequeteMult($query);
        $ida = $res[1]['id'];


    $query = "INSERT INTO IDENTIFICATION(ida, statut, identifiant, mdp)
              VALUES (" . $ida . ", 'adh', '" . $_POST["login"] . "', '" . $_POST["pwd"] . "')";

    traiterRequete($query);
    header( 'Location: http://localhost/projetBDW/espaceperso.php?page=adherents' );

?>