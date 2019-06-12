<?php //si les logs ne correspondent pas à ceux présents dans la base, alors renvoie une page d'erreur
    include ("./includes/entete.php");
    if (isset($_SESSION["slogin"])) session_destroy();
    echo("Erreur d'identification\n");
    echo("<a href=http://localhost/projetBDW/index.php>Retournez à la page d'identification</a>");
?>