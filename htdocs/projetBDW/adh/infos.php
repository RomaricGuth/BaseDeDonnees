<?php //requete permettant d'afficher toutes les informations personnelles de l'utilisateur
    $query="SELECT A.ida AS NUMERO_ADHERENT, A.nom, A.prenom, A.dateNaissance, A.sexe, ADR.rue, ADR.codePost, ADR.ville, A.dateCertif AS LIMITE_CERTIF_MEDICAL, A.club
            FROM ADHERENT A JOIN ADRESSE ADR ON A.idadr = ADR.idadr
            WHERE A.ida = ". $_SESSION["ida"];

    $res = traiterRequete($query);
    Array2Table($res);
?>