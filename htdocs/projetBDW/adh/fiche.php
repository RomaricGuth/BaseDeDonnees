<!--Formulaire permettant la modification des données personnelles-->
<html>
    <form method="POST" name="modif" action="http://localhost/projetBDW/adh/modif.php">
    Nom:
    <input name="newN" type="text" required> <br>
    prénom:
    <input name="newP" type="text" required> <br>
    Date de naissance:
    <input name="newDateNaiss" type="date"> <br>
    Sexe:
    <input name="newSexe" type="text" required> <br>
    Date de validité du certificat médical :
    <input name="newDC" type="date"> <br>
    Club :
    <input name="newClub" type="text"> <br>
    Adresse: <br>
    Rue:
    <input name="newRue" type="text"> <br>
    Code Postal:
    <input name="newCP" type="number"> <br>
    Ville:
    <input name="newVille" type="text"> <br>

    <input name="modifier" type="submit" value="Enregistrer">
    </form>

</html>


