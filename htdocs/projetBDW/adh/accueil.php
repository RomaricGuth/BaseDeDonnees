<html>
<head>
 <meta charset="utf-8" />
<link rel="stylesheet" href="style.css"/>

    <h1>Bienvenue sur votre espace adhérent ! </h1>
    <br/>

    <nav>        
            <h3>ACTIONS</h3>
            <ul>
                <li><a href='http://localhost/projetBDW/espaceperso.php'>Accueil</a></li>
                <li> <a href='http://localhost/projetBDW/espaceperso.php?page=infos'> Voir vos informations personnelles </a> </li>
                <li> <a href='http://localhost/projetBDW/espaceperso.php?page=fiche'> Modifier infos personnelles </a></li>
                <li> <a href='http://localhost/projetBDW/espaceperso.php?page=courses'> Voir les éditions de vos courses </a> </li>
                <li> <a href='http://localhost/projetBDW/espaceperso.php?page=course'> Voir l'ensemble de vos courses </a> </li>
                <li> <a href='http://localhost/projetBDW/espaceperso.php?page=res'> Voir vos résultats </a> </li>
            </ul>  
    </nav>

<?php
    if (isset($_GET["page"])) { // Charge la page en fonction de l'url
        $page = $_GET["page"];
        switch ($page) {
            case "fiche": include(dirname(__FILE__)."/fiche.php"); break;
            case "infos": include(dirname(__FILE__)."/infos.php"); break;
            case "courses": include(dirname(__FILE__)."/courses.php"); break;
            case "course": include(dirname(__FILE__)."/course.php"); break;
            case "res": include(dirname(__FILE__)."/resultats.php"); break;
            default: echo('URL incorrecte : <a href="../espaceperso.php">Retour à votre espace</a>');
        }
    }
 
?>



</html>