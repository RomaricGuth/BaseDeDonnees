<?php
    // verification
    if (!isset ($_GET["page"]) || !isset ($_GET["adherent"]) || $_GET["page"] != "adherent") {
        header( 'Location: http://localhost/projetBDW/espaceperso.php');
    }
    // IDA
    $id = $_GET["adherent"];

    if (isset($_GET["modif"])) {  // pour modifier

        // on recupère les valeurs actuelles
        $query = "SELECT nom, prenom, dateNaissance, sexe, rue, codePost, ville, dateCertif, club
                    FROM InfosAdherents
                    WHERE ida = ". $id;
        $res = traiterRequete($query);

        //on crée le formulaire et on va afficher le tableau créé par la requete avec les inputs
        echo('<form method="POST" action="http://localhost/projetBDW/adm/modifA.php?adherent=' . $id . '">');

        //nom
        $query = "SELECT CONCAT('<input type=\"texte\" name=\"nom\" ";
        if ($res[1]["nom"] != '') {$query .= "value=\"', nom, '\"";} // verification et attribution de la valeur actuelle en valeur par défaut
        $query .= ">') AS 'nom', "; 
        
        //prenom
        $query .= "CONCAT('<input type=\"texte\" name=\"prenom\" ";
        if ($res[1]["prenom"] != '') {$query .= "value=\"', prenom, '\"";}
        $query .= ">') AS 'prenom', ";

        //date de naissance
        $query .= "CONCAT('<input type=\"date\" name=\"dateNaissance\" ";
        if ($res[1]["dateNaissance"] != '') {$query .= "value=\"', dateNaissance, '\"";}
        $query .= ">') AS 'dateNaissance', ";

        // sexe
        $query .= "'H<input type=\"radio\" name=\"sexe\" value=\"H\" ";
        if ($res[1]["sexe"] == 'H') {$query .= "checked";}
        $query .= ">";
        $query .= "F<input type=\"radio\" name=\"sexe\" value=\"F\" ";
        if ($res[1]["sexe"] == 'F') {$query .= "checked";}
        $query .= ">' AS 'sexe', "; 
        
        // rue
        $query .= "CONCAT('<input type=\"texte\" name=\"rue\" ";
        if ($res[1]["rue"] != '') {$query .= "value=\"', rue, '\"";}
        $query .= ">') AS 'rue', ";

        // CP
        $query .= "CONCAT('<input type=\"number\" name=\"codePost\" ";
        if ($res[1]["codePost"] != '') {$query .= "value=\"', codePost, '\"";}
        $query .= ">') AS 'codePost', ";

        // ville
        $query .= "CONCAT('<input type=\"texte\" name=\"ville\" ";
        if ($res[1]["ville"] != '') {$query .= "value=\"', ville, '\"";}
        $query .= ">') AS 'ville', ";

        // date de fin du certificat
        $query .= "CONCAT('<input type=\"date\" name=\"dateCertif\" ";
        if ($res[1]["dateCertif"] != '') {$query .= "value=\"', dateCertif, '\"";}
        $query .= ">') AS 'dateCertif', ";

        // club
        $query .= "CONCAT('<input type=\"texte\" name=\"club\" ";
        if ($res[1]["club"] != '') {$query .= "value=\"', club, '\"";}
        $query .= ">') AS 'club' ";

        
        $query .= "FROM InfosAdherents WHERE ida = " . $id;
        $res = traiterRequete($query);
        Array2Table($res);
        echo('<input type="submit" value="Modifier"></form>');
    }

    else { // pour avoir toute les infos
        $query = "SELECT nom, prenom, dateNaissance, sexe, rue, codePost, ville, dateCertif, club
                    FROM InfosAdherents
                    WHERE ida = ". $id;
        $res = traiterRequete($query);
        Array2Table($res);
        
        echo('<a href="http://localhost/projetBDW/espaceperso.php?page=adherent&adherent=' . $id . '&modif=">Modifier les infos</a>');
    }
?>