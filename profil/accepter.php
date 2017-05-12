<?php 
session_start();

//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', '');

//$insertmbr = $bdd->prepare("UPDATE users SET en_cours = 1 WHERE id = ?");
$insertmbr = $bdd->prepare("UPDATE test3 SET en_cours = 1 WHERE id = ?");
$insertmbr->execute(array($_SESSION['id']));
unset($insertmbr);
//$insertmbr = $bdd->prepare("UPDATE users SET en_cours = 1 WHERE id = ?");
$insertmbr = $bdd->prepare("UPDATE test3 SET en_cours = 1 WHERE id = ?");
$insertmbr->execute(array($_SESSION['eleveid']));
unset($insertmbr);

header("Location: ../")

?>