<?php
    echo('<form method="POST" action="http://localhost/projetBDW/espaceperso.php?page=import&file="  enctype="multipart/form-data">
            <input type="file" name="fichier">
            <input type="submit" value="importer">
        </form>');

    if(isset($_GET["file"])) { // erreur à ce niveau, le fichier n'est pas transmis ?
        // path
        $fichier = "projetBDW1/files/" . basename($_FILES["fichier"]["name"]);
        // pour garder le fichier dans le dossier du site
        move_uploaded_file($_FILES['fichier']['tmp_name'], "projetBDW1/files/" . $fichier);
        $query = file_get_contents($fichier);
        // requetes une par une
        $array = explode(";\n", $query);
        foreach($array as $query) {
            traiterRequete($query);
        }
        header('Location: http://localhost/projetBDW/espaceperso.php');
    }
?>