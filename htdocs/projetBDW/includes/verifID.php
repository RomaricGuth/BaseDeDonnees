<?php // si les logs sont bons, on ouvre une session
    if (!isset($_SESSION))    session_start();
    if (!isset($_SESSION["slogin"])) {
        header( 'Location: http://localhost/projetBDW/erreur.php' );
    }
?>