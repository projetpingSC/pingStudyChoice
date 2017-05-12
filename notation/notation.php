<?php
session_start();
try{
    $bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping'); 
	echo'succes';
}
catch(Exception $e){
   echo'error';
}
if ($_SESSION['id'])
{
	$request = "SELECT  * FROM users WHERE id = ".$_SESSION['id'];
	$result = $bdd->query($request);
	$row = $result->fetch();


	if ($row['en_cours'] != 0)
	{
		if(isset($_POST['note']) == 1)
		{
			if($row['nombre_de_notes'] != null)
			{
				$insertmbr = $bdd->prepare("UPDATE users SET nombre_de_notes = ?  AND note_avg = ? WHERE id = ?");
				$insertmbr->execute(array(1,$_POST['note'],$row['idprof']));
				unset($insertmbr);
				
			} else {
				$noteAVG = ($_POST['note'] + $row['nombre_de_notes'] * $row['note_avg']) / $row['nombre_de_notes'];
				$insertmbr = $bdd->prepare("UPDATE users SET nombre_de_notes = ?  AND note_avg = ? WHERE id = ?");
				$insertmbr->execute(array($row['nombre_de_notes'] + 1,$noteAVG ,$row['idprof']));
				unset($insertmbr);
			}
			$insertmbr = $bdd->prepare("UPDATE users SET idprof = 0 AND en_cours = 0 WHERE id = ?");
			$insertmbr->execute(array($_SESSION['id']));
			unset($insertmbr);
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
			<select>
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