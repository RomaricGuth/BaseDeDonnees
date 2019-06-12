<?php //requete permettant de soumettre toutes les modifications au serveur mysql
    include("../includes/entete.php");
    include("../includes/connexionBD.php");

    $query = 'UPDATE ADHERENT INNER JOIN ADRESSE ON(ADHERENT.idadr=ADRESSE.idadr) SET ';
            if($_POST["newN"] != '') {$query .= ' nom = "' . $_POST["newN"] . '"';}
            if($_POST["newP"] !='') {$query .= ', prenom = "'. $_POST["newP"].'"';}
            if($_POST["newDateNaiss"] !='') {$query .= ', dateNaissance = "'. $_POST["newDateNaiss"].'"';}
            if($_POST["newSexe"] !='') {$query .= ', sexe = "'. $_POST["newSexe"].'"';}
            if($_POST["newDC"] !='') {$query .= ', dateCertif = "'. $_POST["newDC"].'"';}
            if($_POST["newClub"] !='') {$query .= ', club = "'. $_POST["newClub"].'"';}
            if($_POST["newRue"] !='') {$query .= ', rue = "'. $_POST["newRue"].'"';}
            if($_POST["newCP"] !='') {$query .= ', codePost = "'. $_POST["newCP"].'"';}
            if($_POST["newVille"] !='') {$query .= ', ville = "'. $_POST["newVille"].'"';}

        $query .= " WHERE ADHERENT.ida = ". $_SESSION["ida"] ;

    traiterRequete($query);

    header( 'Location: http://localhost/projetBDW/espaceperso.php?page=fiche' );

?>
