<?php //requete permettant de voir toutes les éditions
    $query="SELECT E.annee, E.nbPart AS NBR_PARTICIPANTS, E.debI AS DEBUT_INSCRIPTIONS, E.finI AS FIN_INSCRIPTIONS, E.debC AS DEBUT_CERTIF, E.finC LIMITE_CERTIF, E.debD AS DEBUT_DOSSARD, E.finD AS LIMITE_DOSSARD, E.plan
             FROM EDITION E JOIN RESULTAT R ON E.ided = R.ided JOIN ADHERENT A ON A.nom = R.nom
             WHERE A.ida = " . $_SESSION["ida"] ;

    $res = traiterRequete($query);
    Array2Table($res);
?>