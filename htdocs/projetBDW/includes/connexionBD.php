<?php
    function traiterRequete($query) { //lien et traitement de la requête sql avec mysql
        $c = mysqli_connect('localhost', 'root', '', 'asso_sportive');
        if(mysqli_connect_errno()) {    // erreur si > 0 
            printf("Échec de la connexion : %s",mysqli_connect_error());
            return false; 
        }
        // utilisation de la base 
        $res = mysqli_query($c, $query);

        if($res == FALSE) { // échec si Faux
            printf("Échec de la requête : "); 
            printf($query);
            return false;
        }
        if($res === TRUE) {return true;} // cas des requetes de type INSERT

        $tableauRetourne = array();
        $entete = array();
        $finfo = mysqli_fetch_fields($res);
        //entete
        foreach ($finfo as $val) {  
            $entete[] = $val->name; 
        }
        $tableauRetourne[0] = $entete;
        $i = 1;
        //RECUPERATION LIGNES PAR LIGNES
        while ($ligne = mysqli_fetch_assoc($res)) { 
            $tableauRetourne[$i]= $ligne;
            $i++; 
        }
        mysqli_free_result($res);
        mysqli_close($c);
        return $tableauRetourne;  
    }

    function traiterRequeteMult($querys) {
        $c = mysqli_connect('localhost', 'root', '', 'asso_sportive');
        if(mysqli_connect_errno()) {    // erreur si > 0 
            printf("Échec de la connexion : %s",mysqli_connect_error());
            return false; 
        }
        // utilisation de la base 
        

        if(!mysqli_multi_query($c, $querys)) { // échec si Faux
            printf("Échec des requêtes : "); 
            printf($querys);
            return false;
        }
        else {
            $tableauRetourne = array();
            $j = 0;
            do {     
                // On stocke les resultats un par un
                if ($res=mysqli_store_result($c)) {
                    $tableauRetourne[$j] = array();
                    $entete = array();
                    $finfo = mysqli_fetch_fields($res);
                    //entete
                    foreach ($finfo as $val) {  
                        $entete[] = $val->name; 
                    }
                    $tableauRetourne[$j] = $entete;
                    $j++;
                // Fetch one and one row

                while ($row=mysqli_fetch_assoc($res)) {
                    $tableauRetourne[$j] = array();
                    $tableauRetourne[$j] = $row;
                    $j++;
                }
                // Free result set
                mysqli_free_result($res);
                }
            } while (mysqli_next_result($c));
        }       
        mysqli_close($c);
        return $tableauRetourne;
    }
    
    function Array2Table($resReq) {  //création d'un tableau comportant le résultat d'une requête 
        $tabhtml = '<table>';
        foreach($resReq as $tuple) {  
            $tabhtml .='<tr>';
            foreach($tuple as $att=>$val) {  
                $tabhtml .= '<td>' . $val . '</td>';  
            }
            $tabhtml.='</tr>';
        }
        $tabhtml.='</table>';
        echo($tabhtml);
    }
?>
    