<?php 
    if (!isset ($_GET["page"]) || $_GET["page"] != "adherents") {
        header( 'Location: http://localhost/projetBDW/espaceperso.php');
    }

    if (isset($_GET["supp"])) {  // si on veut supprimer 
        $id = $_GET["supp"];
        $query = "SELECT idadr FROM ADHERENT WHERE ida=" . $id;
        $res = traiterRequete($query);
        $idadr = $res[1]['idadr'];
        $query = "DELETE FROM ADRESSE WHERE idadr=" . $idadr; // supprime l'adresse de l'adherent et l'edition en cascade
        traiterRequete($query);
        header( 'Location: http://localhost/projetBDW/espaceperso.php?page=adherents' );
    }

    else if (isset($_GET["add"])) {  // si on veut ajouter

        //formulaire d'ajout
        echo('<form method="POST" action="http://localhost/projetBDW/adm/ajoutA.php">
                Nom:
                <input name="newN" type="text"> <br>
                prénom:
                <input name="newP" type="text"> <br>
                Date de naissance:
                <input name="newDateNaiss" type="date"> <br>
                Sexe:
                <input name="newSexe" type="text"> <br>
                Date de validité du certificat médical :
                <input name="newDC" type="date"> <br>
                Club :
                <input name="newClub" type="text"> <br>
                Rue:
                <input name="rue" type="text"> <br>
                Code Postal:
                <input name="codePost" type="number"> <br>
                Ville:
                <input name="ville" type="text"> <br>
                Login :
                <input name="login" type="text" required> <br>
                Mot de passe  :
                <input name="pwd" type="text" required> <br>

                <input name="modifier" type="submit" value="Ajouter">
            </form>');
    }

    else { // pour avoir les infos avec lien pour selectionner un adherent et lien supprimer

        $query = "SELECT CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=adherent&adherent=', ida, '>', nom, '</a>') AS nom, prenom,
                         CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=adherents&supp=', ida, '>Supprimer</a>') AS ''
                  FROM ADHERENT"; 
                
        $res = traiterRequete($query);
        if ($res != false) {
            echo("<h3>Courses</h3>");
            Array2Table($res);
        }
        echo('<a href=http://localhost/projetBDW/espaceperso.php?page=adherents&add=>Ajouter un adherent</a>');
    }
?>