<?php
session_start();
try{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=tes', 'root', ''); 
	echo'succes';
}
catch(Exception $e){
   echo'error';
}
if ($_SESSION['id'])
{
	$request = "SELECT  * FROM test3 WHERE id = ".$_SESSION['id'];
	$result = $bdd->query($request);
	$row = $result->fetch();


	if ($row['en_cours'] != 0)
	{
		if(isset($_POST['note']) == 1)
		{
			if($row['nombre_de_notes'] != null)
			{
				$insertmbr = $bdd->prepare("UPDATE test3 SET nombre_de_notes = ?  AND note_avg = ? WHERE id = ?");
				$insertmbr->execute(array(1,$_POST['note'],$row['idprof']));
				unset($insertmbr);
				
			} else {
				$noteAVG = ($_POST['note'] + $row['nombre_de_notes'] * $row['note_avg']) / $row['nombre_de_notes'];
				$insertmbr = $bdd->prepare("UPDATE test3 SET nombre_de_notes = ?  AND note_avg = ? WHERE id = ?");
				$insertmbr->execute(array($row['nombre_de_notes'] + 1,$noteAVG ,$row['idprof']));
				unset($insertmbr);
			}
			$insertmbr = $bdd->prepare("UPDATE test3 SET idprof = 0 AND en_cours = 0 WHERE id = ?");
			$insertmbr->execute(array($_SESSION['id']));
			unset($insertmbr);
		}	
	}



	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Study Choice</title>
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
<?php } else { header("Location: ../profil/connexion.php"); }