<?php
session_start();

//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping'); 
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', ''); 

if ($_SESSION['id'] && $_SESSION['statut'] == "eleve")
{
	if (!$_SESSION['idprof']) {
		header("Location: ../demander_un_cours");
	}
	//$request = "SELECT  * FROM users WHERE id = ".$_SESSION['id'];
	$request = "SELECT  * FROM test3 WHERE id = ".$_SESSION['idprof'];
	$result = $bdd->query($request);
	$row = $result->fetch();

	if (!$row['en_cours']) { header("Location: ../profil/?id=".$_SESSION['id']); }

	$idprof = $_GET['id'];
	if ($idprof == $row['id']) {


		if ($row['en_cours'] != 0)
		{
			if(isset($_POST['note']))
			{
				$note = (int)($_POST['grade']);
				if($row['nombre_de_notes'] < 1)
				{
					//$insertmbr = $bdd->prepare("UPDATE users SET nombre_de_notes = ?  AND note_avg = ? WHERE id = ?");
					$insertmbr = $bdd->prepare("UPDATE test3 SET nombre_de_notes = ?, note_avg = ? WHERE id = ?");
					$insertmbr->execute(array(1,$note,$row['idprof']));
					unset($insertmbr);
					
				} else {
					$noteAVG = ((double)$note + (int)$row['nombre_de_notes'] * (double)$row['note_avg']) / ((int)$row['nombre_de_notes'] + 1);
					//$insertmbr = $bdd->prepare("UPDATE users SET nombre_de_notes = ?  AND note_avg = ? WHERE id = ?");
					$insertmbr = $bdd->prepare("UPDATE test3 SET nombre_de_notes = ?, note_avg = ? WHERE id = ?");
					$insertmbr->execute(array($row['nombre_de_notes'] + 1,$noteAVG ,$idprof));
					unset($insertmbr);

				}
				//$insertmbr = $bdd->prepare("UPDATE users SET idprof = 0 AND en_cours = 0 WHERE id = ?");
				$insertmbr = $bdd->prepare("UPDATE test3 SET idprof = null, en_cours = null WHERE id = ?");
				$insertmbr->execute(array($_SESSION['id']));
				unset($insertmbr);
				//$insertmbr = $bdd->prepare("UPDATE users SET idprof = 0 AND en_cours = 0 WHERE id = ?");
				$insertmbr = $bdd->prepare("UPDATE test3 SET eleveid = null, en_cours = null WHERE id = ?");
				$insertmbr->execute(array($_SESSION['idprof']));
				unset($insertmbr);
				unset($_SESSION['idprof']);

				header("Location: ../profil/?id=".$_SESSION['id']);

			}	
		}
	}



	?>
	<!DOCTYPE html>
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
		<var> Vous devez noter votre professeur pour pouvoir reprendre un cours </var>
		<form method="POST" action="">
			<select name="grade">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
			<input type="submit" name="note" value="noter">

		</form>
	</body>
	</html>
<?php } else { header("Location: ../connexion"); }