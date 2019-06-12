<?php // requete permettant d'afficher tous les résultats d'un utilisateur
    $query="SELECT C.nom AS NOM_COURSE, E.annee AS ANNEE_COURSE, R.dossard AS NUMERO_DOSSARD, R.rang AS CLASSEMENT, TPS.temps AS TEMPS, TPS.km AS DIST
            FROM EDITION E JOIN RESULTAT R ON E.ided = R.ided JOIN COURSE C ON C.idc = E.idc JOIN ADHERENT A ON A.nom = R.nom JOIN tpspassage TPS on TPS.dossard = R.dossard 
            WHERE A.ida =" .$_SESSION["ida"]." AND TPS.km = "."(SELECT MAX(km) FROM tpspassage)"." AND TPS.ided = E.ided"."
            ORDER BY E.annee, TPS.km, TPS.temps DESC";

    $res = traiterRequete($query);
    Array2Table($res);
?>

