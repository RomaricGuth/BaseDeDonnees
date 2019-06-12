<html>
    <h1>Bienvenue sur votre espace administrateur !</h1>
    <br/>
        <!-- MENU  -->
    <nav>        
            <h3>ACTIONS</h3>
            <ul>
                <li><a href='http://localhost/projetBDW/espaceperso.php'>Accueil</a></li>
                <li><a href='http://localhost/projetBDW/espaceperso.php?page=courses'>Ajouter/Supprimer des Courses</a></li>
                <li><a href="http://localhost/projetBDW/espaceperso.php?page=adherents">Adhérents</a></li>
                <li><a href="http://localhost/projetBDW/espaceperso.php?page=import">Adhérents</a></li>
            </ul>  
    </nav>

<?php
    include(dirname(__FILE__)."/../includes/verifID.php");

    // Affichage de la page
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        switch ($page) {
            case "courses": include(dirname(__FILE__)."/courses.php"); break;
            case "course" : include(dirname(__FILE__)."/course.php"); break;
            case "adherents" : include(dirname(__FILE__)."/adherents.php"); break;
            case "adherent" : include(dirname(__FILE__)."/adherent.php"); break;
            case "import" : include(dirname(__FILE__)."/import.php"); break;
            default: echo('URL incorrecte : <a href="../espaceperso.php">Retour à votre espace</a>');
        }
    }
    // Sinon Courses et editions
    else {
        $query="SELECT * FROM CoursesModif";  // courses

        $res = traiterRequete($query);
        if ($res != false) {
            echo("<h3>Courses</h3>");
            Array2Table($res);
        }
        $query = "SELECT Course, annee FROM EditionsModif"; /// editions
        $res = traiterRequete($query);
        if ($res != false) {
            echo("<h3>Editions</h3>");
            Array2Table($res);
        }
    }
?>



</html>