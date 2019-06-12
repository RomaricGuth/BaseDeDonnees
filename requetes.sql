/* IDENTIFICATION A UTILISER AVEC LES VALEURS DU FORMULAIRES

SELECT I.statut, I.identifiant, A.prenom
FROM IDENTIFICATION I JOIN ADHERENT A ON I.ida=A.ida 
WHERE I.identifiant = 'id' AND I.mdp = 'pwd';
*/

/*Tous les noms de courses*/
CREATE OR REPLACE VIEW Nomcourses AS
SELECT nom
FROM COURSE;


/*Courses avec nombre de coureurs moyens, permet d'afficher également les courses qui n'ont pas encore étés courrues
Le nom est un lien pour avoir toutes les infos et modifier*/
CREATE OR REPLACE VIEW CoursesModif AS
SELECT CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=course&course=C', C.idc, '>', C.nom, '</a>') AS nom, AVG(E.nbPart) AS nbCoureursMoyen
FROM COURSE C JOIN EDITION E ON C.idc=E.idc
GROUP BY E.idc
UNION 
SELECT CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=course&course=C', idc, '>', nom, '</a>') AS nom, 'pas encore courru' AS nbCoureuresMoyen
FROM COURSE
WHERE idc NOT IN (SELECT idc FROM EDITION);

/*Avec lien html pour supprimer*/

/* la vue n'accepte pas une colonne sans nom
CREATE OR REPLACE VIEW CoursesSupp AS
SELECT nom, CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=courses&supp=C', idc, '>Supprimer</a>') AS ''
FROM COURSE;
*/

/*Toutes les infos d'une course*/
CREATE OR REPLACE VIEW InfosCourse AS
SELECT *
FROM COURSE;

/*Editions*/

CREATE OR REPLACE VIEW EditionsModif AS
SELECT C.nom as Course, CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=course&course=E', E.ided, '>', E.annee, '</a>') AS annee, E.idc, E.nbPart
FROM EDITION E JOIN COURSE C ON E.idc=C.idc;

/*Avec lien*/
/*
CREATE OR REPLACE VIEW EditionsSupp AS
SELECT C.nom as Course, E.annee, 
       CONCAT('<a href=http://localhost/projetBDW/espaceperso.php?page=courses&supp=E', E.ided, '>Supprimer</a>') AS ''
FROM EDITION E JOIN COURSE C ON E.idc=C.idc;
*/

/*Toutes les infos d'une edition*/
CREATE OR REPLACE VIEW InfosEdition AS
SELECT C.nom AS 'course', E.*, A.rue, A.codePost, A.ville
FROM EDITION E JOIN ADRESSE A ON E.idadr=A.idadr JOIN COURSE C ON E.idc=C.idc;


/* ADHERENTS */

/* infos */
CREATE OR REPLACE VIEW InfosAdherents AS
SELECT A.ida, A.nom, A.prenom, A.dateNaissance, A.sexe, A.dateCertif, AD.rue, AD.codePost, AD.ville, A.club
FROM ADHERENT A JOIN ADRESSE AD ON A.idadr=AD.idadr;

/* RESULTATS */


/* Temps final */
CREATE OR REPLACE VIEW tpsFinal AS
SELECT  R.ided, R.dossard, R.rang, R.nom, R.prenom, MAX(T.temps) AS temps, MAX(T.km) AS 'km'
FROM tpsPassage T JOIN RESULTAT R ON T.dossard=R.dossard AND R.ided=T.ided
GROUP BY t.dossard, R.ided;

CREATE OR REPLACE VIEW TpsFinalAdherents AS
SELECT T.*, A.sexe, A.club
FROM tpsFinal T JOIN ADHERENT A ON T.nom=A.nom AND T.prenom=A.prenom;