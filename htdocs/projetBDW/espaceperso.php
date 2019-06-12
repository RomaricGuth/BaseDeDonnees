<?php 
    include("./includes/entete.php"); // lance une session pour l'utilisateur
    include('./includes/connexionBD.php'); // connexion à la BD

    //test de l'acces par identifiaction
    if (!isset($_SESSION["slogin"])) {
        if (!isset($_POST["pEnvoyer"])) {
            header( 'Location: http://localhost/projetBDW/erreur.php' );
        }
        else { // Récupération des champs du formulaire
            $_SESSION["slogin"]= $_POST["pLogin"];
            $_SESSION["spwp"] = $_POST["pPwd"];

            // Identification
            $query = "SELECT I.statut, I.identifiant, A.prenom, A.ida
                    FROM IDENTIFICATION I JOIN ADHERENT A ON I.ida=A.ida 
                    WHERE identifiant = '" . $_SESSION["slogin"] . "' AND mdp = '" . $_SESSION["spwp"] . "'";
            $res = traiterRequete($query);
            //Verification du statut;
            if (count($res) <= 1) { // Erreur d'identification
                header( 'Location: http://localhost/projetBDW/erreur.php' );
            }
            else {
                $_SESSION["statut"] = $res[1]["statut"];
                $_SESSION["prenom"] = $res[1]["prenom"];
                $_SESSION["ida"] = $res[1]["ida"];

            }
        }
    }
    printf("Bienvenue " . $_SESSION["prenom"] ." ! <br> Vous etes connecté avec le login " . $_SESSION["slogin"] .'<br>');
    if ($_SESSION["statut"] == 'adh') { // ESPACE ADHERENT
        include("./adh/accueil.php");
    }
    else { // ESPACE ADMINISTRATEUR
        include("./adm/accueil.php");
    }
?>

<html> <!-- bouton de deconnection -->
<head>
 <meta charset="utf-8" />
<link rel="stylesheet" href="style.css"/>
    <form action="index.php">
        <input type="submit" name="deco" value="Se deconnecter">
    </form>
</html>