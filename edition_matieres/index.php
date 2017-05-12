<!DOCTYPE html>
<?php
session_start();

//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', '');

if($_SESSION['id'])
{?>

<html>
<head>
	<title>Study Choice</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	   
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">


	<!-- Bootstrap Core CSS -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	    <!-- Custom Fonts -->
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

	    <!-- Theme CSS -->
	<link href="../css/agency.min.css" rel="stylesheet">
</head>
<body>

<var>
	<p>Selectionner les matieres dans lesquelles vous enseignez</p>
			<form method="POST" action="">
			<select name="matiere1">
				<option></option>
				<option>maths</option>
				<option>Physique</option>
				<option>SVT</option>
				<option>Chimie</option>
				<option>Anglais</option>
				<option>Francais</option>
				<option>Histoire</option>
				<option>Eco</option>
				<option>Allemand</option>
				<option>Espagnol</option>
				<option>Geographie</option>
			</select>
			<select name="matiere2">
				<option></option>
				<option>maths</option>
				<option>Physique</option>
				<option>SVT</option>
				<option>Chimie</option>
				<option>Anglais</option>
				<option>Francais</option>
				<option>Histoire</option>
				<option>Eco</option>
				<option>Allemand</option>
				<option>Espagnol</option>
				<option>Geographie</option>
			</select>
				<select name="matiere3">
				<option></option>
				<option>maths</option>
				<option>Physique</option>
				<option>SVT</option>
				<option>Chimie</option>
				<option>Anglais</option>
				<option>Francais</option>
				<option>Histoire</option>
				<option>Eco</option>
				<option>Allemand</option>
				<option>Espagnol</option>
				<option>Geographie</option>
			</select>
			<input type="submit" value="actualiser son profil" />
		</form>

		<?php
			if (isset($_POST['matiere1'])) {
				$matiere1 = htmlspecialchars($_POST['matiere1']);
				$query1 = $bdd->prepare("INSERT INTO matieres(idprof, matiere) VALUES(?, ?)");
				$query1->execute(array($_SESSION['id'], $matiere1));

				if (isset($_POST['matiere2'])) {
					$matiere2 = htmlspecialchars($_POST['matiere2']);
					$query2 = $bdd->prepare("INSERT INTO matieres(idprof, matiere) VALUES(?, ?)");
					$query2->execute(array($_SESSION['id'], $matiere2));

					if (isset($_POST['matiere3'])) {
						$matiere3 = htmlspecialchars($_POST['matiere3']);
						$query3 = $bdd->prepare("INSERT INTO matieres(idprof, matiere) VALUES(?, ?)");
						$query3->execute(array($_SESSION['id'], $matiere3));

					}
				}
				echo 'Vos matieres ont été ajoutées avec succes !';
			}
}  else { header("Location: ../"); }
?>
</var>
</body>
</html>