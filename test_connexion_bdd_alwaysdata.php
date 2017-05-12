<?php 
try{
	$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
	echo "succes";
}
catch(Exception $e){
	echo $e;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
LA CONNEXION A LA BASE DE DONNEES SUR LE WEB FONCTIONNE AVEC CE PDO !!!!!!!!!!!!!!!!!!!!!! 
</body>
</html>

