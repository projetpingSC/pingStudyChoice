<?php

echo 'ok';
try{
$bdd = new PDO('mysql:host=mysql-studychoice.alwaysdata.net;dbname=studychoice_utilisateurs','136109','ping');
} catch (Exception $e){
	echo 'erreur';
}


?>