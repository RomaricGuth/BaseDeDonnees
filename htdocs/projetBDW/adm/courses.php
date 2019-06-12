<?php 
    if (!isset ($_GET["page"]) || $_GET["page"] != "courses") {
        header( 'Location: http://localhost/projetBDW/espaceperso.php');
    }
    if (isset($_GET["supp"])) {  // si on veut supprimer qqch
        //course C ou edition E
        $lettre = substr($_GET["supp"], 0, 1);
        $id = intval(substr($_GET["supp"], 1));

        if ($lettre == 'C') {  // si on veut supprimer une course
            $query = "DELETE FROM COURSE
                      WHERE idc=" . $id;
            traiterRequete($query);
        }

        else if ($lettre == 'E') { // si on veut supprimer une edition
            $query = "SELECT idadr FROM EDITION WHERE ided=" . $id;
            $res = traiterRequete($query);
            $idadr = $res[1]['idadr'];
            $query = "DELETE FROM ADRESSE WHERE idadr=" . $idadr; // supprime l'adresse de l'edition et l'edition en cascade
            traiterRequete($query);
        }
        header( 'Location: http://localhost/projetBDW/espaceperso.php?page=courses' );
    }

    if (isset($_GET["add"])) {  // si on veut ajouter qqch
        $lettre = substr($_GET["add"], 0, 1);
        $id = intval(substr($_GET["add"], 1));
        // on cree le formulaire d'ajout
        $form = '<form name="ajout" method="GET" action="http://localhost/projetBDW/adm/';

        if ($lettre == 'C') { // une course
            $form.= 'ajoutC.php">';
            $form.= 'Nom : <input name="nom" type="text" required><br>
                     Mois : <input name="mois" type="month"><br>
                     URL : <input name="url" type="url"><br>
                     Annee de creation : <input name="annee" type="number"<br>
                     <input type="submit" value="Ajouter">';
        }

        else if ($lettre == 'E') { // une edition
            $query = 'SELECT nom FROM COURSE';
            $res = traiterRequete($query);
            $form.= 'ajoutE.php">';
            $form.= 'Choisissez la course de l\'edition : 
                     <select name="course">';
            array_shift($res);
            foreach ($res as $nom) {
                $form.= '<option value="'.$nom["nom"].'">'.$nom["nom"].'</option>';
            }
            $form.= '</select> 
                     Année : <input name="annee" type="number" required><br>
                     Adresse de départ : 
                        Rue : <input name="rue" type="texte">
                        Code Postal : <input name="codePost" type="number">
                        Ville : <input name="ville" type="text"><br>
                     Plan : <input name="plan" type="file"><br> 
                     Inscription de : <input name="debI" type="date">
                     à : <input name="finI" type="date"><br>
                     dépôt des certificats de : <input name="debC" type="date">
                     à : <input name="finC" type="date"><br>
                     Récuperation des dossards de : <input name="debD" type="date">
                     à : <input name="finD" type="date"><br>
                     <input type="submit" value="Ajouter">';
        }
        echo($form);
    }

    else {

        // COURSES AVEC LIEN SUPPRIMER

        $query = "SELECT nom, CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=courses&supp=C', idc, '>Supprimer</a>') AS ''
                  FROM COURSE"; 
                
        $res = traiterRequete($query);
        if ($res != false) {
            echo("<h3>Courses</h3>");
            Array2Table($res);
        }
        echo('<a href=http://localhost/projetBDW/espaceperso.php?page=courses&add=C>Ajouter une course</a>');
        // EDITIONS AVEC LIEN SUPPRIMER

        $query = "SELECT C.nom as Course, E.annee, 
                        CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=courses&supp=E', E.ided, '>Supprimer</a>') AS ''
                  FROM EDITION E JOIN COURSE C ON E.idc=C.idc";

        $res = traiterRequete($query);

        if ($res != false) {
            echo("<h3>Editions</h3>");
            Array2Table($res);
        }
        echo('<a href=http://localhost/projetBDW/espaceperso.php?page=courses&add=E>Ajouter une edition de course</a>');
    }
?>