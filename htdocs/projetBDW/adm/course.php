<?php
    if (!isset ($_GET["page"]) || !isset ($_GET["course"]) || $_GET["page"] != "course") {
        header( 'Location: http://localhost/projetBDW/espaceperso.php');
    }
    $lettre = substr($_GET["course"], 0, 1);
    $id = intval(substr($_GET["course"], 1));

    if ($lettre == 'C') {  // si l'utilisateur a clique sur une course

        if (isset($_GET["modif"])) {  // pour modifier

            // MEME PRINCIPE QUE POUR MODIFIER LA FICHE D'UN ADHERENT (voir commentaires)
            $query = "SELECT nom, mois, url, anneeCrea
                      FROM InfosCourse
                      WHERE idc = ". $id;
            $res = traiterRequete($query);

            echo('<form method="POST" action="http://localhost/projetBDW/adm/modifC.php?course=' . $_GET["course"] . '" enctype="multipart/form-data">');
            
            $query = "SELECT nom, CONCAT('<input type=\"number\" name=\"mois\" ";
            if ($res[1]["mois"] != '') {$query .= "value=\"', mois, '\"";}
            $query .= ">') AS 'mois', ";

            $query .= "CONCAT('<input type=\"url\" name=\"url\" ";
            if ($res[1]["url"] != '') {$query .= "value=\"', url, '\"";}
            $query .= ">') AS 'url', ";

            $query .= "CONCAT('<input type=\"date\" name=\"anneeCrea\" ";
            if ($res[1]["anneeCrea"] != '') {$query .= "value=\"', anneeCrea, '\"";}
            $query .= ">') AS 'anneeCrea', ";

            $query .= "CONCAT('<input type=\"hidden\" name=\"nom\" value=\"', nom, '\">') AS ''";
            $query .= " FROM InfosCourse WHERE idc = " . $id;
            $res = traiterRequete($query);
            Array2Table($res);
            echo('<input type="submit" value="Modifier"></form>');
        }
        else { // pour avoir toute les infos d'une course et de ses editions
            $query = "SELECT nom, mois, url, anneeCrea
                      FROM InfosCourse
                      WHERE idc = ". $id;
            $res = traiterRequete($query);
            Array2Table($res);
            
            echo('<a href="http://localhost/projetBDW/espaceperso.php?page=course&course=' . $_GET["course"] . '&modif=">Modifier la course</a>');
            echo('<br><h3>Edtions de cette course</h3><br>');

            $query = "SELECT annee, nbPart
                      FROM EditionsModif
                      WHERE idc = ". $id;
            $res = traiterRequete($query);
            Array2Table($res);
        }
        
    }
    
    else if ($lettre == 'E') { // si l'utilisateur a cliqué sur une edition
        
        if (isset($_GET["modif"])) { // pour modifier
            $query=    "SELECT course, annee, rue, codePost, ville, plan, debI, finI, debC, finC, debD, finD
                        FROM InfosEdition
                        WHERE ided = ". $id;
            $res = traiterRequete($query);
            echo('<form method="POST" action="http://localhost/projetBDW/adm/modifE.php?course=' . $_GET["course"] . '">');
            
                // REQUETE CREEANT UN FORMULAIRE TJR LE MEME PRINCIPE
            $query = "SELECT annee, CONCAT('<input type=\"texte\" name=\"rue\" ";
            if ($res[1]["rue"] != '') {$query .= "value=\"', rue, '\"";}
            $query .= ">') AS 'rue', ";

            $query .= "CONCAT('<input type=\"number\" name=\"codePost\" ";
            if ($res[1]["codePost"] != '') {$query .= "value=\"', codePost, '\"";}
            $query .= ">') AS 'codePost', ";

            $query .= "CONCAT('<input type=\"texte\" name=\"ville\" ";
            if ($res[1]["ville"] != '') {$query .= "value=\"', ville, '\"";}
            $query .= ">') AS 'ville', ";

            $query .= "CONCAT('<input type=\"file\" name=\"plan\" ";
            if ($res[1]["plan"] != '') {$query .= "value=\"', plan, '\"";}
            $query .= ">') AS 'plan', ";

            $query .= "CONCAT('<input type=\"date\" name=\"debI\" ";
            if ($res[1]["debI"] != '') {$query .= "value=\"', debI, '\"";}
            $query .= ">') AS 'debI', ";

            $query .= "CONCAT('<input type=\"date\" name=\"finI\" ";
            if ($res[1]["finI"] != '') {$query .= "value=\"', finI, '\"";}
            $query .= ">') AS 'finI', ";

            $query .= "CONCAT('<input type=\"date\" name=\"debC\" ";
            if ($res[1]["debC"] != '') {$query .= "value=\"', debC, '\"";}
            $query .= ">') AS 'debC', ";

            $query .= "CONCAT('<input type=\"date\" name=\"finC\" ";
            if ($res[1]["finC"] != '') {$query .= "value=\"', finC, '\"";}
            $query .= ">') AS 'finC', ";

            $query .= "CONCAT('<input type=\"date\" name=\"debD\" ";
            if ($res[1]["debD"] != '') {$query .= "value=\"', debD, '\"";}
            $query .= ">') AS 'debD', ";

            $query .= "CONCAT('<input type=\"date\" name=\"finD\" ";
            if ($res[1]["finD"] != '') {$query .= "value=\"', finD, '\"";}
            $query .= ">') AS 'finD', ";

            $query .= "CONCAT('<input type=\"hidden\" name=\"annee\" value=\"', annee, '\">') AS ''";
            $query .= " FROM InfosEdition WHERE ided = " . $id;
            $res = traiterRequete($query);
            Array2Table($res);
            echo('<input type="submit" value="Modifier"></form>');
        }
        else { // pour les resultats
            include (dirname(__FILE__)."/resultats.php");
        }
    }
?>