<?php
$host = "mysql-studychoice.alwaysdata.net"; /* L'adresse du serveur */
$login = "136109"; /* Votre nom d'utilisateur */
$password = "ping"; /* Votre mot de passe */
$base = "studychoice_utilisateurs"; /* Le nom de la base */

function connexion()
{
    global $host, $login, $password, $base;
    $bdd = mysql_connect($host, $login, $password);
    mysql_select_db($base,$db);
}
echo "ok"
try{
	connexion();
	$bdd->seeAtribute( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) ;
	echo "reussie";
}
catch (Exception $e){
	echo "erreur";
	die('Erreur : ' . $e->getMessage());
}
?>