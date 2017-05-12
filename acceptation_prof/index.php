<?php 
session_start();

//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', '');


if($_SESSION['id'])
{
	if (isset($_GET['id']) AND $_GET['id'] > 0 AND $_GET['id'] == $_SESSION['id'])
	{
		



	}

} else { header("Location: ../connexion"); }
?>