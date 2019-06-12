<?php
        // toutes les infos de l'edition 
    $query = "SELECT course, annee, rue AS AdresseDepart, codePost, ville, plan, debI, finI, debC, finC, debD, finD
                        FROM InfosEdition
                        WHERE ided = ". $id;
    $res = traiterRequete($query);
    Array2Table($res);
    echo('<a href="http://localhost/projetBDW/espaceperso.php?page=course&course=' . $_GET["course"] . '&modif=">Modifier l\'edition</a>');

    // Les adherents ayant couru la course
    $query = "SELECT *
            FROM TpsFinalAdherents
            WHERE ided=" . $id;
    $res = traiterRequete($query);
    // nb de participants adhérents
    echo("<h4>Adhérents ayant participé : ". (count($res)-1) . "</h4>");
    
    // nb en club
    $res = traiterRequete("SELECT COUNT(*) AS 'nb' FROM tpsFinalAdherents WHERE ided =" . $id ." AND club IS NOT NULL");
    echo("<br>Nombre en club : " . $res[1]['nb']);

    // nb de club
    $res = traiterRequete("SELECT COUNT(DISTINCT club) AS 'nb' FROM tpsFinalAdherents WHERE ided =" . $id ." AND club IS NOT NULL");
    echo("<br>Nombre de clubs differents : " . $res[1]['nb']);

    // on regarde les epreuves de l'edition
    echo('<br>Epreuves : ');
    $query = "SELECT DISTINCT(E.nom), E.idep FROM EPREUVE E JOIN TARIFS T ON E.idep=T.idep WHERE T.ided = " . $id;
    $res = traiterRequete($query);
    
    if (count($res) <= 1) {
        echo('aucune epreuve pour cette edition');
    }
    else {  // informations par epreuve
        $form = ('<form method="POST" action="http://localhost/projetBDW/espaceperso.php?page=course&course=' . $_GET["course"] . '">
            <select name="epreuve">');
        array_shift($res); // on enleve l'entete
        foreach ($res as $tuple) {
            $form .= '<option value="' . $tuple["idep"] . '"/>' . $tuple["nom"] . '</option>'; // on construit les options
        }
        $form .= '</select>
                <input type="submit" value="Voir resultats"/></form>';
        echo($form);
    }
    
    if (isset($_POST["epreuve"])) { // si une epreuve est choisie
        $idep = $_POST["epreuve"];
        $res = traiterRequete("SELECT dist FROM EPREUVE WHERE idep = " .$idep);
        // on regarde quelle est l'epreuve
        $km = $res[1]["dist"];

        // classement des adherents
        $query = "SELECT nom, prenom, rang
                FROM TpsFinalAdherents
                WHERE ided =" . $id . " AND ROUND(km,3) = " . $km . 
                " ORDER BY rang IS NULL, rang , nom, prenom";
        $res = traiterRequete($query);
        echo("Resultats de nos adherents a cette epreuve");
        Array2Table($res);

        //temps vainqueur
        $query = "SELECT ROUND(temps,2) AS 'temps'
                FROM tpsfinal 
                WHERE ided =" . $id . " AND rang=1 AND ROUND(km,3) = " . $km;
        $res = traiterRequete($query);
        echo("<br>Temps du vainqueur : " . $res[1]['temps']);

        // moyenne adherents
        $query = "SELECT ROUND(AVG(temps),2) AS 'temps' 
                FROM TpsFinalAdherents  
                WHERE ided =" . $id . " AND ROUND(km,3) = " . $km;
        $res = traiterRequete($query);
        echo("<br>Moyenne des adherents : " . $res[1]['temps']);


        $res = traiterRequete("SELECT sexe FROM TpsFinalAdherents WHERE ided =" . $id . " AND ROUND(km,3) = " . $km);
        $h = $f = false;
        $i = 1;
        while ((!$h || !$f) && $i < count($res)) { // on teste si il y a des hommes et des femmes
            if ($res[$i]["sexe"] == 'F') {$f = true;}
            if ($res[$i]["sexe"] == 'H') {$h = true;}
            $i++;
        }
        if ($h && $f) { // si oui

        // moyenne hommes
            $query = "SELECT ROUND(AVG(temps),2) AS 'temps' 
                    FROM TpsFinalAdherents 
                    WHERE ided =" . $id . " AND sexe='H' AND ROUND(km,3) = " . $km;
            $res = traiterRequete($query);
            echo("<br>Moyenne des adherents hommes : " . $res[1]['temps']);

            // moyenne femmes
            $query = "SELECT ROUND(AVG(temps),2) AS 'temps' 
                    FROM TpsFinalAdherents 
                    WHERE ided =" . $id . " AND sexe='F' AND ROUND(km,3) = " . $km;
            $res = traiterRequete($query);
            echo("<br>Moyenne des adherents femmes : " . $res[1]['temps']);
        }

        // moins bon temps adherent
        $query = "SELECT ROUND(MAX(temps),2) AS 'temps' 
                FROM TpsFinalAdherents  
                WHERE ided =" . $id . " AND ROUND(km,3) = " . $km;
        $res = traiterRequete($query);
        echo("<br>Moins bon temps d'un adhérent : " . $res[1]['temps']);

        // meilleur temps adherent
        $query = "SELECT ROUND(MIN(temps),2) AS 'temps' 
                FROM TpsFinalAdherents  
                WHERE ided =" . $id . " AND ROUND(km,3) = " . $km;
        $res = traiterRequete($query);
        echo("<br>Meilleur temps d'un adhérent : " . $res[1]['temps']);

        // nb abandons
        $query = "SELECT COUNT(*) AS 'nb' 
                FROM TpsFinalAdherents  
                WHERE ided =" . $id . " AND rang IS NULL AND ROUND(km,3) = " . $km;
        $res = traiterRequete($query);
        echo("<br>Nombre d'abandons : " . $res[1]['nb']);
    }
?>