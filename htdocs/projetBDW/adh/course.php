<?php //requête permettant de voir toutes les courses
    $query="SELECT C.nom AS NOM_COURSE, C.mois, C.url AS SITE_COURSE, C.anneeCrea AS CREATION_COURSE
             FROM EDITION E JOIN RESULTAT R ON E.ided = R.ided JOIN COURSE C ON E.idc = C.idc JOIN ADHERENT A ON A.nom = R.nom
             WHERE A.ida = ". $_SESSION["ida"];

    $res = traiterRequete($query);
    Array2Table($res);
?>