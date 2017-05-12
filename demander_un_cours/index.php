<!DOCTYPE html>
<?php
session_start();
$bdd = mysqli_connect("127.0.0.1","root","","tes"); // bbd dans laquelle un prof est dispo pour un cours ou non
//$bdd = mysqli_connect("mysql2.paris1.alwaysdata.com","136109","ping","studychoice_utilisateurs");

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
	<div align="text-center">
        <div class="col-lg-12">
        <div class="col-md-6">
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
		</div>
		</div>
		</div>

		<?php
			if (isset($_POST['Cours']))
			{
				$cours = mysqli_real_escape_string($bdd, htmlspecialchars($_POST['Cours']));
				//$prof = mysqli_query($bdd,"SELECT * FROM users JOIN matieres ON users.id = matieres.idprof WHERE matieres.matiere = "."'".$cours."' AND users.disponible = 1 ORDER BY note_avg DESC LIMIT 0,5 ") or die(mysql_error($bdd));
				$prof = mysqli_query($bdd,"SELECT * FROM test3 JOIN matieres ON test3.id = matieres.idprof WHERE matieres.matiere = "."'".$cours."' AND test3.disponible = 1 ORDER BY note_avg DESC LIMIT 0,5 ") or die(mysql_error($bdd));
				?>
				<?php
					while($resultat = mysqli_fetch_array($prof))
					{?>
						<a href="../Profil/?id=<?php echo $resultat['id'];?>"><?php echo $resultat['prenom']." ".$resultat['nom']; ?></a>
						<?php if ($resultat['note_avg'])
						{
							echo $resultat['note_avg'];
						} else { echo "Ce professeur n'a encore jamais donné de cours sur notre plateforme"; } ?>
						<br/><?php
					}?>
				<?php
			}
		?>
	</body>
	</html>
<?php }else {
	header("Location: ../connexion");
}
?>