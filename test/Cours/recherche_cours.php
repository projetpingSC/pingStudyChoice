<!DOCTYPE html>
<?php
session_start();
try{
	$bdd = mysqli_connect("127.0.0.1","root","","tes");;  // bbd dans laquelle un prof est dispo pour un cours ou non
	echo'succes';
}
catch(Exception $e){
	echo'error';
}

if($_SESSION['id'])
{?>
	<html>
	<head>
		<title>Study Choice</title>
	</head>
	<body>
		<p align="center">Un cours ?</p>
		<form method="POST" action="">
			<select name="Cours">
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
			<input type="submit" value="rechercher" />
		</form>

		<?php
			if (isset($_POST['Cours']))
			{
				$cours = mysqli_real_escape_string($bdd, htmlspecialchars($_POST['Cours']));
				$prof = mysqli_query($bdd,"SELECT * FROM test3 JOIN matieres2 on id=idprof WHERE test3.disponible = 1 AND matieres2.matiere = "."'".$cours."' LIMIT 0,5") or die (mysqli_error($bdd));
				?>
				<?php
					while($resultat = mysqli_fetch_array($prof))
					{?>
						<a href="../Profil/profil.php?id=<?php echo $resultat['id'];?>"><?php echo $resultat['prenom']." ".$resultat['nom']; ?></a>
						<br/><?php
					}?>
				<?php
			}
		?>
	</body>
	</html>
<?php }else {
	header("Location: ../Profil/connexion.php");
}
?>