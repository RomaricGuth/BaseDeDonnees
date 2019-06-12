<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css"/>
        <title>Projet BDW1</title>
    </head>

<?php
    include("./includes/entete.php");
    if (isset($_SESSION["slogin"])) session_destroy();
?>

<body>
    <h1>Connectez-vous pour avoir accès à votre espace personnalisé !</h1>
	<form method="POST" name="authentification" action="espaceperso.php">
        <h4 name= "id"> Identifiant: </h4>
        <input name="pLogin" type="text"> 
        <br>
        <h4 name= "mdp"> Mot de passe: </h4>
        <input name="pPwd" type="password">
        <br>
        <input name="pEnvoyer" type="submit" value="connexion">
    </form>
</body>
</html>